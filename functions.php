<?php

/*
TO FIX:
    ** ADD: Make tags/collection tags searchable in admin media
    ** ADD: Facebook posts on homepage via plugin
    ** SUPPORT: Tribalpixel Facebook Page plugin, theme use shortcodes
    ** FIX: Add image format for FB sharing (525x275, need to test)

Version: 0.2.5
    ADD: display tags work/collection in swipebox
    FIX: CSS for mobile
    
Version: 0.2.4
    ADD: attachment.php custom FB og:meta for share/like in fancybox
    
Version: 0.2.3
    UPDATE: show info in header responsive order changed (client request)

Version: 0.2.2
    UPDATE: added Swipebox support on mobile device
    
Version: 0.2.1
    ONLINE THEME september 2016

Version: 0.2.0
    UPDATE: Rewrite all Css with Sass reformatted html for flex boxes => better code and responsive
    ADD: Option in theme for change animations of modal boxes
    ADD: credits to tribalpixel in footer
    FIX: Loading of images for slideshow

Version: 0.1.9b
    UPDATE: Foundation FROM 6.2.3 (standard grid) To 6.2.3 (full + flex grid)
    FIX: Responsive CSS, fixes for typo sizes
    ADD: Animation on post loading (foundation motion-ui/toggle)
 
Version: 0.1.9
    UPDATE: Foundation FROM 6.1.2 TO 6.2.3 (standard grid)

Version: 0.1.8
    BUG-FIX: When tag is default, tag_cloud item is not active/highligted
    UPDATE: When default tag/collection is set in admin, it's reflect now in Gallerie landing page
    FIX: Slideshow bug when looping picture $('.slideshow').slick({params})
    FIX: Check all popup pages

Version: 0.1.7
    UPDATE: slick.js FROM 1.5.9 TO 1.6.0
    ** ADD: Facebook posts on homepage via plugin
    ** SUPPORT: Tribalpixel Facebook Page plugin, theme use shortcodes

Version: 0.1.6
    FIX: Pages Work/Collections now act with same pattern -> options in admin
    FIX: Show collections tag on lightbox
    ADD: Show count of images linked with tags/collection in admin

Version: 0.1.5
    ADD: Filigranne automatique sur chaque images -> EasyWatermark plugin
    FIX: Remove featured image from theme, not used anymore, image placed directly in content
    ADD: Default tag options for tag cloud -> works/collections
    ADD: Settings page for collections

Version: 0.1.4
    FIX: Limited homepage posts to 1 category
    FIX: translated tags in picture popup
    ** ADD: Make tags/collection tags searchable in admin media

Version: 0.1.3
    ADD: Collections in page, use custom attachment taxonomy
    FIX: qTranslate config.json for extra taxonomy
    FIX: custom class for menu when in works/collections
 */

define('CFCNG_DEBUG', false);

define("CUSTOM_COLOR_1", "#7b7b7b");  // gris logo
define("CUSTOM_COLOR_2", "#EEEEEE");  // light grey
define("CUSTOM_COLOR_3", "#444444");  // dark grey
define("CUSTOM_COLOR_4", "#0ea7be");  // bleu
define("CUSTOM_COLOR_5", "#001eff");  // bleu 2
define("CUSTOM_COLOR_6", "#a3be0e");  // vert pomme
define("CUSTOM_COLOR_7", "#00e49a");  // vert turquoise 
define("CUSTOM_COLOR_8", "#56b892");  // vert clair
define("CUSTOM_COLOR_9", "#feba03");  // jaune
define("CUSTOM_COLOR_10", "#ff5c00");  // orange
define("CUSTOM_COLOR_11", "#8a4100");  // brun
define("CUSTOM_COLOR_12", "#8f04a0");  // violet
define("CUSTOM_COLOR_13", "#ff5781");  // rose

define("MENU_CONTACT_EN", "Contact");
define("MENU_FILM_EN", "Animation Film");
define("MENU_BIO_EN", "Biography");
define("MENU_PRESSE_EN", "Press");
define("MENU_LIENS_EN", "Links");

