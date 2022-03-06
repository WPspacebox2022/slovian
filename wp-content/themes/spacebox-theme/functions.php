<?php

/* Implement the Main feature. */
require get_template_directory() . '/inc/index.php';

/* Implement Admin Utilities. */
require get_template_directory() . '/inc/admin/customizer.php';
require get_template_directory() . '/inc/admin/admin-dashboard.php';

/* Implement Custom Post Types. */
require get_template_directory() . '/inc/custom-types/types.php';

/* Implement ACF functions. */
require get_template_directory() . '/inc/acf/acf.php';

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/helpers/helpers.php';

/* Implement Functional Utilities. */
require get_template_directory() . '/inc/utilities/utilities.php';


/* Implement the filters feature. */
require get_template_directory() . '/inc/filters.php';

/* Implement the hooks feature. */
require get_template_directory() . '/inc/hooks.php';

















