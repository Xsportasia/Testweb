<?php

add_shortcode('club_ranking1','themeum_club_ranking');

function sort_by_point($a, $b){
    return $b['themeum_points'] - $a['themeum_points'];
}

function themeum_club_ranking($atts, $content){

	extract(shortcode_atts(array(
		'title' 			=> '',
		'count'				=> '',		
		'point_table_id'	=> '',		
		'class'				=> '',
        'time'              => '3000',
        'disable_slider'    => '', 		
		), $atts));

    if($disable_slider == 'enable'){
        $time = 'false';
    }	 	

	global $post;
	$args = array(
			'name'				=> $point_table_id,
			'post_type'			=> 'point_table',
			'posts_per_page' 	=> 1,
		);
	$posts = get_posts($args);

	$output = '';

	$output .= '<div class="themeum-club-ranking '.esc_attr($class).'">';
	$output .= '<div id="club-ranking" class="carousel slide" data-ride="carousel">';

	$output .= '<div class="themeum-title themeum-title-black">';
	$output .= '<div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2>'.esc_attr($title).'</h2>'; 
	/*Controls */
	$output .= '<div class="club-ranking-control">';
	$output .= '<a class="left club-ranking-carousel-control" href="#club-ranking" role="button" data-slide="prev">';
	$output .= '<i class="fa fa-angle-left"></i>';
	$output .= '</a>';
	$output .= '<a class="right club-ranking-carousel-control" href="#club-ranking" role="button" data-slide="next">';
	$output .= '<i class="fa fa-angle-right"></i>';
	$output .= '</a>';
	$output .= '</div>';//club-ranking-control
	$output .= '</div>';//themeum-title-black

	$output .= '<div class="themeum-recent-result-inner">';
	$output .= '<div class="carousel-inner" role="listbox">';
	
	$x=0;
  	$j=0;
	foreach ($posts as $post){
		setup_postdata( $post );
		$point_table    = get_post_meta(get_the_ID(),'point_table_group',true);
		usort($point_table, 'sort_by_point');
		$i=1;
		
    
		$counter = count($point_table);

		foreach ($point_table as  $value) {
			$classes = ($j==0)?'item active':'item';
			
				if( $j==0 || $x == $count ){
					$output .= '<div class="' .$classes. '">';
					$output .= '<ul class="club-ranking-inner">';
					$x=0;
				}
				
					$output .= '<li class="clearfix"><span>'.$i.'<img class="img-responsive" src="'.themeum_logo_url_by_id($value['themeum_club_name']).'">'.get_the_title($value['themeum_club_name']).'</span><span class="pull-right">'.$value['themeum_points'].'</span></li>';	
					
				if( $x == ($count-1) || $counter == $i ){
					$output .= '</ul>';
					$output .= '</div>';//club-ranking-inner
				}
				$x++;

			$i++;
			$j++;
		}
	}
	wp_reset_postdata();
	$output .= '</div>'; //carousel-inner
	
	$output .= '</div>'; //themeum-recent-result-inner
	$output .= '</div>'; //carousel
	$output .= '</div>'; //themeum-club-ranking

    // JS time
    $output .= "<script type='text/javascript'>jQuery(document).ready(function() { jQuery('#club-ranking').carousel({ interval: ".$time." }) });</script>";

	return $output;

};


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Club Ranking", "themeum-soccer"),
	"base" => "club_ranking1",
	'icon' => 'icon-thm-club-ranking',
	"class" => "",
	"description" => __("Widget Title Heading", "themeum-soccer"),
	"category" => __('Themeum', "themeum-soccer"),
	"params" => array(			

		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Title", "themeum-soccer"),
			"param_name" 	=> "title",
			"value" 		=> "",
		),			

		array(
	        "type" => "dropdown",
	        "heading" => __("Select Point Table","themeum-soccer"),
	        "param_name" => "point_table_id",
	        "description" => __("Select Point Table", "themeum-soccer"),
	        "value" => themeum_all_point_table(), 
	        ),
		
		array(
			"type" => "textfield",
			"heading" => __("Number of Ranking Show", "themeum-soccer"),
			"param_name" => "count",
			"value" => "",
			),
					
		array(
			"type" => "textfield",
			"heading" => __("Custom Class ", "themeum-soccer"),
			"param_name" => "class",
			"value" => "",
			),

        array(
	            "type" => "checkbox",
	            "class" => "",
	            "heading" => __("Disable Slider: ","themeum-soccer"),
	            "param_name" => "disable_slider",
	            "value" => array ( __('Disable','themeum') => 'enable'),
	            "description" => __("If you want disable slide check this.","themeum-soccer"),
	            "group" => "Slide"
	        ),

        array(
            "type" => "textfield",
            "heading" => __("Sliding Time(Milliseconds Ex: 4000)", "themeum-soccer"),
            "param_name" => "time",
            "value" => "",
            "group" => "Slide"
            ),		

		)
	));
}