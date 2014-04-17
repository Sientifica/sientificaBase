<div id="menu" class="box">

    <ul class="box f-right">
        <?php if (Base::$user->getRegisterVars('profile') == Base::getConfigApp()->params['profiles']['SUPER']): ?>
            <li><?php echo Form::link("<span><strong>Configuracion</strong></span>", array('users/config/index')); ?></li>
        <?php endif; ?>    
        <li  class="data"><?php echo Form::link("<span>" . Form::image(Base::request()->getBaseUrl() . "/images/iconos/key.png", 'Usuarios', array('height' => '14px')) . " Cambiar datos de acceso</span>", array('users/user/dataAccess')); ?></li>

    </ul>

    <ul class="box" id="ppal">
        <!--<li class="index"><?php echo Form::link("<span>" . Form::image(Base::request()->getBaseUrl() . "/images/iconos/home.gif", 'Usuarios', array('height' => '14px')) . " Dashboard</span>", array('main/index')); ?></li> <!-- Active -->
        <li class="index"><?php echo Form::link("<span>Manejo de Guías</span>", array('awbs/awbs/admin')); ?></li> <!-- Active -->
        <li class="index"><?php echo Form::link("<span>Vuelos</span>", array('vuelos/vuelos/admin')); ?></li> <!-- Active -->

        <li class="user"><?php echo Form::link("<span>" . Form::image(Base::request()->getBaseUrl() . "/images/iconos/usuario.png", 'Usuarios', array('height' => '14px')) . " Usuarios</span>", array('users/user/admin')); ?></li> <!-- Active -->
    </ul>

</div>
