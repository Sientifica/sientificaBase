<?php $this->renderFile('application.views.js.js_common'); ?>

<div id="success"></div>
<h1>Perfiles de usuario</h1>
<div id="listado">
    <div id="buscador">

        <table border="0" width="100%" cellspacing="0" cellpadding="5">

            <tbody>

                <tr>
                    <td>Palabra clave</td>
                    <td><input type=text name="txtnombre" id="txtpalabra" onkeyup="search();" size=30  value=''></td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="botonesListado">
        <a href="javascript:void(0);" class="btn21Gris" onclick="Reset()"><span><span><span class="item_menu"><img width="13" height="14" alt="Buscar" src="<?php echo Base::request()->getBaseUrl(); ?>/images/iconos/agregar.png">Agregar</span></span></span></a>
    </div>
     <div class="separador"></div>
    <div id="grid">
         <script> loadGrid();  </script>
    </div>

    

</div>
