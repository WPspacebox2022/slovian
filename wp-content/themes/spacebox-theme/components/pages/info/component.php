<div class="c-info">
  <div class="c-info__wrapper">
    <div class="c-themes">
  <div class="c-themes__wrapper">
    <p class="c-themes__title"><?php spacebox_the_field('acf_category_title','null');?> </p>
    <div class="c-themes__line"></div>
    <?php 
        $terms = get_sub_field('acf_category_taxonomy');
        if( $terms ):
          echo '<ul class="c-themes__list">';
             foreach( $terms as $term ): ?>

             <li class="c-themes__item">
              <div class="c-themes__icon c-themes__icon--red"></div>
              <a href="<?php echo esc_url( get_term_link( $term )); ?>" target="_blank">
                <p><?php echo esc_html( $term->name );?></p>
              </a>
            </li>
            <?php endforeach; 
            echo '</ul>';
         endif; ?>
  </div>
</div>
    <div class="c-info__block">
      <div class="c-news-brief">
  <div class="c-news-brief__wrapper">
    <p class="c-news-brief__title"><?php spacebox_the_field('acf_news_title_copy','null');?></p>
    <div class="c-news-brief__block">
    <?php
      $news_ids = get_sub_field('acf_news_relationship');

      $news_args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'post__in'       =>  $news_ids,
        'orderby'        => 'post__in',
      );
      
      $news = get_posts($news_args);

      if( $news ): ?>
        
          <?php foreach( $news as $item ): 

              setup_postdata($item); ?>

              <div class="c-news-brief__item">
                <span class="c-news-brief__date"><?php the_date(); ?></span>
                <a href="<?php spacebox_get_the_permalink($item); ?>">
                  <p><?php spacebox_get_the_title($item);?></p>
                </a>
              </div>

          <?php endforeach; ?>

          <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
    <?php spacebox_button('acf_news_btn_name', 'acf_news_btn_link' , 'null' , 'c-news-brief__link');?>
  </div>
</div>
      <div class="c-info__image">
        <picture>
          <?php spacebox_image('acf_news_image' , 'get_sub_field' , '950' , '59' );?>
        </picture>
      </div>
    </div>
  </div>
</div>