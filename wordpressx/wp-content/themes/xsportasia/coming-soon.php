<?php 
/*
 * Template Name: Coming Soon
 */
get_header('alternative'); ?>

<?php
    global $themeum_options;
    $comingsoon_date = '';
    if ( $themeum_options['comingsoon-date'] ) {
        $comingsoon_date = esc_attr( $themeum_options['comingsoon-date'] );
    }
?>

<div class="comingsoon-main-wrap" style="background-image: url(<?php echo esc_url( $themeum_options['comingsoon-bg']['url']); ?>);">
    <div class="container">
        <div class="comingsoon-wrap text-center">
            <div class="comingsoon-content">
                <script type="text/javascript">
                    jQuery(function($) {
                    $('#comingsoon-countdown').countdown("<?php echo str_replace('-', '/', $comingsoon_date); ?>", function(event) {
                        $(this).html(event.strftime('<div class="countdown-section"><span class="countdown-amount first-item countdown-days">%-D </span><span class="countdown-period">%!D:<?php echo esc_html__("DAY", "politist"); ?>,<?php echo esc_html__("DAYS", "politist"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-hours">%-H </span><span class="countdown-period">%!H:<?php echo esc_html__("HOUR", "politist"); ?>,<?php echo esc_html__("HOURS", "politist"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-minutes">%-M </span><span class="countdown-period">%!M:<?php echo esc_html__("MINUTE", "politist"); ?>,<?php echo esc_html__("MINUTES", "politist"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount countdown-seconds">%-S </span><span class="countdown-period">%!S:<?php echo esc_html__("SECOND", "politist"); ?>,<?php echo esc_html__("SECONDS", "politist"); ?>;</span></div>'));
                    });
                });
                </script>

                <?php if( $themeum_options['comingsoon-logo']): ?>
                    <div class="logo-top">
                        <img src="<?php echo esc_url( $themeum_options['comingsoon-logo']['url']); ?>" alt="<?php  esc_html_e( '404 error', 'politist' ); ?>">
                    </div>
                <?php endif; ?>

                <?php if( $themeum_options['comingsoon-title']): ?>
                    <h3 class="coming-soon-title"><?php echo $themeum_options['comingsoon-title']; ?></h3>
                <?php endif; ?>
                <div id="comingsoon-countdown"></div>
            
            </div><!--/.comingsoon-content-->
        </div><!--/.comingsoon-wrap-->
    </div><!--/.container-->
</div><!--/.comingsoon-->


<?php get_footer('alternative');