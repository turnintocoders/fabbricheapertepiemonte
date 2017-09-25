<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="icon" type="image/png" sizes="32x32" href="<?= get_stylesheet_directory_uri() ?>/icon/favicon-32x32.png">
<link rel="icon" href="<?= get_stylesheet_directory_uri() ?>/icon/favicon.ico" type="image/x-icon">

<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-97376718-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

	</header><!-- #masthead -->

	<?php
	// If a regular post or page, and not the front page, show the featured image.
	// if ( has_post_thumbnail() && ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) ) :
	// 	echo '<div class="single-featured-image-header">';
	// 	the_post_thumbnail( 'twentyseventeen-featured-image' );
	// 	echo '</div><!-- .single-featured-image-header -->';
	// endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
