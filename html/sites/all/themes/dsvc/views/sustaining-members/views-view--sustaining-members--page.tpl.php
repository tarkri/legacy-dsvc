<div class="view view-<?php print $css_name; ?>">
<?php if ($header): ?>
	<?php print $header; ?>
<?php endif; ?>

<?php if ($attachment_before): ?>
	<?php print $attachment_before; ?>
<?php endif; ?>

<?php print $rows; ?>

<?php if ($pager): ?>
	<?php print $pager; ?>
<?php endif; ?>

<?php if ($attachment_after): ?>
	<?php print $attachment_after; ?>
<?php endif; ?>

<?php if ($footer): ?>
	<?php print $footer; ?>
<?php endif; ?>
</div>