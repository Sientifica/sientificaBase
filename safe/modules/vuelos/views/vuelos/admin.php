
<script type='text/javascript' src='<?php echo Base::request()->getBaseUrl(); ?>/js/autocomplete/jquery.autocomplete.js'></script>
<div class="header">
    <h1>Vuelos</h1>
</div>
<?php echo $this->renderFile('application.views.main._menuReport'); ?>
<div class="separador"></div>
<script>

    function searchVuelo() {

        $("#createForm").submit();
    }

    $(document).ready(function() {
        $("#aerolinea").autocomplete("<?php echo Form::createUrl($this->module . "/" . $this->controller . "/getAerolineas"); ?>");

        $("#aerolinea").result(function(event, data, formatted) {
            $("#ubicacionID").val(data[1]);
        });

        $("#inicio,#fin").datepicker({
            'dateFormat': 'yy-mm-dd',
            'changeMonth': true,
            'changeYear': true

        });
    })


</script>

<div id="success"></div>
<?php echo Form::beginForm("", 'post', array('id' => 'createForm', 'enctype' => 'multipart/form-data')); ?>

<table class="tablesearch">
    <thead>
        <tr>
            <th>Vuelo</th>
            <th>Fecha</th>
            <th>Aerolínea</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo Form::textField("vuelo", @$_REQUEST["vuelo"], array('class' => 'input-text', 'size' => 10)); ?></td>
            <td><?php echo Form::textField("inicio", @$_REQUEST["inicio"], array('class' => 'input-text', 'size' => 10)); ?> - <?php echo Form::textField("fin", @$_REQUEST["fin"], array('class' => 'input-text', 'size' => 10)); ?></td>
            <td><?php echo Form::textField("aerolinea", @$_REQUEST["aerolinea"], array('class' => 'input-text', 'size' => 30)); ?></td>
            <td></td>
        </tr>

        <tr>
            <td colspan="4" style="text-align: right; height: 30px">                                  
                <?php echo Form::link("Buscar", "javascript:void(0)", array('class' => 'link', 'onclick' => 'searchVuelo()')); ?>
                <?php echo Form::link("reset", array("admin"),array("class"=>'link')); ?>
            </td>
        </tr>
    </tbody>
</table>
<?php echo Form::endForm(); ?>



<div class="separador" style="margin-top: 20px"></div>
<table class="tablesorter" cellspacing="0"> 
    <thead> 
        <tr>

            <td style=" text-align:right">Page: <?php echo $paginator->getPage(); ?> de: <?php echo $paginator->getPages(); ?>  Total: <?php echo $paginator->getNumRows(); ?> &ensp; &ensp;<strong>Ver:</strong> <?php echo $paginator->getViewSizes(); ?> <?php echo Form::link("Agregar Vuelo", array("create"), array('class' => 'btn')); ?></td>
        </tr>
    </thead>
</table>
<table class="tablesorter" cellspacing="0"> 
    <thead> 
        <tr> 
            <!--<th></th> -->
            <th>Vuelo</th>
            <th>Fecha</th>
            <th>Aerolinea</th>
            <th>Guías</th>
            <th>Acciones</th>
        </tr> 
    </thead> 
    <tbody> 
        <?php foreach ($paginator->getData() as $n => $object): ?>
            <tr> 
               <!-- <td><input type="checkbox"></td> -->
                <td>
                    <?php
                    echo $object->vuelo;
                    ?>
                </td>
                <td>
                    <?php
                    echo @$object->fecha->format("Y-m-d");
                    ?>
                </td>
                <td>
                    <?php
                    echo @$object->aerolinea;
                    ?>
                </td>
                <td>
                    <?php
                    echo @count($object->rel_preawbs);
                    ?>
                </td>
                <td> 
                    <?php echo Form::link("Ver Detalle", array("detalle", "id" => $object->getPkValue()), array("class"=>"link")); ?>
                    
                </td>
            </tr> 
        <?php endforeach; ?>
          <tr>
            <td colspan="5" style="height:30px"><?php echo $paginator->getPagination(); ?> </td>
        </tr>
    </tbody> 
</table>
<table class="tablesorter"> 
    <tbody> 
        <tr>

            <td style=" text-align:right">
                <?php echo Form::link("Agregar Vuelo", array("create"), array('class' => 'btn')); ?></td>
        </tr>
    </tbody>
</table>










