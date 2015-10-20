<?php
// cfcng = Christel Falconnier Creation New Generation
// http://code.tutsplus.com/articles/applying-categories-tags-and-custom-taxonomies-to-media-attachments--wp-32319
// ajouter recherche par tag dans admin medias
// ajouter col sorting par tag dans admin medias
// 

/**
 *  Add categories to Medias Attachments
 */
function cfcng_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
//add_action( 'init' , 'cfcng_add_categories_to_attachments' );

// apply tags to attachments
function cfcng_add_tags_to_attachments() {
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'cfcng_add_tags_to_attachments' );



/*******************************************************************************
 *  ADD SCRIPTS AND EXTRA LIBRARIES
 *  http://codex.wordpress.org/Function_Reference/wp_enqueue_script  
 *******************************************************************************/
function cfcreation_load_styles() {

    // get theme version
    $my_theme = wp_get_theme();

    // load foundation stylesheet
    //wp_enqueue_style('cf-creation-normalize', get_stylesheet_directory_uri() . '/css/normalize.css', false, $my_theme->Version, 'all');
    //wp_enqueue_style('cf-creation-foundation', get_stylesheet_directory_uri() . '/css/foundation.min.css', false, $my_theme->Version, 'all');

    // load extras stylesheet
    wp_enqueue_style('cf-creation-font', 'http://fonts.googleapis.com/css?family=Josefin+Slab:400,600', false, $my_theme->Version, 'all');

    // load our main stylesheet.
    wp_enqueue_style('cf-creation-styles', get_stylesheet_uri(), false, $my_theme->Version, 'all');
}
add_action('wp_enqueue_scripts', 'cfcreation_load_styles');

/*******************************************************************************
 *  CUSTOM LOGIN PAGE
 *******************************************************************************/

/** Enqueues scripts and styles to change default login page */
function cfcreation_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'cfcreation_login_stylesheet' );

/** change url link on logo */
function cfcreation_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'cfcreation_login_logo_url' );

/** change title on logo link */
function cfcreation_login_logo_url_title() {
    return "CF-Création";
}
add_filter( 'login_headertitle', 'cfcreation_login_logo_url_title' );

/*******************************************************************************
 *  CUSTOM THEME ADMIN
 *******************************************************************************/

/* Plugin Name: Link Manager
 * Description: Enables the Link Manager that existed in WordPress until version 3.5.
 * Author: WordPress
 * Version: 0.1-beta
 * See http://core.trac.wordpress.org/ticket/21307
 */
add_filter('pre_option_link_manager_enabled', '__return_true');

/*************************************************************************
 * ADD EDITOR CAPABILITY -> MANAGE THEME
 *************************************************************************/
add_action('admin_init', 'cfcreation_allow_editor');
function cfcreation_allow_editor() {
    $role = get_role('editor'); // pick up role to edit the editor role   
    $role->add_cap('edit_theme_options'); // Let them manage our theme
}

/*************************************************************************
 * SECURITY & ANTI-HACK & CLEANING WP TRICKS 
 *************************************************************************/

// Remove fucking emoji nobody use
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove version of wordpress in head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'qtranxf_wp_head_meta_generator');

// Remove editor in wordpress admin
define('DISALLOW_FILE_EDIT', true);