<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow; 


// General Fields
// konsal_general_fields($th, $id, $label, $field_type, $default_value, $condition = null);
if (!function_exists('konsal_general_fields')) {
    function konsal_general_fields($th, $id, $label, $field_type, $default_value, $condition = null) {

        $control_args = [
            'label'      => __( $label, 'konsal' ),
            'default'       => __( $default_value , 'konsal' ),
        ];

        if ($field_type === 'TEXT' || $field_type === 'TEXT2') {
            $control_args['type'] = Controls_Manager::TEXT;
        } elseif ($field_type === 'TEXTAREA' || $field_type === 'TEXTAREA2' || $field_type === 'TEXTAREA3') {
            $control_args['type'] = Controls_Manager::TEXTAREA;
        } elseif ($field_type === 'HEADING') {
            $control_args['type'] = Controls_Manager::HEADING;
        } elseif ($field_type === 'WYSIWYG') {
            $control_args['type'] = Controls_Manager::WYSIWYG;
        } elseif ($field_type === 'DIVIDER') {
            $control_args['type'] = Controls_Manager::DIVIDER;
        } else{
            $control_args['type'] = Controls_Manager::TEXT;
        }

        if ($field_type === 'TEXT') {
            $control_args['label_block'] = true;
        }

        if ($field_type === 'TEXTAREA') {
            $control_args['rows'] = 4;
        }elseif ($field_type === 'TEXTAREA2') {
            $control_args['rows'] = 2;
        }elseif ($field_type === 'TEXTAREA3') {
            $control_args['rows'] = 6;
        }

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args);

    }
}

// Media Fields
// konsal_media_fields($th, $id, $label, $condition = null);
if (!function_exists('konsal_media_fields')) {
    function konsal_media_fields($th, $id, $label, $condition = null) {

        $control_args = [
            'label'      => __( $label, 'konsal' ),
            'type' 			=> Controls_Manager::MEDIA,
            'dynamic' 		=> [
                'active' 		=> true,
            ],
            'default' 		=> [
                'url' 			=> Utils::get_placeholder_image_src(),
            ],
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args);

    }
}

// URL Fields
// konsal_url_fields($th, $id, $label, $condition = null);
if (!function_exists('konsal_url_fields')) {
    function konsal_url_fields($th, $id, $label, $condition = null) {

        $control_args = [
            'label'      => __( $label, 'konsal' ),
            'type' 			=> Controls_Manager::URL,
            'placeholder' 	=> __( 'https://your-link.com', 'konsal' ),
            'show_external' => true,
            'default' 		=> [
                'url' 			=> '#',
                'is_external' 	=> false,
                'nofollow' 		=> false,
            ],
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args); 

    }
}

// SELECT Fields
// konsal_select_field($th, $id, $label, $options = [], $condition = null);
if (!function_exists('konsal_select_field')) {
    function konsal_select_field($th, $id, $label, $options = [], $condition = null) {
        $formatted_options = generate_formatted_options($options);

        $control_args = [
            'label'      => __( $label, 'konsal' ),
            'type'       => Controls_Manager::SELECT,
            'options'    => $formatted_options,
            'default'    => '1',
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args);
    }

    function generate_formatted_options($options) {
        $formatted_options = [];
    
        // Check if options array is empty
        if (empty($options)) {
            // If options array is empty, add the default option
            $formatted_options['1'] = __( 'Option One', 'konsal' );
        }
    
        // Add the rest of the options
        foreach ($options as $index => $option_label) {
            $option_id = $index + 1;  // Generate option ID based on index (starting from 1)
            $formatted_options[$option_id] = __( $option_label, 'konsal' );
        }
    
        return $formatted_options;
    }
    
}


// Switcher Fields
// konsal_switcher_fields($th, $id, $label, $condition = null);
if (!function_exists('konsal_switcher_fields')) {
    function konsal_switcher_fields($th, $id, $label, $condition = null) {

        $control_args = [
            'label'      => __( $label, 'konsal' ),
            'type' 			=> Controls_Manager::SWITCHER,
			'label_on' 		=> __( 'Yes', 'konsal' ),
			'label_off' 	=> __( 'No', 'konsal' ),
			'return_value' 	=> 'yes',
			'default' 		=> 'yes',
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args);

    }
}

// Code Fields
// konsal_code_fields($th, $id, $label, $condition = null);
if (!function_exists('konsal_code_fields')) {
    function konsal_code_fields($th, $id, $label, $condition = null) {

        $control_args = [
            'label'      => __( $label, 'konsal' ),
            'type' => \Elementor\Controls_Manager::CODE, 
			'language' => 'html',
            'rows' => 7,
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args);

    }
}

