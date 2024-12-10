<?php

$this->start_controls_section(
	'1_banner_section',
	[
		'label'     => __( 'Banner', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_one']]
	]
);
$this->add_control(
    'bg',
    [
        'label'     => __( 'Background Image', 'konsal' ),
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
    'overlay',
    [
        'label'     => __( 'Overlay Image', 'konsal' ),
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
    'shape',
    [
        'label'     => __( 'Background Shape Image', 'konsal' ),
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
    'thumb1',
    [
        'label'     => __( 'Banner Image1', 'konsal' ),
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
    'thumb2',
    [
        'label'     => __( 'Banner Image2', 'konsal' ),
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
    'subtitle_img',
    [
        'label'     => __( 'Subtitle Image', 'konsal' ),
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
	'subtitle', [
		'label' 		=> __( 'Subtitle', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Subtitle' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$this->add_control(
	'title', [
		'label' 		=> __( 'Title', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Title' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$this->add_control(
	'desc', [
		'label' 		=> __( 'Description', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Title' , 'konsal' ),
		'rows' 			=> 4,
		'label_block' 	=> true,
	]
);
$this->add_control(
	'button_text',
	[
		'label' 	=> esc_html__( 'Button Text', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXT,
        'default'  	=> esc_html__( 'Get More Info', 'konsal' ),
	]
);

$this->add_control(
	'button_link',
	[
		'label' 		=> esc_html__( 'Button Link', 'konsal' ),
		'type' 		=> \Elementor\Controls_Manager::TEXT,
        'default'  	=> esc_html__( '#', 'konsal' ),
	]
);
$this->add_control(
	'vdo_text',
	[
		'label' 	=> esc_html__( 'Video Text', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXT,
        'default'  	=> esc_html__( 'Get More Info', 'konsal' ),
	]
);
$this->add_control(
	'vdo_url',
	[
		'label' 	=> esc_html__( 'Video Url', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXT,
        'default'  	=> esc_html__( '#', 'konsal' ),
	]
);
$this->end_controls_section();