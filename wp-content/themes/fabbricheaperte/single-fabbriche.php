<?php
/**
 * The template for displaying single fabbrica
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div class="white-background cf">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/post/content', get_post_format() );

						// // If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;
						//
						// the_post_navigation( array(
						// 	'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
						// 	'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
						// ) );

					endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<aside id="secondary" class="widget-area" role="complementary">
			<section class="widget widget_text">
				<h2 class="widget-title">Informazioni</h2>
				<div class="textwidget">
					<?= fap_building_info() ?>
				</div>
			</section>

			<p>
				<b>Provincia:</b>
				<?php $provincia = get_field_object('field_59c5168825d53')['value'] ?>
				<a href="/fabbriche?cat=<?= $provincia ?>">
					<?= $provincia ?>
				</a>
			</p>

			<p>
				<b>Categoria:</b>
				<?php $categorie = get_field_object('field_59c517c86992c')['value'] ?>
				<a href="/fabbriche?tag=<?= implode(',', $categorie) ?>">
					<?= implode(', ', $categorie) ?>
				</a>
			</p>
		</aside><!-- #secondary -->
	</div>
</div><!-- .wrap -->

<?php get_footer();
