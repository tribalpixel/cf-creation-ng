<?php
// cfcng = Christel Falconnier Creation New Generation
// http://code.tutsplus.com/articles/applying-categories-tags-and-custom-taxonomies-to-media-attachments--wp-32319
// ajouter recherche par tag dans admin medias
// ajouter col sorting par tag dans admin medias
// http://wordpress.stackexchange.com/questions/29858/adding-category-tag-taxonomy-support-to-images-media
// http://wordpress.stackexchange.com/questions/76720/how-to-use-taxonomies-on-attachments-with-the-new-media-library
// use #qtransLangSwLM?type=AL&title=none&colon=hidden&current=hidden for custom language switcher in menu

define('CFCNG_DEBUG', false);

/*******************************************************************************
 *  REGISTER CUSTOM TAXONOMY FOR MEDIAS
 *******************************************************************************/
function cfcreation_media_tags() {

    $rewrite = array(
        //'slug' => __('travaux','tax_slug','cfcreation'),
        'with_front' => true,
        'hierarchical' => false,
    );
    $args = array(
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => $rewrite,
        'update_count_callback' => '_update_generic_term_count',
    );
    register_taxonomy('media_tag', array('attachment'), $args);
}

add_action('init', 'cfcreation_media_tags', 0);

/*******************************************************************************
 *  ADD SORTABLE CUSTOM TAG COLUMN TO MEDIA ADMIN PAGE
 *******************************************************************************/
// Register the column as sortable & sort by name
function cfreation_media_tag_column_sortable( $cols ) {
    $cols["taxonomy-media_tag"] = "name";
    return $cols;
}

// Hook actions to admin_init
function cfcreation_media_tag_columns() {
    add_filter( 'manage_upload_sortable_columns', 'cfreation_media_tag_column_sortable' );
}
add_action( 'admin_init', 'cfcreation_media_tag_columns' );

/*******************************************************************************
 *  ADD ADMIN SETTINGS FOR CUSTOM TAG CLOUD
 *******************************************************************************/
// in plugin will be better or not ?

/*******************************************************************************
 *  CUSTOM TAG CLOUD, BASED ON wp_tag_cloud()
 *******************************************************************************/
function cfcreation_tag_cloud($args = '') {
    
    $tax = get_terms('media_tag');
    $inactif = array();
    foreach ($tax as $tag) {
        $tag_options = maybe_unserialize($tag->description);
        if( $tag_options['group'] === 'inactif' ) {
           $inactif[] = $tag->term_id; 
        }
    }
    $exclude = implode($inactif);
    $args = array(
        'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 45,
        'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
        'exclude' => $exclude, 'include' => '', 'link' => 'view', 'taxonomy' => 'media_tag', 'post_type' => '', 'echo' => true, 'hide_empty' => false
    );

    return wp_tag_cloud($args);
}

/*******************************************************************************
 *  ADD SCRIPTS AND EXTRA LIBRARIES
 *  http://codex.wordpress.org/Function_Reference/wp_enqueue_script  
 *******************************************************************************/
function cfcreation_load_styles() {

    // get theme version
    $my_theme = wp_get_theme();

    // load foundation stylesheet
    wp_enqueue_style('cf-creation-normalize', get_stylesheet_directory_uri() . '/css/normalize.css', false, $my_theme->Version, 'all');
    wp_enqueue_style('cf-creation-foundation', get_stylesheet_directory_uri() . '/css/foundation.min.css', false, $my_theme->Version, 'all');

    // load extras stylesheet
    wp_enqueue_style('cf-creation-font', 'http://fonts.googleapis.com/css?family=Josefin+Slab:400,600', false, $my_theme->Version, 'all');

    // load our main stylesheet.
    wp_enqueue_style('cf-creation-styles', get_stylesheet_uri(), false, $my_theme->Version, 'all');
    
    // load jQuery
    wp_enqueue_script('jquery'); 

}
add_action('wp_enqueue_scripts', 'cfcreation_load_styles');

/*******************************************************************************
 *  REGISTER MENUS
 *  http://generatewp.com/nav-menus/  
 *******************************************************************************/
