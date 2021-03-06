<?php wp_nav_menu( array( 
'theme_location' => 'primary',
'items_wrap'      => '<div class="row" ><nav id="site-navigation"class="main-navigation" role="navigation" ><ul id="%1$s" class="%2$s">%3$s</ul></nav></div>', 
'fallback_cb' => false,
'menu_id' => 'mainmenu'

 ) ); ?>
 


<div class="title-bar" data-responsive-toggle="posti" data-hide-for="medium">
  <button class="button menu warning" type="button" data-toggle><i class="fa fa-bars" aria-hidden="true"></i> <?php esc_html('Menu','abnomize'); ?></button>

  <div class="title-bar-title"></div>  
</div>
  <button class="button searchmob"  type="button" data-toggle="searchmobappear"><i class="fa fa-search" aria-hidden="true"></i></button>
<div class="dropdown-pane bottom  float-right" data-close-on-click="true" id="searchmobappear" data-dropdown>
  <?php get_search_form(); ?>
</div>
 
 <?php wp_nav_menu( array( 
'theme_location' => 'primary',
'items_wrap'      => '<nav id="posti"><ul id="%1$s" class="%2$s vertical menu">%3$s</ul></nav>', 
'menu_id' => 'mobilemenu',
'fallback_cb' => false,
'walker' => new abnomize_Walker_Nav_Menu()

 ) ); ?>
 
<?php

class abnomize_Walker_Nav_Menu extends Walker_Nav_Menu {
     function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'nested vertical menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
 
        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
 
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
 
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
 
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
 
        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
 
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
?>