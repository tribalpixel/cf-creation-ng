<?php get_header(); ?>

<?php /* FB PLUGIN SHORTCODE */ ?>
<?php if (shortcode_exists('tplfbp-albums')): ?>
    <?php if (is_home()): ?>
        <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/slick/slick.js'></script>
        <div class="row align-center"> 
            <div class="small-12 columns">
                <?php //echo do_shortcode('[tplfbp-albums]'); ?>
                <?php echo do_shortcode('[tplfbp-show id="1152276924806829"]'); ?>
            </div>
        </div>
        <script>
            jQuery(document).ready(function ($) {

                $('.slideshow-mini').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
//                    arrows: false,
//                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 1000,
//                    adaptiveHeight: false,
//                    variableWidth: true,
//                    dots: false,
//                    centered: false,
                    //lazyLoad: 'ondemand',
                    //mobileFirst: true,
                });

        //$(".fancybox").fancybox();
            });
        </script>  
    <?php endif; ?>
<?php endif; ?>       

<?php /* NORMAL TEMPLATE */ ?>    
<div class="row align-center">
    <div class="columns">
        <div class="content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template', get_post_format()); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>