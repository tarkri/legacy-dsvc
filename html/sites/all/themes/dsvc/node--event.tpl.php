<?php
	if ($page == 0):
		if ($is_front && $nq_pos == 1): ?>
			<a href="<?= $node_url ?>"><?= theme_image_style(array('style_name' => 'meeting_image_large', 'path' => $node->field_event_picture['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></a>
			<h1><?= $title ?></h1>

			<p class="hyphenate"><?= dsvc_token_truncate(strip_tags($node->body['und'][0]["value"], '<strong>'), 375); ?></p>
		<?php else: ?>
			<a href="<?= $node_url ?>"><?= theme_image_style(array('style_name' => 'meeting_image_small', 'path' => $node->field_event_picture['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></a>
			<h3><?= $title ?></h3>

			<p class="hyphenate"><?= dsvc_token_truncate(strip_tags($node->body['und'][0]["value"], '<strong>'), 220); ?></p>
		<?php endif; ?>


			<ul class="post-metadata">
				<li><a href="<?= $node_url ?>">Keep Reading</a></li>
				<li class="last-child"><a href="<?= $node_url ?>#comments"><?php if ($node->comment_count > 0) { ?><?= $node->comment_count ?> Comment<?php if ($node->comment_count != 1) { echo "s"; } ?><?php } else { ?>Make a Comment<?php } ?></a></li>
			</ul><!-- /.post-metadata -->
<?php else: ?>
	<div id="meeting" class="vevent hyphenate">
		<h1 class="summary"><?= $title ?></h1>

		<?php print $node->body['und'][0]['value'] ?>
	</div><!-- /#meeting -->
	<ul id="event-metadata">
		<li><?= theme_image_style(array('style_name' => 'meeting_image_small', 'path' => $node->field_event_picture['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></li>
  	<li>Date &ndash; <abbr title="" class="dtstart"><?php print $event_date->format('l, F j, Y'); ?></abbr></li>
  	<li>Time &ndash; <span><?php print $event_date->format('g:i a'); ?></span></li>
		<li>Location &ndash; <span class="location"><?= $node->field_event_location['und'][0]["name"] ?> (<?= location_map_link($node->field_event_location['und'][0], ''); ?>)</span></li>
		<?php if (!empty($node->field_event_member_cost['und'][0]['value'])) : ?>
		<li>Members &ndash; <span class="money"><?= $node->field_event_member_cost['und'][0]['value'] ?></span> &nbsp;|&nbsp; Non-Members &ndash; <span class="money"><?= $node->field_event_nonmember_cost['und'][0]['value'] ?></span></li>
		<?php endif; ?>
		<?php if (!empty($node->field_event_student_cost['und'][0]['value'])) : ?>
		<li>Students &ndash; <span class="money"><?= $node->field_event_student_cost['und'][0]['value'] ?> (ID Required)</span></li>
		<?php endif; ?>
	</ul><!-- /#event-metadata -->
<?php endif; ?>

<?php print render($content['comments']); ?>
