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
	?>
	<div class="wrap">
		<form action='options.php' method='post'>

			<h1><?php echo get_admin_page_title(); ?> Settings</h1>

			<?php
			settings_fields( 'gg_settings_group' );
			do_settings_sections( 'gg_settings_group' );
			submit_button();
			?>

		</form>
	</div>
	<?php
}


/**
 * Register backend settings.
 *
 * @return void
 */
function gg_settings_init() { 

    // Init settings.
	register_setting( 'gg_settings_group', 'gg_settings' );

    // Add section.
	add_settings_section(
		'gg_section', 
		__( '<i class="dashicons-before dashicons-admin-appearance"></i> Settings section', 'gg' ), 
		'gg_settings_section_callback', 
		'gg_settings_group'
	);

    // Add a section field.
	add_settings_field( 
		'gg_chk_themes', 
		__( 'Themes', 'gg' ), 
		'gg_chk_themes_render', 
		'gg_settings_group', 
		'gg_section' 
	);

}
add_action( 'admin_init', 'gg_settings_init' );


function gg_chk_themes_render(  ) { 

	$options = get_option( 'gg_settings' );
	if ( isset ( $options['gg_chk_themes'] ) ) { 
        $ggOptions = $options['gg_chk_themes'];
	} else { 
        $ggOptions = 0; 
    };
	?>

	<input type='checkbox' name='gg_settings[gg_chk_themes]' <?php checked( $ggOptions ); ?> value="1">
	<?php
}


function gg_settings_section_callback() {
	echo __( 'Description about the <strong>settings section</strong>', 'gg' );
}
