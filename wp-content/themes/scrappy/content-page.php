<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Scrappy
 * @since Scrappy 1.3
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php edit_post_link( __( 'Edit', 'scrappy' ), '<span class="edit-link">', '</span>' ); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'scrappy' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<span class="media-posted-on">
		<?php edit_post_link( __( 'Edit', 'scrappy' ), '<span class="media-edit-link">', '</span>' ); ?>
	</span>
</article><!-- #post-<?php the_ID(); ?> -->
