<?php
/**
 * Template Name: Travaux
 *
 * @package WordPress
 * @subpackage cf-creation2016
 * @since 1.0
 */
?>

<?php
$tax = "media_tag";
$default = get_option("cfcreation_{$tax}_default");

// Catch tag query if any
$tag_query = array();
if (isset($wp_query->query_vars['term'])) {
    $tag_query = array($tax => $wp_query->query_vars['term']);
} else {
    if ($default != -1) {
        $tag_query = array($tax => $default);
    }
}

// Limite  le nb d'image, illimité pour les tags
$limit = -1;

if (is_page()) {
    if ($default != -1) {
        $include_tags = $default;
    } else {
        $collection_tags = get_terms($tax);
        $include = array();
        foreach ($collection_tags as $t) {
            array_push($include, $t->slug);
        }
        $include_tags = implode(', ', $include);
        $limit = 18;
    }
    $tag_query = array($tax => $include_tags);
}
$args = array_merge(array('post_type' => 'attachment', 'posts_per_page' => $limit, 'category' => '11'), $tag_query);
$attachments = get_posts($args);
?> 

<?php get_header(); ?>

<div class="row align-center">

    <div class="small-10 columns">
        <div class="tags-cloud">
            <?php cfcreation_tag_cloud($tax); ?>		
        </div>
    </div>

    <div class="small-12 columns arrows">

        <div class="slideshow">
            <?php
            if ($attachments) {
                foreach ($attachments as $attachment) {

                    $img_url = wp_get_attachment_url($attachment->ID);
                    $img_page = get_permalink($attachment->ID);
                    //var_dump($img['_wp_attached_file']);
                    $show_tags = cfcreation_show_tags($attachment->ID, $current_lang);
                    $btn_fb = '<div class="fb-like" data-href="'.$img_page.'" data-width="250" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>';
                    //$btn_fb = '<div class="fb-share-button" data-href="' . $img_url . '" data-quote="'.strip_tags($show_tags).'" data-layout="button" data-mobile-iframe="true" data-hashtag="#CF-Création"></div>';
                    //$btn_fb = '<div class="fb-like" data-href="' . $img_url . '&title=[title]&description=[description]" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>';
                    //$btn_fb = "";
                    echo '<div class="slide">';
                    echo '<a href="' . wp_get_attachment_url($attachment->ID) . '" rel="gallery" class="image fancybox">';
                    echo wp_get_attachment_image($attachment->ID, 'thumbnail', false, array(
                        'alt' => '<div class="fancy-desc"><div class="fancy-desc-left">' . $show_tags . '</div><div class="fancy-desc-right">' . $btn_fb . '</div></div>',
                        'title' => strip_tags($show_tags),
                        'class' => 'slideshow-img',
                    ));
                    echo '</a>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <hr>
    </div>

</div>

<?php cfcreation_slideshow_js(); ?>

<?php get_footer(); ?>