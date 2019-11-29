<?php
add_shortcode( 'themeum_slider_2', function($atts, $content = null) {

    extract(shortcode_atts(array(
        'number_of_slide'   => '3',
        'order_by'          => 'date', 
        'order'             => 'DESC',
        'time'              => '3000',
        'disable_slider'    => '',
        ), $atts));



    global $post;

    $args = array(
        'post_type'         => 'slider',
        'post_status'       => 'publish',
        'posts_per_page'    => $number_of_slide,
        'orderby'           => $order_by,
        'order'             => $order,
    );

    $posts = get_posts($args);
    $output = '';


    
    if($disable_slider == 'enable'){
        $time = 'false';
    }

    $output .= '<div class="bs-example" data-example-id="simple-carousel">';
    $output .= '<div id="themeum-slider2-carousel" class="carousel slide themeum-slider2-carousel" data-ride="carousel">';


     
    $output .= '<div class="slider2-carousel-indicators" >';
   
    $output .= '<div class="container clearfix">';  
    $output .= '<div class="nano">'; 
    $output .= '<ul class="slider2-carousel-indicators-inner carousel-indicators nano-content">';
    $i=0;
    foreach ($posts as $post){
        setup_postdata( $post );
        $slider_type      = get_post_meta(get_the_ID(),'slider_type',true);

        if( $slider_type != '' ){
            $slider_type = '<span class="slide2-type">'.esc_attr( $slider_type ).'</span>';
        }

        if( $i == 0 ){
            $output .= '<li data-target="#themeum-slider2-carousel" data-slide-to="'.$i.'" class="text-right active">'.balanceTags( $slider_type ).'<span class="indicators-title">'.get_the_title().'</span></li>';
        }else{
            $output .= '<li data-target="#themeum-slider2-carousel" data-slide-to="'.$i.'" class="text-right">'.balanceTags( $slider_type ).'<span class="indicators-title">'.get_the_title().'</span></li>';
        }
        $i++;
    }
    wp_reset_postdata(); 
    $output .= '</ul>';
    $output .= '</div>';//slider2-carousel-indicators
    $output .= '</div>';
    $output .= '</div>';//container

    


    $output .= '<div class="carousel-inner" role="listbox">';
    $j=0;
    foreach ($posts as $post){

            setup_postdata( $post );
            $reasult_group    = get_post_meta(get_the_ID(),'reasult_group',true);
            $select_type      = get_post_meta(get_the_ID(),'select_type',true);
            $classic_content  = get_post_meta(get_the_ID(),'classic_group',true);
            if ( isset($reasult_group["themeum_goal"]) ) {
               $match_result    = $reasult_group["themeum_goal"];
               $match_result = explode(':', $match_result);
            }
            
            # Date translate.
            if ( isset($reasult_group["themeum_datetime"]) ) {
                $sportsdate = esc_attr($reasult_group["themeum_datetime"]);
            } 
            $sports_date = date_i18n("d M Y h:i a", strtotime($sportsdate));
            # End Date.

            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 

            if( $j == 0 ){
                $output .= '<div class="item active" style="padding:250px 0 200px 0;background-image: url('.esc_url($image_url[0]).');background-repeat:no-repeat;background-size:cover;">';
            }else{
                $output .= '<div class="item" style="padding:250px 0 200px 0;background-image: url('.esc_url($image_url[0]).');background-repeat:no-repeat;background-size:cover;">';
            }
            

            $output .= '<div class="container">';
                $output .= '<div class="row">';
                    $output .= '<div class="col-md-6 col-sm-8 col-xs-12">';

                    if( $select_type == 'value2' ){
                        //Match Result
                        $output .= '<div class="slider2-title"><span>'.get_the_title().'</span></div>';
                        $output .= '<div class="slider2-box slider2-box-result">';
                        $output .= '<div class="row">';
                            $output .= '<div class="col-xs-4">';
                            $output .= '<div class="text-left  slider2-logo media">';
                            if ( isset($reasult_group["themeum_team_name1"]) ) {
                                $output .= '<img class="pull-left" width="50" src="'.esc_url(themeum_logo_url_by_id($reasult_group["themeum_team_name1"])).'" alt="'.esc_attr( themeum_get_title_by_id($reasult_group["themeum_team_name1"]) ).'">';
                                $output .= '<div class="media-body"><h3>'.esc_attr( themeum_get_title_by_id($reasult_group["themeum_team_name1"]) ).'</h3></div>';
                            }
                            $output .= '</div>';
                            $output .= '</div>'; //col-xs-4

                            $output .= '<div class="text-center col-xs-4">';
                            if ( isset($reasult_group["themeum_goal"]) ) {
                                $output .= '<div class="slider2-score"><span class="goal">'.esc_attr( $match_result[0] ).'</span> - <span class="goal">'.esc_attr( $match_result[1] ).'</span></div>';
                            }
                            if ( isset($reasult_group["themeum_datetime"]) ) {
                                $output .= '<div class="slider2-time">'.$sports_date.'</div>'; 
                            }
                            $output .= '</div>';//col-xs-4

                            $output .= '<div class="col-xs-4">';
                            $output .= '<div class="text-right slider2-logo media">';
                            if ( isset($reasult_group["themeum_team_name2"]) ) {
                                $output .= '<img class="pull-right" width="50" src="'.esc_url( themeum_logo_url_by_id($reasult_group["themeum_team_name2"]) ).'" alt="'.esc_attr( themeum_get_title_by_id($reasult_group["themeum_team_name2"]) ).'">';
                                $output .= '<div class="media-body"><h3>'.esc_attr( themeum_get_title_by_id($reasult_group["themeum_team_name2"]) ).'</h3></div>';
                            }
                            $output .= '</div>';    
                             $output .= '</div>'; //col-xs-4 
                        $output .= '</div>';//row
                        $output .= '</div>';//slider2-box
                    }
                    elseif( $select_type == 'value3' ){
                        // Upcoming Match
                        $output .= '<div class="slider2-title"><span>'.get_the_title().'</span></div>';
                        $output .= '<div class="slider2-box slider2-box-upcoming">';
                        $output .= '<div class="row">';
                            $output .= '<div class="col-xs-4">';
                            $output .= '<div class="text-left  slider2-logo media">';
                            if ( isset($reasult_group["themeum_team_name1"]) ) {
                                $output .= '<img class="pull-left" width="50" src="'.esc_url( themeum_logo_url_by_id($reasult_group["themeum_team_name1"]) ).'" alt="'.esc_attr( themeum_get_title_by_id($reasult_group["themeum_team_name1"]) ).'">';
                                $output .= '<div class="media-body"><h3>'.esc_attr( themeum_get_title_by_id($reasult_group["themeum_team_name1"]) ).'</h3></div>';
                            }
                            $output .= '</div>';
                            $output .= '</div>'; //col-xs-4

                            $output .= '<div class="text-center col-xs-4">';
                            if ( isset($reasult_group["themeum_datetime"]) ) {
                                $output .= '<div class="slider2-time"><span class="goal">'.$sports_date.'</span></div>';
                            }
                            $output .= '</div>';//col-xs-4

                            $output .= '<div class="col-xs-4">';
                            $output .= '<div class="text-right slider2-logo media">';

                            if ( isset($reasult_group["themeum_team_name2"]) ) {
                                $output .= '<img class="pull-right" width="50" src="'.esc_url( themeum_logo_url_by_id($reasult_group["themeum_team_name2"]) ).'" alt="'.esc_attr( themeum_get_title_by_id($reasult_group["themeum_team_name2"]) ).'">';
                                $output .= '<div class="media-body"><h3>'.esc_attr( themeum_get_title_by_id($reasult_group["themeum_team_name2"]) ).'</h3></div>';
                            }
                            $output .= '</div>';    
                            $output .= '</div>'; //col-xs-4 

                        $output .= '</div>';//row
                        $output .= '</div>';//slider2-box
                    }else{
                        $output .= '<div class="slider2-title"><span>'.get_the_title().'</span></div>';
                        $output .= '<div class="slider2-box">';
                            $output .= '<div class="slider2-content">'.esc_html( $classic_content["themeum_short_description"] ).'</div>';
                        $output .= '</div>';
                    }
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>'; 

        $output .= '</div>';

        $j++;    
        }
    wp_reset_postdata();    
    $output .= '</div>';

    $output .= '</div>';
    $output .= '</div>';    

    // JS time
    $output .= "<script type='text/javascript'>jQuery(document).ready(function() { jQuery('.nano').nanoScroller(); jQuery('#themeum-slider2-carousel').carousel({ interval: ".$time." }) });</script>";

  
    return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
    "name"                 => __("Slider 2", "themeum-soccer"),
    "base"                 => "themeum_slider_2",
    'icon'                 => 'icon-thm-title',
    "class"                => "",
    "description"          => __("Widget Title Heading", "themeum-soccer"),
    "category"             => __('Themeum', "themeum-soccer"),
    "params"               => array(            

            array(
                "type"               => "textfield",
                "heading"            => __("Number of Slide", "themeum-soccer"),
                "param_name"         => "number_of_slide",
                "value"              => "",
            ),

            array(
                "type"              => "dropdown",
                "heading"           => esc_html__("OderBy", 'themeum'),
                "param_name"        => "order_by",
                "value"             => array('Date'=>'date','Title'=>'title','Modified'=>'modified','Author'=>'author','Random'=>'rand'),
            ), 

            array(
                "type"              => "dropdown",
                "heading"           => __("Order By", "themeum-soccer"),
                "param_name"        => "order",
                "value"             => array('Select'=>'','ASC'=>'ASC','DESC'=>'DESC'),
            ),

            array(
                "type"              => "checkbox",
                "class"             => "",
                "heading"           => __("Disable Slider: ","themeum-soccer"),
                "param_name"        => "disable_slider",
                "value"             => array ( __('Disable','themeum') => 'enable'),
                "description"       => __("If you want disable slide check this.","themeum-soccer"),
                "group"             => "Slide"
            ),

            array(
                "type"              => "textfield",
                "heading"           => __("Sliding Time(Milliseconds Ex: 4000)", "themeum-soccer"),
                "param_name"        => "time",
                "value"             => "",
                "group"             => "Slide"
            ),



        )
    ));
}