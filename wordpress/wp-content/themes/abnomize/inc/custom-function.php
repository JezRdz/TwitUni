<?php
/* ----------------------------------------------------------------------------------- */
/* Social Icons
/*----------------------------------------------------------------------------------- */
if ( ! function_exists( 'abnomize_socialprofiles' ) ) :
	function abnomize_socialprofiles(){		
			/*
			** Template to Render Social Icons on Top Bar
			*/
				echo '<div class="socials">';
				for ($i = 1; $i < 8; $i++) : 
				$social = esc_attr(get_theme_mod('abnomize_social_'.$i));
				if ( ($social != 'none') && ($social != '') ) : ?>
				<a class="hvr-ripple-out" href="<?php echo esc_url( get_theme_mod('abnomize_social_url'.$i) ); ?>"><i class="fa fa-<?php echo esc_attr($social); ?>"></i></a>
				<?php endif; endfor;
				echo '</div>';
	}
endif;


/* ----------------------------------------------------------------------------------- */
/* Get Comment Numbers
/*----------------------------------------------------------------------------------- */
function abnomize_commentnumber(){ ?>

	<div class="comment">
	<?php printf( _nx( '1', '%1$s', get_comments_number(), 'comments title', 'abnomize' ), number_format_i18n( get_comments_number() ) ); ?>
	</div>
	<?php 
}



/* ----------------------------------------------------------------------------------- */
/* Category Top
/*----------------------------------------------------------------------------------- */
function abnomize_featuredtopcate(){
	echo '<div class="mylanguage"> ';
	//get all categories of current post

global $post;
$topchildof = absint(get_theme_mod('topcateid'));
$taxonomy = 'category';
// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
// Separator between links.
$separator = ', ';
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
		 $term_ids = implode( ',' , $post_terms );
		 $terms = wp_list_categories( array(
			'title_li' => '',
			'style'    => 'none',
			'show_option_none'    => '',		
			'child_of' => $topchildof,
			'echo'     => false,
			'taxonomy' => $taxonomy,
			'include'  => $term_ids
		) );
		$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
		// Display post categories.
		echo  wp_kses_post($terms);
	}
	echo '</div>';
}

function abnomize_featuredright(){
	$topchildof = absint(get_theme_mod('rightcateid'));
global $post;
$taxonomy = 'category';
// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
// Separator between links.
$separator = ', ';
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
		 $term_ids = implode( ',' , $post_terms );
		 $terms = wp_list_categories( array(
			'title_li' => '',
			'style'    => 'none',
			'show_option_none'    => '',		
			'child_of' => $topchildof,
			'echo'     => false,
			'taxonomy' => $taxonomy,
			'include'  => $term_ids
		) );
		$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
		// Display post categories.
		echo  wp_kses_post($terms);
	}
}

function abnomize_featuredleft(){
	$topchildof = absint(get_theme_mod('leftcateid'));
global $post;
$taxonomy = 'category';
// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
// Separator between links.
$separator = ', ';
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
		 $term_ids = implode( ',' , $post_terms );
		 $terms = wp_list_categories( array(
			'title_li' => '',
			'style'    => 'none',
			'show_option_none'    => '',		
			'child_of' => $topchildof,
			'echo'     => false,
			'taxonomy' => $taxonomy,
			'include'  => $term_ids
		) );
		$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
		// Display post categories.
		echo  wp_kses_post($terms);
	}
}

/* ----------------------------------------------------------------------------------- */
/* Suggested Plugin Jetpack
/*----------------------------------------------------------------------------------- */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'abnomize_register_required_plugins' );
function abnomize_register_required_plugins() {
	$plugins = array(
	array(
			'name'      => __('Jetpack by WordPress.com','abnomize'),
			'slug'      => 'jetpack',
			'required'  => false,
		),
		);
		$config = array(
		'id'           => 'abnomize',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
);

	tgmpa( $plugins, $config );
}	
/* ----------------------------------------------------------------------------------- */
/* Customize Comment Form
/*----------------------------------------------------------------------------------- */
add_filter( 'comment_form_default_fields', 'abnomize_comment_form_fields' );
function abnomize_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns"><label for="middle-label" class="text-right middle">' . '<span class="prefix"><i class="fa fa-user"></i>'. ( $req ? ' <span class="required">* </span>' : '' ) . '</span></label></div>' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. esc_attr_e( 'Name','abnomize' ) .'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></div></div></div>',
        'email'  => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns">' . ' <label for="middle-label" class="text-right middle"><span class="prefix"><i class="fa fa-envelope-o"></i>' . ( $req ? ' <span class="required">* </span>' : '' ) . '</span></label></div> ' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. esc_attr_e( 'Email','abnomize' ) .'" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="20"' . $aria_req . ' /></div></div></div>',
        'url'    => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns">' . ' <label for="middle-label" class="text-right middle"><span class="prefix"><i class="fa fa-external-link"></i>'  . '</span></label></div>' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. esc_attr_e( 'Website','abnomize' ) .'" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div></div>'        
    );
    
    return $fields;
    
    
}

