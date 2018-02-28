<?php

function thim_child_enqueue_styles()
	{

	// Enqueue parent style

	wp_enqueue_style('thim-parent-style', get_template_directory_uri() . '/style.css');
	}

add_action('wp_enqueue_scripts', 'thim_child_enqueue_styles', 100);

// Hide the "Please update now" notification
function hide_update_notice() {
    get_currentuserinfo();
    if (!current_user_can('manage_options')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_notices', 'hide_update_notice', 1 );
