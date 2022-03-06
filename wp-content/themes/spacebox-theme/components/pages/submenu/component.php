<div class="c-submenu">
  <div class="c-submenu__image_wrapper">
    <div class="c-submenu__image c-submenu__image--left">
        <?php spacebox_image('acf_home_info_image_left' , 'get_sub_field' , '500' , '250' );?>
    </div>
    <div class="c-submenu__image c-submenu__image--right">
        <?php spacebox_image('acf_home_info_image_right' , 'get_sub_field' , '500' , '250' );?>
    </div>
  </div>
  
  <div class="c-submenu__wrapper">
  <?php
          $pages = get_sub_field('acf_home_info_page_select');
          if( $pages ): ?>
              <ul class="c-submenu__list">
              <?php foreach( $pages as $page ): setup_postdata($page);?>
                <li>
                  <a href="<?php spacebox_get_the_permalink($page); ?>">
                    <span class="c-submenu__text">
                      <?php spacebox_get_the_title($page); ?>
                    </span>
                  </a>
                </li>
              <?php endforeach; ?>
              </ul>
              <?php  wp_reset_postdata(); ?>
          <?php endif; ?>
  </div>
</div>