$color_array_options = array('-', CUSTOM_COLOR_4, CUSTOM_COLOR_5, CUSTOM_COLOR_6, CUSTOM_COLOR_7, CUSTOM_COLOR_8, CUSTOM_COLOR_9, CUSTOM_COLOR_10, CUSTOM_COLOR_11, CUSTOM_COLOR_12, CUSTOM_COLOR_13);

/* -----------------------------------------------------------------------------
 * THEME FEATURES
 * ----------------------------------------------------------------------------- */
if (!function_exists('cfcreation_theme_features')) {

    // Register Theme Features
    function cfcreation_theme_features() {

        // Add theme support for Post Formats
        add_theme_support('post-formats', array('quote', 'gallery', 'video'));

        // add post-formats to post_type 'page'
        //add_post_type_support('page', 'post-formats');
        add_theme_support('post-thumbnails');
        //add_image_size('bio-thumb', 460, 250, true);
        //add_image_size('presse-thumb', 250, 250, true);
        //add_image_size('full-page', 970, 250, true);
        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');
    }

    add_action('after_setup_theme', 'cfcreation_theme_features');
}


/* -----------------------------------------------------------------------------
 * REGISTER CUSTOM TAXONOMY FOR MEDIAS
 * ----------------------------------------------------------------------------- */
/* slug is made by qTranslate slug plugin */

