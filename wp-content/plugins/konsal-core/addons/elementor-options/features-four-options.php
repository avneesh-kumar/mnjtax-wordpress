<?php

$this->start_controls_section(
	'2_feature_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_four']]
	]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'title', [
		'label' 		=> __( 'Title', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Title' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'content', [
		'label' 		=> __( 'Content', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Content' , 'konsal' ),
		'rows' 			=> 6,
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
	'image2',
	[
		'label' 		=> esc_html__( 'Image 2', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);
$repeater->add_control(
	'phone_label', [
		'label' 		=> __( 'Phone Label', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'CALL US TO GET A FREE QUOTE' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'phone', [
		'label' 		=> __( 'Phone Number', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( '+112 (789) 568 25' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);

$this->add_control(
	'features_2',
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