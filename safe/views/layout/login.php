
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta name="robots" content="noindex,nofollow" />
        <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo Base::request()->getBaseUrl(); ?>/css/login.css" /> <!-- MAIN STYLE SHEET -->
        <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo Base::request()->getBaseUrl(); ?>/css/main.css" /> <!-- MAIN STYLE SHEET -->

        <!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo Base::request()->getBaseUrl(); ?>/css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->

        <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo Base::request()->getBaseUrl(); ?>/css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
        <script type="text/javascript" src="<?php echo Base::request()->getBaseUrl(); ?>/js/jquery.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo Base::request()->getBaseUrl(); ?>/css/comun.css" />


        <title>Base Framework</title>

    </head>

    <body>
        <div class="container">
            <?php echo $content; ?>
        </div>
    </body>
</html>
