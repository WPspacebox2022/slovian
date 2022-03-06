<?php
	
// Swipex WP Helpers

	
add_filter(
    'intermediate_image_sizes',
    function ($sizes) {
        return array_diff(
            $sizes,
            array(
                // 'thumbnail',   
                'medium',   
                'large',      
                'medium_large',
                '1536x1536',  
                '2048x2048',
                'woocommerce_thumbnail',
                'woocommerce_single',
                'woocommerce_gallery_thumbnail',
                'shop_catalog',
                'shop_single',
                'shop_thumbnail'
            ) 
        );
    }
);



function h_dd($data){
	echo '<pre>';
		var_dump($data);
	echo '</pre>';
}


//  Field function

 function spacebox_get_field($post_field,$tag){

	if(get_field($post_field)){
		$data = get_field($post_field);
	} else{
		$data = get_sub_field($post_field);
	}

	if($data) {
		if($tag !== 'null' ) {
			echo '<' . $tag . '>';
		} 

		echo esc_html( $data );

		if($tag !== 'null') {
			echo '</' . $tag . '>';
		}
	}
}

//  Field function


function spacebox_global_field($field_name,$tag){

	$data = get_field($field_name,'option');

  	if($data) {
		if($tag !== 'null' ) {
			echo '<' . $tag . '>';
		} 

		the_field($field_name,'option');

		if($tag !== 'null') {
			echo '</' . $tag . '>';
		}
  	}
}

function spacebox_the_field($post_field,$tag){

	if(get_field($post_field)){
		$data = get_field($post_field);
	} else{
		$data = get_sub_field($post_field);
	}


  if($data) {
		if($tag !== 'null' ) {
			echo '<' . $tag . '>';
		} 

	  	if(get_field($post_field)){
			the_field($post_field);
		} else{
			the_sub_field($post_field);
		}

		if($tag !== 'null') {
			echo '</' . $tag . '>';
		}
  }
}

// Image background function

function spacebox_background_image($data , $widthSize , $heightSize ){
	$field = get_field($data);
	if( $field ){
		$path = spacebox_image_id($field);
	} else {
		$path = spacebox_image_id($data);
	}
	
	

    $thumb = spacebox_make_thumbnail($path, $widthSize, $heightSize , false); 
	$widthSize = strval($widthSize);
	$heightSize = strval($heightSize);
	
	if($thumb){ 
    	echo 'style="background-image: url('.$thumb.')"';
	} else { 
		echo 'style="background-image: url('. THEME . '/placeholder.jpg)"';
	}

}



// BG Color function 

function spacebox_background_color($field_name){
	$color = get_field($field_name);
	if($color){
		echo 'style="background-color:' . $color .' "';
	}
}

// Link function

function spacebox_button($field_name, $link_name , $tag ,$css_classes){
	
	$link_btn = get_sub_field($link_name);

	if($link_btn){
		$link_text = get_sub_field($field_name);
	} else{
		$link_btn = get_field($link_name);
		$link_text = get_field($field_name);
	}
	

	if($link_btn && $link_text) { ?>
		<a href="<?php echo $link_btn; ?>" class="<?php echo $css_classes; ?>">
			<?php if($tag !== 'null' ) {
				echo '<' . $tag . '>';
			} 

			 echo $link_text;

			if($tag !== 'null' ) {
				echo '</' . $tag . '>';
			} ?>
    	</a>
	<?php }
}

function spacebox_link($field_name){
	$link = get_field($field_name);

	if( !empty($link) ) { 
		echo esc_url( $link ); 
	}
}

function spacebox_get_the_permalink($post){

	$link = get_the_permalink($post);

	if( !empty($link) ) { 
		echo esc_url( $link ); 
	}
}

function spacebox_get_the_excerpt($post, $tag , $css_classes ){

	$excerpt = get_the_excerpt($post);

	if( !empty($excerpt) ) {
		if($tag !== 'null' ) {
			echo '<' . $tag . ' class="'.$css_classes.'">';
		} 
  
		echo esc_html($excerpt ); 
  
		if($tag !== 'null') {
			echo '</' . $tag . '>';
		}
	}
}

