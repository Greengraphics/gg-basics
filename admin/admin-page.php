<?php


/**
 * Add the settings page to backend.
 *
 * @return void
 */
function gg_add_admin_menu() { 
	add_submenu_page( 'options-general.php', 'GreenGraphics', 'GreenGraphics Settings', 'manage_options', 'gg-settings', 'gg_options_page', 99 );
}
add_action( 'admin_menu', 'gg_add_admin_menu' );


/**
 * Add settings page link in plugin actions.
 *
 * @param array $actions
 * @return array
 */
function gg_plugin_action_links( $actions ) {
   $actions[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=gg-settings') ) .'">Settings</a>';
   return $actions;
}
add_filter( 'plugin_action_links_gg-basics/gg-basics.php', 'gg_plugin_action_links' );


/**
 * Render backend page.
 *
 * @return void
 */
function gg_options_page() { 
	include_once( __DIR__ . '/admin.php');
}

function gg_admin_scripts(){
    $current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';

    // Check if you are on a specific admin page and enqueue scripts accordingly.
    if ($current_page !== 'gg-settings') {
		return;
	}

	$plugin_url  = plugin_dir_url( __FILE__ );

	wp_enqueue_script('react-settings-page-menu-options',
		$plugin_url . '/build/index.js',
		array('wp-element', 'wp-api-fetch'),
		'1.00',
		true);

}
add_action( 'admin_enqueue_scripts', 'gg_admin_scripts' );
