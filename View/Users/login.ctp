<style>
.users.login label {
  width: 80px;
  float: left;
}

</style>
<div class="col-md-12">
	<div class="col-md-8 pull-right" style="margin-top:120px; text-align: right;">
		<?php echo $this->Html->image('loginImg.png', array("style"=>"width:630px")); ?>
	</div>
	<div class="page-header">
		<h1><?php echo __('Sign in'); ?></h1>
	</div>

	<div class="users login form col-md-4">
		<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<p>
					<?php echo __('Fill in your credentials please'); ?>
				</p>
				<?php
					echo $this->Form->input('username', array('label'=>__('Username')));
					echo $this->Form->input('password', array('label'=>__('Password')));
					echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-lg btn-primary', 'style'=>'margin-top:15px; width: 100%'));
				?>
			</fieldset>
		<?php echo $this->Form->end() ?>
	</div>
</div>
