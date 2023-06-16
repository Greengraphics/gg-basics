<?php

function gg_revisions_num() {
    return 20;
}
add_filter( 'wp_revisions_to_keep', 'gg_revisions_num' );

// add_filter( "wp_{$post->post_type}_revisions_to_keep", $num, $post );
