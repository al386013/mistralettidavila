<?php
/*
 * Template for displaying content custom type Deportes
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

<p id="invisible"><?php $id = the_ID(); ?></p>

<h2 class="titulo-actividades"><a href="<?php the_permalink($id); ?>"><?php the_title(); ?></a></h2>
<p class="entry-meta">Autor del post: <?php the_author();?><br></p>

		<div class="entry-content">

			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt(); 
			} else {
				the_content( __( 'Continuar leyendo', 'twentyseventeen' ) );
			}
			?>

		</div>
<!-- .entry-content -->

	</div>

</article><!-- .post -->
