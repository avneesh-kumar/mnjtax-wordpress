<?php

$this->start_controls_section(
	'6_testimonials_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_six']]
	]
);
$this->add_control(
	'quote6',
	[
		'label' 		=> esc_html__( 'Quote Image', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
	]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'feedback', [
		'label' 		=> __( 'Feedback', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Customer' , 'konsal' ),
		'label_block' 	=> true,
	]
);

$this->add_control(
	'6_testimonials',
	[
		'label' 		=> __( 'Testimonials', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::REPEATER,
		'fields' 		=> $repeater->get_controls(),
	]
);

$this->end_controls_section();