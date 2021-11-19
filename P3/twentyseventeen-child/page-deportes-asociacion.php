<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
include("carrusel_js.php");
?>

<div class="wrap">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    
      <?php
        /*my custom fields Deportes*/
        $tipo_de_post = get_post_type();
        if($tipo_de_post= 'page') {
	  get_template_part( 'template-parts/page/content', get_post_type() );

          /* carrusel fotos */
          echo '<br><br><br>';
          echo '<div id="contenedorCarrusel"><div id="carrusel">';
          echo '<button id="anterior" onclick="suelta(', "'anterior'", ')" class="button-carrusel"><img src="../wp-content/uploads/2021/11/avance-izquierda.png" class="foto-boton"></button>';
          echo '<div><img id="fotoCarrusel" src="../wp-content/uploads/2021/11/arco.jpg"></div>';
          echo '<button id="siguiente" onclick="suelta(', "'siguiente'", ')" class="button-carrusel"><img src="../wp-content/uploads/2021/11/avance-derecha.png" class="foto-boton"></button>';
          echo '</div></div>';

	  $args = array(
	    'post_type' => 'deportes-adaptados',
	    'posts_per_page' => '10' 
          );

          $the_query1 = new WP_Query( $args );

          //el loop para cada deporte adaptado
          if ( $the_query1->have_posts() ) {
	    while ( $the_query1->have_posts() ) {
	      $Mi_post=$the_query1->the_post();
	      get_template_part( 'content-deportes-adaptados');
	    }

            echo '<h4><a id="mas-deportes" href="https://www.paralimpicos.es/deportes-paralimpicos" target="_blank">Más deportes paralímpicos</a></h4>';
          }
        }	
      ?>		  	

    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- .wrap -->

<?php
  get_footer();
?>