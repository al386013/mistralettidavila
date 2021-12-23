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
?>

<div class="wrap">
  <div id="primary" class="content-area">
    <main role="main">
      <h1 class="page-title">Deportes Template</h1>
      <div class="entry-meta">Obtén los deportes adaptados de la asociación.</div><br>
      <p><a id="recuperarCPT" href=""><button class="button" id="botonRecuperar">Recuperar Custom Post Type</button></a></p>
      <div id="divTemplate"></div>
    </main>
  </div>
</div>
  
<?php
  get_footer();
?>