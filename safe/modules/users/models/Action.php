<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Action extends SiModel {

    static $table_name = 'actions';
    
    


     static $has_many = array(
      array('actions_profiles', 'foreign_key' => 'action_id', 'readonly' => false),
      array('permissions', 'foreign_key' => 'action_id', 'readonly' => false),
      ); 
    
    static $belongs_to = array(
        array('controller', 'class_name' =>'ModelController', 'foreign_key' => 'id_controller'),
    );

    public function validateRules() {

        return array(
            array('id_action', 'require'),
        );
    }

    public function attributeLabels() {
        return array(
            'id_action' => 'ID Controlador',
            'action_name' => 'Nombre',
            'action_desc' => 'Descripcion',
            'active'=>'Activo'
            
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
