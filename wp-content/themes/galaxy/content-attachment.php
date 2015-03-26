<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h1 class="entry-title"><?php the_title(); ?></h1>
  
  <div class="entry-meta">
    
	<?php if ( 'post' == get_post_type() ) : ?>
	<?php echo galaxy_post_date() . galaxy_post_comments() . galaxy_post_author(); ?>
    <?php if ( is_sticky() ) : _e( 'Featured', 'galaxy' ); endif; ?>
    <?php endif; ?>      
    
	<?php echo galaxy_post_edit_link(); ?>
  
  </div><!-- .entry-meta -->
  
  <?php galaxy_loop_nav_singular(); ?>
  
  <div class="entry-content entry-attachment">
  	<p><a href="<?php echo wp_get_attachment_url( $post->ID ); ?>" target="_blank"><?php echo wp_get_attachment_image( $post->ID, 'large', false, array( 'class' => 'attachment-large aligncenter' ) ); ?></a></p>
    <?php the_excerpt(); ?>
	<div class="clear"></div>				
  </div> <!-- end .entry-content -->
  
  <?php echo galaxy_link_pages(); ?>
  
  <?php if ( 'post' == get_post_type() ) : ?>
  <div class="entry-meta-bottom">
  <?php echo galaxy_post_category() . galaxy_post_tags(); ?>
  </div><!-- .entry-meta -->
  <?php endif; ?>     

</div> <!-- end #post-<?php the_ID(); ?> .post_class -->

<?php galaxy_loop_nav_singular_attachment(); ?>

<?php comments_template( '', true ); ?>