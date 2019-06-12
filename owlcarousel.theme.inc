<?php

use Drupal\owlcarousel\OwlCarouselView;
/**
 * Prepares variables for views carousel template.
 *
 * Default template: views-bootstrap-carousel.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_owlcarousel_views(array &$vars) {
  $view = $vars['view'];
  $vars['id'] = OwlCarouselView::getUniqueId($view);
  $vars['attributes']['class'][] = 'owl-slider-wrapper';
  $vars['attributes']['class'][] = 'owl-carousel';
  $vars['#attached']['library'][] = 'owlcarousel/owlcarousel';
  $vars['#attached']['drupalSettings']['owlcarousel_views'][$vars['id']] = '';

    // Fields.
  // Carousel rows.
  $image = $view->style_plugin->options['image'];
  $fieldLabels = $view->display_handler->getFieldLabels(TRUE);

  foreach ($vars['rows'] as $id => $row) {
    $vars['rows'][$id] = [];
    $vars['rows'][$id]['image'] = $view->style_plugin->getField($id, $image);
    // Add any additional fields to result.
    foreach (array_keys($fieldLabels) as $label) {
      if (!in_array($label, [$image])) {
        $vars['rows'][$id][$label] = $view->style_plugin->getField($id, $label);
      }
    }
  }

}

