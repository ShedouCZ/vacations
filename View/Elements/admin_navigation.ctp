<?php
	$links = array(

	);
?>
<div class="actions">
	<div class="panel panel-default">
		<div class="panel-heading"><?php echo __('Menu'); ?></div>
			<div class="panel-body">
				<ul class="nav nav-pills nav-stacked">
					<?php
						foreach ($links as $title => $url) {
							$link = $this->Html->link(__($title), $url);
							$options = array();
							if (strpos($this->request->here, Router::url($url)) === 0) { // detect query string + params
								$options = array('class' => 'active');
							}
							echo $this->Html->tag('li', $link, $options);
						}
					?>
				</ul>
			</div><!-- end body -->
	</div><!-- end panel -->
</div><!-- end actions -->
