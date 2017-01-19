<?php

/**
 * @author Tribalpixel
 */
class TribalpixelCustomDashboard {

    public function __construct() {
        // Run
        self::enableDashboardCleaner();
    }

    private function enableDashboardCleaner() {
        add_action('wp_dashboard_setup', array(&$this, 'disable_default_dashboard_widgets'), 999);
        add_action('wp_dashboard_setup', array(&$this, 'enable_custom_dashboard_widgets'), 999);
    }

    /**
     * Unset default Dashboard metaboxes
     * 
     * @global array $wp_meta_boxes
     */
    function disable_default_dashboard_widgets() {
        global $wp_meta_boxes;
        // wp..
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
        // bbpress
        unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);
        // yoast seo
        unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
        // gravity forms
        unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
    }
    
    function enable_custom_dashboard_widgets() {
        global $wp_meta_boxes;
        //var_dump($wp_meta_boxes['dashboard']);
    }

}
