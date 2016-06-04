<?php
/**
*  Sidebar
 */
?>
<?php
global $mtheme_sidebar_choice,$mtheme_pagestyle;
if ( !is_singular() ) {
	unset($mtheme_sidebar_choice);
}
$sidebar_position="sidebar-float-right";
if ($mtheme_pagestyle=="rightsidebar") { $sidebar_position = 'sidebar-float-right'; }
if ($mtheme_pagestyle=="leftsidebar") { $sidebar_position = 'sidebar-float-left'; }
?>
<div id="sidebar" class="sidebar-wrap<?php if ( is_single() || is_page() ) { echo "-single"; } ?> <?php echo esc_attr($sidebar_position); ?>">
		<div class="sidebar clearfix">
			<!-- begin Dynamic Sidebar -->
			<?php
			if ( !isset($mtheme_sidebar_choice) || empty($mtheme_sidebar_choice) ) {
				$mtheme_sidebar_choice="default_sidebar";
			}
			if ( class_exists( 'woocommerce' ) ) {
				if (is_woocommerce()) {
					$mtheme_sidebar_choice="woocommerce_sidebar";
				}
			}
			?>
			<?php
			if ( is_active_sidebar( $mtheme_sidebar_choice ) ) {
				dynamic_sidebar($mtheme_sidebar_choice);
			}
			?>
	</div>
</div>