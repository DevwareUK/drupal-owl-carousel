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
 *   id = "owlcarousel",
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
    $form['default_options'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use default settings'),
      '#description' => $this->t('By selecting this the default settings will be used and overwrite your custom settings.'),
      '#default_value' => $this->options['default_options'],
    ];
    $form['custom_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Custom settings'),
    ];
    $form['custom_settings']['items'] = [
      '#type' => 'number',
      '#title' => $this->t('Items'),
      '#description' => $this->t('Maximum amount of items displayed at a time with the widest browser width.'),
      '#default_value' => $this->options['custom_settings']['items'],
    ];
    $form['custom_settings']['margin'] = [
      '#type' => 'number',
      '#title' => $this->t('Margin (px)'),
      '#default_value' => $this->options['custom_settings']['margin'],
    ];
    $form['custom_settings']['loop'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Loop'),
      '#default_value' => $this->options['custom_settings']['loop'],
      '#description' => $this->t('Infinity loop. Duplicate last and first items to get loop illusion.'),
    ];
    $form['custom_settings']['center'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Center'),
      '#description' => $this->t('Center item. Works well with even an odd number of items.'),
      '#default_value' => $this->options['custom_settings']['center'],
    ];
    $form['custom_settings']['mouseDrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('mouseDrag'),
      '#description' => $this->t('Mouse drag enabled.'),
      '#default_value' => $this->options['custom_settings']['mouseDrag'],
    ];

  }

}
