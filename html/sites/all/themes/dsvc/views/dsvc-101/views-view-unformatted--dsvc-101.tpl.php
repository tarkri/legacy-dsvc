<ul id="monthly-meetings" class="<?php print $classes[$id]; ?>">
<?php 
	$count = 1;
	foreach ($rows as $id => $row):
?>
	<li<?php if (($count % 3) == 0) { echo " class=\"third-child\""; }?>>
		<?php print $row; ?>
	</li>
<?php
	$count ++;
	endforeach;
?>
</ul>