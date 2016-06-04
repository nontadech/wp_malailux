<div class="responsive-menu-wrap">
	<div class="mobile-menu-toggle">
		<span class="mobile-menu-icon"><i class="mobile-menu-icon-toggle feather-icon-menu"></i></span>
				<div class="logo-mobile">
						<?php
						$main_logo=of_get_option('main_logo');
						$responsive_logo=of_get_option('responsive_logo');
						$theme_style=of_get_option('theme_style');
						if (MTHEME_DEMO_STATUS) {
							$home_url_path = esc_url( add_query_arg($_GET ,home_url()) );
						} else {
							$home_url_path = home_url('/');
						}
						$mobile_logo_link_start = '<a href="'.esc_url($home_url_path).'">';

						if ( !MTHEME_DEMO_STATUS ) {
							if ( $main_logo <> "" ) {
								$mobile_logo = '<img class="logoimage" src="'.esc_url($main_logo).'" alt="logo" />';
							}
							if ( $responsive_logo <> "" ) {
								$mobile_logo = '<img class="logoimage" src="'.esc_url($responsive_logo).'" alt="logo" />';
							}
							if ( $main_logo == "" && $responsive_logo == "" ) {
								$mobile_logo = '<img class="logoimage" src="'.esc_url(MTHEME_PATH.'/images/logo.png').'" alt="logo" />';
							}
						} else {
							if ( $theme_style == "light" ) {
								$mobile_logo = '<img class="logoimage" src="'.esc_url(MTHEME_PATH.'/images/logo_dark.png').'" alt="logo" />';
							} else {
								$mobile_logo = '<img class="logoimage" src="'.esc_url(MTHEME_PATH.'/images/logo.png').'" alt="logo" />';
							}
						}
						$mobile_logo_link_end = '</a>';
						$responsive_logo = $mobile_logo_link_start . $mobile_logo . $mobile_logo_link_end;
						echo $responsive_logo;
						?>
				</div>
	</div>
</div>
<div class="responsive-mobile-menu clearfix">
	<?php
	$wpml_lang_selector_disable= of_get_option('wpml_lang_selector_disable');
	if (!$wpml_lang_selector_disable) {
	?>
	<div class="mobile-wpml-lang-selector-wrap">
		<?php do_action('icl_language_selector'); ?>
	</div>
	<?php
	}
	?>
	<div class="mobile-social-header">				
	<?php if ( !function_exists('dynamic_sidebar') 

	|| !dynamic_sidebar('Mobile Social Header') ) : ?>

	<?php endif; ?>
	</div>
	<?php
	get_template_part('mobile','searchform');
	?>
	<nav>
	<?php
	$custom_menu_call = '';
	// Responsive menu conversion to drop down list
	if ( function_exists('wp_nav_menu') ) { 
		wp_nav_menu( array(
		 'container' =>false,
		 'theme_location' => 'mobile_menu',
		 'menu' => $custom_menu_call,
		 'menu_class' => 'mtree',
		 'echo' => true,
		 'before' => '',
		 'after' => '',
		 'link_before' => '',
		 'link_after' => '',
		 'depth' => 0,
		 'fallback_cb' => 'mtheme_nav_fallback'
		 )
		);
	}
	?>
	</nav>
</div>