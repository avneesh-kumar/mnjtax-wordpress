<?php

$this->start_controls_section(
	'2_contactform_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_four']]
	]
);

$this->add_control(
    '2title',
    [
        'label' 	=> __( 'Title', 'konsal' ),
        'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
        'default'  	=> __( 'Title', 'konsal' ),
        'condition'	=> ['layout_style' => ['layout_four']]
    ]
);
$this->add_control(
    '2konsal_select_contact_form',
    [
        'label'   => esc_html__( 'Select Form', 'konsal' ),
        'type'    => \Elementor\Controls_Manager::SELECT,
        'default' => '0',
        'options' => $this->get_as_contact_form(),
    ]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'title', [
		'label' 		=> __( 'Title', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( 'Title' , 'konsal' ),
		'rows' 			=> 2,
	]
);
$repeater->add_control(
	'icon', [
		'label' 		=> __( 'Icon', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( '' , 'konsal' ),
		'rows' 			=> 2,
	]
);
$repeater->add_control(
	'content', [
		'label' 		=> __( 'Content', 'konsal' ),
		'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
		'default' 		=> __( '' , 'konsal' ),
		'rows' 			=> 4,
	]
);


$this->add_control(
	'contacts',
	[
		'label' 		=> __( 'contact Info', 'konsal' ),
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

	//Social 
    $this->add_control(
        'show_social',
        [
            'label' 		=> __( 'Show Social?', 'konsal' ),
            'type' 			=> \Elementor\Controls_Manager::SWITCHER,
            'label_on' 		=> __( 'Show', 'konsal' ),
            'label_off' 	=> __( 'Hide', 'konsal' ),
            'return_value' 	=> 'yes',
            'default' 		=> 'yes',
        ]
    );

    konsal_social_fields($this, 'social_lists', 'Social Lists' );

$this->end_controls_section();