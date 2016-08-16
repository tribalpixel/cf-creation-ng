<?php
/**
 * Template Name: Collections
 *
 * @package WordPress
 * @subpackage cf-creation2016
 * @since 1.0
 */
?>

<?php
$tax = "collection_tag";
$current_lang = qtranxf_getLanguage();
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

<?php /* FB SDK for share button in faceybox */ ?>
<div id="fb-root"></div>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

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
                    $show_tags = cfcreation_show_tags($attachment->ID, $current_lang);

                    $btn_fb = '<div class="fb-share-button" data-href="' . $img_url . '" data-layout="button"></div>';
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