<?php
/**
 * Dynamic css
 *
 * @since Markup 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('markup_dynamic_css')) :

    function markup_dynamic_css()
    {
        global $markup_theme_options;

        /* Color Options Options */
        $markup_primary_color              = esc_attr($markup_theme_options['markup_primary_color']);
        $markup_logo_width              = absint($markup_theme_options['markup_logo_width_option']);
        
        $markup_header_overlay  = esc_attr($markup_theme_options['markup_slider_overlay_color']);
        $markup_header_transparent  = esc_attr($markup_theme_options['markup_slider_overlay_transparent']);
        $markup_header_min_height              = absint($markup_theme_options['markup_header_image_height']);

        $custom_css = '';

        //Primary  Background 
        if (!empty($markup_primary_color)) {
            $custom_css .= "
            #toTop,
            .more-link,
            .pagination .page-numbers.current,
            a.effect:before,
            .show-more,
            a.link-format,
            .wpcf7-form-control.wpcf7-submit,
            .comment-form #submit,
            .meta_bottom .post-share a:hover,
            .tabs-nav li:before,
            .post-slider-section .s-cat,
            .sidebar-3 .widget-title:after,
            .bottom-caption .slick-current .slider-items span,
            aarticle.format-status .post-content .post-format::after,
            article.format-chat .post-content .post-format::after, 
            article.format-link .post-content .post-format::after,
            article.format-standard .post-content .post-format::after, 
            article.format-image .post-content .post-format::after, 
            article.hentry.sticky .post-content .post-format::after, 
            article.format-video .post-content .post-format::after, 
            article.format-gallery .post-content .post-format::after, 
            article.format-audio .post-content .post-format::after, 
            article.format-quote .post-content .post-format::after{ 
                background-color: ". $markup_primary_color."; 
                border-color: ".$markup_primary_color.";
            }";

        }
        //Primary Color
        if (!empty($markup_primary_color)) {
            $custom_css .= "
            #author:active, 
            #email:active, 
            #url:active, 
            #comment:active, 
            #author:focus, 
            #email:focus, 
            #url:focus, 
            #comment:focus,
            #author:hover, 
            #email:hover, 
            #url:hover, 
            #comment:hover{
                border-color:".$markup_primary_color.";
            }";
         }
        //Primary Color
        if (!empty($markup_primary_color)) {
            $custom_css .= "
            .post-cats > span i, 
            .post-tags i,
            .post-cats > span a,
            .slide-wrap .caption span a:hover,
            .comment-form .logged-in-as a:last-child:hover, 
            .comment-form .logged-in-as a:last-child:focus,
            .main-header a:hover, 
            .main-header a:focus, 
            .main-header a:active,
            .top-menu > ul > li > a:hover,
            .main-menu ul li.current-menu-item > a, 
            .main-menu ul li.current-menu-ancestor > a, 
            .main-menu ul li.current-menu-parent > a,
            .header-2 .main-menu > ul > li.current-menu-item > a,
            .main-menu ul li:hover > a,
            .main-menu ul ul li:hover > a,
            .post-navigation .nav-links a:hover, 
            .post-navigation .nav-links a:focus,
            .tabs-nav li.tab-active a, 
            .tabs-nav li.tab-active,
            .tabs-nav li.tab-active a, 
            .tabs-nav li.tab-active,
            ul.trail-items li a:hover span,
            .author-socials a:hover,
            .post-date a:focus, 
            .post-date a:hover,
            .post-excerpt a:hover, 
            .post-excerpt a:focus, 
            .content a:hover, 
            .content a:focus,
            .post-footer > span a:hover, 
            .post-footer > span a:focus,
            .widget a:hover, 
            .widget a:focus,
            .footer-menu li a:hover, 
            .footer-menu li a:focus,
            .footer-social-links a:hover,
            .footer-social-links a:focus,
            .site-footer a:hover, 
            .site-footer a:focus, .content-area p a{ 
                color : ". $markup_primary_color."; 
            }";
        }

        //Logo Width
        if (!empty($markup_logo_width)) {
            $custom_css .= "
            .header-1 .head_one .logo{ 
                max-width : ". $markup_logo_width."px; 
            }";
        }

        //Header Overlay
        if (!empty($markup_header_overlay)) {
            $custom_css .= "
            .header-image:before { 
                background-color : ". $markup_header_overlay."; 
            }";
        }

        //Header Tranparent
        if (!empty($markup_header_transparent)) {
            $custom_css .= "
            .header-image:before { 
                opacity : ". $markup_header_transparent."; 
            }";
        }

        //Header Min Height
        if (!empty($markup_header_min_height)) {
            $custom_css .= "
            .header-1 .header-image .head_one { 
                min-height : ". $markup_header_min_height."px; 
            }";
        }

        wp_add_inline_style('markup-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'markup_dynamic_css', 99);