function cfcreation_media_tags() {

    $labels = array(
        'name' => _x('Tags', 'Taxonomy General Name', 'cfcreation'),
        'singular_name' => _x('Tag', 'Taxonomy Singular Name', 'cfcreation'),
        'menu_name' => __('Tags', 'cfcreation'),
    );

    $rewrite = array(
        //'slug' => __('travaux','tax_slug','cfcreation'),
        'with_front' => true,
        'hierarchical' => false,
    );
    $args = array(
        'labels' => $labels,
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

function cfcreation_collection_tags() {
    $labels = array(
        'name' => _x('Collections', 'Taxonomy General Name', 'cfcreation'),
        'singular_name' => _x('Collection', 'Taxonomy Singular Name', 'cfcreation'),
        'menu_name' => __('Collections', 'cfcreation'),
    );
    $rewrite = array(
        //'slug' => __('travaux','tax_slug','cfcreation'),
        'with_front' => true,
        'hierarchical' => false,
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => $rewrite,
        'update_count_callback' => '_update_generic_term_count',
    );
    register_taxonomy('collection_tag', array('attachment'), $args);
}

add_action('init', 'cfcreation_collection_tags', 0);

/* -----------------------------------------------------------------------------
 * REGISTER CATEGORIES FOR MEDIAS
 * ----------------------------------------------------------------------------- */

function cfcreation_register_taxonomy_for_images() {
    register_taxonomy_for_object_type('category', 'attachment');
}

add_action('init', 'cfcreation_register_taxonomy_for_images');

/* -----------------------------------------------------------------------------
 * ADD CATEGORIES FILTER FOR MEDIAS
 * ----------------------------------------------------------------------------- */

function cfcreation_add_image_category_filter() {
    $screen = get_current_screen();
    if ('upload' == $screen->id) {
        $dropdown_options = array('show_option_all' => __('View all categories'), 'hide_empty' => false, 'hierarchical' => true, 'orderby' => 'name',);
        wp_dropdown_categories($dropdown_options);
    }
}

add_action('restrict_manage_posts', 'cfcreation_add_image_category_filter');

/* -----------------------------------------------------------------------------
 * ADD SORTABLE CUSTOM TAG COLUMN TO MEDIA ADMIN PAGE
 * ----------------------------------------------------------------------------- */

// Register the column as sortable & sort by name
function cfcreation_media_tag_column_sortable($cols) {
    $cols["taxonomy-media_tag"] = "name";
    // $cols["taxonomy-collection_tag"] = "name";
    return $cols;
}

// Hook actions to admin_init
function cfcreation_media_tag_columns() {
    add_filter('manage_upload_sortable_columns', 'cfcreation_media_tag_column_sortable');
}

add_action('admin_init', 'cfcreation_media_tag_columns');

/* -----------------------------------------------------------------------------
 * ADD ADMIN SETTINGS FOR CUSTOM TAG CLOUD
 * ----------------------------------------------------------------------------- */

require_once 'class-admin-tag-cloud.php';

$tagOptions = new adminTagCloud();
$tagOptions->setTaxonomy('media_tag')->setTitle('Tags');

$collectionOptions = new adminTagCloud();
$collectionOptions->setTaxonomy('collection_tag')->setTitle('Collections');

/* -----------------------------------------------------------------------------
 * CUSTOM TAG CLOUD, BASED ON wp_tag_cloud()
 * ----------------------------------------------------------------------------- */

function cfcreation_tag_cloud($taxonomy = "media_tag") {

    $tax = get_terms($taxonomy);
    $inactif = array();
    foreach ($tax as $tag) {
        $tag_options = get_option("cfcreation_{$taxonomy}_" . $tag->term_id);
        if ($tag_options['group'] === 'inactif' || $tag_options['group'] === '') {
            $inactif[] = $tag->term_id;
        }
    }

    $exclude = implode(',', $inactif);
    $args = array(
        'smallest' => 1, 'largest' => 2, 'unit' => 'em', 'number' => 999,
        'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
        'exclude' => $exclude, 'include' => '', 'link' => 'view', 'taxonomy' => $taxonomy, 'echo' => 1, 'hide_empty' => 1
    );
    return wp_tag_cloud($args);
}

/* -----------------------------------------------------------------------------
 * ADD CUSTOM CLASS TO TAGS LINK IN wp_tag_cloud()
 * ----------------------------------------------------------------------------- */

function cfcreation_tag_cloud_custom_class($tags_data) {

    global $color_array_options;
    $body_class = get_body_class();
    $default_active = NULL;
    foreach ($tags_data as $key => $tag) {
        if (is_page('travaux') || is_tax('media_tag')) {
            $tag_option = get_option('cfcreation_media_tag_' . $tag['id']);
            if (is_page()) {
                $default_active = get_option('cfcreation_media_tag_default');
            }
        } else {
            $tag_option = get_option('cfcreation_collection_tag_' . $tag['id']);
            if (is_page()) {
                $default_active = get_option('cfcreation_collection_tag_default');
            }
        }
        $color = array_search($tag_option['color'], $color_array_options);
        if (in_array('term-' . $tag['id'], $body_class) || $tag['slug'] == $default_active) {
            $tags_data[$key]['class'] = $tags_data[$key]['class'] . " tag-color-" . $color . " active-tag";
        }
    }
    //var_dump($tags_data );
    return $tags_data;
}

add_filter('wp_generate_tag_cloud_data', 'cfcreation_tag_cloud_custom_class');

/* -----------------------------------------------------------------------------
 * ADD DYNAMIC CSS TO HTML <head> FOR THE wp_tag_cloud()
 * ----------------------------------------------------------------------------- */

function cfcreation_add_custom_colors() {

    global $color_array_options;

    echo '<style type="text/css" media="screen">' . "\n";
    foreach ($color_array_options as $k => $v) {
        if ($k !== 0) {
            echo ".tags-cloud a.tag-color-{$k} { color:{$v}; }\n";
        }
    }
    echo '</style>' . "\n";
}

add_action('wp_head', 'cfcreation_add_custom_colors');

/**
 * Make HTML Markup for tags Work/Collection in fancybox
 * 
 * @param int $attachmentID
 * @param string $current_lang
 * @param boolean $returnArray
 * @return string
 */
function cfcreation_show_tags($attachmentID, $current_lang, $returnArray = false) {

    $attachment_tags = get_the_terms($attachmentID, 'media_tag');
    $attachment_tags_collection = get_the_terms($attachmentID, 'collection_tag');

    $show_tags_array = array();
    $show_special_tags_array = array();

    if ($attachment_tags) {
        foreach ($attachment_tags as $tag) {
            if ('en-stock' == $tag->slug || 'nouveaute' == $tag->slug) {
                $show_special_tags_array[] = '<span class="success label radius">' . qtranxf_use($current_lang, $tag->name, false) . '</span>';
            } else {
                $show_tags_array[] = '<span class="secondary label radius">' . qtranxf_use($current_lang, $tag->name, false) . '</span>';
            }
        }
    }
    if ($attachment_tags_collection) {
        foreach ($attachment_tags_collection as $tag_collection) {
            if ('en-stock' == $tag_collection->slug || 'nouveaute' == $tag_collection->slug) {
                $show_special_tags_array[] = '<span class="success label radius">' . qtranxf_use($current_lang, $tag_collection->name, false) . '</span>';
            } else {
                $show_tags_array[] = '<span class="label radius">' . qtranxf_use($current_lang, $tag_collection->name, false) . '</span>';
            }
        }
    }

    $show_all_tags_array = array_merge($show_tags_array, $show_special_tags_array);
    $show_tags = implode(' ', $show_all_tags_array);
    
    if($returnArray) {
        return  array_map('strip_tags',$show_all_tags_array);
    }
    return $show_tags;
}
/**
 * Make HTML Markup for tags Work/Collection in swipebox
 * 
 * @param int $attachmentID
 * @param string $current_lang
 * @return string
 */
function cfcreation_show_tags_mobile($attachmentID, $current_lang) {
    $attachment_tags = get_the_terms($attachmentID, 'media_tag');
    $attachment_tags_collection = get_the_terms($attachmentID, 'collection_tag');
    $show_tags_array = array();
    $show_collection_tags_array = array();
    $travaux = ($current_lang == 'fr') ? 'Travaux:' : 'Works:';
    $collection = ($current_lang == 'fr') ? 'Collection:' : 'Collection:';
    if ($attachment_tags) {
        $show_tags_array[] = '<div>'.$travaux;
        foreach ($attachment_tags as $tag) {
            $show_tags_array[] = '#' . qtranxf_use($current_lang, $tag->name, false);
        }
        $show_tags_array[] = '</div>';
    }
    if ($attachment_tags_collection) {
        $show_collection_tags_array[] = '<div>'.$collection;
        foreach ($attachment_tags_collection as $tag_collection) {
            $show_collection_tags_array[] = '#' . qtranxf_use($current_lang, $tag_collection->name, false);
        }
        $show_collection_tags_array[] = '</div>';
    }
    
    return implode(' ',array_merge($show_tags_array, $show_collection_tags_array));
    
}
/* -----------------------------------------------------------------------------
 * ADD SCRIPTS AND EXTRA LIBRARIES
 * http://codex.wordpress.org/Function_Reference/wp_enqueue_script  
 * ----------------------------------------------------------------------------- */

function cfcreation_load_styles() {

    // get theme infos
    $my_theme = wp_get_theme();

    // load foundation stylesheet
    wp_enqueue_style('cf-creation-normalize', get_stylesheet_directory_uri() . '/css/normalize.css', array(), $my_theme->Version, 'all');
    wp_enqueue_style('cf-creation-foundation', get_stylesheet_directory_uri() . '/css/foundation.min.css', array(), $my_theme->Version, 'all');

    // load fonts
    wp_enqueue_style('cf-creation-font', 'http://fonts.googleapis.com/css?family=Josefin+Slab:400,600', array(), $my_theme->Version, 'all');

    // load our main stylesheet.
    wp_enqueue_style('cf-creation-styles', get_stylesheet_uri(), array(), $my_theme->Version, 'all');

    // load JS
    wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'cfcreation_load_styles');

/**
 * Add js script for images gallery in classical browser
 */
function cfcreation_slideshow_js(){
?>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/slick/slick.js'></script>
<script>
    jQuery(document).ready(function ($) {

        $('.slideshow').slick({
            slidesToShow: 6,
            slidesToScroll: 6,
            prevArrow: "<img class='slick-prev' src='<?php echo get_template_directory_uri(); ?>/img/back.png'>",
            nextArrow: "<img class='slick-next' src='<?php echo get_template_directory_uri(); ?>/img/next.png'>",
            infinite: false,
            autoplay: true,
            autoplaySpeed: 10000,
            dots: false,
            lazyLoad: 'progressive',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });

        <?php if(wp_is_mobile()) : ?> 
        $(".fancybox").swipebox({
            removeBarsOnMobile: false
        }); 
        <?php else: ?>
        $(".fancybox").fancybox({
            'titlePosition': 'inside',
            'titleFromAlt': true,
            onComplete: function () {
                FB.XFBML.parse();
            }
        });
        <?php endif; ?>
    });
</script>
<?php
}


/* -----------------------------------------------------------------------------
 * REGISTER MENUS
 * http://generatewp.com/nav-menus/  
 * ----------------------------------------------------------------------------- */
if (!function_exists('cfcreation_navigation_menus')) {

    // Register Navigation Menus
    function cfcreation_navigation_menus() {
        $locations = array(
            'header_menu' => 'Custom Header Menu',
                //'footer_menu' => 'Custom Footer Menu',
        );

        register_nav_menus($locations);
    }

    // Hook into the 'init' action
    add_action('init', 'cfcreation_navigation_menus');
}

/* -----------------------------------------------------------------------------
 * ADD CLASS TO SPECIFIC MENU
 * ----------------------------------------------------------------------------- */

function cfcreation_nav_class($classes, $item) {
    // use id of menu
    if (is_tax('media_tag')) {
        if (in_array('menu-item-52', $classes)) {
            $classes[] = 'current-menu-item ';
        }
    }
    if (is_tax('collection_tag')) {
        if (in_array('menu-item-582', $classes)) {
            $classes[] = 'current-menu-item ';
        }
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'cfcreation_nav_class', 10, 2);

/* -----------------------------------------------------------------------------
 * HOMEPAGE LIMIT POST TO 1 CATEGORY
 * ----------------------------------------------------------------------------- */

function cfcreation_home_page_pots($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_home) {
            $query->set('cat', get_cat_ID('Homepage'));
        }
    }
}

add_action('pre_get_posts', 'cfcreation_home_page_pots');

/* -----------------------------------------------------------------------------
 * CUSTOM LOGIN PAGE
 * ----------------------------------------------------------------------------- */

/** Enqueues scripts and styles to change default login page */
function cfcreation_login_stylesheet() {
    wp_enqueue_style('custom-login', get_template_directory_uri() . '/css/style-login.css');
}

add_action('login_enqueue_scripts', 'cfcreation_login_stylesheet');

/** change url link on logo */
function cfcreation_login_logo_url() {
    return home_url();
}

add_filter('login_headerurl', 'cfcreation_login_logo_url');

/** change title on logo link */
function cfcreation_login_logo_url_title() {
    return get_bloginfo('name');
}

add_filter('login_headertitle', 'cfcreation_login_logo_url_title');

/* -----------------------------------------------------------------------------
 * THEME CUSTOMIZER
 * ----------------------------------------------------------------------------- */

/**
 * Add Options for the Theme Customizer.
 */
function cfcreation_customize_register($wp_customize) {
       
    // remove default section
    $wp_customize->remove_section('static_front_page');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('nav');

    /* INFOS SECTION */
    // add section options
    $wp_customize->add_section('cfcreation_infos_section', array(
        'title' => 'Extra infos',
        'priority' => 30,
    ));

    // add settings
    $wp_customize->add_setting('cfcreation_name', array('default' => 'Christel Falconnier'));
    $wp_customize->add_setting('cfcreation_infos1', array('default' => 'Avenue de Rumine 40'));
    $wp_customize->add_setting('cfcreation_infos2', array('default' => 'CH-1005 Lausannne'));
    $wp_customize->add_setting('cfcreation_tel', array('default' => '+41 21 601 41 02'));
    $wp_customize->add_setting('cfcreation_mobile', array('default' => '+41 79 503 07 48'));
    $wp_customize->add_setting('cfcreation_email', array('default' => 'cf-creation@bluewin.ch'));

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
    $wp_customize->add_setting('cfcreation_fb_settings', array('default' => ''));
    $wp_customize->add_setting('cfcreation_fb_footer', array('default' => 0));

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

    /* MODAL ANIMATION SECTION */
    // add section options
    $wp_customize->add_section('cfcreation_modal_section', array(
        'title' => 'Modal Animations',
        'priority' => 40,
    ));
    // add settings
    $wp_customize->add_setting('cfcreation_modal_in', array('default' => 'fade-in'));
    $wp_customize->add_setting('cfcreation_modal_out', array('default' => 'fade-out'));
    $wp_customize->add_setting('cfcreation_modal_in_page', array('default' => 'fade-in'));
    // add select field for animation IN
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_modal_in_control', array(
        'label' => 'Animation IN',
        'section' => 'cfcreation_modal_section',
        'settings' => 'cfcreation_modal_in',
        'type' => 'select',
        'choices' => array (
            'fade-in'           => 'Fade In', 
            'slide-in-down'     => 'Slide In Down', 
            'slide-in-up'       => 'Slide In Up', 
            'slide-in-right'    => 'Slide In Right', 
            'slide-in-left'     => 'Slide In Left',
            'hinge-in-from-middle-x'     => 'Hinge In X',
            'hinge-in-from-middle-y'     => 'Hinge In Y'
        )
    )));   
    // add select field for animation OUT
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_modal_out_control', array(
        'label' => 'Animation OUT',
        'section' => 'cfcreation_modal_section',
        'settings' => 'cfcreation_modal_out',
        'type' => 'select',
        'choices' => array (
            'fade-in'           => 'Fade Out', 
            'slide-out-down'    => 'Slide Out Down', 
            'slide-out-up'      => 'Slide Out Up', 
            'slide-out-right'   => 'Slide Out Right', 
            'slide-out-left'    => 'Slide Out Left',
            'hinge-out-from-middle-x'     => 'Hinge Out X',
            'hinge-out-from-middle-y'     => 'Hinge Out Y'            
        )        
    )));      
    // add select field for animation IN PAGE (POSTS/PAGE)
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cfcreation_modal_in_page_control', array(
        'label' => 'Animation Page (Posts/Page)',
        'section' => 'cfcreation_modal_section',
        'settings' => 'cfcreation_modal_in_page',
        'type' => 'select',
        'choices' => array (
            'fade-in'           => 'Fade In', 
            'hinge-in-from-middle-x'    => 'Hinge In X',
            'hinge-in-from-middle-y'    => 'Hinge In Y',
            'hinge-in-from-top'         => 'Hinge In From Top',
            'hinge-in-from-bottom'      => 'Hinge From Bottom',
        )
    )));     
}

