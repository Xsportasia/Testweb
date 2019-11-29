<?php

add_shortcode('recent_result','themeum_recent_result');

	function themeum_recent_result($atts, $content){

	extract(shortcode_atts(array(
		'title' 			=> '',
		'count'				=> '3',
		'result_number'		=> '10',
		'group_id' 			=> '',
		'league_id'			=> '',	
		'class'				=> '',
        'time'              => '3000',
        'disable_slider'    => '', 			
		), $atts));

	global $post;

	if($disable_slider == 'enable'){
        $time = 'false';
    }	

	$args = array(
		'post_type'			=> 'fixture_reasult',
		'posts_per_page' 	=> $result_number,
		'tax_query' 		=> array(
								array(
									'taxonomy' => 'league',
									'field'    => 'slug',
									'terms'    => $league_id,
								),
		),
		'meta_query' => array(
							array(
							  'key' => 'themeum_goal_count',
							  'value' => '',
							  'compare' => '!=',
							)
		),
		'meta_key'          => 'themeum_datetime',
		'orderby'           => 'meta_value',
		'order'             => 'ASC'
	);
	if(is_numeric($group_id)){
		$args = array(
			'post_type'			=> 'fixture_reasult',
			'posts_per_page' 	=> $result_number,
			'tax_query' 		=> array(
									'relation' => 'AND',
								array(
									'taxonomy' => 'league',
									'field'    => 'slug',
									'terms'    => $league_id,
								),
								array(
									'taxonomy' => 'team_group',
									'field'    => 'slug',
									'terms'    => $group_id,
								),
							),
				'meta_query' 	=> array(
				 array(
						'key' 		=> 'themeum_goal_count',
						'value' 	=> '',
						'compare' 	=> '!=',
					)
			),
			'meta_key'          => 'themeum_datetime',
			'orderby'           => 'meta_value',
			'order'             => 'DESC'
		);
	}

	$posts = get_posts($args);

	$output = '';


	$output .= '<div class="themeum-recent-result '.esc_attr($class).'">';
	$output .= '<div id="recent-result" class="carousel slide" data-ride="carousel">';

	$output .= '<div class="themeum-title themeum-title-black">';
	$output .= '<div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2>'.esc_attr($title).'</h2>'; 
	/* Controls */
	$output .= '<div class="recent-result-control">';
	$output .= '<a class="left recent-result-carousel-control" href="#recent-result" role="button" data-slide="prev">';
	$output .= '<i class="fa fa-angle-left"></i>';
	$output .= '</a>';
	$output .= '<a class="right recent-result-carousel-control" href="#recent-result" role="button" data-slide="next">';
	$output .= '<i class="fa fa-angle-right"></i>';
	$output .= '</a>';
	$output .= '</div>';//recent-result-control
	$output .= '</div>';//themeum-title-black

	$output .= '<div class="themeum-recent-result-inner">';
	$output .= '<div class="carousel-inner" role="listbox">';

	$j=0;
	$i=0;
	$x=0;
	foreach ($posts as $post){

		setup_postdata( $post );
		$match_result    	= get_post_meta(get_the_ID(),'themeum_goal_count',true);
		$match_result 		= explode(':', $match_result);
		$team_1    			= get_post_meta(get_the_ID(),'team_1_group',true);
		$team_2    			= get_post_meta(get_the_ID(),'team_2_group',true);	

		$sports_date = date_format(date_create(get_post_meta(get_the_ID(),"themeum_datetime",true)), 'd M Y');

		$classes = ($j==0)?'item active':'item';

		if( $j==0 || $x == $count ){
			$output .= '<div class="' .$classes. '">';
			$x=0;
		}

		$output .= '<div class="themeum-recent-result-item-inner">';
		$output .= '<div class="clubnames"><span class="text-left">'.themeum_get_title_by_id($team_1["themeum_club_name1"]).' '.__('vs','themeum').' '.themeum_get_title_by_id($team_2["themeum_club_name2"]).'</span><span class="pull-right">'.$sports_date.'</span></div><div class="clearfix"></div>';	
		$output .= '<div class="themeum-recent-result-item">';
		$output .= '<div class="text-left themeum-recent-result-list"><a href="'. get_the_permalink() .'"><img class="img-responsive" src="'.themeum_logo_url_by_id($team_1["themeum_club_name1"]).'" alt="'.themeum_get_title_by_id($team_1["themeum_club_name1"]).'">'.themeum_get_title_by_id($team_1["themeum_club_name1"]).'</a></div>';
		$output .= '<div class="text-center themeum-recent-result-list"><span class="goal">'.$match_result[0].'</span> - <span class="goal">'.$match_result[1].'</span></div>';
		$output .= '<div class="text-center themeum-recent-result-list"><a href="'. get_the_permalink() .'"><img class="img-responsive" src="'.themeum_logo_url_by_id($team_2["themeum_club_name2"]).'" alt="'.themeum_get_title_by_id($team_2["themeum_club_name2"]).'">'.themeum_get_title_by_id($team_2["themeum_club_name2"]).'</a></div>';
		$output .= '</div>';//themeum-recent-result-item	
		$output .= '</div>';//themeum-recent-result-item-inner

		if( $x == ($count-1) || $match_result == $i ){
			$output .= '</div>';//club-ranking-inner
		}
		$x++;		
		$j++;
		$i++;
	}
	wp_reset_postdata();	

	$output .= '</div>';//carousel-inner
	$output .= '</div>';//themeum-recent-result-inner

	$output .= '</div>'; //#recent-result	
	$output .= '</div>'; //themeum-recent-result

    # JS time
    $output .= "<script type='text/javascript'>jQuery(document).ready(function() { jQuery('#recent-result').carousel({ interval: ".$time." }) });</script>";
	return $output;

};


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" 			=> __("Recent Result", "themeum-soccer"),
	"base" 			=> "recent_result",
	'icon' 			=> 'icon-thm-recent-result',
	"class" 		=> "",
	"description" 	=> __("Widget Title Heading", "themeum-soccer"),
	"category" 		=> __('Themeum', "themeum-soccer"),
	"params" 		=> array(			

		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Title", "themeum-soccer"),
			"param_name" 	=> "title",
			"value" 		=> "",
		),	
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Show Number of result", "themeum-soccer"),
			"param_name" 	=> "result_number",
			"value" 		=> "",
		),		
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Count Number for Carousel", "themeum-soccer"),
			"param_name" 	=> "count",
			"value" 		=> "",
		),	
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Group Slug", "themeum-soccer"),
			"param_name" 	=> "group_id",
			"value" 		=> "",
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("League Slug", "themeum-soccer"),
			"param_name" 	=> "league_id",
			"value" 		=> "",
		),						
		array(
			"type" 			=> "textfield",
			"heading" 		=> __("Custom Class ", "themeum-soccer"),
			"param_name" 	=> "class",
			"value" 		=> "",
		),
        array(
            "type" 			=> "checkbox",
            "class" 		=> "",
            "heading" 		=> __("Disable Slider: ","themeum-soccer"),
            "param_name" 	=> "disable_slider",
            "value" 		=> array ( __('Disable','themeum') => 'enable'),
            "description" 	=> __("If you want disable slide check this.","themeum-soccer"),
            "group" 		=> "Slide"
	    ),
        array(
            "type" 			=> "textfield",
            "heading" 		=> __("Sliding Time(Milliseconds Ex: 4000)", "themeum-soccer"),
            "param_name" 	=> "time",
            "value" 		=> "",
            "group" 		=> "Slide"
        ),			

		)
	));
}