<?php
/**
 * Plugin integrations.
 */

abstract class Capstone_Integration {

	public $includes = array();

	public $directory;

	/**
	 * Add customizer support.
	 *
	 * @since 3.5.0
	 * @access public
	 * @var $has_customizer
	 */
	public $has_customizer;

	public function __construct( $directory ) {
		$this->directory = $directory;

		$this->includes();
		$this->init();
		$this->setup_actions();

		$this->internal_actions();

		// load customizer definitions if needed
		if ( $this->has_customizer ) {
			$this->customize_register_items();
		}
	}

	private function includes() {
		if ( empty( $this->includes ) ) {
			return;
		}

		foreach ( $this->includes as $file ) {
			require_once( trailingslashit( $this->directory ) . $file );
		}
	}

	public function init() {}

	public function setup_actions() {}

	private function internal_actions() {
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	public function body_class( $classes ) {
		$classes[] = $this->get_slug();

		return $classes;
	}

	public function get_url() {
		return trailingslashit( get_template_directory_uri() . '/integrations/' . $this->get_slug() );
	}

	public function get_dir() {
		return trailingslashit( $this->directory );
	}

	private function get_slug() {
		$slug = basename( $this->get_dir() );

		return $slug;
	}

	/**
	 * Load customizer items.
	 *
	 * This loads Kirki based customizer definitions.
	 */
	public function customize_register_items() {
		if ( class_exists( 'Kirki' ) ) {
			$definition_file = $this->get_dir() . 'customizer/customizer-' . $this->get_slug() . '.php';

			if ( empty( $definition_file ) ) {
				return;
			}
	
			include_once( $definition_file );
		}
	}
}
