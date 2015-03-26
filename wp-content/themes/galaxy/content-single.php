<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h1 class="entry-title"><?php the_title(); ?></h1>
  
  <div class="entry-meta">
    
	<?php if ( 'post' == get_post_type() ) : ?>
	<?php echo galaxy_post_date() . galaxy_post_comments() . galaxy_post_author(); ?>
    <?php if ( is_sticky() ) : _e( 'Featured', 'galaxy' ); endif; ?>
    <?php endif; ?>      
    
	<?php echo galaxy_post_edit_link(); ?>
  
  </div><!-- .entry-meta -->
  
  <div class="entry-content">
  	<?php the_content(); ?>
	<div class="clear"></div>				
  </div> <!-- end .entry-content -->
  
  <?php echo galaxy_link_pages(); ?>
  
  <?php if ( 'post' == get_post_type() ) : ?>
  <div class="entry-meta-bottom">
  <?php echo galaxy_post_category() . galaxy_post_tags(); ?>
  </div><!-- .entry-meta -->
  <?php endif; ?>     

</div> <!-- end #post-<?php the_ID(); ?> .post_class -->

<?php galaxy_author(); ?> 

<?php comments_template( '', true ); ?>