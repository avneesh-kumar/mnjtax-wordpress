<?php

$this->start_controls_section(
	'6_feature_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_six']]
	]
);

$this->add_control(
	'shape',
	[
		'label' 		=> esc_html__( 'Shape', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
	]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'title', [
		'label' 		=> __( 'Title', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ), 
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'content', [
		'label' 		=> __( 'Content', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 4,
		'label_block' 	=> true,
	]
);

$repeater->add_control(
	'image',
	[
		'label' 		=> esc_html__( 'Image', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);
$repeater->add_control(
	'icon',
	[
		'label' 		=> esc_html__( 'Icon', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);


$this->add_control(
	'features2',
	[
		'label' 		=> __( 'Features', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::REPEATER,
		'fields' 		=> $repeater->get_controls(),
		'default' 		=> [
			[
				'title' 		=> __( 'Your Name', 'konsal' ),
			],
		],
		'title_field' 	=> '{{{ title }}}',
	]
);

$this->end_controls_section();