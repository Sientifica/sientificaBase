<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ProfilesControllers extends SiModel {

    static $table_name = 'profiles_controllers';


    

    public function validateRules() {

        return array(
                       
            array('profile_id,id_controller','require'),
           
        );
    }

    public function attributeLabels() {
        return array(
            'id_controller' => 'Id Controlador',
            'profile_id' => 'Id Perfil',
           
            
        );
    }

    public function beforeValidate() {

        return true;
    }
    
     public function afterValidate() {
           return true;
     }

    

}

?>
