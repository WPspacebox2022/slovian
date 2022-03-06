<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <title><?php wp_title("", true); ?><?php echo get_bloginfo('name'); ?></title>

    <!-- Optional styles-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,500&amp;display=swap" rel="stylesheet">
 
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
 
           
<div class="h-wrapper">    
     <header class="header">
       <div class="header__desktop">
          <div class="container">
            <div class="header__wrapper">
              <div class="header__logo">
                <a href="<?php echo HOME ?>">
                  <?php spacebox_image('acf_header_logo' , 'global' , '90' , '88' ); ?>
                </a>
              </div>
              <div class="header__inner">
               
                <nav class="header__navigation">
                  <?php echo header_menu(); ?>
                </nav>

                <?php if( has_nav_menu('header-lang') ){ ?>
                  <div class="header__language">
                    <?php echo header_lang(); ?>
                  </div>
                <?php } ?>

                <div class="header__search">
                  <?php spacebox_image('acf_header_search' , 'global' , '30' , '40' ); ?>
                </div>

              </div>
           </div>

         </div>
       </div>

       <div class="header__mobile">
         <div class="header_wrapper">
           <div class="container">
           <nav class="c-menu-sm">
              <ul class="c-menu-sm__container">
                <div class="c-menu-sm__button">x</div>
                <li class="c-menu-sm__item">
                  <a href="index.html">
                    <p class="c-menu-sm__text">Головна</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="about.html">
                    <p class="c-menu-sm__text">Про нас</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="news.html">
                    <p class="c-menu-sm__text">Новини</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="nomery.html">
                    <p class="c-menu-sm__text">Номери</p>
                  </a>
                </li>
                <li class="c-menu-sm__item" id="contact-link">
                  <a href="index.html#contacts">
                    <p class="c-menu-sm__text">Контакти</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="about.html#magazine-policy">
                    <p class="c-menu-sm__text">Політика журналу</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="about.html#counsel">
                    <p class="c-menu-sm__text">Редакційна рада</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="policy.html">
                    <p class="c-menu-sm__text">Політика рецензування</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="pravyla.html">
                    <p class="c-menu-sm__text">Правила оформлення</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="rights.html">
                    <p class="c-menu-sm__text">Авторські права</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="ethics.html">
                    <p class="c-menu-sm__text">Етика щодо публікацій</p>
                  </a>
                </li>
                <li class="c-menu-sm__item">
                  <a href="archyv.html">
                    <p class="c-menu-sm__text">архів</p>
                  </a>
                </li>
              </ul>
          </nav>
         </div>
        </div>
       </div>
     </header>


     