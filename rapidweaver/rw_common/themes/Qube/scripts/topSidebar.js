$qube(function() {
	$qube('#sidebarWrapper').css({float: 'none', display: 'none'});
	$qube('#contentWrapper').css({float: 'none', width: 'auto'});
	$qube('#topSidebarWrapper').css({display: 'block', 'margin-bottom': '20px'});
	$qube('.lowerHeader').css({'margin-bottom': '20px'});
	$qube('#sidebarWrapper .sideHeader script').remove();
	$qube('#sidebarWrapper .sideHeader').appendTo('#topSidebarWrapper');
	$qube('#sidebarWrapper .sidebar script').remove();
	$qube('#sidebarWrapper .sidebar').appendTo('#topSidebarWrapper');
	$qube('#extraContainer4').css({'margin-bottom': '20px'});
	$qube('#extraContainer5').css({'margin-top': '20px', 'margin-bottom': '10px'});
	$qube('#extraContainer6').css({'margin-top': '20px', 'margin-bottom': '10px'});
	$qube('#extraContainer7').css({'margin-top': '20px', 'margin-bottom': '10px'});
});