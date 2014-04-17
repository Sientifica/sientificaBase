<div class="header">
    <h2>Perfiles del sistema</h2>
</div>
<div class="content clearfix"  style="padding: 50px">

<div id="success"></div>

  <ul class="box">
     <li><?php echo Form::link("Gestion de acceso a controladores y acciones", array('users/config/index'), array('class' => 'active')); ?></li>
    <li><?php echo Form::link("Perfiles del sistema", array('users/config/profile')); ?></li>
   
    <li><?php echo Form::link("Permisos de Perfiles", array('users/config/Permissions')); ?></li>
 

</ul>

    


        <table border="0" align="center">
            <thead>
                <tr>
                    <th>Perfiles del sistema</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style=" border-right: slategrey 1px solid">


                        <div id="errors"><?php echo Form::errorSummary($model); ?></div>
                        <div>
                            <?php echo Form::beginForm('', 'post', array('id' => 'createForm',)); ?>                

                            <table width="100%" cellspacing="1" cellpadding="0" border="0" class="edit view">
                                <tbody>
                                    <tr>
                                        <td><?php echo Form::activeLabel($model, 'parent_id'); ?></td>
                                        <td> <?php echo Form::activeTextField($model, 'parent_id',array("size"=>3)); ?></td>
                                       
                                    </tr>
                                    <tr>
                                        <td><?php echo Form::activeLabel($model, 'profile'); ?> </td>
                                        <td><?php echo Form::activeTextField($model, 'profile'); ?></td>

                                    </tr>

                                </tbody></table>

                        </div>
                        <?php echo Form::submitButton('Guardar'); ?>

                        <?php echo Form::endForm(); ?>

                    </td>
                    <td> 
                        <table border="0"  width="100%" class="list_clientes"  cellspacing="0" cellpadding="5">
                            <thead>
                                <tr>
                                    <th>ID</th>     
                                    <th>Perfil</th>           
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (Profile::find("all", array('conditions' => 'super=1')) as $n => $object): ?>
                                    <tr <?php echo ($n % 2 == 0) ? "class='filapar'" : ""; ?>>
                                        <td><?php echo $object->profile_id; ?></td>
                                        <td><?php echo $object->profile; ?></td>

                                        <td class="tdderecha"><table width="100%" class="acciones_list">

                                                <tbody>
                                                    <tr>
                                                        <td><?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/iconos/edit.gif", 'Editar', array("border" => 0)), array('users/config/editProfile', 'id' => $object->getPkValue())); ?></td>

                                                        <td><?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/iconos/eliminar.png", 'Eliminar', array("border" => 0)), array('users/config/deleteProfile', 'id' => $object->getPkValue())); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>


</div>