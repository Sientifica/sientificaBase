<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ModelController extends SiModel {

    static $table_name = 'controllers';


     static $has_many = array(
      array('actions', 'foreign_key' => 'id_controller', 'readonly' => false),
      //array('permissions', 'foreign_key' => 'id_module', 'readonly' => false),
      ); 

    public function validateRules() {

        return array(
            array('id_controller,controller_name', 'require'),
        );
    }

    public function attributeLabels() {
        return array(
            'id_controller' => 'ID Controlador',
            'controller_name' => 'Nombre',
            'controller_desc' => 'Descripcion',
            'module' => 'Modulo',           
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
