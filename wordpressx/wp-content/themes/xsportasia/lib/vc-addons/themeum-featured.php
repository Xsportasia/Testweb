<?php
add_shortcode( 'themeum_featured', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'style' 						=> 'style1',
		'title' 						=> '',
		'category' 						=> '',
		'overlay' 						=> 'yes',
		'number' 						=> '6',
		'class' 						=> '',
        'order_by'  					=> 'date',          
        'order'   						=> 'DESC',   
        'show_author'   				=> 'yes',    
        'show_date'   					=> 'yes',  
        'time'              			=> '3000',
        'disable_slider'    			=> '',   
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
		        'meta_key' => 'thm_featured',
		        'posts_per_page' => $number,
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
		        'meta_key' => 'thm_featured',
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
	 	}

		if($disable_slider == 'enable'){
			$time = 'false';
		}
    	

    if(count($posts)>0){

		$j = 0;
		$i = 1;

		if ( $style == 'style1' ) {

			$output .= '<div class="themeum-featured '.esc_attr($class).'">';
			$output .= '<div id="themeum-featured" class="carousel slide" data-ride="carousel">';
			
			$output .= '<div class="themeum-title">';
			$output .= '<div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2>'.esc_attr($title).'</h2>'; 
		
			$output .= '<div class="themeum-featured-control">';
			$output .= '<a class="left themeum-featured-carousel-control" href="#themeum-featured" role="button" data-slide="prev">';
			$output .= '<i class="fa fa-angle-left"></i>';
			$output .= '</a>';
			$output .= '<a class="right themeum-featured-carousel-control" href="#themeum-featured" role="button" data-slide="next">';
			$output .= '<i class="fa fa-angle-right"></i>';
			$output .= '</a>';
			$output .= '</div>';//recent-result-control
			$output .= '</div>';//themeum-title

				$output .= '<div class="carousel-inner">';

			    foreach ($posts as $post){ 
			    	setup_postdata($post);

		            if( $j == 0 ){
		                $output .= '<div class="item active">';
		            }else{
		                $output .= '<div class="item">';
		            }
			    	$output .= '<div class="themeum-featured-item">';
			    	$output .= '<div class="themeum-overlay-wrap '.$overlay.'">';
				    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'blog-medium', array('class' => 'img-responsive')).'</a>';
				    $output .= '</div>'; //themeum-overlay-wrap 
					$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
					if ( $show_author == 'yes'){
						$output .= '<span class="author"><i class="fa fa-edit"></i>'.__('By ', 'themeum').''.get_the_author_link().'</span>';	
					}	
					if ( $show_date == 'yes'){
						$output .= '<span class="entry-date"><i class="fa fa-calendar-o"></i>';
						$output .= get_the_date('d M Y');
						$output .= '</span>';	
					}	
					$output .= '<div class="featured-item-content">'.themeum_the_excerpt_max_charlength(80).'</div>';
					$output .= '</div>'; //themeum-featured-item
					$output .= '</div>'; //item 
					$j++; 
			    }
			    wp_reset_postdata(); 

			    $output .= '</div>'; //carousel-inner

			    $output .= '</div>'; //carousel
		    $output .= '</div>'; //themeum-featured

		}else {

			$output .= '<div class="themeum-featured '.esc_attr($class).'">';
			$output .= '<div id="themeum-featured" class="carousel slide" data-ride="carousel">';

			$output .= '<div class="themeum-title">';
			$output .= '<div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2>'.esc_attr($title).'</h2>'; 
			$output .= '</div>';//themeum-title

			$output .= '<div class="carousel-inners row">';

			foreach ($posts as $post){ 

					if( $i == 1) {
			            $output .= '<div class="item featured-style-2 col-md-8 active">';   
				    	$output .= '<div class="themeum-featured-item">';

				    	$output .= '<div class="themeum-overlay-wrap '.$overlay.'">';
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'heighlights', array('class' => 'img-responsive')).'</a>';
					    $output .= '</div>';

					    $output .= '<div class="overlay">';
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
							
							$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';	
							if ( $show_date == 'yes'){
								$output .= '<span class="entry-date"><i class="fa fa-calendar-o"></i>';
								$output .= get_the_date('d M Y');
								$output .= '</span>';	
							}	
						$output .= '</div>'; # overlay

						$output .= '</div>'; # themeum-featured-item
						$output .= '</div>'; # item 	
					}else { 
			            $output .= '<div class="item col-md-4">';  
				    	$output .= '<div class="themeum-featured-item">';
				    	$output .= '<div class="themeum-overlay-wrap '.$overlay.'">';
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'heighlights-post', array('class' => 'img-responsive')).'</a>';
					    $output .= '</div>';

					    $output .= '<div class="overlay overlay-inner">';
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
							
							$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';	
							if ( $show_date == 'yes'){
								$output .= '<span class="entry-date"><i class="fa fa-calendar-o"></i>';
								$output .= get_the_date('d M Y');
								$output .= '</span>';	
							}	
						$output .= '</div>'; # overlay

						$output .= '</div>'; # themeum-featured-item
						$output .= '</div>'; # item 	
			    	}

			    	$i++;
			
		    		wp_reset_postdata(); 
			}

		    $output .= '</div>'; 
		    $output .= '</div>'; 
		    $output .= '</div>'; 
		}
	    
	}

	    // JS time
    $output .= "<script type='text/javascript'>jQuery(document).ready(function() { jQuery('#themeum-featured').carousel({ interval: ".$time." }) });</script>";
	return $output;
});

