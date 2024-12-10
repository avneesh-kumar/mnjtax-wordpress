<?php

$this->start_controls_section(
	'1_project_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_one', 'layout_two', 'layout_five', 'layout_six', 'layout_seven']]
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
	'button_link',
	[
		'label' 		=> esc_html__( 'Link', 'konsal' ),
		'type' 		=> \Elementor\Controls_Manager::TEXT,
		'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
		'show_external' => true,
	]
);

$this->add_control(
	'project_list',
	[
		'label' 		=> __( 'Project List', 'konsal' ),
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