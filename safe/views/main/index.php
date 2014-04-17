
     <h1 style="color:white">Bienvenido Sistema de gestión de carga LG S.A.S.</h1>
     <div class="separador" style="height:80px"></div>
    <div class="menu-ppal">
       
        <div id="iconsOptions">

            <?php echo Form::link(" <h5>Guias</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/guia.png", 'Guia'), array('awbs/awbs/admin')); ?>

        </div>
        <div id="iconsOptions">

            <?php echo Form::link("<h5>Vuelos</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/vuelo.png", 'Cartera'), array('vuelos/vuelos/admin')); ?>

        </div>
        <div id="iconsOptions">

            <?php echo Form::link("<h5>Usuarios</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/uusers.png", 'Usuarios'), array('users/user/admin')); ?>

        </div>
        <div id="iconsOptions">

            <?php echo Form::link("<h5>Clave</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/password.png", 'Cartera'), array('users/user/dataAccess')); ?>

        </div>
        <div id="iconsOptions">

            <?php echo Form::link("<h5>Log Out</h5>" . Form::image(Base::request()->getBaseUrl() . "/images/logout.png", 'Log Out'), array('users/login/logout')); ?>

        </div>
    </div>
