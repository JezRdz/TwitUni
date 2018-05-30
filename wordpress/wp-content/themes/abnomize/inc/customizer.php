<?php
/**
 * abnomize Theme Customizer.
 *
 * @package abnomize
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 class abnomize_Category_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $cats = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->cats = get_categories($options);

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>
                    <label>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }
 


function abnomize_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';	
	$wp_customize->get_section( 'title_tagline'  )->title		= __('Site Titles & Logo','abnomize');
	$wp_customize->get_control( 'header_text'  )->label			= __('Display Site Title','abnomize');
	$wp_customize->get_section( 'title_tagline'  )->priority	= 10;
	$wp_customize->get_section( 'colors'  )->title				= __('Logo Text & Background Color','abnomize');
	$wp_customize->get_section( 'colors'  )->panel				= 'abnomize_panel_design';
	$wp_customize->get_section( 'background_image'  )->panel	= 'abnomize_panel_design';


	
// create an empty array
$cats = array();
 
// we loop over the categories and set the names and
// labels we need
foreach ( get_categories() as $categoriesi => $categoryy ){
    $cats[$categoryy->term_id] = $categoryy->name;
}
	
	// Top Navigation Color
	$wp_customize->add_section( 'top_navi_colorbg' , array(
    'title'      => __( 'Top Navigation Color', 'abnomize' ),
	'panel'			=> 'abnomize_panel_design',
    'priority'   => 64,
) );



/**************************************************
* Settings
***************************************************/

