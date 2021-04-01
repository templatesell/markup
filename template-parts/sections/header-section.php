<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Markup
 */
$GLOBALS['markup_theme_options'] = markup_get_options_value();
global $markup_theme_options;
$enable_header = absint($markup_theme_options['markup_enable_top_header']);
$enable_menu   = absint($markup_theme_options['markup_enable_top_header_menu']);
$enable_social = absint($markup_theme_options['markup_enable_top_header_social']);
$search_header = absint($markup_theme_options['markup_enable_search']);
$ads_header = esc_url($markup_theme_options['markup_enable_advertisement']);
$ads_link = esc_url($markup_theme_options['markup_link_advertisement']);
$logo_position = esc_attr($markup_theme_options['markup_logo_position_option']);
?>

<header class="header-1">
		<?php if( $enable_header == 1 ){ ?>
			<section class="top-bar-area">
				<div class="container">
					<?php if( $enable_menu == 1 ) { ?>
						<nav id="top-nav" class="left-side">
	                        <div class="top-menu">
	    						<?php
	    						wp_nav_menu( array(
	    							'theme_location' => 'top',
	    							'menu_id'        => '',
	    							'container' => 'ul',
	                                'menu_class'      => ''
	    						) );
	    						?>
							</div>
						</nav><!-- .top-nav -->
					<?php } ?>
					
					<?php if( $enable_social == 1 ){ ?>
						<div class="right-side">
							<div class="social-links">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_id'        => 'social-menu',
										'menu_class'     => 'markup-social-menu',
									) );
								?>
							</div>
						</div>
					<?php } ?>
				</div>
			</section>
			<?php } ?>		
	<?php $header_image = esc_url(get_header_image());
	$header_class = ($header_image == "") ? '' : 'header-image';
	?>
	<section class="main-header <?php echo esc_attr($header_class); ?>" style="background-image:url(<?php echo esc_url($header_image) ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
		<div class="head_one  clearfix ">
			<div class="container">
				<div class="row">
					<div class="<?php echo esc_attr($logo_position); ?> col-sm-4">
						<div class="logo">
							<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) :
								?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
							else :
								?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							endif;
							$markup_description = get_bloginfo( 'description', 'display' );
							if ( $markup_description || is_customize_preview() ) :
								?>
								<p class="site-description"><?php echo $markup_description; /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>
						</div><!-- .site-logo -->
					</div>
					<?php if(!empty($ads_header)): ?>
					<div class="<?php echo esc_attr($logo_position); ?> col-sm-8 text-right">
						<div class="add__banner">
						    <a href="<?php echo esc_url($ads_link); ?>" target="_blank">
						        <img src="<?php echo esc_url($ads_header); ?>" alt="">
						    </a>
						</div>
					</div>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="menu-area">
			<div class="container">					
				<nav id="site-navigation" class="site-navigation">
					<?php if( 1 == $search_header ){ ?>
						<div class="search-wrapper">					
							<div class="search-box">
								<a href="#" class="s_click"><i class="fa fa-search first_click" aria-hidden="true" style="display: block;"></i></a>
								<a href="#" class="s_click"><i class="fa fa-times second_click" aria-hidden="true" style="display: none;"></i></a>
							</div>
							<div class="search-box-text">
								<?php echo get_search_form(); ?>
							</div>				
						</div>
					<?php } ?>

					<button class="bar-menu">
						<span></span>
					</button>
					<div class="main-menu menu-caret">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container' => 'ul',
							'menu_class'      => ''
						));
						?>
					</div>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</setion><!-- #masthead -->
</header>

