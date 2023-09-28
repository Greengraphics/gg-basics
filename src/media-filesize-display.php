<?php
/*
Plugin Name: Media Filesize Display
Description: Display the filesize of media files in the media library and add sorting by filesize.
Version: 1.0
Author: Nathan
*/

// Function to populate _wp_attachment_filesize meta key
function populate_attachment_filesizes() {
    $attachments = get_posts(array(
        'post_type' => 'attachment',
        'numberposts' => -1,
    ));

    foreach ($attachments as $attachment) {
        calculate_attachment_filesize( $attachment->ID );
    }
}

function calculate_attachment_filesize( $ID ) {

    $file_path = get_attached_file($ID);
    if ( ! $file_path || ! file_exists( $file_path ) ) {
        return;
    }

    $file_size = filesize($file_path);
    if ($file_size !== false) {
        // Convert bytes to kilobytes and store in the _wp_attachment_filesize meta key
        $key = '_wp_attachment_filesize';
        return update_post_meta($ID, $key, round($file_size / 1024, 2));
    }

    return;
}
add_action('edit_attachment', 'calculate_attachment_filesize');
add_action('attachment_updated', 'calculate_attachment_filesize');

// Function to recalculate file size when postmeta is updated
function recalculate_file_size_on_postmeta_update($meta_id, $object_id, $meta_key, $_meta_value) {
    if ($meta_key !== '_wp_attachment_filesize') {
        calculate_attachment_filesize( $object_id );
    }
}
add_action('updated_postmeta', 'recalculate_file_size_on_postmeta_update', 10, 4);

// Sort media by size
function sort_media_by_size($query) {
    global $pagenow;

    if (is_admin() && $pagenow === 'upload.php' && $query->is_main_query() && isset($_GET['orderby']) && $_GET['orderby'] === 'size') {
        $query->set('meta_key', '_wp_attachment_filesize');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'sort_media_by_size');

// Add size column to media library
function add_size_column($columns) {
    $columns['size'] = 'File Size (KB)';
    return $columns;
}
add_filter('manage_media_columns', 'add_size_column');

function display_size_column($column_name, $attachment_id) {
    if ($column_name == 'size') {
        $file_size_in_kb = get_post_meta($attachment_id, '_wp_attachment_filesize', true);

        if ($file_size_in_kb !== '') {
            echo esc_html($file_size_in_kb) . ' KB';
        } else {
            echo 'N/A';
        }
    }
}
add_action('manage_media_custom_column', 'display_size_column', 10, 2);

// Make the size column sortable
function make_size_column_sortable($columns) {
    $columns['size'] = 'size';
    return $columns;
}
add_filter('manage_upload_sortable_columns', 'make_size_column_sortable');
