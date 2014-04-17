<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class configController extends SiController {

    public $layout = "admin";

    public function actionIndex() {

        if (!Base::$user->getIsLogued()) {
            Base::request()->errorHandle(403, "Acceso restringido");
           
        }
        if (Base::getConfigApp()->params['profiles']['SUPER']  != Base::$user->getRegisterVars('profile')) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }


        $modules = self::getModules();
        $i = 0;

        $models = array();
        foreach ($modules as $name => $mod) {            
            foreach ($mod as $key => $module) {
                if (ModelController::exists($key)) {
                    $models[$key] = ModelController::find($key);
                } else {
                    $models[$key] = new ModelController();
                }
                foreach ($module as $n => $action) {
                    $criteria = array('conditions' => "action ='$action' AND id_controller='$key'");
                    if (Action::exists($criteria)) {
                        $actions[$key][$n] = Action::find($criteria);
                    } else {
                        $actions[$key][$n] = new Action();
                    }
                }
            }
        }

        if (isset($_POST['ModelController'])) {
            //$model->connection()->query("TRUNCATE TABLE actions_profiles;TRUNCATE TABLE permissions; TRUNCATE TABLE actions; TRUNCATE TABLE " . $model->table()->table);
            // echo "<pre>";
            //print_r($_POST['ModelController']['profile_id']);die;

            $i = 0;
            foreach ($models as $name => $model) {

                $model->active = @$_POST['ModelController']['active'][$name];
                $model->id_controller = $tmp = $_POST['ModelController']['id_controller'][$i];
                $model->controller_name = $_POST['ModelController']['controller_name'][$i];
                $model->controller_desc = $_POST['ModelController']['controller_desc'][$i];
                $model->module = $_POST['ModelController']['module'][$i];             
                $model->connection()->query("DELETE FROM profiles_controllers WHERE id_controller='" . $model->id_controller . "'");
                 
                foreach ($_POST['ModelController']['profile_id'][$tmp] as $profile) {
                    $proContr = new ProfilesControllers();
                    $proContr->profile_id = $profile;
                    $proContr->id_controller = $model->id_controller;
                    $proContr->save();
                }
                

                if ($model->save()) {
                    $j = 0;
                    foreach ($actions[$tmp] as $key => $action) {

                        $action->action = $act = $_POST['Action']['action'][$tmp][$j];
                        $action->active = @$_POST['Action']['active'][$tmp][$act];
                        $action->id_controller = $model->id_controller;
                        $action->action_name = $_POST['Action']['action_name'][$tmp][$j];
                        $action->action_name = $_POST['Action']['action_name'][$tmp][$j];
                        $action->action_desc = $_POST['Action']['action_desc'][$tmp][$j];
                        $action->save();
                        //echo $action;
                        $j++;
                    }
                }

                $i++;
            }


            /* foreach($_POST['Action'] as $key => $controller){
              foreach( $_POST['Action'][$key] as $name =>$value){
              echo $name."<br>";
              }
              } */
        }

        //$models = ModelController::find("all"); 
        // print_r($models[0]->controller_name);
        $this->render("index", array('models' => $models, 'modules' => $modules, 'actions' => $actions));
    }

    public function actionProfile() {

        if (!Base::$user->getIsLogued()) {
            Base::request()->errorHandle(403, "Acceso restringido");
        }
        if (Base::getConfigApp()->params['profiles']['SUPER']  != Base::$user->getRegisterVars('profile')) {
            Base::request()->errorHandle(403, "Acceso restringido");
        }

        $model = new Profile();
        $model->permissions = false;
        if (isset($_POST['Profile'])) {
            $_POST['Profile']['super'] = 1;
            $model->set_attributes($_POST['Profile']);
            if ($model->save()) {

                $this->redirect("profile");
            }
        }

        $this->render("profile", array('model' => $model));
    }

    public function actionEditProfile() {

        if (!Base::$user->getIsLogued()) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }
        if (Base::getConfigApp()->params['profiles']['SUPER']  != Base::$user->getRegisterVars('profile')) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }

        $model = $this->loadProfile();
        $model->permissions = false;

        if (isset($_POST['Profile'])) {
            $model->set_attributes($_POST['Profile']);
            if ($model->save()) {
                $this->redirect("profile");
            }
        }

        $this->render("profile", array('model' => $model));
    }

    public function actionDeleteProfile() {
        if (!Base::$user->getIsLogued()) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }
        if (Base::getConfigApp()->params['profiles']['SUPER']  != Base::$user->getRegisterVars('profile')) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }


        $model = $this->loadProfile();

        $model->connection()->query("DELETE FROM actions_profiles WHERE profile_id={$model->profile_id}");
        $model->delete();
        $this->redirect("profile");
    }

    public function actionPermissions() {
        $model = new ActionProfile();

        if (!Base::$user->getIsLogued()) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }
        if (Base::getConfigApp()->params['profiles']['SUPER']  != Base::$user->getRegisterVars('profile')) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }

        if (isset($_POST['permisos'])) {
            try{
            $model->connection()->query("DELETE FROM actions_profiles WHERE profile_id={$_POST['profile_id']}");
            }catch(ActiveRecord\DatabaseException $e){}
            foreach ($_POST['permisos'] as $action_id) {
                $actionProfile = new ActionProfile();
                $actionProfile->action_id = $action_id;
                $actionProfile->profile_id = $_POST['profile_id'];
                $actionProfile->allow = 1;
                if (!$actionProfile->save()) {
                    $transaction = false;
                    break;
                }
            }
            $this->redirect("permissions");
        }

        $criteria = array('conditions' => 'super=1');
        $profilesData = Form::listData(Profile::find('all', $criteria), 'profile_id', 'profile');


        $this->render("permissions", array('profilesData' => $profilesData));
    }

    public function actionLoadPermissionsProfile() {

        if (!Base::$user->getIsLogued()) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }
        if (Base::getConfigApp()->params['profiles']['SUPER']  != Base::$user->getRegisterVars('profile')) {
             Base::request()->errorHandle(403, "Acceso restringido");
        }
        if (empty($_GET['id']))
            die;
        $data = array();
        $prfc = ProfilesControllers::find("all", array('conditions' => "profile_id =" . $_GET['id'] . ""));
        foreach ($prfc as $prof) {
            $data[] = $prof->id_controller;
        }
        if (sizeof($data) == 0) {
            die;
        }

        $controllers = ModelController::find("all", array('conditions' => 'id_controller IN(\'' . implode("','", $data) . '\')'));

        $actionP = ActionProfile::find("all", array('conditions' => 'profile_id=' . $_GET['id']));
        $arrIdsAction = array();
        foreach ($actionP as $ids) {
            $arrIdsAction[] = $ids->action_id;
        }
        $this->layout = false;

        $this->render("chargePermissions", array('controllers' => $controllers, 'arrIdsAction' => $arrIdsAction));
    }

    public function loadProfile() {

        $model = Profile::find((int) $_GET['id']);
        return $model;
    }

    public static function getModules() {

        $arrControllers = array();

        $pathController = Base::request()->getBasePathAbsolute() . "/safe/controller";
        $files = SiFunctions::listar_ficheros(array("php"), $pathController);

        foreach ($files[1] as $controller) {
            if ($controller != 'mainController') {
                Base::import("application.controller.$controller");
                $accciones = get_class_methods("$controller");
                foreach ($accciones as $name) {
                    if (preg_match("/(action)+([A-Za-z]*)/", $name, $matches)) {
                        $arrControllers['main'][$controller][] = lcfirst($matches[2]);
                    }
                }
            }
        }
        //se adiciona este bloque para permitir obtener acceso a las acciones de los controladores de modulos
        $mods = Base::getConfigApp()->modules;

        foreach ($mods as $key => $value) {

            $pathController = Base::request()->getBasePathAbsolute() . "/safe/modules/$value/controller";
            $files = SiFunctions::listar_ficheros(array("php"), $pathController);
            foreach ($files[1] as $controller) {
                 if ($value == 'users' && $controller == 'configController') 
                     continue;                     
               
                    Base::import("application.modules.$value.controller.$controller");
                    $accciones = get_class_methods("$controller");
                    foreach ($accciones as $name) {
                        if (preg_match("/(action)+([A-Za-z]*)/", $name, $matches)) {
                            $arrControllers[$value][$controller][] = lcfirst($matches[2]);
                        }
                    }
               
            }
        }


        return $arrControllers;
    }

}

?>
