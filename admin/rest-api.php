<?php

add_action( 'rest_api_init', 'rest_api_register_route');


/*
 * Add custom routes to the Rest API
 */
function rest_api_register_route(){

	//Add the GET 'react-settings-page/v1/options' endpoint to the Rest API
	register_rest_route(
		'react-settings-page/v1', '/options', array(
			'methods'  => 'GET',
			'callback' => 'rest_api_react_settings_page_read_options_callback',
			'permission_callback' => '__return_true'
		)
	);


}

/*
 * Callback for the GET 'react-settings-page/v1/options' endpoint of the Rest API
 */
function rest_api_react_settings_page_read_options_callback( $data ) {

	//Check the capability
	if (!current_user_can('manage_options')) {
		return new WP_Error(
			'rest_read_error',
			'Sorry, you are not allowed to view the options.',
			array('status' => 403)
		);
	}

	//Generate the response
	$response = [];
	$response['plugin_option_1'] = get_option('plugin_option_1');
	$response['plugin_option_2'] = get_option('plugin_option_2');


	//Prepare the response
	$response = new WP_REST_Response($response);

	return $response;

}


//Add the POST 'react_settings_page/v1/options' endpoint to the Rest API
register_rest_route(
	'react-settings-page/v1', '/options', array(
		'methods'             => 'POST',
		'callback'            => 'rest_api_react_settings_page_update_options_callback',
		'permission_callback' => '__return_true'
	)
);

function rest_api_react_settings_page_update_options_callback( $request ) {

if ( ! current_user_can( 'manage_options' ) ) {
    return new WP_Error(
        'rest_update_error',
        'Sorry, you are not allowed to update the DAEXT UI Test options.',
        array( 'status' => 403 )
    );
}

//Get the data and sanitize
//Note: In a real-world scenario, the sanitization function should be based on the option type.
$plugin_option_1 = sanitize_text_field( $request->get_param( 'plugin_option_1' ) );
$plugin_option_2 = sanitize_text_field( $request->get_param( 'plugin_option_2' ) );

//Update the options
update_option( 'plugin_option_1', $plugin_option_1 );
update_option( 'plugin_option_2', $plugin_option_2 );

$response = new WP_REST_Response( 'Data successfully added.', '200' );

return $response;

}
