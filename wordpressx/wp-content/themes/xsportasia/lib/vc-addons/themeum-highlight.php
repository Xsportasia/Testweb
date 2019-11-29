<?php
add_shortcode( 'themeum_highlight', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'category' 						=> '',
		'number' 						=> '6',
		'style' 						=> 'style1',
		'overlay' 						=> 'yes',
		'class' 						=> '',
        'order_by'  					=> '',          
        'order'   						=> 'DESC',   
        'show_category'   				=> 'yes', 
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
		        'orderby' => $order_by,
		        'order' => $order,
		        'meta_key' => 'thm_highlight',
		        'posts_per_page' => esc_attr($number),
		    );
		    $posts = get_posts($args);
 		}else{
 			echo "Please Enter a valid category name";
 			$args = 0;
 		}
 		}else{
			$args = array( 
		        'orderby' => $order_by,
		        'order' => $order,
		        'meta_key' => 'thm_highlight',
		        'posts_per_page' => esc_attr($number),
		    );
		    $posts = get_posts($args);
	 	}

	if ($style == 'style1') {
	    if(count($posts)>0){
	    	$output .= '<div class="highlights themeum-default-ul '.esc_attr($class).'">';
	    	$i=1;
	    	$j=1;
			$x=0;
			$total_post = count($posts);
		    $difference = 2;
		    foreach ($posts as $post): setup_postdata($post);

		    if($i==1){
		    	$output .= '<div class="row">';
		    	$output .= '<div class="highlights-item col-sm-12">';
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
				} else {
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
				$output .= '</div>'; //highlights-item   
				$output .= '</div>';   //row 
				$output .= '<div class="clearfix"></div>'; 
		    }else {

	    		if( $j==1 || $x == $difference ){
		    		$output .= '<div class="row">';	
		    		$x=0;
		    	}

			    $output .= '<div class="highlights-item all-items col-md-6 col-sm-12 col-xs-12">';
				if ( has_post_thumbnail() ) {
			    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap '.$overlay.'">';
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
				    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap no-image">';
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
				}
				$output .= '</div>'; //highlights-item all-items

				if( $x == ($difference-1) || $total_post == $j ){
					$output .= '</div>'; //row	
					
				}
				$x++;
				$j++;
			}
			$i++;
		    endforeach;

		    wp_reset_postdata();   
		    
		    $output .= '</div>'; //highlights		     
		}
	} elseif ($style == 'style2') {
	    if(count($posts)>0){

	    	$output .= '<div class="highlights-style2 '.$class.'">';
	    	$i=1;
		    foreach ($posts as $post): setup_postdata($post);

		    if($i==1){
		    	$output .= '<div class="highlights-style2-item">';
		    	$output .= '<div class="themeum-overlay-wrap '.esc_attr($overlay).'">';
			    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'blog-medium', array('class' => 'img-responsive')).'</a>';
			    $output .= '</div>'; //themeum-overlay-wrap
				if ( $show_category == 'yes'){
					$output .= '<span class="entry-category">';
					$output .= get_the_category_list(', ');
					$output .= '</span>';
				}
				$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
				$output .= '<span class="author"><i class="fa fa-edit"></i>'.__('By ', 'themeum').''.get_the_author_link().'</span>';	
				if ( $show_date == 'yes'){
					$output .= '<span class="entry-date"><i class="fa fa-calendar-o"></i>';
					$output .= get_the_date('d M Y');
					$output .= '</span>';	
				}	

				$output .= '</div>'; //highlights-style2-item  
		    }else {

			    $output .= '<div class="all-highlights-style2-item">';
				if ( $show_category == 'yes'){
					$output .= '<span class="entry-category">';
					$output .= get_the_category_list(', ');
					$output .= '</span>';
				}
				$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
				$output .= '<span class="author"><i class="fa fa-edit"></i>'.__('By ', 'themeum').''.get_the_author_link().'</span>';	
				if ( $show_date == 'yes'){
					$output .= '<span class="entry-date"><i class="fa fa-calendar-o"></i>';
					$output .= get_the_date('d M Y');
					$output .= '</span>';	
				}		
				$output .= '</div>';
			}
			$i++;
		    endforeach;

		    wp_reset_postdata();   
		    $output .= '</div>';     
		}
	}elseif ($style == 'style4') {

		if(count($posts)>0){
	    	$output .= '<div class="highlights themeum-default-ulw '.esc_attr($class).'">';
	    	$output .= '<div class="row">';

	    	$i=1;
			$total_post = count($posts);
		    $difference = 2;
		    foreach ($posts as $post): setup_postdata($post);

		    if($i==1){
		    	
		    	$output .= '<div class="highlights-item highlight-style3 highlight-style4 col-md-7">';
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
				} else {
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
					$output .= '</div>'; # Themeum-overlay-inner					
					$output .= '</div>'; # Highlights-wrapper
				}
				$output .= '</div>'; # Highlights-item   
				
		    }else {
			    $output .= '<div class="highlights-item all-items style3-wrapper col-md-5">';
					if ( has_post_thumbnail() ) {
					    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap '.$overlay.'">';
						$output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'video-thumb', array('class' => 'img-responsive')).'</a>';
						
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
						$output .= '</div>'; # themeum-overlay-inner
						$output .= '</div>'; # highlights-intro
						$output .= '</div>'; # highlights-wrapper
					}else {
					    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap no-image">';
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
						$output .= '</div>'; # themeum-overlay-inner
						$output .= '</div>'; # highlights-intro
						$output .= '</div>'; # highlights-wrapper
					}
				$output .= '</div>'; # style4-wrapper
			}
			$i++;
		    endforeach;

		    wp_reset_postdata();   
		    
		    $output .= '</div>'; # row
		    $output .= '</div>'; # highlights     
		}

	}else {
		if(count($posts)>0){

	    	$output .= '<div class="highlights themeum-default-ulw '.esc_attr($class).'">';
	    	$output .= '<div class="row">';

	    	$i=1;
			$total_post = count($posts);
		    $difference = 2;
		    foreach ($posts as $post): setup_postdata($post);

		    if($i==1){
		    	
		    	$output .= '<div class="highlights-item highlight-style3 col-md-6">';
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
				} else {
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
				$output .= '</div>'; //highlights-item   
				
		    }else {


			    $output .= '<div class="highlights-item all-items style3-wrapper col-md-3">';

				if ( has_post_thumbnail() ) {
				    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap '.$overlay.'">';
					$output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'heighlights-post', array('class' => 'img-responsive')).'</a>';
					
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
					$output .= '</div>'; # themeum-overlay-inner
					$output .= '</div>'; # highlights-intro
					$output .= '</div>'; # highlights-wrapper
				}else {
				    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap no-image">';
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
					$output .= '</div>'; # themeum-overlay-inner
					$output .= '</div>'; # highlights-intro
					$output .= '</div>'; # highlights-wrapper
				}
				
				$output .= '</div>'; # style3-wrapper

				
				
			}
			$i++;
		    endforeach;

		    wp_reset_postdata();   
		    
		    $output .= '</div>'; # row
		    $output .= '</div>'; # highlights     
		}
	}

	return $output;

});

function themeum_fc_cat_list(){
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
		"name" 			=> __("Highlight", "themeum"),
		"base" 			=> "themeum_highlight",
		'icon' 			=> 'icon-thm-highlight',
		"class" 		=> "",
		"description" 	=> __("Widget Title Heading", "themeum"),
		"category" 		=> __('Themeum', "themeum"),
		"params" 		=> array(	

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "themeum"),
				"param_name" 	=> "style",
				"value" 		=> array('Select'=>'','Style1'=>'style1','Style2'=>'style2', 'Style3' => 'style3', 'Style4' => 'style4'),
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
				"value" 		=> themeum_fc_cat_list(),
			),	
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Number of items", "themeum"),
				"param_name" 	=> "number",
				"value" 		=> "",
			),			
			array(
				"type" => "dropdown",
				"heading" => __("Order", "themeum"),
				"param_name" => "order",
				"value" => array('Select'=>'','DESC'=>'DESC','ASC'=>'ASC'),
			),				
			array(
				"type" => "dropdown",
				"heading" => __("Show Category", "themeum"),
				"param_name" => "show_category",
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