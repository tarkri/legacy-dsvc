<div class="membership-profile">
		<div class="intro profile-section">
			<h1>Membership Profile</h1>

			<?php if ($own_profile) : ?>
				<p>This is the information the DSVC uses to let you know about upcoming events and to contact you about your membership status. None of this information will be shared without your permission.</p>

				<a class="button" href="/user/<?php echo $user->uid ?>/edit-profile">Edit Your Profile</a>
				<a class="button" href="/user/<?php echo $user->uid ?>/edit">Edit Your Account</a>
			<?php endif; ?>
		</div>

	<div class="name-title profile-section">
		<h1 class="fname"><?php print render($user_profile['field_first_name']) . " " . render($user_profile['field_last_name']); ?></h1>
		<?php if (!$field_job_title[0]['field_is_private']['value'] || $own_profile) : ?>
			<p class="title">
				<strong>Job Title</strong>
				<?php print render($user_profile['field_job_title']); ?> <?php if ($own_profile) { print '<span class="'.strtolower($field_job_title[0]['field_is_private']['display']).'">(' . $field_job_title[0]['field_is_private']['display'] . ')</span>'; } ?>
			</p>
		<?php endif; ?>

		<?php if (!$field_employer[0]['field_is_private']['value'] || $own_profile) : ?>
			<p>
				<strong>Employer</strong>
				<?php print render($user_profile['field_employer']); ?> <?php if ($own_profile) { print '<span class="'.strtolower($field_employer[0]['field_is_private']['display']).'">(' . $field_employer[0]['field_is_private']['display'] . ')</span>'; } ?>
			</p>
		<?php endif; ?>
	</div>

	<dl class="membership-info profile-section">
		<dt>Member Since:</dt> <dd><?php print render($user_profile['field_dsvc_member_since']); ?></dd>
		<?php if ($own_profile) : ?>
			<dt>Expires:</dt> <dd><?php print render($user_profile['field_dsvc_membership_expires']); ?></dd>
			<dt>Type:</dt> <dd><?php print render($user_profile['field_dsvc_membership_type']); ?></dd>
		<?php endif; ?>
	</dl>


	<?php if (!$field_primary_address[0]['field_is_private']['value'] && !$field_primary_phone[0]['field_is_private']['value'] || $own_profile) : ?>
		<div class="contact primary profile-section">
			<h2>Contact Information</h2>

			<?php print render($user_profile['field_primary_address']); ?>
			<?php if ($own_profile) { print '<span class="'.strtolower($field_primary_address[0]['field_is_private']['display']).'">(' . $field_primary_address[0]['field_is_private']['display'] . ')</span>'; } ?>

			<dl>
				<dt>Phone</dt>
				<dd><?php print render($user_profile['field_primary_phone']); ?> <?php if ($own_profile) { print '<span class="'.strtolower($field_primary_phone[0]['field_is_private']['display']).'">(' . $field_primary_phone[0]['field_is_private']['display'] . ')</span>'; } ?></dd>
			</dl>
		</div>
	<?php endif; ?>
</div>
