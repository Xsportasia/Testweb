<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TA Newspaper
 */

get_header(); ?>
<div class="tan-container clearfix">

	<?php global $post;
	$sidebar_meta_option = 'right_sidebar';
    $sidebar_meta_option = get_post_meta( $post->ID, 'ta_newspaper_post_sidebar_layout', true );
    
    if($sidebar_meta_option == 'both_sidebar' || $sidebar_meta_option == 'left_sidebar'){
        get_sidebar( 'left' );
    } ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if( $sidebar_meta_option == 'right_sidebar' || $sidebar_meta_option == 'both_sidebar' || $sidebar_meta_option == '') {
        get_sidebar();
} ?>

</div>
<?php get_footer();
