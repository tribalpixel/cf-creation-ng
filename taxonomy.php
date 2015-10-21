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
   
	<div class="row" id="content">
	
		<div class="small-12 columns">
		<?php 
			// show tag cloud
			cfcreation_tag_cloud(); 
		?>		
		</div>
		
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<h3><?php the_title(); ?></h3>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
	
		<div class="small-12 columns">
		<?php 
			//echo "<pre>"; print_r( $wp_query ); echo "</pre>";
			/*
			$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' =>'any'); 
			$attachments = get_posts( $args );
			if ( $attachments ) {
				foreach ( $attachments as $attachment ) {
					//the_attachment_link( $attachment->ID , false );
					echo "<pre>"; print_r($attachment); echo "</pre>";
				}
			}	
			*/
		?>
		
    </div>
  </div>
	
<?php get_footer(); ?>