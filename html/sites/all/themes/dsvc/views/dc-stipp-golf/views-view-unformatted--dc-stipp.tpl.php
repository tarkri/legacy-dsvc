<div id="dc-stipp" class="article-display <?php print $classes[$id]; ?>">
<?php
	$count = 1;
	foreach ($rows as $id => $row):
?>
	<article<?php if (($count % 3) == 0) { echo " class=\"third-child\""; }?>>
		<?php print $row; ?>
	</article>
<?php
	$count ++;
	endforeach;
?>
</div>
