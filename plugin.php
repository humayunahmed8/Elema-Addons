<?php
namespace ElemaAddons;

use ElemaAddons\Widgets\Hello_World;


class ElemaPlugin {
	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function widget_scripts() {
		// wp_register_script( 'elementor-hello-world', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	private function include_widgets_files() {
        require_once __DIR__ . '/widgets/hello-world.php';
    }

	public function register_widgets() {
		// Its is now safe to include Widgets files
        $this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Hello_World() );
		// \Elementor\Plugin::instance()->$widgets_manager->register_widget_type( new Widgets\Hello_World() );
	}

	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		
		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
ElemaPlugin::instance();
