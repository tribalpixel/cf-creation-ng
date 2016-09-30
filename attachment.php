<?php

/**
 * Change de default WPSEO <meta property="og:title" />
 * 
 * @param srting $title
 * @return string
 */
function cfcreation_FB_attachments_title($title) {
    $current_lang = qtranxf_getLanguage();
    $title_fr = 'Retrouvez toutes mes autres créations sur mon site web';
    $title_en = 'Find all my other creations on my website';
    $fb_title = ($current_lang === 'en') ? $title_en : $title_fr;
    return $fb_title;
}

add_filter('wpseo_opengraph_title', 'cfcreation_FB_attachments_title', 999);

/**
 * Change de default WPSEO <meta property="og:description" />
 * 
 * @param srting $desc
 * @return string
 */
function cfcreation_FB_attachments_desc($desc) {
    $current_lang = qtranxf_getLanguage();
    $show_tags = cfcreation_show_tags(get_the_ID(), $current_lang, true);
    $hashtags = array_map('cfcreation_add_hashtag_to_string', $show_tags);
    return implode(', ', $hashtags);
}

add_filter('wpseo_opengraph_desc', 'cfcreation_FB_attachments_desc', 999);

function cfcreation_FB_attachments_dimension() {
    // Retrieve attachment metadata.
    $metadata = wp_get_attachment_metadata();
    $w = '<meta property="og:image:width" content="'.$metadata['width'].'" />'."\r\n";
    $l = '<meta property="og:image:height" content="'.$metadata['height'].'" />'."\r\n";
    echo $w.$l;
}

add_action('wp_head', 'cfcreation_FB_attachments_dimension',1);

/**
 * 
 * @param string $string
 * @return string
 */
function cfcreation_add_hashtag_to_string($string) {
    return '#' . $string;
}
?>
<?php get_header(); ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="row align-center">
    <?php echo wp_get_attachment_image(get_the_ID(), 'large'); ?>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>