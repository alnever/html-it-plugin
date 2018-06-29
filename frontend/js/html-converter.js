/*

JavaSript function for the HTML It plugin

Functions allow to download results of the convertion/transformation


*/

(function($) {

	$(document).ready( function () {
		$("#html_converter_img").click( function() {
			console.log($('#html_converter_result').html());
			//  TODO: save the content into the local file

		});
	});

})(jQuery);

