<?php

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
// remove_action( 'init', 'rest_api_init' );
// remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
// remove_action( 'parse_request', 'rest_api_loaded' );
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// add_filter( 'show_admin_bar', '__return_false' );
add_filter('rest_enabled', '__return_false');
add_filter( 'aioseop_prev_link', 'mayak_remove_prev_link' );
add_filter( 'aioseop_next_link', 'mayak_remove_prev_link' );
remove_filter('comment_text', 'make_clickable', 9);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
remove_filter('comment_text', 'make_clickable', 9);


// add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
// function my_deregister_styles() {
// 	wp_deregister_style( 'syntaxhighlighter-theme-default' );
// 	wp_deregister_style( 'syntaxhighlighter-core' );
// 	wp_deregister_style( 'wp-pagenavi' );
// 	wp_deregister_style( 'contact-form-7-css' );
// }
function swipex_deregister_global_styles() {
    if ( ! is_user_logged_in() ) {
        wp_dequeue_style( 'global-styles' );
    }
}
add_action( 'wp_enqueue_scripts', 'swipex_deregister_global_styles', 100 );



function swipex_deregister_styles()    { 
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}
add_action( 'wp_print_styles', 'swipex_deregister_styles', 100 );


function swipex_remove_block_library_css(){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );    
}
add_action( 'wp_enqueue_scripts', 'swipex_remove_block_library_css' );
   



function swipex_disable_woocommerce_block_editor_styles() {
    wp_deregister_style( 'wc-block-editor' );
    wp_deregister_style( 'wc-blocks-style' );
}
add_action( 'enqueue_block_assets', 'swipex_disable_woocommerce_block_editor_styles', 1, 1 );


function swipex_disable_other_image_sizes() {
	remove_image_size('post-thumbnail'); 
	remove_image_size('another-size');   
}
add_action('init', 'swipex_disable_other_image_sizes');



add_filter(
    'intermediate_image_sizes',
    function ($sizes) {
        return array_diff(
            $sizes,
            array(
                // 'thumbnail',   
                'medium',   
                'large',      
                'medium_large',
                '1536x1536',  
                '2048x2048',
                'woocommerce_thumbnail',
                'woocommerce_single',
                'woocommerce_gallery_thumbnail',
                'shop_catalog',
                'shop_single',
                'shop_thumbnail'
            ) 
        );
    }
);

