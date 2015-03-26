<?php
// Fist full of comments
function custom_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
                 
		<li <?php comment_class( 'clearfix' ); ?> id="comment-<?php comment_ID() ?>">
			
			<div class="clearfix" style="margin-bottom:20px;">

				<div class="comment-author clearfix">
				
					<div class="gravatar">
						<?php echo get_avatar( $comment, 48 ); ?>
					</div>
					<div class="author-info">
						
						<h3 class="inline"><?php comment_author_link() ?></h3>
						<p><?php comment_date('F jS, Y') ?> <?php _e('at',woothemes); ?> <?php comment_time() ?></p>
						
						<p class="comment-type"><?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
						
					</div>
					
				</div><!-- End comment-author -->			
			
				<div class="comment-text">
				
					<?php if ($comment->comment_approved == '0') : ?>
						<em><?php _e('Your comment is awaiting moderation.',woothemes); ?></em>
					<?php endif; ?>
				
					<?php comment_text() ?>
					
				</div><!-- End comment-text -->
				
			</div>
			<?php  /*  The following are the pingback template. Will cause styling issues with odd and even styling due to threading.
        }  else {
               ?>
               <li <?php comment_class(); ?>>
                       
                    <div class="comment_head cl">
                        
                        <div class="user_meta" style="margin:0">
                            <p class="name"><strong><?php the_commenter_link() ?></strong></p>
                        </div>
                    </div>
                    <div class="comment_entry">
                        <?php comment_text() ?><?php edit_comment_link('Edit', ' <span class="edit-link">(', ')</span>');?>
                    </div>

                    <?php }*/ 
}

function the_commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( ']* class=[^>]+>', $commenter ) ) {$commenter = ereg_replace( '(]* class=[\'"]?)', '\\1url ' , $commenter );
    } else { $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );}
    echo $commenter ;
}

function the_commenter_avatar() {
    $email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( "$email", "32" ) );
    echo $avatar;
}

?>