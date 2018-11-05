<?php
/**
 * Pre-load the navigation menu as a JSON object
 *
 * @package Foxhound
 */

/**
 * Class wrapper for menu loading
 */
class TFS_Portal_LoadMenu {
	/**
	 * Set up actions
	 */
	public function __construct() {
		add_filter( 'wp_enqueue_scripts', array( $this, 'print_data' ) );
	}

	/**
	 * Adds the json-string data to the react app script
	 */
	public function print_data() {
		$menu_data = sprintf(
			'var FoxhoundMenu = %s;',
			$this->add_json_data()
		);
		wp_add_inline_script( TFS_PORTAL_APP, $menu_data, 'before' );
	}

	/**
	 * Dumps the current query response as a JSON-encoded string
	 */
	public function add_json_data() {
		return wp_json_encode( array(
			'enabled' => class_exists( 'WP_REST_Menus' ),
			'data' => $this->get_menu_data(),
		) );
	}

	/**
	 * Gets menu data from the JSON API server
	 *
	 * @return array
	 */
	public function get_menu_data() {
		$menu = array();

		$request = new \WP_REST_Request();
		$request['context'] = 'view';
		$request['location'] = 'side-bar-menu';

		if ( class_exists( 'WP_REST_Menus' ) ) {
			$menu_api = new WP_REST_Menus();
			$menu = $menu_api->get_menu_location( $request );
		}

		return $menu;
	}
}
new TFS_Portal_LoadMenu();
