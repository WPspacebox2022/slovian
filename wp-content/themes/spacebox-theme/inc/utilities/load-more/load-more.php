<?php 
add_action( 'wp_ajax_nopriv_loadMore', 'load_more' );
add_action( 'wp_ajax_loadMore', 'load_more' );

function load_more(){ 
	
	$brand_id = $_POST['product_brand']
	?>


          <?php 

            $product_args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'order'          => 'ASC',
                'post_status'    => 'publish',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'brands',
                    'field' => 'term_id',
                    'terms' => $brand_id,
                  ),
                ),
            );

            $products = get_posts($product_args); 

            $term = get_term($brand_id); 
            
            ?>

			     
              <?php 

                    foreach( $products as $product ){ ?>

                        <div class="products__content-col">
                          <a href="<?php echo get_the_permalink($product->ID); ?>" class="product">
                          <?php if( get_post_thumbnail_id($product->ID) ){ ?>
                                    <div class="product__img">
                                      <picture>
                                          <?php echo wp_get_attachment_image(get_post_thumbnail_id($product->ID), 'medium'); ?>
                                      </picture>
                                    </div>
                                  <?php } else { ?>
                                    <div class="product__img default">
                                      <picture>
                                          <img src="<?=THEME?>/placeholder.jpg" alt="product">
                                      </picture>
                                    </div>
                                  <?php } ?>
                            <div class="product__content">
                            
                              <?php $categories = get_the_terms( $product->ID , 'product_cat' );
                                  if( $categories && ! is_wp_error($categories) ){ ?>
                                      
                                          <span class="product__content-tag tag--<?php echo $categories[0]->slug; ?>">
                                              <?php echo $categories[0]->name; ?>
                                          </span>
                                                            
                                  <?php } ?>
                            
                              <span class="product__content-name">
                                <?php echo get_the_title($product->ID); ?>
                              </span>
                              <span class="product__content-val">
                                <?php echo get_the_excerpt($product->ID); ?>
                              </span>
                            </div>
                          </a>
                        </div>

                    <?php } ?>
           
        
   

	<?php

	

	$response = ob_get_contents();
	ob_end_clean();
	echo $response;
	die(1);
}