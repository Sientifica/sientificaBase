
<div class="header">
    <h1>Usuarios</h1>
</div>

<?php echo $this->renderFile('application.views.main._menuReport'); ?>
<div class="separador"></div>
<div id="success"></div>

<table class="tablesorter" cellspacing="0"> 
    <thead> 
        <tr>

            <td style=" text-align:right">Page: <?php echo $paginator->getPage(); ?> de: <?php echo $paginator->getPages(); ?>  Total: <?php echo $paginator->getNumRows(); ?> &ensp; &ensp;<strong>Ver:</strong> <?php echo $paginator->getViewSizes(); ?> <?php echo Form::link("Add new User", array("create"), array('class' => 'btn')); ?></td>
        </tr>
    </thead>
</table>
<table class="tablesorter"> 
    <thead> 
        <tr> 
            <!--<th></th> -->
            <th>Full Name</th>
            <th>User</th>
            <th>Profile</th>
            <th>Actions</th>
        </tr> 
    </thead> 
    <tbody> 
        <?php foreach ($paginator->getData() as $n => $object): ?>
            <tr> 
               <!-- <td><input type="checkbox"></td> -->
                <td><?php echo $object->name; ?></td>
                <td><?php echo $object->nickname; ?></td>
                <td><?php echo $object->profiles->profile; ?></td>
                <td>
                    <?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/icn_edit.png", array("title" => "Edit")), array("users/user/update", "id" => sha1($object->getPkValue()))); ?>
                    <?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/icn_security.png", array("title" => "Change Password")), array("users/user/changePassword", "id" => sha1($object->getPkValue()))); ?>
                    <?php echo Form::link(Form::image(Base::request()->getBaseUrl() . "/images/icn_trash.png", array("title" => "Delete")), array("users/user/delete", "id" => sha1($object->getPkValue()))); ?>
                </td> 
            </tr> 
        <?php endforeach; ?>
        <tr>
            <td colspan="8" style="height:30px"><?php echo $paginator->getPagination(); ?> </td>
        </tr>

    </tbody> 
</table>
<table class="tablesorter"> 
    <tbody> 
        <tr>

            <td style=" text-align:right">
                <?php echo Form::link("Add new user", array("create"), array('class' => 'btn')); ?></td>
        </tr>
    </tbody>
</table>



