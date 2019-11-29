<?php
add_shortcode( 'themeum_latest_post', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'category' 						=> '',
		'style' 						=> 'style1',
		'overlay' 						=> 'yes',
		'number' 						=> '6',
		'class' 						=> '',         
        'order'   						=> 'DESC',   
        'show_category'   				=> 'yes', 
        'show_author'   				=> 'yes', 
        'show_date'   					=> 'yes',    
		), $atts));

 	global $post;

 	$output     = '';
 	$posts= 0;
  	if (isset($category) && $category!='') {
 		$idObj 	= get_category_by_slug( $category );
 		
 		if (isset($idObj) && $idObj!='') {
			$idObj 	= get_category_by_slug( $category );
			$cat_id = $idObj->term_id;

			$args = array( 
		    	'category' => $cat_id,
    			'orderby' => 'date',
		        'order' => $order,
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
 		}else{
 			echo "Please Enter a valid category name";
 			$args = 0;
 		}
 		}else{
			$args = array( 
    			'orderby' => 'date',
		        'order' => $order,
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
	 	}

		if ($style == 'style1') {

		    if(count($posts)>0){
		    	$output .= '<div class="highlights themeum-default-ul popular-items-wrap '.esc_attr($class).'">';
		    	$output .= '<div class="row">';
		    	$i=1;
			    foreach ($posts as $post): setup_postdata($post);

			    if($i==1){
			    	$output .= '<div class="highlights-item popular-items-wrap col-sm-12">';
			    	if ( has_post_thumbnail() ) {
					    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap '.esc_attr($overlay).'">';
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'heighlights', array('class' => 'img-responsive')).'</a>';
						
						$output .= '<div class="themeum-default-intro highlights-intro themeum-overlay">';	
						$output .= '<div class="themeum-overlay-inner">';
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date">';
							$output .= get_the_date('d M Y');
							$output .= '</span>';	
						}		
						$output .= '</div>';//themeum-overlay-inner
						$output .= '</div>';//highlights-intro
						$output .= '</div>';//highlights-wrapper	
					}else {
						$output .= '<div class="themeum-default-wrapper highlights-wrapper">';
						$output .= '<div class="highlights-intro themeum-overlay-inner no-image">';
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date">';
							$output .= get_the_date('d M Y');
							$output .= '</span>';	
						}		
						$output .= '</div>';//themeum-overlay-inner					
						$output .= '</div>';//highlights-wrapper
					}
					$output .= '</div>';    
					$output .= '<div class="clearfix"></div>'; 
			    }else {

				    $output .= '<div class="popular-item all-items">';
				    $output .= '<div class="popular-news-wrapper popular-items-wrap clearfix">';
				    if ( has_post_thumbnail() ) {
					    $output .= '<div class="popular-image col-md-5 col-sm-12 col-xs-4">';
					    $output .= '<div class="themeum-overlay-wrap '.esc_attr($overlay).'">';
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'blog-thumb', array('class' => 'img-responsive')).'</a>';
					    $output .= '</div>';//themeum-overlay-wrap
					    $output .= '</div>';//image
					    
						$output .= '<div class="popular-news-intro col-md-7 col-sm-12 col-xs-8">';	
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date">';
							$output .= get_the_date('d M Y');
							$output .= '</span>';	
						}		
						$output .= '</div>';//popular-intro
					}else {
						$output .= '<div class="popular-news-intro col-md-12 col-sm-12 col-xs-8">';	
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date">';
							$output .= get_the_date('d M Y');
							$output .= '</span>';	
						}		
						$output .= '</div>';//popular-intro
					}
					$output .= '</div>';//popular-wrapper
					$output .= '</div>';
				}
				$i++;
			    endforeach;

			    wp_reset_postdata();   
			    $output .= '</div>';
			    $output .= '</div>';
			     
			}
		} elseif ($style == 'style2') {
		    if(count($posts)>0){
		    	$output .= '<ul class="themeum-default-ul popular-news-style2 '.$class.'">';
		    	$i=1;
			    foreach ($posts as $post): setup_postdata($post);
				    $output .= '<li class="popular-item popular-news-style2-item">';

				    $output .= '<div class="media">';
				    $output .= '<div class="popular-image pull-left">';
				    $output .= '<div class="themeum-overlay-wrap '.$overlay.'">';
				    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'blog-thumb', array('class' => 'img-responsive')).'</a>';
				    $output .= '</div>';//image
				    $output .= '</div>';//image
				    
					$output .= '<div class="popular-news-intro media-body">';	
					if ( $show_category == 'yes'){
						$output .= '<span class="entry-category">';
						$output .= get_the_category_list(', ');
						$output .= '</span>';
					}
					$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
					if ( $show_author == 'yes'){
						$output .= '<span class="author"><i class="fa fa-edit"></i>'.__('By ', 'themeum').''.get_the_author_link().'</span>';	
					}
					if ( $show_date == 'yes'){
						$output .= '<span class="entry-date"><i class="fa fa-calendar-o"></i>';
						$output .= get_the_date('d M Y');
						$output .= '</span>';	
					}		
					$output .= '</div>';//popular-intro
					$output .= '</div>';//popular-wrapper
					$output .= '</li>';

				$i++;
			    endforeach;

			    wp_reset_postdata();   
			    $output .= '</ul>';
			     
			}
		} else {
			$output .= 'Please select any Style';
		}

	return $output;

});

function themeum_all_cat_list_3(){
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
		"name" 			=> __("Themeum Latest Post", "themeum"),
		"base" 			=> "themeum_latest_post",
		'icon' 			=> 'icon-thm-latest-post',
		"class" 		=> "",
		"description" 	=> __("Widget Title Heading", "themeum"),
		"category" 		=> __('Themeum', "themeum"),
		"params" 		=> array(	

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "themeum"),
				"param_name" 	=> "style",
				"value" 		=> array('Select'=>'','Style 1'=>'style1','Style 2'=>'style2'),
			),	
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Image Overlay", "themeum"),
				"param_name" 	=> "overlay",
				"value" 		=> array('Select'=>'','YES'=>'yes','NO'=>'no'),
			),				
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Category Filter", "themeum"),
				"param_name" 	=> "category",
				"value" 		=> themeum_all_cat_list_3(),
			),	
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Number of items", "themeum"),
				"param_name" 	=> "number",
				"value" 		=> "",
			),			
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Order", "themeum"),
				"param_name" 	=> "order",
				"value" 		=> array('Select'=>'','DESC'=>'DESC','ASC'=>'ASC'),
			),				
			array(
				"type" => "dropdown",
				"heading" => __("Show Category", "themeum"),
				"param_name" => "show_category",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Show Author", "themeum"),
				"param_name" => "show_author",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Show Date", "themeum"),
				"param_name" => "show_date",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
				),				


			array(
				"type" => "textfield",
				"heading" => __("Custom Class", "themeum"),
				"param_name" => "class",
				"value" => "",
				),	

			)

		));
}