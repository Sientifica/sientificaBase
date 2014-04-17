
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" content="en" />
        <meta name="robots" content="noindex,nofollow" />

        <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo Base::request()->getBaseUrl(); ?>/css/main.css" /> <!-- MAIN STYLE SHEET -->



        <script type="text/javascript" src="<?php echo Base::request()->getBaseUrl(); ?>/js/jquery-1.6.1.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo Base::request()->getBaseUrl(); ?>/css/comun.css" />


        <link rel="stylesheet" type="text/css" href="<?php echo Base::request()->getBaseUrl(); ?>/js/autocomplete/jquery.autocomplete.css" />
        <link href="<?php echo Base::request()->getBaseUrl(); ?>/js/datepicker/development-bundle/themes/base/jquery.ui.all.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo Base::request()->getBaseUrl(); ?>/js/datepicker/development-bundle/themes/base/jquery.ui.all.css" type="text/css" rel="stylesheet">

            <script src="<?php echo Base::request()->getBaseUrl(); ?>/js/datepicker/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>

            <script src="<?php echo Base::request()->getBaseUrl(); ?>/js/datepicker/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script>


            <title>LG S.A.S. - Gestión de Carga</title>
    </head>

    <body>

        <div id="main" style="min-width:500px">
            <div id="content" class="box">

                <div class="separador"></div>
                <div class="container">
                    <div id="menu" class="box">
                        <ul class="box f-right">
                            <?php if (Base::$user->getRegisterVars('profile') == Base::getConfigApp()->params['profiles']['SUPER']): ?>
                                <li><?php echo Form::link("<strong>Home</strong>", array('main/index'), array("class" => "link_menu")); ?></li>
                                <li><?php echo Form::link("<strong>Configuracion</strong>", array('users/config/index'), array("class" => "link_menu")); ?></li>
                            <?php endif; ?>   
                        </ul>

                    </div>
                     <div class="separador"></div>
                    <?php echo $content; ?>
                </div>
                <div class="separador"></div>

            </div>


        </div>


    </body>
</html>
