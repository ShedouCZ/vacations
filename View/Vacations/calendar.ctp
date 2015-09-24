<?php
	$data = $this->requestAction('/api/get');
	$users = json_encode($data['users']);
	$vacations = json_encode($data['vacations']);
	//debug($vacations);
?>
<h1>Vacations</h1>

<script type="text/javascript">
	App.data = {};
	App.data.users = <?php echo $users; ?>;
	App.data.vacations = <?php echo $vacations; ?>;
</script>

<div id="Vacations">
	<svg id="context" class="sticky"></svg>
	<svg id="timegrid"></svg>
</div>