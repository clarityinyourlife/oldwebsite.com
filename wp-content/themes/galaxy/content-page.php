<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <?php $entry_title = ( galaxy_post_edit_link() == "" )? 'entry-title entry-title-page' : 'entry-title'; ?>
  <h1 class="<?php echo $entry_title; ?>"><?php the_title(); ?></h1>
  
  <?php if ( galaxy_post_edit_link() != "" ) : ?>  
  <div class="entry-meta"> 
    <?php echo galaxy_post_edit_link(); ?> 
  </div>  
  <?php endif;?>
  
  <div class="entry-content">
  	<?php the_content(); ?>
	<div class="clear"></div>				
  </div> <!-- end .entry-content -->
  
  <?php echo galaxy_link_pages(); ?>
  
</div> <!-- end #post-<?php the_ID(); ?> .post_class -->

<?php comments_template( '', true ); ?>