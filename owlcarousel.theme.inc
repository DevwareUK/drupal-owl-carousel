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

}

