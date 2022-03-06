<?php

    get_header(); 

    $s = get_search_query();

    global $wpdb;

    $products = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = 'product' AND post_title LIKE '%s'", '%'. $wpdb->esc_like( $s ) .'%') );

    if ( $products) { ?>
        <main class="main">
          <section class="section products search-result">
            <div class="container">
              <div class="products__content">
                <div class="products__content-chapter"> 
                  
                  <div class="products__content-search-results">
                  
                    <h2>Search Results: <strong> <?php echo get_query_var('s'); ?> </strong></h2>
                  </div>

                  <div class="products__content-row">
                    <?php foreach( $products as $index => $product ){  ?>
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
                                
                                <?php $categories = get_the_terms( get_the_ID(), 'product_cat' );
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
            </div>
          </section>
        </main>
    <?php } else { ?>

        <main class="main main--search-no-results">
         
              <div class="products__content-search-results">
                <h2>Search Results: <strong> <?php $string = get_query_var('s'); echo mb_substr($string, 0, 13); ?>...</strong></h2>
              </div>
              <p>Nothing found, try again </p>
              <form class="search-again"  action="<?php echo home_url( '/' ); ?>"  method="GET">
                <div class="form-group">
                  <div class="input-wrap">
                    <input type="text" placeholder="Search pharm" name="s" required="required" class="form-control form-control"/>
                  </div>
                </div>
                <button type="submit" class="header__content-search-submit">
                  <svg width="1em" height="1em" class="icon icon-search ">
                    <use xlink:href="<?=THEME?>/dist/s/images/useful/svg/theme/symbol-defs.svg#icon-search"></use>
                  </svg>
                </button>
              </form>
      
      </main>
  <?php } ?>
<?php get_footer(); ?>