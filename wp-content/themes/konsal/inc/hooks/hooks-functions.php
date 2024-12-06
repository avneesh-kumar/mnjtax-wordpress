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
        exit();
    }


    // preloader hook function
    if( ! function_exists( 'konsal_preloader_wrap_cb' ) ) {
        function konsal_preloader_wrap_cb() {
            $preloader_display              =  konsal_opt('konsal_display_preloader');

            if( class_exists('ReduxFramework') ){
                if( $preloader_display ){
                    echo '<div class="preloader">';
                        echo '<button class="th-btn preloaderCls">'.esc_html__( 'Cancel Preloader', 'konsal' ).'</button>';
                        echo '<div class="preloader-inner">';
                            if( ! empty( konsal_opt( 'konsal_preloader_img','url' ) ) ){
                                echo konsal_img_tag( array(
                                    'url'   => esc_url( konsal_opt( 'konsal_preloader_img','url' ) ),
                                    'class' => 'loader-img',
                                ) );  
                            }else{
                               echo '<span class="loader"></span>';
                            }
                        echo '</div>';
                    echo '</div>';
                }
            }else{
                echo '<div class="preloader">';
                    echo '<button class="th-btn preloaderCls">'.esc_html__( 'Cancel Preloader', 'konsal' ).'</button>';
                    echo '<div class="preloader-inner">';
                        echo '<span class="loader"></span>';
                    echo '</div>';
                echo '</div>';
            }
        }
    }

    // Header Hook function
    if( !function_exists('konsal_header_cb') ) {
        function konsal_header_cb( ) {
            get_template_part('templates/header');
            get_template_part('templates/header-menu-bottom');
        }
    }

    // back top top hook function
    if( ! function_exists( 'konsal_back_to_top_cb' ) ) {
        function konsal_back_to_top_cb( ) {
            $backtotop_trigger = konsal_opt('konsal_display_bcktotop');

            if( class_exists( 'ReduxFramework' ) ) {
                if( $backtotop_trigger ) {
                    echo '<div class="scroll-top">';
                        echo '<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
                            </svg>';
                    echo '</div>';
                }
            }

        }
    }

    // Blog Start Wrapper Function
    if( !function_exists('konsal_blog_start_wrap_cb') ) {
        function konsal_blog_start_wrap_cb() {
            echo '<section class="th-blog-wrapper space-top space-extra-bottom arrow-wrap">';
                echo '<div class="container">';
                    echo '<div class="row gx-40">';
        }
    }

    // Blog End Wrapper Function
    if( !function_exists('konsal_blog_end_wrap_cb') ) {
        function konsal_blog_end_wrap_cb() {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // Blog Column Start Wrapper Function
    if( !function_exists('konsal_blog_col_start_wrap_cb') ) {
        function konsal_blog_col_start_wrap_cb() {
            if( class_exists('ReduxFramework') ) {
                $konsal_blog_sidebar = konsal_opt('konsal_blog_sidebar');
                if( $konsal_blog_sidebar == '2' && is_active_sidebar('konsal-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7 order-lg-last">';
                } elseif( $konsal_blog_sidebar == '3' && is_active_sidebar('konsal-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('konsal-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }
    // Blog Column End Wrapper Function
    if( !function_exists('konsal_blog_col_end_wrap_cb') ) {
        function konsal_blog_col_end_wrap_cb() {
            echo '</div>';
        }
    }

    // Blog Sidebar
    if( !function_exists('konsal_blog_sidebar_cb') ) {
        function konsal_blog_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_blog_sidebar = konsal_opt('konsal_blog_sidebar');
            } else {
                $konsal_blog_sidebar = 2;
                
            }
            if( $konsal_blog_sidebar != 1 && is_active_sidebar('konsal-blog-sidebar') ) {
                // Sidebar
                get_sidebar();
            }
        }
    }


    if( !function_exists('konsal_blog_details_sidebar_cb') ) {
        function konsal_blog_details_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_blog_single_sidebar = konsal_opt('konsal_blog_single_sidebar');
            } else {
                $konsal_blog_single_sidebar = 4;
            }
            if( $konsal_blog_single_sidebar != 1 ) {
                // Sidebar
                get_sidebar();
            }

        }
    }

    // Blog Pagination Function
    if( !function_exists('konsal_blog_pagination_cb') ) {
        function konsal_blog_pagination_cb( ) {
            get_template_part('templates/pagination');
        }
    }

    // Blog Content Function
    if( !function_exists('konsal_blog_content_cb') ) {
        function konsal_blog_content_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_blog_grid = konsal_opt('konsal_blog_grid');
            } else {
                $konsal_blog_grid = '1';
            }

            if( $konsal_blog_grid == '1' ) {
                $konsal_blog_grid_class = 'col-lg-12';
            } elseif( $konsal_blog_grid == '2' ) {
                $konsal_blog_grid_class = 'col-sm-6';
            } else {
                $konsal_blog_grid_class = 'col-lg-4 col-sm-6';
            }

            echo '<div class="row">';
                if( have_posts() ) {
                    while( have_posts() ) {
                        the_post();
                        echo '<div class="'.esc_attr($konsal_blog_grid_class).'">';
                            get_template_part('templates/content',get_post_format());
                        echo '</div>';
                    }
                    wp_reset_postdata();
                } else{
                    get_template_part('templates/content','none');
                }
            echo '</div>';
        }
    }

    // footer content Function
    if( !function_exists('konsal_footer_content_cb') ) {
        function konsal_footer_content_cb( ) {

            if( class_exists('ReduxFramework') && did_action( 'elementor/loaded' )  ){
                if( is_page() || is_page_template('template-builder.php') ) {
                    $post_id = get_the_ID();

                    // Get the page settings manager
                    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

                    // Get the settings model for current post
                    $page_settings_model = $page_settings_manager->get_model( $post_id );

                    // Retrieve the Footer Style
                    $footer_settings = $page_settings_model->get_settings( 'konsal_footer_style' );

                    // Footer Local
                    $footer_local = $page_settings_model->get_settings( 'konsal_footer_builder_option' );

                    // Footer Enable Disable
                    $footer_enable_disable = $page_settings_model->get_settings( 'konsal_footer_choice' );

                    if( $footer_enable_disable == 'yes' ){
                        if( $footer_settings == 'footer_builder' ) {
                            // local options
                            $konsal_local_footer = get_post( $footer_local );
                            echo '<footer>';
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $konsal_local_footer->ID );
                            echo '</footer>';
                        } else {
                            // global options
                            $konsal_footer_builder_trigger = konsal_opt('konsal_footer_builder_trigger');
                            if( $konsal_footer_builder_trigger == 'footer_builder' ) {
                                echo '<footer>';
                                $konsal_global_footer_select = get_post( konsal_opt( 'konsal_footer_builder_select' ) );
                                $footer_post = get_post( $konsal_global_footer_select );
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                                echo '</footer>';
                            } else {
                                // wordpress widgets
                                konsal_footer_global_option();
                            }
                        }
                    }
                } else {
                    // global options
                    $konsal_footer_builder_trigger = konsal_opt('konsal_footer_builder_trigger');
                    if( $konsal_footer_builder_trigger == 'footer_builder' ) {
                        echo '<footer>';
                        $konsal_global_footer_select = get_post( konsal_opt( 'konsal_footer_builder_select' ) );
                        $footer_post = get_post( $konsal_global_footer_select );
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                        echo '</footer>';
                    } else {
                        // wordpress widgets
                        konsal_footer_global_option();
                    }
                }
            } else {
                echo '<div class="footer-wrapper footer-sitcky">';
                    echo '<div class="copyright-wrap">';
                        echo '<div class="container">';
                            echo '<p class="copyright-text text-center">'.sprintf( 'Copyright <i class="fal fa-copyright"></i> %s <a href="%s">%s</a> All Rights Reserved by <a href="%s">%s</a>',date('Y'),esc_url('#'),__( 'Konsal.','konsal' ),esc_url('https://themeforest.net/user/th'),__( 'Themeholy', 'konsal' ) ).'</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }

        }
    }

    // blog details wrapper start hook function
    if( !function_exists('konsal_blog_details_wrapper_start_cb') ) {
        function konsal_blog_details_wrapper_start_cb( ) {
            echo '<section class="th-blog-wrapper blog-details space-top space-extra-bottom">';
                echo '<div class="container">';
                    
                    echo '<div class="row gx-40">';
        }
    }

    // blog details column wrapper start hook function
    if( !function_exists('konsal_blog_details_col_start_cb') ) {
        function konsal_blog_details_col_start_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_blog_single_sidebar = konsal_opt('konsal_blog_single_sidebar');
                if( $konsal_blog_single_sidebar == '2' && is_active_sidebar('konsal-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7 order-last">';
                } elseif( $konsal_blog_single_sidebar == '3' && is_active_sidebar('konsal-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('konsal-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }

    // blog details post meta hook function
    if( !function_exists('konsal_blog_post_meta_cb') ) {
        function konsal_blog_post_meta_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_display_post_cate   =  konsal_opt('konsal_display_post_cate');
                $konsal_display_post_date      =  konsal_opt('konsal_display_post_date');
                $konsal_display_post_author      =  konsal_opt('konsal_display_post_author');
                $konsal_display_post_comment      =  konsal_opt('konsal_display_post_comment');
            } else {
                $konsal_display_post_cate   = '';
                $konsal_display_post_date      = '1';
                $konsal_display_post_author      = '1';
                $konsal_display_post_comment      = '1';
            }

            echo '<!-- Blog Meta -->';
                echo '<div class="blog-meta">';
                    if( $konsal_display_post_author ){
                        echo '<a class="author" href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">';

                        echo '<i class="far fa-user"></i>';
                        echo esc_html__('By ', 'konsal') . esc_html( ucwords( get_the_author() ) );
                        echo '</a>';
                    }
                    if( $konsal_display_post_date ){
                        echo '<a href="'.esc_url( konsal_blog_date_permalink() ).'"><i class="fa-light fa-calendar-days"></i>';
                            echo '<time datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time>';
                        echo '</a>';
                    }
                    if( $konsal_display_post_comment ){
                        if( get_comments_number() == 1 ){
                            $comment_text = __( ' Comment', 'konsal' );
                        }else{
                            $comment_text = __( ' Comments', 'konsal' );
                        }

                        echo '<a href="'.esc_url( get_comments_link( get_the_ID() ) ).'"><i class="far fa-comments"></i>'.esc_html( get_comments_number() ).''.$comment_text.'</a>';
                    }
                    if( $konsal_display_post_cate ){
                        $categories = get_the_category();  
                        echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'"><i class="far fa-tags"></i>'.esc_html( $categories[0]->name ).'</a>';
                    }
                echo '</div>';
        }
    }

    // blog details share options hook function
    if( !function_exists('konsal_blog_details_share_options_cb') ) {
        function konsal_blog_details_share_options_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_post_details_share_options = konsal_opt('konsal_post_details_share_options');
            } else {
                $konsal_post_details_share_options = false;
            }
            if( function_exists( 'konsal_social_sharing_buttons' ) && $konsal_post_details_share_options ) {
                echo '<div class="col-md-auto text-xl-end">';
                echo '<span class="share-links-title">'.__( 'Share:', 'konsal' ).'</span>';
                    echo '<ul class="social-links">';
                        echo konsal_social_sharing_buttons();
                    echo '</ul>';
                    echo '<!-- End Social Share -->';
                echo '</div>';
            }
        }
    }

    // Blog Details Post Navigation hook function
    if( !function_exists( 'konsal_blog_details_post_navigation_cb' ) ) {
        function konsal_blog_details_post_navigation_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_post_details_post_navigation = konsal_opt('konsal_post_details_post_navigation');
            } else {
                $konsal_post_details_post_navigation = true;
            }

            $prevpost = get_previous_post();
            $nextpost = get_next_post();

            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );

            if( $konsal_post_details_post_navigation && ! empty( $prevpost ) || !empty( $nextpost ) ) {
                echo '<div class="blog-navigation">';
                    echo '<div>';
                        if( ! empty( $prevpost ) ) {
                            echo '<a href="'.esc_url( get_permalink( $prevpost->ID ) ).'" class="nav-btn prev">';
                            if( class_exists('ReduxFramework') ) {
                                if (has_post_thumbnail( $prevpost->ID )) {
                                    echo get_the_post_thumbnail( $prevpost->ID, 'konsal_80X80' );
                                };
                            }
                                echo '<span class="nav-text">'.esc_html__( ' Previous Post', 'konsal' ).'</span>';
                            echo '</a>';
                        }
                    echo '</div>';

                    echo '<a href="'.get_permalink( get_option( 'page_for_posts' ) ).'" class="blog-btn"><i class="fa-solid fa-grid"></i></a>';

                    echo '<div>';
                        if( ! empty( $nextpost ) ) {
                            echo '<a href="'.esc_url( get_permalink( $nextpost->ID ) ).'" class="nav-btn next">';
                                if( class_exists('ReduxFramework') ) {
                                    if (has_post_thumbnail($nextpost->ID)) {
                                        echo get_the_post_thumbnail( $nextpost->ID, 'konsal_80X80' );
                                    };
                                }
                                echo '<span class="nav-text">'.esc_html__( ' Next Post', 'konsal' ).'</span>';
                            echo '</a>';
                        }
                    echo '</div>';
                echo '</div>';
            }
        }
    }
    
    // blog details author bio hook function
    if( !function_exists('konsal_blog_details_author_bio_cb') ) { 
        function konsal_blog_details_author_bio_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $postauthorbox =  konsal_opt( 'konsal_post_details_author_desc_trigger' );
            } else {
                $postauthorbox = '1';
            }
            if( !empty( get_the_author_meta('description')  ) && $postauthorbox == '1' ) {
                 echo '<div class="blog-author">';
                    echo '<div class="auhtor-img">';
                        echo konsal_img_tag( array(
                        "url"   => esc_url( get_avatar_url( get_the_author_meta('ID'), array(
                            "size"  => '140'
                            ) ) ),
                        ) );
                    echo '</div>';
                    echo '<div class="media-body">';
                        echo '<div class="media">';
                            echo '<div class="media-left">';
                                echo '<h3 class="author-name"><a class="text-inherit" href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">'.esc_html( ucwords( get_the_author() ) ).'</a></h3>';

                                $designation = get_user_meta( get_the_author_meta('ID'), '_konsal_user_designation',true );

                                if( !empty( $designation ) ){
                                    echo '<span class="author-desig">'.esc_html( $designation ).'</span>';
                                }
                            echo '</div>';

                            $konsal_social_icons = get_user_meta( get_the_author_meta('ID'), '_konsal_social_profile_group',true );
                            if( is_array( $konsal_social_icons ) && !empty( $konsal_social_icons ) ) {
                                echo '<div class="media-body text-end">';
                                    echo '<div class="th-social style2 align-items-center">';
                                        foreach( $konsal_social_icons as $singleicon ) {
                                            if( ! empty( $singleicon['_konsal_social_profile_icon'] ) ) {
                                                echo '<a href="'.esc_url( $singleicon['_konsal_lawyer_social_profile_link'] ).'"><i class="'.esc_attr( $singleicon['_konsal_social_profile_icon'] ).'"></i></a>';
                                            }
                                        }
                                    echo '</div>';
                                echo '</div>';
                            }
                        echo '</div>';
                        if( ! empty( get_the_author_meta('description') ) ) {
                            echo '<p class="author-text">';
                                echo esc_html( get_the_author_meta('description') );
                            echo '</p>';
                        }
                    echo '</div>';
                echo '</div>';
            }

        }
    }

    // Blog Details Comments hook function
    if( !function_exists('konsal_blog_details_comments_cb') ) {
        function konsal_blog_details_comments_cb( ) {
            if ( ! comments_open() ) {
                echo '<div class="blog-comment-area">';
                    echo konsal_heading_tag( array(
                        "tag"   => "h3",
                        "text"  => esc_html__( 'Comments are closed', 'konsal' ),
                        "class" => "inner-title"
                    ) );
                echo '</div>';
            }

            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
    }

    // Blog Details Column end hook function
    if( !function_exists('konsal_blog_details_col_end_cb') ) {
        function konsal_blog_details_col_end_cb( ) {
            echo '</div>';
        }
    }

    // Blog Details Wrapper end hook function
    if( !function_exists('konsal_blog_details_wrapper_end_cb') ) {
        function konsal_blog_details_wrapper_end_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page start wrapper hook function
    if( !function_exists('konsal_page_start_wrap_cb') ) {
        function konsal_page_start_wrap_cb( ) {
            
            if( is_page( 'cart' ) ){
                $section_class = "th-cart-wrapper space-top space-extra-bottom";
            }elseif( is_page( 'checkout' ) ){
                $section_class = "th-checkout-wrapper space-top space-extra-bottom";
            }elseif( is_page('wishlist') ){
                $section_class = "wishlist-area space-top space-extra-bottom";
            }else{
                $section_class = "space-top space-extra-bottom";  
            }
            echo '<section class="'.esc_attr( $section_class ).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
        }
    }

    // page wrapper end hook function
    if( !function_exists('konsal_page_end_wrap_cb') ) {
        function konsal_page_end_wrap_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page column wrapper start hook function
    if( !function_exists('konsal_page_col_start_wrap_cb') ) {
        function konsal_page_col_start_wrap_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_page_sidebar = konsal_opt('konsal_page_sidebar');
            }else {
                $konsal_page_sidebar = '1';
            }
            if( $konsal_page_sidebar == '2' && is_active_sidebar('konsal-page-sidebar') ) {
                echo '<div class="col-xxl-8 col-lg-7 order-last">';
            } elseif( $konsal_page_sidebar == '3' && is_active_sidebar('konsal-page-sidebar') ) {
                echo '<div class="col-xxl-8 col-lg-7">';
            } else {
                echo '<div class="col-lg-12">';
            }

        }
    }

    // page column wrapper end hook function
    if( !function_exists('konsal_page_col_end_wrap_cb') ) {
        function konsal_page_col_end_wrap_cb( ) {
            echo '</div>';
        }
    }

    // page sidebar hook function
    if( !function_exists('konsal_page_sidebar_cb') ) {
        function konsal_page_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $konsal_page_sidebar = konsal_opt('konsal_page_sidebar');
            }else {
                $konsal_page_sidebar = '1';
            }

            if( class_exists('ReduxFramework') ) {
                $konsal_page_layoutopt = konsal_opt('konsal_page_layoutopt');
            }else {
                $konsal_page_layoutopt = '3';
            }

            if( $konsal_page_layoutopt == '1' && $konsal_page_sidebar != 1 ) {
                get_sidebar('page');
            } elseif( $konsal_page_layoutopt == '2' && $konsal_page_sidebar != 1 ) {
                get_sidebar();
            }
        }
    }

    // page content hook function
    if( !function_exists('konsal_page_content_cb') ) {
        function konsal_page_content_cb( ) {
            if(  class_exists('woocommerce') && ( is_woocommerce() || is_cart() || is_checkout() || is_page('wishlist') || is_account_page() )  ) {
                echo '<div class="woocommerce--content">';
            } else {
                echo '<div class="page--content clearfix">';
            }

                the_content();

                // Link Pages
                konsal_link_pages();

            echo '</div>';
            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        }
    }

    if( !function_exists('konsal_blog_post_thumb_cb') ) {
        function konsal_blog_post_thumb_cb( ) {
            if( get_post_format() ) {
                $format = get_post_format();
            }else{
                $format = 'standard';
            }

            $konsal_post_slider_thumbnail = konsal_meta( 'post_format_slider' );

            if( !empty( $konsal_post_slider_thumbnail ) ){
                echo '<div class="blog-img th-slider" data-slider-options=\'{"effect":"fade"}\'>';
                    echo '<div class="swiper-wrapper">';
                        foreach( $konsal_post_slider_thumbnail as $single_image ){
                            echo '<div class="swiper-slide">';
                                echo konsal_img_tag( array(
                                    'url'   => esc_url( $single_image )
                                ) );
                            echo '</div>';
                        }
                    echo '</div>';
                echo '<button class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
                echo '<button class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
            echo '</div>';
            }elseif( has_post_thumbnail() && $format == 'standard' ) {
                echo '<!-- Post Thumbnail -->';
                echo '<div class="blog-img">';
                    if( ! is_single() ){
                        echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                    }

                    the_post_thumbnail();

                    if( ! is_single() ){
                        echo '</a>';
                    }
                echo '</div>';
                echo '<!-- End Post Thumbnail -->';
            }elseif( $format == 'video' ){
                if( has_post_thumbnail() && ! empty ( konsal_meta( 'post_format_video' ) ) ){
                    echo '<div class="blog-img">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            the_post_thumbnail();
                        if( ! is_single() ){
                            echo '</a>';
                        }
                        echo '<a href="'.esc_url( konsal_meta( 'post_format_video' ) ).'" class="play-btn popup-video">';
                            echo '<i class="fas fa-play"></i>';
                        echo '</a>';
                    echo '</div>';
                }elseif( ! has_post_thumbnail() && ! is_single() ){
                    echo '<div class="blog-video">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            echo konsal_embedded_media( array( 'video', 'iframe' ) );
                        if( ! is_single() ){
                            echo '</a>';
                        }
                    echo '</div>';
                }
            }elseif( $format == 'audio' ){
                $konsal_audio = konsal_meta( 'post_format_audio' );
                if( ! empty( $konsal_audio ) ){
                    echo '<div class="blog-audio">';
                        echo wp_oembed_get( $konsal_audio );
                    echo '</div>';
                }elseif( ! is_single() ){
                    echo '<div class="blog-audio">';
                        echo wp_oembed_get( $konsal_audio );
                    echo '</div>';
                }
            }

        }
    }

    if( !function_exists('konsal_blog_post_content_cb') ) {
        function konsal_blog_post_content_cb( ) {
            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );
            if( class_exists( 'ReduxFramework' ) ) {
                $konsal_excerpt_length          = konsal_opt( 'konsal_blog_postExcerpt' );
                $konsal_display_post_category   = konsal_opt( 'konsal_display_post_category' );
            } else {
                $konsal_excerpt_length          = '48';
                $konsal_display_post_category   = '1';
            }

            if( class_exists( 'ReduxFramework' ) ) {
                $konsal_blog_admin = konsal_opt( 'konsal_blog_post_author' );
                $konsal_blog_readmore_setting_val = konsal_opt('konsal_blog_readmore_setting');
                if( $konsal_blog_readmore_setting_val == 'custom' ) {
                    $konsal_blog_readmore_setting = konsal_opt('konsal_blog_custom_readmore');
                } else {
                    $konsal_blog_readmore_setting = __( 'Read More', 'konsal' );
                }
            } else {
                $konsal_blog_readmore_setting = __( 'Read More', 'konsal' );
                $konsal_blog_admin = true;
            }
            echo '<!-- blog-content -->';

                do_action( 'konsal_blog_post_thumb' );
                
                echo '<div class="blog-content">';

                    // Blog Post Meta
                    do_action( 'konsal_blog_post_meta' );

                    echo '<!-- Post Title -->';
                    echo '<h2 class="blog-title"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title( ), $allowhtml ).'</a></h2>';
                    echo '<!-- End Post Title -->';

                    echo '<!-- Post Summary -->';
                        echo konsal_paragraph_tag( array(
                            "text"  => wp_kses( wp_trim_words( get_the_excerpt(), $konsal_excerpt_length, '' ), $allowhtml ),
                            "class" => 'blog-text',
                        ) );

                        if( !empty( $konsal_blog_readmore_setting ) ){
                            echo '<!-- Button -->';
                                echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn">'.esc_html( $konsal_blog_readmore_setting ).' <div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
                            echo '<!-- End Button -->';
                        }
                    echo '<!-- End Post Summary -->';
                echo '</div>';
            echo '<!-- End Post Content -->';
        }
    }