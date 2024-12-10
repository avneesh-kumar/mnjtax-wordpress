<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if (!defined('ABSPATH')) {
    exit;
}

if ( ! is_active_sidebar( 'konsal-page-sidebar' ) ) {
    return;
}
?>

<div class="col-xxl-4 col-lg-5">
    <div class="page-sidebar">
    <?php 
        dynamic_sidebar( 'konsal-page-sidebar' );
    ?>               
    </div>
</div>