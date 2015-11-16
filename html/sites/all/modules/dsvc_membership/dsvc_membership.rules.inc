<?php

/**
 * Implementation of hook_rules_action_info().
 */
function dsvc_membership_rules_action_info() {
	return array(
		'dsvc_membership_capsule_deactivate_member' => array(
			'label' => t('Deactivate the Capsule contact associated to the user.'),
			'parameter' => array(
				'user' => array(
					'type' => 'user',
					'label' => t('User'),
				),
			),
			'group' => t('User'),
		),

		'dsvc_membership_capsule_activate_member' => array(
			'label' => t('Activate the Capsule contact associated to the user.'),
			'parameter' => array(
				'user' => array(
					'type' => 'user',
					'label' => t('User'),
				),
			),
			'group' => t('User'),
		),

		'dsvc_membership_capsule_create_member' => array(
			'label' => t('Create the Capsule contact associated to the user.'),
			'parameter' => array(
				'user' => array(
					'type' => 'user',
					'label' => t('User'),
				),
			),
			'group' => t('User'),
		),

		'dsvc_membership_line_item_renewal_update' => array(
			'label' => t("Get the member id if none exists"),
			'parameter' => array(
				'commerce_line_item' => array(
					'type' => 'commerce_line_item',
					'label' => t('Line item'),
				),
			),
			'group' => t('Commerce Line Item'),
		),

		'dsvc_membership_membership_renewal' => array(
			'label' => t("Updated Membership based on member ID"),
			'parameter' => array(
				'commerce_line_item' => array(
					'type' => 'commerce_line_item',
					'label' => t('Line item'),
				),
			),
			'group' => t('Commerce Line Item'),
		),
	);
}

