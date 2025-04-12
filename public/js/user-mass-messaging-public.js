(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery(document).ready(function($) {
	    if (typeof massMessagingData !== 'undefined' && massMessagingData.connections) {
	        var connections = massMessagingData.connections;

	        var checkSelect2 = setInterval(function() {
	            if ($('#send-to-input').hasClass('select2-hidden-accessible')) {
	                clearInterval(checkSelect2);

	                var selectedIds = connections.map(function(item) {
	                    return item.id;
	                });

	                $('#send-to-input').val(selectedIds);

	                connections.forEach(function(item) {
	                    var option = new Option(item.text, item.id, true, true);
	                    $('#send-to-input').append(option);
	                });

	                $('#send-to-input').trigger('change');
	            }
	        }, 100);
	    }
	});


})( jQuery );
