<?php

$this->start_controls_section(
	'1_feature_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_one', 'layout_two', 'layout_three', 'layout_five']]
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


$this->add_control(
	'features',
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