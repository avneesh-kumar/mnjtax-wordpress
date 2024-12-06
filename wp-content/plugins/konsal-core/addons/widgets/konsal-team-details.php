<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
/**
 *
 * Team Info Widget
 *
 */
class konsal_Team_Info extends Widget_Base{

	public function get_name() {
		return 'konsalteaminfo';
	}

	public function get_title() {
		return esc_html__( 'Team Member Info', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_member_content',
			[
				'label'		=> esc_html__( 'Member Info','konsal' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Layout Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options'		=> [
					'1'  			=> __( 'Style One', 'konsal' ),
				],
			]
		);

        $this->add_control(
			'image',
			[
				'label' 		=> __( 'Choose Image', 'konsal' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'name',
			[
				'label' 	=> esc_html__( 'Member Name', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'Angela Kwang', 'konsal' ),
                'rows' => '2'
			]
        );
        $this->add_control(
			'desig',
			[
				'label' 	=> esc_html__( 'Member Designation', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'Teacher', 'konsal' ),
                'rows' => '2'
			]
        ); 
        $this->add_control(
			'desc',
			[
				'label' 	=> esc_html__( 'Description', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'Business consulting firms offer a range of services including strategic planning,', 'konsal' ),
				'separator' => 'after',
			]
        ); 
		
		$this->add_control(
			'title',
			[
				'label' 	=> esc_html__( 'Title', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'Title', 'konsal' ),
                'rows' => '2'
			]
        );
        $this->add_control(
			'content',
			[
				'label' 	=> esc_html__( 'Contnet', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( '', 'konsal' ),
                'rows' => '6'
			]
        );
		$this->add_control(
			'title2',
			[
				'label' 	=> esc_html__( 'Title 2', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'Title', 'konsal' ),
                'rows' => '2'
			]
        );
		$this->add_control(
			'content2',
			[
				'label' 	=> esc_html__( 'Contnet 2', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( '', 'konsal' ),
                'rows' => '6'
			]
        ); 

		$this->end_controls_section();

		$this->start_controls_section(
			'team_contact_info',
			[
				'label'		=> esc_html__( 'Social Info','konsal' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fb_link',
			[
				'label' 		=> esc_html__( 'Facebook Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		$this->add_control(
			'twitter_link',
			[
				'label' 		=> esc_html__( 'Twitter Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		$this->add_control(
			'instagram_link',
			[
				'label' 		=> esc_html__( 'Instagram Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
					
				],
			]
		);
		$this->add_control(
			'linkedin_link',
			[
				'label' 		=> esc_html__( 'Linkedin Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		$this->add_control(
			'pinterest_link',
			[
				'label' 		=> esc_html__( 'Pinterest Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

        //-----------------------Styling-------------------//
        $this->start_controls_section(
            'section_title_style_section',
            [
                'label' => __( 'Style', 'konsal' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        konsal_all_elementor_style($this, 'Name', '{{WRAPPER}} .about-card_title',[ '1' ], '--title-color' );
        konsal_all_elementor_style($this, 'Designation ', '{{WRAPPER}} .about-card_desig',[ '1' ], '--theme-color' );
        konsal_all_elementor_style($this, 'Description ', '{{WRAPPER}} .about-card_text',[ '1' ], '--body-color' );
        konsal_all_elementor_style($this, 'Title ', '{{WRAPPER}} .title',[ '1' ], '--title-color' );
        konsal_all_elementor_style($this, 'Title 2 ', '{{WRAPPER}} .title2',[ '1' ], '--title-color' );

        $this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings_for_display(); 

            if( $settings['layout_style'] == '1' ){
                $f_target = $settings['fb_link']['is_external'] ? ' target="_blank"' : '';
                $f_nofollow = $settings['fb_link']['nofollow'] ? ' rel="nofollow"' : '';
                $t_target = $settings['twitter_link']['is_external'] ? ' target="_blank"' : '';
                $t_nofollow = $settings['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';
                $i_target = $settings['instagram_link']['is_external'] ? ' target="_blank"' : '';
                $i_nofollow = $settings['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';
                $l_target = $settings['linkedin_link']['is_external'] ? ' target="_blank"' : '';
                $l_nofollow = $settings['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';
                $p_target = $settings['pinterest_link']['is_external'] ? ' target="_blank"' : '';
                $p_nofollow = $settings['pinterest_link']['nofollow'] ? ' rel="nofollow"' : '';

                echo '<div class="row mb-60">';
                    echo '<div class="col-xl-6">';
                        echo '<div class="about-card-img mb-xl-0 mb-30">';
                            echo konsal_img_tag( array(
                                'url'   => esc_url( $settings['image']['url'] ),
                            ) );
                            echo '<div class="th-social">';
                                if( ! empty( $settings['fb_link']['url']) ){
                                    echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $settings['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
                                }
                                if( ! empty( $settings['twitter_link']['url']) ){
                                    echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $settings['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
                                }
                                if( ! empty( $settings['linkedin_link']['url']) ){
                                    echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $settings['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
                                }
                                if( ! empty( $settings['instagram_link']['url']) ){
                                    echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $settings['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
                                }
                                if( ! empty( $settings['pinterest_link']['url']) ){
                                    echo '<a '.wp_kses_post( $p_nofollow.$p_target ).' href="'.esc_url( $settings['pinterest_link']['url'] ).'"><i class="fab fa-pinterest-p"></i></a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="col-xl-6">';
                       echo ' <div class="about-card">';
                            if(!empty($settings['name'])){
                                    echo '<h2 class="about-card_title h3">'.esc_html($settings['name']).'</h2>';
                            }
                            if(!empty($settings['desig'])){
                                    echo '<p class="about-card_desig">'.esc_html($settings['desig']).'</p>';
                            }
                            if(!empty($settings['desc'])){
                                    echo '<p class="about-card_text">'.esc_html($settings['desc']).'</p>';
                                }
                                if(!empty($settings['title'])){
                                    echo '<h4 class="box-title title">'.esc_html($settings['title']).'</h4>';
                                }
                                if(!empty($settings['content'])){
                                    echo '<div class="checklist mb-30">';
                                        echo wp_kses_post($settings['content']);
                                    echo '</div>';
                                }
                                if(!empty($settings['title2'])){
                                    echo '<h4 class="box-title title2">'.esc_html($settings['title2']).'</h4>';
                                }
                                if(!empty($settings['content2'])){
                                    echo '<div class="checklist">';
                                        echo wp_kses_post($settings['content2']);
                                    echo '</div>';
                                }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            }

		
	}
}