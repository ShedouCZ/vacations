<?php
	$data = $this->requestAction('/api/get');
	$users = json_encode($data['users']);
	$vacations = json_encode($data['vacations']);
	$employee_types = json_encode($data['employee_types']);
	$vacation_types = json_encode($data['vacation_types']);
	//debug($vacations);
?>
<h1>Vacations</h1>

<script type="text/javascript">
	App.data = {};
	App.data.users = <?php echo $users; ?>;
	App.data.vacations = <?php echo $vacations; ?>;
	App.data.employee_types = <?php echo $employee_types; ?>;
	App.data.vacation_types = <?php echo $vacation_types; ?>;
</script>

<style media="screen">
	<?php
		require APP . 'Vendor/autoload.php';
		use Mexitek\PHPColors\Color;

		foreach ($data['vacation_types'] as $type) {
			$color = new Color($type['color']);
			$stroke = $color->lighten(3);
			$fill   = $color->lighten(18);
			echo ".bar.type-$type[id] rect { stroke: #$stroke; fill: #$fill }\n";
		}
	?>
</style>

<div id="Vacations">
	<svg id="context" class="sticky"></svg>
	<svg id="timegrid"></svg>
</div>
