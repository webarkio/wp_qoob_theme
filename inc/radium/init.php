<?php
/**
 * Version 0.0.3
 *
 * This file is just an example you can copy it to your theme and modify it to fit your own needs.
 * Watch the paths though.
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if ( !class_exists( 'Radium_Theme_Demo_Data_Importer' ) ) {

	require_once( dirname( __FILE__ ) . '/importer/radium-importer.php' ); //load admin theme data importer

	class Radium_Theme_Demo_Data_Importer extends Radium_Theme_Importer {

		/**
		 * Set framewok
		 *
		 * options that can be used are 'default', 'qoob' or 'optiontree'
		 *
		 * @since 0.0.3
		 *
		 * @var string
		 */
		public $theme_options_framework = 'radium';

		/**
		 * Holds a copy of the object for easy reference.
		 *
		 * @since 0.0.1
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Set the key to be used to store theme options
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */

		
		public $theme_option_name       = 'my_theme_options_name'; //set theme options name here (key used to save theme options). Optiontree option name will be set automatically
		public $theme_options_file_name = 'theme_options.txt';
		public $widgets_file_name       = 'widgets.json';
		public $content_demo_file_name  = 'content.xml';
		/**
		 * Holds a copy of the widget settings
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $widget_import_results;

		/**
		 * Constructor. Hooks all interactions to initialize the class.
		 *
		 * @since 0.0.1
		 */
		public function __construct() {
			$this->content_demo_url = get_template_directory_uri() . '/inc/radium/demo-files/content.xml';
			$this->widget_demo_url  = get_template_directory_uri() . '/inc/radium/demo-files/widgets.json';

			$this->demo_files_path = dirname(__FILE__) . '/demo-files/'; //can

			self::$instance = $this;
			parent::__construct();
			set_time_limit(0);
		}

		/**
		 * Add menus - the menus listed here largely depend on the ones registered in the theme
		 *
		 * @since 0.0.1
		 */
		public function set_demo_menus(){

			// Menus to Import and assign - you can remove or add as many as you want
			$main_menu   = get_term_by('name', 'Main Menu', 'nav_menu');

			set_theme_mod( 'nav_menu_locations', array(
					'main_menu' => $main_menu->term_id
				)
			);

			$this->flag_as_imported['menus'] = true;

		}

	}

	new Radium_Theme_Demo_Data_Importer;

}