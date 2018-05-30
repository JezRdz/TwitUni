<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package abnomize
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'abnomize' ); ?></a>
<div class="topmenu">
	<div class="row"> 
	<div class="small-12 large-6 column">
	<?php if ( abnomize_the_custom_logo()  ) {
      abnomize_the_custom_logo();
   }
   else {
	   
	  if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></h1>
						<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></p>
						
					<?php endif;
   }
   ?> 
   </div>
   <div class="small-12 large-6 column sidesearch">
   <?php get_template_part('template-parts/menu'); ?>
   
  
	</div>
	</div>
	</div>
<?php do_action('abnomize_header'); ?>
<div id="content" class="site-content">
	<?php if ( is_active_sidebar( 'below-navi' ) ) { ?>

	
<div class="row">
	<?php dynamic_sidebar( 'below-navi' ); ?>
</div><!-- #secondary -->
<?php } 
