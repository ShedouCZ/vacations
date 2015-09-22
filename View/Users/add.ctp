<div class="users form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
									<ul class="nav nav-pills pull-right">
							<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;' . __('List Users'), array('action'=>'index'), array('escape'=>false)); ?></li>
					</ul>
								<h1><?php echo __('Admin Add User'); ?></h1>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-3">
			<?php echo $this->element('admin_navigation'); ?>
					</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('User', array('role'=>'form', 'class'=>'form-horizontal')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('username', array('class'=>'form-control', 'placeholder'=>__('Username')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password', array('class'=>'form-control', 'placeholder'=>__('Password')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mail', array('class'=>'form-control', 'placeholder'=>__('Mail')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('Role', array('multiple'=>'checkbox', 'placeholder' => __('Modified')));?>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>
					</div>

				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
