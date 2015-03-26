<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.',woothemes); ?></p>

			<?php
			return;
		}
	}

?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>

	<br /><br />

	<h2 id="comments"><?php comments_number(__('0 Comments',woothemes), __('1 Comment',woothemes), __('% Comments',woothemes) );?></h2>
	
	<ol class="commentlist">
	
		<?php if ( have_comments() ) : ?>
									
			<?php wp_list_comments( 'type=comment&callback=custom_comment' ); ?>

		<?php endif; ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.',woothemes); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<br /><br />

<h2 id="respond"><?php _e('Leave a Reply',woothemes); ?></h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be',woothemes); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>" rel="nofollow"><?php _e('logged in',woothemes); ?></a> <?php _e('to post a comment.',woothemes); ?></p>
<?php else : ?>
	
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="clearfix">
	
		<div class="comment-text">
		
			<p>
				<label for="url" class="block"><?php _e('Leave a Message',woothemes); ?></label>
				<textarea name="comment" id="comment" cols="" rows="14" tabindex="4" class="input"></textarea>
			</p>
		
		</div><!-- End comment-text -->
			
		<div class="comment-author">
		
			<small><?php cancel_comment_reply_link(); ?></small>
		
			<?php if ( $user_ID ) : ?>
		
				<p><?php _e('Logged in as',woothemes); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account',woothemes); ?>"><?php _e('Log out',woothemes); ?> &raquo;</a></p>
			
			<?php else : ?>
		
				<p>
					<label for="author" class="block"><?php _e('Name',woothemes); ?> <?php if ($req) echo  __('(required)',woothemes); ?></label>
					<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="32" tabindex="1" class="input" />
				</p>
				
				<p>
					<label for="email" class="block"><?php _e('Mail (will not be published)',woothemes); ?> <?php if ($req) echo  __('(required)',woothemes); ?></label>
					<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="32" tabindex="2" class="input" />
				</p>
				
				<p>
					<label for="url" class="block"><?php _e('Website',woothemes); ?></label>
					<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="32" tabindex="3" class="input" />
				</p>
				
			<?php endif; ?>
		
			<p><input name="submit" type="image" id="submit" src="<?php bloginfo('template_directory'); ?>/images/submit.jpg" tabindex="5" value="" />
			<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			</p>
			
		</div><!-- End comment-author -->
				
		<?php comment_id_fields(); ?><?php do_action('comment_form', $post->ID); ?>
	
	</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