// Social Repeater
// konsal_social_fields($this, 'social', 'Social List');
if (!function_exists('konsal_social_fields')) {
    function konsal_social_fields($th, $id, $label, $condition = null) {

        $repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' 	=> __( 'Social Icon', 'konsal' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'fab fa-facebook-f',
					'library' 	=> 'solid',
				],
			]
		);
		$repeater->add_control(
			'icon_link',
			[
				'label' 		=> __( 'Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> true,
				],
			]
		);

        $control_args = [
            'label' 		=> __( $label , 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' => [
                    [
                        'social_icon' => ['value' => 'fab fa-facebook-f', 'library' => 'solid'],
                        'icon_link' => ['url' => 'https://www.facebook.com', 'is_external' => false, 'nofollow' => true],
                    ],
                    [
                        'social_icon' => ['value' => 'fab fa-twitter', 'library' => 'solid'],
                        'icon_link' => ['url' => 'https://www.twitter.com', 'is_external' => false, 'nofollow' => true],
                    ],
                    [
                        'social_icon' => ['value' => 'fab fa-instagram', 'library' => 'solid'],
                        'icon_link' => ['url' => 'https://www.instagram.com', 'is_external' => false, 'nofollow' => true],
                    ],
                    [
                        'social_icon' => ['value' => 'fab fa-linkedin-in', 'library' => 'solid'],
                        'icon_link' => ['url' => 'https://www.linkedin.com', 'is_external' => false, 'nofollow' => true],
                    ],
                    [
                        'social_icon' => ['value' => 'fab fa-pinterest-p', 'library' => 'solid'],
                        'icon_link' => ['url' => 'https://pinterest.com', 'is_external' => false, 'nofollow' => true],
                    ],
                ],
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args);

    }
}


// Common Repeater
// konsal_common_repeater_field($th, $label, $fields, $condition = null)
if (!function_exists('konsal_common_repeater_field')) {
    function konsal_common_repeater_field($th, $id, $label, $fields, $condition = null) {

        // Id create
        $control_id = str_replace(' ', '_', strtolower($label));

        $repeater = new \Elementor\Repeater();

        foreach ($fields as $field) {
            switch ($field) {
                case 'title':
                    $repeater->add_control(
                        $control_id . '_title',
                        [
                            'label'         => esc_html__($label . ' Title', 'konsal'),
                            'type'          => \Elementor\Controls_Manager::TEXTAREA,
                            'default'       => __('Title here', 'konsal'),
                            'label_block'   => true,
                            'rows'          => 2,
                        ]
                    );
                    break;

                case 'subtitle':
                    $repeater->add_control(
                        $control_id . '_subtitle',
                        [
                            'label'         => esc_html__($label . ' Subtitle', 'konsal'),
                            'type'          => \Elementor\Controls_Manager::TEXTAREA,
                            'default'       => __('Subtitle here', 'konsal'),
                            'label_block'   => true,
                            'rows'          => 2,
                        ]
                    );
                    break;

                case 'text':
                    $repeater->add_control(
                        $control_id . '_text',
                        [
                            'label'         => esc_html__($label . ' Text', 'konsal'),
                            'type'          => \Elementor\Controls_Manager::TEXTAREA,
                            'default'       => __('Text here', 'konsal'),
                            'label_block'   => true,
                            'rows'          => 4,
                        ]
                    );
                    break;

                case 'icon2':
                    $repeater->add_control(
                        $control_id . '_icon2',
                        [
                            'label'         => esc_html__($label . ' Icon', 'konsal'),
                            'type'          => \Elementor\Controls_Manager::TEXTAREA,
                            'default'       => __('<i class="fa-light fa-clock"></i>', 'konsal'),
                            'label_block'   => true,
                            'rows'          => 2,
                        ]
                    );
                    break;

                case 'icon':
                    $repeater->add_control(
                        $control_id . '_icon',
                        [
                            'label'     => esc_html__($label . ' Icon', 'konsal'),
                            'type'      => \Elementor\Controls_Manager::MEDIA,
                            'dynamic'   => [
                                'active' => true,
                            ],
                            'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src(),
                            ],
                        ]
                    );
                    break;

                case 'image':
                    $repeater->add_control(
                        $control_id . '_image',
                        [
                            'label'     => esc_html__($label . ' Image', 'konsal'),
                            'type'      => \Elementor\Controls_Manager::MEDIA,
                            'dynamic'   => [
                                'active' => true,
                            ],
                            'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src(),
                            ],
                        ]
                    );
                    break;

                case 'link':
                    $repeater->add_control(
                        $control_id . '_link',
                        [
                            'label'         => esc_html__($label . ' Link', 'konsal'),
                            'type' 			=> Controls_Manager::URL,
                            'placeholder' 	=> __( 'https://your-link.com', 'konsal' ),
                            'show_external' => true,
                            'default' 		=> [
                                'url' 			=> '#',
                                'is_external' 	=> false,
                                'nofollow' 		=> false,
                            ],
                        ]
                    );
                    break;

                default:
                    break;
            }
        }

        $th->add_control(
            $id,
            [
                'label'         => esc_html__($label . ' Lists', 'konsal'),
                'type'          => \Elementor\Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'default'       => [
                    [
                        $control_id . '_title' => __('Title', 'konsal'),
                    ],
                ],
                'condition' => [
                    'layout_style' => $condition
                ]
            ]
        );


    }
}


