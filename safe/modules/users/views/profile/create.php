<?php $this->renderFile('application.views.js.js_common'); ?>
<script>
    function allActions(ctrl){
    
        $('input[ref="'+ctrl+'"]').each(function(){
        
            if($("#all_"+ctrl).is(':checked')){      
                $(this).attr('checked', true);
            }else{
                $(this).attr('checked', false); 
            } 
        });
    }

</script>
<div id="form">

    <?php echo Form::beginForm("", 'post', array('id' => 'createForm', 'target' => 'ifrm_uploadfiles', 'enctype' => 'multipart/form-data')); ?>
    <table border="0">

        <tr>
            <td><input  type=hidden id="transaccion"   value='crear'> </td>
            <td> <input  type=button class="input-submit"  id="buttonUpload" onclick="Save();"  value="Guardar">
                <input  type="reset" class="input-submit" onclick="Cancel();"    value='Cancelar'>  </td>
        </tr>

    </table>
    <h3>Perfiles usuario</h3>
    <div id="errors"><?php echo Form::errorSummary($model); ?></div>
    <div>


        <table width="100%" cellspacing="1" cellpadding="0" border="0" class="edit view">
            <tbody>
                <tr>
                    <td><?php echo Form::activeLabel($model, 'profile'); ?> <?php echo Form::activeTextField($model, 'profile'); ?></td>
                  
                </tr>
                
                  
                <tr> 
                    <td width="100%" valign="top">
                        <div id="profiles">
                            <h4>Permisos de Usuario</h4>
                            <ul>
                                <?php foreach ($controllers as $ctrl): ?>
                                    <div  style="float: left;margin-left: 30px; width: 200px;min-height: 200px"><strong><label><?php echo Form::checkbox('all_' . $ctrl->id_controller, false, array('onclick' => "allActions('$ctrl->id_controller')")); ?> <?php echo (!empty($ctrl->controller_name)) ? $ctrl->controller_name : $ctrl->id_controller; ?></label></strong>:
                                        <ul>
                                            <?php foreach ($ctrl->actions as $action): ?>
                                                <li><label><?php echo Form::checkbox('permisos[]', false, array('value' => $action->action_id, 'ref' => $ctrl->id_controller)); ?> <?php echo (!empty($action->action_name)) ? $action->action_name : $action->action; ?></label></li>
                                            <?php endforeach; ?> 


                                        </ul>
                                    </div>
                                <?php endforeach; ?> 
                            </ul>
                        </div>
                    </td>
                </tr>


            </tbody></table>

    </div>
    <table border="0">

        <tr>
            <td><input  type=hidden id="transaccion"   value='crear'> </td>
            <td> <input  type=button class="input-submit" id="buttonUpload" onclick="Save();"  value="Guardar">
                <input  type="reset" class="input-submit" onclick="Cancel();"    value='Cancelar'>  </td>
        </tr>

    </table>
    <?php echo Form::endForm(); ?>
</div>

