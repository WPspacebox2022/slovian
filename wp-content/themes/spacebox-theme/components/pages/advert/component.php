<div class="c-advert">
  <div class="c-advert__header">
    <p class="c-themes__title">
      <?php spacebox_get_field('acf_home_advert_title','null');?>
    </p>
    <div class="c-themes__line"></div>
  </div>
  <div class="c-advert__wrapper">
    <div class="c-new-issue">
     
      <?php
      $slider_ids = get_sub_field('acf_home_advert_relationship');

      $slider_args = array(
        'post_type' => 'magazine',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'post__in'       =>  $slider_ids,
        'orderby'        => 'post__in',
      );
      
      $slider = get_posts($slider_args);

      if( $slider ): ?>

          <?php foreach( $slider as $item ): setup_postdata($item); ?>

                <div class="c-new-issue__wrapper">
                    <h4 class="c-new-issue__description"><?php spacebox_get_the_title($item->ID);?></h4>
                    <div class="c-new-issue__image">
                      <?php spacebox_image_thumbnail($item , '400' , '536' );?>
                    </div>
                    <?php spacebox_button('acf_home_advert_btn_name', 'acf_home_advert_btn_link' , 'p' , 'c-new-issue__link');?>
                  </div>
                  <div class="c-issue-info">
                    <div class="c-issue-info__wrapper">
                        <?php spacebox_get_the_excerpt($item->ID, 'p' , 'c-issue-info__text' );?>
                       
                        <a href="<?php spacebox_get_the_permalink($item->ID);?>" target="_blank">
                          <p>читати</p>
                        </a>
                    </div>
                  </div>

          <?php endforeach; ?>

          <?php wp_reset_postdata(); ?>
      <?php endif; ?>
      
  </div>

  </div>
  <div class="swiper">
  <div class="swiper-wrapper">
  <?php
      $slider_ids = get_sub_field('acf_home_advert_relationship_slider');

      $slider_args = array(
        'post_type' => 'magazine',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'post__in'       =>  $slider_ids,
        'orderby'        => 'post__in',
      );
      
      $slider = get_posts($slider_args);

      if( $slider ): ?>

          <?php foreach( $slider as $item ): 

              setup_postdata($item); ?>

            <div class="swiper-slide">
                <a href="<?php spacebox_get_the_permalink($item);?>" target="_blank">
                  <picture>
                    <?php spacebox_image_thumbnail($item , '255', '342' );?>
                  </picture>
                </a>
              </div>

          <?php endforeach; ?>

          <?php wp_reset_postdata(); ?>
      <?php endif; ?>

  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
</div>