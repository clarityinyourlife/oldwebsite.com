/**
 * Functions file for loading custom JS for Galaxy drop downs.
 *
 * @package Cayon
 * @subpackage Functions
 */

(function($){
	
	/** Galaxy Dorp Downs */
	function galaxyMenu() {
		
		$( '.menu1 ul' ).supersubs({			
			
			minWidth: 16,
			maxWidth: 27,
			extraWidth: 1		
		
		}).superfish({		
			
			delay: 100,
			speed: 'fast',
			animation: { opacity:'show', height:'show' },
			//autoArrows: false,
			dropShadows: false
	  
	  });
	  
	}
	
	/** jQuery Document Ready */
	$(document).ready(function(){
		galaxyMenu();
	});

})(jQuery);