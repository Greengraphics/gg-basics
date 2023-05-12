<?php

/**
 * Disable auto update emails.
 */
$ggOptions = get_option('gg_settings');
if ( isset($ggOptions['gg_chk_auto_emails']) ) {   

    add_filter('auto_core_update_send_email', '__return_false');
    
    // Disable auto update plugin emails.
    add_filter('auto_plugin_update_send_email', '__return_false');
    
    // Disable auto update theme emails.
    add_filter('auto_theme_update_send_email', '__return_false');
}


/**
 * Add email settings to backend.
 */
function gg_settings_email_init() {

    // Add section.
	add_settings_section(
		'gg_section_emails', 
		__( '<i class="dashicons-before dashicons-email"></i> Emails', 'gg' ), 
		false, 
		'gg_settings_group'
	);

    // Add a section field.
	add_settings_field( 
		'gg_chk_auto_emails', 
		__( 'Disable Auto Update Emails', 'gg' ), 
		'gg_chk_auto_emails_render', 
		'gg_settings_group', 
		'gg_section_emails' 
	);

}
add_action( 'admin_init', 'gg_settings_email_init' );


function gg_chk_auto_emails_render() {

	$options = get_option( 'gg_settings' );
	if ( isset ( $options['gg_chk_auto_emails'] ) ) { 
        $ggOptions = $options['gg_chk_auto_emails'];
	} else { 
        $ggOptions = 0; 
    };
	?>

    
    <input type='checkbox' name='gg_settings[gg_chk_auto_emails]' <?php checked( $ggOptions ); ?> value=1>

    <?php
}
