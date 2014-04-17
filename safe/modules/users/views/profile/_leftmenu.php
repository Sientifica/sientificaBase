
<ul class="box">
   
    <li><?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/iconos/usuario.png", 'Eliminar') . " Gestionar Usuarios", 'javascript:void(0)', array('onclick' => "loadModuleAction('users','user','admin')")); ?></li>
    <li  id="submenu-active"><?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/iconos/role.png", 'Eliminar') . "Perfiles de usuario ", 'javascript:void(0)', array('onclick' => "loadModuleAction('users','profile','admin')")); ?></li>
</ul>
