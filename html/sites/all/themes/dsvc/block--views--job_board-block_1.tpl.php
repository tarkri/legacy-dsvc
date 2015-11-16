<section id="new-jobs">
	<?php if (!empty($block->subject)): ?>
	  <h2><?php print $block->subject ?></h2>
	<?php endif;?>

	<?php print $content ?>

	<ul id="jobs-navigation" class="utility-navigation">
		<li><a href="/resources/job-board">See All Jobs</a></li>
	</ul><!-- /.utility-navigation -->
</section>
