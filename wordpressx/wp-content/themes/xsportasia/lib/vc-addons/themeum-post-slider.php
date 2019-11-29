<?php
add_shortcode( 'themeum_post_slider', function($atts, $content = null) {

    extract(shortcode_atts(array(
        'category'                      => '',
        'number'                        => '4',
        'class'                         => '',
        'order_by'                      => 'date',          
        'order'                         => 'DESC',   
        'time'                          => '',
        'disable_slider'                => '',
        ), $atts));

    global $post;

    $posts= 0;

    if (isset($category) && $category!='') {
        $idObj  = get_category_by_slug( $category );
        
        if (isset($idObj) && $idObj!='') {
            $idObj  = get_category_by_slug( $category );
            $cat_id = $idObj->term_id;

            $args = array( 
                'category'          => $cat_id,
                'orderby'           => $order_by,
                'order'             => $order,
                'posts_per_page'    => $number,
            );
            $posts = get_posts($args);
        }else{
            echo __("Please Enter a valid category name","themeum");
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
    $output = '';

    if($disable_slider == 'enable'){
        $time = 'false';
    }
    $output .= '<div id="themeum-post-slider" class="carousel slide themeum-post-slider" data-ride="carousel">';

    $output .= '<div class="carousel-inner" role="listbox">';
    $j=0;
    foreach ($posts as $post){
        setup_postdata( $post );
             if ( has_post_thumbnail() ) {

                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 

                if( $j == 0 ){
                    $output .= '<div class="item active" style="min-height:700px; background-image: url('.esc_url($image_url[0]).');background-repeat:no-repeat;background-position:center;background-size:cover;">';
                }else{
                    $output .= '<div class="item" style="min-height:700px; background-image: url('.esc_url($image_url[0]).');background-repeat:no-repeat;background-size:cover;background-position:center;">';
                }
                $output .= '<div class="container">';
                    $output .= '<div class="row">';
                        $output .= '<div class="post-slider-wrap col-md-7 col-sm-7 col-xs-12">';
                            $output .= '<div class="post-slider-in clearfix">';
                                $output .= '<div class="post-slider-innner">';
                                $output .= '<span class="entry-category">';
                                $output .= get_the_category_list(', ');
                                $output .= '</span>';
                                $output .= '<h2 class="slider-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
                                $output .= '<p class="slider-excerpt">'.wpsoccer_excerpt_max_charlength(140).'</p>';
								$output .= '<a class="btn btn-style" href="'.get_permalink().'">'.__('Read More','themeum').'</a>';
                                $output .= '</div>'; //handpick-slider-innner
                            $output .= '</div>'; //handpick-slider-in
                        $output .= '</div>'; //col-sm-7
                    $output .= '</div>'; //row
                $output .= '</div>'; //container
            $output .= '</div>'; //item

            $j++;   
            }
        }
    wp_reset_postdata();    
    $output .= '</div>';//carousel-inner

    // Navigation
    $output .='<div class="container custom-nav-wrap">';
        $output .= '<div class="customNavigation carousel-controls">';
            $output .= '<a class="left rank-control" data-target="#themeum-post-slider" role="button" data-slide="prev">';
                $output .= '<i class="fa fa-angle-left"></i>';
            $output .= '</a>';
            
            $output .= '<a class="right rank-control" data-target="#themeum-post-slider" role="button" data-slide="next">';
                $output .= '<i class="fa fa-angle-right"></i>';
            $output .= '</a>';
        $output .= '</div>'; //.customNavigation
    $output .= '</div>'; //.container


    $output .= '</div>';
  

    // JS time
    $output .= "<script type='text/javascript'>jQuery(document).ready(function() { jQuery('.nano').nanoScroller(); jQuery('#themeum-post-slider').carousel({ interval: ".$time." }) });</script>";

  
    return $output;

});

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
    vc_map(array(
        "name" => esc_html__("Themeum post slider", 'themeum'),
        "base" => "themeum_post_slider",
        'icon' => 'icon-thm-slide',
        "class" => "",
        "description" => esc_html__("Widget Title Heading", 'themeum'),
        "category" => __('Themeum', "themeum"),
        "params" => array(              

            array(
                "type" => "textfield",
                "heading" => esc_html__("Category Name (leave empty for all latest post list)", 'themeum'),
                "param_name" => "category",
                "value" => "",
                ),                      

            array(
                "type" => "textfield",
                "heading" => esc_html__("Number of items", 'themeum'),
                "param_name" => "number",
                "value" => "",
                ),          

            array(
                "type" => "dropdown",
                "heading" => esc_html__("OderBy", 'themeum'),
                "param_name" => "order_by",
                "value" => array('Date'=>'date','Title'=>'title','Modified'=>'modified','Author'=>'author','Random'=>'rand'),
                ),              

            array(
                "type" => "dropdown",
                "heading" => esc_html__("Order", 'themeum'),
                "param_name" => "order",
                "value" => array('DESC'=>'DESC','ASC'=>'ASC'),
                ),                          

            array(
                "type" => "textfield",
                "heading" => esc_html__("Custom Class", 'themeum'),
                "param_name" => "class",
                "value" => "",
                ),  
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => esc_html__("Disable Slider: ","themeum"),
                "param_name" => "disable_slider",
                "value" => array ( esc_html__('Disable','themeum') => 'enable'),
                "description" => esc_html__("If you want disable slide check this.","themeum"),
                "group" => "Slide"
            ),

            array(
                "type" => "textfield",
                "heading" => esc_html__("Sliding Time(Milliseconds Ex: 4000)", "themeum"),
                "param_name" => "time",
                "value" => "3000",
                "group" => "Slide"
                ),

            )

        ));
}