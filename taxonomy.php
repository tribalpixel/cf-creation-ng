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
<link rel='stylesheet' id='cf-creation-slick-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/slick/slick.css' type='text/css' media='all' />
<link rel='stylesheet' id='cf-creation-slick-theme-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/slick/slick-theme.css' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/slick/slick.js'></script>

<div class="row" id="content">

    <div class="small-12 columns">
        <?php
        // show tag cloud
        cfcreation_tag_cloud();
        ?>		
    </div>

    <div class="small-12 columns slideshow">
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
                echo "<div>"; the_attachment_link( $attachment->ID , false ); echo "</div>";
                //echo "<pre>"; print_r($attachment); echo "</pre>";
            }
        }
        /**/
        ?>

    </div>
</div>

<script>
jQuery(document).ready(function($){
    $('.slideshow').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        adaptiveHeight: true,
        dots: true
    });  
});
</script>

<?php get_footer(); ?>