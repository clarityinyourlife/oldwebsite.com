<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Babylog
 * @since Babylog 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found hentry">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'babylog' ); ?></h1>
				</header><!-- .entry-header -->
				<div class="content-wrapper">
					<div class="entry-content">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'babylog' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .entry-content -->
				</div>
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>