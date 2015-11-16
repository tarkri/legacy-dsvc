(function ($) {

	Drupal.behaviors.dsvcMembership = {
		attach: function (context, settings) {
			$('#edit-field-email-und-0-value').attr("disabled", "disabled");

			function getUrlVars() {
				var vars = {}, hash;

				if (window.location.href.indexOf('?') === -1) {
					return false;
				}

				var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

				for (var i = 0; i < hashes.length; i++) {
					hash = hashes[i].split('=');
					vars[hash[0]] = hash[1];
				}

				return vars;
			}

			var args = getUrlVars();

			if (args) {
				$('#edit-line-item-fields-field-member-first-name-und-0-value').val(args.first_name);
				$('#edit-line-item-fields-field-member-last-name-und-0-value').val(args.last_name);
				$('#edit-line-item-fields-field-member-email-address-und-0-email').val(args.email);
				$('#edit-line-item-fields-field-member-crm-id input').val(args.member_id);
			}

			// if ($('.commerce-cart-add-to-cart-form-9')) {
			// 	$('#edit-submit').on('click', function(e) {
			// 		e.preventDefault();
			// 		e.stopPropagation();

			// 		console.log('button click');
			// 		$.ajax({
			// 			url: '/member-api/lookup',
			// 			type: 'GET',
			// 			dataType: 'json',
			// 			data: {
			// 				first_name: $('#edit-line-item-fields-field-member-first-name-und-0-value').val(),
			// 				last_name: $('#edit-line-item-fields-field-member-last-name-und-0-value').val(),
			// 				email: $('#edit-line-item-fields-field-member-email-address-und-0-email').val(),
			// 			}
			// 		}).done(function(data) {
			// 			console.log(data);
			// 		});
			// 	});
			// }
		}
	};

})(jQuery);
;
(function($) {

/**
 * Disable the continue buttons in the checkout process once they are clicked
 * and provide a notification to the user.
 */
Drupal.behaviors.commerceCheckout = {
  attach: function (context, settings) {
    // When the buttons to move from page to page in the checkout process are
    // clicked we disable them so they are not accidently clicked twice.
    $('input.checkout-continue:not(.checkout-processed)', context).addClass('checkout-processed').click(function() {
      var $this = $(this);
      $this.clone().insertAfter(this).attr('disabled', true).next().removeClass('element-invisible');
      $this.hide();
    });
  }
}

})(jQuery);
;
