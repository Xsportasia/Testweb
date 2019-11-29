<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php  if ( rwmb_meta( 'thm_audio_code' ) ) { ?>
    <div class="featured-wrap">
        <div class="entry-audio embed-responsive embed-responsive-16by9">
            <?php echo rwmb_meta( 'thm_audio_code' ); ?>
        </div> <!--/.audio-content -->
        <div class="share-btn"><i class="fa fa-share"></i></div>
        <div class="share-btn-pop" style="display:none"><?php get_template_part( 'post-format/social-buttons' ); ?></div>
    </div>    
    <?php } ?>          

    <div class="entry-content-wrap">
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    </div>

  
</article> <!--/#post -->