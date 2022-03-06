<?php




function h_dd($data){
	echo '<pre>';
		var_dump($data);
	echo '</pre>';
}


function ft( $data ){

	if( strpos( $data , '</p>')  == true ){
		$order = ['<p>','</p>'];
		return strip_tags( $data , $order );

	} else {
		return $data;
	}
}


if( !function_exists('setImage') ){
	function setImage( $link , $alt , $title , $caption ) { ?>
  
	  <figure>
		<picture>
		  <img src="<?php echo $link; ?>" alt="<?php echo $alt; ?>" title="<?php echo $title; ?>">
		</picture>
		<?php if( $caption ){ ?>
		  <figcaption>
			<?php echo $caption; ?>
		  </figcaption>
		<?php } ?>
	  </figure>
  
	<?php }
  }



  // Helper Function



// Icon function

function swipex_icon($field){

	$icon_ids = get_sub_field($field);

	$icon_args = array(
		'post_type' => 'icons',
		'posts_per_page' => 1,
		'order'          => 'ASC',
		'post_status'    => 'publish',
	);

	$icons = get_posts($icon_args); 
				
		foreach( $icons as $icon ):  ?>
			<svg width="1em" height="1em" class="icon icon-effect-decor">
				<use xlink:href="<?=THEME?>/dist/s/images/useful/svg/theme/symbol-defs.svg#<?php echo get_field('acf_icon_id', $icon->ID); ?>"></use>
			</svg>
		<?php endforeach; ?>

		<?php wp_reset_postdata(); 

	}

