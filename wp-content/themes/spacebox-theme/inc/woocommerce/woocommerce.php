<?php


add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

 
// remove title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
// remove  rating  stars
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
// remove product meta 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// remove  description
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
// remove images
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
// remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
// remove additional information tabs
remove_action('woocommerce_after_single_product_summary ','woocommerce_output_product_data_tabs',10);


 