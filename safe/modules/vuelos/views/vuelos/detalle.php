
<script type='text/javascript' src='<?php echo Base::request()->getBaseUrl(); ?>/js/autocomplete/jquery.autocomplete.js'></script>
<div class="header">
    <h1>Detalle de Vuelo</h1>
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

<?php echo Form::beginForm("", 'post', array('id' => 'updateForm', 'enctype' => 'multipart/form-data')); ?>

 
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
                <?php echo Form::textField("vuelo", $model->vuelo, array('class' => 'input-text', 'size' => 40, "readonly" => true)); ?>
            </td>
            <td   valign="top" height="60px">
                <div>
                    <?php echo Form::activeLabel($model, 'aerolinea'); ?>
                </div>
                <div class="separador"></div>
                <?php echo Form::textField("aerolinea", $model->aerolinea, array('class' => 'input-text', 'size' => 40, "readonly" => true)); ?>
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
                echo Form::textField("fecha", $model->fecha->format("d/m/Y"), array('class' => 'input-text', 'size' => 40, "readonly" => true));
                ?>
            </td>
            <td valign="top" height="60px">
                <div>
                    <?php
                    echo Form::label("Archivo de Carga", "archivo_carga", array());
                    ?>
                </div>

                <div class="separador"></div>

                <?php echo Form::activeFileField($model, "archivo_carga", "", array()); ?>
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


<div class="separador"></div>


<?php echo Form::hiddenField("id", $model->idvuelo); ?> 
<?php echo Form::endForm(); ?>

<?php echo Form::beginForm("", 'post', array('id' => 'updateForm', 'enctype' => 'multipart/form-data')); ?>

<table class="tablesorter" > 
    <thead> 
        <tr> 
            <!--<th></th> -->
            <th>MAWB</th>
            <th>HAWB</th>
            <th>PESO</th>
            <th>QTY</th>
            <th>CONFIRMADO</th>

        </tr> 
    </thead> 
    <tbody>
        <?php foreach ($model->rel_preawbs as $preawb): ?>
            <tr>
                <td><?php echo $preawb->awbcode; ?></td>
                <td><?php echo $preawb->awbpadre; ?></td>
                <td><?php echo $preawb->peso; ?></td>
                <td><?php echo $preawb->qty_total_bultos; ?></td>
                <td><?php echo $preawb->confirmado; ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php echo Form::endForm(); ?>
