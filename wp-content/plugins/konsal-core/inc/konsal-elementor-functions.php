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

if (!function_exists('konsal_all_elementor_style')) :
    function konsal_all_elementor_style($agrs, $label, $selector, $condition, $style = 'color', $color = true, $typo = true, $mar = true, $pad = true) {
    
        if (false != $color) :
            $agrs->add_control(
                str_replace(' ', '_', $label) . '_color',
                [
                    'label'         => __($label . ' Color', 'konsal'),
                    'type'          => \Elementor\Controls_Manager::COLOR,
                    'selectors'     => [
                        $selector   => $style . ': {{VALUE}}',
                    ],
                    'condition'     => [
                        'layout_style' => $condition
                    ]
                ]
            );
        endif;

        if (false != $typo) :
            //title typography
            $agrs->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'           =>  str_replace(' ', '_', $label) . '_typo',
                    'label'          => esc_html__($label . ' Typography', 'konsal'),
                    'selector'       => $selector,
                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );

        endif;

        if (false != $mar) :
            $agrs->add_responsive_control(
                str_replace(' ', '_', $label) . '_margin',
                [
                    'label'         => esc_html__($label . ' Margin', 'konsal'),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%', 'em' ],
                    'selectors'     => [
                        $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],

                    'condition' => [
                        'layout_style' => $condition,
                    ]
                ]
            );

        endif;

        if (false != $pad) :
            $agrs->add_responsive_control(
                str_replace(' ', '_', $label) . '_padding',
                [
                    'label'         => esc_html__($label . ' Padding', 'konsal'),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%', 'em' ],
                    'selectors'     => [
                        $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],

                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );

        endif;

    }
endif;
//--------------------------------------------------button--------------------------------------------------//

if (!function_exists('konsal_elementor_border_style')) :
    function konsal_elementor_border_style($agrs, $label, $selector, $condition)
    {

        
        if (false != $selector) :
            $agrs->add_group_control(
                 \Elementor\Group_Control_Border::get_type(),
                [
                    'name'      => $label .'border',
                    'label'     => __($label . ' Border', 'konsal'),
                    'selector'  => $selector ,
                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );

            $agrs->add_responsive_control(
                str_replace(' ', '_', $label) . '_border_radious',
                [
                    'label'         => esc_html__($label . ' Border Radious', 'konsal'),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%', 'em' ],
                    'selectors'     => [
                        $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],

                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );

        endif;
    }
endif;


if (!function_exists('konsal_elementor_color_style')) :
    function konsal_elementor_color_style($agrs, $label, $selector, $condition, $style = 'color')
    {
        if (false != $selector) :
            $agrs->add_control(
                str_replace(' ', '_', $label) . '_color',
                [
                    'label' => __($label . ' Color', 'konsal'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        $selector => $style . ': {{VALUE}}',
                    ],
                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            );  
        endif;
    }
endif;

if (!function_exists('konsal_elementor_typography_style')) :
    function konsal_elementor_typography_style($agrs, $label, $selector, $condition)
    {   
        if (false != $selector) :
            $agrs->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'           =>  str_replace(' ', '_', $label) . '_typo',
                    'label'          => esc_html__($label . ' Typography', 'konsal'),
                    'selector'       => $selector,
                    'condition' => [
                        'layout_style' => $condition
                    ]
                ]
            ); 
        endif;
    }
endif;



// Common Style fields - Color, Typography, Margin & padding
// konsal_common_style_fields($th, $id, $label, $selector, $condition = null, $p = 'color');
if (!function_exists('konsal_common_style_fields')) {
    function konsal_common_style_fields($th, $id, $label, $selector, $condition = null, $p = 'color') {
       
        $control_args = [
            'label'      => __( $label, 'konsal' ),
            'tab' 		=> Controls_Manager::TAB_STYLE,
        ];
        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }
        $th->start_controls_section($id.'title_style_section', $control_args);

		$th->add_control(
			$id.'color',
			[
				'label' 	=> __( 'Color', 'konsal' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors'  => [
					$selector => $p . ': {{VALUE}}',
				],
			]
        );

		$th->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> $id.'typography',
				'label' 	=> __( 'Typography', 'konsal' ),
				'selector' 	=> $selector
			]
		);

		$th->add_responsive_control(
			$id.'margin',
			[
				'label' 		=> __( 'Margin', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->add_responsive_control(
			$id.'padding',
			[
				'label' 		=> __( 'Padding', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->end_controls_section();

    }
}


// Button Style field
// konsal_button_style_fields($th, $id, $label, $selector, $condition = null)
if (!function_exists('konsal_button_style_fields')) {
    function konsal_button_style_fields($th, $id, $label, $selector, $condition = null) {
       
        $control_args = [
            'label'      => __( $label, 'konsal' ),
            'tab' 		=> Controls_Manager::TAB_STYLE,
        ];
        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->start_controls_section($id.'button_style_section', $control_args);

		$th->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> $id.'button_typography',
				'label' 	=> __( 'Typography', 'konsal' ),
				'selector' 	=> $selector
			]
		);

		$th->start_controls_tabs(
			$id.'style_tabs'
		);

			$th->start_controls_tab(
				$id.'first_style_tab',
				[
					'label' => esc_html__( 'Normal', 'konsal' ),
				]
			);

			$th->add_control(
				$id.'button_color',
				[
					'label' 		=> __( 'Color', 'konsal' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						$selector => 'color: {{VALUE}}',
					],
				]
			);
	
			$th->add_control(
				$id.'button_bg',
				[
					'label' 		=> __( 'Background Color', 'konsal' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						$selector => 'background-color:{{VALUE}}',
					],
				]
			);

			$th->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => $id.'border',
					'selector' => $selector
				]
			);

			$th->end_controls_tab();

			//--------------------secound--------------------//
			$th->start_controls_tab(
				$id.'sec_style_tab',
				[
					'label' => esc_html__( 'Hover', 'konsal' ),
				]
			);

			$th->add_control(
				$id.'button_h_color',
				[
					'label' 		=> __( 'Hover Color ', 'konsal' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
                        $selector . ':hover' => 'color:{{VALUE}} !important',
					],
				]
			);

			$th->add_control(
				$id.'button_hover_bg',
				[
					'label' 		=> __( 'Background Hover Color', 'konsal' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' => [
                        $selector . ':hover' => 'background:{{VALUE}} !important',
                        $selector . ':after' => 'background:{{VALUE}} !important',
                    ],
				]
			);

			$th->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => $id.'border2',
					'selector' => $selector.':hover',
				]
			);

			$th->end_controls_tab();

		$th->end_controls_tabs();

		$th->add_control(
			$id.'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$th->add_responsive_control(
			$id.'button_margin',
			[
				'label' 		=> __( 'Margin', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->add_responsive_control(
			$id.'button_padding',
			[
				'label' 		=> __( 'Padding', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		
		$th->add_responsive_control(
			$id.'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->end_controls_section();

    }
}



//function for load elementor widgets field style wise

if (!function_exists('konsal_get_elementor_option')) :
    function konsal_get_elementor_option($template_name = null)
    {
        $template_path = apply_filters('konsal-elementor/template-options', 'elementor-options/');
        $template = locate_template($template_path . $template_name);
        if (!$template) {
            $template = KONSAL_ADDONS  . 'elementor-options/' . $template_name;
        }
        if (file_exists($template)) {
            return $template;
        }
    }
endif;