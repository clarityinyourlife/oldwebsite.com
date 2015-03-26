/**
 * Functions file for loading custom Admin JS.
 *
 * @package Cayon
 * @subpackage Functions
 */

(function($){
	
	/** jQuery Document Ready */
	$(document).ready(function(){
		
		$( '#galaxy_tabs' ).tabs({
			cookie: { expires: 1 }
		});
		
	});

	/** jQuery Windows Load */
	$(window).load(function(){
	});	

})(jQuery);