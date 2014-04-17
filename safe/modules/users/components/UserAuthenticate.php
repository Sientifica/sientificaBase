<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserAuthenticate
 *
 * @author randrade
 */
class UserAuthenticate extends SiUserAuthenticate {

    public function Authentication() {

        $username = strtolower(trim($this->nickname));
        $password = trim($this->password);

        $criteria = array('conditions' => array('LOWER(nickname) = ?', $username));
        $model = User::find($criteria);

        if ($model === null) {
            $this->errorCode = self::NICK_INVALID;
        } else if ($model->password != sha1($password)) {
            $this->errorCode = self::PASSWORD_INVALID;
        } else {
            $this->errorCode = self::NOERROR;
            $this->id = $model->user_id;
            $this->setVar('name', $model->name);
            $this->setVar('nickname', $model->nickname);
            $this->setVar('profile', $model->profile_id);
           
        }
    }

}

?>
