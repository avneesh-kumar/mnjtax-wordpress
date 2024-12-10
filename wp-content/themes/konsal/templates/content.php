<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

echo '<!-- Single Post -->';

if(has_post_thumbnail()){ ?>

    <div <?php post_class('hth-post-thumbnail'); ?>>
    <?php
}else{ ?>
    <div <?php post_class(); ?>>
<?php }


    // Blog Post Content
    do_action( 'konsal_blog_post_content' );


echo '</div>';
echo '<!-- End Single Post -->';