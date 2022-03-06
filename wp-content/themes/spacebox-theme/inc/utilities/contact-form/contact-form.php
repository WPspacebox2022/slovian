<?php

// form

add_filter('wpcf7_form_elements', function($content) {
$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

return $content;
});

// contact-form 7
add_filter('wpcf7_autop_or_not', '__return_false');



add_filter('wpcf7_form_elements', function($content) {
    preg_match_all('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', $content,$matches);

    foreach($matches[2] as $match):
        $content = str_replace(trim($match),trim(preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $match)),$content);
    endforeach;
    return $content;
});
