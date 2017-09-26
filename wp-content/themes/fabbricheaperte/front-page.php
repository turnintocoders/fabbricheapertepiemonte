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

		<article id="post-119" class="twentyseventeen-panel  post-119 page type-page status-publish has-post-thumbnail hentry">

			<div class="panel-image" style="background-image: url(/wp-content/themes/fabbricheaperte/img/Header-1.jpg);">
				<div class="panel-txt">
					<p>Due giorni per scoprire le industrie del Piemonte</p>
				</div>
				<div class="panel-txt">
					<p>#fabbricheaperte</p>
				</div>
			</div><!-- .panel-image -->


		</article><!-- #post-## -->


		<article id="panel1" class="twentyseventeen-panel  post-123 page type-page status-publish has-post-thumbnail hentry">

				<div class="panel-container">
					<div class="panel-item">
						<p> PRONTI PER SCOPRIRE LE INDUSTRIE MANIFATTURIERE DEL PIEMONTE
							E LE LORO ECCELLENZE?<br/>
							 <br/>
							Il 27 e 28 ottobre 2017, FABBRICHE APERTE<br/>
							<span>vi farà entrare in numerosi stabilimenti, che apriranno le porte per mostrarvi i loro processi di produzione.</span>

						</p>
					</div>
					<div class="panel-item">
						<p>
							<strong><span>Dall’automotive al design, dall’agroalimentare al tessile, dall’aerospaziale ai servizi avanzati, dalla meccanica alla chimica, sono tante le eccellenze dell’industria manifatturiera piemontese da conoscere.</span><br/>
Scoprirete storie di determinazione e innovazione esempi di cultura d’impresa e di saperi tecnologici.</strong><br>
Un mondo affascinante che permette l'affermazione del sistema economico del  Piemonte a livello internazionale grazie al saper fare e alla qualità  produttiva.
Una rete di eccellenze che la strategia regionale punta a rafforzare  grazie all'utilizzo mirato dei fondi europei per l'innovazione e la competitività.
						</p>
					</div>
				</div><!-- .panel-container -->

		</article><!-- #post-## -->



		<article id="panel2" class="twentyseventeen-panel  post-123 page type-page status-publish has-post-thumbnail hentry">

				<div class="panel-container">
					<div class="panel-item">
						<h3>PER LE AZIENDE</h3>
						<p>Come diventare una delle Fabbriche Aperte?</p>
						<p>Per aderire all’iniziativa
							Fabbriche Aperte scrivi a <span><a href="mailto:gabinettopresidenzagiunta@regione.piemonte.it">gabinettopresidenzagiunta@regione.piemonte.it</a></span></p>
					</div>
					<div class="panel-item">
						<h3>PER IL PUBBLICO</h3>
						<p>Come partecipare una delle Fabbriche Aperte?</p>
						<p>Le prenotazioni saranno aperte dal 1 ottobre accedendo alle schede delle singole fabbriche</p>
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

<?php get_footer();