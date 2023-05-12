<?php
/**
 * Plugin Name: GG Basics
 * Plugin URI: https://www.greengraphics.com.au/
 * Description: All the good stuff. Hides Wordpress stuff.
 * Author: Greengraphics
 * Author URI: https://www.greengraphics.com.au/
 * Version: 1.0.2
 * Text Domain: gg-basics
 * License: GPL2
 *
 * Copyright 2023 Greengraphics
 */

if ( ! defined('ABSPATH')) {
    die;
}

// include ('admin/caps.php');
// include ('admin/menus.php');
include ('admin/options.php');
include ('admin/dashboard.php');