$wp_customize->add_setting('radio_menu',
    array(
        'default'			=> 'fixed',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'abnomize_sanitize_select'
    )
);
$wp_customize->add_setting( 'topnavbgcolor' , array(
    'default'     => '#40ACEC',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting( 'topnavbgcolorsub' , array(
    'default'     => '#20598a',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting( 'topnavbgcolorfont' , array(
    'default'     => '#ffffff',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting('search_setting',
    array(
        'default'			=> 'show',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'abnomize_sanitize_select'
    )
);
/**************************************************
* Layout
***************************************************/
// Post Settings
	$wp_customize->add_section( 'abnomize_panel_layout' , array(
    'title'      => __( 'Layout', 'abnomize' ),
	'panel'			=> 'abnomize_panel_design',
    'priority'   => 2,
) );


//Author Profile
 $wp_customize->add_setting('website_layout',	
	array(
		'default'			=> 'rightside',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'abnomize_sanitize_select'
	));
$wp_customize->add_control('website_layout',
                         array (                             
							'type' => 'radio',
							'label' => __('Post and Page Layout','abnomize'),
							'settings'   => 'website_layout',
							'section' => 'abnomize_panel_layout',
							'choices' => array(          
							'rightside' => __('Right Sidebar','abnomize'),
							'left' => __('Left Sidebar','abnomize'),
							'full' => __('Full Width [No sidebar]','abnomize'),
                         )
						 ));	
	
/**************************************************
* Fonts
***************************************************/
$font_array = array('Raleway','Khula','Open Sans','Indie Flower','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans','Fjalla One','PT Sans Narrow','Poiret One','Passion One','Arvo','Inconsolata','Shadows Into Light','Pacifico','Dancing Script','Architects Daughter','Sigmar One','Righteous','Amatic SC','Orbitron','Chewy','Lobster Two','Gloria Hallelujah','Lekton','Almendra Display','Swanky and Moo Moo','Hanalei Fill','Uncial Antiqua','Rouge Script','Engagement','Bonbon','Caesar Dressing','Kenia','Lemon','Stardos Stencil','Bilbo','Macondo','Delius Unicase','Butcherman','Monoton','Nosifer','Codystar','Fontdiner Swanky','Diplomata SC','Snowburst One','Faster One','Rock Salt','Eater');
$fonts = array_combine($font_array, $font_array);
// Body Fonts
	$wp_customize->add_section( 'abnomize_panel_bodyfonts' , array(
    'title'      => __( 'Body Fonts', 'abnomize' ),
	'panel'			=> 'abnomize_panel_advance',
    'priority'   => 1,
) );	
$wp_customize->add_setting(
	'abnomize_title_font',
	array(
		'default'=> 'Open Sans',
		'sanitize_callback' => 'abnomize_sanitize_gfont' 
		)
);
$wp_customize->add_control(
	'abnomize_title_font',array(
			'label' => __('Title','abnomize'),
			'settings' => 'abnomize_title_font',
			'section'  => 'abnomize_panel_bodyfonts',
			'type' => 'select',
			'choices' => $fonts,
		)
);
$wp_customize->add_setting(
		'abnomize_body_font',
			array(	'default'=> 'Open Sans',
					'sanitize_callback' => 'abnomize_sanitize_gfont' )
	);

$wp_customize->add_control(
		'abnomize_body_font',array(
				'label' => __('Body','abnomize'),
				'settings' => 'abnomize_body_font',
				'section'  => 'abnomize_panel_bodyfonts',
				'type' => 'select',
				'choices' => $fonts
			)
	);
/**************************************************
* Post Settings
***************************************************/
// Post Settings
	$wp_customize->add_section( 'abnomize_panel_postsettings' , array(
    'title'      => __( 'Post Settings', 'abnomize' ),
	//'panel'			=> 'abnomize_panel_advance',
    'priority'   => 2,
) );


$wp_customize->add_setting('random_post',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'abnomize_sanitize_select'
	));
$wp_customize->add_control('random_post',
                         array (                             
							'type' => 'radio',
							'label' => __('Random Post Below Post','abnomize'),
							'settings'   => 'random_post',
							'section' => 'abnomize_panel_postsettings',
							'choices' => array(
							'enable' => __('Enable','abnomize'),
							'disable' => __('Disable','abnomize'),
                         )
						 ));						
$wp_customize->add_setting('abnomize_author_profile',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'abnomize_sanitize_select'
	));
$wp_customize->add_control('abnomize_author_profile',
                         array (                             
							'type' => 'radio',
							'label' => __('Show Author Profile in Post and Pages','abnomize'),
							'settings'   => 'abnomize_author_profile',
							'section' => 'abnomize_panel_postsettings',
							'choices' => array(
							'enable' => __('Enable','abnomize'),
							'disable' => __('Disable','abnomize'),
                         )
						 ));
	
$wp_customize->add_setting('singlepost_thumb',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'abnomize_sanitize_select'
	));
$wp_customize->add_control('singlepost_thumb',
                         array (                             
							'type' => 'radio',
							'label' => __('Thumbnail in Single Post','abnomize'),
							'settings'   => 'singlepost_thumb',
							'section' => 'abnomize_panel_postsettings',
							'choices' => array(
							'enable' => __('Enable','abnomize'),
							'disable' => __('Disable','abnomize'),
                         )
						 ));
						 
						 
						 
/**************************************************
* WooCommerce
***************************************************/
// Woocommerce
	$wp_customize->add_section( 'abnomize_woo_section' , array(
    'title'      => __( 'WooCommerce', 'abnomize' ),
	//'panel'			=> 'abnomize_panel_design',
    'priority'   => 67,
) );

// Woocommerce Settings
$wp_customize->add_setting('abnomize_woo_lightbox',	
	array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'abnomize_sanitize_select'
	));
$wp_customize->add_control('abnomize_woo_lightbox', array (                             
				'type' => 'radio',
				'label' => __('LightBox Open Images','abnomize'),
				'settings'   => 'abnomize_woo_lightbox',
				'section' => 'abnomize_woo_section',
				'choices' => array(
				'enable' => __('Enable','abnomize'),
				'disable' => __('Disable','abnomize'),
			 )
			 ));
$wp_customize->add_setting('abnomize_woo_zoom',	
	array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'abnomize_sanitize_select'
	));
$wp_customize->add_control('abnomize_woo_zoom', array (                             
				'type' => 'radio',
				'label' => __('Zoom Product Images','abnomize'),
				'settings'   => 'abnomize_woo_zoom',
				'section' => 'abnomize_woo_section',
				'choices' => array(
				'enable' => __('Enable','abnomize'),
				'disable' => __('Disable','abnomize'),
			 )
			 ));	
$wp_customize->add_setting('abnomize_woo_slider',	
	array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'abnomize_sanitize_select'
	));
