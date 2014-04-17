<?php
$data['awbs'] = array();
$data['vuelos'] = array();
$data['user'] = array();
$data['dataAccess'] = array();

if ($this->action == 'dataAccess')
    $data[$this->action] = array("class" => "btnactivo");
else
    $data[$this->controller] = array("class" => "btnactivo");
?>  
<div>
    
    <div id="iconsOptionsSmall">

        <?php echo Form::link(" <h5>Guias</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/guia.png", 'Guia'), array('awbs/awbs/admin'), $data['awbs']); ?>

    </div>
    <div id="iconsOptionsSmall">

        <?php echo Form::link("<h5>Vuelos</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/vuelo.png", 'Cartera'), array('vuelos/vuelos/admin'), $data['vuelos']); ?>

    </div>
    <div id="iconsOptionsSmall">

        <?php echo Form::link("<h5>Usuarios</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/uusers.png", 'Usuarios'), array('users/user/admin'), $data['user']); ?>

    </div>
    <div id="iconsOptionsSmall">

        <?php echo Form::link("<h5>Clave</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/password.png", 'Cartera'), array('users/user/dataAccess'), $data['dataAccess']); ?>

    </div>
    <div id="iconsOptionsSmall" style="float:right">

        <?php echo Form::link("<h5>Log Out</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/logout.png", 'Log Out'), array('users/login/logout')); ?>

    </div>
    <div id="iconsOptionsSmall" style="float:right">

        <?php echo Form::link(" <h5>Home</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/home.png", 'Guia'), array('main/index')); ?>

    </div>
</div>
