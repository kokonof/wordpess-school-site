<?php
/*
Plugin Name: cocojambo
Description: Description
Version: 0.0.1
Author: Volkov Grisha
Requires PHP: 7.4
Text Domain: cocojambo
Domain Path: /languages/
Tags: cocojambo
Text Domain: cocojambo
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'COCOJAMBO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once 'autoload.php';

function activationPlugin() {
	if ( PHP_MAJOR_VERSION < 7 ) {
		die( __( 'Need PHP >= 7', 'cocojambo' ) );
	}

	global $wpdb;
	$query = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}test`
				(
				    `id` INT NOT NULL AUTO_INCREMENT ,
					 `name` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)
    			) ENGINE = InnoDB;";
	$wpdb->query( $query );

	cocojambo_add_post_type();
	flush_rewrite_rules();
}

function deactivationPlugin() {
	file_put_contents( COCOJAMBO_PLUGIN_DIR . 'log.txt', __( "Plugin Deactivated\n" ), FILE_APPEND );
}

register_activation_hook( __FILE__, 'activationPlugin' );
register_deactivation_hook( __FILE__, 'deactivationPlugin' );
add_action( 'plugins_loaded', 'loaded_textdomain' );
add_action( 'admin_menu', 'cocojambo_admin_pages' );
add_action( 'wp_enqueue_scripts', 'cocojambo_scripts_front' );
add_action( 'admin_enqueue_scripts', 'cocojambo_scripts_admin' );
add_action( 'admin_init', 'cocojambo_add_settings' );
add_action( 'init', 'cocojambo_add_post_type' );

add_filter('template_include', 'cocojambo_get_theme_template');
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'cocojambo_add_plugin_links');

add_shortcode('cocojambo_code', 'cocojambo_code');

function cocojambo_code($attr) {
	$attr = shortcode_atts([
		'tag' => 'h3',
		'class' => 'btn btn-primary'
	], $attr);
	$tag = esc_html($attr['tag']);
	$class = esc_html($attr['class']);
	return " <{$tag} class='{$class}'> Shortcode!!!</{$tag}>";
}

function cocojambo_add_plugin_links( $links ) {
var_dump($links);
	$newLinks = [
		'<a href="'. admin_url('admin.php?page=add_prefix_to_post') .'"> '. __('Settings','cocojambo') .'</a>',
	];

	return array_merge($links, $newLinks);
}

function cocojambo_get_theme_template( $template ) {
	var_dump(get_template_directory());
	if (is_singular('book')) {
		if (!file_exists(get_template_directory() . '/single-book.php')){
			return COCOJAMBO_PLUGIN_DIR . 'templates/public/single-book.php';
		}
	}

	if (is_post_type_archive('book')) {
		if (!file_exists(get_template_directory() . '/archive-book.php')){
			return COCOJAMBO_PLUGIN_DIR . 'templates/public/archive-book.php';
		}
	}

	if (is_tax('genre')) {
		if (!file_exists(get_template_directory() . '/taxonomy-genre.php')){
			return COCOJAMBO_PLUGIN_DIR . 'templates/public/taxonomy-genre.php';
		}
	}

	return $template;
}

function cocojambo_add_post_type() {

	register_taxonomy('genre', 'book', [
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rewrite' =>[
			'slug' => 'books/genre',
		],
		'labels' => [
			'name'                        => __( 'Genres', 'cocojambo' ),
			'singular_name'               => __( 'Genre', 'cocojambo' ),
			'all_items'                   => __( 'All Genres' , 'cocojambo'),
			'edit_item'                   => __( 'Edit Genres', 'cocojambo' ),
			'update_item'                 => __( 'Update Genres', 'cocojambo' ),
			'add_new_item'                => __( 'Add New Genres' , 'cocojambo'),
			'new_item_name'               => __( 'New Genres Name' , 'cocojambo'),
			'add_or_remove_items'         => __( 'Add or remove Genres', 'cocojambo' ),
			'menu_name'                   => __( 'Genres' , 'cocojambo'),
		]
	]);
	register_post_type('book', [
		'label' => __('Books', 'cocojambo'),
		'public' => true,
		'supports' => [
			'title',
			'editor',
			'thumbnail'
		],
		'has_archive' => true,
		'rewrite' => [
			'slug' => 'books'
		],
		'show_in_rest' => true
	]);
}


function cocojambo_add_settings() {
	register_setting( 'cocojambo_main_group', 'cocojambo_main_email' );
	register_setting( 'cocojambo_main_group', 'cocojambo_main_name' );

	add_settings_section(
		'cocojambo_main_first',
		__( 'Main Section One', 'cocojambo' ),
		function () {
			echo '<p>' . __( 'Main Section Description', 'cocojambo' ) . ' </p>';},
		'add-prefix-to-post-title' );

	add_settings_section(
		'cocojambo_main_second',
		__( 'Main Section Second', 'cocojambo' ),
		'',
		'add-prefix-to-post-title' );

	add_settings_field(
		'cocojambo_main_email',
		__('Email', 'cocojambo'),
		'main_email_field',
		'add-prefix-to-post-title',
		'cocojambo_main_first',
		['label_for' => 'cocojambo_main_email']
	);

	add_settings_field(
		'cocojambo_main_name',
		__('Name', 'cocojambo'),
		'main_name_field',
		'add-prefix-to-post-title',
		'cocojambo_main_second',
		['label_for' => 'cocojambo_main_name']
	);
}

function main_email_field() {
	echo '<input 
	name="cocojambo_main_email" 
	id="cocojambo_main_email" 
	type="text" 
	value="' . esc_attr(get_option('cocojambo_main_email')) . '"
	class="regular-text code" />';
}

function main_name_field() {
	echo '<input 
	name="cocojambo_main_name" 
	id="cocojambo_main_name" 
	type="time" 
	value="' . esc_attr(get_option('cocojambo_main_name')) . '"
	class="regular-text code" />';
}

function loaded_textdomain() {
	load_plugin_textdomain( 'cocojambo' );
}

function cocojambo_admin_pages() {

}

function cocojambo_scripts_front() {
	wp_enqueue_style( 'cocojambo-public', plugins_url( '/assets/public/public.css', __FILE__ ), 20 );
	wp_enqueue_script( 'cocojambo-public', plugins_url( '/assets/public/public.js', __FILE__ ), [ 'jquery' ], false, true );
}

function cocojambo_scripts_admin( $hook_suffix ) {
	if ( ! in_array( $hook_suffix, [
		'toplevel_page_add-prefix-to-post-title',
		'toplevel_page_add-prefix-to-post'
	] ) ) {
		return;
	}
	wp_enqueue_style( 'cocojambo-admin', plugins_url( '/assets/admin/admin.css', __FILE__ ) );
	wp_enqueue_script( 'cocojambo-admin', plugins_url( '/assets/admin/admin.js', __FILE__ ) );
}


$cocojambo_study = new CocojamboStudy();
$cocojambo_study->convertTitle();
$cocojambo_study->addPrefixToPostTitle();

$cocojambo_menu = new CocojamboLeftMenu();
