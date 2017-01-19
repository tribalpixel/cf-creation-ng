<?php

/**
 * @author Tribalpixel
 */
class adminTagCloud {

    private $taxonomy;
    private $title;

    public function __construct() {
        //$this->taxonomy = $taxonomy; 
        add_action('admin_menu', array(&$this, 'add_settings_page'));
    }

    public function setTaxonomy($taxonomy) {
        $this->taxonomy = $taxonomy;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function get_attachment_total($term) {
        $args = "posts_per_page=-1&post_status=any&post_type=attachment&{$this->taxonomy}={$term}";
        $count = new WP_Query($args);
        return count($count->get_posts());
    }

    public function add_settings_page() {
        add_media_page(__($this->title), __('Options ' . $this->title ), 'manage_categories', $this->taxonomy . '-settings', array(&$this, 'tag_cloud_settings'));
    }

    public function build_select($select_id, $options_array, $option_type, $selected_value = "-", $color = FALSE) {
        $output = '<select name="update_' . $this->taxonomy . '_group[' . $select_id . '][' . $option_type . ']"';
        if ($selected_value != "-" && $color == TRUE) {
            $output .= ' style="background-color:' . $selected_value . '; color: #FFF;"';
        }
        $output .= '>';
        foreach ($options_array as $option) {
            $output .= '<option value="' . $option . '"';
            if ($option == $selected_value) {
                $output .= ' selected="selected"';
            }
            if ($color) {
                $output .= ' style="background-color:' . $option . ';"';
            }
            $output .= '>' . $option . '</option>';
        }
        $output .= '</select>';

        return $output;
    }

    public function tag_cloud_settings() {

        // verify if something is posted
        if (!empty($_POST) && check_admin_referer("update_{$this->taxonomy}_description", "{$this->taxonomy}_group_nonce")) {
            //echo "<pre>"; print_r($_POST); echo "</pre>";
            // update terms in db
            foreach ($_POST["update_{$this->taxonomy}_group"] as $key => $value) {
                update_option("cfcreation_{$this->taxonomy}_" . $key, $value);
                //wp_update_term($key, '{$this->taxonomy}', array('description' => $value));
            }
            update_option("cfcreation_{$this->taxonomy}_default", $_POST["option_{$this->taxonomy}_default"]);
            update_option("cfcreation_{$this->taxonomy}_cloud", $_POST["option_{$this->taxonomy}_cloud"]);

            echo '<div class="updated">mise &agrave; jour reussie</div>';
        }

        // define array of options 
        $group_array_options = array('inactif', 'actif');
        global $color_array_options;

        // get all terms objects
        $args = array('hide_empty' => false);
        $tax = get_terms($this->taxonomy, $args);

        // if not empty , build form
        if (!empty($tax)) {

            // initalize arrays
            $actif = $inactif = $active_cloud = array();

            foreach ($tax as $tag) {

                // build tags array with group and order
                $options = get_option("cfcreation_{$this->taxonomy}_" . $tag->term_id);

                switch ($options['group']) {

                    case $group_array_options[1]:
                        $actif[] = array(
                            'id' => $tag->term_id,
                            'name' => $tag->name,
                            'slug' => $tag->slug,
                            'select_group' => $this->build_select($tag->term_id, $group_array_options, 'group', 'actif'),
                            'select_color' => $this->build_select($tag->term_id, $color_array_options, 'color', $options['color'], true),
                        );
                        $active_cloud[] = $tag->term_id;
                        break;

                    default:
                        // new tag with no group
                        $inactif[] = array(
                            'id' => $tag->term_id,
                            'name' => $tag->name,
                            'slug' => $tag->slug,
                            'select_group' => $this->build_select($tag->term_id, $group_array_options, 'group'),
                        );
                        break;
                }
            } // end foreach

            $active_cloud_param = implode(',', $active_cloud);
            $default_option_tag = get_option('cfcreation_' . $this->taxonomy . '_default');
        } // end if
        ?>
        <style>
            .inline-list li {
                display: inline-block;
                width: 50%;
            }
        </style>
        <div class="wrap nosubsub">
            <h1><?php _e('Options ' . $this->title); ?></h1>
            <hr />
            <div class="small-10 small-centered columns">
                <div id="tags-cloud">
                    <?php cfcreation_tag_cloud($this->taxonomy); ?>		
                </div>
            </div>
            <hr />
            <div class="right">
                <h2><?php echo _e('Settings'); ?></h2>
                <form method="post" action=""> 
                    <?php
                    echo '<h4>Tag(s) actifs</h4>';
                    echo '<ul class="inline-list">';
                    if (!empty($actif)) {
                        foreach ($actif as $tag_options) {
                            echo '<li><strong>' . ucfirst($tag_options['name']) . ' (' . $this->get_attachment_total($tag_options['slug']) . ') : </strong>' . $tag_options['select_group'] . ' ' . $tag_options['select_color'] . '</li>';
                        }
                    } else {
                        echo '<li>Aucun</li>';
                    }
                    echo '</ul>';

                    echo '<input type="hidden" value="' . $active_cloud_param . '" name="option_' . $this->taxonomy . '_cloud">';
                    echo '<hr />';
                    
                    echo '<h4>Tag actif par defaut</h4>';
                    echo '<select name="option_' . $this->taxonomy . '_default">';
                    echo '<option value="-1">-</option>';
                    foreach ($tax as $tag_object) {
                        //var_dump(in_array($tag_object->id, $active_cloud));
                        if(in_array($tag_object->term_id, $active_cloud)) {
                            echo '<option value="' . $tag_object->slug . '"';
                            if ($default_option_tag == $tag_object->slug) {
                                echo ' selected="selected"';
                            }
                            echo '>' . ucfirst($tag_object->name) . '</option>';
                        }
                    }
                    echo '</select><br style="clear:both;" />';

                    submit_button();

                    echo '<h4>Tag(s) non-utilis&eacute;(s)</h4>';
                    echo '<ul class="inline-list">';
                    foreach ($inactif as $tag_options) {
                        echo '<li><strong>' . ucfirst($tag_options['name']) . ' (' . $this->get_attachment_total($tag_options['slug']) . ') : </strong>' . $tag_options['select_group'] . '</li>';
                        echo '<input type="hidden" value="-" name="update_' . $this->taxonomy . '_group[' . $tag_options['id'] . '][color]">';
                    }
                    echo '</ul>';

                    // add nonce field
                    wp_nonce_field("update_{$this->taxonomy}_description", "{$this->taxonomy}_group_nonce");
                    ?>	
                </form>
            </div>
        </div>
        <?php
    }

//END tag_cloud_settings
}

//END Class
