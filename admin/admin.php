<?php

if ( ! current_user_can('manage_options' ) ) {
    wp_die('You do not have sufficient capabilities to view this page.');
}

?>

<h1>GG admin page.</h1>

<div class="wrap">

    <div id="react-app">Admin settings</div>

</div>
