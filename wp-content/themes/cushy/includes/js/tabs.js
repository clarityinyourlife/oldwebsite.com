jQuery(document).ready(function(){
		jQuery('#features div').hide(); // Hide all divs
		jQuery('#features div:first').show(); // Show the first div
		jQuery('#features div:first div').show();
		jQuery('#features-tabs li:first').addClass('active'); // Set the class of the first link to active
		jQuery('#features-tabs li a').click(function(){ //When any link is clicked
		jQuery('#features-tabs li').removeClass('active'); // Remove active class from all links
		jQuery(this).parent().addClass('active'); //Set clicked link class to active
		var currentTab = jQuery(this).attr('href'); // Set variable currentTab to value of href attribute of clicked link
		jQuery('#features div').hide(); // Hide all divs
		jQuery('#features div div').show();
		jQuery(currentTab).show(); // Show div with id equal to variable currentTab
		return false;
		});
		});