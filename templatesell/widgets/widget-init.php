<?php

if ( ! function_exists( 'markup_load_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function markup_load_widgets() {

        // Highlight Post.
        register_widget( 'Markup_Featured_Post' );

        // Author Widget.
        register_widget( 'Markup_Author_Widget' );
		
		// Social Widget.
        register_widget( 'Markup_Social_Widget' );
    }
endif;
add_action( 'widgets_init', 'markup_load_widgets' );


