<?php
date_default_timezone_set ("America/Bogota");
$path =dirname(__FILE__).'/../../sientificaPhp/sientifica.php';
$config=dirname(__FILE__).'/safe/config/configuration.php';
require_once($path);
Sientifica::initWebApp($config)->run();
?>
