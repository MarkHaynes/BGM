<?php

// Register Style
function custom_styles() {

	wp_register_style( 'style-normalize', 'get_template_directory_uri()/css/normalize.css', false, false, 'all' );
	wp_enqueue_style( 'style-normalize' );

	wp_register_style( 'style-main', 'get_template_directory_uri()/style.css', false, false );
	wp_enqueue_style( 'style-main' );

}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'custom_styles' );

?>