<?php

$this->start_controls_section(
	'2_banner_section',
	[
		'label'     => __( 'Banner', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_two']]
	]
);

$this->add_control(
    'arrow_shape',
    [
        'label'     => __( 'Arrow Shape', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::MEDIA,
        'dynamic' 		=> [
			'active' 		=> true,
		],
		'default' 		=> [
			'url' 		=>  \Elementor\Utils::get_placeholder_image_src(),
		],
    ]
);
$this->add_control(
    'shape1',
    [
        'label'     => __( 'Background Shape Image 1', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::MEDIA,
        'dynamic' 		=> [
			'active' 		=> true,
		],
		'default' 		=> [
			'url' 		=>  \Elementor\Utils::get_placeholder_image_src(),
		],
    ]
);
$this->add_control(
    'shape2',
    [
        'label'     => __( 'Background Shape Image 2', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::MEDIA,
        'dynamic' 		=> [
			'active' 		=> true,
		],
		'default' 		=> [
			'url' 		=>  \Elementor\Utils::get_placeholder_image_src(),
		],
    ]
);
$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'heading', [
		'label' 		=> __( 'Heading', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'title1', [
		'label' 		=> __( 'Title 1', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'title2', [
		'label' 		=> __( 'Title 2', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'desc', [
		'label' 		=> __( 'Description', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
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
	'bg',
	[
		'label' 		=> esc_html__( 'Background', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);


$this->add_control(
	'banners2',
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