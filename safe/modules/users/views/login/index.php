



<?php echo Form::beginForm('', 'post', array('enctype' => 'multipart/form-data')); ?>



<fieldset class="cont_login">
    <legend>Administrador login</legend>
    <div id="errors"><?php echo Form::errorSummary($model); ?></div>
    <table border="0" width="200px" style="margin-left: auto;margin-right: auto">

        <tbody>

            <tr>

                <td>
                    <?php echo Form::activeLabel($model, 'nickname'); ?>
                    <?php echo Form::activeTextField($model, 'nickname', array('class' => 'input-text', 'style' => 'width:200px')); ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?php echo Form::activeLabel($model, 'password'); ?>
                    <?php echo Form::activePasswordField($model, 'password', array('class' => 'input-text', 'style' => 'width:200px')); ?>
                </td>
            </tr>

        </tbody>
    </table>



    <div class="submit_link">

        <?php echo Form::submitButton('Login', array("class" => "link")); ?> 


    </div>
</fieldset>



<?php echo Form::endForm(); ?>

