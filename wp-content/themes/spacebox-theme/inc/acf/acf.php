
<?php

// Add Global Website Settings
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Настройки Сайта',
		'menu_title'	=> 'Настройки Сайта',
		'icon_url'      => 'dashicons-tide',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}



add_filter('acf/format_value/type=textarea', 'do_shortcode');



add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field', 20);
  function add_default_value_to_image_field($field) {
    acf_render_field_setting( $field, array(
      'label'      => __('Default Image ID','acf'),
      'instructions'  => __('Appears when creating a new post','acf'),
      'type'      => 'image',
      'name'      => 'default_value',
    ));
  }


  add_action('acf/render_field_settings/type=audio_video_player', 'add_default_value_to_file_field', 20);
  function add_default_value_to_file_field($field) {
    acf_render_field_setting( $field, array(
      'label'      => __('Default File','acf'),
      'instructions'  => __('Appears when creating a new post','acf'),
      'type'      => 'audio_video_player',
      'name'      => 'default_value',
    ));
  }


add_filter('acf/format_value/type=wysiwyg', 'format_value_wysiwyg', 10, 3);
function format_value_wysiwyg( $value, $post_id, $field ) {
	$value = apply_filters( 'the_content', $value );
	return $value;
}



add_filter('acf/load_field/key=field_6139dace0334c', 'load_just_categories_filter', 12, 1);
function load_just_categories_filter( $field ) {

    $field['taxonomy'] = [];
    $terms = get_terms( array(
        'taxonomy' => 'magazine',
        'hide_empty' => false,
		'hierarchical' => 1,
		'parent' => 0
    ) );

    if ( !empty($terms) ) {
        foreach( $terms as $term ) {
            $field['taxonomy'][] = 'magazine:'.$term->slug;
        }
    }
    return $field;
}


add_filter('acf/load_field/key=field_6165f6f15d12c', 'load_just_categories_filter_1', 12, 1);
function load_just_categories_filter_1( $field ) {

    $field['taxonomy'] = [];
    $terms = get_terms( array(
        'taxonomy' => 'brands',
        'hide_empty' => false,
        'hierarchical' => 1,
        'parent' => 0
    ) );

    if ( !empty($terms) ) {
        foreach( $terms as $term ) {
			
          $field['taxonomy'][] = 'brands:'.$term->slug;
			
        }
    }

    return $field;
}
