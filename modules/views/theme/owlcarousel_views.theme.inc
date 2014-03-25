<?php

/**
 * @file
 * owlcarousel_views.theme.inc
 */

/**
 * Add helper variables for carousel view.
 */
function template_process_owlcarousel_views(&$vars) {
  if (!empty($vars['view'])) {
    $options = $vars['options'];
    $view = $vars['view'];

    $items = array();
    $row_plugin = $view->style_plugin->row_plugin;
    foreach ($vars['rows'] as $id => $row) {
      $view->row_index = $id;
      $item['row'] = $row_plugin->render($row);

      $items[] = $item;
    }
    $vars['items'] = $items;

    $options['attributes']['id'] = $vars['options']['id'];
    $vars['settings'] = $options;
  }

  return $vars;
}