function spacebox_get_the_title($post){
	$title = get_the_title($post);
	if( !empty($title) ) { 
		echo esc_html( $title ); 
	}
}

// Language
function spacebox_languages() {

	if (function_exists('wpm_get_languages')) {

	  $languages = wpm_get_languages();
	  $acf_languages = get_field('acf_header_language_choiсe','option');
	  $current = wpm_get_language();

	  if( !empty($acf_languages) ){

		  $out = '<select class="wpm-language-switcher js-select2" data-placeholder="Choose language" title="Language Switcher" onchange="location = this.value;" >';

			  foreach ($languages as $code => $language) {

				  $toggle_url = esc_url(wpm_translate_current_url($code));
				  $css_classes = '';

				  foreach( $acf_languages as $item ){
					  
					  if(	$language['name'] === $item ){ 
						  if ($code === $current) {
							  $css_classes .= 'selected="selected" ';
						  }
						  $out .= '<option value="' . $toggle_url . '" ' . $css_classes . ' data-lang="' . esc_attr($code) . '">';
						  $out .= $language['name'];
						  $out .= '</option>';
					  }
				  }
			  }

		  $out .= '</select>';

		  return $out;
	  }

  }

}



// Optimaze Image
function spacebox_image_id($id){
	if( is_wp_error( $id ) ) {
		return '';
	}
	global $wpdb;
	$query = "SELECT meta_value as upload_path FROM wp_postmeta WHERE meta_key = '_wp_attached_file' AND post_id = " . $id;
	$result = $wpdb -> get_results($query);
	if( is_wp_error( $result ) ) {
		return '';
	}
	if(empty($result))
		return false;
	$upload_dir = wp_upload_dir();
	$path = $upload_dir['baseurl'] . '/' . $result[0] -> upload_path;
	$path = preg_replace('/https?\:\/\/(.+?)\//', '/', $path  );
	return $path;
}

function spacebox_make_thumbnail($path, $width, $height, $crop = true){
	if(preg_match('/https?:\/\//', $path))
		$path = $_SERVER['DOCUMENT_ROOT'] . preg_replace('/https?:\/\/' . $_SERVER['HTTP_HOST'] . '/', '', $path);
	elseif(preg_match('/^\//', $path))
		$path = $_SERVER['DOCUMENT_ROOT'] . $path;

	preg_match('/uploads\/(.+)(\/)(.+)\.(.+)/', $path, $matches);

	if(count($matches) < 5)
		return $path;

	$name_path_prefix = preg_replace('/\//', '_', $matches[1]);

	$crop_prefix = '';
	if($crop)
		$crop_prefix = 'crop_';

	$src = '/wp-content/uploads/thumbs/' . $crop_prefix . $matches[3] . $name_path_prefix . '_' . $width . '_' . $height . '.' . $matches[4];
	$file_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/thumbs/' . $crop_prefix . $matches[3] . $name_path_prefix . '_' . $width . '_' . $height . '.' . $matches[4];
	
	if(file_exists($file_path))
		return $src;

	$image = wp_get_image_editor( $path );
	
	if ( ! is_wp_error( $image ) ) {
	    $image->resize( $width, $height, $crop );
	    $image->save( $file_path );
	    return($src); 
	}
}




function spacebox_image_thumbnail($data , $widthSize , $heightSize ){
	$image = get_post_thumbnail_id($data);
	$path = spacebox_image_id($image);
	$widthSize = strval($widthSize);
	$heightSize = strval($heightSize);
	$alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);

    $thumb = spacebox_make_thumbnail($path, $widthSize, $heightSize , true); 
	
	if( $image ){ ?>
    	<img src="<?php echo esc_url($thumb); ?>" class="lazyloaded" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
	<?php } else { ?>
		<img src="<?php echo esc_url( THEME . '/placeholder.jpg'); ?>">
	<?php }


}






// Optimaze Image URL
function spacebox_image_url($data , $widthSize , $heightSize ){
	
    $image = get_post_thumbnail_id($data);
	$path = spacebox_image_id($image);
	$widthSize = strval($widthSize);
	$heightSize = strval($heightSize);

    $thumb = spacebox_make_thumbnail($path, $widthSize, $heightSize , true); 
	
	if( $image ){ 
    	return esc_url($thumb); 
	} else { 
		return esc_url( THEME . '/placeholder.jpg');
	}
}


