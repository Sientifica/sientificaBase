<script>
            
    $(document).ready(function(){
               
                
        $(".checkboxall").click(function()
        {
            var checked_status = this.checked;
            $("input[class=checkboxItem]").each(function()
            {
                this.checked = checked_status;
            });
        });
                
    })
            
    function enableChecks(value){
        loadPermissions(value)
                
    }
            
    function loadPermissions(id){
        jQuery.ajax({
            type: "GET",
            url: "<?php echo Form::createUrl($this->module."/".$this->controller . "/loadPermissionsProfile"); ?>",
            data: "id="+id,
            success: function(msg){
                $("#permissions").html(msg);
                
            }

        });
    }
            
            
           
           
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
<table width="100%" cellspacing="1" cellpadding="0" border="0" align="center" >
    <tbody>

        <tr>
            <td width="100%" valign="top" scope="row">
                Seleccionar todo
                <?php echo Form::checkbox('checkall', false, array('class' => 'checkboxall')); ?>

            </td>


        </tr>


        <tr> 
            <td width="100%" valign="top">
                <div id="profiles">
                    <h4>Permisos de Usuario</h4>
                    <ul>
                        <?php foreach ($controllers as $ctrl): ?>
                            <?php if ($ctrl->active == 1): ?>
                                <div  style="float: left;margin-left: 30px; width: 200px;min-height: 200px"><strong><label><?php echo Form::checkbox('all_' . $ctrl->id_controller, false, array('onclick' => "allActions('$ctrl->id_controller')", 'class' => 'checkboxItem')); ?> <?php echo (!empty($ctrl->controller_name)) ? $ctrl->controller_name : $ctrl->id_controller; ?></label></strong>:
                                    <ul>
                                        <?php foreach ($ctrl->actions as $action): ?>
                                            <?php if ($action->active == 1): ?>
                                                <li><label><?php echo Form::checkbox('permisos[]', in_array($action->action_id, $arrIdsAction), array('value' => $action->action_id, 'class' => 'checkboxItem', 'ref' => $ctrl->id_controller)); ?> <?php echo (!empty($action->action_name)) ? $action->action_name : $action->action; ?></label></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?> 


                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?> 
                    </ul>
                </div>
            </td>
        </tr>


    </tbody></table>