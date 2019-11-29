<?php 
    $output = ''; 
    $sub_img = array();
    global $post;

    if(!function_exists('thmtheme_call_sub_header')){
        function thmtheme_call_sub_header(){
            global $themeum_options;
            if(isset($themeum_options['blog-banner']['url'])){
                $output = 'style="background-image:url('.esc_url($themeum_options['blog-banner']['url']).');background-size: cover;background-position: 50% 50%;padding: 150px 0 90px;"';
                return $output;
            }else{
                 $output = 'style="background-color:'.esc_attr($themeum_options['blog-subtitle-bg-color']).';padding: 150px 0 90px;"';
                 return $output;
            }
        }
    }
    
    if( isset($post->post_name) ){
        if(!empty($post->ID)){ 
            $image_attached = esc_attr(get_post_meta( $post->ID , 'thm_subtitle_images', true ));
            if(!empty($image_attached)){
                $sub_img = wp_get_attachment_image_src( $image_attached , 'blog-full'); 
                $output = 'style="background-image:url('.esc_url($sub_img[0]).');background-size: cover;background-position: 50% 50%;padding: 150px 0 90px;"';
                if(empty($sub_img[0])){
                    $output = 'style="background-color:'.esc_attr(get_post_meta(get_the_ID(),"thm_subtitle_color",true)).';padding: 150px 0 90px;"';
                    if(get_post_meta(get_the_ID(),"thm_subtitle_color",true) == ''){
                        $output = thmtheme_call_sub_header();
                    }
                }
            }else{
                if(get_post_meta(get_the_ID(),"thm_subtitle_color",true) != "" ){
                    $output = 'style="background-color:'.esc_attr(get_post_meta(get_the_ID(),"thm_subtitle_color",true)).';padding: 150px 0 90px;"';
                }else{
                    $output = thmtheme_call_sub_header();
                }
            }
        }else{
            $output = thmtheme_call_sub_header();
        }
    }else{
            $output = thmtheme_call_sub_header();
        }

?>

<?php if (!is_front_page()) { ?>

<div class="sub-title" <?php echo $output;?>>
    <div class="container">
        <div class="sub-title-inner">
            <h2>
                <?php
                   $var = 1;
                   if(function_exists('is_shop')){
                       if(is_shop()&& !is_product()){
                         echo esc_html__('Shop', 'themeum-core');
                         $var = 2;
                       }
                   }
                   if($var != 2){
                        if( is_home() && get_option( 'page_for_posts' ) ){
                            echo get_the_title( get_option( 'page_for_posts' ) );
                        }elseif (is_archive()){
                            echo the_archive_title( '<span class="page-title">', '</span>' );
                        }else{
                            the_title();
                        }
                   }
               ?>
            </h2>
        </div>
    </div>
</div>

<?php } 


