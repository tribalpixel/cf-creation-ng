<?php get_header(); ?>
	
   
	<div class="row" id="content">
		<div class="small-12 columns">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<h3><?php the_title(); ?></h3>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
<?php 

        $args = array('hide_empty' => false);
        //print_r(get_terms('media_tag', $args));
?>

    </div>
  </div>

	
<?php get_footer(); ?>