<div class="employeeTypes index">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<ul class="nav nav-pills pull-right">
					<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-random"></span>&nbsp;&nbsp;' . __('Assign Types'), array('action' => 'types'), array('escape' => false)); ?></li>
					<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;' . __('List Employee Types'), array('action'=>'index'), array('escape'=>false)); ?></li>
					<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;' . __('New Employee Type'), array('action' => 'add'), array('escape' => false)); ?></li>
					<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-sort"></span>&nbsp;&nbsp;' . __('Reorder'), array('action' => 'reorder'), array('escape' => false)); ?></li>
				</ul>
				<h1><?php echo __('Employee by Type'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div id="advanced" style="margin-left: 30px;">
				<?php foreach ($types as $type_id => $type_label) { ?>
					<?php
						$days_info = isset($type_info[$type_id]) ? " ($type_info[$type_id] days)" : '';
					?>
					<div style="width: 23%; float: left; margin-top: 15px; margin-left: 10px" class="block__list block__list_words">
						<div class="block__list-title"><?php echo $type_label . $days_info ?></div>
						<ul id="employee_type_<?php echo $type_id; ?>" class="employee_type_box" data-type-id="<?php echo $type_id; ?>">
							<?php $users = @$users_by_type[$type_id]  ?>
							<?php if ($users) foreach ($users as $user_id => $user) { ?>
								<li data-item-id="<?php echo $user['id']; ?>"><?php echo $user['sn'] ?></li>
							<?php } ?>
							<li>&nbsp;</li>
					</div>
				<?php } ?>
			</div>
		</div> <!-- end col md 12 -->
	</div><!-- end row -->


</div>
