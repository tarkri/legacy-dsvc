/**
 * @file
 * Javascript to generate Stripe token in PCI-compliant way.
 */

(function ($) {
  Drupal.behaviors.stripe = {
    attach: function (context, settings) {
      if (settings.stripe.fetched == null) {
        settings.stripe.fetched = true;

        var createToken = function (cardFieldMap, responseHandler) {
          Stripe.setPublishableKey(settings.stripe.publicKey);

          var cardValues = {
            number: $('[id^=' + cardFieldMap.number +']').val(),
            cvc: $('[id^=' + cardFieldMap.cvc +']').val(),
            exp_month: $('[id^=' + cardFieldMap.exp_month +']').val(),
            exp_year: $('[id^=' + cardFieldMap.exp_year +']').val(),
            name: $('[id^=' + cardFieldMap.name +']').val()
          };

          var optionalFieldMap = {
            address_line1: 'commerce-stripe-thoroughfare',
            address_line2: 'commerce-stripe-premise',
            address_city: 'commerce-stripe-locality',
            address_state: 'commerce-stripe-administrative-area',
            address_zip: 'commerce-stripe-postal-code',
            address_country: 'commerce-stripe-country'
          };
          for (var stripeName in optionalFieldMap) {
            if (optionalFieldMap.hasOwnProperty(stripeName)) {
              var formInputElement = $('.' + optionalFieldMap[stripeName]);
              if (formInputElement.length) {
                cardValues[stripeName] = formInputElement.val();
              }
            }
          }

          Stripe.createToken(cardValues, responseHandler);
        };

        var makeResponseHandler = function (form$, errorDisplay$, onError, onSuccess) {
          return function (status, response) {
            if (response.error) {
              // Show the errors on the form.
              errorDisplay$.html($("<div class='messages error'></div>").html(response.error.message));

              onError && onError(form$);
            }
            else {
              // Token contains id, last4, and card type.
              var token = response['id'];
              // Insert the token into the form so it gets submitted to the server.
              form$.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

              onSuccess && onSuccess(form$);

              // And submit.
              form$.get(0).submit(form$);
            }
          };
        };

        $('body').delegate('#edit-continue', 'click', function(event) {

          // Prevent the Stripe actions to be triggered if Stripe is not selected.
          if ($("input[value*='commerce_stripe|']").is(':checked')) {
            // Do not fetch the token if cardonfile is enabled and the customer has selected an existing card.
            if ($('.form-item-commerce-payment-payment-details-cardonfile').length) {
              // If select list enabled in card on file settings
              if ($("select[name='commerce_payment[payment_details][cardonfile]']").length
                  && $("select[name='commerce_payment[payment_details][cardonfile]'] option:selected").val() != 'new') {
                return;
              }

              // If radio buttons are enabled in card on file settings
              if ($("input[type='radio'][name='commerce_payment[payment_details][cardonfile]']").length
                  && $("input[type='radio'][name='commerce_payment[payment_details][cardonfile]']:checked").val() != 'new') {
                return;
              }
            }

            $(this).addClass('auth-processing');

            // Prevent the form from submitting with the default action.
            event.preventDefault();

            // Show progress animated gif (needed for submitting after first error).
            $('.checkout-processing').show();

            // Disable the submit button to prevent repeated clicks.
            $('.form-submit').attr("disabled", "disabled");
   
            var cardFields = {
              number: 'edit-commerce-payment-payment-details-credit-card-number',
              cvc: 'edit-commerce-payment-payment-details-credit-card-code',
              exp_month: 'edit-commerce-payment-payment-details-credit-card-exp-month',
              exp_year: 'edit-commerce-payment-payment-details-credit-card-exp-year',
              name: 'edit-commerce-payment-payment-details-credit-card-owner'
            };

            var responseHandler = makeResponseHandler(
              $("#edit-continue").closest("form"),
              $('div.payment-errors'),
              function () {
                $(this).removeClass('auth-processing');
                // Enable the submit button to allow resubmission.
                $('.form-submit').removeAttr("disabled");
                // Hide progress animated gif.
                $('.checkout-processing').hide();
              },
              function (form$) {
                var $btnTrigger = $('.form-submit.auth-processing').eq(0);
                var trigger$ = $("<input type='hidden' />").attr('name', $btnTrigger.attr('name')).attr('value', $btnTrigger.attr('value'));
                form$.append(trigger$);
              }
            );

            createToken(cardFields, responseHandler);

            // Prevent the form from submitting with the default action.
            return false;
          }
        });

        $('#commerce-stripe-cardonfile-create-form').delegate('#edit-submit', 'click', function (event) {
          var cardFields = {
            number: 'edit-credit-card-number',
            cvc: 'edit-credit-card-code',
            exp_month: 'edit-credit-card-exp-month',
            exp_year: 'edit-credit-card-exp-year',
            name: 'edit-credit-card-owner'
          };

          var responseHandler = makeResponseHandler($('#commerce-stripe-cardonfile-create-form'), $('#card-errors'));

          createToken(cardFields, responseHandler);

          return false;
        });
      }
    }
  }
})(jQuery);
;
(function($) {
  Drupal.behaviors.chosen = {
    attach: function(context, settings) {
      settings.chosen = settings.chosen || Drupal.settings.chosen;

      // Prepare selector and add unwantend selectors.
      var selector = settings.chosen.selector;

      // Function to prepare all the options together for the chosen() call.
      var getElementOptions = function (element) {
        var options = $.extend({}, settings.chosen.options);

        // The width default option is considered the minimum width, so this
        // must be evaluated for every option.
        if ($(element).width() < settings.chosen.minimum_width) {
          options.width = settings.chosen.minimum_width + 'px';
        }
        else {
          options.width = $(element).width() + 'px';
        }

        // Some field widgets have cardinality, so we must respect that.
        // @see chosen_pre_render_select()
        if ($(element).attr('multiple') && $(element).data('cardinality')) {
          options.max_selected_options = $(element).data('cardinality');
        }

        return options;
      };

      // Process elements that have opted-in for Chosen.
      // @todo Remove support for the deprecated chosen-widget class.
      $('select.chosen-enable, select.chosen-widget', context).once('chosen', function() {
        options = getElementOptions(this);
        $(this).chosen(options);
      });

      $(selector, context)
        // Disabled on:
        // - Field UI
        // - WYSIWYG elements
        // - Tabledrag weights
        // - Elements that have opted-out of Chosen
        // - Elements already processed by Chosen
        .not('#field-ui-field-overview-form select, #field-ui-display-overview-form select, .wysiwyg, .draggable select[name$="[weight]"], .draggable select[name$="[position]"], .chosen-disable, .chosen-processed')
        .filter(function() {
          // Filter out select widgets that do not meet the minimum number of
          // options.
          var minOptions = $(this).attr('multiple') ? settings.chosen.minimum_multiple : settings.chosen.minimum_single;
          if (!minOptions) {
            // Zero value means no minimum.
            return true;
          }
          else {
            return $(this).find('option').length >= minOptions;
          }
        })
        .once('chosen', function() {
          options = getElementOptions(this);
          $(this).chosen(options);
        });
    }
  };
})(jQuery);
;
