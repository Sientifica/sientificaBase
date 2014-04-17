
<ul>
    <?php foreach ($controllers as $ctrl): ?>
        <?php if ($ctrl->active == 1): ?>
            <div  style="float: left;margin-left: 30px;  width: 200px;min-height: 200px"><strong><label><?php echo Form::checkbox('all_' . $ctrl->id_controller, false, array('onclick' => "allActions('$ctrl->id_controller')")); ?> <?php echo (!empty($ctrl->controller_name)) ? $ctrl->controller_name : $ctrl->id_controller; ?></label></strong>:
                <ul>
                    <?php
                     $join = "INNER JOIN actions_profiles AS ap ON(ap.action_id=actions.action_id) ";
                     $actions = Action::find("all", array('joins' => $join, 'conditions' => 'ap.profile_id =' .Base::getConfigApp()->params['profiles']['ADMIN']. " AND id_controller='" . $ctrl->id_controller . "'"));
                     foreach ($actions as $action):?>
                        <?php if ($action->active == 1): ?>
                            <li><label><?php echo Form::checkbox('permisos[]', in_array($action->action_id, $arrIdsAction), array('value' => $action->action_id, 'ref' => $ctrl->id_controller)); ?> <?php echo (!empty($action->action_name)) ? $action->action_name : $action->action; ?></label></li>
                        <?php endif; ?>
                    <?php endforeach; ?> 
                    </tr>

                </ul>
            </div>
        <?php endif; ?>
    <?php endforeach; ?> 
</ul>