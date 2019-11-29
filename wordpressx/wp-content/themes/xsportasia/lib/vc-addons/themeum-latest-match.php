<?php
add_shortcode( 'themeum_latest_match', function($atts, $content = null) {

	extract(shortcode_atts(array(

		'match_layout' 		=> 'layout1',
		'image'				=> '',
		'title'				=> '',
		'title_size'		=> '72',
		'title_margin'		=> '10px 0 10px 0',
		'padding'			=> '220px 0 140px 0',
		'color'				=> '#fff',
		'team_a'			=> '',
		'team_b'			=> '',
		'match_date'		=> '',
		'next_match'		=> '',
		'place'				=> '',
		'match_start' 		=> '',
		'team_one_image' 	=> '',
		'team_two_image' 	=> '',
		'button_name' 		=> '',
		'button_url' 		=> '',
		'class'				=> '',
		), $atts));

		$src_image   = wp_get_attachment_image_src($image, 'full');
		$src_image2   = wp_get_attachment_image_src($team_one_image, 'full');
		$src_image3   = wp_get_attachment_image_src($team_two_image, 'full');

		$output = $style = $style2 = $style3 = $image_style = '';

		if($title_size != '' ){ $style .= 'font-size:'.esc_attr((int)$title_size).'px;'; }
		if($title_margin != '' ){ $style .= 'margin:'.esc_attr($title_margin).';'; }
		if($color != '' ){ $style .= 'color:'.esc_attr($color).';'; }

		if ($padding) {$style2 .= 'padding:'.esc_attr($padding).';';}

		if ($src_image[0]) {$style2 .= 'background-image: url('.esc_url($src_image[0]).');background-repeat:no-repeat;background-size:cover;';}		

		if ($padding) {$style3 .= 'padding:'.esc_attr($padding).';';}


		if ( $src_image[0] != "" ) {
           $image_style = 'style = "'.$style2.'"';
        }else{
           $image_style = 'style="background-color: #444;'.$style3.'"';
        }


	if ( $match_layout == 'layout1' ) {
		$output .= '<div class="themeum-latest-match '.esc_attr($class).'" '.$image_style.'>';

			$output .= '<div class="container">';	
			$output .= '<div class="row">';	
			$output .= '<div class="col-sm-7">';	
			if ($title) {
				$output .= '<h2 style="'.$style.'">'.esc_attr($title).'</h2>';
			}
			
			if ($match_date) {
				$datetime = $match_date; ?>
                <script type="text/javascript">
                    jQuery(function($) {
                         //Countdown
						function countdown(endDate) {
						  let days, hours, minutes, seconds;
						  
						  endDate = new Date(endDate).getTime();
						  
						  if (isNaN(endDate)) {
							return;
						  }
						  setInterval(calculate, 1000);
						  function calculate() {
						    let startDate = new Date();
						    startDate = startDate.getTime();
						    
						    let timeRemaining = parseInt((endDate - startDate) / 1000);
						    
						    if (timeRemaining >= 0) {
						      days = parseInt(timeRemaining / 86400);
						      timeRemaining = (timeRemaining % 86400);
						      
						      hours = parseInt(timeRemaining / 3600);
						      timeRemaining = (timeRemaining % 3600);
						      
						      minutes = parseInt(timeRemaining / 60);
						      timeRemaining = (timeRemaining % 60);
						      
						      seconds = parseInt(timeRemaining);
						      
						      document.getElementById("m-days").innerHTML = parseInt(days, 10);
						      document.getElementById("m-hours").innerHTML = ("0" + hours).slice(-2);
						      document.getElementById("m-minutes").innerHTML = ("0" + minutes).slice(-2);
						      document.getElementById("m-seconds").innerHTML = ("0" + seconds).slice(-2);
						    } else {
						      return;
						    }
						  }
						}

	                    (function () { 
						  countdown('<?php echo $datetime; ?>');
						}());
                    });
                </script>
               <?php 
               //$output .= '<div id="home-countdown-timer"></div>';
               $output .= '<div id="countdown-timer-custom">';
               	   $output .= '<div class="match-place">';
               	   $output .= '<p>'.$place.'</p>';
               	   $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-days"></div>';
	               		$output .= '<p class="single-count-label">Days</p>';
	               $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-hours"></div>';
	               		$output .= '<p class="single-count-label">Hours</p>';
	               $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-minutes"></div>';
	               		$output .= '<p class="single-count-label">Minutes</p>';
	               $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-seconds"></div>';
	               		$output .= '<p class="single-count-label">Seconds</p>';
	               $output .= '</div>';
	           $output .= '</div>';
               $output .= '<div id="clearfix"></div>';
			}
			$output .= '<div class="latest-team">';
			if ($team_a) {
				$output .= '<span class="latest-team-a">'.esc_attr($team_a).'</span>';
			}	
			if ($team_b) {	
				$output .= '<span class="latest-team-b">'.esc_attr($team_b).'</span>';
			}
			$output .= '</div>';//latest-team


			$output .= '</div>';//col-sm-7
			$output .= '</div>';//row
			$output .= '</div>';//container
		$output .= '</div>';
	}else if ($match_layout == 'layout3') {
		
		$output .= '<div class="themeum-lateswt-match style3-container '.esc_attr($class).'" style="background-image: url('.esc_url($src_image[0]).');background-repeat:no-repeat;background-size:cover;">';

			$output .= '<div class="container">';	
			$output .= '<div class="row">';	
			$output .= '<div class="col-sm-7 countdown-time">';	


			if ($place) {
				$output .= '<span class="match-date">'.$place.'</span>';
			}
			if ($title) {
				$output .= '<h2 style="'.$style.'">'.esc_attr($title).'</h2>';
			}
			
			if ($match_date) { $datetime = $match_date; ?>

                <script type="text/javascript">
                    jQuery(function($) {
                         //Countdown
						function countdown(endDate) {
						  let days, hours, minutes, seconds;
						  
						  endDate = new Date(endDate).getTime();
						  
						  if (isNaN(endDate)) {
							return;
						  }
						  setInterval(calculate, 1000);
						  function calculate() {
						    let startDate = new Date();
						    startDate = startDate.getTime();
						    
						    let timeRemaining = parseInt((endDate - startDate) / 1000);
						    
						    if (timeRemaining >= 0) {
						      days = parseInt(timeRemaining / 86400);
						      timeRemaining = (timeRemaining % 86400);
						      
						      hours = parseInt(timeRemaining / 3600);
						      timeRemaining = (timeRemaining % 3600);
						      
						      minutes = parseInt(timeRemaining / 60);
						      timeRemaining = (timeRemaining % 60);
						      
						      seconds = parseInt(timeRemaining);
						      
						      document.getElementById("m-days").innerHTML = parseInt(days, 10);
						      document.getElementById("m-hours").innerHTML = ("0" + hours).slice(-2);
						      document.getElementById("m-minutes").innerHTML = ("0" + minutes).slice(-2);
						      document.getElementById("m-seconds").innerHTML = ("0" + seconds).slice(-2);
						    } else {
						      return;
						    }
						  }
						}

	                    (function () { 
						  countdown('<?php echo $datetime; ?>');
						}());
                    });
                </script>

               <?php 
               //$output .= '<div id="home-countdown-timer" class="match-countdown-wrap"></div>';
               $output .= '<div class="match-countdown-wrap">';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-days"></div>';
	               		$output .= '<p class="single-count-label">Days</p>';
	               $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-hours"></div>';
	               		$output .= '<p class="single-count-label">Hours</p>';
	               $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-minutes"></div>';
	               		$output .= '<p class="single-count-label">Minutes</p>';
	               $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-seconds"></div>';
	               		$output .= '<p class="single-count-label">Seconds</p>';
	               $output .= '</div>'; 
               $output .= '</div>'; 

               if ($button_url) {
               		$output .= '<a href="'.$button_url.'" class="match-ticket-btn">'. $button_name .'</a>';
               }

               $output .= '<div id="clearfix"></div>';
			}
			
			$output .= '</div>';//col-sm-7
			$output .= '</div>';//row
			$output .= '</div>';//container
		$output .= '</div>';

	}else{

			$output .= '<div class="container">';	
			$output .= '<div class="themeum-latest-match-layout2 '.esc_attr($class).'">';
			$output .= '<div class="row">';	
			

			# Starting Date Section.
			if ($match_start) {
				$output .= '<div class="col-sm-2 match-date-cont">';
					$output .= '<span class="starting_date">'. esc_html__( 'Starting Date', 'themeum') .'</span>';
					$output .= '<h3 class="match_title">'.esc_attr($match_start).'</h3>';
				$output .= '</div>';
			}

			# Opening Match section.
			if ($place) {
				$output .= '<div class="col-sm-2 match-opening-cont">';
				$output .= '<span class="opening_match">'. esc_html__( 'Opening Match', 'themeum') .'</span>';
				$output .= '<span>'.esc_attr($place).'</span>';
				$output .= '</div>';
			}

			# Latest Match Section.
			$output .= '<div class="col-sm-4 latest-team-wrap">';
			if ($team_a) {
				$output .= '<div class="image-wrap">';
				$output  .= '<img src="' . esc_url($src_image2[0]). '" class="img-responsive" alt="photo">';
				$output .= '<span class="latest-team-a">'.esc_attr($team_a).'</span>';
				$output .= '<span class="team-vs">'.esc_html__( '&nbsp; &nbsp; &nbsp; VS &nbsp;', 'themeum').'</span>';
				$output .= '</div>';
			}

			if ($team_b) {	
				$output .= '<div class="image-wrap">';
				$output  .= '<img src="' . esc_url($src_image3[0]). '" class="img-responsive" alt="photo">';
				$output .= '<span class="latest-team-b">'.esc_attr($team_b).'</span>';
				$output .= '</div>';
			}
			$output .= '</div>'; # End Latest Match Section


			# Match Count Down.
			if ($match_date) {
				$datetime = $match_date; ?>
                <script type="text/javascript">
                    jQuery(function($) {
                         //Countdown
						function countdown(endDate) {
						  let days, hours, minutes, seconds;
						  
						  endDate = new Date(endDate).getTime();
						  
						  if (isNaN(endDate)) {
							return;
						  }
						  setInterval(calculate, 1000);
						  function calculate() {
						    let startDate = new Date();
						    startDate = startDate.getTime();
						    
						    let timeRemaining = parseInt((endDate - startDate) / 1000);
						    
						    if (timeRemaining >= 0) {
						      days = parseInt(timeRemaining / 86400);
						      timeRemaining = (timeRemaining % 86400);
						      
						      hours = parseInt(timeRemaining / 3600);
						      timeRemaining = (timeRemaining % 3600);
						      
						      minutes = parseInt(timeRemaining / 60);
						      timeRemaining = (timeRemaining % 60);
						      
						      seconds = parseInt(timeRemaining);
						      
						      document.getElementById("m-days").innerHTML = parseInt(days, 10);
						      document.getElementById("m-hours").innerHTML = ("0" + hours).slice(-2);
						      document.getElementById("m-minutes").innerHTML = ("0" + minutes).slice(-2);
						    } else {
						      return;
						    }
						  }
						}

	                    (function () { 
						  countdown('<?php echo $datetime; ?>');
						}());
                    });
                </script>
            <?php 
               $output .= '<div class="col-sm-4">';
               $output .= '<div id="countdown-timer-custom">';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-days"></div>';
	               		$output .= '<p class="single-count-label">Days</p>';
	               $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-hours"></div>';
	               		$output .= '<p class="single-count-label">Hours</p>';
	               $output .= '</div>';
	               $output .= '<div class="single-custom-count">';
	               		$output .= '<div class="custom-count" id="m-minutes"></div>';
	               		$output .= '<p class="single-count-label">Minutes</p>';
	               $output .= '</div>';
	           $output .= '</div>';
               $output .= '<div id="clearfix"></div>';
               $output .= '</div>';
               $output .= '<div id="clearfix"></div>';
			}
			# End Match Down
			
			$output .= '</div>'; # row
			$output .= '</div>'; # container
		$output .= '</div>';

	}

	return $output;

});

# Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" 				=> __("Latest Match", "themeum"),
	"base" 				=> "themeum_latest_match",
	'icon' 				=> 'icon-thm-latest-match',
	"description" 		=> __("Latest Match is Display Here.", "themeum"),
	"category" 			=> __('Themeum', "themeum"),
	"params" 			=> array(

			array(
	            "type"          => "dropdown",
	            "heading"       => esc_html__("Gappry Layout", 'themeum'),
	            "param_name"    => "match_layout",
	            "value"         => array('Select'=>'','Layout 1'=>'layout1','Layout 2'=>'layout2', 'Layout 3'=>'layout3'), # Select Layout
	            "default" 		=> "layout1",
	        ),
			array(
				"type" 			=> "attach_image",
				"heading" 		=> __("Insert Image", "themeum"),
				"param_name" 	=> "image",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1", "layout3")),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Match Start Date Ex. 12 JAN 2018", "themeum"),
				"param_name" 	=> "match_start",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout2")), # Layout Two
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Place Name Ex. Lokomotiv Moscow", "themeum"),
				"param_name" 	=> "place",
				"value" 		=> "",
			),	
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Title", "themeum"),
				"param_name" 	=> "title",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1", "layout3")),
			),	
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Title Font Size", "themeum"),
				"param_name" 	=> "title_size",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1")),
			),	
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Title Margin", "themeum"),
				"param_name" 	=> "title_margin",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1")),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Title Padding", "themeum"),
				"param_name" 	=> "padding",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1")),
			),			
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> __("Title Color", "themeum"),
				"param_name" 	=> "color",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1")),
			),	
			array(
				"type" 			=> "attach_image",
				"heading" 		=> __("Team A Logo Image", "themeum"),
				"param_name" 	=> "team_one_image",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout2")), # Layout Two
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Team A", "themeum"),
				"param_name" 	=> "team_a",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1", "layout2")),
			),	
			array(
				"type" 			=> "attach_image",
				"heading" 		=> __("Team B Logo Image", "themeum"),
				"param_name" 	=> "team_two_image",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout2")), # Layout Two
			),		
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Team B", "themeum"),
				"param_name" 	=> "team_b",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1", "layout2")),
			),	
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Match Date", "themeum"),
				"param_name" 	=> "match_date",
				"value" 		=> "11-23-2020",
				"default" 		=> "02/02/2021 09:00:00 PM",
				"description" 	=> "Month/Day/Year Hours:Minutes:Seconds AM/PM"
			),			
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Next Match Text Ex. Next Match", "themeum"),
				"param_name" 	=> "next_match",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout1")),
			),	
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Button Name", "themeum"),
				"param_name" 	=> "button_name",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout3")),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Button URL", "themeum"),
				"param_name" 	=> "button_URL",
				"value" 		=> "",
				"dependency" 	=> Array("element" => "match_layout", "value" => array("layout3")),
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Custom Class", "themeum"),
				"param_name" 	=> "class",
				"value" 		=> ""
			),		
		)
	));
}