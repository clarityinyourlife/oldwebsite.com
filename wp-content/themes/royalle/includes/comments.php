<?php
global $wpdb;
 
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,70) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC LIMIT $number";

$comments = $wpdb->get_results($sql);

foreach ($comments as $comment) {

?>

						<li>
							
								<div class="gravatar">
									<?php echo str_replace( "class='avatar", "class='photo avatar", get_avatar( "$comment->comment_author_email", "37" ) ); ?>
								</div><!-- /.gravatar -->
								
								<div class="body">
								<span>
									<?php echo strip_tags($comment->com_excerpt); ?>
									<?php if ( strlen($comment->com_excerpt) >= 70 ) { echo '...'; } ?>
								</span>
								</div><!-- /.body -->
							
								<div class="author">
									<span><?php _e('Posted by', 'woothemes'); ?> <a href="<?php echo get_permalink($comment->ID) . "#comment-" . $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?>"><?php echo strip_tags($comment->comment_author); ?></a> <?php _e('about', 'woothemes'); ?> <a href="<?php echo get_permalink($comment->ID) . "#comment-" . $comment->comment_ID; ?>" title="Re: <?php echo $comment->post_title; ?>"><?php echo $comment->post_title; ?></a></span>
								</div><!-- /.author -->
								
								<div class="fix"></div>

						</li>

<?php

}
 
?>
