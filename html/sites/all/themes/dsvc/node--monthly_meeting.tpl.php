<?php
	if ($page == 0):
		if ($is_front && $nq_pos == 1): ?>
			<a href="<?= $node_url ?>"><?= theme_image_style(array('style_name' => 'meeting_image_large', 'path' => $node->field_meeting_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></a>
			<h1><?= $title ?></h1>

			<p class="hyphenate"><?= dsvc_token_truncate(strip_tags($node->body['und'][0]["value"], '<strong>'), 375); ?></p>
		<?php else: ?>
			<a href="<?= $node_url ?>"><?= theme_image_style(array('style_name' => 'meeting_image_small', 'path' => $node->field_meeting_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></a>
			<h3><?= $title ?></h3>

			<p class="hyphenate"><?= dsvc_token_truncate(strip_tags($node->body['und'][0]["value"], '<strong>'), 220); ?></p>
		<?php endif; ?>

			<ul class="post-metadata">
				<li><a href="<?= $node_url ?>">Keep Reading</a></li>
				<li class="last-child"><a href="<?= $node_url ?>#comments"><?php if ($node->comment_count > 0) { ?><?= $node->comment_count ?> Comment<?php if ($node->comment_count != 1) { echo "s"; } ?><?php } else { ?>Make a Comment<?php } ?></a></li>
			</ul><!-- /.post-metadata -->
<?php else: ?>
<div id="meeting" class="vevent hyphenate">
	<h1 class="summary"><?= $node->title ?></h1>
	<?php print render($content['body']); ?>
</div><!-- /#meeting -->

<ul id="event-metadata">
	<?php
		$output = field_view_value('node', $node, 'field_meeting_image', $node->field_meeting_image['und'][0], array(
			'type' => 'image',
			'settings' => array(
				'image_style' => 'meeting_image_small',
			),
		));
	?>

	<li><?php print render($output); ?></li>
	<li>Date &ndash; <abbr title="" class="dtstart"><?php echo $meeting->format('l, F j, Y'); ?></abbr></li>
	<li>Reception &ndash; <abbr title="" class="dtend"><?php echo $reception->format('g:i a'); ?></abbr> &nbsp;|&nbsp; Meeting &ndash; <span><?php print $meeting->format('g:i a'); ?></span></li>
	<li>Location &ndash; <span class="location"><?= $node->field_meeting_location['und'][0]["name"] ?> (<?= location_map_link($node->field_meeting_location['und'][0], ''); ?>)</span></li>
	<li>Members &ndash; <span class="money"><?= $node->field_member_cost['und'][0]['value'] ?></span> &nbsp;|&nbsp; Non-Members &ndash; <span class="money"><?= $node->field_nonmember_cost['und'][0]['value'] ?></span></li>
	<li>Students &ndash; <span class="money"><?= $node->field_student_cost['und'][0]['value'] ?> (ID Required)</span></li>
</ul><!-- /#event-metadata -->
<?php endif; ?>

<?php print render($content['comments']); ?>
