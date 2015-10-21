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

    <div class="small-12 columns">
        <?php
        //echo "<pre>"; print_r( $wp_query->query_vars['term'] ); echo "</pre>";
        $tag_query = array();
        if( isset($wp_query->query_vars['term']) ) {
            $tag_query = array('media_tag'=>$wp_query->query_vars['term']);
        } 
        $args = array_merge( array('post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' => 'any'), $tag_query);
        $attachments = get_posts($args);
        if ($attachments) {
            foreach ($attachments as $attachment) {
                the_attachment_link( $attachment->ID , false );
                //echo "<pre>"; print_r($attachment); echo "</pre>";
            }
        }
        /**/
        ?>

    </div>
</div>

<?php get_footer(); ?>