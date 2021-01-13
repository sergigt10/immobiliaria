(function($) {
  'use strict';

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2({
			language: {
				noResults: function() {
					return " ... ";        
				},
				searching: function() {
					return " ... ";
				}
			}
		});
  }
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
  }
})(jQuery);