<?php

/**
 * Provide a valid, unique HTML ID.
 */
function html5_base_preprocess_region(&$variables) {
  $variables['region'] = drupal_html_id($variables['region']);
}
