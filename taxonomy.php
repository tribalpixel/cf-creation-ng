<?php
/**
 * Template Name: Travaux
 *
 * @package WordPress
 * @subpackage cf-creation-ng
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<link rel='stylesheet' id='cf-creation-slick-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/slick/slick.css' type='text/css' media='all' />
<link rel='stylesheet' id='cf-creation-slick-theme-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/slick/slick-theme.css' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/slick/slick.js'></script>

<div class="row" id="content">

    <div class="small-12 columns">
        <div id='tags-cloud'>
            <?php
            // show tag cloud
            cfcreation_tag_cloud();
            ?>		
        </div>
    </div>

    <div class="small-12 columns slideshow">
        <?php
        $tag_query = array();
        if (isset($wp_query->query_vars['term'])) {
            $tag_query = array('media_tag' => $wp_query->query_vars['term']);
        }
        $args = array_merge(array('post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' => 'any'), $tag_query);
        $attachments = get_posts($args);
        if ($attachments) {
            foreach ($attachments as $attachment) {
                var_dump($attachment);
                $attachment_tags = get_the_terms($attachment->ID, 'media_tag');
                $show_tags_array = array();
                $show_special_tags_array = array();
                if ($attachment_tags) {
                    foreach ($attachment_tags as $tag) {
                        //var_dump($tag);
                        if ('en-stock' == $tag->slug || 'nouveaute' == $tag->slug) {
                            $show_special_tags_array[] = '<span class="success label">' . $tag->name . '</span>';
                        } else {
                            $show_tags_array[] = '<span class="label">' . $tag->name . '</span>';
                        }
                    }
                    //var_dump($show_tags_array);
                    $show_tags = implode(', ', $show_tags_array);
                    $show_special_tags = implode(', ', $show_special_tags_array);
                }
                //$img_url = urlencode(wp_get_attachment_url($attachment->ID)); 
                $img_url = urlencode('http://www.cf-creation.ch/wp-content/gallery/travaux/2014_09_mg_4496.jpg'); 
                $btn_fb = '<a class="label btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$img_url.'&amp;title='.$attachment->post_name.'">partager sur facebook</a>';
                echo '<div>';
                echo '<a href="' . wp_get_attachment_url($attachment->ID) . '" rel="gallery">';
                echo wp_get_attachment_image($attachment->ID, 'thumbnail', false, array(
                    'alt' => $btn_fb . '<div class="fancy-desc">' . $show_tags . '<div class="fancy-desc-right"> ' . $show_special_tags . ' </div></div>',
                    'title' => strip_tags($show_tags),
                ));
                echo '</a>';
                echo '</div>';
                //echo "<pre>"; print_r($attachment); echo "</pre>";
            }
        }
        /**/
        ?>

    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $('.slideshow').slick({
            slidesToShow: 6,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 10000,
            adaptiveHeight: true,
            dots: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
</script>

<?php get_footer(); ?>