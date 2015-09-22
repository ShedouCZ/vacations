<div class="roles form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Role'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo __('Actions'); ?></div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
									<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;' . __('List Roles'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;' . __('Delete'), array('action' => 'delete', $this->Form->value('Role.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Role.id'))); ?></li>
							</ul>
						</div>
					</div>
				</div>
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<?php echo $this->Form->create('Role', array('role' => 'form')); ?>
				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => __('Id')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('alias', array('label'=>__('Name'), 'class' => 'form-control', 'placeholder' => __('Rolename')));?>
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
