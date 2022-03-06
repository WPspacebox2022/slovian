

    <?php while ( have_rows('acf_page_components') ) : the_row(); 


        if( get_row_layout() == 'acf_page_component_banner') { 

            get_template_part('components/pages/banner/component'); 
 
        } 

        if( get_row_layout() == 'acf_page_component_submenu') { 

            get_template_part('components/pages/submenu/component'); 
 
        } 

        if( get_row_layout() == 'acf_page_component_information') { 

            get_template_part('components/pages/info/component'); 
 
        } 

        if( get_row_layout() == 'acf_page_component_contact') { 

            get_template_part('components/pages/contact/component'); 
 
        } 
        if( get_row_layout() == 'acf_page_component_advert') { 

            get_template_part('components/pages/advert/component'); 
 
        } 

    endwhile; ?>


