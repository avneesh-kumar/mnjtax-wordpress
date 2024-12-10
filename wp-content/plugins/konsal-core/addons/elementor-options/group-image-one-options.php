<?php

$this->start_controls_section(
	'1_group_img_section',
	[
		'label'     => __( 'Image', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_one', 'layout_two']]
	]
);
$this->add_control(
    'img_1',
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
    'img_2',
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
    'img_3',
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
	'content', [
		'label' 		=> __( 'Subtitle', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
		'default' 		=> __( 'Subtitle' , 'konsal' ),
		'label_block' 	=> true,
	]
);

$this->end_controls_section();