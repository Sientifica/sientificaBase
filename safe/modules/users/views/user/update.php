
<script>

    function allActions(ctrl) {

        $('input[ref="' + ctrl + '"]').each(function() {

            if ($("#all_" + ctrl).is(':checked')) {
                $(this).attr('checked', true);
            } else {
                $(this).attr('checked', false);
            }
        });
    }

    function loadPermissions(id) {
        jQuery.ajax({
            type: "GET",
            url: "<?php echo Form::createUrl($this->module . "/" . $this->controller . "/loadPermissionsProfile"); ?>",
            data: "id=" + id,
            success: function(msg) {
                $("#profiles").html(msg);

            }

        });
    }

</script>
<div class="header">
    <h1>Users</h1>
</div>
<?php echo $this->renderFile('application.views.main._menuReport'); ?>
<div class="separador"></div>
<div id="success"></div>  
<?php echo Form::beginForm("", 'post', array('id' => 'createForm', 'enctype' => 'multipart/form-data')); ?>


<table class="tablesorter"> 
    <tbody> 
        <tr>

            <td style=" text-align:right">
                <input type="submit" value="Save" class="btn">
                <?php echo Form::link("Cancel", array("admin"), array("class" => 'link')); ?>   </td>
        </tr>
    </tbody>
</table>

<table class="tablesearch">
    <tbody>
        <tr>
            <td colspan="2"> <div id="errors"><?php echo Form::errorSummary($model); ?></div></td>
        </tr>
        <tr>
            <td><?php echo Form::activeLabel($model, 'name'); ?></td>
            <td><?php echo Form::activeTextField($model, 'name', array('class' => 'input-text', 'size' => 30)); ?></td>

        </tr>
        <tr>
            <td><?php echo Form::activeLabel($model, 'nickname'); ?></td>
            <td> <?php echo Form::activeTextField($model, 'nickname', array('class' => 'input-text', 'size' => 30)); ?></td>

        </tr>

    </tbody>
</table>



<table class="tablesearch" style="margin-top: 20px">
    <tbody>
        <tr>
            <td width="100%" valign="top" scope="row">
                <?php echo Form::activeLabel($model, 'profile_id'); ?> &ensp; 
                <?php echo Form::activeDropDownList($model, 'profile_id', $profilesData, array("prompt" => '-- Seleccione Perfil --', 'onchange' => 'loadPermissions(this.value)')); ?>
            </td>


        </tr>
        <tr> 
            <td width="100%" valign="top">
                <div id="profiles">
                    <h4>Permisos de Usuario</h4>
                    <ul>
                        <?php foreach ($controllers as $ctrl): ?>
                            <?php if ($ctrl->active == 1): ?>
                                <div  style="float: left;margin-left: 30px; width: 200px;min-height: 200px"><strong><label><?php echo Form::checkbox('all_' . $ctrl->id_controller, false, array('onclick' => "allActions('$ctrl->id_controller')")); ?> <?php echo (!empty($ctrl->controller_name)) ? $ctrl->controller_name : $ctrl->id_controller; ?></label></strong>:
                                    <ul>
                                        <?php
                                        $join = "INNER JOIN actions_profiles AS ap ON(ap.action_id=actions.action_id) ";
                                        $actions = Action::find("all", array('joins' => $join, 'conditions' => 'ap.profile_id =' . Base::getConfigApp()->params['profiles']['ADMIN'] . " AND id_controller='" . $ctrl->id_controller . "'"));


                                        foreach ($actions as $action):
                                            ?>

                                            <?php if ($action->active == 1): ?>
                                                <li><label><?php echo Form::checkbox('permisos[]', in_array($action->action_id, $arrIdsAction), array('value' => $action->action_id, 'ref' => $ctrl->id_controller)); ?> <?php echo (!empty($action->action_name)) ? $action->action_name : $action->action; ?></label></li>
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


    </tbody>
</table>
<table class="tablesorter"> 
    <tbody> 
        <tr>

            <td style=" text-align:right">
                <input type="submit" value="Save" class="btn">
                <?php echo Form::link("Cancel", array("admin"), array("class" => 'link')); ?>   </td>
        </tr>
    </tbody>
</table>
<?php echo Form::endForm(); ?>