//  Field function

 function swipex_get_field($post_field,$tag){

  	$data = get_sub_field($post_field);

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

function swipex_the_field($post_field,$tag){

	$data = get_sub_field($post_field);

  if($data) {
	  if($tag !== 'null' ) {
		  echo '<' . $tag . '>';
	  } 

	  echo esc_html( the_sub_field($post_field) );

	  if($tag !== 'null') {
		  echo '</' . $tag . '>';
	  }
  }
}

// Image background function

function swipex_background_Image($data , $widthSize , $heightSize ){
	if( $data['id'] ){
		$path = teil_get_image_by_id($data['id']);
	} else {
		$path = teil_get_image_by_id($data);
	}

    $thumb = teil_make_thumbnail($path, $widthSize, $heightSize , false); 
	$widthSize = strval($widthSize);
	$heightSize = strval($heightSize);
	
	if( $data ){ 
    	return $thumb;
	} else { 
		return THEME . '/placeholder.jpg';
	}

}

// Image function

function swipexImage($data , $widthSize , $heightSize ){

	if( $data['id'] ){
		$path = teil_get_image_by_id($data['id']);
	} 
	
	$widthSize = strval($widthSize);
	$heightSize = strval($heightSize);

	$thumb = teil_make_thumbnail($path, $widthSize, $heightSize , false); 

	if( strpos( $path , 'svg')){ ?>

		<img src="<?=$path?>" class="lazyloaded" alt="<?=$data['alt']?>" loading="lazy">
	
	<?php } else {
		if( $data['id'] ){ ?>
			<img src="<?=$thumb?>" class="lazyloaded" alt="<?=$data['alt']?>" loading="lazy">
		<?php } else { ?>
			<img src="<?=THEME?>/placeholder.jpg">
		<?php }  
	}

}

// BG Color function 

function swipex_background_color($field){
	$color = get_sub_field($field);
	if($color){?>
		style="background-color:<?php echo $color; ?>;"
	<?php }
}

// Link function

function swipex_button($field_name, $link_name, $tag, $css_classes){
	$link_btn = get_sub_field($link_name);
	$link_text = get_sub_field($field_name);

	if($link_btn && $link_text) { ?>
		<a href="<?php echo $link_btn; ?>" class="button <?php echo $css_classes; ?>"> 
		<?php if($tag !== 'null') {
		  		echo '<' . $tag . '>';
				}

	  		 	echo $link_text; 

			   if($tag !== 'null') {
		  		echo '</' . $tag . '>';
	  			} ?>
    	</a>
	<?php }
}

function swipex_link($field_name){
	$link = get_sub_field($field_name);

	if( !empty($link) ) { 
		echo esc_url( $link ); 
	}
}

// Logo function

function swipexLogo(){?>

	<a href="<?php echo home_url(); ?>" class="header__content-logo">
		<img src="./s/images/useful/logo.svg"/>
	</a>
<?php }


// Language
function swipex_languages() {

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
function swipex_image_id($id){
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

function swipex_make_thumbnail($path, $width, $height, $crop = true){
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


function swipex_image($nameField , $widthSize , $heightSize ){

		$data = get_sub_field($nameField);

		if( isset($data['id']) ){
			$path = swipex_image_id($data['id']);
		} 
		
		$widthSize = strval($widthSize);
		$heightSize = strval($heightSize);
		$alt = get_post_meta($data, '_wp_attachment_image_alt', TRUE);
		$thumb = swipex_make_thumbnail($path, $widthSize, $heightSize , false); 

        if( strpos( $path , 'svg')){ ?>

            <img src="<?php echo $path?>" class="lazyloaded" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
        
        <?php } else {
            if( isset($data['id']) ){ ?>
                <img src="<?php echo esc_url($thumb); ?>" class="lazyloaded" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
            <?php } else { ?>
                <img src="<?php echo esc_url( THEME . '/placeholder.jpg'); ?>">
            <?php }  
        }

}

function swipex_image_thumbnail($data , $widthSize , $heightSize ){
	
    $path = swipex_image_id($data);
	$widthSize = strval($widthSize);
	$heightSize = strval($heightSize);
	$alt = get_post_meta($data, '_wp_attachment_image_alt', TRUE);
    $thumb = swipex_make_thumbnail($path, $widthSize, $heightSize , false); 
	
	if( $data ){ ?>
    	<img src="<?php echo esc_url($thumb); ?>" class="lazyloaded" alt="<?php echo esc_attr($alt); ?>" loading="lazy">
	<?php } else { ?>
		<img src="<?php echo esc_url( THEME . '/placeholder.jpg'); ?>">
	<?php }

}



function swipex_video_or_image($nameField , $posterField , $muted ,$autoplay , $widthSize, $heightSize  ){
	
	$data = get_sub_field($nameField)[0];
	$posterField = get_sub_field($posterField);
	if( isset($posterField) ){ 	// if image ID

		$path = swipex_image_id($posterField['id']);
	
		if( strpos( $data['url'] , 'mp4') ){ // if video
			
			$widthSize = strval($widthSize);
			$heightSize = strval($heightSize);
			$posterUrl = swipex_make_thumbnail($path, $widthSize, $heightSize , false); 
	
			echo '<video 
				preload="auto" 
				height="'.$heightSize.'" 
				width="' . $heightSize . '" 
				autoplay="' . esc_attr($autoplay) .'" 
				playsinline="playsinline" 
				muted="'. esc_attr($muted) .'" 
				loop="loop" 
				poster="'. esc_url($posterUrl) .'">
					<source src="' . esc_url($data['url']).'" type="' . esc_attr($data['mime_type']).'"/>
			</video>';
		} 
	}
	
	if( strpos( $data['url'] , 'jpg') or strpos( $data['url'] , 'png') or  strpos( $data['url'] , 'svg') ) { // if image

		if( isset($data['id']) ){ 		// if image ID
			$path = swipex_image_id($data['id']);
			$widthSize = strval($widthSize);
			$heightSize = strval($heightSize);
			$alt = get_post_meta($data, '_wp_attachment_image_alt', TRUE);
			$thumb = swipex_make_thumbnail($path, $widthSize, $heightSize , false); 
		

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


// Optimaze Image URL
function swipex_image_url($data , $widthSize , $heightSize ){

	if ( isset($data['id']) ) {
		$path = swipex_image_id($data['id']);
	} else {
		$path = swipex_image_id($data);
	}

    $thumb = swipex_make_thumbnail($path, $widthSize, $heightSize , false); 
	$widthSize = strval($widthSize);
	$heightSize = strval($heightSize);
	
	if( isset($data) ){ 
    	return esc_url($thumb);
	} else { 
		return esc_url(THEME.'/placeholder.jpg');
	}

}

// get icon
function swipex_get_icon($data){ 
	if($data) { ?>
		<svg width="1em" height="1em" class="icon <?php echo esc_html(get_field('acf_icon_id', $data[0] )); ?>">
			<use xlink:href="<?php echo THEME; ?>/dist/s/images/useful/svg/theme/symbol-defs.svg#<?php echo esc_html(get_field('acf_icon_id', $data[0] )); ?>"></use>
		</svg>
	<?php }
 }