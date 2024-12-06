<?php

$this->start_controls_section(
	'3_banner_section',
	[
		'label'     => __( 'Banner', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_three']]
	]
);
$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'1_heading', [
		'label' 		=> __( 'Heading', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'1_title1', [
		'label' 		=> __( 'Title 1', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'1_title2', [
		'label' 		=> __( 'Title 2', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'1_desc', [
		'label' 		=> __( 'Description', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'1_button_text',
	[
		'label' 	=> esc_html__( 'Button Text', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXT,
        'default'  	=> esc_html__( 'Choose Plan', 'konsal' ),
	]
);

$repeater->add_control(
	'1_button_link',
	[
		'label' 		=> esc_html__( 'Link', 'konsal' ),
		'type' 		=> \Elementor\Controls_Manager::TEXT,
		'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
		'show_external' => true,
	]
);

$repeater->add_control(
	'1_image',
	[
		'label' 		=> esc_html__( 'Image', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);
$repeater->add_control(
	'2_image',
	[
		'label' 		=> esc_html__( 'Image 2', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);
$repeater->add_control(
	'3_image',
	[
		'label' 		=> esc_html__( 'Image 3', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);


$this->add_control(
	'banners3',
	[
		'label' 		=> __( 'Banners', 'konsal' ),
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