<?php if(!defined('ABSPATH')) { die(); } // Include in all php files, to prevent direct execution
/**
 * Plugin Name: EmptyPlugin
 * Description: A Generic Empty Plugin for project testing
 * Author: Pierce Gresham
 * Author URI:
 * Version: 0.1.1
 * Text Domain: empty-plugin
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 **/
if( !class_exists('EmptyPlugin') ) {
	class EmptyPlugin {
		private static $version = '0.1.0';
		private static $_this;
		private $capability = 'manage_options';


		private $new_format_post_type = array(
			'vehicle' => array(
		        'labels' => array(
		            'singular'    => 'Vehicle',
		            'plural'      => 'Vehicles', // optional
		            'overrides'   => array(),    // optional
		            'text_domain' => ''          // optional
		        ),
		        'args' => array(
		            'public'              => true,
		            'has_archive'         => true,
		            'menu_position'       => 21,
		            'menu_icon'           => 'dashicons-portfolio',
		            'supports'            => array('title', 'thumbnail'),
		            'taxonomies'          => array('resource_type', 'resource_tag'),
		            'exclude_from_search' => true
		        ),
		    ),
		);


		// taken from the PostTaxClass
		private $test_post_types = array(
			'vehicle' => array(
				'args' => array(
					'label'               => 'Vehicle',
					// 'labels'              => $this->populate_labels('Resource', 'Resources'),
					'public'              => true,
					'has_archive'         => true,
					'menu_position'       => 21,
					'menu_icon'           => 'dashicons-portfolio',
					'supports'            => array('title', 'thumbnail'),
					'taxonomies'          => array('resource_type', 'resource_tag'),
					'exclude_from_search' => true
				),
				'singular' => 'Vehicle',
				'plural'   => 'Vehicles',	
			),
			'idea' => array(
				'args' => array(
					'label'               => 'Idea',
					// 'labels'              => $this->populate_labels('Resource', 'Resources'),
					'public'              => true,
					'has_archive'         => true,
					'menu_position'       => 21,
					'menu_icon'           => 'dashicons-portfolio',
					'supports'            => array('title', 'thumbnail'),
					'taxonomies'          => array('resource_type', 'resource_tag'),
					'exclude_from_search' => true
				),
				'singular' => 'Idea',
				'plural'   => 'Ideas',	
			),
			'book' => array(
				'args' => array(
					'label'               => 'Book',
					// 'labels'              => $this->populate_labels('Resource', 'Resources'),
					'public'              => true,
					'has_archive'         => true,
					'menu_position'       => 21,
					'menu_icon'           => 'dashicons-portfolio',
					'supports'            => array('title', 'thumbnail'),
					'taxonomies'          => array('resource_type', 'resource_tag'),
					'exclude_from_search' => true
				),
				'singular' => 'Book',
				'plural'   => 'Books',	
			),
		);

		private $test_taxonomies = array(
				'service' => array(
					'args' => array(
						// 'labels'            => $this->populate_labels('Service', 'Services'),
						'hierarchical'      => false,
						'public'            => true,
						'show_ui'           => true,
						'show_admin_column' => true,
						'show_in_nav_menus' => true,
						'show_tagcloud'     => true,
						'rewrite'           => array(
							'slug'            => 'services'
						),
					),
					'post_types'          => array( 'post', 'team', 'portfolio' ),
					'singular'            => 'Service',
					'plural'              => 'Services',	
				),
			);

		
		public static function Instance() {
			static $instance = null;
			if ($instance === null) {
				$instance = new self();
			}
			return $instance;
		}


		private function __construct() {
			register_activation_hook( __FILE__, array( $this, 'register_activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'register_deactivation' ) );

			add_action( 'init', array( $this, 'plugin_init') );
			add_action( 'admin_menu', array( $this, 'add_test_page') );
			add_action( 'init', array( $this, 'register_post_types' ) );
			add_action( 'init', array( $this, 'register_taxonomies' ) );

		}

		public function register_post_types() {
			BytesPostsTaxonomies::new_register_custom_post_types( $this->new_format_post_type );
		}
		public function register_taxonomies() {
			// BytesPostsTaxonomies::register_taxonomies( $this->test_taxonomies );
		}




		/**
		 * Register and enque resource styles and scripts
		 * Owl Carousel and Featherlight libraries
		 */
		public function admin_enqueues() {
		}
		public function register_activation() {
		}

		public function register_deactivation() {
		}
		
		public function plugin_init() {
			include_once 'classes/BytesPostTypesTaxonomies.php';
		}

		// Function to display tool menu addition 
		public function add_test_page() {
			var_dump(array(1, 2, 3));
			add_submenu_page( 'tools.php', __( 'Empty Plugin', 'empty-plugin' ), __( 'Empyty Plugin', 'empty-plugin' ), $this->capability, 'empty-plugin', array( $this, 'render_test_page' ) );
		}


		public function render_test_page() {
			?>
			<h2>output</h2>
			<?php
// echo BytesPostsTaxonomies::test_func();
			
			// print_r( get_terms( 'service' ) );
		}
	}
	// create instance of Class
	EmptyPlugin::Instance();
}
?>