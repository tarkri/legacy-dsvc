<?php
// $Id: maintenance-page.tpl.php,v 1.3 2008/01/24 09:42:53 goba Exp $

/**
 * @file maintenance-page.tpl.php
 *
 * This is an override of the default maintenance page. Used for Garland and
 * Minnelli, this file should not be moved or modified since the installation
 * and update pages depend on this file.
 *
 * This mirrors closely page.tpl.php for Garland in order to share the same
 * styles.
 */
?>
<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<div id="page">
<?php if (!empty($admin)) print $admin; ?>
	<div id="content">
		<div id="primary-content">
			<?php if ($tabs): ?>
				<div id="content-tabs">
					<?php print $tabs; ?>
				</div>
			<?php endif; ?>

			<?php if ($help): ?>
				<?php print $help; ?>
			<?php endif; ?>
			<?php if ($messages): ?>
				<?php print $messages; ?>
			<?php endif; ?>

      <?php if ($tertiary_content): ?>
        <div id="tertiary-content">
          <?php print $tertiary_content; ?>
      	</div><!-- /#jobs-rss -->
      <?php endif; ?>

			<?php print $content; ?>
		</div><!-- /#primary-content -->

		<div id="secondary-content">
			<?php if ($secondary_content): ?>
				<?php print $secondary_content; ?>
			<?php endif; ?>
		</div><!-- /#secondary-content -->

	</div><!-- /#content -->

	<div id="header">
		<?php if ($header): ?>
			<?php print $header; ?>
		<?php endif; ?>

		<div id="primary-navigation">
			<?php if ($primary_navigation): ?>
				<?php print $primary_navigation; ?>
			<?php endif; ?>
		</div>
	</div><!-- /#header -->

	<div id="footer">
		<?php if ($footer): ?>
			<?php print $footer; ?>
		<?php endif; ?>
	</div><!-- /#footer -->
</div><!-- /#page -->

<div class="modal jqmWindow">
	<?php print dsvc_user_form(); ?>
</div>

<?php print $page_bottom ?>

</body>
</html>
