<?php
	$data = $this->requestAction('/api/get');
	$users = json_encode($data['users']);
	$vacations = json_encode($data['vacations']);
	debug($vacations);
?>

<script type="text/javascript">
	App.data = {};
	App.data.users = <?php echo $users; ?>;
	App.data.vacations = <?php echo $vacations; ?>;
</script>

<div id="Vacations">
	<svg id="timegrid"></svg>
</div>