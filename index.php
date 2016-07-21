<?php get_header(); ?>
<?php if (is_home()): ?>

    <div class="row">
        <div class="small-12 columns">
            <?php echo do_shortcode('[cfcreation-fb-page]') ?>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {

            $('.slideshow-mini').slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                //arrows: false,
                infinite: false,
                autoplay: true,
                autoplaySpeed: 10000,
                adaptiveHeight: false,
                variableWidth: false,
                dots: false,
                centered: false,
                //lazyLoad: 'ondemand',
                //rmobileFirst: true,
            });

            $(".fancybox").fancybox();
        });
    </script>

<?php endif; ?>
<div class="row" id="content">
    <div class="small-12 columns">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template', get_post_format()); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>