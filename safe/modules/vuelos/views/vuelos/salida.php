<script type='text/javascript' src='<?php echo Base::request()->getBaseUrl(); ?>/js/autocomplete/jquery.autocomplete.js'></script>
<div class="header">
    <h1>Registro de Salida</h1>
</div>
<?php echo $this->renderFile('application.views.main._menuReport'); ?>
<div class="separador"></div>
<script>
    $(document).ready(function() {
        $("input[rel=qtys]").focus(function() {
            $(this).select();
        });
    });
</script>
<div class="content clearfix">

    <?php echo Form::beginForm("", 'post', array('id' => 'createForm', 'enctype' => 'multipart/form-data')); ?>

<article class="module width_full">
        <header> <div class="submit_link">

                    <input type="submit" value="Save" class="alt_btn">
                    <?php echo Form::link("Cancel", array("admin"), array("class" => 'btn')); ?>   
                </div></header>
     <div class="module_content">
    <div id="errors"><?php echo Form::errorSummary(array($model, $movimientos)); ?></div>
     </div>
    <article class="module width_half">
        <header><h3>Registro de Salida de Carga</h3></header>

        <div class="module_content">
            
            <fieldset>

                <table width="100%" cellspacing="1" cellpadding="0" border="2">
                    <tbody>
                        <tr>
                            <td width="100%" height="60px" valign="top">

                                <div><?php echo Form::activeLabel($model, 'awbcode'); ?></div>
                                <div class="separador"></div>
                                <?php echo Form::textField('awbcode', $model->awbcode, array('class' => 'input-text', 'size' => 15, "readonly" => true)); ?>
                                <div class="separador" style="padding-top: 10px"></div>
                                <div><?php echo Form::activeLabel($movimientos, 'vuelo'); ?></div>
                                <div class="separador"></div>
                                <?php echo Form::activeTextField($movimientos, 'vuelo', array('class' => 'input-text', 'size' => 15)); ?>
                                <div class="separador" style="padding-top: 10px"></div>
                                <div><?php echo Form::activeLabel($movimientos, 'destino'); ?></div>
                                <div class="separador"></div>
                                <?php echo Form::activeTextField($movimientos, 'destino', array('class' => 'input-text', 'size' => 15)); ?>


                            </td>

                            <td width="100%"  valign="top" height="80px">
                                <div><?php echo Form::activeLabel($movimientos, 'armador'); ?></div>
                                <div class="separador"></div>
                                <?php echo Form::activeTextField($movimientos, 'armador', array('class' => 'input-text', 'size' => 20)); ?>
                                <div class="separador" style="padding-top: 10px"></div>
                                <div><?php echo Form::activeLabel($model, 'peso'); ?></div>
                                <div class="separador"></div>
                                <?php echo Form::textField('peso', $model->peso, array('class' => 'input-text', 'size' => 15, "readonly" => true)); ?>
                            </td>

                        </tr>
                        <tr>



                            <td width="100%"  valign="top" colspan="2" >
                                <fieldset>
                                    <table class="tablesorter" cellspacing="0"> 
                                        <thead> 
                                            <tr> 

                                                <th>Ubicacion</th>
                                                <th>Cantidad</th>
                                                <th>Qty Salida</th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($model->rel_pos as $pos): ?>
                                            <tr>                                                              
                                                <td style="text-align: center"><?php echo $pos->rel_pos->indice; ?></td>
                                                <td style="text-align: center"><?php echo $pos->qty_pos_bultos; ?></td>
                                                <td> <?php echo Form::textField('salida[padre]['.$pos->id.']',@$_POST['salida']['padre'][$pos->id], array('class' => 'input-text',"rel"=>"qtys", 'size' => 5)); ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </table>
                                </fieldset>
                            </td>

                        </tr>
                        <tr>
                            <td width="100%" colspan="2"   valign="top" height="60px">
                                <div> <?php echo Form::activeLabel($movimientos, 'observaciones'); ?></div>
                                <div class="separador"></div>
                                <?php echo Form::activeTextArea($movimientos, 'observaciones', array('class' => 'input-text', "style" => "width:95%")); ?></td>

                        </tr>
                    </tbody></table>

            </fieldset>


        </div>
        
    </article>
     <?php if ($model->rel_hijas): ?>
    <article class="module width_half">
        <header><h3>Registro de salida - Guías Hijas </h3></header>

        <div class="module_content">
            

           
                <fieldset>

                    <fieldset id="dinamics">                    
                        <table class="tablesorter" cellspacing="0"> 
                            <thead> 
                                <tr>                                        
                                    <th>Número de Guía (AWB Código)</th>
                                    <th></th>

                                </tr> 
                            </thead> 
                            <tbody> 
                                <?php foreach ($model->rel_hijas as $hija): ?>
                                    <tr> 

                                        <td><?php echo $hija->awbcode; ?></td>
                                        <td><table class="tablesorter" cellspacing="0" style="width: 50%"> 
                                                <thead> 
                                                    <tr> 

                                                        <th>Ubicacion</th>
                                                        <th>Cantidad</th>
                                                        <th>Qty Salida</th>
                                                    </tr>
                                                </thead>
                                                <?php foreach ($hija->rel_pos as $pos): ?>
                                                    <tr>                                                              
                                                        <td style="text-align: center"><?php echo $pos->rel_pos->indice; ?></td>
                                                        <td style="text-align: center"><?php echo $pos->qty_pos_bultos; ?></td>
                                                        <td> <?php echo Form::textField('salida[hijas]['.$hija->idawb.']['.$pos->id.']',@$_POST['salida']['hijas'][$hija->idawb][$pos->id], array('class' => 'input-text',"rel"=>"qtys", 'size' => 5)); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </table></td>

                                    </tr> 
                                <?php endforeach; ?>

                            </tbody> 
                        </table> 
                    </fieldset>

                </fieldset>
          

        </div>
         
       
    </article>
     <?php endif; ?>
  <div class="separador"></div>
         <footer>
                <div class="submit_link">

                    <input type="submit" value="Save" class="alt_btn">
                    <?php echo Form::link("Cancel", array("admin"), array("class" => 'btn')); ?>   
                </div>
            </footer>
    </article>
</div>

<?php echo Form::endForm(); ?>
</div>