// Optimaze Image 
function spacebox_image($nameField , $option , $widthSize , $heightSize ){

	if( $option == 'get_field' ){
		$data = get_field($nameField);
	}
	
	if( $option == 'get_sub_field' ){
		$data = get_sub_field($nameField);
	}

	if( $option == 'global' ){
		$data = get_field($nameField, 'option');
	}

	if( $option == 'repeater' or $option == 'gallery' or $option == 'post'){
		$data = $nameField;
	}


	// var_dump( $data['id'] );

	$path = spacebox_image_id($data['id']);
	$widthSize = strval($widthSize);
	$heightSize = strval($heightSize);
	$alt = get_post_meta($data, '_wp_attachment_image_alt', TRUE);
	$thumb = spacebox_make_thumbnail($path, $widthSize, $heightSize , true); 

	if( strpos( $path , 'svg')){ 

		if( isset($path) ){ ?>
			<img src="<?php echo esc_url($path); ?>" class="lazyloaded" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
		<?php } else { ?>
			<img src="<?php echo esc_url( THEME . '/placeholder.jpg'); ?>">
		<?php } 
	
	} else {

		if( isset($path) ){ ?>
			<img src="<?php echo esc_url($thumb); ?>" class="lazyloaded" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
		<?php } else { ?>
			<img src="<?php echo esc_url( THEME . '/placeholder.jpg'); ?>">
		<?php }  
	}

}

// get icon old
function swipexIcon($data){ 
	if($data) { ?>
		<svg width="1em" height="1em" class="icon <?php echo esc_html(get_field('acf_icon_id', $data[0] )); ?>">
			<use xlink:href="<?php echo THEME; ?>/dist/s/images/useful/svg/theme/symbol-defs.svg#<?php echo esc_html(get_field('acf_icon_id', $data[0] )); ?>"></use>
		</svg>
	<?php }
 }

//  icon new

 function spacebox_icon($field, $option) { 

	if( $option == 'get_field' ){
		$icon_ids = get_field($field);
	}
	
	if( $option == 'get_sub_field' ){
		$icon_ids = get_sub_field($field);
	}

	if( get_field('acf_icon_options_show',$icon_ids[0]) === 'icon_svg' ){

		the_field('acf_icon_custom_svg', $icon_ids[0]);

	} else{

		spacebox_image_thumbnail($icon_ids[0],'30','30');

	}
		
}


 // language prefix
function spacebox_get_lang_prefix() {
	if( function_exists('wpm_get_language') ){
		if( wpm_get_language() == 'en'){
			return esc_url( IS_FRONT );
		} else {
			return esc_url( IS_FRONT .'/'. wpm_get_language() );
		}
	}
}


// Logo function
function spacebox_logo(){?>
	<a href="<?php echo esc_url(spacebox_get_lang_prefix()); ?>" class="header__content-logo">
		<img src="<?php echo THEME; ?>/dist/s/images/useful/logo.svg"/>
	</a>
<?php }



function spacebox_category_name($data){ 
	$taxonomy_slug = 'category';
	$post_id = $data;
	
	$primary_cat_id = get_post_meta( $post_id, 'epc_primary_' . $taxonomy_slug , true );

	$tag_name = get_cat_name($primary_cat_id);

	if( !empty($tag_name) ){
		echo $tag_name;
	}
	
}

 
function spacebox_category_slug($post){ 

	$taxonomy_slug = 'category';
	$post_id = $post;
	$primary_cat_id = get_post_meta( $post_id, 'epc_primary_' . $taxonomy_slug , true );

	$tag_url = get_category_link($primary_cat_id);

	if( !empty($tag_url) ){
		echo $tag_url;
	}
 
}

function spacebox_taxonomy_name($post, $taxonomy_name ){ 

	$categories = get_the_terms( $post, $taxonomy_name );
    if($categories){
		foreach( $categories as $category ) {
			echo $category->name;
		}
	}
	
}

