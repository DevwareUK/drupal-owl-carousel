/**
 * @file
 */

(function ($, Drupal, drupalSettings) {
    'use strict';

    Drupal.behaviors.owl = {
        attach: function (context, settings) {
            $('.owl-slider-wrapper', context).each(function () {
                var $this = $(this);
                var $this_settings = $.parseJSON($this.attr('data-settings'));
                $this.owlCarousel($this_settings);
            });
        }
    };

    // @todo: set owlcarousel to work with multiple carousels.
    Drupal.behaviors.owlcarousel_views = {
        attach: function (context, settings) {
            var owlCarouselViews = drupalSettings.
            $('.owl-slider-wrapper').owlCarousel({
                items: 1
            });

        }
    }
})(jQuery);
