<?php
	$links = array(
		'NO STRESS!' => '/no-stress',
		'Řekli o výstavě' => '/o-vystave',
		'Galerie' => '/galerie',
		'Kontakt' => '/kontakt',
	);
?>
<div class="navbar-wrapper">
<div class="container">
 <nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">
				J<sup>3</sup>T
			</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<?php
					foreach ($links as $title => $url) {
						$link = $this->Html->link($title, $url);
						$options = array();
						if (strpos($this->request->here, Router::url($url)) === 0) { // detect query string + params
							$options = array('class' => 'active');
						}
						echo $this->Html->tag('li', $link, $options);
					}
				?>
			</ul>
		</div>
	</div>
</nav>
</div>
</div>
