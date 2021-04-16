/**
 * @file
 */

(function ($) {
  Drupal.behaviors.owl = {
    attach: function (context, settings) {
      let carousels = [];

      $('.owl-slider-wrapper', context).each(function () {
        var $this = $(this);
        var $this_settings = $.parseJSON($this.attr('data-settings'));
        carousels.push($this.owlCarousel($this_settings));

        if ($(this).parent().hasClass('owlcarousel-thumbs-thumbs')) {
          $this.find('.owl-wrapper').click({main: carousels[carousels.length - 2]}, (e) => {
            var index = $(e.target).closest('.owl-item').index();
            e.data.main.trigger('owl.goTo', [index, 300]);
          }).bind(carousels.length);
        }
      });
    }
  };
})(jQuery);
