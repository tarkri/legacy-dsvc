<?php
/**
 * @file
 * awards.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function awards_taxonomy_default_vocabularies() {
  return array(
    'award_type' => array(
      'name' => 'Award Type',
      'machine_name' => 'award_type',
      'description' => '',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '0',
    ),
  );
}
