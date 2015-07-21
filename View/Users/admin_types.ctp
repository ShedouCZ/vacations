
<div id="advanced" style="margin-left: 30px;">
    <?php foreach ($types as $type_id => $type_label) { ?>
        <div style="width: 23%; float: left; margin-top: 15px; margin-left: 10px" class="block__list block__list_words">
            <div class="block__list-title"><?php echo $type_label ?></div>
            <ul id="employee_type_<?php echo $type_id; ?>" class="employee_type_box" data-type-id="<?php echo $type_id; ?>">
                <?php $users = @$users_by_type[$type_id]  ?>
                <?php if ($users) foreach ($users as $user_id => $user) { ?>
                    <li data-item-id="<?php echo $user['id']; ?>"><?php echo $user['sn'] ?></li>
                <?php } ?>
                <li>&nbsp;</li>
        </div>
    <?php } ?>
</div>
