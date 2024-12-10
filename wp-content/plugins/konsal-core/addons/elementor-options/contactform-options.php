<?php

$this->start_controls_section(
	'1_contactform_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_one', 'layout_two', 'layout_three', 'layout_five']]
	]
);
$this->add_control(
    'image',
    [
        'label' 		=> __( 'Background', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::MEDIA,
        'dynamic' 		=> [
            'active' 		=> true,
        ],
        'condition'	=> ['layout_style' => ['layout_two', 'layout_three']]
    ]
); 
$this->add_control(
    'title',
    [
        'label' 	=> __( 'Title', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
        'default'  	=> __( 'Title', 'konsal' ),
        'condition'	=> ['layout_style' => ['layout_two', 'layout_three', 'layout_five']]
    ]
);
$this->add_control(
    'konsal_select_contact_form',
    [
        'label'   => esc_html__( 'Select Form', 'konsal' ),
        'type'    => \Elementor\Controls_Manager::SELECT,
        'default' => '0',
        'options' => $this->get_as_contact_form(),
    ]
);


$this->end_controls_section();