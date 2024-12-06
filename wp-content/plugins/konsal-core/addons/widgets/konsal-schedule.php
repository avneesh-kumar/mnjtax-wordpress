<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Schedule Widget.
 *
 */
class Konsal_Schedule extends Widget_Base {

	public function get_name() {
		return 'konsalschedule';
	}
	public function get_title() {
		return __( 'Schedule', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'schedule_section',
			[
				'label' 	=> __( 'Schedule', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		konsal_select_field( $this, 'layout_style', 'Layout Style', ['Style One'] ); 

        konsal_general_fields($this, 'head1', 'Heading 1', 'TEXTAREA2', 'Speakers');
        konsal_general_fields($this, 'head2', 'Heading 2', 'TEXTAREA2', 'Session');
        konsal_general_fields($this, 'head3', 'Heading 3', 'TEXTAREA2', 'Time');
        konsal_general_fields($this, 'head4', 'Heading 4', 'TEXTAREA2', 'Venue');

		$repeater = new Repeater();

		konsal_media_fields($repeater, 'image', 'Choose Image');
		konsal_general_fields($repeater, 'name', 'Name', 'TEXTAREA2', 'Jhon Smith');
		konsal_general_fields($repeater, 'sessions', 'Sessions Name', 'TEXTAREA2', 'Breakout Sessions');
		konsal_general_fields($repeater, 'time', 'Time', 'TEXTAREA2', '11:45 AM');
		konsal_general_fields($repeater, 'venue', 'Venue', 'TEXTAREA2', 'Main Stage');

		$this->add_control(
			'schedule_slides',
			[
				'label' 		=> __( 'Schedules', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'name' 	=> __( 'Jhon Smith', 'konsal' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

        		//-------General Style-------
		 $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Background Styling', 'konsal' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		konsal_color_fields( $this, 'bg', 'Heading Background', 'background', '{{WRAPPER}} .schedule_table thead tr' );                      

		$this->end_controls_section();

		konsal_common_style_fields( $this, 'heading', 'Heading', '{{WRAPPER}} .schedule_table th' );


    }

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
        echo '<table class="schedule_table">';
            echo '<thead>';
                echo '<tr>';
                    if(!empty($settings['head1'])){
                        echo '<th class="schedule-col-speaker">'.wp_kses_post($settings['head1']).'</th>';
                    }
                    if(!empty($settings['head2'])){
                        echo '<th class="schedule-col-session">'.wp_kses_post($settings['head2']).'</th>';
                    }
                    if(!empty($settings['head3'])){
                        echo '<th class="schedule-col-time">'.wp_kses_post($settings['head3']).'</th>';
                    }
                    if(!empty($settings['head4'])){
                        echo '<th class="schedule-col-venue">'.wp_kses_post($settings['head4']).'</th>';
                    }
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach( $settings['schedule_slides'] as $data ){
                echo '<tr class="schedule_item">';
                    echo '<td data-title="Speaker">';
                        echo '<div class="schedule-speaker">';
                            if( ! empty( $data['image']['url'] ) ){
                                echo '<img width="56" height="56" src="'.esc_url( $data['image']['url'] ).'" alt="'.esc_attr__('Image', 'konsal').'">';
                            }
                            if(!empty($data['name'])){
                                echo '<div class="schedule-speakername">'.esc_html($data['name']).'</div>';
                            }
                        echo '</div>';
                    echo '</td>';
                    if(!empty($data['sessions'])){
                        echo '<td data-title="Session">';
                            echo '<span class="schedule-session">'.esc_html($data['sessions']).'</span>';
                        echo '</td>';
                    }
                    if(!empty($data['time'])){
                        echo '<td data-title="Time">';
                            echo '<div class="schedule-time">'.esc_html($data['time']).'</div>';
                        echo '</td>';
                    }
                    if(!empty($data['venue'])){
                        echo '<td data-title="Vanue">';
                            echo '<span class="schedule-vanue">'.esc_html($data['venue']).'</span>';
                        echo '</td>';
                    }
                echo '</tr>';
            }
            echo '</tbody>';
        echo '</table>';
           
		}elseif( $settings['layout_style'] == '2' ){
		

		}

		
	}

}