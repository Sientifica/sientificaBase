 
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
                url: "<?php echo Form::createUrl($this->module . "/" . $this->controller . "/loadPermissionsProfile"); ?>",
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
<div class="header">
    <h2>Permisos de perfiles</h2>
</div>
<div class="content clearfix"  style="padding: 20px">
    <div id="success"></div>
   
      <ul class="box">
     <li><?php echo Form::link("Gestion de acceso a controladores y acciones", array('users/config/index'), array('class' => 'active')); ?></li>
    <li><?php echo Form::link("Perfiles del sistema", array('users/config/profile')); ?></li>
   
    <li><?php echo Form::link("Permisos de Perfiles", array('users/config/Permissions')); ?></li>
 

</ul>
    <div id="listado">



        <div id="grid">
            <?php echo Form::beginForm('', 'post', array('id' => 'createForm',)); ?>
            <div align="center">

                <?php echo Form::submitButton('Guardar'); ?>

            </div>
            <div id="form" style=" width:auto; margin-left: auto;margin-right: auto">




                <div id="errors"><?php //echo Form::errorSummary($model);         ?></div>
                <div>
                    Seleccione el Perfil
                    <?php echo Form::dropDownList('profile_id', '', $profilesData, array("prompt" => '-- Seleccione Perfil --', 'onchange' => 'enableChecks(this.value);')); ?>

                    <div id="permissions"></div>

                </div>

                <?php echo Form::endForm(); ?>
            </div>
        </div>
    </div>
</div>
