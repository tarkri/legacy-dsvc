<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * DSVC Store theme.
 */

function dsvc_store_preprocess_user_profile(&$variables) {
  global $user;

  $account = $variables['elements']['#account'];
  if ($user->uid == $account->uid) {
    $variables['own_profile'] = true;
  }
  else {
    $variables['own_profile'] = false;
  }

  $field_types = array("field_email", "field_job_title", "field_employer", "field_primary_address", "field_primary_phone");

  foreach ($field_types as $field) {
    $field_info = field_info_field($field);

    // drupal_set_message(_user_field_privacy_value($field_info['id'], $account->uid));

    if (_user_field_privacy_value($field_info['id'], $account->uid)) {
      $variables[$field][0]['field_is_private']['value'] = true;
      $variables[$field][0]['field_is_private']['display'] = "Private";
    }
    else {
     $variables[$field][0]['field_is_private']['value'] = false;
     $variables[$field][0]['field_is_private']['display'] = "Public";
    }
  }
}

function dsvc_store_preprocess_node(&$variables) {
  $variables['taxonomy'] = taxonomy_get_tree(2);
}
