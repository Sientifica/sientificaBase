<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class vuelosController extends SiController {

    public $layout = "admin";

    public function actionAdmin() {

        //print_r($_POST);


        $vuelo = new Vuelo();
        $sql = "select t1.* from vuelos as t1 where 1 ";



        if ((isset($_REQUEST['vuelo']) && $_REQUEST['vuelo'] != '')) {

            $sql .= " && vuelo like '%" . $_REQUEST['vuelo'] . "%' ";
        }

        if (isset($_REQUEST['aerolinea']) && $_REQUEST['aerolinea'] != '') {

            $sql .= " && aerolinea like '%" . $_REQUEST['aerolinea'] . "%' ";
        }

        if ((isset($_REQUEST['inicio']) && $_REQUEST['inicio'] != '') && isset($_REQUEST['fin']) && $_REQUEST['fin'] != '') {

            $sql .= " && ( t1.fecha >= '" . $_REQUEST['inicio'] . "' && t1.fecha <='" . $_REQUEST['fin'] . "' ) ";
        }


        $paginator = new SiPaginator(array('model' => $vuelo, "query" => $sql));
        //print_r($model->connection()->last_query);
        $this->render("admin", array('model' => $vuelo, 'paginator' => $paginator));
    }

    public function actionCreate() {


        //print_r($_POST);
        //exit;

        $model = new Vuelo();
        $model->scenario = "create";

        if (isset($_POST['Vuelo'])) {

            //$model->connection()->transaction();
            $isValid = true;
            $transaccion = true;
            try {
                if (preg_match("/\//", $_POST['Vuelo']['fecha'])) {

                    $tmpDate = preg_split("/\//", $_POST['Vuelo']['fecha']);
                    $_POST['Vuelo']['fecha'] = $tmpDate[2] . "-" . $tmpDate[1] . "-" . $tmpDate[0];
                }
                $model->set_attributes($_POST['Vuelo']);
                if ($model->save()) {
                    //$model->connection()->commit();
                    $this->redirect("vuelos/vuelos/detalle", array("id" => $model->idvuelo));
                } else {
                    $model->addError('Error', "No se pudo efectuar el registro");
                    //$model->connection()->rollback();
                }
            } catch (ActiveRecord\DatabaseException $e) {

                //print_r($e);
                //$modelExistente = new Vuelo();
                $modelExistente = Vuelo::find(array("conditions" => array("aerolinea" => $_POST['Vuelo']['aerolinea'], "fecha" => $_POST['Vuelo']['fecha'], "vuelo" => $_POST['Vuelo']['vuelo'])));
                $model->addError('Error', "Ya existe un vuelo registrado con estos datos. <a href='index.php?module=vuelos&controller=vuelos&action=detalle&id=" . $modelExistente->idvuelo . "'>ver vuelo</a>", array("class" => 'btn'));
                $this->render("create", array('model' => $model));
            }
            //Se realiza registro transaccional en la base de datos para mantener integridad relacional
        }


        $this->render("create", array('model' => $model));
    }

    public function actionSalida() {

        $this->render("salida", array('movimientos' => $movimientos, 'model' => $model, 'hijas' => $hijas));
    }

    public function actionDetalle() {
        $model = $this->loadModel();
        $model->scenario = "detalle";

        if (isset($_POST['Vuelo'])) {


            /*if (preg_match("/\//", $_POST['Vuelo']['fecha'])) {

                $tmpDate = preg_split("/\//", $_POST['Vuelo']['fecha']);
                $_POST['Vuelo']['fecha'] = $tmpDate[2] . "-" . $tmpDate[1] . "-" . $tmpDate[0];
            }*/

            $file = new UploadFile($model, 'archivo_carga');
            $_POST['Vuelo']['archivo_carga'] = $file->save_filename;
            $model->set_attributes($_POST['Vuelo']);





            if (!$file->inType(array('csv')) && !empty($model->archivo_carga)) {
                $model->addError('archivo_carga', "Formatos permitidos de archivo son [*.csv]");
            }



            if ($model->validate()) {

                $file_handle = fopen($file->file_tmp, "r");
                $c = 1;
                if ($file_handle) {

                    while (!feof($file_handle)) {

                        $row = fgetcsv($file_handle, 1024);
                        if (trim($row[1]) == trim($model->vuelo)) {
                            $preawb = new PreAwb();
                            if (isset($row[13]) && !empty($row[13])) {

                                $preawb->set_attributes(array("created_at" => date("Y-m-d H:i:s"),
                                                                "awbcode" => trim($row[13]),
                                                                "peso" => trim($row[16]),
                                                                "qty_total_bultos" => trim($row[15]),
                                                                "idvuelo" => $model->id,
                                                                "awbpadre" => trim($row[9]),
                                                              )
                                );
                            } else {
                                $preawb->set_attributes(array("created_at" => date("Y-m-d H:i:s"),
                                    "awbcode" => trim($row[9]),
                                    "peso" => trim($row[11]),
                                    "qty_total_bultos" => trim($row[10]),
                                    "idvuelo" => $model->id,
                                        )
                                );
                            }
                            $preawb->save();                         
                            $c++;
                        }
                    }
                    $this->redirect("detalle",array("id"=>$model->id));
                }
            }

          
            
        }

        $this->render("detalle", array("model" => $model));
    }

    public function actionDelete() {
        $model = $this->loadModel($_REQUEST['id']);
        try {
            $model->delete();
            $this->redirect("admin");
        } catch (ActiveRecord\DatabaseException $e) {
            $this->addScript('error("El Perfil no se puede eliminar porque tiene registros relacionados");', true);
        }
    }

    public function loadModel($id = null) {

        $model = Vuelo::find(array('conditions' => array('idvuelo=?', (!is_null($id)) ? $id : $_REQUEST['id'])));
        if (!$model)
            Base::request()->errorHandle(404, "Not Found");

        return $model;
    }

    public function actionGetAerolineas() {
        $q = strtolower($_GET["q"]);

        if (!$q)
            return;
        $criteria = array('select' => 'aerolinea', 'group' => 'aerolinea', 'conditions' => array("aerolinea LIKE '%" . $q . "%'"));
        $models = Vuelo::find("all", $criteria);
        foreach ($models as $model) {
            echo "$model->aerolinea\n";
        }
    }

    public function actionGetVuelosByNameAndDate() {
        $q = strtolower($_GET["q"]);

        if (!$q)
            return;

        $longq = strlen($q);
        $criteria = array('conditions' => array("aerolinea LIKE '%" . $q . "%' || vuelo LIKE '%" . $q . "%' || SUBSTR(fecha,1," . $longq . ") = '" . $q . "'"));
        $models = Vuelo::find("all", $criteria);
        foreach ($models as $model) {
            echo "$model->aerolinea $model->vuelo (" . $model->fecha->format("Y-m-d") . ")|$model->idvuelo\n";
        }
    }

}

?>
