<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

  get_header();
?>

<div class="wrap">
  <div id="primary" class="content-area">
    <main role="main">
      <h1 class="page-title">Deportes adaptados</h1>
      <div class="entry-meta">Descubre cada deporte de la asociación.</div>
      <?php
        the_title( '<h2 class="titulo-actividades">', '</h2>' );
        the_content();
       ?>
    </main>
  </div>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>