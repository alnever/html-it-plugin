/*

JavaSript function for the HTML It plugin

Functions allow to download results of the convertion/transformation


*/

(function($) {

	$(document).ready( function () {
		$("#html_converter_link").click(function () {
			// get a content
			var content = $('#html_converter_result').html();
			// create a BLOB object
			var blob = new Blob([content], { type:'text/html' });
			// make the link downloadable
			$("#html_converter_link").attr("download","temporary.html");
			// attach the blob to the link
			$("#html_converter_link").attr("href",URL.createObjectURL(blob));
		});
	});

})(jQuery);

