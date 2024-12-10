<?php
	// Block direct access
	if( ! defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : Konsal
	* @Version     : 1.0
	* @Author     : Themeholy
    * @Author URI : https://www.themeholy.com/
	*
	*/

	if( ! is_active_sidebar( 'konsal-woo-sidebar' ) ){
		return;
	}
?>
<div class="col-xl-3 col-lg-4">
	<!-- Sidebar Begin -->
	<aside class="sidebar-area shop-sidebar">
		<?php
			dynamic_sidebar( 'konsal-woo-sidebar' );
		?>
	</aside>
	<!-- Sidebar End -->
</div>