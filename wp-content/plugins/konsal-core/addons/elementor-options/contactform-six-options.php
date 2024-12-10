<?php

$this->start_controls_section(
	'6_contactform_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_six']]
	]
);

$this->add_control(
    '6bg',
    [
        'label' 		=> __( 'Background', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::MEDIA,
        'dynamic' 		=> [
            'active' 		=> true,
        ],
    ]
); 
$this->add_control(
    '6shape',
    [
        'label' 		=> __( 'Subatitle Shape', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::MEDIA,
        'dynamic' 		=> [
            'active' 		=> true,
        ],
    ]
); 
$this->add_control(
    '6subtitle',
    [
        'label' 	=> __( 'Subitle', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
        'default'  	=> __( 'Subitle', 'konsal' ),
    ]
);
$this->add_control(
    '6title',
    [
        'label' 	=> __( 'Title', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
        'default'  	=> __( 'Title', 'konsal' ),
    ]
);
$this->add_control(
    '6desc',
    [
        'label' 	=> __( 'Description', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
        'default'  	=> __( 'Description', 'konsal' ),
    ]
);
$this->add_control(
    '6konsal_select_contact_form',
    [
        'label'   => esc_html__( 'Select Form', 'konsal' ),
        'type'    => \Elementor\Controls_Manager::SELECT,
        'default' => '0',
        'options' => $this->get_as_contact_form(),
    ]
);

$this->add_control(
    '6icon',
    [
        'label' 		=> __( 'Icon', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::MEDIA,
        'dynamic' 		=> [
            'active' 		=> true,
        ],
    ]
); 
$this->add_control(
    '6label',
    [
        'label' 	=> __( 'Label', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
        'default'  	=> __( 'Subitle', 'konsal' ),
    ]
);
$this->add_control(
    '6content',
    [
        'label' 	=> __( 'Content', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
        'default'  	=> __( 'Content', 'konsal' ),
    ]
);

$this->end_controls_section();