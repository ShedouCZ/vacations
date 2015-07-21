
<div id="advanced" style="margin-left: 30px;">
    <?php foreach ($types as $type_id => $type_label) { ?>
        <div style="width: 23%; float: left; margin-top: 15px; margin-left: 10px" class="block__list block__list_words">
            <div class="block__list-title"><?php echo $type_label ?></div>
            <ul id="advanced-1">
                <?php $users = @$users_by_type[$type_id]  ?>
                <?php if ($users) foreach ($users as $user_id => $user) { ?>
                    <li><?php echo $user['sn'] ?></li>
                <?php } ?>
        </div>
    <?php } ?>
</div>
