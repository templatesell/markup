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

            /*
             * prev_text and next_text used to be wrapped in __(), but they hold
             * no words, only an icon element, so a translator saw nothing but
             * markup. paginate_links() also returns null when there is one page
             * or fewer, which used to leave an empty pagination div behind.
             */
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
            /*
             * This used to call paginate_links() with no arguments purely to test
             * truthiness, building the whole pagination markup and discarding it.
             */
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