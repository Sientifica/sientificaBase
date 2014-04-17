<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionProfile extends SiModel {

    static $table_name = 'actions_profiles';


    

    public function validateRules() {

        return array(
                       
            array('action_id,profile_id','require'),
           
        );
    }

    public function attributeLabels() {
        return array(
            'action_id' => 'Id Accion',
            'profile_id' => 'Id Perfil',
            'allow' => 'Permiso',
            
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
