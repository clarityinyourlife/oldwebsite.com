<?php
function woo_options() {
// VARIABLES
$themename = "VibrantCMS";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/vibrantcms/';
$shortname = "woo";

$GLOBALS['template_path'] = get_bloginfo('template_directory');

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options


$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$steps = array("1., 2., 3.","01., 02., 03.","1 >, 2 >, 3 >","01 >, 02 >, 03 >","Step 01 >,Step 02 >,Step 03 >",);
$layouts = array("default.php","blog.php");

// THIS IS THE DIFFERENT FIELDS
$options = array();   

$options[] = array(	"name" => "General Settings",
						"type" => "heading");

$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify an image URL directly.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
                                                                                     
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feedburner_url",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => "Navigation Options",
					"type" => "heading");    

$options[] = array( "name" => "Header - Category Navigation",
					"desc" => "Swap the Page navigation for a Category navigation. ",
					"id" => $shortname."_cat_menu",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Header - Exclude Pages or Categories from Navigation",
					"desc" => "Enter a comma-separated list of <a href='http://support.wordpress.com/pages/8/'>ID's</a> that you'd like to exclude from the top navigation. (e.g. 12,23,27,44)",
					"id" => $shortname."_nav_exclude",
					"std" => "",
					"type" => "text"); 			    												    									

$options[] = array(	"name" => "Front Page Layout",
						"type" => "heading");			

$options[] = array(	"name" => "Featured Pages",
						"desc" => "Enter a comma-separated list of the page ID's that you'd like to display in the featured slider.",
						"id" => $shortname."_featpages",
						"std" => "",
						"type" => "text");

$options[] = array(	"name" => "Featured Steps Format",
						"desc" => "Select the format you'd like to use for the featured steps.",
					    "id" => $shortname."_steps",
					    "std" => "1., 2., 3.",
					    "type" => "select",
					    "options" => $steps);													
						
$options[] = array(	"name" => "Front Page Layout",
						"desc" => "Choose the layout of to be used for the other entries on your homepage.",
			    		"id" => $shortname."_layout",
			    		"std" => "default.php",
			    		"type" => "select",
			    		"options" => $layouts);		    		

$options[] = array(	"name" => "Extended Footer",
						"type" => "heading");
						
$options[] = array(	"name" => "Enable Extended Footer",
						"desc" => "If checked, this option will enable Extended Footer.",
						"id" => $shortname."_extended_footer",
						"std" => "true",
						"type" => "checkbox");							
						
$options[] = array(	"name" => "About Section",
						"desc" => "Enter the ID of the page in this section.",
						"id" => $shortname."_about",
						"std" => "",
						"type" => "select",
						"options" => $woo_pages);

$options[] = array(	"name" => "Contact Section",
						"desc" => "Enter the ID of the page in this section.",
						"id" => $shortname."_contact",
						"std" => "",
						"type" => "select",
						"options" => $woo_pages);						

$options[] = array(	"name" => "Blog Settings",
						"type" => "heading");																												

$options[] = array(	"name" => "Add Blog Link to Main Navigation?",
						"desc" => "If checked, this option will add a blog link to your main navigation next to the Home link.",
						"id" => $shortname."_blog",
						"std" => "false",
						"type" => "checkbox");																									
$options[] = array( 	"name" => "Blog Permalink",
					   	"desc" => "Please enter the permalink to your blog parent category (i.e. <home url ignored>/category/blog/).",
						"id" => $shortname."_blogcat",
						"std" => "",
						"type" => "text");

$options[] = array(	"name" => "Show sidebar tabber on blog pages?",
						"desc" => "Check this box if you wish to show the sidebar tabber on the blog pages.",
						"id" => $shortname."_tabber",
						"std" => "false",
						"type" => "checkbox");															

$options[] = array(	"name" => "Banner Ad Management (336x280 MPU)",
						"type" => "heading");

$options[] = array(	"name" => "Display 336x280 MPU",
						"desc" => "Check this box if you wish to display the 336x280 MPU in the sidebar.",
						"id" => $shortname."_show_mpu",
						"std" => "false",
						"type" => "checkbox");

$options[] = array(	"name" => "336x280 Block Ad - Image Location",
						"desc" => "Enter the URL for this block ad.",
						"id" => $shortname."_block_image",
						"std" => $template_path . "/images/ad336.jpg",
						"type" => "text");
						
$options[] = array(	"name" => "336x280 Block Ad - Destination",
						"desc" => "Enter the URL where this block ad points to.",
			    		"id" => $shortname."_block_url",
						"std" => "http://www.woothemes.com",
			    		"type" => "text");
						
$options[] = array(	"name" => "Banner Ad Management (468x60 Banner)",
						"type" => "heading");

$options[] = array(	"name" => "Display 468x60 Banner",
						"desc" => "Check this box if you wish to enable the 468x60 ad below first post in blog.",
						"id" => $shortname."_show_ad",
						"std" => "false",
						"type" => "checkbox");

$options[] = array(	"name" => "468x60 Ad - Image Location",
						"desc" => "Enter the URL for this block ad.",
						"id" => $shortname."_ad_below_image",
						"std" => $template_path . "/images/ad468.jpg",
						"type" => "text");
						
$options[] = array(	"name" => "468x60 Ad - Destination",
						"desc" => "Enter the URL where this block ad points to.",
			    		"id" => $shortname."_ad_below_url",
						"std" => "http://www.woothemes.com",
			    		"type" => "text");                                            

// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);

                                     
// Woo Metabox Options
                    

$woo_metaboxes = array(

        "image" => array (
            "name" => "image",
            "label" => "Image",
            "type" => "upload",
            "desc" => "Upload file here..."
        ),  
		"top" => array (
			"name"		=> "top",
			"default" 	=> "",
			"label" 	=> "Top",
			"type" 		=> "text",
			"desc"      => "Enter a number i.e. 100. This value you specify will be the amount of pixels that the image will be be moved downwards."
		),
		"left" => array (
			"name"		=> "left",
			"default" 	=> "",
			"label" 	=> "Left",
			"type" 		=> "text",
			"desc"      => "Enter a number i.e. 30. This value you specify will be the amount of pixels that the image will be be moved to the right"
		)
		
    );
    
// Add extra metaboxes through function
if ( function_exists("woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
    
if ( get_option('woo_custom_template') != $woo_metaboxes) update_option('woo_custom_template',$woo_metaboxes);      

/*
function woo_update_options(){
        $options = get_option('woo_template',$options);  
        foreach ($options as $option){
            update_option($option['id'],$option['std']);
        }   
}

function woo_add_options(){
        $options = get_option('woo_template',$options);  
        foreach ($options as $option){
            update_option($option['id'],$option['std']);
        }   
}


//add_action('switch_theme', 'woo_update_options'); 
if(get_option('template') == 'wooframework'){       
    woo_add_options();
} // end function 
*/


}

add_action( 'admin_head','woo_options' );  

?>