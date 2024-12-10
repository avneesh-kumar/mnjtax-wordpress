<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Konsal
 * @Author URI : https://www.themeholy.com/
 *
 */


// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

function konsal_core_essential_scripts( ) {
    wp_enqueue_script('konsal-ajax',KONSAL_PLUGDIRURI.'assets/js/konsal.ajax.js',array( 'jquery' ),'1.0',true);
    wp_localize_script(
    'konsal-ajax',
    'konsalajax',
        array(
            'action_url' => admin_url( 'admin-ajax.php' ),
            'nonce'	     => wp_create_nonce( 'konsal-nonce' ),
        )
    );
}

add_action('wp_enqueue_scripts','konsal_core_essential_scripts');


// konsal Section subscribe ajax callback function
add_action( 'wp_ajax_konsal_subscribe_ajax', 'konsal_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_konsal_subscribe_ajax', 'konsal_subscribe_ajax' );

function konsal_subscribe_ajax( ){
  $apiKey = konsal_opt('konsal_subscribe_apikey');
  $listid = konsal_opt('konsal_subscribe_listid');
   if( ! wp_verify_nonce($_POST['security'], 'konsal-nonce') ) {
    echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('You are not allowed.', 'konsal').'</div>';
   }else{
       if( !empty( $apiKey ) && !empty( $listid )  ){
           $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

           $result = $MailChimp->post("lists/{$listid}/members",[
               'email_address'    => esc_attr( $_POST['sectsubscribe_email'] ),
               'status'           => 'subscribed',
           ]);

           if ($MailChimp->success()) {
               if( $result['status'] == 'subscribed' ){
                   echo '<div class="alert alert-success mt-2" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'konsal').'</div>';
               }
           }elseif( $result['status'] == '400' ) {
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('This Email address is already exists.', 'konsal').'</div>';
           }else{
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Sorry something went wrong.', 'konsal').'</div>';
           }
        }else{
           echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'konsal').'</div>';
        }
   }

   wp_die();

}

add_action('wp_ajax_konsal_addtocart_notification','konsal_addtocart_notification');
add_action('wp_ajax_nopriv_konsal_addtocart_notification','konsal_addtocart_notification');
function konsal_addtocart_notification(){

    $_product = wc_get_product($_POST['prodid']);
    $response = [
        'img_url'   => esc_url( wp_get_attachment_image_src( $_product->get_image_id(),array('60','60'))[0] ),
        'title'     => wp_kses_post( $_product->get_title() )
    ];
    echo json_encode($response);

    wp_die();
}