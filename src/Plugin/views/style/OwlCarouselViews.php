<?php

namespace Drupal\owlcarousel\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\owlcarousel\OwlCarouselGlobal;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render each item into owl carousel.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "owlcarouselviews",
 *   title = @Translation("OwlCarousel"),
 *   help = @Translation("Displays rows as OwlCarousel."),
 *   theme = "owlcarousel_views",
 *   display_types = {"normal"}
 * )
 */
class OwlCarouselViews extends StylePluginBase {

  /**
   * Does the style plugin allows to use style plugins.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Does the style plugin support custom css class for the rows.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * Set default options.
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    $settings = OwlCarouselGlobal::defaultSettings();
    foreach ($settings as $k => $v) {
      $options[$k] = ['default' => $v];
    }
    return $options;
  }

  /**
   * Render the given style.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $fields = ['' => t('<None>')];
    $fields += $this->displayHandler->getFieldLabels(TRUE);

    $form['items'] = [
      '#type' => 'number',
      '#title' => $this->t('Items'),
      '#description' => $this->t('Maximum amount of items displayed at a time with the widest browser width.'),
      '#default_value' => $this->options['items'],
    ];

    // Fields to use.
    $form['image'] = [
      '#type' => 'select',
      '#title' => $this->t('Image'),
      '#options' => $fields,
      '#default_value' => $this->options['image'],
    ];


  }

}
