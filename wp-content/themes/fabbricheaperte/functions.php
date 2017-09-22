<?php
/**
 * Fabbriche Aperte Piemonte functions
 *
 */

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'parent-style' ),
		wp_get_theme()->get('Version') );
}

add_image_size( 'twentyseventeen-thumbnail-edificio', 300, 300, true );

function oht_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 1000;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1000;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
remove_action( 'template_redirect', 'twentyseventeen_content_width', 0 );
add_action( 'template_redirect', 'oht_content_width', 0 );

unregister_sidebar( 'sidebar-1' );

wp_dequeue_style( 'twentyseventeen-fonts' );

function oht_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 1000 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 1000px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
remove_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10 );
add_filter( 'wp_calculate_image_sizes', 'oht_content_image_sizes_attr', 10, 2 );

add_action( 'init', 'oht_crea_edifici' );
function oht_crea_edifici() {
	register_post_type( 'edificio',
	array(
		'labels' => array(
			'name' => __( 'Edifici' ),
			'singular_name' => __( 'Edificio' )
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'edifici'),
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields'),
		'taxonomies' => array('post_tag', 'category' ),
		)
	);
}

function oht_add_edifici_body_class( $classes ) {
	global $post;
	if ( isset( $post ) && $post->post_type == 'edificio' && !is_archive() ) {
		$classes[] = 'has-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'oht_add_edifici_body_class' );

function oht_remove_menus(){
	remove_menu_page( 'edit.php' );          //Posts
	remove_menu_page( 'edit-comments.php' ); //Comments
}
add_action( 'admin_menu', 'oht_remove_menus' );

function oht_building_info() {
	$custom_fields = get_post_custom();
	$building_info = ['Anno', 'Progettisti', 'Apertura sabato', 'Apertura domenica',
		'Accesso', 'Modalità', 'Persone / Visita', 'Indirizzo', 'Mezzi', 'Accessibilità sedia a rotelle'];
	$output = '<ul>';
	foreach ($building_info as $info) {
		if ( array_key_exists($info, $custom_fields) ) {
			$value = $custom_fields[$info][0];
			if ( $info == 'Indirizzo' ) {
				$value = '<a href="https://www.google.it/maps?q='.$value.', Torino" target="_blank">'
					.$value.'</a>';
			}
			$output .= '<li><b>'.$info.':</b> '.$value.'</li>';
		}
	}
	$output .= '</ul>';
	return $output;
}
