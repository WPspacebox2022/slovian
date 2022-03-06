<div class="c-contacts" id="contacts">
  <div class="c-contacts__wrapper">
    <p class="c-contacts__title"><?php spacebox_the_field('acf_contact_title','null');?></p>
    <div class="c-contacts__block">
      <div class="c-contacts__left">
      <?php

          if( have_rows('acf_contact_repeater') ):

              while( have_rows('acf_contact_repeater') ) : the_row();?>
              <a href="<?php spacebox_the_field('acf_contact_link','null');?>" class="c-contacts__link1">
                <div class="c-contacts__left__item">
                  <div class="c-contacts__icon">
                    <?php spacebox_icon('acf_contact_repeator_icon', 'get_sub_field');?>
                  </div>
                  <p class="c-contacts__text1">
                    <?php spacebox_the_field('acf_contact_name','null');?>
                  </p>
                </div>
              </a>

              <?php endwhile;

          endif;?>

      </div>
      <div class="c-contacts__right">
        <div class="c-contacts__item">
          <?php spacebox_the_field('acf_contact_editor','null');?>
      </div>
    </div>
  </div>
</div>