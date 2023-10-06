<?php
/**
 * Plugin Name: GG Basics
 * Plugin URI: https://www.greengraphics.com.au/
 * Description: All the good stuff. Hides Wordpress stuff.
 * Author: Greengraphics
 * Author URI: https://www.greengraphics.com.au/
 * Version: 1.0.4
 * Text Domain: gg-basics
 * License: GPL2
 *
 * Update URI: https://github.com/Greengraphics/gg-basics
 * download_url: https://github.com/Greengraphics/gg-basics
 * 
 * Copyright 2023 Greengraphics
 * 
 * @package gg
 */

if ( ! defined('ABSPATH')) {
    die;
}

require_once __DIR__ . '/vendor/autoload.php';

// Plugin updates.
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/Greengraphics/gg-basics',
	__FILE__,
	'gg-basics'
);

// Backend page for settings.
require_once 'admin/admin-page.php';

// Email related functionality.
require_once 'admin/emails.php';

// Revision related functionality.
require_once 'admin/revisions.php';

// include ('admin/caps.php');
// include ('admin/menus.php');
include ('admin/options.php');

// API for our settings.
include ('admin/rest-api.php');
include ('admin/dashboard.php');

// Need to add something to enable/disable.
$flag = true;
if ( $flag ) {
	require_once 'src/media-filesize-display.php';
	
	// Register activation hook
	register_activation_hook(__FILE__, 'populate_attachment_filesizes');
}
