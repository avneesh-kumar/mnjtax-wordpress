<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    
    /**
    *
    * Hook for Footer Content
    *
    * Hook konsal_footer_content
    *
    * @Hooked konsal_footer_content_cb 10
    *
    */
    do_action( 'konsal_footer_content' );

    /**
    *
    * Hook for Back to Top Button
    *
    * Hook konsal_back_to_top
    *
    * @Hooked konsal_back_to_top_cb 10
    *
    */
    do_action( 'konsal_back_to_top' );

    wp_footer();
    ?>
</body>
</html>