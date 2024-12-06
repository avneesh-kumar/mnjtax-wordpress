<?php

$this->start_controls_section(
	'1_counterup_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => [ 'layout_one', 'layout_two' ]]
	]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'image',
	[
		'label' 		=> esc_html__( 'Icon', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);
$repeater->add_control(
	'counter_text', [
		'label' 		=> __( 'Title', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'counter_number', [
		'label' 		=> __( 'Number', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXT,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'label_block' 	=> true,
	]
);

$repeater->add_control(
	'counter_suffix', [
		'label' 		=> __( 'After Title', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXT,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'label_block' 	=> true,
	]
);

$this->add_control(
	'counter',
	[
		'label' 		=> __( 'Counters', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::REPEATER,
		'fields' 		=> $repeater->get_controls(),
		'default' 		=> [
			[
				'counter_text' 		=> __( 'Your Name', 'konsal' ),
			],
		],
	]
);

$this->end_controls_section();