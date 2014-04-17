<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class loginController extends SiController {

    public $layout = "login";
    
    
    public function actionLogin() {     
        

        Base::import('application.modules.users.components.UserAuthenticate');

        //$this->layout = false;

        $model = new User();
        $model->scenario = 'login';
        if (isset($_POST['User'])) {
            $model->set_attributes($_REQUEST['User']);
            if ($model->validate()) {
                $model->authenticateUser();
                if (Base::$user->getIsLogued()) {                    
                    $this->redirect('main/index');
                }
            }
        }


        $this->render("index", array('model' => $model));
    }

    public function actionLogout() {
        Base::$user->logout();
        $this->redirect('login');
    }


   

}

?>
