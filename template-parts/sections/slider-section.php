<?php 
/**
 * Markup Slider Function
 * @since Markup 1.0.0
 *
 * @param null
 * @return void
 *
 */
global $markup_theme_options;
$slide_id = absint($markup_theme_options['markup-select-category']);
        $slick_args = array(
            'slidesToShow'      => 1,
            'slidesToScroll'    => 1,
            'dots'              => false,
            'arrows'            => false,
        );
      $args = array(
			'posts_per_page' => 5,
			'paged' => 1,
			'cat' => $slide_id,
			'post_type' => 'post'
		);
		$slider_query = new WP_Query($args);
		if ($slider_query->have_posts()): ?>
    <div class="modern-slider" data-slick='<?php echo $slick_args_encoded; ?>'>
				<?php while ($slider_query->have_posts()) : $slider_query->the_post(); 
          if(has_post_thumbnail()){
          $image_id = get_post_thumbnail_id();
          $image_url = wp_get_attachment_image_src( $image_id,'',true );
        ?>
				<div class="slider-items">
          <div class="slide-wrap">
            <div class="col-md-12">
              <div class="slider-height img-cover" style="background-image: url(<?php echo esc_url($image_url[0]);?>)">
                <div class="caption">
                    <?php
                       $categories = get_the_category();
                       if ( ! empty( $categories ) ) {
                          echo '<a class="s-cat" href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">'.esc_html( $categories[0]->name ).'</a>';
                      }                                 
                    ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta">
                      <?php markup_posted_by(); ?>
                      <?php markup_posted_on(); ?>
                    </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <?php } endwhile;
        wp_reset_postdata(); ?>
    </div>
<?php endif; ?>