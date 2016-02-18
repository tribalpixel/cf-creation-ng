<?php get_header(); ?>

<div class="row" id="content">
    <div class="small-12 columns">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <h4><?php the_title(); ?></h4>
                <div class="small-4 columns"><div class="label radius"><?php previous_image_link(false, __('Previous Image')); ?></div></div>
                <div class="small-4 columns"><?php echo wp_get_attachment_image(get_the_ID(), 'large'); ?></div>       
                <div class="small-4 columns"><div class="label radius"><?php next_image_link(false, __('Next Image')); ?></div></div>
                    <?php the_tags(); ?>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>