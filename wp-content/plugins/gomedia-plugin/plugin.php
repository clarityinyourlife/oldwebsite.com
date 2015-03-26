<?php
/*
Plugin Name: GoMedia Support
Plugin URI: http://gomedia.com.au
Description:  The GoMedia plugin adds a support widget to your WordPress Dashboard. See also: <a href="http://gomedia.com.au/supportportal/">GoMedia Support</a> for further support.
Version: 1.4.4
Author: gomedia.com.au
Author URI: http://gomedia.com.au
*/

/*---------------------------------
	    Plugin Updater
------------------------------------*/

//custom updates/upgrades
require 'plugin-updates/plugin-update-checker.php';
$ExampleUpdateChecker = new PluginUpdateChecker(
	'http://gomediaglobal.com/dev/wordpress/plugin/gomedia-support-info.json', 
	__FILE__,
	'gomedia-plugin'
);

//custom updates/upgrades
$this_file = __FILE__;
$update_check = "http://gomediaglobal.com/dev/wordpress/plugin/gomedia-support.upd";
require_once('updater.php');


// WP Admin Menu

function wpm_add_pages() {
	 add_menu_page('GoMedia Help', 'GoMedia Help', 0, __FILE__, 'wpm_toplevel_page', plugins_url('gomedia-plugin/images/vum-logo.png'),'3.127453' );
	 add_submenu_page(__FILE__, 'Videos', 'Videos', 0, __FILE__, 'wpm_toplevel_page');
	 add_submenu_page(__FILE__, 'User Manual', 'User Manual', 0, 'online-manual', 'wpm_online_manual');   
	 #$wpm_administration = add_submenu_page(__FILE__, 'Manual Options', 'Manual Options', 10, 'manual-options', 'wpm_admin');	 


	$wpm_help = "support@gomedia.com.au";
	
	add_contextual_help($wpm_administration, $wpm_help);

}
add_action('admin_menu', 'wpm_add_pages');

// Include Subpages
include('videos.php');
include('manual.php');
include('admin-page.php');

function showMessage($message, $errormsg = false)
{
	if ($errormsg) {
		echo '<div id="message" class="error">';
	}
	else {
		echo '<div id="message" class="updated fade gomedia-message" >';
	}

	echo "<h4><strong>$message</strong></h4></div>";
} 

function showAdminMessages()
{
       showMessage('<div class="gomedia-message-text">Hi! How exciting.. lets get started with your new website </div><div class="gomedia-message-buttam"><a href="' . get_option( 'siteurl' ) . '/wp-admin/admin.php?page=gomedia-plugin/plugin.php" class="gomedia-message-button">Start Here!!</a></div><div style="clear:both;"></div>');
}

add_action('admin_notices', 'showAdminMessages');



function help_status_init() {
    // disable help bar
	if(get_option("help_status") == "1"){
    	remove_action( 'admin_notices', 'showAdminMessages');
    }            
}    
 
add_action('init', 'help_status_init' );

if ('saveDB' == $_POST['action']) {
	update_option("help_status",$_POST['help_status']);
}

add_option("help_status","");

// Create the function to output the contents of our Dashboard Widget