function spacebox_taxonomy_slug($post, $taxonomy_name){ 

	$categories = get_the_terms( $post, $taxonomy_name );
    if($categories){
		foreach( $categories as $category ) {
			echo get_term_link( $category->term_id, $category->taxonomy );
		}
	}
	
}

function spacebox_author_image($post , $size){

	$author_id = get_the_author_meta($post->ID);
    $author = get_the_author_meta( 'user_email', $author_id );
	echo get_avatar( $author , $size);
}

function spacebox_author_name($post){
	$author_id = get_the_author_meta('ID');
	echo get_the_author_meta('display_name', $author_id);
}

function spacebox_author_link($post){
	$post_id = get_the_author_meta('ID');
	echo get_author_posts_url( $post_id );

}

function spacebox_tags($post){
	$tags = get_the_tags($post);
                      
    if( $tags && ! is_wp_error($tags) ){
        foreach($tags as $tag){
            echo $tag->name . ',';
        }                         
    }
}


function spacebox_time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('тому');

}


function spacebox_category_list() {
	global $post;
	$terms = get_categories($post->ID);

	function spacebox_term_active($term){
		if( single_cat_title( '', false ) == $term->name ){
			return ' class="active" ';
		}
	}

    if( $terms && ! is_wp_error($terms) ){
		echo '<ul>';
        foreach($terms as $term){
            echo '<li><a '.spacebox_term_active($term).' href="'.get_term_link($term).'">'.$term->name.'</a></li>';   
        } 
		echo '</ul>';                         
    } 
}

function spacebox_video_or_image($nameField , $posterField  , $widthSize, $heightSize  ){
	
	$data = get_sub_field($nameField)[0];
	$posterField = get_sub_field($posterField);
	if( isset($posterField) ){ 	// if image ID

		$path = spacebox_image_id($posterField['id']);
	
		if( strpos( $data['url'] , 'mp4') ){ // if video
			
			$widthSize = strval($widthSize);
			$heightSize = strval($heightSize);
			$posterUrl = spacebox_make_thumbnail($path, $widthSize, $heightSize , false); 
	
			echo '<video 
				preload="auto" 
				height="'.$heightSize.'" 
				width="' . $heightSize . '" 
				autoplay="autoplay" 
				playsinline="playsinline" 
				muted="muted" 
				loop="loop" 
				poster="'. esc_url($posterUrl) .'">
					<source src="' . esc_url($data['url']).'" type="' . esc_attr($data['mime_type']).'"/>
			</video>';
		} 
	}
	
	if( strpos( $data['url'] , 'jpg') or strpos( $data['url'] , 'png') or  strpos( $data['url'] , 'svg') ) { // if image

		if( isset($data['id']) ){ 		// if image ID
			$path = spacebox_image_id($data['id']);
			$widthSize = strval($widthSize);
			$heightSize = strval($heightSize);
			$alt = get_post_meta($data, '_wp_attachment_image_alt', TRUE);
			$thumb = spacebox_make_thumbnail($path, $widthSize, $heightSize , false); 
		

			if( strpos( $path , 'svg')){ ?> <!-- if image svg  -->

				<img src="<?php echo $path?>" class="lazyloaded" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
			
			<?php } else { 	// if images format			
				if( isset($data['id']) ){ ?> 
					<img src="<?php echo esc_url($thumb); ?>" class="lazyloaded" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
				<?php } 			
			}

		} 
	}
	
	if( empty($data['url']) ){
		echo 'Not found!';
	}

}

function spacebox_post_video_or_image($post_id){

	$video = get_field('acf_post_video');


	if( isset($video['url']) ){

			echo '<video 
				preload="auto" 
				controls>
					<source src="' . esc_url($video['url']).'" type="' . esc_attr($video['mime_type']).'"/>
			</video>';
		
		echo '<a class="lt-video" href="' . $video['url'].'"><i class="fa fa-play"></i></a>';
	
	} else {
		
		spacebox_image_thumbnail( $post_id , '245' , '120');
		echo '<a class="lt-video lt--image" href="' . spacebox_image_url($post_id , '900' , '500').'"></a>';
	}
}

function spacebox_wp_query( $args ){
	return new WP_Query( $args );
}



function spacebox_page_active($page){
	if(get_the_title() == get_the_title($page)){
		echo 'active';
	}
}