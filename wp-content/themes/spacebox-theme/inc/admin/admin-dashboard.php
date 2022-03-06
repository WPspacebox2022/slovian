<?php


function custom_login_logo() { ?>
    <style type="text/css">
        #wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before{
            background-image: url( <?php echo get_field('acf_admin_logo','option')['url']; ?> );
        }
    </style>
<?php } 
add_action('admin_head', 'custom_login_logo');
    

// Admin Post - Image
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
 
function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Миниатюра');
    return $defaults;
}
 
function posts_custom_columns($column_name, $id){
 if($column_name === 'riv_post_thumbs'){
        the_post_thumbnail( array(50, 50) );
    }
}




// User delete - social fields 
function true_hide_contacts( $contactmethods ) {
	unset($contactmethods['linkedin']);
	unset($contactmethods['myspace']);
	unset($contactmethods['pinterest']);
	unset($contactmethods['soundcloud']);
	unset($contactmethods['twitter']);
	unset($contactmethods['tumblr']);
	unset($contactmethods['wikipedia']);
	unset($contactmethods['facebook']);
	unset($contactmethods['youtube']);
	unset($contactmethods['instagram']);
	unset($contactmethods['twitter']);
	return $contactmethods;
}
add_filter('user_contactmethods', 'true_hide_contacts', 10, 1);







// filter by brands

add_action('restrict_manage_posts', 'admin_products_by_manufacturer_filter_dropdown');
function admin_products_by_manufacturer_filter_dropdown() {
    global $typenow, $pagenow;

    $taxonomy = 'brands'; // The custom taxonomy

    if( 'edit.php' === $pagenow && 'product' === $typenow && taxonomy_exists( $taxonomy ) ) {
        $info_taxonomy = get_taxonomy($taxonomy);
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';

        wp_dropdown_categories( array(
            'show_option_all' => sprintf( __("Выбрать Бренд", "woocommerce") ),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'selected'        => $selected,
            'orderby'         => 'name',
            'show_count'      => true,
            'hide_empty'      => true,
        ) );
    }
}

add_action('parse_query', 'admin_products_by_manufacturer_filter_query');
function admin_products_by_manufacturer_filter_query( $query ) {
    global $typenow, $pagenow;

    $taxonomy = 'brands'; // The custom taxonomy

    if ( 'edit.php' === $pagenow && 'product' === $typenow && taxonomy_exists( $taxonomy ) ) {
        $q_vars = &$query->query_vars;

        if ( isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }
}