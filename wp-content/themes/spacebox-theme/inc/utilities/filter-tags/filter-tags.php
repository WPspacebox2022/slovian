<?php 
add_action( 'wp_ajax_nopriv_filterTag', 'filter_tag' );
add_action( 'wp_ajax_filterTag', 'filter_tag' );

function filter_tag(){ 
	
	$tag = $_POST['product_tag'];

  if( !empty($tag) ){ ?>

  <div id="somatoAnchorId" class="products__content-top">
    <h2>Show by:</h2>
    <button type="button" class="button button--regular button--small"><span>Clear filter</span></button>
  </div>
  <div class="products__content product-ajax">
    <div class="products__content-chapter">
    <?php 

      $product_args = array(
          'post_type' => 'product',
          'posts_per_page' => -1,
          'order'          => 'ASC',
          'post_status'    => 'publish',
          'tax_query' => array(
              array(
                'taxonomy' => 'product_tag',
                'field' => 'name',
                'terms' => $tag,
              ),
            ),
                );

      $products = get_posts($product_args); ?>

      
      <div class="products__content-row js-load-wrap">
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
      </div>
    </div>
  </div>

  <?php } else { 

      while ( have_rows('acf_page_components', 39 ) ) : the_row(); 

        $brands = get_sub_field('acf_products_list', 39 );

        foreach( $brands as $brand_item ){

          $brand = $brand_item->name; 
          $brand_link = $brand_item->slug; 
          $brand_id = $brand_item->term_id;


          $product_args = array(
              'post_type' => 'product',
              'posts_per_page' => -1,
              'order'          => 'ASC',
              'post_status'    => 'publish',
              'tax_query' => array(
                array(
                  'taxonomy' => 'brands',
                  'field' => 'slug',
                  'terms' => $brand_link,
                ),
              ),
          );

          $products = get_posts($product_args);

          $product_count = count($products);
          ?>
          
          <?php if( !empty($product_count) ){ ?>
            <div class="products__content-chapter">
                <div id="<?php echo $brand_link; ?>" class="products__content-top">
                    <?php 
                          if ( !empty( get_field('acf_product_brand_image',$brand_item) ) ){  ?>
                              <div class="products__content-top-logo">
                                <picture>
                                  <img src="<?php echo get_field('acf_product_brand_image',$brand_item); ?>" alt="<?php echo $brand; ?>">
                                </picture>
                              </div>
                              <h2>
                                <?php echo $brand; ?>
                              </h2>
                          
                        <?php } ?>
                </div>
                <div class="products__content-row js-load-wrap">
                      <?php if( !empty($product_count) ){

                            foreach( $products as $index => $product ){ 
                                if( $index < 3){ ?>
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
                            <?php } ?>

                      <?php } ?>
                      <?php if( $product_count > 3 ){ ?>
                        <div class="products__content-col js-load-more" data-brand="<?php echo $brand_id; ?>">
                          <button type="button" class="product">
                            <div class="product__img product__img--blur">
                              <picture>
                                <source media="(min-width: 479px)" srcset="<?=THEME?>/dist/s/images/useful/products/1.png">
                                <source srcset="<?=THEME?>/dist/s/images/useful/products/1.png" type="image/webp">
                                <img src="<?=THEME?>/dist/s/images/useful/products/1.png" alt="img">
                              </picture>
                            </div>
                            <div class="product__overlap">
                              <svg width="1em" height="1em" class="icon icon-arr-large-down ">
                                <use xlink:href="<?=THEME?>/dist/s/images/useful/svg/theme/symbol-defs.svg#icon-arr-large-down"></use>
                              </svg><span class="product__overlap-txt">and more 
                                <strong>
                                <?php echo $product_count; ?>
                                </strong> <?php echo $brand; ?> products</span>
                              <div class="button button--regular"><span>View all products</span></div>
                            </div>
                          </button>
                        </div>
                      <?php } ?>
                </div>
            </div>
          <?php } ?>
        <?php } 

      endwhile;

  }

	$response = ob_get_contents();
	ob_end_clean();
	echo $response;
	die(1);
}