<?php get_header('alternative'); 
/*
*Template Name: 404 Page Template
*/
global $themeum_options;
?>
<section class="error-page-inner">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center wow fadeIn">
                   <img src="<?php echo esc_url($themeum_options['errorpage']['url']); ?>"  alt="<?php  _e( '404 error', 'themeum' ); ?>">
                    <h1><?php  _e( '404','themeum');?> </h1>
                    <p class="p-error"><?php  _e( 'Were sorry, Page Not Found', 'themeum' ); ?></p>
                    <a href="<?php echo esc_url(site_url()); ?>" class="btn btn-default home-btn"><i class="fa fa-home"></i> <?php echo __('Back to Home','themeum'); ?></a>    
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer('alternative'); ?>
