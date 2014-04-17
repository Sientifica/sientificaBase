<?php

class mainController extends SiController {

    public $layout = "admin";

    public function actionIndex() {
        if (!Base::$user->getIsLogued())
            $this->redirect('users/login/login');
        
        
      $this->render('index');  
    }

    public function actionLeftMenu() {
        $ctrl = $_GET['ctrl'];
        $this->renderFile("application.views." . $ctrl . "._leftmenu");
    }

    public function actionError() {

        $error = Base::$error['error'];
        $message = Base::$error['message'];
        $this->layout = "login";

        $this->render('error', array('error' => $error, 'message' => $message));
    }

}

?>
