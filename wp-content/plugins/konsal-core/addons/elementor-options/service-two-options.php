<?php

$this->start_controls_section(
	'2_service_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_five', 'layout_seven']]
	]
);

$repeater = new \Elementor\Repeater();

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
	'icon',
	[
		'label' 		=> esc_html__( 'Icon', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);
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
	'desc', [
		'label' 		=> __( 'Description', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 4,
		'label_block' 	=> true,
	]
);

$repeater->add_control(
	'button_text',
	[
		'label' 	=> esc_html__( 'Button Text', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXT,
        'default'  	=> esc_html__( 'Get More Info', 'konsal' ),
	]
);
$repeater->add_control(
	'button_link',
	[
		'label' 		=> esc_html__( 'Button Link', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::URL,
		'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
		'show_external' => true,
		'default' 		=> [
			'url' 			=> '#',
			'is_external' 	=> false,
			'nofollow' 		=> false,
		],
	]
);

$this->add_control(
	'services2',
	[
		'label' 		=> __( 'Services', 'konsal' ),
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