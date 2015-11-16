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
 * Attaches double-click behavior to toggle full path of Krumo elements.
 */
Drupal.behaviors.devel = {
  attach: function (context, settings) {

    // Add hint to footnote
    $('.krumo-footnote .krumo-call').once().before('<img style="vertical-align: middle;" title="Click to expand. Double-click to show path." src="' + settings.basePath + 'misc/help.png"/>');

    var krumo_name = [];
    var krumo_type = [];

    function krumo_traverse(el) {
      krumo_name.push($(el).html());
      krumo_type.push($(el).siblings('em').html().match(/\w*/)[0]);

      if ($(el).closest('.krumo-nest').length > 0) {
        krumo_traverse($(el).closest('.krumo-nest').prev().find('.krumo-name'));
      }
    }

    $('.krumo-child > div:first-child', context).dblclick(
      function(e) {
        if ($(this).find('> .krumo-php-path').length > 0) {
          // Remove path if shown.
          $(this).find('> .krumo-php-path').remove();
        }
        else {
          // Get elements.
          krumo_traverse($(this).find('> a.krumo-name'));

          // Create path.
          var krumo_path_string = '';
          for (var i = krumo_name.length - 1; i >= 0; --i) {
            // Start element.
            if ((krumo_name.length - 1) == i)
              krumo_path_string += '$' + krumo_name[i];

            if (typeof krumo_name[(i-1)] !== 'undefined') {
              if (krumo_type[i] == 'Array') {
                krumo_path_string += "[";
                if (!/^\d*$/.test(krumo_name[(i-1)]))
                  krumo_path_string += "'";
                krumo_path_string += krumo_name[(i-1)];
                if (!/^\d*$/.test(krumo_name[(i-1)]))
                  krumo_path_string += "'";
                krumo_path_string += "]";
              }
              if (krumo_type[i] == 'Object')
                krumo_path_string += '->' + krumo_name[(i-1)];
            }
          }
          $(this).append('<div class="krumo-php-path" style="font-family: Courier, monospace; font-weight: bold;">' + krumo_path_string + '</div>');

          // Reset arrays.
          krumo_name = [];
          krumo_type = [];
        }
      }
    );
  }
};

})(jQuery);
;
