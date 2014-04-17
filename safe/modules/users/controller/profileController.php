<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class profileController extends SiController {

    public $layout = false;

    public function actionAdmin() {
        $model = new Profile();
        $controllers = Controller::find("all");
        $this->render("admin", array('model' => $model, 'controllers' => $controllers));
    }

    public function actionGrid() {


        $criteria = array('conditions' => 'super=0');
        $paginator = new SiPaginator(new Profile, 5, 5, $criteria);
        $paginator->jfunction = 'Pagination';
        $listModel = Profile::find('all', $criteria);


        $this->render("grid", array('paginator' => $paginator));
    }

    public function actionCreate() {
        $model = new Profile();


        if (isset($_POST['Profile'])) {
            $_POST['parent_id'] = Base::getConfigApp()->params['profiles']['ADMIN'];
            $model->set_attributes($_POST['Profile']);
            $model->connection()->transaction();
            $transaction = true;
            try {
                if ($model->save()) {
                    if (isset($_POST['permisos'])) {

                        foreach ($_POST['permisos'] as $action_id) {
                            $actionProfile = new ActionProfile();
                            $actionProfile->action_id = $action_id;
                            $actionProfile->profile_id = $model->profile_id;
                            $actionProfile->allow = 1;
                            if (!$actionProfile->save()) {
                                $transaction = false;
                                break;
                            }
                        }
                    }
                    if ($transaction) {
                        $model->connection()->commit();
                        $this->addScript('success("El registro fué creado con éxito");');
                    } else {
                        $model->connection()->rollback();
                    }
                }
            } catch (ActiveRecord\DatabaseException $e) {
                $model->connection()->rollback();
                $model->addError("Error", "No se puedo efectuar el registro");
            }
        }

        $data = array();      
      
        $prfc = ProfilesControllers::find("all", array('conditions' => "profile_id =".Base::getConfigApp()->params['profiles']['ADMIN']));
        foreach ($prfc as $prof) {
            $data[] = $prof->id_controller;
        }
       

        $controllers = Controller::find("all", array('conditions' => 'id_controller IN(\''.implode("','",$data).'\')'));
        $this->render("create", array('model' => $model, 'controllers' => $controllers));
    }

    public function actionUpdate() {
        $model = $this->loadModel($_REQUEST['id']);

        if (isset($_POST['Profile'])) {
            $model->set_attributes($_POST['Profile']);
            $model->connection()->transaction();
            $transaction = true;
            try {
                if ($model->save()) {
                    if (isset($_POST['permisos']) && sizeof($_POST['permisos']) > 0) {
                        $model->connection()->query("DELETE FROM actions_profiles WHERE profile_id={$model->profile_id}");
                        foreach ($_POST['permisos'] as $action_id) {
                            $actionProfile = new ActionProfile();
                            $actionProfile->action_id = $action_id;
                            $actionProfile->profile_id = $model->profile_id;
                            $actionProfile->allow = 1;
                            if (!$actionProfile->save()) {
                                $transaction = false;
                                break;
                            }
                        }
                    }
                    if ($transaction) {
                        $model->connection()->commit();
                        $this->addScript('success("El registro fué modificado con éxito");');
                    } else {
                        $model->connection()->rollback();
                    }
                }
            } catch (ActiveRecord\DatabaseException $e) {
                $model->connection()->rollback();
                $model->addError("Error", "No se puedo efectuar la actualización");
            }
        }
        $data = array();      
      
        $prfc = ProfilesControllers::find("all", array('conditions' => "profile_id =".Base::getConfigApp()->params['profiles']['ADMIN']));
        foreach ($prfc as $prof) {
            $data[] = $prof->id_controller;
        }
       

        $controllers = Controller::find("all", array('conditions' => 'id_controller IN(\''.implode("','",$data).'\')'));

        $arrIdsAction = array();
        foreach ($model->actions_profiles as $ids) {
            $arrIdsAction[] = $ids->action_id;
        }


        $this->render("update", array('model' => $model, 'controllers' => $controllers, 'arrIdsAction' => $arrIdsAction));
    }

    public function actionDelete() {
        $model = $this->loadModel($_REQUEST['id']);
        try {
            $model->connection()->query("DELETE FROM actions_profiles WHERE profile_id={$model->profile_id}");
            $model->delete();
            $this->addScript('success("El registro fué eliminado con éxito");');
        } catch (ActiveRecord\DatabaseException $e) {
            $this->addScript('error("El Perfil no se puede eliminar porque tiene relacionados Permisos y/o Usuarios");', true);
        }
    }

    public function loadModel($id) {
        $model = Profile::find((int) $id);
        return $model;
    }

}

?>
