<?php
/**
 * Template Name: Travaux
 *
 * @package WordPress
 * @subpackage cf-creation2016
 * @since 0.0.1
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

<link rel='stylesheet' id='cf-creation-slick-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/slick/slick.css' type='text/css' media='all' />
<link rel='stylesheet' id='cf-creation-slick-theme-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/slick/slick-theme.css' type='text/css' media='all' />
<link rel='stylesheet' id='cf-creation-fancybox-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.7.min.css' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/slick/slick.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.7.min.js'></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.easing.pack.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.mousewheel.pack.js"></script>

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
            <?php cfcreation_tag_cloud(); ?>		
        </div>
    </div>

    <div class="">

        <div class="slideshow">
            <?php
            $tag_query = array();
            if (isset($wp_query->query_vars['term'])) {
                $tag_query = array('media_tag' => $wp_query->query_vars['term']);
            }
            if (is_page()) {
                $limit = 18;
            } else {
                $limit = -1;
            }
            $args = array_merge(array('post_type' => 'attachment', 'posts_per_page' => $limit, 'tag_ID' => '11'), $tag_query);
            $attachments = get_posts($args);
            if ($attachments) {
                foreach ($attachments as $attachment) {					                   
                    //var_dump($attachment);
                    $attachment_tags = get_the_terms($attachment->ID, 'media_tag');
                    $show_tags_array = array();
                    $show_special_tags_array = array();
                    if ($attachment_tags) {
                        foreach ($attachment_tags as $tag) {

                            if ('en-stock' == $tag->slug || 'nouveaute' == $tag->slug) {
                                $show_special_tags_array[] = '<span class="success label radius">' . $tag->name . '</span>';
                            } else {
                                $show_tags_array[] = '<span class="label radius">' . $tag->name . '</span>';
                            }
                        }
                        $show_all_tags_array = array_merge($show_tags_array, $show_special_tags_array);

                        $show_tags = implode(', ', $show_all_tags_array);
                    }
                    $img_url = urlencode(wp_get_attachment_url($attachment->ID));
                    $btn_fb = '<div class="fb-share-button" data-href="' . $img_url . '" data-layout="button"></div>';
                    echo '<div class="slide">';
                    echo '<a href="' . wp_get_attachment_url($attachment->ID) . '" rel="gallery" class="image fancybox">';
                    echo wp_get_attachment_image($attachment->ID, 'thumbnail', false, array(
                        'alt' => '<div class="fancy-desc"><div class="fancy-desc-left">' . $show_tags . '</div><div class="fancy-desc-right">' . $btn_fb . '</div></div>',
                        'title' => strip_tags($show_tags),
                    ));
                    echo '</a>';
                    echo '</div>';
                }
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
            infinite: true,
            autoplay: true,
            autoplaySpeed: 10000,
            adaptiveHeight: true,
            dots: false,
            centered: false,
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
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $(".fancybox").fancybox({
            'titlePosition': 'inside',
            'titleFromAlt': true,
            onComplete: function () {
                FB.XFBML.parse();
                console.log($(this))
            }
        });

    });

</script>



<?php get_footer(); ?>