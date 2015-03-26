<?php
//Categories
function inc_cats() {

		$categories = get_categories('hide_empty=0');
		$categories = array();
		$inc = '';
		$counter = 0;
		
		foreach ($categories as $cat) {
			
			$counter++;
			$inc .= $cat->cat_ID;
			
			if ( $counter <> count($categoires) ) { $inc .= ','; }
		
		}
		
		echo $inc;
	
}	

//Popular Posts
function popular_posts() {
	
	global $wpdb;
	if (empty($pop_posts) || $pop_posts < 1) $pop_posts = 5;
	$popularposts = "SELECT ID,post_title FROM {$wpdb->prefix}posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY comment_count DESC LIMIT 0,".$pop_posts;
$posts = $wpdb->get_results($popularposts);
	
	if($posts){
		foreach($posts as $post){
			$post_title = stripslashes($post->post_title);
			$guid = get_permalink($post->ID);
			$popular .= '<li><a href="'.$guid.'" title="'.$post_title.'">'.$post_title.'</a></li>';
		}
	}
	
	echo $popular;
}

//Recent Comments
function recent_comments() {
	global $wpdb;
 
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
				comment_post_ID, comment_author, comment_date_gmt, comment_approved,
				comment_type,comment_author_url,
				SUBSTRING(comment_content,1,50) AS com_excerpt
				FROM $wpdb->comments
				LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
				$wpdb->posts.ID)
				WHERE comment_approved = '1' AND comment_type = '' AND
				post_password = ''
				ORDER BY comment_date_gmt DESC LIMIT 5";

	$comments = $wpdb->get_results($sql);
	$output = $pre_HTML;

	foreach ($comments as $comment) {

		$output .= "\n
		<li>"."<a href=\"" . get_permalink($comment->ID) .
		"#comment-" . $comment->comment_ID . "\" title=\"on " .
		$comment->post_title . "\">" .strip_tags($comment->comment_author)
		.": " . strip_tags($comment->com_excerpt)
		."...</a></li>
		";
		
	}

	$output .= $post_HTML;
 
	echo $output; 
}

/*-----------------------------------------------------------------------------------*/
/* WordPress 3.0 New Features Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu' ) ) );
	register_nav_menus( array( 'archive-menu' => __( 'Archive Menu' ) ) );
} 

?>