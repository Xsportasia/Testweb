<?php global $themeum_options; ?>


<div class="page-content">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

    <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'themeum' ), admin_url( 'post-new.php' ) ); ?></p>

    <?php } elseif ( is_search() ) { ?>
    <img src="<?php echo esc_url(get_template_directory_uri().'/images/search-error.png'); ?>"  alt="<?php  _e( 'Error Search', 'themeum' ); ?>">
    <h2 class="search-error-title"><?php _e( 'Nothing Found', 'themeum' ); ?></h2>

    <p class="search-error-text"><?php _e( 'Sorry, but nothing matched your search terms. Please try again <br> with different keywords.', 'themeum' ); ?></p>
    <?php 
       if(isset($_GET['post_type'])){
            ?>
            <div class="course-search col-md-offset-2 col-sm-12 col-md-8">
                <form role="search" action="<?php echo esc_url(site_url('/')); ?>" method="get">
                    <input class="custom-input" type="search" name="s" placeholder="Find Course, Tutorials"/>
                    <input type="hidden" name="post_type" value="course" />
                    <input type="submit" alt="Search" value="" class="transparent-button" />
                </form>
            </div>
            <?php
        }else{
            get_search_form();
        }  
    ?>

    <?php } else { ?>

    <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'themeum' ); ?></p>
    <?php get_search_form(); ?>

    <?php } ?>
</div><!-- .page-content -->