<?php

register_nav_menus(array(
	'header-menu' => 'Header menu',
));

function header_menu(){
	wp_nav_menu( array(
		'theme_location' => 'header-menu',
        'container' => false,
	) );
}


register_nav_menus(array(
	'sub-menu' => 'Sub menu',
));

function sub_menu(){
	wp_nav_menu( array(
		'theme_location' => 'sub-menu',
        'container' => false,
	) );
}

function header_lang(){
	wp_nav_menu( array(
		'theme_location' => 'header-lang',
        'container' => false,
	) );
}


register_nav_menus(array(
	'header-lang' => 'Header languages',
));





//  header menu style


// menu ul 
add_filter( 'wp_nav_menu_args', 'filter_nav_menu_args' );
function filter_nav_menu_args( $args ) {
	if ( $args['theme_location'] === 'header-menu' ) {
		$args['container']  = false;
		$args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
		$args['menu_class'] = 'c-navigation__wrapper';
	}
	return $args;
	if ( $args['theme_location'] === 'sub-menu' ) {
		$args['container']  = false;
		$args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
		$args['menu_class'] = 'c-submenu__list';
	}
	return $args;
}


// header-menu ul li
add_filter( 'nav_menu_css_class', 'filter_nav_menu_css_classes', 10, 4 );
function filter_nav_menu_css_classes( $classes, $item, $args, $depth ) {
	if ( $args->theme_location === 'header-menu' ) {
            $classes['class'] = 'c-navigation__item';
	}
	return $classes;

	if ( $args->theme_location === 'sub-menu' ) {
			$classes['class'] = '';
	}
	return $classes;
}



// menu ul li a
function add_specific_menu_location_atts( $atts, $item, $args ) {

    if( $args->theme_location == 'header-menu' ) {
            $atts['class'] = 'e-link';
    }
    return $atts;
	if( $args->theme_location == 'sub-menu' ) {
			$atts['class'] = 'c-submenu__text';
	}
	return $atts;
    
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );


