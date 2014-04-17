<div class="ver_pags">  Pagina: <?php echo $paginator->getPage(); ?> de: <?php echo $paginator->getPages(); ?>  Total: <?php echo $paginator->getNumRows(); ?> &ensp; &ensp;<strong>Ver:</strong> <?php echo $paginator->getViewSizes();?></div>
<table border="0"  width="100%" class="list_clientes"  cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Perfil</th>           
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($paginator->getData() as $n => $object): ?>
            <tr <?php echo ($n % 2 == 0) ? 'class="bg"' : ""; ?>>
                <td><?php echo $object->profile; ?></td>
               
                <td class="tdderecha"><table width="100%" class="acciones_list">

                        <tbody>
                            <tr>
                                <td><?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/iconos/edit.gif", 'Editar',array("border"=>0)), 'javascript:void(0)', array('onclick' => 'load(' . $object->getPkValue() . ')')); ?></td>
                               
                                <td><?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/iconos/eliminar.png", 'Eliminar',array("border"=>0)), 'javascript:void(0);',array('onclick' => 'Delete(' . $object->getPkValue() . ')')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>

            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
 <div id="paginacion"><?php echo  $paginator->getPagination();?></div>