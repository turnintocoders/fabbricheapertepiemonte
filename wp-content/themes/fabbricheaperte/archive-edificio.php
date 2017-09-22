<?php
/**
 * The template for displaying archive edifici
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
$selected_cat = '';
$selected_tag = '';
$query = 'post_type=edificio';
if ( array_key_exists( 'cat', $_GET ) ) {
	$query .= '&cat='.htmlspecialchars($_GET['cat']);
	$selected_cat = $_GET['cat'];
}
if ( array_key_exists( 'tag', $_GET ) ) {
	$query .= '&tag='.htmlspecialchars($_GET['tag']);
	$selected_tag = $_GET['tag'];
}

query_posts( $query );

?>

<div class="wrap">
	<header class="page-header">
		<h1 class="page-title">Edifici</h1>
	</header><!-- .page-header -->

	<form method="get" class="search-form" action="/edifici">
		<div class="gallery gallery-columns-3 gallery-size-thumbnail">
			<div class="gallery-item">
				<label for="quartiere">Quartiere: </label>
				<select id="quartiere" name="cat">
					<option value="">Vedi tutti</option>
					<?php $categories = get_categories();
					$categories = array_filter($categories,
						function($c) {
							return $c->cat_ID != 1;
						} );
					foreach ($categories as $category) {
						$selected = $category->cat_ID == $selected_cat ? ' selected' : '';
						echo '<option value="'.$category->cat_ID.'"'.$selected.'>'.$category->name.'</option>';
					} ?>
				</select>
			</div><div class="gallery-item">
				<label for="tipologia">Tipologia: </label>
				<select id="tipologia" name="tag">
					<option value="">Vedi tutti</option>
					<?php $tags = get_tags();
					foreach ($tags as $tag) {
						$selected = $tag->slug == $selected_tag ? ' selected' : '';
						echo '<option value="'.$tag->slug.'"'.$selected.'>'.$tag->name.'</option>';
					} ?>
				</select>
			</div><div class="gallery-item">
				<label>&nbsp;</label>
				<button type="submit" class="form-submit">
					Filtra
				</button>
			</div>
		</div>
	</form>

	<?php
	if ( array_key_exists( 'cat', $_GET ) && !empty( $_GET['cat'] ) ) {
		echo '<b>Nel quartiere: </b>'.get_the_category()[0]->name.'</br>';
	}
	if ( array_key_exists( 'tag', $_GET ) && !empty( $_GET['tag'] ) ) {
		echo '<b>Tipologia: </b>'.get_the_tags()[0]->name.'</br>';
	}
	if ( ( array_key_exists( 'cat', $_GET ) && !empty( $_GET['cat'] ) ) ||
		 ( array_key_exists( 'tag', $_GET ) && !empty( $_GET['tag'] ) ) ) {
		echo '<p><a href="/edifici">Vedi tutti</a></p>';
	}
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="gallery gallery-columns-3 gallery-size-thumbnail">
			<?php
			/* Start the Loop */
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/edificio-thumb' );
				endwhile;
			else :
				get_template_part( 'template-parts/post/content', 'none' );
			endif; ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
