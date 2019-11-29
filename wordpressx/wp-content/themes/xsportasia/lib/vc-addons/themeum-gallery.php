<?php
add_shortcode( 'themeum_gallery', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'style' 						=> 'style1',
		'category' 						=> '',
		'number' 						=> '6',
		'overlay' 						=> 'yes',
		'class' 						=> '',
        'order_by'  					=> 'date',          
        'order'   						=> 'DESC',      
		), $atts));

 	global $post;

 	$output     = '';
 	
  	if (isset($category) && $category!='') {
 		$idObj 	= get_category_by_slug( $category );
 		
 		if (isset($idObj) && $idObj!='') {
			$idObj 	= get_category_by_slug( $category );
			$cat_id = $idObj->term_id;

			$args = array( 
		    	'category' 			=> $cat_id,
		        'orderby' 			=> $order_by,
		        'order' 			=> $order,
		        'posts_per_page' 	=> $number,

		    );
		    $posts = get_posts($args);
 		}else{
 			echo "Please Enter a valid category name";
 			$args = 0;
 		}
 		}else{
			$args = array( 
		        'orderby' 			=> $order_by,
		        'order' 			=> $order,
		        'posts_per_page' 	=> $number,
		    );
		    $posts = get_posts($args);
	 	}

    if(count($posts)>0) {

    	if ($style == 'style1') {

    		$output .= '<div class="themeum-gallery '.esc_attr($class).'">';
    		
    		$output .= '<div id="galleryslider" class="gallery-controll flexslider">';
		    	$output .= '<ul class="slides">';
			    foreach ($posts as $post): setup_postdata($post);
			    if ( has_post_thumbnail() && ! post_password_required() ){
				    $output .= '<li class="all-slides">';
				    $output .= '<div class="themeum-overlay-wrap '.esc_attr($overlay).'">';
				    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'heighlights', array('class' => 'img-responsive')).'</a>';
				    $output .= '</div>';
					$output .= '</li>';
				}
			    endforeach;
			    wp_reset_postdata();   
			    $output .= '</ul>';
			$output .= '</div>';

		    # Controllers
			$output .= '<div id="gallerycarousel" class="gallery-controll-thumb flexslider">';
			$output .= '<ul class="slides gallery-thumb-image">';
			foreach ($posts as $post): setup_postdata($post);
			 if ( has_post_thumbnail() && ! post_password_required() ){
				$output .= '<li>';
				$output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'blog-thumb', array('class' => 'img-responsive')).'</a>';
				$output .= '</li>';
			}
			endforeach;
		    wp_reset_postdata();   
			$output .= '</ul>';
			$output .= '</div>';
			$output .= '</div>'; # themeum-gallery
		}elseif ($style == 'style3') {

	    	


		    	$output .= '<div class="row themeum-video-post-style2 '.$class.'">';
				$j = 1;
			    foreach ($posts as $post): setup_postdata($post);
			    if ( $j == 1 ) { 
				    $output .= '<div class="col-sm-6">';
				    $output .= '<div class="themeum-video-post-item">';
				    if ( has_post_thumbnail() ) {	
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'popular-post', array('class' => 'img-responsive')).'</a>';
					}
					$output .= '</div>';	
					$output .= '</div>';	
						
				}elseif ($j == 2 || $j == 3) {
					$output .= '<div class="col-sm-3">';
				    $output .= '<div class="gallery-post-col-3">';
				    if ( has_post_thumbnail() ) {
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'popular-post', array('class' => 'img-responsive')).'</a>';
					}
					$output .= '</div>';
					$output .= '</div>';	

				} else{
					$output .= '<div class="col-sm-6">';
					    $output .= '<div class="gallery-post-col-6">';
					    if ( has_post_thumbnail() ) {	
						    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'blog-full', array('class' => 'img-responsive')).'</a>';
						}		
						$output .= '</div>';
					$output .= '</div>';
				}

				$j++;
				
			    endforeach;
			    wp_reset_postdata();   
			    
			    $output .= '</div>'; # Themeum-video-post-style2

			

		}else {

			$output .= '<div class="row">';
			$output .= '<div class="themeum-gallery thm-gallery-style2 col-md-10 '.esc_attr($class).'">';
    		$output .= '<div id="galleryslider" class="gallery-controll flexslider">';
	    	$output .= '<ul class="slides">';
		    foreach ($posts as $post): setup_postdata($post);
		    if ( has_post_thumbnail() && ! post_password_required() ){
			    $output .= '<li class="all-slides">';
			    $output .= '<div class="themeum-overlay-wrap '.esc_attr($overlay).'">';
			    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'heighlights', array('class' => 'img-responsive')).'</a>';
			    $output .= '</div>';
				$output .= '</li>';
			}
		    endforeach;
		    wp_reset_postdata();   
		    $output .= '</ul>';
			$output .= '</div>';

		    # Controllers
			$output .= '<div id="gallerycarousel" class="thum-style2 gallery-controll-thumb flexslider col-md-2">';
			$output .= '<ul class="slides gallery-thumb-image">';
			foreach ($posts as $post): setup_postdata($post);
			 if ( has_post_thumbnail() && ! post_password_required() ){
				$output .= '<li>';
				$output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'blog-thumb', array('class' => 'img-responsive')).'</a>';
				$output .= '</li>';
			}
			endforeach;
		    wp_reset_postdata();   
			$output .= '</ul>';
			$output .= '</div>';
			$output .= '</div>'; //themeum-gallery
			$output .= '</div>'; //themeum-gallery

		}
			     
	}

	return $output;

});

function themeum_sp_cat_list(){
	$cat_lists = get_categories();
	$all_cat_list = array('All Category'=>'');
	foreach($cat_lists as $cat_list){
		$all_cat_list[$cat_list->cat_name] = $cat_list->cat_name;
	}
	return $all_cat_list;
}
# Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" 			=> __("Gallery", "themeum"),
		"base" 			=> "themeum_gallery",
		'icon' 			=> 'icon-thm-gappery',
		"class" 		=> "",
		"description" 	=> __("Widget Title Heading", "themeum"),
		"category" 		=> __('Themeum', "themeum"),
		"params" 		=> array(	

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "themeum"),
				"param_name" 	=> "style",
				"value" 		=> array('Select'=>'','Style1'=>'style1','Style2'=>'style2', 'Style3'=>'style3'),
			),			
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Category Filter", "themeum"),
				"param_name" 	=> "category",
				"value" 		=> themeum_sp_cat_list(),
			),	
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Image Overlay", "themeum"),
				"param_name" 	=> "overlay",
				"value" 		=> array('Select'=>'','Select'=>'','YES'=>'yes','NO'=>'no'),
			),			
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Number of items", "themeum"),
				"param_name" 	=> "number",
				"value" 		=> "",
			),	
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("OderBy", "themeum"),
				"param_name" 	=> "order_by",
				"value" 		=> array('Select'=>'','Date'=>'date','Title'=>'title','Modified'=>'modified','Author'=>'author','Random'=>'rand'),
			),	
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Order", "themeum"),
				"param_name" 	=> "order",
				"value" 		=> array('Select'=>'','DESC'=>'DESC','ASC'=>'ASC'),
			),	
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Custom Class", "themeum"),
				"param_name" 	=> "class",
				"value" 		=> "",
			),	
		)
	));
}