<?php if ($title == "Homepage"): ?>

<?php else: ?>
	<div id="main-content">
		<h1><?= $title ?></h1>

		<? print render($content); ?>
	</div>
<?php endif; ?>

<?php print render($content['comments']); ?>
