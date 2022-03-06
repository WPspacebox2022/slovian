
<?php 

    while ( have_rows('acf_home_components') ) : the_row(); 

        if( get_row_layout() == 'acf_home_component_banner') { 

            get_template_part('components/home/banner/component'); 

        } 


        if( get_row_layout() == 'acf_component_news_list') { 

            get_template_part('components/home/news.list/component'); 

        }


        if( get_row_layout() == 'acf_home_component_text') { 

            get_template_part('components/home/text/component');
        }


    endwhile; 

?>