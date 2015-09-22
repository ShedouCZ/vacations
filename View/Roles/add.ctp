<div class="roles form">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Role'); ?></h1>
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
								<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;' . __('List Roles'), array('action' => 'index'), array('escape' => false)); ?></li>
							</ul>
						</div>
					</div>
				</div>
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<?php echo $this->Form->create('Role', array('role' => 'form')); ?>
				<div class="form-group">
					<?php echo $this->Form->input('alias', array('class' => 'form-control', 'placeholder' => __('Rolename')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('homepage', array('class' => 'form-control', 'placeholder' => __('Homepage')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>
			<?php echo $this->Form->end() ?>
		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
