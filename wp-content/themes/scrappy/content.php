<?php
/**
 * @package Scrappy
 * @since Scrappy 1.3
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<div class="post-date">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to' , 'scrappy' ); ?> <?php the_title_attribute(); ?>">
				<span class="post-month"><?php the_time( 'M' ); ?></span>
				<span class="post-day"><?php the_time( 'j' ); ?></span>
				<span class="post-year"><?php the_time( 'Y' ); ?></span>
				</a>
			</div>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'scrappy' ), '<span class="edit-link">', '</span>' ); ?>
		<?php if ( has_post_thumbnail() ) {
			echo "<div class='post-thumbnail'>";
				echo "<a href=\"" . get_permalink() . "\">";
				the_post_thumbnail();
				echo "</a>";
			echo "</div>";
		} ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'scrappy' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php if ( 'post' == get_post_type() ) : ?>
			<span class="media-posted-on">
				<?php scrappy_posted_on(); ?>
				<?php edit_post_link( __( 'Edit', 'scrappy' ), '<span class="sep"> | </span><span class="media-edit-link">', '</span>' ); ?>
			</span>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'scrappy' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'scrappy' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'scrappy' ) );
				if ( $categories_list && scrappy_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'scrappy' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'scrappy' ) );
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( 'Tagged %1$s', 'scrappy' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'scrappy' ), __( '1 Comment', 'scrappy' ), __( '% Comments', 'scrappy' ) ); ?></span>
		<?php endif; ?>

	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
<hr />
