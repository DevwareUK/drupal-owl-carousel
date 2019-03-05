<?php

/**
 * @file
 * Features Owl Carousel.
 */

/**
 * Implementation of hook_features_export_options()
 */
function owlcarousel_group_features_export_options() {
  $options = array();
  $groups = (array) owlcarousel_group_load();
  foreach ($groups as $name => $group) {
    $options[$name] = str_replace('_', ' ', $group->value);
  }
  return $options;
}

/**
 * Implementation of hook_features_export()
 */
function owlcarousel_group_features_export($data, &$export, $module_name = '') {
  $pipe = array();
  foreach ((array) $data as $name) {
    $group = owlcarousel_group_load($name);
    if ($group) {
      $export['features']['owlcarousel_group'][$name] = $name;
    }
  }
  $export['dependencies'][] = 'owlcarousel';
  return $pipe;
}

/**
 * Implementation of hook_features_export_render()
 */
function owlcarousel_group_features_export_render($module_name, $data) {
  $groups = array();

  foreach ($data as $name) {
    $group = (array) owlcarousel_group_load($name);
    $groups[$name] = $group;
  }

  $code = '  $data = ' . features_var_export($groups, '  ') . ';' . PHP_EOL;
  $code .= '  return $data;';

  return array('owlcarousel_group_defaults' => $code);
}

/**
 * Implementation of hook_features_rebuild()
 */
function owlcarousel_group_features_rebuild($module) {
  owlcarousel_group_features_revert($module);
}

/**
 * Implementation of hook_features_revert()
 */
function owlcarousel_group_features_revert($module) {
  if ($data = features_get_default('owlcarousel_group', $module)) {
    foreach ($data as $name => $group) {
      // Restore the group settings
      db_query("DELETE FROM {variable} WHERE name LIKE :name", array(':name' => '%' . db_like($name)));
      $group = array_shift($group);
      foreach($group['settings'] as $name => $value)
      db_query("INSERT INTO {variable} (name, value) VALUES(:name, :value)", array(':name' => $name, ':value' => serialize($value)));
    }
  }
}
