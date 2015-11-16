<div id="page">
	<?php if (!empty($messages)) : ?>
		<section class="notifications">
			<?php print $messages; ?>
		</section>
	<?php endif; ?>

	<?php if (!empty($admin)) print $admin; ?>

	<section id="header">
		<?php print render($page['logo']); ?>
		<?php print render($page['primary_navigation']); ?>
	</section>

	<div id="main-wrapper">
		<section id="">
			<?php if ($user->uid) : ?>
				<?php if (empty($account->field_first_name)) : ?>
					<a href="/user">Welcome</a> | <a href="/user/logout">logout</a>
				<?php else : ?>
					<a href="/user">Welcome <?php print $account->field_first_name['und'][0]['value']; ?></a> | <a href="/user/logout">logout</a>
				<?php endif; ?>
			<?php else: ?>
				<a class="ctools-use-modal ctools-modal-dsvc-modal" href="/modal/nojs/login">Login</a>
			<?php endif; ?>
		</section>

		<section id="primary-content" role="main">
			<?php if ($tabs = render($tabs)): ?><div id="content-tabs" class="tabs"><?php print $tabs; ?></div><?php endif; ?>
			<?php print render($page['help']); ?>

      <?php if ($page['tertiary_content']): ?>
        <?php print render($page['tertiary_content']); ?>
      <?php endif; ?>

			<?php print render($page['content']); ?>
		</section><!-- /#primary-content -->

		<?php print render($page['secondary_content']); ?>
	</div><!-- /#main-wrapper -->

	<?php print render($page['footer']); ?>
</div><!-- /#page -->
