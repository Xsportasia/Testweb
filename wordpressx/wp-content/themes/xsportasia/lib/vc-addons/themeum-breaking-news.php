<?php
add_shortcode( 'themeum_breaking_news', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'category' 			=> '',
		'number' 			=> '6',
		'class' 			=> '',
        'order_by'  		=> 'date',          
        'order'   			=> 'DESC', 
        'time'              => '3000',
        'disable_slider'    => '',    
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
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
	 	}

    if($disable_slider == 'enable'){
        $time = 'false';
    }	 	

    if(count($posts)>0){
    	$output .= '<div class="themeum-breaking-news '.esc_attr($class).'">';
    	$output .= '<div class="container">';
    	$output .= '<div class="row">';
    	$output .= '<div class="breaking-news-title col-md-2 col-sm-3"><h2>'.__('Breaking news','themeum').'</h2></div>';
    	$output .= '<div id="carousel-breaking-news" class="col-md-10 col-sm-9 carousel slide" data-ride="carousel">';
    	
    	$output .= '<div class="carousel-inner">';
    	$post_number = 1;
	    foreach ($posts as $post): setup_postdata($post);
	    	if($post_number == 1) {
	    		$active = 'active';
	    	}else {
	    		$active = '';
	    	}
	    	$output .= '<div class="item '.esc_attr($active).'">';
			$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';	
			$output .= '</div>'; //item   
			$post_number++;	

	    endforeach;
	    wp_reset_postdata(); 
	    $output .= '</div>';//carousel-inner

	    $output .= '<div class="breaking-news-controller">';
	    $output .= '<a href="#carousel-breaking-news" class="prev" data-slide="prev"><i class="fa fa-angle-left"></i></a>'; 
		$output .= '<a href="#carousel-breaking-news" class="next" data-slide="next"><i class="fa fa-angle-right"></i></a>'; 
	    $output .= '</div>';//breaking-news-controller

	    $output .= '</div>'; //carousel-breaking-news
	    $output .= '</div>'; //row
	    $output .= '</div>'; //container
	    $output .= '</div>'; //themeum-breaking-news 
	     
	}

    // JS time
    $output .= "<script type='text/javascript'>jQuery(document).ready(function() { jQuery('#carousel-breaking-news').carousel({ interval: ".$time." }) });</script>";

	return $output;

});

function themeum_opp_cat_list(){
	$cat_lists = get_categories();
	$all_cat_list = array('All Category'=>'');
	foreach($cat_lists as $cat_list){
		$all_cat_list[$cat_list->cat_name] = $cat_list->cat_name;
	}
	return $all_cat_list; 
}

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Breaking News", "themeum"),
		"base" => "themeum_breaking_news",
		'icon' => 'icon-thm-breaking-news',
		"class" => "",
		"description" => __("Widget Title Heading", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(				

			array(
				"type" => "dropdown",
				"heading" => __("Category Filter", "themeum"),
				"param_name" => "category",
				"value" => themeum_opp_cat_list(),
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