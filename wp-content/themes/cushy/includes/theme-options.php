<?php

function woo_options() {

// VARIABLES
$themename = "Cushy";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/cushy/';
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

// THIS IS THE DIFFERENT FIELDS
$options = array();   

// THIS IS THE DIFFERENT FIELDS
	$options[] = array(	"name" => "General Settings",
					"icon" => "general",
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

$options[] = array( "name" => "Contact Form E-Mail",
					"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting 'Contact Form' as page template.",
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array(	"name" => "Navigation Settings",
					"icon" => "nav",
					"type" => "heading");

$options[] = array(	"name" => "Exclude pages from top navigation",
					"desc" => "Enter a comma-separated list of the <a href='http://support.wordpress.com/pages/8/'>Page ID's</a> that you'd like to exclude from the main navigation. (e.g. 1,2,3,4).",
					"id" => $shortname."_pages_ex",
					"std" => "",
					"type" => "text");			

$options[] = array(	"name" => "Use Breadcrumbs?",
					"desc" => "Check this box if you'd like to enable the use of breadcrumbs.",
					"id" => $shortname."_breadcrumbs",
					"std" => "false",
					"type" => "checkbox");															

$options[] = array(	"name" => "Blog Setup",
					"icon" => "main",
					"type" => "heading");					
						
$options[] = array(	"name" => "Blog Category",
					"desc" => "Posts in this category will be shown as \"Recent News\" on the homepage.",
					"id" => $shortname."_blog_cat",
					"std" => "",
					"type" => "select",
					"options" => $woo_categories );

$options[] = array(	"name" => "Blog Permalink",
					"desc" => "Please enter the permalink to your blog parent category (i.e. <home url ignored>/category/blog/).",
					"id" => $shortname."_blog_permalink",
					"std" => "",
					"type" => "text");					

$options[] = array(	"name" => "Custom Homepage Settings",
					"icon" => "homepage",
					"type" => "heading");					
					
$options[] = array(	"name" => "Featured Page",
					"desc" => "The information in this page will be loaded into the homepage and displayed at the top.",
					"id" => $shortname."_features_page",
					"std" => "",
					"type" => "select",
					"options" => $woo_pages );	
	
$options[] = array(	"name" => "Featured Pages Tabber",
					"desc" => "Enter a comma-separated list of the <a href='http://support.wordpress.com/pages/8/'>Page ID's</a> that you'd like to include in the featured tabber on the custom homepage. (e.g. 1,2,3,4).",
					"id" => $shortname."_featured_tabs",
					"std" => "",
					"type" => "text");
					
$options[] = array(	"name" => "Banner Ads Sidebar - Widget (125x125)",
					"icon" => "ads",
					"type" => "heading");

$options[] = array(	"name" => "Rotate banners?",
					"desc" => "Check this to randomly rotate the banner ads.",
					"id" => $shortname."_ads_rotate",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array(	"name" => "Banner Ad #1 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_1",
					"std" => "http://www.woothemes.com/ads/125x125b.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #1 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_1",
					"std" => "http://www.woothemes.com",
					"type" => "text");						

$options[] = array(	"name" => "Banner Ad #2 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_2",
					"std" => "http://www.woothemes.com/ads/125x125b.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #2 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_2",
					"std" => "http://www.woothemes.com",
					"type" => "text");

$options[] = array(	"name" => "Banner Ad #3 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_3",
					"std" => "http://www.woothemes.com/ads/125x125b.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #3 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_3",
					"std" => "http://www.woothemes.com",
					"type" => "text");

$options[] = array(	"name" => "Banner Ad #4 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_4",
					"std" => "http://www.woothemes.com/ads/125x125b.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #4 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_4",
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
			"name"		=> "image",
			"default" 	=> "",
			"label" 	=> "Image URL",
			"type" 		=> "upload",
			"desc"      => "Upload your image with 'Add Media' above post window, copy the url and paste it here."
		),
		"caption" => array (
			"name"		=> "image_caption",
			"default" 	=> "",
			"label" 	=> "Image Caption",
			"type" 		=> "text",
			"desc"      => "Add a caption to the image."
		),
		"excerpt" => array (
			"name"		=> "excerpt",
			"default" 	=> "",
			"label" 	=> "Excerpt for pages",
			"type" 		=> "textarea",
			"desc"      => "Add your excerpt for the Featured Page Section or Featured Tabs on the Custom Homepage."
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