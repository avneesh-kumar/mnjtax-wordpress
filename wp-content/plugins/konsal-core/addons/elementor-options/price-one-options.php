<?php

$this->start_controls_section(
	'1_price_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => 'layout_one']
	]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'title',
	[
		'label'     => __( 'Title', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::TEXTAREA,
        'rows' 		=> 2,
         'default'  	=> esc_html__( 'Basic Plan', 'konsal' ),
	]
);
$repeater->add_control(
	'subtitle',
	[
		'label'     => __( 'Subtitle', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::TEXTAREA,
        'rows' 		=> 2,
         'default'  	=> esc_html__( 'Basic Plan', 'konsal' ),
	]
);
$repeater->add_control(
	'image',
	[
		'label' 		=> __( 'Choose Image', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'dynamic' 		=> [
			'active' 		=> true,
		],
		'default' 		=> [
			'url' 			=> \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);

$repeater->add_control(
	'price',
	[
		'label'     => __( 'Price', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::TEXTAREA,
        'rows' 		=> 3,
         'default'  	=> esc_html__( '$55/Per Month', 'konsal' ),
	]
);	

$repeater->add_control(
	'features', [
		'label' 		=> __( 'Features', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
		'default' 		=> __( '12 Hour Session' , 'konsal' ),
		'label_block' 	=> true,
	]
);

$repeater->add_control(
	'button_text',
	[
		'label' 	=> esc_html__( 'Button Text', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXT,
        'default'  	=> esc_html__( 'Choose Plan', 'konsal' ),
	]
);

$repeater->add_control(
	'button_link',
	[
		'label' 		=> esc_html__( 'Link', 'konsal' ),
		'type' 		=> \Elementor\Controls_Manager::TEXT,
		'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
		'show_external' => true,
	]
);

$this->add_control(
	'price_list',
	[
		'label' 		=> __( 'Price List', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::REPEATER,
		'fields' 		=> $repeater->get_controls(),
		'default' 		=> [
			[
				'title' 		=> __( 'title', 'konsal' ),
			],
		],
	]
);


$this->end_controls_section();