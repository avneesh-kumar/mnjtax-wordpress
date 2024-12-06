<?php

$this->start_controls_section(
	'3_group_img_section',
	[
		'label'     => __( 'Image', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_three']]
	]
);
$this->add_control(
    '1_img_1',
    [
        'label'     => __( 'Image 1', 'konsal' ),
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
    '1_img_2',
    [
        'label'     => __( 'Image 2', 'konsal' ),
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
    '1_img_3',
    [
        'label'     => __( 'Image 3', 'konsal' ),
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
    '1_img_4',
    [
        'label'     => __( 'Image 4', 'konsal' ),
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
	'1_content', [
		'label' 		=> __( 'Experience', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
		'default' 		=> __( 'Experience' , 'konsal' ),
		'label_block' 	=> true,
	]
);
$this->add_control(
	'years', [
		'label' 		=> __( 'Years', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( '1990' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);

$this->end_controls_section();