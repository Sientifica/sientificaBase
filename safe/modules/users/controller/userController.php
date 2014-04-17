<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class userController extends SiController {

    public $layout = "admin";

    public function actionAdmin() {



        $model = new User();

        
        $criteria = new siCriteria();
        $criteria->join = 'INNER JOIN profiles p ON(p.profile_id = users.profile_id)';
        $criteria->condition = 'users.profile_id = ' . Base::getConfigApp()->params['profiles']['ADMIN'] . ' OR p.parent_id=' . Base::getConfigApp()->params['profiles']['ADMIN'];

        $paginator = new SiPaginator(array('model'=>$model,'criteria'=>$criteria));

        $profilesData = Form::listData(Profile::find('all', array('conditions' => 'profile_id > 1')), 'profile_id', 'profile');
        $controllers = ModelController::find("all");
        $this->render("admin", array('model' => $model, 'profilesData' => $profilesData, 'controllers' => $controllers,'paginator' => $paginator));
    }

    

    public function actionCreate() {
        $model = new User();
        $model->scenario = 'create';

        if (isset($_POST['User'])) {
            $model->set_attributes($_POST['User']);
            $model->password = sha1($model->password);
            $model->connection()->transaction();
            $transaction = true;
            try {
                if ($model->save()) {
                    if (isset($_POST['permisos'])) {

                        foreach ($_POST['permisos'] as $action_id) {
                            $actionPermission = new Permission();
                            $actionPermission->action_id = $action_id;
                            $actionPermission->user_id = $model->user_id;
                            $actionPermission->allow = 1;
                            if (!$actionPermission->save()) {
                                $transaction = false;
                                break;
                            }
                        }
                    }
                    if ($transaction) {
                        $model->connection()->commit();
                        $this->redirect("admin");
                    } else {
                        $model->connection()->rollback();
                    }
                }
            } catch (ActiveRecord\DatabaseException $e) {
                $model->connection()->rollback();
                $model->addError("Error", "No se puedo efectuar el registro");
            }
            $model->password = '';
        }


        $criteria = array('conditions' => 'parent_id=' . Base::getConfigApp()->params['profiles']['ADMIN'] . ' OR profile_id=' . Base::getConfigApp()->params['profiles']['ADMIN']);
        $profilesData = Form::listData(Profile::find('all', $criteria), 'profile_id', 'profile');

        $join = "INNER JOIN profiles_controllers AS pc ON(pc.id_controller=controllers.id_controller) ";
        $controllers = ModelController::find("all", array('joins' => $join, 'conditions' => 'pc.profile_id =' . Base::getConfigApp()->params['profiles']['ADMIN'] . ''));

        $this->render("create", array('model' => $model, 'profilesData' => $profilesData, 'controllers' => $controllers));
    }

    public function actionUpdate() {
        $model = $this->loadModel($_REQUEST['id']);

        $model->scenario = 'update';
        if (isset($_POST['User'])) {
            $model->set_attributes($_POST['User']);
            $model->connection()->transaction();
            $transaction = true;
            try {
                if ($model->save()) {
                    if (isset($_POST['permisos']) && sizeof($_POST['permisos']) > 0) {
                        $model->connection()->query("DELETE FROM permissions WHERE user_id={$model->user_id}");
                        foreach ($_POST['permisos'] as $action_id) {
                            $actionPermission = new Permission();
                            $actionPermission->action_id = $action_id;
                            $actionPermission->user_id = $model->user_id;
                            $actionPermission->allow = 1;
                            if (!$actionPermission->save()) {
                                $transaction = false;
                                break;
                            }
                        }
                    }
                    if ($transaction) {
                        $model->connection()->commit();
                        $this->redirect("admin");
                    } else {
                        $model->connection()->rollback();
                    }
                }
            } catch (ActiveRecord\DatabaseException $e) {
                $model->connection()->rollback();
                $model->addError("Error", "No se puedo efectuar la actualización");
            }
        }


        $criteria = array('conditions' => 'parent_id=' . Base::getConfigApp()->params['profiles']['ADMIN'] . ' OR profile_id=' . Base::getConfigApp()->params['profiles']['ADMIN']);
        $profilesData = Form::listData(Profile::find('all', $criteria), 'profile_id', 'profile');



        $data = array();

        $join = "INNER JOIN profiles_controllers AS pc ON(pc.id_controller=controllers.id_controller) ";
        $controllers = ModelController::find("all", array('joins' => $join, 'conditions' => 'pc.profile_id =' . Base::getConfigApp()->params['profiles']['ADMIN'] . ''));

        $arrIdsAction = array();

        foreach ($model->permissions as $ids) {
            $arrIdsAction[] = $ids->action_id;
        }

        $this->render("update", array('model' => $model, 'profilesData' => $profilesData, 'controllers' => $controllers, 'arrIdsAction' => $arrIdsAction));
    }

    public function actionLoadPermissionsProfile() {
        $criteria = array("conditions" => array("profile_id=?", $_GET['id']));
        $model = ActionProfile::find("all", $criteria);

        $arrIdsAction = array();
        foreach ($model as $ids) {
            $arrIdsAction[] = $ids->action_id;
        }

        $data = array();

        $join = "INNER JOIN profiles_controllers AS pc ON(pc.id_controller=controllers.id_controller) ";
        $controllers = ModelController::find("all", array('joins' => $join, 'conditions' => 'pc.profile_id =' . Base::getConfigApp()->params['profiles']['ADMIN'] . ''));
        $this->layout = false;
        $this->render("profiles", array('controllers' => $controllers, 'arrIdsAction' => $arrIdsAction, 'profile' => $_GET['id']));
    }

    public function actionChangePassword() {

        $model = $this->loadModel( $_REQUEST['id']);
        $model->scenario = 'password';
        if (isset($_POST['User'])) {

            $model->set_attributes($_POST['User']);
            $model->password = sha1($model->password);
            if ($model->save()) {
                $this->redirect("admin");
            }
        }
        $model->password = '';

        $this->render("changePassword", array('model' => $model));
    }

    public function actionDelete() {
        $model = $this->loadModel($_REQUEST['id']);
        try {
            $model->connection()->query("DELETE FROM permissions WHERE user_id={$model->user_id}");
            $model->delete();
            $this->redirect("admin");
        } catch (ActiveRecord\DatabaseException $e) {
            $this->addScript('error("El Perfil no se puede eliminar porque tiene registros relacionados");', true);
        }
    }

    public function loadModel($id) {
        $model = User::find(array('conditions' => array('SHA1(user_id)=?', $_REQUEST['id'])));
        if (!$model)
            Base::request()->errorHandle(404, "Not Found");

        return $model;
    }

    public function actionDataAccess() {

        if (!Base::$user->getIsLogued())
            Base::request()->errorHandle(404, "No tiene permisos para ejecutar esta accion");
            
        if(!User::exists(Base::$user->getRegisterVars('id')))
               Base::request()->errorHandle(404, "No tiene permisos para ejecutar esta accion");

        $model = User::find(Base::$user->getRegisterVars('id'));


        $actual = $model->password;
        $model->scenario = 'dataccess';
        if (isset($_POST['User'])) {

            $model->set_attributes($_POST['User']);

            if ($actual != sha1($model->passwordActual)) {
                $model->addError('passwordActual', 'No corresponde a la clave actual');
            }
            $model->password = sha1($model->password);
            if ($model->save()) {

                $this->redirect("main/login");
            }
            $model->password = '';
        }
        $model->password = '';
        $model->passwordActual = '';
        $this->render("dataAccess", array('model' => $model));
    }

}

?>
