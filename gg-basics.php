<?php
/**
 * Plugin Name: GG Basics
 * Plugin URI: https://www.greengraphics.com.au/
 * Description: All the good stuff. Hides Wordpress stuff.
 * Author: Greengraphics
 * Author URI: https://www.greengraphics.com.au/
 * Version: 1.0.3
 * Text Domain: gg-basics
 * License: GPL2
 *
 * Copyright 2023 Greengraphics
 * 
 * @package gg
 */

if ( ! defined('ABSPATH')) {
    die;
}

// Backend page for settings.
require_once 'admin/admin-page.php';

// include ('admin/caps.php');
// include ('admin/menus.php');
include ('admin/options.php');
include ('admin/dashboard.php');
