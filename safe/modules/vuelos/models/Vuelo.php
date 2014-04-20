<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Vuelo extends SiModel {

    public $archivo_carga;
    static $table_name = 'vuelos';
    static $primary_key = 'idvuelo';
    /*
      static $belongs_to = array(
      array('rel_padre', 'class_name' => 'Awbs', 'foreign_key' => 'awbpadre'),
      );
     * 
     */
    static $has_many = array(

      /*
        array('rel_preawbs', 'class_name' => 'PreAwb', 'foreign_key' => 'idvuelo'),
        array('rel_movs_entrada', 'class_name' => 'Movimientos', 'foreign_key' => 'idvuelo', "conditions" => "tipo='entrada'"),
      */  
    );

    public function validateRules() {


        return array(
            array("vuelo,fecha,aerolinea", "required", "on" => "create"),
            array("archivo_carga", "required", "on" => "detalle"),
        );

        return (true);
    }

    public function attributeLabels() {
        return array(
            'created_at' => 'Fecha de registro',
            'vuelo' => 'Número de vuelo',
            'fecha' => 'Fecha de vuelo',
            'aerolinea' => 'Aerolínea',
            'archivo_carga'=>"Archivo de Carga",
        );
    }

    public function beforeValidate() {

        /*
          if (isset($this->hijas)) {


          $awbPosicionesPadre = array();
          $valid = false;
          foreach ($_POST['AwbsPosicion']['padre'] as $p => $padre) {
          $awbPosicionesPadre[$p] = new AwbsPosicion();
          $awbPosicionesPadre[$p]->set_attributes($padre);
          if(empty($awbPosicionesPadre[$p]->posicion)){
          $valid = true;
          break;
          }
          }

          $arrCodes=array();
          foreach (@$this->hijas as $n => $hija) {
          $hijas[$n] = new Awbs();
          $hijas[$n]->set_attributes($hija);
          if (!empty($hijas[$n]->awbcode) && $valid) {
          $this->scenario = "onlyhijas";
          $this->isHijas = true;
          $arrCodes[] = $hijas[$n]->awbcode;
          if($hijas[$n]->awbcode == $this->awbcode){
          $this->addError("awbcode","El codigo AWB se ha duplicado en un codigo HAWB");
          break;
          }
          }
          }

          $contUniq = sizeof(array_unique($arrCodes));
          $contOri = sizeof($arrCodes);
          if($contUniq != $contOri){
          $this->addError("awbpadre","Existe codigos HAWB duplicados");
          }
          }


          if (empty($this->awbpadre))
          $this->awbpadre = NULL;
         * 
         */
        return true;
    }

    public function afterValidate() {
        return true;
    }

}

?>