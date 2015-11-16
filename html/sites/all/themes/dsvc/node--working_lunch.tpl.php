<?php
	if ($page == 0) :
		if ($is_front && $nq_pos == 1) : ?>
			<a href="<?= $node_url ?>"><?= theme_image_style(array('style_name' => 'meeting_image_large', 'path' => $node->field_meeting_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></a>
			<h1><?= $node->title ?></h1>

			<p class="hyphenate"><?= dsvc_token_truncate(strip_tags($node->body['und'][0]["value"], '<strong>'), 375); ?></p>
		<?php else : ?>
			<a href="<?= $node_url ?>"><?= theme_image_style(array('style_name' => 'meeting_image_small', 'path' => $node->field_meeting_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></a>
			<h3><?= $title ?></h3>

			<p class="hyphenate"><?= dsvc_token_truncate(strip_tags($node->body['und'][0]["value"], '<strong>'), 220); ?></p>
		<?php endif; ?>

		<ul class="post-metadata">
			<li><a href="<?= $node_url ?>">Keep Reading</a></li>
			<li class="last-child"><a href="<?= $node_url ?>#comments"><?php if ($node->comment_count > 0) { ?><?= $node->comment_count ?> Comment<?php if ($node->comment_count != 1) { echo "s"; } ?><?php } else { ?>Make a Comment<?php } ?></a></li>
		</ul><!-- /.post-metadata -->
<?php elseif ($page == 1) : ?>
	<div id="meeting" class="vevent hyphenate">
		<h1 class="summary"><?= $title ?></h1>
		<?php print $node->body['und'][0]['value'] ?>
	</div><!-- /#meeting -->

	<ul id="event-metadata">
		<li><?= theme_image_style(array('style_name' => 'meeting_image_small', 'path' => $node->field_meeting_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></li>
		<li>Date &ndash; <abbr class="dtstart" title="<?= $date_from ?>"><?= $date_from->format('l, F j, Y') ?></abbr></li>
		<li>Time &ndash; <abbr class="dtend" title="<?= $date_to ?>"><?= $date_from->format('g:i a') ?> &ndash; <?= $date_to->format('g:i a') ?></li>
		<li>Location &ndash; <span><?= $node->field_wl_location['und'][0]["name"] ?> (<?= location_map_link($node->field_wl_location['und'][0], ''); ?>)</span></li>
		<li>Members &ndash; <span><?= $node->field_member_cost['und'][0]["value"] ?></span> &nbsp;|&nbsp; Non-Members &ndash; <span><?= $node->field_nonmember_cost['und'][0]["value"] ?></span></li>
	</ul><!-- /#event-metadata -->
<?php endif; ?>

<?php print render($content['comments']); ?>
