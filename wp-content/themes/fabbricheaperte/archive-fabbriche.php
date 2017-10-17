<?php
/**
 * The template for displaying archive fabbriche
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
$selected_provincia = '';
$selected_category = '';
$query = [
	'post_type' => 'fabbriche',
	'meta_query' => [
		'relation' => 'AND',
	],
	'orderby' => 'title',
	'order'   => 'ASC',
];
if ( array_key_exists( 'provincia', $_GET ) && !empty( $_GET['provincia'] ) ) {
	$selected_provincia = $_GET['provincia'];
	$query['meta_query'][] = [
		'key' => 'provincia',
		'value' => $selected_provincia,
		'compare'	=> 'LIKE'
	];
}
if ( array_key_exists( 'category', $_GET ) && !empty( $_GET['category'] ) ) {
	$selected_category = $_GET['category'];
	$query['meta_query'][] = [
		'key' => 'categoria',
		'value' => $selected_category,
		'compare'	=> 'LIKE'
	];
}

query_posts( $query );

?>

<div class="wrap margin-bottom">
	<form method="get" class="search-form" action="/fabbriche">
		<div class="gallery gallery-columns-3 gallery-size-thumbnail">
			<div class="gallery-item">
				<label for="quartiere">Provincia: </label>
				<select id="quartiere" name="provincia">
					<option value="">Vedi tutti</option>
					<?php $province = get_field_object('field_59c5168825d53')['choices'];
					foreach ($province as $key => $provincia) {
						$selected = $provincia == $selected_provincia ? ' selected' : '';
						echo '<option value="'.$key.'"'.$selected.'>'.$provincia.'</option>';
					} ?>
				</select>
			</div><div class="gallery-item">
				<label for="tipologia">Categoria: </label>
				<select id="tipologia" name="category">
					<option value="">Vedi tutti</option>
					<?php $categories = get_field_object('field_59c517c86992c')['choices'];
					foreach ($categories as $key => $category) {
						$selected = $key == $selected_category ? ' selected' : '';
						echo '<option value="'.$key.'"'.$selected.'>'.$category.'</option>';
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
	if ( array_key_exists( 'provincia', $_GET ) && !empty( $_GET['provincia'] ) ) {
		echo '<b>Provincia: </b>'.get_field_object('field_59c5168825d53')['choices'][$selected_provincia].' ';
	}
	if ( array_key_exists( 'category', $_GET ) && !empty( $_GET['category'] ) ) {
		echo '<b>Categoria: </b>'.get_field_object('field_59c517c86992c')['choices'][$selected_category].' ';
	}
	if ( ( array_key_exists( 'provincia', $_GET ) && !empty( $_GET['provincia'] ) ) ||
		 ( array_key_exists( 'category', $_GET ) && !empty( $_GET['category'] ) ) ) {
		echo '<a href="/fabbriche">Vedi tutti</a>';
	}
	?>
</div>


<div class="wrap">
	<main id="main" class="site-main" role="main">
		<div class="item-fabbrica">
		<?php
		/* Start the Loop */
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/fabbriche-thumb' );
			endwhile;
		else :
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>
		</div>
	</main><!-- #main -->
</div><!-- .wrap -->

<?php get_footer();
