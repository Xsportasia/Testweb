<div id="sidebar" class="col-sm-4" role="complementary">
    <aside class="widget-area">
        <?php 
	        $var =  get_post_meta( get_the_ID() , '_my_meta_value_key', true  );
	        if($var == ''){
	        	if ( is_active_sidebar( 'sidebar' ) ) {
	        		dynamic_sidebar('sidebar');
	        	}
	        }else{
	        	if ( is_active_sidebar( $var ) ) {
	        		dynamic_sidebar(esc_attr($var));
	        	}
	        }
         ?>

    </aside>
</div> <!-- #sidebar -->