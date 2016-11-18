<?php
/**
 * Plugin Name: GG-Basics
 * Plugin URI: https://www.greengraphics.com.au/
 * Description: All the good stuff. Hides Wordpress news, allows editors to access menus etc.
 * Author: Step & Nath
 * Author URI: https://www.greengraphics.com.au/
 * Version: 1.0
 * Text Domain: gg-basics
 * License: GPL2
 *
 * Copyright 2016 Greengraphics
 */

if ( __FILE__ == $_SERVER['SCRIPT_FILENAME'] ) { exit; }

include ('admin/caps.php');
include ('admin/menus.php');
include ('admin/options.php');
include ('admin/dashboard.php');



?>