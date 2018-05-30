<?php

/**
 * abnomize functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package abnomize
 */

if ( ! function_exists( 'abnomize_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function abnomize_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on abnomize, use a find and replace
	 * to change 'abnomize' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'abnomize', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	//WooCommerce Support
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 220, 260, true);
	add_image_size( 'abnomize-featured-image', 346, 259, true );
	add_image_size( 'abnomize-random-image', 180, 200, true );

	if(get_theme_mod('abnomize_woo_zoom')=='enable'){ add_theme_support( 'wc-product-gallery-zoom' );}
	if(get_theme_mod('abnomize_woolightbox')!=='disable'){ add_theme_support( 'wc-product-gallery-lightbox' );}
	if(get_theme_mod('abnomize_woo_slider')=='enable'){ add_theme_support( 'wc-product-gallery-slider' );}
	add_theme_support( 'custom-logo', array(
   'height'      => 90,
   'width'       => 400,
   'header-text' => array( 'site-title', 'site-description' ),
   'flex-width' => true,
   'flex-height' => true,
) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'abnomize' ),
		'mobile' => esc_html__( 'Mobile Menu', 'abnomize' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'abnomize' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
      /*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css') );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'abnomize_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // abnomize_setup
add_action( 'after_setup_theme', 'abnomize_setup' );
 function abnomize_search_form( $form ) {
	$form = '<div class="input-group"><form role="search" method="get" id="searchform" class="searchform" action="' .esc_url(home_url( '/' )). '" >
	<div><label class="screen-reader-text" for="s">' . _x( 'Search for:','Label','abnomize' ) . '</label>
	<input type="text" class="input-group-field" placeholder="'. esc_attr_x( 'Search..','Placeholder','abnomize' ) .'" value="' . get_search_query() . '" name="s" id="s" />
	<button type="submit" id="searchsubmit" class="input-group-button button"><i class="fa fa-search"></i></button>
	</div>
	</div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'abnomize_search_form' );

//jetpack related posts
function abnomize_more_related_posts( $options ) {
    $options['size'] = 6;
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'abnomize_more_related_posts' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function abnomize_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'abnomize_content_width', 640 );
}
add_action( 'after_setup_theme', 'abnomize_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function abnomize_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'abnomize' ),
		'id'            => 'sidebar-1',
		'description'   => __('Sidebar widget for all pages included Post, Pages','abnomize'),
		'before_widget' => '<aside id="sidebarid %1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Post Widget', 'abnomize' ),
		'id'            => 'post-widget-1',
		'description'   => __('This will aside post content and show widgets ','abnomize'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Below Top Navigation', 'abnomize' ),
		'id'            => 'below-navi',
		'description'   => __('This widget show just above content and below main navigation','abnomize'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
register_sidebar( array(
		'name'          => esc_html__( 'Post and Pages footer', 'abnomize' ),
		'id'            => 'content-end',
		'description'   => __('After post content and above comment','abnomize'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'abnomize' ),
		'id'            => 'footer-1',
		'description'   => __('Footer widget area first from left','abnomize'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'abnomize' ),
		'id'            => 'footer-2',
		'description'   => __('Footer widget area Second from left','abnomize'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'abnomize' ),
		'id'            => 'footer-3',
		'description'   => __('Footer widget area Third from left','abnomize'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'abnomize' ),
		'id'            => 'footer-4',
		'description'   => __('Footer widget area fourth from left','abnomize'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'abnomize_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function abnomize_scripts() {
	wp_enqueue_style( 'abnomize-style', get_stylesheet_uri() );
	wp_enqueue_script( 'abnomize-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'abnomize-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
     
   wp_enqueue_script( 'foundation-core', get_template_directory_uri() . '/foundation/js/foundation.core.js', false, null, true);
   wp_enqueue_style('abnomize-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('abnomize_body_font', 'Open Sans') ).':100,300,400,700' );
   wp_enqueue_style('abnomize-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('abnomize_title_font', 'Open Sans') ).':100,300,400,700' );
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/foundation/js/foundation.min.js', false, null, true);
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/foundation/css/foundation.min.css' );
	wp_enqueue_style( 'foundation-flex', get_template_directory_uri() . '/foundation/css/foundation-flex.min.css' );
	wp_enqueue_style( 'abnomize-customcss', get_template_directory_uri() . '/css/custom.css' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'abnomize_scripts' );

function abnomize_custom_customize_enqueue() {
	wp_enqueue_style( 'abnomize-customizer-css', get_template_directory_uri() . '/css/customizer-css.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'abnomize_custom_customize_enqueue' );


function abnomize_footerscript() {
    wp_enqueue_script(
        'abnomize-loadscripts',
        get_template_directory_uri() . '/js/loadscripts.js',
        array('jquery'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'abnomize_footerscript',10);


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Custom function and codes
 */
require get_template_directory() . '/inc/custom-function.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/* Excerpt ********************************************/

    function abnomize_excerptlength_teaser($length) {
    return 10;
    }
    function abnomize_excerptlength_index($length) {
    return 25;
    }
    function abnomize_excerptmore($more) {
    return '...';
    }
    
    
    function abnomize_excerpt($length_callback='', $more_callback='') {
    global $post;
    add_filter('excerpt_length', $length_callback);
 
    add_filter('excerpt_more', $more_callback);
   
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = ''.$output.'';
    echo $output;
    }
	