// Repeater
// konsal_repeater_fields($this, 'repeater', 'Repeater List');
if (!function_exists('konsal_repeater_fields')) {
    function konsal_repeater_fields($th, $id, $label, $fields = array(), $condition = null) {
        $repeater = new Repeater();

        if (isset($fields['image']) && is_array($fields['image'])) {
            foreach ($fields['image'] as $imageLabel) {
                $field_id = strtolower(str_replace(' ', '_', $imageLabel));
                $repeater->add_control(
                    $field_id,
                    [
                        'label'     => $imageLabel,
                        'type'      => Controls_Manager::MEDIA,
                        'dynamic'   => ['active' => true],
                    ]
                );
            }
        }

        if (isset($fields['title']) && is_array($fields['title'])) {
            foreach ($fields['title'] as $titleLabel) {
                $field_id = strtolower(str_replace(' ', '_', $titleLabel));
                $repeater->add_control(
                    $field_id,
                    [
                        'label'         => $titleLabel,
                        'type'          => Controls_Manager::TEXTAREA,
                        'default'       => 'Title',
                        'label_block'   => true,
                        'rows'          => '2'
                    ]
                );
            }
        }

        if (isset($fields['desc']) && is_array($fields['desc'])) {
            foreach ($fields['desc'] as $descLabel) {
                $field_id = strtolower(str_replace(' ', '_', $descLabel));
                $repeater->add_control(
                    $field_id,
                    [
                        'label'         => $descLabel,
                        'type'          => Controls_Manager::TEXTAREA,
                        'label_block'   => true,
                        'rows'          => '4'
                    ]
                );
            }
        }

        if (isset($fields['btn']) && is_array($fields['btn'])) {
            foreach ($fields['btn'] as $btnLabel) {
                $field_id = strtolower(str_replace(' ', '_', $btnLabel));
                $repeater->add_control(
                    $field_id,
                    [
                        'label'         => $btnLabel,
                        'type'          => Controls_Manager::TEXTAREA,
                        'default'       => 'Read More',
                        'label_block'   => true,
                        'rows'          => '2'
                    ]
                );
            }
        }

        if (isset($fields['url']) && is_array($fields['url'])) {
            foreach ($fields['url'] as $urlLabel) {
                $field_id = strtolower(str_replace(' ', '_', $urlLabel));
                $repeater->add_control(
                    $field_id,
                    [
                        'label'         => $urlLabel,
                        'type' 			=> Controls_Manager::URL,
                        'placeholder' 	=> __( 'https://your-link.com', 'konsal' ),
                        'show_external' => true,
                        'default' 		=> [
                            'url' 			=> '#',
                            'is_external' 	=> false,
                            'nofollow' 		=> false,
                        ],
                    ]
                );
            }
        }

        // Remaining URL field handling, if required...

        $control_args = [
            'label'     => __( $label, 'konsal' ),
            'type'      => Controls_Manager::REPEATER,
            'fields'    => $repeater->get_controls(),
            'default' 		=> [
                [
                    $field_id  => '',
                ],
            ],
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args);
    }
}


// Slider option
// function konsal_elementor_slider_options($th, $condition = null)
if (!function_exists('konsal_elementor_slider_options')) {
    function konsal_elementor_slider_options($th, $condition = null) {

        $th->start_controls_section(
			'slider_control',
			[
				'label'     => __( 'Slider Control', 'konsal' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
                    'layout_style' => $condition
                ]
			]
        );
        $th->add_control(
			'make_it_slider',
			[
				'label' 		=> __( 'Use it as slider ?', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'konsal' ),
				'label_off' 	=> __( 'Hide', 'konsal' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
        $th->add_control(
			'slider_id',
			[
				'label' 		=> __( 'Slider ID', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
                'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
                'default' 		=> __( 'thSlider1', 'konsal' ),
			]
		);

		$th->add_control(
			'desktop_items',
			[
				'label' 		=> __( 'Items To Show (1300 +)', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 0,
						'step' 		=> 1,
						'max' 		=> 10,
					],
				],
				'default' 		=> [
					'unit' 			=> '%',
					'size' 			=> 4,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);

		$th->add_control(
			'large_laptop_items',
			[
				'label' 		=> __( 'Large Laptop Items (max 1300)', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 4,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);

		$th->add_control(
			'laptop_items',
			[
				'label' 		=> __( 'Laptop Items (max 1200)', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 2,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);

        $th->add_control(
			'tablet_items',
			[
				'label' 		=> __( 'Tablet Items (max 922)', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 2,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);
        $th->add_control(
			'mobile_items',
			[
				'label' 		=> __( 'Mobile Items (max 768)', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 1,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);

        $th->add_control(
			'small_mobile_items',
			[
				'label' 		=> __( 'Small Mobile (max 576)', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 1,
				],
				'condition'		=> [ 'make_it_slider' => [ 'yes' ] ],
			]
		);
		$th->add_control(
			'show_dots',
			[
				'label' 		=> __( 'Show Dots ?', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'konsal' ),
				'label_off' 	=> __( 'Hide', 'konsal' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);
		$th->add_control(
			'show_arrow',
			[
				'label' 		=> __( 'Show Arrow ?', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'konsal' ),
				'label_off' 	=> __( 'Hide', 'konsal' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);

		$th->end_controls_section();
        
    }
}