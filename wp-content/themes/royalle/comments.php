<?php
	
	// Do not delete these lines
	
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'woothemes') ?></p>
	
	<?php return; } ?>

<!-- You can start editing here. -->

<div id="comments">
	
	<?php $comments_by_type = &separate_comments($comments); ?>
	
	<?php if ( have_comments() ) : ?>

		<h3><?php comments_number(__('No Comments', 'woothemes'), __('One Comment', 'woothemes'), __('% Comments', 'woothemes') );?></h3>

		<ol class="commentlist">
	
			<?php wp_list_comments('avatar_size=37&callback=custom_comment&type=comment'); ?>
		
		</ol>    

		<div class="navigation">
			<div class="fl"><?php previous_comments_link() ?></div>
			<div class="fr"><?php next_comments_link() ?></div>
			
		</div><!-- /.navigation -->
		    
		<?php if (! empty($comments_by_type['trackback'])) : ?>
    		
        <h3 id="pings"><?php _e('Trackbacks/Pingbacks', 'woothemes') ?></h3>
    
        <ol class="pinglist">
            <?php wp_list_comments('type=pings&callback=list_pings'); ?>
        </ol>
    	
	<?php endif; ?>
    	    	
	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->

		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<p class="nocomments"><?php _e('Comments are closed.', 'woothemes') ?></p>

		<?php endif; ?>

	<?php endif; ?>

</div> <!-- /#comments_wrap -->

<?php if ('open' == $post->comment_status) : ?> 

<div id="respond">
	
	<h3><?php comment_form_title( __('Leave a Comment', 'woothemes'), __('Leave a Reply to %s', 'woothemes') ); ?></h3>
	
	<div class="cancel-comment-reply">
		<small><?php cancel_comment_reply_link(); ?></small>
	</div><!-- /.cancel-comment-reply -->

	<?php if ( get_option('comment_registration') && !$user_ID ) : //If registration required & not logged in. ?>

		<p><?php _e('You must be', 'woothemes') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>" rel="nofollow"><?php _e('logged in', 'woothemes') ?></a> <?php _e('to post a comment.', 'woothemes') ?></p>

	<?php else : //No registration required ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( $user_ID ) : //If user is logged in ?>
			
			<div class="fl">
			
			<p><?php _e('Logged in as', 'woothemes') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Log out of this account', 'woothemes') ?>"><?php _e('Logout', 'woothemes') ?> &raquo;</a></p>
			
			</div>

		<?php else : //If user is not logged in ?>

			<div class="fl">
			
				<p>
					<label for="author"><?php _e('Name', 'woothemes') ?></label><br />
					<input type="text" name="author" class="txt" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
				</p>
	
				<p>
					<label for="email"><?php _e('Email', 'woothemes') ?></label><br />
					<input type="text" name="email" class="txt" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
				</p>
	
				<p>
					<label for="url"><?php _e('Website', 'woothemes') ?></label><br />
					<input type="text" name="url" class="txt" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				</p>
				
				</div>

		<?php endif; // End if logged in ?>

		<!--<p><strong>XHTML:</strong> <?php _e('You can use these tags', 'woothemes'); ?>: <?php echo allowed_tags(); ?></p>-->
		
		<div class="fr">
			
			<p>
				<label for="comment"><?php _e('Your comment', 'woothemes') ?></label>
				
				<textarea name="comment" id="comment" rows="14" cols="50" tabindex="4"></textarea>
			</p>
		
		</div>
		
		<div class="fl" style="margin-right: 20px;">	
			<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Send', 'woothemes') ?>" />
		</div>
		
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>

		</form><!-- /#commentform -->

	<?php endif; // If registration required ?>

	<div style="clear:both"></div>

</div><!-- /#respond -->

<?php endif; // if you delete this the sky will fall on your head ?>
