<?php
/**
 * Enqueue scripts and styles.
 */
function markup_scripts() {

	/*google font  */
	global $markup_theme_options;

    /*
     * Roboto, Roboto Slab and Monsieur La Doulaise are bundled in
     * assets/fonts/. This replaces the WPTT webfont loader, which still had
     * to reach fonts.googleapis.com on first use and cache into the uploads
     * directory, so it needed both outbound network access and a writable
     * uploads folder. Each face keeps its unicode-range, so browsers still
     * download only the subsets a page needs.
     */
    wp_enqueue_style( 'markup-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', array(), MARKUP_VERSION );

    wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/animate.min.css', array(), '4.1.1' );

    wp_enqueue_style( 'grid-css', get_template_directory_uri() . '/css/bootstrap.css', array(), MARKUP_VERSION );
    //*Font-Awesome-master*/
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3' );

    /*Slick CSS*/
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.8.1' );

   /*Main CSS*/
    wp_enqueue_style( 'markup-style', get_stylesheet_uri(), array(), MARKUP_VERSION );

	/*RTL CSS*/
	wp_style_add_data( 'markup-style', 'rtl', 'replace' );

    $markup_pagination_option =  esc_attr($markup_theme_options['markup-pagination-options']);
    
    if( 'ajax' == $markup_pagination_option )  {
    	
    	wp_enqueue_script( 'markup-custom-pagination', get_template_directory_uri() . '/assets/js/custom-infinte-pagination.js', array('jquery'), '4.6.0', true );
    }
    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.js', array(), '20200412', true );

    $masonry =  esc_attr($markup_theme_options['markup-column-blog-page']);
    if( 'masonry-post' == $masonry || 'one-column' == $masonry)  {
        wp_enqueue_script( 'masonry' );
        wp_enqueue_script( 'markup-custom-masonry', get_template_directory_uri() . '/assets/js/custom-masonry.js', array('jquery'), '4.6.0', true );
   }

	wp_enqueue_script( 'markup-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20200412', true );

	/*Slick JS*/
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '4.6.0', true  );
    

    
    /*Custom Script JS*/
	wp_enqueue_script( 'markup-script', get_template_directory_uri() . '/assets/js/script.js', array(), '20200412', true );
    
	/*Custom Scripts*/
	wp_enqueue_script( 'markup-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '20200412', true );
    
	global $wp_query;
    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    $max_num_pages = $wp_query->max_num_pages;

    wp_localize_script( 'markup-custom', 'markup_ajax', array(
        'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
        'paged'     => $paged,
        'max_num_pages'      => $max_num_pages,
        'next_posts'      => next_posts( $max_num_pages, false ),
        'show_more'      => __( 'View More', 'markup' ),
        'no_more_posts'        => __( 'No More', 'markup' ),
    ));

	wp_enqueue_script( 'markup-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20200412', true );

	/*Sticky Sidebar*/
	global $markup_theme_options;
	if( 1 == absint($markup_theme_options['markup-enable-sticky-sidebar'])) {
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array(), '20200412', true );
        wp_enqueue_script( 'markup-sticky-sidebar', get_template_directory_uri() . '/assets/js/custom-sticky-sidebar.js', array(), '20200412', true );
	}
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action( 'wp_enqueue_scripts', 'markup_scripts' );

/**
 * Enqueue fonts for the editor style
 */
function markup_block_styles() {
    wp_enqueue_style( 'markup-editor-styles', get_theme_file_uri( 'css/editor-styles.css' ), array(), MARKUP_VERSION );

    /*
     * The editor used to request Google directly, bypassing the local fonts
     * the front end already used. The body URL also had an HTML fragment
     * pasted inside it, so that request could never resolve at all.
     */
    wp_enqueue_style( 'markup-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', array(), MARKUP_VERSION );

    $markup_custom_css = '
    .editor-styles-wrapper p{ 
        font-family: Roboto;
        line-height: 1.5;
    }

    .editor-post-title__block .editor-post-title__input,
    .editor-styles-wrapper h1,
    .editor-styles-wrapper h2,
    .editor-styles-wrapper h3,
    .editor-styles-wrapper h4,
    .editor-styles-wrapper h5,
    .editor-styles-wrapper h6{font-family:Roboto Slab;} 
    ';

    wp_add_inline_style( 'markup-editor-styles', $markup_custom_css );
}

add_action( 'enqueue_block_editor_assets', 'markup_block_styles' );


/**
 * Enqueue Style for block pattern.
 */
function markup_block_pattern_styles() {

    /*
     * Was named prefer_blog_block_style, copied from the prefer-blog child
     * theme, and gated behind is_admin(), so the block pattern styling applied
     * in the editor but not on the published page. enqueue_block_assets runs
     * in both contexts, which is the point of the hook.
     */
    wp_enqueue_style(
        'markup-block-style',
        get_template_directory_uri() . '/templatesell/patterns/block-style.css',
        array(),
        MARKUP_VERSION
    );
}
add_action( 'enqueue_block_assets', 'markup_block_pattern_styles' );
