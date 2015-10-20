<?php get_header(); ?>
	
   
	<div class="row" id="content">
		<div class="small-12 columns">
			  
<?php
$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' =>'any', 'post_parent' => $post->ID ); 
$attachments = get_posts( $args );
if ( $attachments ) {
	foreach ( $attachments as $attachment ) {
		echo apply_filters( 'the_title' , $attachment->post_title );
		the_attachment_link( $attachment->ID , false );
	}
}
?>
    </div>
  </div>

	
<?php get_footer(); ?>