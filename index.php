<?php get_header(); ?>
	  
<div class="row" id="content">
    <div class="small-12 columns">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template', get_post_format() ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
    </div>
</div>
	
<?php get_footer(); ?>