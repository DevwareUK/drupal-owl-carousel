/**
 * @file
 * OwlCarousel Drupal JS.
 */

(function ($, Drupal, drupalSettings) {
    'use strict';

    // @todo: Currently this is breaking JS in Drupal.
    Drupal.behaviors.owl = {
        attach: function (context, settings) {
            // $('.owl-slider-wrapper', context).each(function () {
            //     var $this = $(this);
            //     var $this_settings = $.parseJSON($this.attr('data-settings'));
            //     $this.owlCarousel($this_settings);
            // });
        }
    };

    /**
     * OwlCarousel views js.
     * @type {{attach: Drupal.behaviors.owlcarousel_views.attach}}
     */
    Drupal.behaviors.owlcarousel_views = {
        attach: function (context, settings) {

            // Declare the owlcarousel views settings object.
            var owlCarouselViews = drupalSettings.owlcarousel_views;
            // Loop the carousel object and output settings into our carousel.
            for (const item in owlCarouselViews) {
                var thisSettings = owlCarouselViews[item];
                $('.' + item).owlCarousel(thisSettings);
            }

        }
    }
})(jQuery, Drupal, drupalSettings);
