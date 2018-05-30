<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package abnomize
 */

get_header(); ?>
<div class="row">
  <div id="primary" class="large-8 columns">
<main id="main" class="site-main" role="main">
<div class="row small-up-2 medium-up-3 large-up-2">
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>



		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
		</div>
		<?php echo paginate_links(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
		<?php get_sidebar(); ?>
<?php get_footer(); ?>
