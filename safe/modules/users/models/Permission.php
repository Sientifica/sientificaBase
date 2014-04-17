<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Permission extends SiModel {

    static $table_name = 'permissions';

    public $active;
    

    public function validateRules() {

        return array(
                       
            array('action_id,user_id','require'),
           
        );
    }

    public function attributeLabels() {
        return array(
            'action_id' => 'Id Accion',
            'user_id' => 'Id Usuario',
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
