<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package abnomize
 */

?>

	</div><!-- #content -->
	</div><!-- #content -->
	
	
<footer class="marketing-site-footer">
  <div class="row medium-unstack">
    <div class="medium-4 columns">
    <?php dynamic_sidebar( 'footer-1' ); ?>
    </div>
    <div class="medium-4 columns">
 <?php dynamic_sidebar( 'footer-2' ); ?>
    </div>
    <div class="medium-4 columns">
    <?php dynamic_sidebar( 'footer-3' ); ?>
    </div>
  </div>
  <div class="marketing-site-footer-bottom">
    <div class="row large-unstack align-middle">
	<?php echo wp_kses_post( abnomize_socialprofiles() ); ?>
      <div class="column">
        <p><div class="site-info">			
			<a href="<?php echo esc_url( __( 'https://www.insertcart.com/abnomize-theme-setup-guide-documentation/', 'abnomize' ) ); ?>"><?php printf( __( 'Theme: %s', 'abnomize' ), 'abnomize' ); ?></a>
			<span class="sep"> | </span>
			<?php echo ( get_theme_mod('abnomize_footer_text') == '' ) ? ('&copy; '.date_i18n('Y').' '.esc_html(get_bloginfo('name')).__('. All Rights Reserved. ','abnomize')) : esc_attr(get_theme_mod('abnomize_footer_text')); ?>
		</div><!-- .site-info --></p>
      </div>
      <div class="column">
	    <?php if (has_nav_menu('footer-menu')) { ?>                
                <?php wp_nav_menu( array(
                        'menu' => 'footer-menu',
                        'menu_class' => 'menu marketing-site-footer-bottom-links',
                        'container' => '',
						'theme_location' => 'footer-menu',
                        'depth' => '0',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                    ) ); ?>                 
                <!-- Left Nav Section -->    
	 <?php } ?>
	  
	  
	  
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</div></div>
</body>
</html>