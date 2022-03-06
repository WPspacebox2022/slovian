<?php

// do_shortcode
add_filter('the_content', 'do_shortcode');

// Excerpt more
add_filter('excerpt_more', function($more) {
	return '...';
});