$wp_customize->add_control('abnomize_woo_slider', array (                             
				'type' => 'radio',
				'label' => __('Slide Product Images','abnomize'),
				'settings'   => 'abnomize_woo_slider',
				'section' => 'abnomize_woo_section',
				'choices' => array(
				'enable' => __('Enable','abnomize'),
				'disable' => __('Disable','abnomize'),
			 )
			 ));	
/**************************************************
* Footer Copyright
***************************************************/
	$wp_customize-> add_section(
    'abnomize_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','abnomize'),
    	'description'	=> __('Enter your Own Copyright Text.','abnomize'),
    	'priority'		=> 3,
    	'panel'			=> 'abnomize_panel_advance'
    	)
    );
    
	$wp_customize->add_setting(
	'abnomize_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'abnomize_footer_text',
	        array(
	            'section' => 'abnomize_custom_footer',
	            'settings' => 'abnomize_footer_text',
	            'type' => 'text'
	        )
	);
	
/**************************************************
* Social
***************************************************/
	// Social Icons
	$wp_customize->add_section('abnomize_social_section', array(
			'title' => __('Social Icons','abnomize'),
			'priority' => 44 ,
				'panel'	=> 'abnomize_panel_advance'
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','abnomize'),
					'facebook-square' => __('Facebook','abnomize'),
					'twitter-square' => __('Twitter','abnomize'),
					'google-plus-square' => __('Google Plus','abnomize'),
					'instagram' => __('Instagram','abnomize'),
					'rss' => __('RSS Feeds','abnomize'),
					'vine' => __('Vine','abnomize'),
					'vimeo-square' => __('Vimeo','abnomize'),
					'youtube-square' => __('Youtube','abnomize'),
					'flickr' => __('Flickr','abnomize'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'abnomize_social_'.$x, array(
				'sanitize_callback' => 'abnomize_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'abnomize_social_'.$x, array(
					'settings' => 'abnomize_social_'.$x,
					'label' => __('Icon ','abnomize').$x,
					'section' => 'abnomize_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'abnomize_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'abnomize_social_url'.$x, array(
					'settings' => 'abnomize_social_url'.$x,
					'description' => __('Icon ','abnomize').$x.__(' Url','abnomize'),
					'section' => 'abnomize_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function abnomize_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook-square',
					'twitter-square',
					'google-plus-square',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube-square',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
/**************************************************
* Control
***************************************************/

	$wp_customize->add_control('radio_menu',
    array(
        'type' => 'radio',
        'label' => __('Top Navigation Position','abnomize'),
		'settings'   => 'radio_menu',
        'section' => 'top_navi_colorbg',
        'choices' => array(
            'fixed' => __('Float','abnomize'),
            'relative' => __('Fixed','abnomize'),
        ) ));		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolor', array(
	'label'        => __( 'Top Navigation Color', 'abnomize' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolor',
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolorsub', array(
	'label'        => __( 'Sub Menu Color', 'abnomize' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolorsub',
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolorfont', array(
	'label'        => __( 'Top Menu Font Color', 'abnomize' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolorfont',
	) ) );
$wp_customize->add_control('search_setting',
    array(
        'type' => 'radio',
        'label' => __('Search Bar','abnomize'),
		'settings'   => 'search_setting',
        'section' => 'top_navi_colorbg',
        'choices' => array(
            'show' => __('Show','abnomize'),
            'hide' => __('Hide','abnomize'),
        ) ));
		

/**************************************************
* Customizer Panels
***************************************************/	
	$wp_customize->add_panel('abnomize_panel_design',
		array(
			'priority' 			=> 12,
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> __( 'Color, Design', 'abnomize' ),
			'description' 		=> __( 'Configure color and layout settings for the abnomize Theme', 'abnomize' ),
		)
	);
	$wp_customize->add_panel('abnomize_panel_advance',
		array(
			'priority' 			=> 13,
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> __( 'Advance Settings', 'abnomize' ),
			'description' 		=> __( 'Advance Settings related to footer copyright and Enable options', 'abnomize' ),
		)
	);
		
	$wp_customize->add_section( 'profile_panel_featured' , array(
	'title'      => __( 'Featured Posts', 'abnomize' ),
	'description' 		=> __( 'Top Header featured posts section, Select Category for featured post to display', 'abnomize' ),
	'priority'   => 9,
	) );  

$wp_customize->add_setting('abnomize_featured_section',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'abnomize_sanitize_select'
	));
$wp_customize->add_control('abnomize_featured_section',
                         array (                             
							'type' => 'radio',
							'label' => __('Enable or Disable Featured Section','abnomize'),
							'settings'   => 'abnomize_featured_section',
							'section' => 'profile_panel_featured',
							'choices' => array(
							'enable' => __('Enable','abnomize'),
							'disable' => __('Disable','abnomize'),
                         )
						 ));	
	$wp_customize->add_setting( 'profile_featuredcate', array(
	'default' => 1,
	'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'profile_featurecat_control', array(
	'settings' => 'profile_featuredcate',
	'label' => __('Select Category','abnomize'),
	'type' => 'select',
	'choices' => $cats,
	'section' => 'profile_panel_featured',  // depending on where you want it to be
	) );


	$wp_customize->add_section( 'profile_panel_tabs' , array(
    'title'      => __( 'Info Post Listing', 'abnomize' ),
	'description' 		=> __( 'This Setting allow you to display post label on thumbnail, Must be in Sub category eg : Language -> English, French, Spanish </br> Year -> 2015, 2016 etc..  ', 'abnomize' ),
    'priority'   => 8,
) );   

		
$wp_customize->add_setting( 'topcateid', array(
    'default' => 1,
    'sanitize_callback' => 'absint'
) );
 
$wp_customize->add_control( 'cat_contlr_top', array(
    'settings' => 'topcateid',
    'label' => __('Top Category Select','abnomize'),
    'type' => 'select',
    'choices' => $cats,
    'section' => 'profile_panel_tabs',  // depending on where you want it to be
) );

$wp_customize->add_setting( 'leftcateid', array(
    'default' => 1,
    'sanitize_callback' => 'absint'
) );
 
$wp_customize->add_control( 'cat_contlr_left', array(
    'settings' => 'leftcateid',
    'label' => __('Left Category Select','abnomize'),
    'type' => 'select',
    'choices' => $cats,
    'section' => 'profile_panel_tabs',  // depending on where you want it to be
) );
$wp_customize->add_setting( 'rightcateid', array(
    'default' => 1,
    'sanitize_callback' => 'absint'
) );
 
$wp_customize->add_control( 'cat_contlr_right', array(
    'settings' => 'rightcateid',
    'label' => __('Right Category Select','abnomize'),
    'type' => 'select',
    'choices' => $cats,
    'section' => 'profile_panel_tabs',  // depending on where you want it to be
) );
}
add_action( 'customize_register', 'abnomize_customize_register' );




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function abnomize_customize_preview_js() {
	wp_enqueue_script( 'abnomize_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'abnomize_customize_preview_js' );

/************************************
 * sanitization callback.
 ***********************************/
function abnomize_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}
function abnomize_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );
	
	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! null( $hex_color ) ? $hex_color : $setting->default );
}
function abnomize_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function abnomize_sanitize_gfont( $input ) {
		if ( in_array($input, array('Helvetica Neue','Helvetica','Raleway','Khula','Open Sans','Indie Flower','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans','Fjalla One','PT Sans Narrow','Poiret One','Passion One','Arvo','Inconsolata','Shadows Into Light','Pacifico','Dancing Script','Architects Daughter','Sigmar One','Righteous','Amatic SC','Orbitron','Chewy','Lobster Two','Gloria Hallelujah','Lekton','Almendra Display','Swanky and Moo Moo','Hanalei Fill','Uncial Antiqua','Rouge Script','Engagement','Bonbon','Caesar Dressing','Kenia','Lemon','Stardos Stencil','Bilbo','Macondo','Delius Unicase','Butcherman','Monoton','Nosifer','Codystar','Fontdiner Swanky','Diplomata SC','Snowburst One','Faster One','Rock Salt','Eater') ) )
			return $input;
		else
			return '';	
	}
	
	function abnomize_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}	
	function abnomize_sanitize_multicheckbox( $checked ) {
	// Boolean check.
	$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}