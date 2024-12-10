<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */


// Block direct access
if( ! defined( 'ABSPATH' ) ){
    exit;
}

 // theme option callback
function konsal_opt( $id = null, $url = null ){
    global $konsal_opt;

    if( $id && $url ){

        if( isset( $konsal_opt[$id][$url] ) && $konsal_opt[$id][$url] ){
            return $konsal_opt[$id][$url];
        }
    }else{
        if( isset( $konsal_opt[$id] )  && $konsal_opt[$id] ){
            return $konsal_opt[$id];
        }
    }
}

// theme logo
function konsal_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    if( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $siteLogo = '';
        $siteLogo .= '<a class="logo" href="'.esc_url( $siteUrl ).'">';
        $siteLogo .= konsal_img_tag( array(
            "class" => "img-fluid",
            "url"   => esc_url( wp_get_attachment_image_url( $custom_logo_id, 'full') )
        ) );
        $siteLogo .= '</a>';

        return $siteLogo;
    } elseif( !konsal_opt('konsal_text_title') && konsal_opt('konsal_site_logo', 'url' )  ){

        $siteLogo = '<img class="img-fluid" src="'.esc_url( konsal_opt('konsal_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'konsal' ).'" />';
        return '<a class="logo" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';


    }elseif( konsal_opt('konsal_text_title') ){
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( konsal_opt('konsal_text_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// custom meta id callback
function konsal_meta( $id = '' ){
    $value = get_post_meta( get_the_ID(), '_konsal_'.$id, true );
    return $value;
}


// Blog Date Permalink
function konsal_blog_date_permalink() {
    $year  = get_the_time('Y');
    $month_link = get_the_time('m');
    $day   = get_the_time('d');
    $link = get_day_link( $year, $month_link, $day);
    return $link;
}

//audio format iframe match
function konsal_iframe_match() {
    $audio_content = konsal_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}


//Post embedded media
function konsal_embedded_media( $type = array() ){
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );


    if( in_array( 'audio' , $type) ){
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }

    }else{
        if( count( $embed ) > 0 ){
            $output = $embed[0];
        }else{
           $output = '';
        }
    }
    return $output;
}


// WP post link pages
function konsal_link_pages(){
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'konsal' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'konsal' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


// Data Background image attr
function konsal_data_bg_attr( $imgUrl = '' ){
    return 'data-bg-img="'.esc_url( $imgUrl ).'"';
}

// image alt tag
function konsal_image_alt( $url = '' ){
    if( $url != '' ){
        // attachment id by url
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
            $alt = str_replace( '-', ' ', $filename['filename'] );
            return $alt;
        }
    }else{
       return;
    }
}


// Flat Content wysiwyg output with meta key and post id

function konsal_get_textareahtml_output( $content ) {
    global $wp_embed;

    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = wpautop( $content );
    $content = do_shortcode( $content );

    return $content;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

function konsal_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'konsal_pingback_header' );


// Excerpt More
function konsal_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'konsal_excerpt_more' );


// konsal comment template callback
function konsal_comment_callback( $comment, $args, $depth ) {
        $add_below = 'comment';
    ?>
    <li <?php comment_class( array('th-comment-item') ); ?>>
        <div id="comment-<?php comment_ID() ?>" class="th-post-comment">
            <?php
                if( get_avatar( $comment, 100 )  ) :
            ?>
            <!-- Author Image -->
            <div class="comment-avater">
                <?php
                    if ( $args['avatar_size'] != 0 ) {
                        echo get_avatar( $comment, 110 );
                    }
                ?>
            </div>
            <!-- Author Image -->
            <?php
                endif;
            ?>
            <!-- Comment Content -->
            <div class="comment-content">
                <span class="commented-on"> <i class="far fa-calendar"></i> <?php printf( esc_html__('%1$s', 'konsal'), get_comment_date() ); ?> </span>
                <h3 class="name"><?php echo esc_html( ucwords( get_comment_author() ) ); ?></h3>
                <?php comment_text(); ?>
                <div class="reply_and_edit">
                    <?php
                        $reply_text = wp_kses_post( '<i class="fas fa-reply"></i> Reply', 'konsal' );

                        $edit_reply_text = wp_kses_post( '<i class="fas fa-pencil-alt"></i> Edit', 'konsal' );

                        comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 3, 'max_depth' => 5, 'reply_text' => $reply_text ) ) );
                        edit_comment_link( $edit_reply_text, '  ', '' );
                    ?>  
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'konsal' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Comment Content -->
<?php
}

