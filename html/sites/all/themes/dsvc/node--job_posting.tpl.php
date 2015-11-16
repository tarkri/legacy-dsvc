<div id="main-content" class="job">
	<h2><?= date('F j Y', $node->created) ?></h2>

	<h1><?= $title ?></h1>

	<ul id="job-meta">
		<li><?= $node->field_employer_name['und'][0]["value"] ?></li>
		<li><?= $node->field_employer_location['und'][0]["value"] ?></li>
		<li><a href="<?= $node->field_employer_website['und'][0]["value"] ?>">Website</a></li>
	</ul>

  <div id="job-description" class="hyphenate">
	  <?= $node->body['und'][0]["value"]; ?>
  </div>

  <div id="how-to-apply" class="hyphenate">
		<h2 id="contact-information">How To Apply:</h2>
		<?= $node->field_how_to_apply['und'][0]["value"]; ?>
	</div>

	<ul id="job-board-pagination" class="pager">
		<li class="pager-previous">
			<?php if (!empty($content['flippy_pager']['#list']['next'])) {
				print l(t('previous'), 'node/' . $content['flippy_pager']['#list']['next']['nid']);
			} ?></li>
		<li class="pager-key"><a href="/resources/job-board" id="back-to-job-board">Back to job board</a></li>
		<li class="pager-next">
			<?php if (!empty($content['flippy_pager']['#list']['prev'])) {
				print l(t('next'), 'node/' . $content['flippy_pager']['#list']['prev']['nid']);
			} ?>
		</li>
	</ul>
</div>
