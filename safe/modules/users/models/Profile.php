<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Profile extends SiModel {

    static $table_name = 'profiles';
    static $primary_key = 'profile_id';


     static $has_many = array(
      array('user', 'foreign_key' => 'profile_id'),
      array('actions_profiles', 'foreign_key' => 'profile_id', 'readonly' => false),
      );
     
      public $permissions = true;

      public function validateRules() {

        return array(                       
            array('profile','required'), 
          
        );
    }

    public function attributeLabels() {
        return array(
            'profile' => 'Perfil',
            'parent_id' => 'Relacion Perfil',
            'super' => 'Perfil del sistema',
            
        );
    }

    public function beforeValidate() {
        
        if(count(@$_POST['permisos'])==0 && $this->permissions){
            $this->addError("Permisos","Debe seleccionar al menos una acción");
        }

        return true;
    }
    
     public function afterValidate() {
           return true;
     }

    

}

?>
