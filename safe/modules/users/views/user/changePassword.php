
<div class="header">
    <h1>Cambiar Clave</h1>
</div>
<?php echo $this->renderFile('application.views.main._menuReport'); ?>
<div class="separador"></div>
<div id="success"></div>   
<?php echo Form::beginForm("", 'post', array('id' => 'createForm', 'enctype' => 'multipart/form-data')); ?>


<table class="tablesearch">
    <tbody>
        <tr>
            <td colspan="4"> <div id="errors"><?php echo Form::errorSummary($model); ?></div></td>
        </tr>
    <td width="12.5%" valign="top" scope="row">
        <?php echo Form::hiddenField('id', $_REQUEST['id']); ?>
        <?php echo Form::activeLabel($model, 'password'); ?>
    </td>
    <td width="37.5%" valign="top">
        <?php echo Form::activePasswordField($model, 'password', array("size" => "30", 'class' => 'input-text')); ?>

    </td>


    <td width="12.5%" valign="top" scope="row">
        <?php echo Form::activeLabel($model, 'repeatpass'); ?>
    </td>
    <td width="37.5%" valign="top">
        <?php echo Form::activePasswordField($model, 'repeatpass', array("size" => "30", 'class' => 'input-text')); ?>

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
