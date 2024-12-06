<?php /** @noinspection PhpUndefinedClassInspection */
/**
 * Questionar for Elementor
 * Beautiful Frequently Asked Questions element with rich snippets for Elementor
 * Exclusively on https://1.envato.market/questionar-elementor
 *
 * @encoding        UTF-8
 * @version         1.1.6
 * @copyright       (C) 2018 - 2021 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

namespace Merkulove\QuestionarElementor;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

use Exception;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Merkulove\QuestionarElementor\Unity\Plugin as UnityPlugin;

/** @noinspection PhpUnused */
/**
 * Questionar - Custom Elementor Widget.
 **/
class questionar_elementor extends Widget_Base {

    /**
     * Use this to sort widgets.
     * A smaller value means earlier initialization of the widget.
     * Can take negative values.
     * Default widgets and widgets from 3rd party developers have 0 $mdp_order
     **/
    public $mdp_order = 1;

    /**
     * Widget base constructor.
     * Initializing the widget base class.
     *
     * @access public
     * @throws Exception If arguments are missing when initializing a full widget instance.
     * @param array      $data Widget data. Default is an empty array.
     * @param array|null $args Optional. Widget default arguments. Default is null.
     *
     * @return void
     **/
    public function __construct( $data = [], $args = null ) {

        parent::__construct( $data, $args );

        wp_register_style(
            'mdp-questionar-elementor-admin',
            UnityPlugin::get_url().'src/Merkulove/Unity/assets/css/elementor-admin'.UnityPlugin::get_suffix().'.css',
            [], UnityPlugin::get_version()
        );
        wp_register_style(
            'mdp-questionar',
            UnityPlugin::get_url().'css/questionar'.UnityPlugin::get_suffix().'.css',
            [],
            UnityPlugin::get_version()
        );
        wp_enqueue_script(
            'jquery-ui',
            UnityPlugin::get_url().'js/jquery-ui'.UnityPlugin::get_suffix() . '.js',
            array('jquery'),
            UnityPlugin::get_version(),
            true
        );

    }

    /**
     * Return a widget name.
     *
     * @return string
     **/
    public function get_name() {
        return 'mdp-questionar-elementor';
    }

    /**
     * Return the widget title that will be displayed as the widget label.
     *
     * @return string
     **/
    public function get_title() {
        return esc_html__( 'Questionar', 'questionar-elementor' );
    }

    /**
     * Set the widget icon.
     *
     * @return string
     */
    public function get_icon() {
        return 'mdp-questionar-elementor-widget-icon';
    }

    /**
     * Set the category of the widget.
     *
     * @return array with category names
     **/
    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Get widget keywords. Retrieve the list of keywords the widget belongs to.
     *
     * @access public
     *
     * @return array Widget keywords.
     **/
    public function get_keywords() {

        return [
            'Merkulove',
            'Questionar',
            'FAQ',
            'FAQs',
            'accordion',
            'question',
            'answer',
            'expand',
            'hide',
            'schema',
            'snippet'
        ];

    }

    /**
     * Get style dependencies.
     * Retrieve the list of style dependencies the widget requires.
     *
     * @access public
     *
     * @return array Widget styles dependencies.
     **/
    public function get_style_depends() {

        return [ 'mdp-questionar', 'mdp-questionar-elementor-admin' ];

    }

	/**
	 * Get script dependencies.
	 * Retrieve the list of script dependencies the element requires.
	 *
	 * @access public
     *
	 * @return array Element scripts dependencies.
	 **/
	public function get_script_depends() {

		return [];

    }

