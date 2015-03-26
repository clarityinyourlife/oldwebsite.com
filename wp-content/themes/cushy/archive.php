<?php get_header(); ?>

	<?php if (have_posts()) : ?>
	
		<?php if ( get_option( 'woo_breadcrumbs' ) == 'true' ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
		
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
			<h2 class="pagetitle"><?php _e('Archive for the',woothemes); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category',woothemes); ?></h2>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2 class="pagetitle"><?php _e('Posts Tagged',woothemes); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2 class="pagetitle"><?php _e('Archive for',woothemes); ?> <?php the_time('F jS, Y'); ?></h2>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2 class="pagetitle"><?php _e('Archive for',woothemes); ?> <?php the_time('F, Y'); ?></h2>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2 class="pagetitle"><?php _e('Archive for',woothemes); ?> <?php the_time('Y'); ?></h2>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2 class="pagetitle"><?php _e('Author Archive',woothemes); ?></h2>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2 class="pagetitle"><?php _e('Blog Archives',woothemes); ?></h2>
		<?php } ?>

	<div id="left-col">
	   
            <?php while (have_posts()) : the_post(); ?>
    			
				<ul class="cat-tabs clearfix">
					<?php 
						foreach( get_the_category() as $cat ) {
							echo '<li class="active"><a href="'. get_category_link( $cat->term_id ) . '">' . $cat->cat_name .'</a></li>';
						} 
					?>
					<li><small><?php the_time('F jS, Y') ?></small></li>
				</ul>
				
				<div class="post-top"></div><!-- End post-top -->
				
                <div class="post" id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    
					<?php the_content( '' ); ?>
					
					<a href="<?php the_permalink(); ?>#more-<?php the_ID(); ?>" class="read-more" title="<?php _e('Read more of',woothemes); ?> &quot;<?php the_title(); ?>&quot;"><?php _e('Read More',woothemes); ?></a>
					
                </div>
    
            <?php endwhile; ?>
    
            <div class="navigation clearfix">
                <div class="left"><?php next_posts_link(__('&laquo; Older Entries',woothemes)) ?></div>
                <div class="right"><?php previous_posts_link(__('Newer Entries &raquo;',woothemes)) ?></div>
            </div>
    
        <?php else : ?>
    
            <h2 class="center"><?php _e('Not Found',woothemes); ?></h2>
            <p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",woothemes); ?></p>
            <?php include (TEMPLATEPATH . "/searchform.php"); ?>
    
        <?php endif; ?>

	</div><!-- End leftcol -->
    
    <div id="right-col">
    
    	<?php get_sidebar(); ?>
    
    </div><!-- End rightcol -->
	
<?php get_footer(); ?>

