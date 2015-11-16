<?php

/**
 * Implementation of hook_enable().
 */
function dsvc_membership_enable() {
	// Check if our field is not already created.
	if (!field_info_field('field_first_name')) {
		$field = array(
			'field_name' => 'field_first_name',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_first_name',
			'entity_type' => 'user',
			'label' => 'First Name',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => TRUE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 1,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_last_name')) {
		$field = array(
			'field_name' => 'field_last_name',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_last_name',
			'entity_type' => 'user',
			'label' => 'Last Name',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => TRUE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 1,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_email')) {
		$field = array(
			'field_name' => 'field_email',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_email',
			'entity_type' => 'user',
			'label' => 'Email Address',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
				'user_field_privacy' => 1,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_job_title')) {
		$field = array(
			'field_name' => 'field_job_title',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_job_title',
			'entity_type' => 'user',
			'label' => 'Job Title',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
				'user_field_privacy' => 1,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_employer')) {
		$field = array(
			'field_name' => 'field_employer',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_employer',
			'entity_type' => 'user',
			'label' => 'Employer',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
				'user_field_privacy' => 1,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_available_for_freelance')) {
		$field = array(
			'field_name' => 'field_available_for_freelance',
			'type' => 'list_boolean',
			'settings' => array(
				'allowed_values' => array(0 => 'No', 1 => 'Yes'),
			),
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_available_for_freelance',
			'entity_type' => 'user',
			'label' => 'Available for Freelance',
			'bundle' => 'user',
			'required' => FALSE,
			'settings' => array(
				'user_register_form' => 0,
			),
			'widget' => array(
				'type' => 'options_buttons',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_primary_phone')) {
		$field = array(
			'field_name' => 'field_primary_phone',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_primary_phone',
			'entity_type' => 'user',
			'label' => 'Phone',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
				'user_field_privacy' => 1,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_primary_address')) {
		$field = array(
			'field_name' => 'field_primary_address',
			'type' => 'addressfield',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_primary_address',
			'entity_type' => 'user',
			'label' => 'Primary Address',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
				'user_field_privacy' => 1,
			),
			'widget' => array(
				'type' => 'addressfield_standard',
				'settings' => array(
					'available_countries' => array('US'),
					'format_handlers' => array('address', 'address-hide-country'),
				),
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_dsvc_member_since')) {
		$field = array(
			'field_name' => 'field_dsvc_member_since',
			'type' => 'datetime',
			'settings' => array(
				'granularity' => array(
					'month' => 'month',
					'year' => 'year',
				),
				'tz_handling' => 'none',
			),
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_dsvc_member_since',
			'entity_type' => 'user',
			'label' => 'Member Since',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'field_permissions' => array('type' => 2),
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
			),
			'widget' => array(
				'type' => 'date_text',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_dsvc_membership_expires')) {
		$field = array(
			'field_name' => 'field_dsvc_membership_expires',
			'type' => 'datetime',
			'settings' => array(
				'granularity' => array(
					'day' => 'day',
					'month' => 'month',
					'year' => 'year',
				),
				'tz_handling' => 'none',
			),
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_dsvc_membership_expires',
			'entity_type' => 'user',
			'label' => 'Membership Expires',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'field_permissions' => array('type' => 2),
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
			),
			'widget' => array(
				'type' => 'date_text',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_dsvc_membership_type')) {
		$field = array(
			'field_name' => 'field_dsvc_membership_type',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_dsvc_membership_type',
			'entity_type' => 'user',
			'label' => 'Membership Type',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_sugar_id')) {
		$field = array(
			'field_name' => 'field_sugar_id',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_sugar_id',
			'entity_type' => 'user',
			'label' => 'CRM ID',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_crm_email_id')) {
		$field = array(
			'field_name' => 'field_crm_email_id',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_crm_email_id',
			'entity_type' => 'user',
			'label' => 'CRM Email ID',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_crm_address_id')) {
		$field = array(
			'field_name' => 'field_crm_address_id',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_crm_address_id',
			'entity_type' => 'user',
			'label' => 'CRM Address ID',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}

	if (!field_info_field('field_crm_phone_id')) {
		$field = array(
			'field_name' => 'field_crm_phone_id',
			'type' => 'text',
		);
		field_create_field($field);

		// Create the instance on the bundle.
		$instance = array(
			'field_name' => 'field_crm_phone_id',
			'entity_type' => 'user',
			'label' => 'CRM Phone ID',
			'bundle' => 'user',
			// If you don't set the "required" property then the field wont be required by default.
			'required' => FALSE,
			'settings' => array(
				// Here you inform either or not you want this field showing up on the registration form.
				'user_register_form' => 0,
			),
			'widget' => array(
				'type' => 'textfield',
			),
		);
		field_create_instance($instance);
	}
}