    /**
     * Content tab for the Questionar repeater
     * @param $repeater
     */
    protected function repeater_tab_content( $repeater ) {

        $repeater->start_controls_tab( 'questionar_cnt', ['label' => esc_html__( 'CONTENT', 'questionar-elementor' )] );

        $repeater->add_control(
            'questionar_title',
            [
                'label' => esc_html__( 'Question', 'questionar-elementor' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Type your title here', 'questionar-elementor' ),
            ]
        );

        $repeater->add_control(
            'questionar_content',
            [
                'label' => esc_html__( 'Answer', 'questionar-elementor' ),
                'type' => Controls_Manager::WYSIWYG,
            ]
        );

        $repeater->end_controls_tab();

    }

    /**
     * Style tab for the Questionar repeater
     * @param $repeater
     */
    protected function repeater_tab_style( $repeater ) {

        $repeater->start_controls_tab( 'questionar_ans', ['label' => esc_html__( 'STYLE', 'questionar-elementor' )] );

        $repeater->add_control(
            'questionar_header_q',
            [
                'label' => __( 'Questions Styles', 'questionar-elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $repeater->add_control(
            'questionar_custom_color_q',
            [
                'label' => esc_html__( 'Question Color', 'questionar-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.mdp-questions' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'questions_custom_background_q',
                'label' => esc_html__( 'Background', 'questionar-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.mdp-questions',
            ]
        );

        $repeater->add_control(
            'questionar_header_a',
            [
                'label' => __( 'Answers Styles', 'questionar-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'questionar_custom_color_a',
            [
                'label' => esc_html__( 'Answer Color', 'questionar-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.mdp-answers' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.mdp-answers *' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'questions_custom_background_a',
                'label' => esc_html__( 'Background', 'questionar-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.mdp-answers',
            ]
        );

        $repeater->end_controls_tab();

    }

    /**
     * Add the widget controls.
     *
     * @since 1.0.0
     * @access protected
     *
     * @return void with category names
     **/
    protected function register_controls() {

        /** Start section questionar. */
        $this->start_controls_section( 'section_questionar',
            [ 'label' => esc_html__( 'Questionar', 'questionar-elementor' ) ] );

        $repeater = new Repeater();

        $repeater->start_controls_tabs( 'questionar_repeater_tabs' );

            $this->repeater_tab_content( $repeater );

            $this->repeater_tab_style( $repeater );

        $repeater->end_controls_tabs();

        /** Questionar items. */
        $this->add_control(
            'questionar_items',
            [
                'label' => esc_html__( 'Questionar items', 'questionar-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'questionar_title' => esc_html__( 'Questionar', 'questionar-elementor' ),
                        'questionar_content' => __( '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. '.
                                                    'Ut elit tellus, luctus nec ullamcorper mattis, pulvinar '.
                                                    'dapibus leo.</p>', 'questionar-elementor' ),
                    ],
                    [
                        'questionar_title' => esc_html__( 'Questionar', 'questionar-elementor' ),
                        'questionar_content' => __( '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. '.
                                                    'Ut elit tellus, luctus nec ullamcorper mattis, pulvinar '.
                                                    'dapibus leo.</p>', 'questionar-elementor' ),
                    ],
                ],
                'title_field' => '{{{questionar_title}}}',
            ]
        );

        /** Questions HTML Tag. */
        $this->add_control(
            'questions_html_tag',
            [
                'label' => esc_html__( 'Questions HTML Tag', 'questionar-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'p' => 'p',
                    'span' => 'span',
                ],
                'default' => 'h4',
                'separator' => 'before',
            ]
        );

        /** Inactive Icon. */
        $this->add_control(
            'questionar_selected_icon',
            [
                'label' => esc_html__( 'Inactive Icon', 'questionar-elementor' ),
                'type' => Controls_Manager::ICONS,
                'separator' => 'before',
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-angle-down',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-down',
                        'angle-down',
                        'angle-double-down',
                        'caret-down',
                        'caret-square-down',
                    ],
                    'fa-regular' => [
                        'caret-square-down',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'layout',
                            'operator' => '!in',
                            'value' => [
                                'expand',
                            ],
                        ],
                    ],
                ],
            ]
        );

        /** Active Icon. */
        $this->add_control(
            'questionar_selected_active_icon',
            [
                'label' => esc_html__( 'Active Icon', 'questionar-elementor' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default' => [
                    'value' => 'fas fa-angle-up',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-up',
                        'angle-up',
                        'angle-double-up',
                        'caret-up',
                        'caret-square-up',
                    ],
                    'fa-regular' => [
                        'caret-square-up',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
                'condition' => [
                    'questionar_selected_icon[value]!' => '',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'layout',
                            'operator' => '!in',
                            'value' => [
                                'expand',
                            ],
                        ],
                    ],
                ],
            ]
        );

        /** FAQ layout. */
        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'FAQ layout', 'questionar-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'collapse' => 'Collapse all',
                    'first' => 'Expand first',
                    'expand' => 'Expand all',
                ],
                'default' => 'first',
                'separator' => 'before'
            ]
        );

        /** Expand Event. */
        $this->add_control(
            'expand_event',
            [
                'label' => esc_html__( 'Expand event', 'questionar-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'click' => 'Click',
                    'dblclick' => 'Double click',
                    'mouseover' => 'Hover',
                ],
                'default' => 'click',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'layout',
                            'operator' => '!in',
                            'value' => [
                                'expand',
                            ],
                        ],
                    ],
                ],
            ]
        );

        /** Expand Event. */
        $this->add_control(
            'collapsible',
            [
                'label' => esc_html__( 'Collapsible', 'questionar-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'questionar-elementor' ),
                'label_off' => esc_html__( 'Off', 'questionar-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'layout',
                            'operator' => '!in',
                            'value' => [
                                'expand',
                            ],
                        ],
                    ],
                ],
            ]
        );

        /** Rich Snippets. */
        $this->add_control(
            'rich_snippets',
            [
                'label' => esc_html__( 'Rich Snippets', 'questionar-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'questionar-elementor' ),
                'label_off' => esc_html__( 'Off', 'questionar-elementor' ),
                'return_value' => 'yes',
                'separator' => 'before'
            ]
        );

        /** End section questionar. */
        $this->end_controls_section();

        /** Questions. */
        $this->start_controls_section( 'style_questions',
            [
                'label' => esc_html__( 'Questions', 'questionar-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ] );

        /** Margin. */
        $this->add_responsive_control(
            'questions_margin',
            [
                'label' => esc_html__( 'Margin', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions' => 'margin: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}};',
                ],
                'toggle' => true,
            ]
        );

        /** Padding. */
        $this->add_responsive_control(
            'questions_padding',
            [
                'label' => esc_html__( 'Padding', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions' => 'padding: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}};',
                ],
                'toggle' => true,
                'separator' => 'after'
            ]
        );

        /** Color. */
        /** @noinspection PhpUndefinedClassInspection */
        $this->add_control(
            'color_questions',
            [
                'label' => esc_html__( 'Ink Color', 'questionar-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions' => 'color: {{VALUE}}',
                ],
            ]
        );

        /** Typography. */
        /** @noinspection PhpUndefinedClassInspection */
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'questions_typography',
                'label' => esc_html__( 'Typography', 'questionar-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mdp-questions',
            ]
        );

        /** Shadow. */
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'questions_shadow',
                'label' => esc_html__( 'Text Shadow', 'questionar-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-questions',
            ]
        );

        /** Alignment. */
        $this->add_responsive_control(
            'questions_align',
            [
                'label' => esc_html__( 'Alignment', 'questionar-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'questionar-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'questionar-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'questionar-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions' => 'text-align: {{questions_align}};',
                ],
                'toggle' => true,
            ]
        );

        /** Background. */
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'questions_background',
                'label' => esc_html__( 'Background', 'questionar-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .mdp-questions',
                'separator' => 'before'
            ]
        );

        /** Box Shadow. */
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'questions_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'questionar-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-questions',
            ]
        );

        /** Border style. */
        $this->add_control(
            'border_style_questions',
            [
                'label' => esc_html__( 'Border style', 'questionar-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'hidden' => 'Hidden',
                    'dotted' => 'Dotted',
                    'dashed' => 'Dashed',
                    'solid' => 'Solid',
                    'double' => 'Double',
                    'groove' => 'Groove',
                    'ridge' => 'Ridge',
                    'inset' => 'Inset',
                    'outset' => 'Outset',
                ],
                'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions' => 'border-style: {{value}};',
                ],

            ]
        );

        /** Border Width. */
        $this->add_responsive_control(
            'border_width_questions',
            [
                'label' => esc_html__( 'Border Width', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions' => 'border-top-width: {{top}}{{unit}}; border-right-width: {{right}}{{unit}}; border-bottom-width: {{bottom}}{{unit}}; border-left-width: {{left}}{{unit}};',
                ],
                'toggle' => true,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'border_style_questions',
                            'operator' => '!in',
                            'value' => [
                                'none',
                            ],
                        ],
                    ],
                ],
            ]
        );

        /** Border Color. */
        $this->add_control(
            'border_color_questions',
            [
                'label' => esc_html__( 'Border Color', 'questionar-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions' => 'border-color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'border_style_questions',
                            'operator' => '!in',
                            'value' => [
                                'none',
                            ],
                        ],
                    ],
                ],
            ]
        );

        /** Border Radius. */
        $this->add_responsive_control(
            'border_radius_questions',
            [
                'label' => esc_html__( 'Border Radius', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions' => 'border-top-right-radius: {{top}}{{unit}}; border-bottom-right-radius: {{right}}{{unit}}; border-bottom-left-radius: {{bottom}}{{unit}}; border-top-left-radius: {{left}}{{unit}};',
                ],
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        /** Icon */
        $this->start_controls_section( 'style_icon',
            [
                'label' => esc_html__( 'Icon', 'questionar-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'layout',
                            'operator' => '!in',
                            'value' => [
                                'expand',
                            ],
                        ],
                    ],
                ],
            ] );

        /** Margin. */
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Margin', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-questionar-icon' => 'margin: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}};',
                ],
                'default' => [
                    'top' => 0,
                    'right' => 20,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => false
                ],
                'toggle' => true,
            ]
        );

        /** Padding. */
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Padding', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-questionar-icon' => 'padding: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}};',
                ],
                'toggle' => true,
            ]
        );

        /** Alignment. */
        $this->add_control(
            'icon_align',
            [
                'label' => esc_html__( 'Alignment', 'questionar-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'questionar-elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'questionar-elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => is_rtl() ? 'right' : 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .mdp-questionar-icon' => 'float: {{value}}; text-align: {{value}};',
                ],
            ]
        );

        /** Background. */
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'questions_icon_background',
                'label' => esc_html__( 'Background', 'questionar-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .mdp-questionar-icon',
            ]
        );

        /** Color. */
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Collapsed Icon Color', 'questionar-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions.ui-accordion-header-collapsed span.mdp-questionar-icon' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        /** Size. */
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Collapsed Icon Size', 'questionar-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'size' => '16',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ui-accordion-header span.mdp-questionar-icon' => 'font-size: {{size}}{{unit}}; width: {{size}}{{unit}}; height: {{size}}{{unit}};',
                ],
                'separator' => 'after'
            ]
        );

        /** Active Color. */
        $this->add_control(
            'icon_active_color',
            [
                'label' => esc_html__( 'Active Color', 'questionar-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .ui-accordion-header.ui-accordion-header-active span.mdp-questionar-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        /** Active Size. */
        $this->add_responsive_control(
            'icon_active_size',
            [
                'label' => esc_html__( 'Active Size', 'questionar-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'size' => '16',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-questions.ui-accordion-header-active span.mdp-questionar-icon' => 'font-size: {{size}}{{unit}}; width: {{size}}{{unit}}; height: {{size}}{{unit}};',
                ],
            ]
        );

        $this->end_controls_section();

        /** Answers. */
        $this->start_controls_section( 'style_answers',
            [
                'label' => esc_html__( 'Answers', 'questionar-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ] );

        /** Margin. */
        $this->add_responsive_control(
            'answers_margin',
            [
                'label' => esc_html__( 'Margin', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-answers' => 'margin: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}};',
                ],
                'toggle' => true,
            ]
        );

        /** Padding. */
        $this->add_responsive_control(
            'answers_padding',
            [
                'label' => esc_html__( 'Padding', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-answers' => 'padding: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}};',
                ],
                'toggle' => true,
                'separator' => 'after'
            ]
        );

        /** Color. */
        /** @noinspection PhpUndefinedClassInspection */
        $this->add_control(
            'color_answers',
            [
                'label' => esc_html__( 'Ink Color', 'questionar-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-answers p' => 'color: {{VALUE}}',
                ],
            ]
        );

        /** Typography. */
        /** @noinspection PhpUndefinedClassInspection */
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'answers_typography',
                'label' => esc_html__( 'Typography', 'questionar-elementor' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mdp-answer-text',
            ]
        );

        /** Alignment. */
        $this->add_responsive_control(
            'answers_align',
            [
                'label' => esc_html__( 'Alignment', 'questionar-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'questionar-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'questionar-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'questionar-elementor' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'questionar-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .mdp-answers' => 'text-align: {{answers_align}};',
                ],
                'toggle' => true,
            ]
        );

        /** Background. */
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'answers_background',
                'label' => esc_html__( 'Background', 'questionar-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .mdp-answers',
                'separator' => 'before'
            ]
        );

        /** Box Shadow. */
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'answers_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'questionar-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-answers',
            ]
        );

        /** Border style. */
        $this->add_control(
            'border_style_answers',
            [
                'label' => esc_html__( 'Border style', 'questionar-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'hidden' => 'Hidden',
                    'dotted' => 'Dotted',
                    'dashed' => 'Dashed',
                    'solid' => 'Solid',
                    'double' => 'Double',
                    'groove' => 'Groove',
                    'ridge' => 'Ridge',
                    'inset' => 'Inset',
                    'outset' => 'Outset',
                ],
                'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .mdp-answers' => 'border-style: {{border_style_answers.value}};',
                ],
            ]
        );

        /** Border Width. */
        $this->add_responsive_control(
            'border_width_answers',
            [
                'label' => esc_html__( 'Border Width', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-answers' => 'border-top-width: {{top}}{{unit}}; border-right-width: {{right}}{{unit}}; border-bottom-width: {{bottom}}{{unit}}; border-left-width: {{left}}{{unit}};',
                ],
                'toggle' => true,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'border_style_answers',
                            'operator' => '!in',
                            'value' => [
                                'none',
                            ],
                        ],
                    ],
                ],
            ]
        );

        /** Border Color. */
        $this->add_control(
            'border_color_answers',
            [
                'label' => esc_html__( 'Border Color', 'questionar-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mdp-answers' => 'border-color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'border_style_answers',
                            'operator' => '!in',
                            'value' => [
                                'none',
                            ],
                        ],
                    ],
                ],
            ]
        );

        /** Border Radius. */
        $this->add_responsive_control(
            'border_radius_answers',
            [
                'label' => esc_html__( 'Border Radius', 'questionar-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-answers' => 'border-top-right-radius: {{top}}{{unit}}; border-bottom-right-radius: {{right}}{{unit}}; border-bottom-left-radius: {{bottom}}{{unit}}; border-top-left-radius: {{left}}{{unit}};',
                ],
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

    }

    /**
     * We display the text of questions and answers.
     *
     * @param array $settings
     *
     * @return string $questionar
     */
    public function get_questionar( $settings ){

        $accordion = $settings['questionar_items'];

        $questionar = '<div id="accordion-' . $this->get_id() . '">';

        foreach ( $accordion as $info ){
            $questionar .= '<' . $settings['questions_html_tag'] . ' class="mdp-questions elementor-repeater-item-' . esc_attr( $info['_id'] ) .  '">' . $info['questionar_title'] . '</' . $settings['questions_html_tag'] . '>';
            $questionar .= '<div class="mdp-answers elementor-repeater-item-' . esc_attr( $info['_id'] ) . '">';
            $questionar .= '<div class="mdp-answer-text">' . $info['questionar_content'] . '</div></div>';
        }

        $questionar .= '</div>';

        return $questionar;
    }

    /**
     * Rich Snippets.
     *
     * @param array $settings
     *
     * @return string $json
     *
     * @since 1.0.0
     */
    public function get_questionar_json( $settings ){

        $accordion = $settings['questionar_items'];

        $json = '<script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "FAQPage",
          "mainEntity": [';

        foreach ( $accordion as $info ) {

            // Replace " by '
            $name = str_replace( '"', "'", $info['questionar_title'] );
            $text = str_replace( '"', "'", $info['questionar_content'] );

            $json .= '{
                    "@type": "Question",
                    "name": "' . wp_kses( $name, 'default') . '",
                    "acceptedAnswer": {
                      "@type": "Answer",
                      "text": "' . wp_kses( $text, 'default') . '"
                    }
                  }';

            if( $info !== end($accordion) ){
                $json .= ',';
            }

        }

        $json .= ']
        }
        </script>';

        return $json;
    }

    /**
     * Get icon class and echo style for the custom icon
     * @param $icon
     * @param $color
     * @param $idSection
     * @return string
     */
    private function get_style_for_custom_icons( $icon, $color, $idSection, $suffix ): string
    {

        $is_icon = isset( $icon[ 'value' ] );
        if ( ! $is_icon ) { return ''; }

        $is_custom_icon = is_array( $icon[ 'value' ] );
        $icon_class = $is_custom_icon ? 'mdp-custom-icon-' . $idSection : $icon[ 'value' ];

        if ( $is_custom_icon ) {
            echo wp_sprintf(

                '<!--suppress ALL -->
            <style>
                .ui-accordion-header%1$s{
                    display: inline-block;
                    mask-image: url(%2$s);
                    -webkit-mask-image: url(%2$s);
                    mask-repeat: no-repeat;
                    -webkit-mask-repeat: no-repeat;
                    mask-size: contain;
                    -webkit-mask-size: contain;
                    background-color: %3$s !important;
                }
            </style>',

                $suffix === 'active' ? '.ui-accordion-header-active .' . $icon_class : ' .' . $icon_class,
                esc_attr($icon['value']['url']),
                esc_attr($color)

            );
        }

        return $icon_class;

    }

    /**
     * Render Frontend Output. Generate the final HTML on the frontend.
     *
     * @since 1.0.0
     * @access protected
     **/
    protected function render() {

        /** We get all the values from the admin panel. */
        $settings = $this->get_settings_for_display();

        /** Section id. */
        $idSection = $this->get_id();

        /** FAQ's */
        echo $this->get_questionar( $settings );

        /** Rich snippets */
        if( $settings['rich_snippets'] === 'yes' ){
            echo $this->get_questionar_json( $settings );
        }

        /** Layout */
        if ( 'expand' !== $settings[ 'layout' ] ) {

            $layout =  ( $settings[ 'layout' ] === 'first' ) ? '0' : 'false';
            $collapsible = ( $settings[ 'collapsible' ] === 'yes' ) ? 'true' : 'false';

            $icon_class = $this->get_style_for_custom_icons(
                $settings['questionar_selected_icon'],
                $settings['icon_color'],
                $idSection,
                'collapsed'
            );
            $icon_class_active = $this->get_style_for_custom_icons(
                $settings['questionar_selected_active_icon'],
                $settings['icon_active_color'],
                $idSection,
                'active'
            );
            ?>

            <!--suppress JSUnresolvedFunction -->
            <script>
                jQuery( document ).ready(function() {

                    let icons_<?php echo esc_attr($idSection); ?> = {
                        header: "<?php echo esc_attr( $icon_class . ' mdp-questionar-icon' ); ?>",
                        activeHeader: "<?php echo esc_attr( $icon_class_active . ' mdp-questionar-icon' ); ?>"
                    };

                    jQuery( "#accordion-<?php echo esc_attr($idSection); ?>" ).accordion( {
                        icons: icons_<?php echo esc_attr($idSection); ?>,
                        collapsible: <?php echo esc_attr( $collapsible ) ?>,
                        active: <?php echo esc_attr( $layout ) ?>,
                        event: "<?php echo esc_attr( $settings[ 'expand_event' ] ) ?>",
                        animate: {
                            duration: 500
                        },
                        heightStyle: "content"
                    });

                });
            </script>
            <?php
        }

    }

    /**
     * Return link for documentation.
     *
     * Used to add stuff after widget.
     *
     * @since 1.0.0
     * @access public
     **/
    public function get_custom_help_url() {
        return 'https://docs.merkulov.design/category/questionar-elementor/';
    }

}
