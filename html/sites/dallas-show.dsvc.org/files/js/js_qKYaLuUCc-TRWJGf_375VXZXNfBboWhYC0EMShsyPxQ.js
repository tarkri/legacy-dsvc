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
(function ($) {

/**
 * A progressbar object. Initialized with the given id. Must be inserted into
 * the DOM afterwards through progressBar.element.
 *
 * method is the function which will perform the HTTP request to get the
 * progress bar state. Either "GET" or "POST".
 *
 * e.g. pb = new progressBar('myProgressBar');
 *      some_element.appendChild(pb.element);
 */
Drupal.progressBar = function (id, updateCallback, method, errorCallback) {
  var pb = this;
  this.id = id;
  this.method = method || 'GET';
  this.updateCallback = updateCallback;
  this.errorCallback = errorCallback;

  // The WAI-ARIA setting aria-live="polite" will announce changes after users
  // have completed their current activity and not interrupt the screen reader.
  this.element = $('<div class="progress" aria-live="polite"></div>').attr('id', id);
  this.element.html('<div class="bar"><div class="filled"></div></div>' +
                    '<div class="percentage"></div>' +
                    '<div class="message">&nbsp;</div>');
};

/**
 * Set the percentage and status message for the progressbar.
 */
Drupal.progressBar.prototype.setProgress = function (percentage, message) {
  if (percentage >= 0 && percentage <= 100) {
    $('div.filled', this.element).css('width', percentage + '%');
    $('div.percentage', this.element).html(percentage + '%');
  }
  $('div.message', this.element).html(message);
  if (this.updateCallback) {
    this.updateCallback(percentage, message, this);
  }
};

/**
 * Start monitoring progress via Ajax.
 */
Drupal.progressBar.prototype.startMonitoring = function (uri, delay) {
  this.delay = delay;
  this.uri = uri;
  this.sendPing();
};

/**
 * Stop monitoring progress via Ajax.
 */
Drupal.progressBar.prototype.stopMonitoring = function () {
  clearTimeout(this.timer);
  // This allows monitoring to be stopped from within the callback.
  this.uri = null;
};

/**
 * Request progress data from server.
 */
Drupal.progressBar.prototype.sendPing = function () {
  if (this.timer) {
    clearTimeout(this.timer);
  }
  if (this.uri) {
    var pb = this;
    // When doing a post request, you need non-null data. Otherwise a
    // HTTP 411 or HTTP 406 (with Apache mod_security) error may result.
    $.ajax({
      type: this.method,
      url: this.uri,
      data: '',
      dataType: 'json',
      success: function (progress) {
        // Display errors.
        if (progress.status == 0) {
          pb.displayError(progress.data);
          return;
        }
        // Update display.
        pb.setProgress(progress.percentage, progress.message);
        // Schedule next timer.
        pb.timer = setTimeout(function () { pb.sendPing(); }, pb.delay);
      },
      error: function (xmlhttp) {
        pb.displayError(Drupal.ajaxError(xmlhttp, pb.uri));
      }
    });
  }
};

/**
 * Display errors on the page.
 */
Drupal.progressBar.prototype.displayError = function (string) {
  var error = $('<div class="messages error"></div>').html(string);
  $(this.element).before(error).hide();

  if (this.errorCallback) {
    this.errorCallback(this);
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
