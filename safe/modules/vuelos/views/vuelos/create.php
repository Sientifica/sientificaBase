<script type='text/javascript' src='<?php echo Base::request()->getBaseUrl(); ?>/js/autocomplete/jquery.autocomplete.js'></script>
<div class="header">
    <h1>Crea Vuelo</h1>
</div>
<?php echo $this->renderFile('application.views.main._menuReport'); ?>
<div class="separador"></div>
<script>

    $(document).ready(function() {
        $("#Vuelo_aerolinea").autocomplete("<?php echo Form::createUrl($this->module . "/" . $this->controller . "/getAerolineas"); ?>");

        $("#Vuelo_aerolinea").result(function(event, data, formatted) {
        });

        $("#Vuelo_fecha").datepicker({
            'dateFormat': 'yy-mm-dd',
            'changeMonth': true,
            'changeYear': true

        });
    })


</script>


<?php echo Form::beginForm("", 'post', array('id' => 'createForm', 'enctype' => 'multipart/form-data')); ?>

<div id="success"></div>

<table class="tablesearch">
    <tbody>
        <tr>
            <td colspan="2">
                <div id="errors">
                    <?php echo Form::errorSummary(array($model)); ?> 
                </div>
            </td>
        </tr>
        <tr>
            <td   valign="top" height="60px">
                <div>
                    <?php echo Form::activeLabel($model, 'vuelo'); ?>
                </div>
                <div class="separador"></div>
                <?php echo Form::activeTextField($model, "vuelo", array('class' => 'input-text', 'size' => 40)); ?>
            </td>
            <td   valign="top" height="60px">
                <div>
                    <?php echo Form::activeLabel($model, 'aerolinea'); ?>
                </div>
                <div class="separador"></div>
                <?php echo Form::activeTextField($model, "aerolinea", array('class' => 'input-text', 'size' => 40)); ?>
            </td>

        </tr>
        <tr>
            <td   valign="top" height="60px">
                <div>
                    <?php
                    echo Form::activeLabel($model, 'fecha');
                    ?>
                </div>

                <div class="separador"></div>

                <?php
                echo Form::activeTextField($model, "fecha", array('class' => 'input-text', 'size' => 40));
                ?>
            </td>
            <td valign="top" height="60px">
                &nbsp;
            </td>
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





