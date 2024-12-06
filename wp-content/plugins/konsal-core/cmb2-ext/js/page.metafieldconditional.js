(function($){
    "use strict";
    
    let $konsal_page_breadcrumb_area      = $("#_konsal_page_breadcrumb_area");
    let $konsal_page_settings             = $("#_konsal_page_breadcrumb_settings");
    let $konsal_page_breadcrumb_image     = $("#_konsal_breadcumb_image");
    let $konsal_page_title                = $("#_konsal_page_title");
    let $konsal_page_title_settings       = $("#_konsal_page_title_settings");

    if( $konsal_page_breadcrumb_area.val() == '1' ) {
        $(".cmb2-id--konsal-page-breadcrumb-settings").show();
        if( $konsal_page_settings.val() == 'global' ) {
            $(".cmb2-id--konsal-breadcumb-image").hide();
            $(".cmb2-id--konsal-page-title").hide();
            $(".cmb2-id--konsal-page-title-settings").hide();
            $(".cmb2-id--konsal-custom-page-title").hide();
            $(".cmb2-id--konsal-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--konsal-breadcumb-image").show();
            $(".cmb2-id--konsal-page-title").show();
            $(".cmb2-id--konsal-page-breadcrumb-trigger").show();
    
            if( $konsal_page_title.val() == '1' ) {
                $(".cmb2-id--konsal-page-title-settings").show();
                if( $konsal_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--konsal-custom-page-title").hide();
                } else {
                    $(".cmb2-id--konsal-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--konsal-page-title-settings").hide();
                $(".cmb2-id--konsal-custom-page-title").hide();
    
            }
        }
    } else {
        $konsal_page_breadcrumb_area.parents('.cmb2-id--konsal-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $konsal_page_breadcrumb_area.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--konsal-page-breadcrumb-settings").show();
            if( $konsal_page_settings.val() == 'global' ) {
                $(".cmb2-id--konsal-breadcumb-image").hide();
                $(".cmb2-id--konsal-page-title").hide();
                $(".cmb2-id--konsal-page-title-settings").hide();
                $(".cmb2-id--konsal-custom-page-title").hide();
                $(".cmb2-id--konsal-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--konsal-breadcumb-image").show();
                $(".cmb2-id--konsal-page-title").show();
                $(".cmb2-id--konsal-page-breadcrumb-trigger").show();
        
                if( $konsal_page_title.val() == '1' ) {
                    $(".cmb2-id--konsal-page-title-settings").show();
                    if( $konsal_page_title_settings.val() == 'default' ) {
                        $(".cmb2-id--konsal-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--konsal-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--konsal-page-title-settings").hide();
                    $(".cmb2-id--konsal-custom-page-title").hide();
        
                }
            }
        } else {
            $(this).parents('.cmb2-id--konsal-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $konsal_page_title.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--konsal-page-title-settings").show();
            if( $konsal_page_title_settings.val() == 'default' ) {
                $(".cmb2-id--konsal-custom-page-title").hide();
            } else {
                $(".cmb2-id--konsal-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--konsal-page-title-settings").hide();
            $(".cmb2-id--konsal-custom-page-title").hide();

        }
    });

    //page settings
    $konsal_page_settings.on("change",function(){
        if( $(this).val() == 'global' ) {
            $(".cmb2-id--konsal-breadcumb-image").hide();
            $(".cmb2-id--konsal-page-title").hide();
            $(".cmb2-id--konsal-page-title-settings").hide();
            $(".cmb2-id--konsal-custom-page-title").hide();
            $(".cmb2-id--konsal-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--konsal-breadcumb-image").show();
            $(".cmb2-id--konsal-page-title").show();
            $(".cmb2-id--konsal-page-breadcrumb-trigger").show();
    
            if( $konsal_page_title.val() == '1' ) {
                $(".cmb2-id--konsal-page-title-settings").show();
                if( $konsal_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--konsal-custom-page-title").hide();
                } else {
                    $(".cmb2-id--konsal-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--konsal-page-title-settings").hide();
                $(".cmb2-id--konsal-custom-page-title").hide();
    
            }
        }
    });

    // page title settings
    $konsal_page_title_settings.on("change",function(){
        if( $(this).val() == 'default' ) {
            $(".cmb2-id--konsal-custom-page-title").hide();
        } else {
            $(".cmb2-id--konsal-custom-page-title").show();
        }
    });
    
})(jQuery);