if (!function_exists('cfcreation_navigation_menus')) {

    // Register Navigation Menus
    function cfcreation_navigation_menus() {
        $locations = array(
            'header_menu' => 'Custom Header Menu',
            'footer_menu' => 'Custom Footer Menu',
        );

        register_nav_menus($locations);
    }

    // Hook into the 'init' action
    add_action('init', 'cfcreation_navigation_menus');
}

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
    return get_bloginfo('name');;
}
add_filter( 'login_headertitle', 'cfcreation_login_logo_url_title' );

/*******************************************************************************
 *  THEME CUSTOMIZER
 *******************************************************************************/

/**
 * Add Options for the Theme Customizer.
 */
function cfcreation_customize_register($wp_customize) {

    // remove default section
    $wp_customize->remove_section('static_front_page');
    $wp_customize->remove_section('nav');

    /* INFOS SECTION */
    // add section options
    $wp_customize->add_section('cfcreation_infos_section', array(
        'title' => 'Extra infos',
        'priority' => 30,
    ));

    // add settings
    $wp_customize->add_setting('cfcreation_name', array('default' => 'Christel Falconnier',));
    $wp_customize->add_setting('cfcreation_infos1', array('default' => 'Avenue de Rumine 40',));
    $wp_customize->add_setting('cfcreation_infos2', array('default' => 'CH-1005 Lausannne',));
    $wp_customize->add_setting('cfcreation_tel', array('default' => '+41 21 601 41 02',));
    $wp_customize->add_setting('cfcreation_mobile', array('default' => '+41 79 503 07 48',));
    $wp_customize->add_setting('cfcreation_email', array('default' => 'cf-creation@bluewin.ch',));

    // add text field for name
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_name_control', array(
        'label' => 'Nom',
        'section' => 'cfcreation_infos_section',
        'settings' => 'cfcreation_name',
        'priority' => 11,
    )));

    // add text field for info1 & info2
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_infos1_control', array(
        'label' => 'Adresse 1',
        'section' => 'cfcreation_infos_section',
        'settings' => 'cfcreation_infos1',
        'priority' => 12,
    )));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_infos2_control', array(
        'label' => 'Adresse 2',
        'section' => 'cfcreation_infos_section',
        'settings' => 'cfcreation_infos2',
        'priority' => 13,
    )));

    // add text field for tel & mobile
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_tel_control', array(
        'label' => 'T&eacute;l&eacute;phone',
        'section' => 'cfcreation_infos_section',
        'settings' => 'cfcreation_tel',
        'priority' => 14,
    )));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_mobile_control', array(
        'label' => 'Mobile',
        'section' => 'cfcreation_infos_section',
        'settings' => 'cfcreation_mobile',
        'priority' => 15,
    )));

    // add text field for email
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_email_control', array(
        'label' => 'E-mail',
        'section' => 'cfcreation_infos_section',
        'settings' => 'cfcreation_email',
        'priority' => 16,
    )));

    /* FACEBOOK SECTION */
    // add section options
    $wp_customize->add_section('cfcreation_fb_section', array(
        'title' => 'Facebook',
        'priority' => 30,
    ));

    // add settings
    $wp_customize->add_setting('cfcreation_fb_settings', array('default' => '',));
    $wp_customize->add_setting('cfcreation_fb_footer', array('default' => 0,));

    // add text field for URL
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_fb_control', array(
        'label' => 'URL de la page Faceboook',
        'section' => 'cfcreation_fb_section',
        'settings' => 'cfcreation_fb_settings',
    )));

    // add checkbox option to show fb widget
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_fb_hidden', array(
        'label' => 'montrer le boutton dans le pied de page',
        'type' => 'checkbox',
        'section' => 'cfcreation_fb_section',
        'settings' => 'cfcreation_fb_footer',
    )));

    /* HOME NEWS & SLIDESHOW SECTION */
    // add section options
    $wp_customize->add_section('cfcreation_slideshow_section', array(
        'title' => 'Page d\'accueil',
        'priority' => 20,
    ));

    //echo '<pre>'; print_r($wp_customize); echo '</pre>';
}
add_action('customize_register', 'cfcreation_customize_register');

/**
 * Add custom palette for admin theme
 * not used for the moment, need to generate admin-style.css with scss
 */
function cfcreation_custom_admin_color_palette() {
  wp_admin_css_color(
    'cfcreation-colors',
    __('CF-Création'),
    get_stylesheet_directory_uri() . '/admin-style.css',
    array('#222222', '#333333', '#feba03', '#ff5c00')
  );
}
//add_action('admin_init', 'cfcreation_custom_admin_color_palette');
 
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