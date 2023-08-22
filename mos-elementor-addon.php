<?php
/**
 * Plugin Name: Mos Elementor Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Md. Mostak Shahid
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addon
 */

function register_hello_world_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/hello-world-widget-1.php' );
	require_once( __DIR__ . '/widgets/hello-world-widget-2.php' );
	require_once( __DIR__ . '/widgets/Post_GRID.php' );
	require_once( __DIR__ . '/includes/Classes/Helper.php' );

	$widgets_manager->register( new \Mos_Elementor_Addons\Widgets\Elementor_Hello_World_Widget_1() );
	$widgets_manager->register( new \Mos_Elementor_Addons\Widgets\Elementor_Hello_World_Widget_2() );
	$widgets_manager->register( new \Mos_Elementor_Addons\Widgets\Post_GRID() );

}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );


$taxonomies     = get_taxonomies( [], 'objects' );
//var_dump($taxonomies);