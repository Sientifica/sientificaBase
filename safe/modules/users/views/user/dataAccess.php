<div id="center">


    <script>
        function dataAccess() {

            var datas = $("#createForm").serialize();

            jQuery.ajax({
                type: "POST",
                url: "<?php echo Form::createUrl($this->controller . "/dataAccess"); ?>",
                data: datas,
                success: function(msg) {
                    $("#center").html(msg);

                }

            });
        }


    </script>
    <div class="header">
        <h1>Data Access</h1>
    </div>
    <?php echo $this->renderFile('application.views.main._menuReport'); ?>
    <div class="separador"></div>
    <div id="success"></div>





    <?php echo Form::beginForm("", 'post', array('id' => 'createForm', 'enctype' => 'multipart/form-data')); ?>

    <table class="tablesearch">
        <tbody>
            <tr>
                <td colspan="2"> <div id="errors"><?php echo Form::errorSummary($model); ?></div></td>
            </tr>
            <tr>


                <td>
                    <?php echo Form::activeLabel($model, 'nickname'); ?> <?php echo Form::activeTextField($model, 'nickname', array('class' => 'input-text')); ?>

                </td>

                <td>
                    <?php echo Form::activeLabel($model, 'passwordActual'); ?>
                    <?php echo Form::activePasswordField($model, 'passwordActual', array('class' => 'input-text')); ?>
                </td>

            </tr></table>

    <table class="tablesearch" style="margin-top: 20px">
        <tr>

            <td>
                <?php echo Form::activeLabel($model, 'password'); ?>
                <?php echo Form::activePasswordField($model, 'password', array('class' => 'input-text')); ?>

            </td>

            <td>
                <?php echo Form::activeLabel($model, 'repeatpass'); ?>
                <?php echo Form::activePasswordField($model, 'repeatpass', array('class' => 'input-text')); ?>

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
