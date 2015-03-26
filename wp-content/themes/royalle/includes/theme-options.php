<?php



function woo_options() {
// VARIABLES
$themename = "Royalle";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/';
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


//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

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

$options[] = array( "name" => "General Settings",
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
                                                                                     
$options[] = array( "name" => "Text Title",
					"desc" => "Enable if you want Blog Title and Tagline to be text-based. Setup title/tagline in WP -> Settings -> General.",
					"id" => $shortname."_texttitle",
					"std" => "false",
					"type" => "checkbox");

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
                    
$options[] = array( "name" => "E-Mail URL",
					"desc" => "Enter your preferred E-mail subscription URL. (Feedburner or other)",
					"id" => $shortname."_feedburner_id",
					"std" => "",
					"type" => "text");



$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");
    
$options[] = array( "name" => "Optional Header Navigation",
					"icon" => "nav",
					"type" => "heading"); 
					
$options[] = array(	"name" => "Show Category Navigation",
					"desc" => "Displays a horizontal category navigation menu below the header section.",
					"id" => $shortname."_top_nav",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Swap Category for Page Navigation",
					"desc" => "Swap the top navigation for a page navigation. This navigation menu includes drop-downs.",
					"id" => $shortname."_cat_menu",
					"std" => "false",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Exclude Categories from Navigation",
					"desc" => "Enter a comma-separated list of page/category <a href='http://support.wordpress.com/pages/8/'>ID's</a> that you'd like to exclude from the top navigation. (e.g. 12,23,27,44)",
					"id" => $shortname."_top_nav_exclude",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => "Sidebar Navigation",
					"icon" => "sidebar",
					"type" => "heading"); 
					
$options[] = array( "name" => "Swap Page for Category Navigation",
					"desc" => "Swap the Sidebar Page navigation for a Category navigation. Please note this section does not include drop-down menus.",
					"id" => $shortname."_page_menu",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Exclude Pages from Navigation",
					"desc" => "Enter a comma-separated list of <a href='http://support.wordpress.com/pages/8/'>ID's</a> that you'd like to exclude from the top navigation. (e.g. 12,23,27,44)",
					"id" => $shortname."_sidebar_nav_exclude",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => "Featured Posts",
					"icon" => "featured",
					"type" => "heading"); 
					
$options[] = array(	"name" => "Featured Posts",
					"desc" => "Select the number of featured posts you'd like to display. <br />NOTE: Set total number of posts to show on home page in WordPress admin under Settings -> Reading -> Blog posts to show at most.",
					"id" => $shortname."_featured_posts",
					"std" => "Select a number:",
					"type" => "select",
					"options" => $other_entries); 
					
$options[] = array( "name" => "Excerpt or Content",
					"icon" => "layout",
					"type" => "heading");  

$options[] = array( "name" => "Full Content for Home Page Featured Post/s",
					"desc" => "Show the full content in featured posts on homepage instead of the excerpt.",
					"id" => $shortname."_featured_content",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => "Full Content for Home Page Other Posts",
					"desc" => "Show the full content in other posts on homepage instead of the excerpt.",
					"id" => $shortname."_home_content",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Full Content Archive",
					"desc" => "Show the full content in posts on archive pages instead of the excerpt.",
					"id" => $shortname."_archive_content",
					"std" => "false",
					"type" => "checkbox");  
					
$options[] = array( "name" => "hCard Details",
					"icon" => "misc",
					"type" => "heading");										

$options[] = array( "name" => "Display hCard?",
					"desc" => "Checking this box will display your hCard in the sidebar below the RSS feed. <a href='http://microformats.org/wiki/hcard'>Read more about hCards.</a>",
					"id" => $shortname."_hcard",
					"std" => "false",
					"type" => "checkbox");   

$options[] = array( "name" => "hCard - Your First Name",
					"desc" => "Enter your first name here.",
					"id" => $shortname."_hcard_firstname",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "hCard - Additional Names",
					"desc" => "Enter your additional names here.",
					"id" => $shortname."_hcard_addname",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "hCard - Your Surname",
					"desc" => "Enter your surname here.",
					"id" => $shortname."_hcard_surname",
					"std" => "",
					"type" => "text");			

$options[] = array( "name" => "hCard - Street Address",
					"desc" => "Enter your street address here.",
					"id" => $shortname."_hcard_street",
					"std" => "",
					"type" => "text");						

$options[] = array( "name" => "hCard - City",
					"desc" => "Enter the name of your city here.",
					"id" => $shortname."_hcard_city",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "hCard - Region / Province",
					"desc" => "Enter your region here.",
					"id" => $shortname."_hcard_region",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => "hCard - Postal Code",
					"desc" => "Enter your postal code here.",
					"id" => $shortname."_hcard_postal",
					"std" => "",
					"type" => "text");							

$options[] = array( "name" => "hCard - Country",
					"desc" => "Enter your country here.",
					"id" => $shortname."_hcard_country",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => "hCard - Telephone Number",
					"desc" => "Enter your telephone number here.",
					"id" => $shortname."_hcard_tel",
					"std" => "",
					"type" => "text");					

$options[] = array( "name" => "hCard - E-mail Address",
					"desc" => "Enter your e-mail address here.",
					"id" => $shortname."_hcard_email",
					"std" => "",
					"type" => "text");		
					
$options[] = array( "name" => "Dynamic Images",
					"type" => "heading",
					"icon" => "image");    
				    				   
$options[] = array( "name" => 'Dynamic Image Resizing',
					"desc" => "",
					"id" => $shortname."_wpthumb_notice",
					"std" => 'There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>WP Post Thumbnail</strong> or <strong>TimThumb - Custom Settings panel</strong>. We recommend using WP Post Thumbnail option.',
					"type" => "info");					

$options[] = array( "name" => "WP Post Thumbnail",
					"desc" => "Use WordPress post thumbnail to assign a post thumbnail. Will enable the <strong>Featured Image panel</strong> in your post sidebar where you can assign a post thumbnail.",
					"id" => $shortname."_post_image_support",
					"std" => "true",
					"class" => "collapsed",
					"type" => "checkbox" );

$options[] = array( "name" => "WP Post Thumbnail - Dynamic Image Resizing",
					"desc" => "The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>",
					"id" => $shortname."_pis_resize",
					"std" => "true",
					"class" => "hidden",
					"type" => "checkbox" );

$options[] = array( "name" => "WP Post Thumbnail - Hard Crop",
					"desc" => "The post thumbnail will be cropped to match the target aspect ratio (only used if 'Dynamic Image Resizing' is enabled).",
					"id" => $shortname."_pis_hard_crop",
					"std" => "true",
					"class" => "hidden last",
					"type" => "checkbox" );

$options[] = array( "name" => "TimThumb - Custom Settings Panel",
					"desc" => "This will enable the <a href='http://code.google.com/p/timthumb/'>TimThumb</a> (thumb.php) script which dynamically resizes images added through the <strong>custom settings panel below the post</strong>. Make sure your themes <em>cache</em> folder is writable. <a href='http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/'>Need help?</a>",
					"id" => $shortname."_resize",
					"std" => "true",
					"type" => "checkbox" );

$options[] = array( "name" => "Automatic Image Thumbnail",
					"desc" => "If no thumbnail is specifified then the first uploaded image in the post is used.",
					"id" => $shortname."_auto_img",
					"std" => "false",
					"type" => "checkbox" );
					                    
$options[] = array( "name" => "Featured Image (homepage)",
					"desc" => "Enter an integer value for the desired sizes which will be used when dynamically creating the featured images. Default size: 595 by 155 pixels. Recommended to leave as is because the background image styling is set for these sizes",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(
											'id' => $shortname. '_image_width',
											'type' => 'text',
											'std' => 595,
											'meta' => 'Width'
											),
									array(
											'id' => $shortname. '_image_height',
											'type' => 'text',
											'std' => 155,
											'meta' => 'Height'
											)
								  )
					   );  

$options[] = array(	"name" => "Ads - Sidebar Widget (125x125)",
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
			"label" 	=> "Image",
			"type" 		=> "upload",
			"desc"      => "Enter the URL for image to be used by the Dynamic Image resizer."
		),
		"embed" => array (
			"name"		=> "embed",
			"std" 	    => "",
			"label" 	=> "Video Embed Code",
			"type" 		=> "textarea",
			"desc"      => "Paste the embed code for your video here. Video will be resized automatically. Note: You need to tag this post with 'video' in order to work with the Woo - Video Player widget.",
			"input"     => "textarea"
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