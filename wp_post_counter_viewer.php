<?php
/*
	Plugin Name: WP Post Counter And Viewer
	Plugin URI: https://salihonder.com.tr/wordpress_post_counter_and_viewer/
	Description: Count, Save, Calculate and View Your Posts View Times In Anywhere
	Version: 1.0.0
	Author: Salih ÖNDER
	Author URI: https://salihonder.com.tr/
	License: MIT
	Text Domain: wppcav
	Domain Path: /languages/
*/


/** Add Menu Page For Plugin Settings
 */
	add_action('admin_menu', 'wppcav_admin_menu_page');
        
    function wppcav_admin_menu_page() {
            add_submenu_page( 'options-general.php', 'Wp Post Counter and Viewer Settings', 'Post Counter & Viewer Settings', 'manage_options', 'wppcav_admin_menu', 'wppcav_admin_menu_frontend' );
        }

	function wppcav_admin_menu_frontend() {

	}

 /** 
* Add Menu Page For Plugin Settings */

/** Plugin Settings
 */
	define('WPPCAV_TEXTDOMAIN','wppcav');
	load_plugin_textdomain( WPPCAV_TEXTDOMAIN , false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
 /** Plugin Settings
* Plugin Settings */

/** Define Functions
 */

	function wppcav_get_post_view() {
		$count = get_post_meta( get_the_ID(), 'post_views_count', true );
		$message = "Not Defined";

		if ($count == NULL || $count == 0) {
			return _e( 'No View', WPPCAV_TEXTDOMAIN);
		}
		else if ($count == 1) {
			return _e( '1 View', WPPCAV_TEXTDOMAIN);
		}
		else {
			$return_message = $count . " " . esc_html__( 'Views', WPPCAV_TEXTDOMAIN);

			return $return_message;
		}
	}
	function wppcav_set_post_view() {
		$key = 'post_views_count';
		$post_id = get_the_ID();
		$count = (int) get_post_meta( $post_id, $key, true );
		$count++;
		update_post_meta( $post_id, $key, $count );
	}
	function wppcav_posts_column_views( $columns ) {
		$columns['post_views'] = 'Views';
		return $columns;
	}
	function wppcav_posts_custom_column_views( $column ) {
		if ( $column === 'post_views') {
			echo wppcav_get_post_view();
		}
	}
	add_filter( 'manage_posts_columns', 'wppcav_posts_column_views' );
	add_action( 'manage_posts_custom_column', 'wppcav_posts_custom_column_views' );
	
	add_shortcode( 'wppcav_set_post_view', 'wppcav_set_post_view' );
	add_shortcode( 'wppcav_get_post_view', 'wppcav_get_post_view' );


 /** 
* Define Functions*/









?>