function gomedia_dashboard_widget_function() {
	// Display whatever it is you want to show
	echo '
	<style>
 .inside{font-size:12px;padding-top:20px;} span.sub{font-style:italic;font-family:Georgia,"Times New Roman","Bitstream Charter",Times,serif;padding:0px 10px 5px 15px;color:#777;font-size:13px;} .table{margin:0 -9px;padding:0 10px;position:relative;} .table_content{float:left;width:45%;} .table_discussion{float:right;width:45%;} table td{padding:3px 0;white-space:nowrap;} table tr.first td{border-top:none;} td.b{padding-right:6px;text-align:right;font-family:Georgia,"Times New Roman","Bitstream Charter",Times,serif;font-size:14px;width:1%;} td.b a{font-size:18px;} td.b a:hover{color:#d54e21;} .t{font-size:12px;padding-right:12px;padding-top:6px;color:#777;} .t a{white-space:nowrap;} .versions{padding:6px 10px 12px;clear:left;} .versions .b{font-weight:bold;}
</style>

	<div class="table table_content"> 
    <span class="sub">GoMedia Tutorials</span> 
        <table style="border-top:#ececec 1px solid; width:90%; margin-top:7px;">
		<tr> 
        <td class="first"><img src="../wp-content/plugins/gomedia-plugin/images/get-started.png" width="15" height="15" /></td>
        <td class="t posts"><a href="http://gomedia.com.au/tutorial/get-started/" target="_blank">Getting Started</a></td>
        </tr>
        <tr> 
        <td class="first"><img src="../wp-content/plugins/gomedia-plugin/images/wordpress.png" width="15" height="15" /></td>
        <td class="t posts"><a href="http://gomedia.com.au/tutorial/wordpress/" target="_blank">WordPress Tutorials</a></td>
        </tr>
        <tr>
        <td class="first"><img src="../wp-content/plugins/gomedia-plugin/images/ftp.png" width="15" height="15" /></td>
        <td class="t pages"><a href="http://gomedia.com.au/tutorial/ftp/" target="_blank">FTP Tutorials</a></td>
        </tr>
        <tr>
        <td class="first"><img src="../wp-content/plugins/gomedia-plugin/images/cpanel.png" width="15" height="15" /></td>
        <td class="t cats"><a href="http://gomedia.com.au/tutorial/cpanel/" target="_blank">Cpanel Tutorials</a></td>
        </tr>
        </table> 
</div> 
<div class="table table_discussion"> 
    <span class="sub">GoMedia Support</span> 
        <table style="border-top:#ececec 1px solid; width:90%; margin-top:7px;"> 
        <tr class="first">
        <td class="b b-comments"><img src="../wp-content/plugins/gomedia-plugin/images/support.png" width="15" height="15" /></td>
        <td class="last t"><a href="http://gomedia.com.au/support/" target="_blank">GoMedia Support</a></td>
        </tr>
        <tr>
        <td class="b b-comments"><img src="../wp-content/plugins/gomedia-plugin/images/knowledge.png" width="15" height="15" /></td>
        <td class="last t"><a href="http://secure.gomedia.com.au/knowledgebase.php" target="_blank">Knowledgebase</a></td>
        </tr> 
        <tr>
        <td class="b b-comments"><img src="../wp-content/plugins/gomedia-plugin/images/ticket.png" width="15" height="15" /></td>
        <td class="last t"><a href="http://secure.gomedia.com.au/supporttickets.php" target="_blank">Support Tickets</a></td>
        </tr> 
        <tr>
        <td class="b b-comments"><img src="../wp-content/plugins/gomedia-plugin/images/clientarea.png" width="15" height="15" /></td>
        <td class="last t"><a href="http://secure.gomedia.com.au/clientarea.php" target="_blank">Client Area</a></td>
        </tr> 
        </table> 
</div> 
			
<div class="versions"> 
<p><span class="b"><a href="/wp-admin/admin.php?page=gomedia-plugin/plugin.php">GoMedia Support Guide</a></span></p>
<p>Visit <span class="b"><a href="http://gomedia.com.au">GoMedia</a></span> for more information.</p>
<br class="clear" />
</div>
	
	';
} 

/*---------------------------------
	Custom login logo
------------------------------------*/

function gomedia_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.plugins_url('gomedia-plugin/images/logo-plugin.png').') !important; }
    </style>';
}
add_action('login_head', 'gomedia_login_logo');


// Create the function use in the action hook

function gomedia_add_dashboard_widgets() {
	wp_add_dashboard_widget('gomedia_dashboard_widget', 'GoMedia Help and Support', 'gomedia_dashboard_widget_function');	
} 

// Hook into the 'wp_dashboard_setup' action to register our other functions

add_action('wp_dashboard_setup', 'gomedia_add_dashboard_widgets' );
?>