<?php
/**
 * Post Navigation Function
 *
 * @since Markup 1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('markup_posts_navigation')) :
    function markup_posts_navigation()
    {
        global $markup_theme_options;
        $markup_pagination_option = $markup_theme_options['markup-pagination-options'];
        if ('numeric' == $markup_pagination_option) {
            global $wp_query;
            $big = 999999999; // need an unlikely integer

            // Arrows are icons only, so no translation functions.
            $markup_links = paginate_links(
                array(
                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, get_query_var( 'paged' ) ),
                    'total'     => $wp_query->max_num_pages,
                    'prev_text' => '<i class="fa fa-angle-left"></i>',
                    'next_text' => '<i class="fa fa-angle-right"></i>',
                )
            );

            if ( ! empty( $markup_links ) ) {
                echo "<div class='pagination'>";
                echo wp_kses_post( $markup_links );
                echo "</div>";
            }
        } elseif ('ajax' == $markup_pagination_option) {
            $page_number = get_query_var('paged');
            if ($page_number == 0) {
                $output_page = 2;
            } else {
                $output_page = $page_number + 1;
            }
            global $wp_query;

            if ( $wp_query->max_num_pages > 1 ) {
                printf(
                    '<div class="ajax-pagination text-center"><div class="show-more" data-number="%1$s"><i class="fa fa-refresh"></i>%2$s</div><div id="free-temp-post"></div></div>',
                    esc_attr( $output_page ),
                    esc_html__( 'View More', 'markup' )
                );
            }
            } else {
            return false;
        }
    }
endif;
add_action('markup_action_navigation', 'markup_posts_navigation', 10);