<?php

$this->start_controls_section(
	'3_project_section',
	[
		'label'     => __( 'Content', 'konsal' ),
		'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition'	=> ['layout_style' => ['layout_three', 'layout_four']]
	]
);

$this->add_control(
    'filter_all_title', [
        'label' 		=> __( 'Filter All Title', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
        'rows' 			=> 2,
        'default' 		=> __( 'All' , 'konsal' ),
        'label_block' 	=> true,
    ]	
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
    'filter_title', [
        'label' 		=> __( 'Filter Title', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
        'rows' 			=> 2,
        'default' 		=> __( 'Case' , 'konsal' ),
        'label_block' 	=> true,
    ]	
);

$repeater->add_control(
    'filter_data', [
        'label' 		=> __( 'Filtering nav data', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
        'rows' 			=> 2,
        'default' 		=> __( 'cat1' , 'konsal' ),
        'label_block' 	=> true,
    ]
);

$this->add_control(
    'portfolio_filter',
    [
        'label' 		=> __( 'Filter Buttons', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::REPEATER,
        'fields' 		=> $repeater->get_controls(),
        'default' 		=> [
            [
                'filter_title' 		=> __( 'Family Insurance', 'konsal' ),
            ]
        ],
        'title_field' 	=> '{{{ filter_title }}}',
    ]
);	

$repeater = new \Elementor\Repeater();

$repeater->add_control(
    'filter_content_data', [
        'label' 		=> __( 'Filter Content Data', 'konsal' ),
        'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
        'rows' 			=> 2,
        'default' 		=> __( '' , 'konsal' ),
    ]	
);

$repeater->add_control(
	'title',
	[
		'label'     => __( 'Title', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::TEXTAREA,
        'rows' 		=> 2,
         'default'  	=> esc_html__( 'Title', 'konsal' ),
	]
);
$repeater->add_control(
	'subtitle',
	[
		'label'     => __( 'Subtitle', 'konsal' ),
        'type'      => \Elementor\Controls_Manager::TEXTAREA,
        'rows' 		=> 2,
         'default'  	=> esc_html__( 'Subtitle', 'konsal' ),
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
	'project_list_2',
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