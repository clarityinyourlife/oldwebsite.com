$qube(function() {
	var siteWidth = $qube('#mainWrapper').width();
	var contentWidth = ($qube('#contentWrapper').width() / siteWidth) * 100;
	if(siteWidth < '700'){ contentWidth -= 8; }
	else if(siteWidth > '900'){ contentWidth -= 2; }
	else { contentWidth -= 4; }
	$qube('#sidebarWrapper').css({float: 'none', display: 'none'});
	$qube('#contentWrapper').css({float: 'none', width: 'auto'});
	$qube('#content').css({float: 'right', width: contentWidth + '%'});
	$qube('#contentSidebar').css({float: 'left', display: 'block'});
	$qube('.lowerHeader').css({'margin-bottom': '20px'});
	$qube('#sidebarWrapper .sideHeader script').remove();
	$qube('#sidebarWrapper .sideHeader').appendTo('#contentSidebar');
	$qube('#sidebarWrapper .sidebar script').remove();
	$qube('#sidebarWrapper .sidebar').appendTo('#contentSidebar');
	$qube('#extraContainer4').css({'margin-bottom': '20px'});
	$qube('#extraContainer5').css({'margin-top': '20px', 'margin-bottom': '10px'});
	$qube('#extraContainer6').css({'margin-top': '20px', 'margin-bottom': '10px'});
	$qube('#extraContainer7').css({'margin-top': '20px', 'margin-bottom': '10px'});
});