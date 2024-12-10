<?php

$this->start_controls_section(
	'4_group_img_section',
	[
		'label'     => __( 'Image', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_four']]
	]
);
$this->add_control(
    '4_img_1',
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
    '4_img_2',
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

$this->end_controls_section();