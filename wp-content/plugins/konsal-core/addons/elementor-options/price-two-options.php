<?php

$this->start_controls_section(
	'2_price_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => 'layout_two']
	]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'title2',
	[
		'label'     => __( 'Title', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::TEXTAREA,
        'rows' 		=> 2,
         'default'  	=> esc_html__( 'Basic Plan', 'konsal' ),
	]
);
$repeater->add_control(
	'price2',
	[
		'label'     => __( 'Price', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::TEXTAREA,
        'rows' 		=> 3,
         'default'  	=> esc_html__( '$55/Per Month', 'konsal' ),
	]
);	

$repeater->add_control(
	'features2', [
		'label' 		=> __( 'Features', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
		'default' 		=> __( '12 Hour Session' , 'konsal' ),
		'label_block' 	=> true,
	]
);

$repeater->add_control(
	'button_text2',
	[
		'label' 	=> esc_html__( 'Button Text', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXT,
        'default'  	=> esc_html__( 'Choose Plan', 'konsal' ),
	]
);
$repeater->add_control(
    'button_link2',
    [
        'label' 		=> esc_html__( 'Link', 'konsal' ),
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
	'price_list2',
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