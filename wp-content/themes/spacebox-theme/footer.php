
    <?php wp_footer(); ?>

    <footer class="footer">
      <div class="c-footer__wrapper">
        <div class="c-footer__block">
          <div class="c-footer__text">
            <a href="http://www.etnolog.org.ua/" target="_blank">
              <span>© ІМФЕ</span>
            </a>
          </div>
          <div class="c-footer__logo">
            <?php if( get_field('acf_footer_logo','option') ){ ?>
              <a href="<?php echo HOME ?>">
                <?php spacebox_image('acf_footer_logo' , 'global' , '90' , '88' ); ?>
              </a>
            <?php } ?>
          </div>
          <div class="c-footer__date">
            <span>2022</span>
          </div>
        </div>
      </div>
    </footer>
  </div> 
  </body>
</html>