add_filter( 'comment_form_defaults', 'abnomize_comment_form' );
function abnomize_comment_form( $argsbutton ) {
        $argsbutton['class_submit'] = 'float-center button'; 
    
    return $argsbutton;
}



/* ----------------------------------------------------------------------------------- */
/* Custom CSS Output
/*----------------------------------------------------------------------------------- */

function abnomize_custom_css_output(){
    
    echo '<style type="text/css">';	
    //echo esc_html(get_theme_mod('custom_css'));    

    echo '.floatingmenu #primary-menu > li.menu-item > ul{background: '.esc_html(get_theme_mod('topnavbgcolorsub','#20598a')).' !important;}';
    echo '.floatingmenu,.floatingmenu div.large-8.columns{background-color: '.esc_html(get_theme_mod('topnavbgcolor','#40ACEC')).' !important;}';
    echo '.floatingmenu li.page_item a, .floatingmenu li.menu-item a{color: '.esc_html(get_theme_mod('topnavbgcolorfont','#ffffff')).' !important;}';
    echo '.floatingmenu{position: '.esc_attr(get_theme_mod('radio_menu','fixed')).' !important;}';

	if ( get_theme_mod('abnomize_body_font') ) :
		echo "body { font-family: ".esc_attr(get_theme_mod('abnomize_body_font'))."; }";
	endif;
	if ( get_theme_mod('abnomize_title_font') ) :
		echo "h1.site-title, h1.entry-title, h2.entry-title { font-family: ".esc_attr(get_theme_mod('abnomize_title_font'))."; }";
	endif;
    echo '</style>';
    
}
add_action('wp_head','abnomize_custom_css_output');

if ( function_exists('yoast_breadcrumb') ) { 
function abnomize_breadcrumb_support(){		
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');		
}
add_action('abnomize_before_single_post_title','abnomize_breadcrumb_support');
}

// Install notice
if ( ! defined( 'WPINC' ) ) {
	die;
}

function abnomize_notice() {
	if ( isset( $_GET['activated'] ) ) {
		$return = '<div class="notice updated activation is-dismissible"><p>';
		$my_theme = wp_get_theme();	
		$return .= ' <a class="button button-primary theme-options" href="' . esc_url(admin_url( 'customize.php' )) . '">' . esc_html( 'Theme Options', 'abnomize' ) . '</a>';
		$return .= ' <a class="button button-primary help" href="http://www.insertcart.com/abnomize-theme-setup-guide/">' . esc_html( 'Need Help?', 'abnomize' ) . '</a>';
		$return .= '</p></div>';
		echo wp_kses_post($return);
	}
}
add_action( 'admin_notices', 'abnomize_notice' );

// Custom Header Call 
function abnomize_customhead(){
	
	if ( is_front_page() ) {
		?>
	
		<div class="header-area">
			<div class="row heading">
				<?php
			$description = get_bloginfo( 'description', 'display' );

			if ( $description || is_customize_preview() ) :
			?>
				<p class="site-description"><?php echo $description; ?></p>
			<?php endif; ?>
			</div>
		</div>
	<?php }
	
		if ( is_search() ) {
		?>
	
		<div class="header-area">
			<div class="row heading">
				<h1 class="page-title search-result-title"><i class="fa fa-search"></i> <?php printf( esc_html__( 'Search Results for: %s', 'abnomize' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</div>
		</div>
	<?php }
		if ( is_category() ) {
		?>
	
		<div class="header-area">
			<div class="row heading">
				<?php
					the_archive_title( '<h1 class="page-title titlepage"><i class="fa fa-list-alt"></i> ', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</div>
		</div>
	<?php }
		if ( is_tag() ) {
		?>
	
		<div class="header-area">
			<div class="row heading">
				<?php
					single_tag_title( '<h1 class="page-title titlepage"><i class="fa fa-tag"></i> ', '</h1>' );
				?>
			</div>
		</div>
	<?php }
		if ( is_author() ) {
		?>
	
		<div class="header-area">
			<div class="row heading">
				<?php
					echo '<h1 class="page-title titlepage"><i class="fa fa-user-circle-o" aria-hidden="true"></i> '.esc_attr(get_the_author_meta( 'nicename' )).'</h1>';
				?>
			</div>
		</div>
	<?php }
	
	
	
}
add_action('abnomize_header','abnomize_customhead');