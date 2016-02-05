<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo("charset"); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php bloginfo("name"); ?> - <?php bloginfo("description"); ?></title>
        
        <?php wp_head(); ?>
        
    </head>
	
    <body <?php body_class(); ?>>  
	<?php if(CFCNG_DEBUG) { echo "<pre>"; print_r( debug_backtrace() ); echo "</pre>"; } ?>
        
        <?php /* LOGO */ ?>	
        <div class="row">
            <div class="small-12 columns">
                <div id="logo">
                    <h1><?php bloginfo('name'); ?>, <?php bloginfo('description'); ?>, <?php echo get_theme_mod('cfcreation_name'); ?></h1>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo_cfcreation.png" alt="CF-Creation logo" width="321" height="135" /></a>
                </div>
            </div>
        </div>		

        <?php /* ADDRESS */ ?>	
        <div class="row">
            <div class="small-12 columns">		
                <div id="contact-address">
                    <?php echo get_theme_mod('cfcreation_name'); ?> &nbsp;|&nbsp;
                    <?php echo get_theme_mod('cfcreation_infos1'); ?>&nbsp;|&nbsp;
                    <?php echo get_theme_mod('cfcreation_infos2'); ?>&nbsp;|&nbsp;
                    <?php echo get_theme_mod('cfcreation_mobile'); ?>&nbsp;|&nbsp;
                    <a href="mailto:<?php echo get_theme_mod('cfcreation_email'); ?>" ><?php echo get_theme_mod('cfcreation_email'); ?></a>						  
                </div>			
            </div>
        </div>

        <?php /* NAV */ ?>	
        <div class="row">
            <div class="small-12 centered columns">
                <div id="header_nav">
                    <?php wp_nav_menu(array('theme_location' => 'header_menu', 'items_wrap' => '<ul id="%1$s" class="%2$s inline-list">%3$s</ul>',)); ?>
                </div>
            </div>
        </div>    