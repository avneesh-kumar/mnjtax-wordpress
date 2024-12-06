<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Tab Builder Widget .
 *
 */
class Konsal_Tab_Builder extends Widget_Base {

	public function get_name() {
		return 'konsaltabbuilder';
	}
	public function get_title() {
		return __( 'Tab Builder', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
    public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'tab_builder_section',
			[
				'label' 	=> __( 'Tab Builder', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		konsal_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		$repeater = new Repeater();

		konsal_general_fields( $repeater, 'title', 'Tab Builder Title', 'TEXTAREA2', 'Tab 1' );

		$repeater->add_control( 
			'konsal_tab_builder_option',
			[
				'label'     => __( 'Tab Name', 'konsal' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->konsal_tab_builder_choose_option(),
				'default'	=> ''
			]
		);

		$this->add_control(
			'tab_builder_repeater',
			[
				'label' 		=> __( 'Tab', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title'    => __( 'Tab 1', 'konsal' ),
					],
					
				],
				'title_field' 	=> '{{{ title }}}',
				'condition'		=> [ 
					'layout_style' => [ '1', '2' ],
				],
			]
		);


        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		konsal_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .nav-link', ['1'] );


    }

	public function konsal_tab_builder_choose_option(){

		$konsal_post_query = new WP_Query( array(
			'post_type'				=> 'konsal_tab_builder',
			'posts_per_page'	    => -1,
		) );

		$konsal_tab_builder_title = array();
		$konsal_tab_builder_title[''] = __( 'Select a Tab','Foodelio');

		while( $konsal_post_query->have_posts() ) {
			$konsal_post_query->the_post();
			$konsal_tab_builder_title[ get_the_ID() ] =  get_the_title();
		}
		wp_reset_postdata();

		return $konsal_tab_builder_title;

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
        echo '<div class="schedule-wrap1">';
            echo '<ul class="nav nav-tabs schedule-tab" role="tablist">';
                $x = 0;
                    foreach( $settings['tab_builder_repeater'] as $data ){
                        $x++;
                        $active = $x == '1' ? 'active':'';
                    echo '<li class="nav-item" role="presentation">';
                        echo '<button class="nav-link '.esc_attr($active).'" id="schedule-date-tab'.esc_attr($x).'" data-bs-toggle="tab" data-bs-target="#schedule-tab'.esc_attr($x).'-content" type="button" role="tab" aria-controls="schedule-tab'.esc_attr($x).'-content" aria-selected="true">'.wp_kses_post( $data['title'] ).'</button>';
                    echo '</li>';
                }
            echo '</ul>';
            echo '<div class="tab-content schedule-tab-content">';
            $x = 0;
            foreach( $settings['tab_builder_repeater'] as $data ){
                $x++;
                $active = $x == '1' ? 'active show':'';
                    echo '<div class="tab-pane fade '.esc_attr($active).'" id="schedule-tab'.esc_attr($x).'-content" role="tabpanel" aria-labelledby="schedule-date-tab'.esc_attr($x).'">';
                        $elementor = \Elementor\Plugin::instance();
                        if( ! empty( $data['konsal_tab_builder_option'] ) ){
                            echo $elementor->frontend->get_builder_content_for_display( $data['konsal_tab_builder_option'] );
                        }
                    echo '</div>';
                }
            echo '</div>';
        echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="nav tab-menu1" role="tablist">';
				$x = 0;
				foreach( $settings['tab_builder_repeater'] as $data ){
					$x++;
					$active = $x == '1' ? 'active':'';
					echo '<button class="tab-btn '.esc_attr($active).'" id="nav-one-tab'.esc_attr($x).'" data-bs-toggle="tab" data-bs-target="#nav-one'.esc_attr($x).'" type="button" role="tab" aria-controls="nav-one'.esc_attr($x).'">';
						echo esc_html( $data['title'] );
						echo '<span class="date">'.esc_html( $data['sub'] ).'</span>';
					echo '</button>';
				}
			echo '</div>';

			echo '<div class="tab-content">';
				$x = 0;
				foreach( $settings['tab_builder_repeater'] as $data ){
					$x++;
					$active = $x == '1' ? 'active show':'';
					echo '<div class="tab-pane fade '.esc_attr($active).'" id="nav-one'.esc_attr($x).'" role="tabpanel" aria-labelledby="nav-one-tab'.esc_attr($x).'">';
						$elementor = \Elementor\Plugin::instance();
						if( ! empty( $data['konsal_tab_builder_option'] ) ){
							echo $elementor->frontend->get_builder_content_for_display( $data['konsal_tab_builder_option'] );
						}
					echo '</div>';
				}
			echo '</div>';

		}
		
      
	}
}