add_action('customize_register', 'cfcreation_customize_register');

/**
 * Add custom palette for admin theme
 * not used for the moment, need to generate admin-style.css with scss
 */
function cfcreation_custom_admin_color_palette() {
    wp_admin_css_color(
            'cfcreation-colors', __('CF-Création'), get_stylesheet_directory_uri() . '/admin-style.css', array('#222222', '#333333', '#feba03', '#ff5c00')
    );
}

//add_action('admin_init', 'cfcreation_custom_admin_color_palette');

/* -----------------------------------------------------------------------------
 * ADMIN UI TWEAKS
 * ----------------------------------------------------------------------------- */
// show link manager to WP
add_filter('pre_option_link_manager_enabled', '__return_true');

// Remove unwanted menu
// !!! only remove menu from admin UI, but page is still reachable by url
function cfcreation_remove_menus() {
    remove_menu_page('edit-comments.php');    // Comments
}

add_action('admin_menu', 'cfcreation_remove_menus');

// Modifying TinyMCE editor to remove unused items.
function cfcreation_custom_tiny_mce($init) {
    $init['block_formats'] = 'Paragraph=p;Header 3=h3;Header 4=h4;Header 5=h5;Header 6=h6';
    return $init;
}

add_filter('tiny_mce_before_init', 'cfcreation_custom_tiny_mce');

