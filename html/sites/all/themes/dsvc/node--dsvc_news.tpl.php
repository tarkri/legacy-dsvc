<?php
	if ($page == 0) :
		if ($is_front && $nq_pos == 1) : ?>
			<a href="<?= $node_url ?>"><?= theme_image_style(array('style_name' => 'meeting_image_large', 'path' => $node->field_news_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></a>
			<h1><?= $title ?></h1>

			<p class="hyphenate"><?= dsvc_token_truncate(strip_tags($node->body['und'][0]["value"], '<strong>'), 375); ?></p>
		<?php else:	?>
			<a href="<?= $node_url ?>"><?= theme_image_style(array('style_name' => 'meeting_image_small', 'path' => $node->field_news_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></a>
			<h3><?= $title ?></h3>

			<p class="hyphenate"><?= dsvc_token_truncate(strip_tags($node->body['und'][0]["value"], '<strong>'), 220); ?></p>
		<?php endif; ?>


		<ul class="post-metadata">
			<li><a href="<?= $node_url ?>">Keep Reading</a></li>
			<li class="last-child"><a href="<?= $node_url ?>#comments"><?php if ($node->comment_count > 0) { ?><?= $node->comment_count ?> Comment<?php if ($node->comment_count != 1) { echo "s"; } ?><?php } else { ?>Make a Comment<?php } ?></a></li>
		</ul><!-- /.post-metadata -->
	<?php elseif ($page == 1) : ?>
		<div id="meeting" class="hyphenate">
			<h1 class="summary"><?= $title ?></h1>
			<?php print $node->body['und'][0]['value'] ?>

			<?php if (isset($node->field_document['und'][0]["filename"])): ?>
				<?php foreach ($node->field_document['und'] as $id => $document): ?>
					<p>
						<a href="/<?= $document['filepath'] ?>">
							<?php
								if ($document["data"]["description"] != "") :
									print $document["data"]["description"];
								else :
									print $document["filename"];
								endif;
							?>
							(<?php
								if ($document['filemime'] == "application/pdf") {print "PDF,";} ?> <?php print round($document["filesize"]/1024); ?>KB)
						</a>
					</p>
				<?php endforeach; ?>
			<?php endif; ?>
		</div><!-- /#meeting -->

		<ul id="event-metadata">
			<li><?= theme_image_style(array('style_name' => 'meeting_image_small', 'path' => $node->field_news_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?></li>
		</ul><!-- /#event-metadata -->
<?php endif; ?>

<?php print render($content['comments']); ?>
