<div class="c-banner">
  <div class="c-banner__wrapper">
    <div class="c-banner__title">
      <div class="c-banner__letter">
        <picture>
            <?php spacebox_image('acf_home_banner_image_left' , 'get_sub_field' , '270' , '375' );?>
        </picture>
      </div>
      <div class="c-banner__text__wrapper">
        <h1 class="c-banner__text c-banner__text--big"><?php spacebox_get_field('acf_home_banner_title','null');?></h1>
        <h2 class="c-banner__text c-banner__text--small"><?php spacebox_get_field('acf_home_banner_subtitle','null');?></h2>

      </div>
    </div>
    <div class="c-banner__image">
      <picture>
        <?php spacebox_image('acf_home_banner_image_right' , 'get_sub_field' , '400' , '566' );?>
      </picture>
    </div>
  </div>
</div>