<?php

if ( ! class_exists( 'Maera_Bootstrap_Widgets' ) ) {

	/**
	* The Bootstrap Shell module
	*/
	class Maera_Bootstrap_Widgets {

		/**
		 * Class constructor
		 */
		public function __construct() {

			// Widgets
			add_action( 'maera/widgets/areas', array( $this, 'extra_widget_areas_array' ), 12 );
			add_action( 'maera/widgets/class', array( $this, 'widgets_class' ) );
			add_action( 'maera/widgets/title/before', array( $this, 'widgets_before_title' ) );
			add_action( 'maera/widgets/title/after', array( $this, 'widgets_after_title' ) );
		}


		/**
		 * Return an array of the extra widget area regions
		 */
		function extra_widget_areas_array() {

			$areas = array(
				'body_top'     => array(
					'name'     => __( 'Body Top', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/header/before/ewa',
					'priority' => 20,
					'class'    => 'row',
				),
				'pre_header'   => array(
					'name'     => __( 'Pre-Header', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/extra_header/before/ewa',
					'priority' => 20,
					'class'    => 'row',
				),
				'header'       => array(
					'name'     => __( 'Header', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/extra_header/widgets/ewa',
					'priority' => 10,
					'class'    => 'row',
				),
				'post_header'  => array(
					'name'     => __( 'Post-Header', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/extra_header/after/ewa',
					'priority' => 15,
					'class'    => 'row',
				),
				'jumbotron'    => array(
					'name'     => __( 'Jumbotron', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/jumbotron/content/ewa',
					'priority' => 10,
					'class'    => 'row',
				),
				'pre_content'  => array(
					'name'     => __( 'Pre-Content', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/wrap/before/ewa',
					'priority' => 10,
					'class'    => 'row',
				),
				'pre_main'     => array(
					'name'     => __( 'Pre-Main', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/content/before/ewa',
					'priority' => 10,
					'class'    => 'row',
				),
				'post_main'    => array(
					'name'     => __( 'Post-Main', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/content/after/ewa',
					'priority' => 10,
					'class'    => 'row',
				),
				'pre_footer'   => array(
					'name'     => __( 'Pre-Footer', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/footer/before/ewa',
					'priority' => 10,
					'class'    => 'row',
				),
				'footer'       => array(
					'name'     => __( 'Footer', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/footer/content/ewa',
					'priority' => 10,
					'class'    => 'row',
				),
				'post_footer'  => array(
					'name'     => __( 'Post-Footer', 'maera_bootstrap' ),
					'default'  => 0,
					'action'   => 'maera/footer/after/ewa',
					'priority' => 10,
					'class'    => 'row',
				),
			);

			return $areas;

		}


		/**
		 * Get the widget class
		 */
		function widgets_class() {

			$widgets_mode = get_theme_mod( 'widgets_mode', 'none' );

			if ( 'panel' == $widgets_mode ) {
				return 'panel panel-default';
			} elseif ( 'well' == $widgets_mode ) {
				return 'well';
			}

		}


		/**
		 * Widgets 'before_title' modifying based on widgets mode.
		 */
		function widgets_before_title() {

			$widgets_mode = get_theme_mod( 'widgets_mode', 'none' );

			if ( 'panel' == $widgets_mode ) {
				return '<div class="panel-heading">';
			} elseif ( 'well' == $widgets_mode ) {
				return '<h3 class="widget-title">';
			}

		}


		/**
		 * Widgets 'after_title' modifying based on widgets mode.
		 */
		function widgets_after_title() {

			$widgets_mode = get_theme_mod( 'widgets_mode', 'none' );

			if ( 'panel' == $widgets_mode ) {
				return '</div><div class="panel-body">';
			} elseif ( 'well' == $widgets_mode ) {
				return '</h3>';
			}

		}

	}

}

/**
 * Adds Maera Logo widget.
 */
class Maera_Logo_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'maera_logo',
			__( 'Logo (Maera Bootstrap)', 'maera_bootstrap' ),
			array( 'description' => __( 'The logo you have specified in the Customizer', 'maera_bootstrap' ), )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		$logo = get_theme_mod( 'logo', '' );

		if ( $logo ) {
			echo '<img id="brand-logo" src="' . $logo . '" alt="' . get_bloginfo( 'name' ) .'">';
		}

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		_e( 'This widget has no options. Its only function is to print the site logo, as defined in the theme customizer. You can use this wherever you need, particularly useful in the header widget areas, or to accomplish alternative site layouts', 'maera_bootstrap' );

	}

}

function register_maera_logo_widget() {
    register_widget( 'Maera_Logo_Widget' );
}
add_action( 'widgets_init', 'register_maera_logo_widget' );
