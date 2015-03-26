<?php galaxy_featured_image(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <?php $entry_title = ( 'page' == get_post_type() && galaxy_post_edit_link() == "" )? 'entry-title entry-title-page' : 'entry-title'; ?>
  <h1 class="<?php echo $entry_title; ?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
  
  <?php if ( 'post' == get_post_type() ) : ?>
  
  <div class="entry-meta">    
	<?php echo galaxy_post_date() . galaxy_post_comments() . galaxy_post_author(); ?>
    <?php if ( is_sticky() ) : printf( '<span class="entry-meta-sep"> &sdot; </span> <span class="entry-meta-featured">%1$s</span>', __( 'Featured', 'galaxy' ) ); endif; ?>    
	<?php echo galaxy_post_edit_link(); ?>  
  </div><!-- .entry-meta -->
  
  <?php elseif ( 'page' == get_post_type() && galaxy_post_edit_link() != "" ) : ?>
  
  <div class="entry-meta"> 
    <?php echo galaxy_post_edit_link(); ?> 
  </div>
  
  <?php endif;?>  
  
  <div class="entry-content">
  	<?php galaxy_post_style(); ?>
  <div class="clear"></div>
  </div> <!-- end .entry-content -->
  
  <?php echo galaxy_link_pages(); ?>
  
  <div class="entry-meta-bottom">
  <?php if ( 'post' == get_post_type() ) : ?>  
  <?php echo galaxy_post_category() . galaxy_post_tags(); ?>  
  <?php endif; ?>
  </div><!-- .entry-meta-bottom -->

</div> <!-- end #post-<?php the_ID(); ?> .post_class -->