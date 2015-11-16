<div id="main-stories">
<?php
	$count = 1;
	foreach ($rows as $id => $row):
?>
	<article<?php if ($count == 1) { echo " class=\"first-child\""; } elseif ($count == 4 || $count == 7) { echo " class=\"last-child\""; }?>>
		<?php print $row; ?>
	</article>
<?php
	$count ++;
	endforeach;
?>
</div><!-- /#main-stories -->
