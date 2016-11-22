<?php 
if ( __FILE__ == $_SERVER['SCRIPT_FILENAME'] ) { exit; }

// Custom Dashboard Stuff

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Welcome', 'custom_dashboard_help');
}

function custom_dashboard_help() {

	echo '<h2>';
	bloginfo('name');
	echo '</h2>';
	echo '<p style=font-size:1.4em;">Please use any of the menu items to your left.</p><p style=font-size:1.4em;">And click Dashboard anytime you want to come back here.</p><p style=font-size:1.4em;"><p style=font-size:1.4em;">Make sure you keep your <a href="http://www.browsehappy.com/" target="_blank">browser up-to-date</a>.</p><div style="clear:both"></div>';
}


	// disable default dashboard widgets
function disable_default_dashboard_widgets() {
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

// remove wordpress version type
remove_action('wp_head', 'wp_generator');

function change_footer_version() {
	$theme_name = bloginfo('name');
  return $theme_name;
}
add_filter( 'update_footer', 'change_footer_version', 9999 );

function remove_footer_admin () {
  echo 'Site made proudly by Greengraphics.';
}
add_filter('admin_footer_text', 'remove_footer_admin');


/**
 * hide TML pages from sub-Admins!
 */
add_filter('parse_query', 'exclude_pages_from_dash');
function exclude_pages_from_dash($query)
{
    global $wpdb, $pagenow, $post_type;

    if (!is_admin()) {
        return;
    }

    if (// On Pages view AND not Admin
        !current_user_can('nothingadministrator') &&
        $pagenow == 'edit.php' &&
        $post_type == 'page'
    ) {
        $query_str = "
            SELECT $wpdb->posts.ID
            FROM $wpdb->posts, $wpdb->postmeta
            WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
            AND $wpdb->postmeta.meta_key = '_tml_action'
        ";
        $pages = $wpdb->get_results($query_str, ARRAY_A);
        $pages = wp_list_pluck($pages, 'ID');

        $query->query_vars['post__not_in'] = $pages;
    }
}


?>
