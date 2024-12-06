<?php
/**
* @version  1.0
* @package  konsal
* @author   Konsal <support@konsal.com>
*
* Websites: http://www.vecurosoft.com
*
*/

/**************************************
* Creating Working Hours Widget
***************************************/

class konsal_working_hours_widget extends WP_Widget {

        function __construct() {
        
            parent::__construct(
                // Base ID of your widget
                'konsal_working_hours_widget', 
            
                // Widget name will appear in UI
                esc_html__( 'Konsal :: Working Hours', 'konsal' ),
            
                // Widget description
                array( 
                    'classname'   					=> 'widget_admin',
                    'customize_selective_refresh' 	=> true,  
                    'description' 					=> esc_html__( 'Add Working Hours Widget', 'konsal' ),   
                )
            );

        }
    
        // This is where the action happens
        public function widget( $args, $instance ) {
            
            $about_img  	= ( !empty( $instance['about_img'] ) ) ? $instance['about_img'] : "";
            $label  	= ( !empty( $instance['label'] ) ) ? $instance['label'] : "";  
            $desc  			= ( !empty( $instance['desc'] ) ) ? $instance['desc'] : "";
            
            //before and after widget arguments are defined by themes
            echo '<!-- Author Widget -->';
            echo $args['before_widget']; 


            echo '<div class="about-logo">';
                if( !empty( $about_img ) ) {
                    echo '<a href="'.esc_url( home_url() ).'"><img src="'.esc_url( $about_img ).'" alt="Konsal"></a>';
                }
            echo '</div>';
            echo '<div class="themeholy-widget-schedule">';
                if( !empty( $label ) ) {
                    echo '<h4 class="title">'.esc_html( $label ).'</h4>';
                }
                if( !empty( $desc ) ) {
                    echo wp_kses_post( $desc );
                }
            echo '</div>';
            echo $args['after_widget']; 
        }
            
        // Widget Backend 
        public function form( $instance ) {
    
            // Label	
            if ( isset( $instance[ 'label' ] ) ) {
                $label = $instance[ 'label' ];
            }else {
                $label = '';
            }
			
            // Description
            if ( isset( $instance[ 'desc' ] ) ) {
                $desc = $instance[ 'desc' ];
            }else {
                $desc = '';
            }
            
            //Image
            if ( isset( $instance[ 'about_img' ] ) ) {
                $about_img = $instance[ 'about_img' ];
            }else {
                $about_img = '';
            }

            // Widget admin form
            ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'label' ); ?>"><?php _e( 'Label:' ,'konsal'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'label' ); ?>" name="<?php echo $this->get_field_name( 'label' ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>" />
            </p>
            <input class="widefat" id="<?php echo $this->get_field_id( 'about_img' ); ?>" name="<?php echo $this->get_field_name( 'about_img' ); ?>" type="text" placeholder="<?php echo esc_attr__('Image url', 'konsal'); ?>" value="<?php echo esc_attr( $about_img ); ?>" />

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php _e( 'Description:' ,'konsal'); ?></label> 
                <textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" cols="30" rows="10"><?php echo wp_kses_post( $desc ); ?></textarea>
            </p>
            <p>
               <?php echo __( 'Add Social link from ','konsal') . '<a href="'.esc_url( admin_url('admin.php?page=Konsal&tab=17') ).'">'.__('Here','konsal').'</a>'; ?>
            </p>
			
            <?php 
        }
    
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            
            $instance = array();     
            $instance['label'] 	= ( ! empty( $new_instance['label'] ) ) ? strip_tags( $new_instance['label'] ) : '';      
            $instance['desc'] 	        = ( ! empty( $new_instance['desc'] ) ) ? wp_kses_post( $new_instance['desc'] ) : '';        
            $instance['about_img'] 	    = ( ! empty( $new_instance['about_img'] ) ) ? strip_tags( $new_instance['about_img'] ) : '';
            return $instance;
        }
    } // Class konsal_working_hours_widget ends here
    

    // Register and load the widget
    function konsal_working_hours_load_widget() {
        register_widget( 'konsal_working_hours_widget' );
    }
    add_action( 'widgets_init', 'konsal_working_hours_load_widget' );