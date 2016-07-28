<?php
/**
 * Template Name: Travaux
 *
 * @package WordPress
 * @subpackage cf-creation2016
 * @since 1.0
 */
?>

<?php get_header(); ?>

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


<style>
    .slideshow { 
        height:140px; 
        overflow: hidden; 
        background: #FFF url('<?php echo get_template_directory_uri(); ?>/img/loading.gif') center center no-repeat;/**/
    } 
    .slideshow .slide {
        display: none;
    }
    .slideshow.slick-initialized {
        background:none;
    }          
    .slideshow.slick-initialized .slide {
        display: block;
    }     
</style>
<div class="row" id="content">

    <div class="small-10 small-centered columns">
        <div id="tags-cloud">
            <?php
            if (is_tax("media_tag") || is_page('travaux')) {
                cfcreation_tag_cloud();
            } else {
                cfcreation_collection_cloud();
            }
            //echo "<hr>". is_tax('collection_tag') . "</hr>";
            //echo "<hr>". is_tax('media_tag') . "</hr>";
            ?>		
        </div>
    </div>

    <div class="small-12 small-centered columns">

        <?php
        $default = get_option('cfcreation_media_tag_default');
        $current_lang = qtranxf_getLanguage();
        
        // Catch tag query if any
        $tag_query = array();
        if (is_tax("media_tag") || is_page('travaux')) {
            if (isset($wp_query->query_vars['term'])) {
                $tag_query = array('media_tag' => $wp_query->query_vars['term']);
            } else {
                if ($default != -1) {
                    $tag_query = array('media_tag' => $default);
                }
            }
        }
        /*
          else {
          if (isset($wp_query->query_vars['term'])) { $tag_query = array('collection_tag' => $wp_query->query_vars['term']); }
          else { $tag_query = array('tax_query' => array('taxonomy' => 'collection_tag')); }
          }
         */

        // Limite  le nb d'image sur la page initiale, illimité pour les tags
        if (is_page()) {
            $limit = 6;
        } else {
            $limit = -1;
        }

        $args = array_merge(array('post_type' => 'attachment', 'posts_per_page' => $limit, 'category' => '11'), $tag_query);
        //var_dump($args);
        $attachments = get_posts($args);
        //var_dump($attachments);
        ?> 
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
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>

</div>

<script>
    jQuery(document).ready(function ($) {
//jQuery(function($) {


        $('.slideshow').slick({
            slidesToShow: 6,
            slidesToScroll: 6,
            prevArrow: "<img class='slick-prev' src='<?php echo get_template_directory_uri(); ?>/img/back.png'>",
            nextArrow: "<img class='slick-next' src='<?php echo get_template_directory_uri(); ?>/img/next.png'>",
            //infinite: true,
            autoplay: true,
            autoplaySpeed: 10000,
            adaptiveHeight: false,
            variableWidth: true,
            dots: false,
            //centered: true,
            //lazyLoad: 'ondemand',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });

        $(".fancybox").fancybox({
            'titlePosition': 'inside',
            'titleFromAlt': true,
            onComplete: function () {
                FB.XFBML.parse();
                //console.log($(this))
            }
        });

    });

</script>



<?php get_footer(); ?>