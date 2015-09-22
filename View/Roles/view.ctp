<div class="roles view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Role'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
									<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;' . __('Edit Role'), array('action' => 'edit', $role['Role']['id']), array('escape' => false)); ?> </li>
									<li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;' . __('Delete Role'), array('action' => 'delete', $role['Role']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $role['Role']['id'])); ?> </li>
									<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;' . __('List Roles'), array('action' => 'index'), array('escape' => false)); ?> </li>
									<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;' . __('New Role'), array('action' => 'add'), array('escape' => false)); ?> </li>
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
						<?php echo h($role['Role']['id']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Rolename'); ?></th>
					<td>
						<?php echo h($role['Role']['alias']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Homepage'); ?></th>
					<td>
						<?php echo h($role['Role']['homepage']); ?>
						&nbsp;
					</td>
				</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->
	</div>
</div>
