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


		private $format_post_type = array(
			'animal' => array(
		        'labels' => array(
		            'singular'    => 'Animal',
		            'plural'      => 'Animals', // optional
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
		    'vegetable' => array(
		        'labels' => array(
		            'singular'    => 'Vegatable',
		            // 'plural'      => '', // optional
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
		    'mineral' => array(
		        'labels' => array(
		            'singular'    => 'Mineral',
		            'plural'      => 'Minerals', // optional
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

		private $test_taxonomies = array(
				'color' => array(
					'labels'    => array(
			            'singular'    => 'Color',
			             // optional
			            'overrides'   => array(),    // optional
			            'text_domain' => ''          // optional
			        ),
					'args'      => array(
						// 'labels'            => $this->populate_labels('Service', 'Services'),
						'hierarchical'      => false,
						'public'            => true,
						'show_ui'           => true,
						'show_admin_column' => true,
						'show_in_nav_menus' => true,
						'show_tagcloud'     => true,
						'rewrite'           => array(
							'slug'            => 'colors'
						),
					),
				),
				'number' => array(
					'labels'    => array(
			            'singular'    => 'Number',
			            'plural'      => 'Numbers', // optional
			            'overrides'   => array(),    // optional
			            'text_domain' => ''          // optional
			        ),
					'args'      => array(
						// 'labels'            => $this->populate_labels('Service', 'Services'),
						'hierarchical'      => false,
						'public'            => true,
						'show_ui'           => true,
						'show_admin_column' => true,
						'show_in_nav_menus' => true,
						'show_tagcloud'     => true,
						'rewrite'           => array(
							'slug'            => 'numbers'
						),
					),
					'post_types' => array( 'post', 'team', 'portfolio' ),
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
			add_action( 'init', array( $this, 'add_test_page') );
			add_action( 'init', array( $this, 'register_post_types' ) );
			add_action( 'init', array( $this, 'register_taxonomies' ) );

		}

		public function register_post_types() {
			// BytesPostsTaxonomies::new_register_custom_post_types( $this->format_post_type );
		}
		public function register_taxonomies() {
			BytesPostsTaxonomies::new_register_taxonomies( $this->test_taxonomies );
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