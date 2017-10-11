<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article class="twentyseventeen-panel">
			<div class="panel-image clear">
				<div class="wrap">
					<div class="panel-txt panel-txt-left">
						<p>Due giorni<br>per scoprire<br>le industrie<br>del Piemonte</p>
					</div>
					<div class="panel-txt panel-txt-right font-light">
						<p>#piemontefabbricheaperte</p>
					</div>
				</div>
			</div><!-- .panel-image -->
		</article><!-- #post-## -->

		<article id="panel1" class="twentyseventeen-panel">
				<div class="wrap">
					<div class="panel1-item panel1-item-left">
						<p class="panel1-item-title">
							Pronti per scoprire le industrie manifatturiere del Piemonte e le loro eccellenze?
							<br>
							<br>
						</p>
						<p>
							Il 27 e 28 ottobre 2017, Fabbriche Aperte
							<br>
							<span class="font-light green">vi farà entrare in numerosi stabilimenti, che apriranno le porte per mostrarvi i loro processi di produzione.</span>
						</p>
					</div>
					<div class="panel1-item panel1-item-right purple">
						<p>
							<strong><span class="font-light">
								Dall’automotive al design, dall’agroalimentare al tessile, dall’aerospaziale
								ai servizi avanzati, dalla meccanica alla chimica, sono tante le eccellenze
								dell’industria manifatturiera piemontese da conoscere.</span>
								<br>
								<br>
								Scoprirete storie di determinazione e innovazione esempi di cultura d’impresa e di saperi
								tecnologici.
							</strong>
							<br>
							<br>
							<span class="font-light">
								Un mondo affascinante che permette l'affermazione del sistema economico del  Piemonte a
								livello internazionale grazie al saper fare e alla qualità  produttiva.
								Una rete di eccellenze che la strategia regionale punta a rafforzare  grazie all'utilizzo
								mirato dei fondi europei per l'innovazione e la competitività.
							</span>
						</p>
					</div>
				</div><!-- .panel-container -->
		</article><!-- #post-## -->

		<article id="panel2" class="twentyseventeen-panel">
				<div class="wrap">
					<div class="panel2-item panel2-item-left purple">
						<h3>Per le aziende</h3>
						<p class="font-light">La raccolta delle adesioni per l'edizione 2017 è conclusa.</p>
						<p class="font-light">Per informazioni su Fabbriche Aperte scrivi a <b><a class="green" href="mailto:gabinettopresidenzagiunta@regione.piemonte.it">gabinettopresidenzagiunta@regione.piemonte.it</a></b></p>
					</div>
					<div class="panel2-item panel2-item-right">
						<h3>Per il pubblico</h3>
						<p class="panel2-item-big-font">Come visitare le Fabbriche Aperte?</p>
						<p class="font-light">Le prenotazioni saranno aperte dal 1 ottobre accedendo alle schede delle singole fabbriche</p>
						<a class="green" href="mailto:info@piemontefabbricheaperte.it">info@piemontefabbricheaperte.it</a>
					</div>
				</div><!-- .panel-container -->
		</article><!-- #post-## -->

		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== twentyseventeen_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param int $num_sections Number of front page sections.
			 */
			$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );
			global $twentyseventeencounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$twentyseventeencounter = $i;
				twentyseventeen_front_page_section( null, $i );
			}

	endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
$query = [
	'post_type' => 'fabbriche',
];
query_posts( $query );
$js = '';
$id = 0;
while ( have_posts() ) : the_post();
	$custom_fields = get_field_objects();
	if ($custom_fields['indirizzo']['value']) {
		$lat = $custom_fields['indirizzo']['value']['lat'];
		$lng = $custom_fields['indirizzo']['value']['lng'];
		$js .= 'var marker'.$id.' = new google.maps.Marker({
			position: {lat: '.$lat.', lng: '.$lng.'},
			map: map
		});';
		$js .= 'marker'.$id.'.addListener(\'click\', function() {
			infoWindow.setContent("<a href=\''.get_permalink().'\'>'.get_the_title().'</a>");
			infoWindow.open(map, marker'.$id.');
			});';
		$id++;
	}
endwhile;
?>

<style>
#map {
	height: 500px;
	width: 100%;
}
</style>
<div id="map"></div>
<script>
function initMap() {
	var infoWindow = new google.maps.InfoWindow;
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 8,
		center: {lat:45.295, lng:8.038}
	});
	<?= $js ?>
}
</script>

<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNjXHb9FNrUR_WOC0gHprUEEbHvd_aKIY&callback=initMap">
</script>
<?php get_footer();
