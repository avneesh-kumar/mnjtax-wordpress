<?php

$this->start_controls_section(
	'1_testimonials_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_one','layout_two', 'layout_three', 'layout_four', 'layout_five']]
	]
);
$this->add_control(
	'quote',
	[
		'label' 		=> esc_html__( 'Quote Image', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'name', [
		'label' 		=> __( 'Name', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Safe Cleaning Supplies' , 'konsal' ),
		'rows' 			=> 2,
		'label_block' 	=> true,
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
	'feedback', [
		'label' 		=> __( 'Feedback', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Customer' , 'konsal' ),
		'label_block' 	=> true,
	]
);
$repeater->add_control(
	'client_image',
	[
		'label' 		=> esc_html__( 'Client Image', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::MEDIA,
		'default' 		=> [
			'url' =>  \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);
$repeater->add_control(
	'client_rating',
	[
		'label' 	=> __( 'Client Rating', 'konsal' ),
		'type' 		=> \Elementor\Controls_Manager::SELECT,
		'default' 	=> 'five',
		'options' 	=> [
			'one'  		=> __( 'One Star', 'konsal' ),
			'two' 		=> __( 'Two Star', 'konsal' ),
			'three' 	=> __( 'Three Star', 'konsal' ),
			'four' 		=> __( 'Four Star', 'konsal' ),
			'five' 	 	=> __( 'Five Star', 'konsal' ),
		],
	]
);
$this->add_control(
	'1_testimonials',
	[
		'label' 		=> __( 'Testimonials', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::REPEATER,
		'fields' 		=> $repeater->get_controls(),
		'default' 		=> [
			[
				'name' 		=> __( 'Your Name', 'konsal' ),
			],
		],
		'title_field' 	=> '{{{ name }}}',
	]
);

$this->end_controls_section();