/* -----------------------------------------------------------------------------
 * ADD EDITOR CAPABILITY -> MANAGE THEME
 * ----------------------------------------------------------------------------- */
add_action('admin_init', 'cfcreation_allow_editor');

function cfcreation_allow_editor() {
    $role = get_role('editor'); // pick up role to edit the editor role   
    $role->add_cap('edit_theme_options'); // Let them manage our theme
}

/* -----------------------------------------------------------------------------
 * SECURITY & ANTI-HACK & CLEANING WP TRICKS 
 * ----------------------------------------------------------------------------- */

// Remove fucking emoji nobody use
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Remove version of wordpress in head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'qtranxf_wp_head_meta_generator');

// Remove editor in wordpress admin
define('DISALLOW_FILE_EDIT', true);


/* -----------------------------------------------------------------------------
 * Alter search query in admin medias: JOIN
 * http://stackoverflow.com/questions/20401351/how-to-the-get-the-wordpress-media-search-to-inlcude-tags
 * ----------------------------------------------------------------------------- */

function cfcreation_attachments_join($join, $query) {
    global $wpdb;

    //if we are not on admin or the current search is not on attachment return
    if (!is_admin() || (!isset($query->query['post_type']) || $query->query['post_type'] != 'attachment'))
        return $join;

    //  if current query is the main query and a search...
    if (is_main_query() && is_search()) {
        $join .= "
        LEFT JOIN
        {$wpdb->term_relationships} ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id
        LEFT JOIN
        {$wpdb->term_taxonomy} ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id
        LEFT JOIN
        {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id ";
    }

    return $join;
}

//add_filter( 'posts_join', 'cfcreation_attachments_join', 10, 2 );

/* -----------------------------------------------------------------------------
 * Alter search query in admin medias: WHERE
 * ----------------------------------------------------------------------------- */
function cfcreation_attachments_where($where, $query) {
    global $wpdb;

    //if we are not on admin or the current search is not on attachment return
    if (!is_admin() || (!isset($query->query['post_type']) || $query->query['post_type'] != 'attachment'))
        return $where;

    //  if current query is the main query and a search...
    if (is_main_query() && is_search()) {
        //  explictly search post_tag taxonomies
        $where .= " OR ( 
                        ( {$wpdb->term_taxonomy}.taxonomy IN('media_tag') AND {$wpdb->terms}.name LIKE '%" . esc_sql(get_query_var('s')) . "%' )
                       )";
    }

    return $where;
}

//add_filter( 'posts_where', 'cfcreation_attachments_where', 10, 2 );

/* -----------------------------------------------------------------------------
 * Alter search query in admin: GROUPBY
 * ----------------------------------------------------------------------------- */
function cfcreation_attachments_groupby($groupby, $query) {

    global $wpdb;

    //if we are not on admin or the current search is not on attachment return
    if (!is_admin() || (!isset($query->query['post_type']) || $query->query['post_type'] != 'attachment'))
        return $groupby;

    //  if current query is the main query and a search...
    if (is_main_query() && is_search()) {
        //  assign the GROUPBY
        $groupby = "{$wpdb->posts}.ID";
    }

    return $groupby;
}

//add_filter( 'posts_groupby', 'cfcreation_attachments_groupby', 10, 2 );
