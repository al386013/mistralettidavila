<?php
//Para que  muestre errores de php para depurar código 
//define('WP_DEBUG', true);
//define('WP_DEBUG_LOG', true);
//define('WP_DEBUG_DISPLAY', true);
//@ini_set('display_errors', 1);
//Para que muestre errores de acceso o ejecución de las URLs
//ini_set('log_errors',TRUE);
//ini_set('error_reporting', E_ALL);
//ini_set('error_log', dirname(__FILE__) . '/error_logWP.txt');

function instalarPaginas(){
  require_once( ABSPATH . 'wp-admin/includes/post.php' );

  if (! post_exists('Deportes asociación')) {
    $wordpress_page = array(
      'post_title'    => 'Deportes asociación',
      'post_content'  => '[inscripciones]',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type' => 'page',
      'post_slug'=> "deportes-asociacion",
    );
    wp_insert_post( $wordpress_page );
  }
}
add_action( 'after_setup_theme', 'instalarPaginas', 11 );

//Shortcode para hacerte socio
function shortcode_socio() {
    return '<p class="shortcode">Si estás interesado en nuestras actividades, ¡hazte socio!</p>';
}
add_shortcode('socio', 'shortcode_socio');

//Shortcode para inscripciones
function shortcode_inscripciones() {
    return '<p class="shortcode">Si estás interesado en algún deporte adaptado que ofrecemos, ¡consulta e inscríbete en nuestras actividades!</p>';
}
add_shortcode('inscripciones', 'shortcode_inscripciones');


//custom-post Type asociacion
function gestion_deportes_adaptados() {
  $labels = array(
  'name' => _x('Deportes Adaptados', 'post type general name'),
  'singular_name' => _x('Deportes Adaptados', 'post type singular name'),
  'add_new' => _x('Añadir Deporte Adaptado', 'Deporte Adaptado'),
  'add_new_item' => __('Añadir Nuevo Deporte Adaptado'),
  'edit_item' => __('Editar Deporte Adaptado'),
  'new_item' => __('Nuevo Deporte Adaptado'),
  'view_item' => __('Ver Deporte Adaptado'),
  'search_items' => __('Buscar Deporte Adaptado'),
  'not_found' => __('No se han encontrado Deportes Adaptados'),
  'not_found_in_trash' => __('No se han encontrado Deportes Adaptados en la papelera')
);

$args = array(
  'labels' => $labels,
  'public' => true,
  'hierarchical' => false,
  'menu_position' => 2,
  'has_archive' => true,
  'query_var' => true,
  'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom- fields','comments','revisions'),
  'rewrite' => array('slug' => 'deportes-adaptados'),
);

register_post_type( 'deportes-adaptados', $args );

}
add_action('init', 'gestion_deportes_adaptados', 1);


//Widget para los datos de la asociación
class widget_datos extends WP_Widget {
  public function __construct() {
    $widget_ops = array( 
      'classname' => 'widget_datos',
      'description' => 'Widget con los datos de la asociación'
    );
    parent::__construct( 'widget_datos', 'Widget Datos', $widget_ops );
  }	

  // Creamos la parte pública del widget
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $socios = apply_filters( 'widget_title', $instance['socios'] );
    $monitores = apply_filters( 'widget_title', $instance['monitores'] );
    $patrocinadores = apply_filters( 'widget_title', $instance['patrocinadores'] );

    // los argumentos del antes y después del widget vienen definidos por el tema
    echo $args['before_widget'];
    if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];

    // Aquí es donde debemos introducir el código que queremos que se ejecute
    if ( ! empty( $socios ) and ! empty( $monitores) and ! empty( $patrocinadores)) {
      echo 'La asociación cuenta ya con: ' ;
      echo '<br><br><ul><li>', $socios, ' socios</li>';
      echo '<li>', $monitores, ' monitores</li>';
      echo '<li>', $patrocinadores, ' patrocinadores</li></ul>';
    } else {
      echo 'No hay datos de la asociación.';
    }   
    echo $args['after_widget'];
  }
		
  // Backend  del widget
  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = __( 'Titulo', 'my_widget_domain' );
    }

    // Formulario del backend
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e( 'Titulo:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>
    " name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" 
    value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id( 'socios' ); ?>">
    <?php _e( 'Socios:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'socios' ); ?>
    " name="<?php echo $this->get_field_name( 'socios' ); ?>" type="number" 
    value="<?php echo esc_attr( $socios ); ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id( 'monitores' ); ?>">
    <?php _e( 'Monitores:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'monitores' ); ?>
    " name="<?php echo $this->get_field_name( 'monitores' ); ?>" type="number" 
    value="<?php echo esc_attr( $monitores); ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id( 'patrocinadores' ); ?>">
    <?php _e( 'Patrocinadores:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'patrocinadores' ); ?>
    " name="<?php echo $this->get_field_name( 'patrocinadores' ); ?>" type="number" 
    value="<?php echo esc_attr( $patrocinadores); ?>" />
    </p>
    <?php	
  }

  // Actualizamos el widget reemplazando las viejas instancias con las nuevas
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['socios'] = ( ! empty( $new_instance['socios'] ) ) ? strip_tags( $new_instance['socios'] ) : '';
    $instance['monitores'] = ( ! empty( $new_instance['monitores'] ) ) ? strip_tags( $new_instance['monitores'] ) : '';
    $instance['patrocinadores'] = ( ! empty( $new_instance['patrocinadores'] ) ) ? strip_tags( $new_instance['patrocinadores'] ) : '';
    return $instance;
  }
} // La clase wp_widget termina aquí

// Registramos el widget
function load_widget_datos() {
  register_widget( 'widget_datos' );
}
add_action( 'widgets_init', 'load_widget_datos' );

?>