<?php

$this->start_controls_section(
	'team_one_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style!' => 'layout_ten']
	]
);
$this->add_control(
	'team_shape',
	[
		'label' 		=> esc_html__( 'Shape Image', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
		'condition'	=> ['layout_style' => ['layout_two', 'layout_three']]
	]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'name', [
		'label' 		=> __( 'Name', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Leslie Alexander' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'profile_link',
	[
		'label' 		=> esc_html__( 'Profile Link', 'konsal' ),
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
$repeater->add_control(
	'designation', [
		'label' 		=> __( 'Designation', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXT,
		'default' 		=> __( 'Customer' , 'konsal' ),
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'team_image',
	[
		'label' 		=> esc_html__( 'Speaker Image', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);
$repeater->add_control(
	'fb_link',
	[
		'label' 		=> esc_html__( 'Facebook Link', 'konsal' ),
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
$repeater->add_control(
	'twitter_link',
	[
		'label' 		=> esc_html__( 'Twitter Link', 'konsal' ),
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
$repeater->add_control(
	'linkedin_link',
	[
		'label' 		=> esc_html__( 'Linkedin Link', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::URL,
		'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
		'show_external' => true,
	]
);
$repeater->add_control(
	'instagram_link',
	[
		'label' 		=> esc_html__( 'Instagram Link', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::URL,
		'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
		'show_external' => true,
	]
);

$this->add_control(
	'team_members',
	[
		'label' 		=> __( 'Team Member', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::REPEATER,
		'fields' 		=> $repeater->get_controls(),
		'default' 		=> [
			[
				'title' 		=> __( 'Your Name', 'konsal' ),
			],
		],
		'title_field' 	=> '{{{ name }}}',
	]
);

$this->end_controls_section();