<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php  if ( get_post_meta( get_the_ID(), 'thm_video',true ) ) { ?>
    <div class="featured-wrap">
        <div class="entry-video embed-responsive embed-responsive-16by9">
            <?php $video_source = esc_attr(get_post_meta( get_the_ID(), 'thm_video_source',true )); ?>
            <?php $video = get_post_meta( get_the_ID(), 'thm_video',true ); ?>
            <?php if($video_source == 1): ?>
                <?php echo get_post_meta( get_the_ID(), 'thm_video',true ); ?>
            <?php elseif ($video_source == 2): ?>
                <?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
            <?php elseif ($video_source == 3): ?>
                <?php echo '<iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="350" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
            <?php endif; ?>
        </div><div class="share-btn"><i class="fa fa-share"></i></div>
        <div class="share-btn-pop" style="display:none"><?php get_template_part( 'post-format/social-buttons' ); ?></div>
    </div>
    <?php } ?>

    <div class="entry-content-wrap">
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    </div>

</article> <!--/#post -->