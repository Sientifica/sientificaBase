<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends SiModel {

    static $table_name = 'users';
    static $primary_key = 'user_id';

    const PROFILE_SUPER = 1;    
    const ADMIN_PROFILE = 2;
   

    public $repeatpass;
    public $passwordActual;
    
    static $belongs_to = array(
        array('profiles'),
        
    );
    static $has_many = array(
        array('permissions', 'foreign_key' => 'user_id', 'readonly' => false),
       
    );
   

    public function validateRules() {

        return array(
            array('nickname,password', 'required', 'on' => 'login'),
            array('nickname', 'email', 'on' => 'create'),
            array('nickname', 'email', 'on' => 'update'),
            array('nickname', 'email', 'on' => 'dataccess'),           
            array('nickname,passwordActual,password,repeatpass', 'required', 'on' => 'dataccess'),
            array('nickname,password,repeatpass,name,profile_id', 'required', 'on' => 'create'),
            array('nickname,name,profile_id', 'required', 'on' => 'update'),
            array('nickname', 'unique', 'on' => 'create'),
            array('profile_id', 'numeric', 'only_integer' => true),
            array('password', 'compare', 'to' => 'repeatpass', 'on' => 'create'),
            array('password,repeatpass', 'required', 'on' => 'password'),
            array('password', 'compare', 'to' => 'repeatpass', 'on' => 'password'),            
            array('password', 'compare', 'to' => 'repeatpass', 'on' => 'passwordCustomer'),            
            array('password', 'compare', 'to' => 'repeatpass', 'on' => 'dataccess'),
            array('name,position,nickname,password,repeatpass,phone1', 'required', 'on' => 'account'),
            array('name,position,nickname,phone1', 'required', 'on' => 'customer'),
        );
    }

    public function attributeLabels() {
        return array(
            'nickname' => 'Email',
            'password' => 'Clave',
            'repeatpass' => 'Confirmar Clave',
            'name' => 'Nombre Completo',
            'profile_id' => 'Perfil',
            'passwordActual' => 'Clave Actual',
            'position' => 'Cargo',
            'phone1' => 'Telefono',
            'phone2' => 'Telefono (opcional)',
            'mobile' => 'Celular',
        );
    }

    public function beforeValidate() {

        /* if ($this->scenario == 'password') {
          $actual = User::find($this->user_id);

          if (!empty($this->passwordActual) && $actual->password != sha1($this->passwordActual)) {
          $this->addError("Clave Actual", "La clave actual no es valida");
          }
          } */

        if ($this->scenario != 'login' && $this->scenario != 'password' && $this->scenario != 'update') {
            if (count(@$_POST['permisos']) == 0) {
                // $this->addError("Permisos", "Debe seleccionar al menos una acción");
            }
        }


        return true;
    }

    public function afterValidate() {
        $this->repeatpass = @$_POST['User']['repeatpass'];
        return true;
    }

    public function authenticateUser() {


        $identify = new UserAuthenticate($this->nickname, $this->password);
        $identify->Authentication();

        switch ($identify->errorCode) {
            case UserAuthenticate::NOERROR:
                Base::$user->login($identify);
                break;
            case UserAuthenticate::NICK_INVALID:
                $this->addError('Usuario', 'no es válido.');
                break;
            default:
                $this->addError('Password', 'no es válido.');
                break;
        }
    }

}

?>
