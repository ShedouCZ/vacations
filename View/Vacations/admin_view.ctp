<div class="vacations view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Vacation'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<?php echo $this->element('admin_navigation'); ?>
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;' . __('Edit Vacation'), array('action' => 'edit', $vacation['Vacation']['id']), array('escape' => false)); ?> </li>
								<li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;' . __('Delete Vacation'), array('action' => 'delete', $vacation['Vacation']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $vacation['Vacation']['id'])); ?> </li>
								<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;' . __('List Vacations'), array('action' => 'index'), array('escape' => false)); ?> </li>
								<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;' . __('New Vacation'), array('action' => 'add'), array('escape' => false)); ?> </li>
										<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;' . __('List Vacation Types'), array('controller' => 'vacation_types', 'action' => 'index'), array('escape' => false)); ?> </li>
										<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;' . __('New Vacation Types'), array('controller' => 'vacation_types', 'action' => 'add'), array('escape' => false)); ?> </li>
										<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;' . __('List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
										<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;' . __('New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
					<tr>
						<th><?php echo __('Id'); ?></th>
						<td>
							<?php echo h($vacation['Vacation']['id']); ?>
						</td>
					</tr>
					<tr>
						<th><?php echo __('Title'); ?></th>
						<td>
							<?php echo h($vacation['Vacation']['title']); ?>
						</td>
					</tr>
					<tr>
						<th><?php echo __('Start'); ?></th>
						<td>
							<?php echo h($vacation['Vacation']['start']); ?>
						</td>
					</tr>
					<tr>
						<th><?php echo __('End'); ?></th>
						<td>
							<?php echo h($vacation['Vacation']['end']); ?>
						</td>
					</tr>
					<tr>
								<th><?php echo __('Vacation Types'); ?></th>
								<td>
			<?php echo $this->Html->link($vacation['VacationTypes']['title'], array('controller' => 'vacation_types', 'action' => 'view', $vacation['VacationTypes']['id'])); ?>
			&nbsp;
		</td>
					</tr>
					<tr>
								<th><?php echo __('User'); ?></th>
								<td>
			<?php echo $this->Html->link($vacation['User']['id'], array('controller' => 'users', 'action' => 'view', $vacation['User']['id'])); ?>
			&nbsp;
		</td>
					</tr>
				</tbody>
			</table>
		</div><!-- end col md 9 -->

	</div>
</div>

