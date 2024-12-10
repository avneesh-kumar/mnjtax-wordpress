<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Contact Info Widget .
 *
 */
class konsal_Contact_Info extends Widget_Base {

	public function get_name() {
		return 'konsalcontactinfo';
	}

	public function get_title() {
		return __( 'Contact Info', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Contact Info', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        ); 

        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Layout Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'konsal' ),
					'2'  		=> __( 'Style Two', 'konsal' ),
				],
			]
		);

        $this->add_control(
            'title', [
                'label' 		=> __( 'Title', 'konsal' ),
                'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
                'default' 		=> __( 'Title' , 'konsal' ),
                'rows' 			=> 2,
                'condition'	=> [
                    'layout_style' => ['1']
                ]
            ]
        );

        $this->add_control(
			'phone_icon',
			[
				'label' 		=> __( 'Phone Iocn', 'konsal' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 		=> '<i class="far fa-phone"></i>',
                'condition'	=> [
                    'layout_style' => ['1']
                ]
			]
		);
		$this->add_control(
			'phone',
            [
				'label'         => __( 'Phone Number', 'konsal' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( '+125 (405) 555-0128' , 'konsal' ),
				'label_block'   => true,
				'separator' => 'after',
                'condition'	=> [
                    'layout_style' => ['1']
                ]
			]
		);
		$this->add_control(
			'email_icon',
			[
				'label' 		=> __( 'Email Icon', 'konsal' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 		=> '<i class="far fa-envelope-open"></i>',
                'condition'	=> [
                    'layout_style' => ['1']
                ]
			]
		);
        $this->add_control(
			'email',
            [
				'label'         => __( 'Email Address', 'konsal' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'quick.help@gmail.com' , 'konsal' ),
				'label_block'   => true,
				'separator' => 'after',
                'condition'	=> [
                    'layout_style' => ['1']
                ]
			]
		);

        
        $this->add_control(
            'button_text', [
                'label' 		=> __( 'Button Text', 'konsal' ),
                'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
                'default' 		=> __( 'Button' , 'konsal' ),
                'condition'	=> [
                    'layout_style' => ['1']
                ]
            ]
        );
        $this->add_control(
            'map', [
                'label' 		=> __( 'Map Iframe', 'konsal' ),
                'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
                'default' 		=> __( '' , 'konsal' ),
                'condition'	=> [
                    'layout_style' => ['1']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
			'icon',
            [
				'label'         => __( 'Icon', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '' , 'konsal' ),
				'label_block'   => true,
				'rows' => '2'
			]
		);
        $repeater->add_control(
			'label',
            [
				'label'         => __( 'Label', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '' , 'konsal' ),
				'label_block'   => true,
				'rows' => '2'
			]
		);
        $repeater->add_control(
			'content',
            [
				'label'         => __( 'Content', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '' , 'konsal' ),
				'label_block'   => true,
				'rows' => '4'
			]
		);
		
		$this->add_control(
			'info_lists',
			[
				'label' 		=> __( 'Contact Info Lists', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'label' 		=> __( 'Title', 'konsal' ),
					],
				],
                'condition'	=> [
                    'layout_style' => ['2']
                ]
			]
		);

		$this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

        //---------Title Style---------//
        konsal_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .title ', ['1', '2']);

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            $email    	= $settings['email'];
            $phone    	= $settings['phone'];        
    
            $email          = is_email( $email );
    
            $replace        = array(' ','-',' - ');
            $replace_phone        = array(' ','-',' - ', '(', ')');
            $with           = array('','','');
    
            $emailurl       = str_replace( $replace, $with, $email );
            $phoneurl       = str_replace( $replace_phone, $with, $phone );	

            echo '<div class="widget footer-widget">';
                if( ! empty( $settings['title'] ) ){
                    echo '<h3 class="widget_title title">'.esc_html( $settings['title'] ).'</h3>';
                }
                echo '<div class="th-widget-contact">';
                    if(!empty($phone)){
                        echo '<div class="info-box">';
                            echo '<div class="info-box_icon">'.wp_kses_post($settings['phone_icon']).'</div>';
                            echo '<p class="info-box_text">';
                                echo '<a href="'.esc_attr( 'tel:'.$phoneurl).'" class="info-box_link">'.esc_html($phone).'</a>';
                            echo '</p>';
                        echo '</div>';
                    }
                    if(!empty($email)){
                        echo '<div class="info-box">';
                            echo '<div class="info-box_icon">'.wp_kses_post($settings['email_icon']).'</div>';
                            echo '<p class="info-box_text">';
                                echo '<a href="'.esc_attr( 'mailto:'.$emailurl).'" class="info-box_link">'.esc_html($email).'</a>';
                            echo '</p>';
                        echo '</div>';
                    }
                    if( ! empty( $settings['button_text'] ) ){
                        echo '<button type="button" class="th-btn style3 mt-15 map-modal-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">'.wp_kses_post( $settings['button_text'] ).'</button>';
                    }
                echo '</div>';
            echo '</div>';

            if( ! empty( $settings['map'] ) ){
                echo '<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close icon-btn" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="contact-map"> '.$settings['map'].' </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

        }elseif( $settings['layout_style'] == '2' ){
            foreach( $settings['info_lists'] as $data ){
                echo '<div class="contact-feature">';
                    if(!empty($data['icon'])){
                        echo '<div class="box-icon">'.wp_kses_post($data['icon']).'</div>';
                    }
                    echo '<div class="media-body">';
                        if(!empty($data['label'])){
                            echo '<h3 class="box-title h5 title">'.wp_kses_post($data['label']).'</h3>';
                        }
                        if(!empty($data['content'])){
                            echo '<p class="box-text">'.wp_kses_post($data['content']).'</p>';
                        }
                    echo '</div>';
                echo '</div>';
            }

        }
		 

	}

}