//body class
add_filter( 'body_class', 'konsal_body_class' );
function konsal_body_class( $classes ) {
    if( class_exists('ReduxFramework') ) {
        $konsal_blog_single_sidebar = konsal_opt('konsal_blog_single_sidebar');
        if( ($konsal_blog_single_sidebar != '2' && $konsal_blog_single_sidebar != '3' ) || ! is_active_sidebar('konsal-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
    } else {
        if( !is_active_sidebar('konsal-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
    }
    return $classes;
}


function konsal_footer_global_option(){
    // Konsal Widget Enable Disable
    if( class_exists( 'ReduxFramework' ) ){
        $konsal_footerwidget_enable = konsal_opt( 'konsal_footerwidget_enable' );
        $konsal_footercta_enable = konsal_opt( 'konsal_footercta_enable' );
        $konsal_disable_footer_bottom = konsal_opt( 'konsal_disable_footer_bottom' );

    }else{
        $konsal_footerwidget_enable = '';
        $konsal_disable_footer_bottom = '1';
        $konsal_footercta_enable = '';
    }
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'i'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array(),
            'class'     => array(),
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
    );

    if( $konsal_footercta_enable == 1 ){ 
        $footer_cta_class = 'footer-layout1';
        $konsal_footer_cta_bg = !empty(konsal_opt( 'konsal_footer_cta_bg','url' )) ? konsal_opt( 'konsal_footer_cta_bg','url' ) : '#';
        $konsal_footer_cta_title = !empty(konsal_opt( 'konsal_footer_cta_title' )) ? konsal_opt( 'konsal_footer_cta_title' ) : '';
        $konsal_footer_cta_subtitle = !empty(konsal_opt( 'konsal_footer_cta_subtitle' )) ? konsal_opt( 'konsal_footer_cta_subtitle' ) : '';

        echo '<div class="cta-area-1" >';
            echo '<div class="container z-index-common">';
                echo '<div class="cta-wrap bg-theme">';
                    echo '<div class="cta-thumb">';
                        echo '<img src="'.esc_url( $konsal_footer_cta_bg ).'" alt="'.esc_html__('icon', 'konsal').'">';
                    echo '</div>';
                    echo '<div class="cta-content">';
                        echo '<h5 class="cta-subtitle">'.esc_html( $konsal_footer_cta_title ).'</h5>';
                        echo '<h4 class="cta-title">'.esc_html( $konsal_footer_cta_subtitle ).'</h4>';
                    echo '</div>';
                    if( !empty( konsal_opt( 'konsal_footer_cta_btn_text' ) ) ){
                        echo '<a href="'.esc_html( konsal_opt( 'konsal_footer_cta_btn_url' ) ).'" class="th-btn style7">'.esc_html( konsal_opt( 'konsal_footer_cta_btn_text' ) ).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }else{
        $footer_cta_class = '';
    }
    echo '<footer class="footer-wrapper '.esc_attr($footer_cta_class).' footer-custom">';
        
        if( $konsal_footerwidget_enable == 1 ){
            echo '<div class="widget-area">';
                echo '<div class="container">';
                    echo '<div class="row justify-content-between">';
                        if( is_active_sidebar( 'konsal-footer-1' )){
                            dynamic_sidebar( 'konsal-footer-1' ); 
                        }
                        if( is_active_sidebar( 'konsal-footer-2' )){
                            dynamic_sidebar( 'konsal-footer-2' ); 
                        }
                        if( is_active_sidebar( 'konsal-footer-3' )){
                            dynamic_sidebar( 'konsal-footer-3' ); 
                        }
                        if( is_active_sidebar( 'konsal-footer-4' )){
                            dynamic_sidebar( 'konsal-footer-4' ); 
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        if( $konsal_disable_footer_bottom == 1 ){
            echo '<div class="copyright-wrap">';
                echo '<div class="container">';
                    echo '<div class="row justify-content-between align-items-center">';
                        if( has_nav_menu( 'footer-menu' ) ){
                            echo '<div class="col-lg-6">';
                        }else{
                            echo '<div class="col-lg-12 text-center">';
                        }
                            echo '<p class="copyright-text">'.wp_kses( konsal_opt( 'konsal_copyright_text' ), $allowhtml ).'</p>';
                        echo '</div>';
                        if( has_nav_menu( 'footer-menu' ) ){
                            echo '<div class="col-lg-6  text-center text-lg-end">';
                                echo '<div class="footer-links">';
                                    wp_nav_menu( array(
                                        'theme_location'  => 'footer-menu',
                                    ) );
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    echo '</footer>';
}

function konsal_social_icon(){
    $konsal_social_icon = konsal_opt( 'konsal_social_links' );
    if( ! empty( $konsal_social_icon ) && isset( $konsal_social_icon ) ){
        foreach( $konsal_social_icon as $social_icon ){
            if( ! empty( $social_icon['title'] ) ){
                echo '<a href="'.esc_url( $social_icon['url'] ).'"><i class="'.esc_attr( $social_icon['title'] ).'"></i></a> ';
            }
        }
    }
}

// global header
function konsal_global_header_option() {
    if( class_exists( 'ReduxFramework' ) ){

        global $woocommerce;
        if( ! empty( $woocommerce->cart->cart_contents_count ) ){
          $count = $woocommerce->cart->cart_contents_count;
        }else{
          $count = "0";
        }

        if(konsal_opt('konsal_header_sticky')){
            $sticky = '';
        }else{
            $sticky = '-no';
        }

        if(konsal_opt('konsal_menu_icon')){ 
            $menu_icon = '';
        }else{
            $menu_icon = 'hide-icon';
        } 

        // Konsal Widget Enable Disable
        $konsal_header_btn_text = konsal_opt('konsal_header_btn_text');
        $konsal_btn_url = konsal_opt('konsal_btn_url');

        $konsal_header_search_switcher      = konsal_opt( 'konsal_header_search_switcher' );
        $konsal_header_cart_switcher        = konsal_opt( 'konsal_header_cart_switcher' );
        $konsal_header_offcanvas_switcher   = konsal_opt( 'konsal_header_offcanvas_switcher' );

        echo konsal_search_box();
        echo konsal_mobile_menu();
        echo konsal_offcanvas_box();
        echo konsal_cart_box();

        echo '<header class="th-header header-default prebuilt">';

            konsal_header_topbar();
        
            echo '<div class="sticky-wrapper'.esc_attr($sticky).'">';
                echo '<!-- Main Menu Area -->';
                echo '<div class="menu-area">';
                    echo '<div class="container">';
                        echo '<div class="row align-items-center justify-content-between">';
                            echo '<div class="col-auto">';
                                echo '<div class="header-logo">';
                                    echo konsal_theme_logo();
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="col-auto">';
                                if( has_nav_menu( 'primary-menu' ) ){
                                    echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
                                        wp_nav_menu( array(
                                            "theme_location"    => 'primary-menu',
                                            "container"         => '',
                                            "menu_class"        => ''
                                        ) );
                                    echo '</nav>';
                                }
                                echo '<div class="header-button d-flex d-lg-none">';
                                    if( $konsal_header_cart_switcher == 1 ){
                                        echo '<button type="button" class="simple-icon sideMenuToggler">';
                                            echo '<i class="far fa-shopping-cart"></i>';
                                            echo '<span class="badge">'.esc_html( $count ).'</span>';
                                        echo '</button>';
                                    }
                                    echo '<button type="button" class="th-menu-toggle"><i class="far fa-bars"></i></button>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="col-auto d-none d-xl-block">';
                                echo '<div class="header-button">';
                                    if( $konsal_header_search_switcher == 1 ){
                                        echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
                                    }
                                    if( $konsal_header_cart_switcher == 1 ){
                                        echo '<button type="button" class="simple-icon sideMenuToggler">';
                                            echo '<i class="far fa-shopping-cart"></i>';
                                            echo '<span class="badge">'.esc_html( $count ).'</span>';
                                        echo '</button>';
                                    }
                                    if( $konsal_header_offcanvas_switcher == 1 ){
                                        echo '<button type="button" class="simple-icon sideMenuInfo"><i class="fa-solid fa-bars"></i></button>';
                                    }
                                    if(!empty( $konsal_header_btn_text )){
                                        echo '<div class="d-xxl-block d-none">';
                                            echo '<a href="'.esc_url($konsal_btn_url).'" class="th-btn">'.wp_kses_post( $konsal_header_btn_text ).'</a>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="logo-bg" data-bg-src="'.KONSAL_DIR_ASSIST_URI.'img/hero-1-bg.png"></div>';  
                echo '</div>';
            echo '</div>';
        echo '</header>';

    }else{
        konsal_global_header();
    }
}





// konsal woocommerce breadcrumb
function konsal_woo_breadcrumb( $args ) {
    return array(
        'delimiter'   => '',
        'wrap_before' => '<ul class="breadcumb-menu">',
        'wrap_after'  => '</ul>',
        'before'      => '<li>',
        'after'       => '</li>',
        'home'        => _x( 'Home', 'breadcrumb', 'konsal' ),
    );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'konsal_woo_breadcrumb' );

function konsal_custom_search_form( $class ) {
    echo '<!-- Search Form -->';

    echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'" class="'.esc_attr( $class ).'">';
        echo '<label class="searchIcon">';
            echo konsal_img_tag( array(
                "url"   => esc_url( get_theme_file_uri( '/assets/img/search-2.svg' ) ),
                "class" => "svg"
            ) );
            echo '<input value="'.esc_html( get_search_query() ).'" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'konsal').'">';
        echo '</label>';
    echo '</form>';
    echo '<!-- End Search Form -->';
}



//Fire the wp_body_open action.
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

//Remove Tag-Clouds inline style
add_filter( 'wp_generate_tag_cloud', 'konsal_remove_tagcloud_inline_style',10,1 );
function konsal_remove_tagcloud_inline_style( $input ){
   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input );
}

function konsal_setPostViews( $postID ) {
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function konsal_getPostViews( $postID ){
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return __( '0', 'konsal' );
    }
    return $count;
}


/* This code filters the Categories archive widget to include the post count inside the link */
add_filter( 'wp_list_categories', 'konsal_cat_count_span' );
function konsal_cat_count_span( $links ) {
    $links = str_replace('</a> (', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter( 'get_archives_link', 'konsal_archive_count_span' );
function konsal_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}
//header search box
if(! function_exists('konsal_search_box')){
    function konsal_search_box(){
        echo '<div class="popup-search-box d-none d-lg-block  ">';
            echo '<button class="searchClose border-theme text-theme"><i class="fal fa-times"></i></button>';
            echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'">';
                echo '<input value="'.esc_html( get_search_query() ).'" class="border-theme" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'konsal').'">';
                echo '<button type="submit"><i class="fal fa-search"></i></button>';
            echo '</form>';
        echo '</div>';
    }
}

// mobile logo
function konsal_mobile_logo() {
    $logo_url = konsal_opt('konsal_mobile_logo', 'url' );
    $mobile_menu = '';
    if( !empty($logo_url )){
        $mobile_menu = '<div class="mobile-logo"><a href="'.home_url('/').'"><img src="'.esc_url($logo_url).'" alt="'.esc_attr__( 'logo', 'konsal' ).'"></a></div>';
    }else{
        $mobile_menu .= '<div class="mobile-logo">';
        $mobile_menu .= konsal_theme_logo();
        $mobile_menu .= '</div>';
    }

    return $mobile_menu;
 }

//header mobile menu
if(! function_exists('konsal_mobile_menu')){
    function konsal_mobile_menu(){
        echo '<div class="th-menu-wrapper">';
            echo '<div class="th-menu-area text-center">';
                echo '<button class="th-menu-toggle"><i class="fal fa-times"></i></button>';
                    if( class_exists('ReduxFramework') ){
                        if(!empty(konsal_opt('konsal_menu_menu_show') )){
                            echo konsal_mobile_logo(); 
                        }
                    }else{
                        echo '<div class="mobile-logo">';
                            echo konsal_theme_logo();
                        echo '</div>';
                    }
                echo '<div class="th-mobile-menu">';
                    if( has_nav_menu( 'primary-menu' ) ) {
                        echo '<div class="th-mobile-menu">';
                            wp_nav_menu( array(
                                "theme_location"    => 'primary-menu',
                                "container"         => '',
                                "menu_class"        => ''
                            ) );
                        echo '</div>';                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}

//Offcanvas box
if(! function_exists('konsal_offcanvas_box')){
     function konsal_offcanvas_box(){
        echo '<div class="sidemenu-wrapper sidemenu-info d-none d-lg-block">';
            echo '<div class="sidemenu-content">';
                echo '<button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>';
                    if(is_active_sidebar('konsal-offcanvth-sidebar')){
                        dynamic_sidebar( 'konsal-offcanvth-sidebar' );
                    }else{
                        echo '<h4>No Widget Added </h4>';
                        echo '<p>Please add some widget in Offcanvs Sidebar</p>';
                    }
            echo '</div>';
        echo '</div>';
    }
}

//Cart box
if(! function_exists('konsal_cart_box')){
    function konsal_cart_box(){
        echo '<div class="sidemenu-wrapper sidemenu-cart">';
            echo '<div class="sidemenu-content">';
                echo '<button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>';
                echo '<div class="widget woocommerce widget_shopping_cart">';
                    echo '<h3 class="widget_title">Shopping cart</h3>';
                    echo '<div class="widget_shopping_cart_content">';
                        if( class_exists( 'woocommerce' ) ){
                            echo woocommerce_mini_cart();
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
   }
}


// Konsal Default Header for unit test
if( ! function_exists( 'konsal_global_header' ) ){
    function konsal_global_header(){
        echo konsal_search_box();
        echo konsal_mobile_menu();

        if( class_exists( 'ReduxFramework' ) ){ 
            $class = '';
        } else {
            $class = 'unittest-header';
        }

        echo '<!--======== Header ========-->';
        echo '<header class="th-header header-default ' . esc_attr($class) . ' ">';
           echo ' <div class="menu-wrapper">';
                echo '<div class="sticky-wrapper">';
                    echo '<div class="menu-area">';
                        echo '<div class="container">';
                            echo '<div class="row gx-20 align-items-center justify-content-between">';
                                echo '<div class="col-auto">';
                                    echo '<div class="header-logo">';
                                        echo konsal_theme_logo();
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="col-auto">';
                                    if( has_nav_menu( 'primary-menu' ) ) {
                                        echo '<nav class="main-menu d-none d-lg-inline-block">';
                                            wp_nav_menu( array(
                                                "theme_location"    => 'primary-menu',
                                                "container"         => '',
                                                "menu_class"        => ''
                                            ) );
                                        echo '</nav>';
                                    }                                    
                                    echo '</nav>';
                                    echo '<button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>';
                                echo '</div>';
                                echo '<div class="col-auto d-none d-xl-block">';
                                    echo '<div class="header-button">';
                                        echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</header>';
    }
}

if( ! function_exists( 'konsal_header_topbar' ) ){
    function konsal_header_topbar(){
        
        $konsal_show_header_topbar      = konsal_opt( 'konsal_header_topbar_switcher' );
        $konsal_show_social_icon        = konsal_opt( 'konsal_header_topbar_social_icon_switcher' );
        $phone      = konsal_opt( 'konsal_topbar_phone' );          
        $email       = konsal_opt( 'konsal_topbar_email' );
        $konsal_language_switcher       = konsal_opt( 'konsal_header_topbar_language_switcher' );
        $konsal_menu_topbar_slogan       = konsal_opt( 'konsal_menu_topbar_slogan' );

        $phone_icon = !empty(konsal_opt( 'konsal_topbar_phone_icon' )) ? konsal_opt( 'konsal_topbar_phone_icon' ): '';
        $email_icon = !empty(konsal_opt( 'konsal_topbar_email_icon' )) ? konsal_opt( 'konsal_topbar_email_icon' ): '';

        $replace        = array(' ','-',' - ');
        $replace_phone  = array(' ','-',' - ', '(', ')');
        $with           = array('','','');

        $phoneurl       = str_replace( $replace_phone, $with, $phone );
        $eamilurl       = str_replace( $replace, $with, $email );

        if( $konsal_show_header_topbar ){
            echo '<div class="header-top">';
                echo '<div class="container">';
                    echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
                        if(!empty($konsal_menu_topbar_slogan )){
                            echo '<div class="col-auto d-none d-lg-block">';
                                echo '<p class="header-notice">'.esc_html( $konsal_menu_topbar_slogan ).'</p>';
                            echo '</div>';
                        }
                        echo '<div class="col-auto">';
                            echo '<div class="header-links">';
                                echo '<ul>';
                                    if(!empty($phone )){
                                        echo '<li class="d-none d-xl-inline-block">'.wp_kses_post( $phone_icon ).'<a href="'.esc_attr( 'tel:'.$phoneurl ).'">'.esc_html($phone).'</a></li>';
                                    }
                                    if(!empty($email )){
                                        echo '<li class="d-none d-sm-inline-block">'.wp_kses_post( $email_icon ).'<a href="'.esc_attr( 'mailto:'.$eamilurl ).'">'.esc_html($email).'</a></li>';
                                    }
                                    if($konsal_language_switcher){
                                        echo '<li>';
                                            echo '<div class="dropdown-link">';
                                                echo '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-light fa-globe"></i> '.esc_html__('Language', 'konsal').'</a>';
                                                echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
                                                    echo '<li>';
                                                        echo do_shortcode('[gtranslate]');
                                                    echo '</li>';
                                                echo '</ul>';
                                            echo '</div>';
                                        echo '</li>';
                                    }
                                    if($konsal_show_social_icon){
                                        echo ' <li>';
                                            echo '<div class="social-links">';
                                                konsal_social_icon();
                                            echo '</div>';
                                        echo '</li>';
                                    }
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }
}

// Add Extra Class On Comment Reply Button
function konsal_custom_comment_reply_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'konsal_custom_comment_reply_link', 99);

// Add Extra Class On Edit Comment Link
function konsal_custom_edit_comment_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $content);
}

add_filter('edit_comment_link', 'konsal_custom_edit_comment_link', 99);


function konsal_post_classes( $classes, $class, $post_id ) {
    if ( get_post_type() === 'post' ) {
        $classes[] = "th-blog blog-single";
    }elseif( get_post_type() === 'product' ){
        // Return Class
    }elseif( get_post_type() === 'page' ){
        $classes[] = "page--item";
    }
    
    return $classes;
}
add_filter( 'post_class', 'konsal_post_classes', 10, 3 );
add_filter('wpcf7_autop_or_not', '__return_false');