<?php if(!defined('ABSPATH')) { die(); } // Include in all php files, to prevent direct execution

if( !class_exists( 'BytesPostsTaxonomies' ) ) {

	class BytesPostsTaxonomies {
		private static $version = '0.1.0';
		private static $_this;


		public static function register_custom_post_types( $post_types ) {
			if( is_array( $post_types ) ) {

				foreach( $post_types as $post_key => $post_data ) {
					$args = array();
					if( !empty( $post_data['args'] ) ) {
						$args = $post_data['args'];
						if( !empty($post_data[ 'singular' ]) && !empty($post_data[ 'plural' ]) ) {
							
							$singular_name  = $post_data[ 'singular' ];
							$plural_name    = $post_data[ 'plural' ];	
							$args['labels'] = self::populate_post_labels( $singular_name, $plural_name );
							// var_dump($args['labels']);
							register_post_type( $post_key, $args );
						}	
					}
				}
			} 
		}

		public static function register_taxonomies( $taxonomies ) {
			if( is_array( $taxonomies ) ) {

				foreach ( $taxonomies as $taxonomy_key => $taxonomy_data ) {
					$args = array();
					if ( ! empty( $taxonomy_data['args'] ) ) {
						$args = $taxonomy_data['args'];
						if( !empty( $taxonomy_data[ 'singular' ] ) && !empty( $taxonomy_data[ 'plural' ] ) ) {
							
							$singular_name    = $taxonomy_data[ 'singular' ];
							$plural_name      = $taxonomy_data[ 'plural' ];	
							$args[ 'labels' ] = self::populate_tax_labels( $singular_name, $plural_name );

							var_dump($args['labels']);
							
							register_taxonomy( $taxonomy_key, $taxonomy_data['post_types'], $args );
						}
					}
				}
			} 
		}	


		public static function new_register_taxonomies( $taxonomies ) {

		}


		public static function new_register_custom_post_types( $post_types ) {
			if( !is_array( $post_types ) ) {
				return;
			} 

			foreach( $post_types as $post_key => $post_data ) {
				// var_dump($post_data);
				$args   = array();
				$labels = array();
				if( empty( $post_data['args'] ) || empty( $post_data['labels'] ) ) {
					continue;		
				}
				$args   = $post_data['args'];
				$labels = $post_data['labels'];

				if( empty($labels['singular']) ) {
					continue;
				}
				$args['label'] = $labels['singular'];
				
				$labels = shortcode_atts( array(
					'singular'  => '',
					'plural'    => $labels['singular'] . 's',
					'overrides' => array(), 
					'textdomain' => ''
				), $labels );


				$args['labels'] = self::populate_post_labels( $labels['singular'], $labels['plural'], $labels['overrides'], $labels['textdomain'] );

				var_dump($args['labels']);
				
				register_post_type( $post_key, $args );		
			}
		}

		public static function new_register_custom_post_types( $post_types ) {
		    if( !is_array( $post_types ) ) {
		        return;
		    }
		    foreach( $post_types as $post_key => $post_data ) {
		        $args   = array();
		        $labels = array();
		        if( empty( $post_data['args'] ) || empty( $post_data[ 'labels' ] ) ) {
		            continue;
		        }
		        $args   = $post_data['args'];
		        $labels = $post_data['labels'];
		        if( empty($labels['singular']) ) {
		            continue;
		        }
		        $args['label'] = $labels['singular'];
		        $labels = shortcode_atts( array(
		            'singular'    => '',
		            'plural'      => $labels['singular'] . 's',
		            'overrides'   => array(),
		            'text_domain' => ''
		        ), $labels );
		        $args['labels'] = call_user_func_array( array( 'MyClassName', 'populate_post_labels' ), array_values( $labels ) );
		        register_post_type( $post_key, $args );
		    }
		}


		

		private static function populate_tax_labels( $singular, $plural, $overrides = array(), $text_domain = "" ) {
			return shortcode_atts( array(
				'name'                       => _x( $plural, 'Taxonomy General Name', $text_domain ),
				'singular_name'              => _x( $singular, 'Taxonomy Singular Name', $text_domain ),
				'menu_name'                  => __( $plural, $text_domain ),
				'all_items'                  => __( 'All '. $plural, $text_domain ),
				'parent_item'                => __( 'Parent ' . $singular, $text_domain ),
				'parent_item_colon'          => __( 'Parent ' . $singular . ':', $text_domain ),
				'new_item_name'              => __( 'New ' . $singular . ' Name', $text_domain ),
				'add_new_item'               => __( 'Add New ' . $singular, $text_domain ),
				'edit_item'                  => __( 'Edit ' . $singular, $text_domain ),
				'update_item'                => __( 'Update ' . $singular, $text_domain ),
				'view_item'                  => __( 'View ' . $singular, $text_domain ),
				'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas', $text_domain ),
				'add_or_remove_items'        => __( 'Add or remove ' . $plural, $text_domain ),
				'choose_from_most_used'      => __( 'Choose from the most used', $text_domain ),
				'popular_items'              => __( 'Popular ' . $plural, $text_domain ),
				'search_items'               => __( 'Search ' . $plural, $text_domain ),
				'not_found'                  => __( 'Not Found', $text_domain ),
				'no_terms'                   => __( 'No ' . $plural, $text_domain ),
				'items_list'                 => __( $plural . ' list', $text_domain ),
				'items_list_navigation'      => __( $plural . ' list navigation', $text_domain ),
			), $overrides );
		}


		private static function populate_post_labels( $singular, $plural, $overrides = array(), $text_domain = "" ) {
			return shortcode_atts( array(
				'name'                  => _x( $plural, 'Post Type General Name', $text_domain ),
				'singular_name'         => _x( $singular, 'Post Type Singular Name', $text_domain ),
				'menu_name'             => __( $plural, $text_domain ),
				'name_admin_bar'        => __( $singular, $text_domain ),
				'archives'              => __( $singular . ' Archives', $text_domain ),
				'attributes'            => __( $singular . ' Attributes', $text_domain ),
				'parent_item_colon'     => __( 'Parent ' . $singular . ':', $text_domain ),
				'all_items'             => __( 'All ' . $plural, $text_domain ),
				'add_new_item'          => __( 'Add New ' . $singular, $text_domain ),
				'add_new'               => __( 'Add New', $text_domain ),
				'new_item'              => __( 'New ' . $singular, $text_domain ),
				'edit_item'             => __( 'Edit ' . $singular, $text_domain ),
				'update_item'           => __( 'Update ' . $singular, $text_domain ),
				'view_item'             => __( 'View ' . $singular, $text_domain ),
				'view_items'            => __( 'View ' . $plural, $text_domain ),
				'search_items'          => __( 'Search ' . $plural, $text_domain ),
				'not_found'             => __( 'Not found', $text_domain ),
				'not_found_in_trash'    => __( 'Not found in Trash', $text_domain ),
				'featured_image'        => __( 'Featured Image', $text_domain ),
				'set_featured_image'    => __( 'Set featured image', $text_domain ),
				'remove_featured_image' => __( 'Remove featured image', $text_domain ),
				'use_featured_image'    => __( 'Use as featured image', $text_domain ),
				'insert_into_item'      => __( 'Insert into ' . $singular, $text_domain ),
				'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular, $text_domain ),
				'items_list'            => __( $plural . ' list', $text_domain ),
				'items_list_navigation' => __( $plural . ' list navigation', $text_domain ),
				'filter_items_list'     => __( 'Filter ' . $singular . ' list', $text_domain ),
			) , $overrides );
		}
	} 
} 