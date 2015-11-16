<?= theme_image_style(array('style_name' => 'award_image', 'path' => $node->field_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?>

<div id="event-metadata">
	<h1><?= $title ?></h1>
	<h2>
		<?php
			print $node->field_medal['und'][0]['value'];
			if ($node->field_judges_choice['und'][0]['value'] == 1) {
				print " & Judges Choice";
			}
		?>
		<br />
		<?= $node->field_show_category['und'][0]['value'] ?>
	</h2>

	<div>
		<?= $node->body['und'][0]['value'] ?>
	</div>

	<a href="#" id="back-to-archive">Return to <?= $show_year->format('Y'); ?> Dallas Show Winners</a>
</div>
