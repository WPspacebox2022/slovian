<?php 

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}



get_header();  
the_post(); 
global $product; 

?>

<main class="main">
    <section class="section product-card">
        <div class="container">
            <div class="product-card__content">
              <div class="product-card__content-main">
                <div class="product-card__content-main-mobile-ttl">
                  <h2>
                    <?php the_title($product->ID); ?>
                  </h2>
                </div>

                <?php if(has_post_thumbnail( $product->ID )){ ?>
                    <div class="product-card__content-main-img">
                        <picture>
                            <?php echo wp_get_attachment_image(get_post_thumbnail_id($product->ID), array( 640,584 )); ?>
                        </picture>
                    </div>
                <?php } ?>

                <div class="product-card__content-main-banner">
                    <svg width="1em" height="1em" class="icon icon-partners ">
                        <use xlink:href="<?=THEME?>/dist/s/images/useful/svg/theme/symbol-defs.svg#icon-partners"></use>
                    </svg>
                    <p>Please contact our manager to discuss collaboration details directly via message form or 
                        <a href="<?=HOME?>/#contact-form">Telegram</a>. 
                    </p>
                    <a href="<?=HOME?>/#contact-form" class="button button--regular"><span>Become a partner</span></a>
                </div>

              </div>
              <div class="product-card__content-about">
                <h2>
                <?php the_title($product->ID); ?>
                </h2>
                <div class="product-card__content-about-info">

                  <div class="product-card__content-about-line">
                   
                        <?php 
                    
                            $brand_terms = get_the_terms( $product->ID, 'brands' );

                            if($brand_terms){ ?>

                                <div class="product-card__content-about-logo">
                                    <picture>
                                        <img src="<?php echo get_field('acf_product_brand_image',$brand_terms[0]); ?>" alt="<?php echo $brand_terms[0]->name; ?>">
                                    </picture>
                                </div>
                                
                            <?php }

                            $categories = get_the_terms( get_the_ID(), 'product_cat' );
                            if( $categories && ! is_wp_error($categories) ){
                                foreach($categories as $cat){ ?>
                                    <span class="product-card__content-about-tag about--category tag--<?php echo $categories[0]->slug; ?>">
                                        <?php echo $cat->name; ?>
                                    </span>
                                <?php }                         
                            }

                            $tags = get_the_terms( get_the_ID(), 'product_tag' );
                            if( $tags && ! is_wp_error($tags) ){
                                foreach($tags as $tag){ ?>
                                    <span class="product-card__content-about-tag about--tag">
                                        <?php echo $tag->name; ?>
                                    </span>
                                <?php }                         
                            }
                        ?>
                  </div>
                  <?php $short = wpautop(get_the_content($product->ID)); ?>
                  <div class="product-card__content-about-info-list js-specifications">
                    <div class="js-specifications__short-content" <?php if( strlen($short) < 500 ){ echo 'style="height: auto"'; }?> >
                        <?php   
                            echo $short;
                        ?>
                    </div>

                    <div class="js-specifications-content"></div>

                    <?php 
                    if( strlen($short) > 500 ){ ?>
                        <button type="button" class="product-card__content-about-info-list-btn-mobile js-specifications-btn"><span>All specifications</span>
                        <svg width="1em" height="1em" class="icon icon-arr-down ">
                            <use xlink:href="<?=THEME?>/dist/s/images/useful/svg/theme/symbol-defs.svg#icon-arr-down"></use>
                        </svg>
                        </button>
                    <?php } ?>

                  </div>
                    <div class="product-card__content-about-link">
                      <a href="<?=HOME?>" class="button button--empty">
                          <span>Back to Catalogue</span>
                        </a>
                    </div>
                </div>
              </div>
              <div class="product-card__content-mobile-banner">
                <svg width="1em" height="1em" class="icon icon-partners ">
                  <use xlink:href="<?=THEME?>/dist/s/images/useful/svg/theme/symbol-defs.svg#icon-partners"></use>
                </svg>
                <h2>Become a partner</h2>
                <p>Please contact our manager to discuss collaboration details directly via Message form or 
                    <a href="<?=HOME?>/#contact-form">Telegram</a>. 
                </p>
                <a href="<?=HOME?>/#contact-form" class="button button--regular">
                    <span>Become a partner</span>
                </a>
              </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>