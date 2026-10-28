<?php
/**
 * Social Sharing Hook *
 * @since 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('markup_social_sharing')) :
    function markup_social_sharing($post_id)
    {
        $markup_url = get_the_permalink($post_id);
        $markup_title = get_the_title($post_id);
        $markup_image = get_the_post_thumbnail_url($post_id);
        
        /*
         * Built unescaped here and escaped once at output. esc_url() rewrites &
         * as &#038;, so escaping at both ends would double-encode the query
         * string and break the share links. The endpoints are https now; the
         * http:// versions only redirect.
         */
        $markup_twitter_sharing_url   = 'https://twitter.com/share?text=' . $markup_title . '&url=' . $markup_url;
        $markup_facebook_sharing_url  = 'https://www.facebook.com/sharer/sharer.php?u=' . $markup_url;
        $markup_pinterest_sharing_url = 'https://pinterest.com/pin/create/button/?url=' . $markup_url . '&media=' . $markup_image . '&description=' . $markup_title;
        $markup_linkedin_sharing_url  = 'https://www.linkedin.com/shareArticle?mini=true&title=' . $markup_title . '&url=' . $markup_url;
        
        ?>
        
        <div class="post-share">
            <span class="btn-text"><?php esc_html_e( 'Share', 'markup' ); ?></span>
            <span class="btn-icon"><i class="fa fa-share-alt"></i></span>
            <ul class="share-icons">
                <li>
                <a target="_blank" href="<?php echo esc_url( $markup_facebook_sharing_url ); ?>">
                    <i class="fa fa-facebook"></i>
                </a>
                </li>
                <li>
                    <a target="_blank" href="<?php echo esc_url( $markup_twitter_sharing_url ); ?>">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="<?php echo esc_url( $markup_pinterest_sharing_url ); ?>">
                        <i class="fa fa-pinterest"></i>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="<?php echo esc_url( $markup_linkedin_sharing_url ); ?>">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </li>
            </ul>
        </div>
        <?php
    }
endif;
add_action('markup_social_sharing', 'markup_social_sharing', 10);