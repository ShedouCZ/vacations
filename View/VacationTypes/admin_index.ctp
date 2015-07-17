<div class="vacationTypes index">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<ul class="nav nav-pills pull-right">
					<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;' . __('New Vacation Type'), array('action' => 'add'), array('escape' => false)); ?></li>
					<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-sort"></span>&nbsp;&nbsp;' . __('Reorder'), array('action' => 'reorder'), array('escape' => false)); ?></li>
				</ul>
				<h1><?php echo __('Vacation Types'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<?php echo $this->element('admin_navigation'); ?>
					</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th style="width:40px"><?php echo $this->Paginator->sort('color', ' '); ?></th>
						<th><?php echo $this->Paginator->sort('title'); ?></th>
						<th style="width:50px" class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($vacationTypes as $vacationType) { ?>
					<tr>
						<td><div style="width:25px;height:24px; background-color:<?php echo h($vacationType['VacationType']['color']); ?>"></div></td>
						<td><?php echo h($vacationType['VacationType']['title']); ?></td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $vacationType['VacationType']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $vacationType['VacationType']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $vacationType['VacationType']['id'])); ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>

			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div>
