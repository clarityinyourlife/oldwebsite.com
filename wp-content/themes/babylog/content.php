<?php
/**
 * @package Babylog
 * @since Babylog 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'babylog' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php
			if ( is_sticky() ) {
				printf( __( '<a class="sticky-permalink" href="%1$s" rel="bookmark">Featured</a>', 'babylog' ),
					esc_url( get_permalink() )
					);
			}
			else {
				printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'babylog' ),
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
			}
		?>
	</header><!-- .entry-header -->
	<div class="content-wrapper">
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php babylog_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'babylog' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'babylog' ), 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'babylog' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ' ', 'babylog' ) );
					if ( $categories_list && babylog_categorized_blog() ) :
				?>
				<span class="cat-links">
					<?php printf( __( '%1$s', 'babylog' ), $categories_list ); ?>
				</span>
				<?php endif; // End if categories ?>

			<?php endif; // End if 'post' == get_post_type() ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>

			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'babylog' ), __( '1 Comment', 'babylog' ), __( '% Comments', 'babylog' ) ); ?></span>
			<?php endif; ?>

		</footer><!-- .entry-meta -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