function themeum_smp_cat_list(){
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
		"name" 				=> __("Featured", "themeum"),
		"base" 				=> "themeum_featured",
		'icon' 				=> 'icon-thm-featured',
		"class" 			=> "",
		"description" 		=> __("Widget Title Heading", "themeum"),
		"category" 			=> __('Themeum', "themeum"),
		"params" 			=> array(	

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "themeum"),
				"param_name" 	=> "style",
				"value" 		=> array( 'Select'=>'','Style1'=>'style1','Style2'=>'style2' ),
			),
		
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Title", "themeum"),
				"param_name" 	=> "title",
				"value" 		=> "",
			),	

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Category Filter", "themeum"),
				"param_name" 	=> "category",
				"value" 		=> themeum_smp_cat_list(),
				),	

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Image Overlay", "themeum"),
				"param_name" 	=> "overlay",
				"value" 		=> array('Select'=>'','YES'=>'yes','NO'=>'no'),
			),			

			array(
				"type" => "textfield",
				"heading" => __("Number of items", "themeum"),
				"param_name" => "number",
				"value" => "",
				),			

			array(
				"type" => "dropdown",
				"heading" => __("OderBy", "themeum"),
				"param_name" => "order_by",
				"value" => array('Select'=>'','Date'=>'date','Title'=>'title','Modified'=>'modified','Author'=>'author','Random'=>'rand'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Order", "themeum"),
				"param_name" => "order",
				"value" => array('Select'=>'','DESC'=>'DESC','ASC'=>'ASC'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Show Date", "themeum"),
				"param_name" => "show_date",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Show Author", "themeum"),
				"param_name" => "show_author",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
				),				


			array(
				"type" => "textfield",
				"heading" => __("Custom Class", "themeum"),
				"param_name" => "class",
				"value" => "",
				),	

	        array(
		            "type" => "checkbox",
		            "class" => "",
		            "heading" => __("Disable Slider: ","themeum"),
		            "param_name" => "disable_slider",
		            "value" => array ( __('Disable','themeum') => 'enable'),
		            "description" => __("If you want disable slide check this.","themeum"),
		            "group" => "Slide"
		        ),

	        array(
	            "type" => "textfield",
	            "heading" => __("Sliding Time(Milliseconds Ex: 4000)", "themeum"),
	            "param_name" => "time",
	            "value" => "",
	            "group" => "Slide"
	            ),	


			)

		));
}