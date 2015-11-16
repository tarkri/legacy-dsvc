(function ($) {
	Drupal.behaviors.DSVC = {
		attach: function(context) {
			var creditsOpen = false;

			$('.messages').click(function(e) {
				$(this).fadeOut(500);
			});

			$("a#show-credits").click(function(e) {
				if (creditsOpen === false) {
					e.preventDefault();
					$("ul#site-credits").css("display", "block");
					$("ul#site-credits").animate({
						bottom: "48px"
					}, 1000, function() {
						creditsOpen = true;
					});
					$(this).text("Hide Credits");
				} else {
					e.preventDefault();
					$("ul#site-credits").animate({
						bottom: "-7px"
					}, 1000, function() {
						$("ul#site-credits").css("display", "none");
						creditsOpen = false;
					});
					$(this).text("Site Credits");
				}
			});

			$("a#close-credits").click(function(e) {
				e.preventDefault();
				$("a#show-credits").text("Site Credits");
				$("ul#site-credits").animate({
					bottom: "-7px"
				}, 1000, function() {
					$("ul#site-credits").css("display", "none");
					creditsOpen = false;
				});
			});

			$("ul.job-listings > li").each(function() {
				var title_height = $(this).find("div.job-description h2").height();
				var date_height  = $(this).find("div#job-meta h2").height();

				if (title_height > date_height) {
					var new_padding = title_height - date_height;
					$(this).find("div#job-meta h2").css("padding-top", new_padding);
				}
			});
		}
	};
}(jQuery));





// $("form#views-exposed-form-job-board-page-1 .form-checkbox").live("change", function() {
//   // Execute the submit function on the form
//   $("form#views-exposed-form-job-board-page-1").submit();
// });

// $("form#views-exposed-form-job-board-page-2 .form-checkbox").live("change", function() {
//   // Execute the submit function on the form
//   $("form#views-exposed-form-job-board-page-2").submit();
// });
