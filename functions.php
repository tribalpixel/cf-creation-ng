<?php
// cfcng = Christel Falconnier Creation New Generation
// http://code.tutsplus.com/articles/applying-categories-tags-and-custom-taxonomies-to-media-attachments--wp-32319
// ajouter recherche par tag dans admin medias
// ajouter col sorting par tag dans admin medias
// http://wordpress.stackexchange.com/questions/29858/adding-category-tag-taxonomy-support-to-images-media
// http://wordpress.stackexchange.com/questions/76720/how-to-use-taxonomies-on-attachments-with-the-new-media-library


define('CFCNG_DEBUG', false);

/*******************************************************************************
 *  REGISTER CUSTOM TAXONOMY FOR MEDIAS
 *******************************************************************************/
function cfcreation_media_tags() {

	$labels = array(
		'name'                       => _x( 'Travaux', 'Taxonomy General Name', 'cfcreation' ),
		'singular_name'              => _x( 'Travaux', 'Taxonomy Singular Name', 'cfcreation' ),
		'menu_name'                  => __( 'Tags', 'cfcreation' ),
		'all_items'                  => __( 'All Items', 'cfcreation' ),
		'parent_item'                => __( 'Parent Item', 'cfcreation' ),
		'parent_item_colon'          => __( 'Parent Item:', 'cfcreation' ),
		'new_item_name'              => __( 'New Item Name', 'cfcreation' ),
		'add_new_item'               => __( 'Add New Item', 'cfcreation' ),
		'edit_item'                  => __( 'Edit Item', 'cfcreation' ),
		'update_item'                => __( 'Update Item', 'cfcreation' ),
		'view_item'                  => __( 'View Item', 'cfcreation' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'cfcreation' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'cfcreation' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'cfcreation' ),
		'popular_items'              => __( 'Popular Items', 'cfcreation' ),
		'search_items'               => __( 'Search Items', 'cfcreation' ),
		'not_found'                  => __( 'Not Found', 'cfcreation' ),
	);
	$rewrite = array(
		'slug'                       => 'travaux',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		'update_count_callback'      => '_update_generic_term_count',
	);
	register_taxonomy( 'media_tag', array( 'attachment' ), $args );

}
add_action( 'init', 'cfcreation_media_tags', 0 );

/*******************************************************************************
 *  CUSTOM TAG CLOUD, BASED ON wp_tag_cloud()
 *******************************************************************************/
function cfcreation_tag_cloud( $args = '' ) {
    $defaults = array(
        'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 45,
        'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
        'exclude' => '', 'include' => '', 'link' => 'view', 'taxonomy' => 'media_tag', 'post_type' => '', 'echo' => true, 'hide_empty' => false
    );
    $args = wp_parse_args( $args, $defaults );
 
    $tags = get_terms( $args['taxonomy'], array_merge( $args, array( 'orderby' => 'count', 'order' => 'DESC' ) ) ); // Always query top tags
 
    if ( empty( $tags ) || is_wp_error( $tags ) )
        return;
 
    foreach ( $tags as $key => $tag ) {
        $link = get_term_link( intval($tag->term_id), $tag->taxonomy );
        if ( is_wp_error( $link ) )
            return;
 
        $tags[ $key ]->link = $link;
        $tags[ $key ]->id = $tag->term_id;
    }
 
    $return = wp_generate_tag_cloud( $tags, $args ); // Here's where those top tags get sorted according to $args
 
    /**
     * Filter the tag cloud output.
     *
     * @since 2.3.0
     *
     * @param string $return HTML output of the tag cloud.
     * @param array  $args   An array of tag cloud arguments.
     */
    $return = apply_filters( 'wp_tag_cloud', $return, $args );
 
    if ( 'array' == $args['format'] || empty($args['echo']) )
        return $return;
 
    echo $return;
}


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