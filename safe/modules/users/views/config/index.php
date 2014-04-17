<div class="header">
    <h2>Gestion de acceso a controladores y acciones</h2>
</div>
<div class="content clearfix" style="padding: 20px">

    <div id="success"></div>
   
    <ul>
     <li><?php echo Form::link("Gestion de acceso a controladores y acciones", array('users/config/index'), array('class' => 'active')); ?></li>
    <li><?php echo Form::link("Perfiles del sistema", array('users/config/profile')); ?></li>
   
    <li><?php echo Form::link("Permisos de Perfiles", array('users/config/Permissions')); ?></li>
 

</ul>

    <div id="listado">



        <div id="grid">
            <?php echo Form::beginForm('index', 'post', array('id' => 'createForm',)); ?>
            <div align="center">

                <?php echo Form::submitButton('Guardar'); ?>

            </div>
            <p>&ensp;</p>
            <?php $i = 0;
                 foreach ($modules as $nameModule => $mod)    : 
              
                ?> 
             
                    <?php foreach ($mod as $key => $module): ?>

                    <table border="0" align="center">
                        <thead>
                            <tr>
                                <th>Datos Controlador</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style=" border-right: slategrey 1px solid">

                                    <table border="0">
                                        <tr>
                                            <td>Restringir</td>
                                            <td>

                                                <?php echo Form::checkBox("ModelController[active][$key]", $models[$key]->active); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Controller ID </td>
                                            <td><?php echo Form::activeTextField($models[$key], "id_controller[]", array('readonly' => true, 'value' => $key)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alias</td>
                                            <td> <?php echo Form::activeTextField($models[$key], "controller_name[]", array('value' => $models[$key]->controller_name)); ?>
                                            <?php echo Form::activeHiddenField($models[$key], "module[]", array('value' => $nameModule)); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Descripcion</td>
                                            <td>
                                                <textarea id="ModelController_controller_desc" name="ModelController[controller_desc][]" ><?php echo $models[$key]->controller_desc; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Perfiles</td>
        <?php $profilesData = Form::listData(Profile::find('all', array('conditions' => 'super=1')), 'profile_id', 'profile'); ?>
                                            <td>

                                                <?php
                                                foreach ($profilesData as $value => $name):
                                                    $data = array();
                                                    $prfc = ProfilesControllers::find("all", array('conditions' => "id_controller='$key'"));
                                                    foreach ($prfc as $prof) {
                                                        $data[] = $prof->profile_id;
                                                    }
                                                    ?>
                                                    <label><?php echo Form::checkBox("ModelController[profile_id][$key][]", (in_array($value, $data)) ? true : false, array('value' => $value)); ?>  <?php echo $name; ?></label></br>

        <?php endforeach; ?>


                                                </select>
                                            </td>
                                        </tr>

                                    </table>



                                </td>
                                <td> <table border="0" style="margin-top:20px;margin-bottom:50px;">

                                        <tbody>
                                            <?php $j = 0;
                                            foreach ($module as $n => $action):
                                                ?>
                                                <tr>
                                                    <td>Restringir <?php echo Form::checkBox("Action[active][$key][$action]", $actions[$key][$n]->active); ?></td>
                                                    <td>ID <?php echo Form::activeTextField($actions[$key][$n], "action[$key][]", array('readonly' => true, 'value' => $action)); ?></td>
                                                    <td>Alias <?php echo Form::activeTextField($actions[$key][$n], "action_name[$key][]", array('value' => $actions[$key][$n]->action_name)); ?></td>
                                                    <td>Descripcion 
                                                        <textarea id="Action_action_desc_accountController" name="Action[action_desc][<?php echo $key; ?>][]"><?php echo $actions[$key][$n]->action_desc; ?></textarea>
                                                    </td>
                                                </tr>
            <?php $j++;
        endforeach;
        ?>
                                        </tbody>
                                    </table></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    $i++;
                endforeach;?>
             </fieldset>
            <?php endforeach;
            ?>
            </br>
            <div align="center">   <?php echo Form::submitButton('Guardar'); ?></div>
<?php echo Form::endForm(); ?>
        </div>



    </div> 
</div>