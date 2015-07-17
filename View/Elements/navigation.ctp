	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php
					if (preg_match('~/bookings~', $this->request->here)) {
						$active = 'active';
					}
				?>
				<a class="navbar-brand <?php echo @$active?>" href="<?php echo Router::url('/'); ?>"><i class="fa fa-home"></i> <?php echo __("Vacations"); ?></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<?php echo $this->Element('navigation_links'); ?>
				</ul>
				<?php if (AuthComponent::user('id')) { ?>
					<ul class="nav navbar-nav navbar-right">
						<li> <a href="<?php echo Router::url('/docs/user.pdf');?>"><?php echo __("nápověda"); ?></a> </li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Session->read('Auth.User.username'); ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php echo $this->Element('roles_links'); ?>
								<li class="divider"></li>
								<li> <a href="<?php echo Router::url('/logout');?>"><?php echo __("Logout"); ?></a> </li>
							</ul>
						</li>
						<?php if ($this->Auth->is_allowed('/config', AuthComponent::user())) { ?>
							<li><a class="navbar-brand" href="<?php echo Router::url('/config');?>"><i class="fa fa-cog"></i></a></li>
						<?php } ?>
					</ul>
				<?php } else if (Router::getParam('action') != 'login') {
					$inputDefaults = array('div'=>false, 'class'=>'form-control', 'label'=>false);
					echo $this->Form->create('User', array('url'=>Router::url('/login'), 'class'=>'navbar-form navbar-right', 'inputDefaults'=>$inputDefaults));
					echo '<div class="input-group">';
						echo '<span class="input-group-btn">';
							echo $this->Form->input('username', array('placeholder'=>__('Username')));
							echo $this->Form->input('password', array('placeholder'=>__('Password')));
							echo $this->Form->button('Login', array('class'=>'btn btn-default'));
						echo '</span>';
					echo '</div>';
					echo $this->Form->end();
				} ?>
			</div><!--/.nav-collapse -->
		</div>
	</div>
