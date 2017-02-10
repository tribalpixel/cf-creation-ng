<?php get_header(); ?>

<?php /* NORMAL TEMPLATE */ ?>    
<div class="row align-center">
    <div class="small-12 columns">
        <div class="content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template', get_post_format()); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php echo cfcreation_homepage_slideshow_js(); ?>

<?php get_footer(); ?>