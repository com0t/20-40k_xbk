<?php

namespace MasterAddons\Inc\Classes;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Animation
{
    /**
     * Register widget controls.
     *
     * Adds base animation controls.
     */
    public static function register_section_animation(Widget_Base $element, $is_multiple, $condition)
    {
        if (true === $is_multiple) {
            $pointer_options = array(
                'none'       => __('None', JLTMA_TD),
                'underline'  => __('Underline', JLTMA_TD),
                'overline'   => __('Overline', JLTMA_TD),
                'background' => __('Background', JLTMA_TD),
                'text'       => __('Text', JLTMA_TD),
            );
        } else {
            $pointer_options = array(
                'none'       => __('None', JLTMA_TD),
                'underline'  => __('Underline', JLTMA_TD),
                'overline'   => __('Overline', JLTMA_TD),
                'background' => __('Background', JLTMA_TD),
            );
        }

        $element->start_controls_section(
            'animation',
            array(
                'label'      => __('Pointer Animation', JLTMA_TD),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => $condition,
            )
        );

        $element->add_control(
            'pointer',
            array(
                'label'          => __('Hover Effect', JLTMA_TD),
                'type'           => Controls_Manager::SELECT,
                'default'        => 'none',
                'options'        => $pointer_options,
                'render_type'    => 'template',
                'prefix_class'   => 'jltma-pointer-',
                'style_transfer' => true,
            )
        );

        $element->add_control(
            'animation_line',
            array(
                'label'   => __('Animation', JLTMA_TD),
                'type'    => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => array(
                    'slide'    => 'Slide',
                    'grow'     => 'Grow',
                    'drop-in'  => 'Drop In',
                    'drop-out' => 'Drop Out',
                    'none'     => 'None',
                ),
                'render_type'  => 'template',
                'prefix_class' => 'jltma-animation-',
                'condition'    => array(
                    'pointer' => array('overline'),
                ),
            )
        );

        $element->add_control(
            'animation_underline',
            array(
                'label'   => __('Animation', JLTMA_TD),
                'type'    => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => array(
                    'slide'    => 'Slide',
                    'grow'     => 'Grow',
                    'drop-in'  => 'Drop In',
                    'drop-out' => 'Drop Out',
                    'none'     => 'None',
                ),
                'render_type'  => 'template',
                'prefix_class' => 'jltma-animation-',
                'condition'    => array(
                    'pointer' => array('underline'),
                ),
            )
        );

        $element->add_control(
            'animation_background',
            array(
                'label'   => __('Animation', JLTMA_TD),
                'type'    => 'jltma-choose-text',
                'options' => array(
                    'sweep-filling' => array(
                        'title'       => __('Sweep', JLTMA_TD),
                        'description' => __('Sweep Filling', JLTMA_TD),
                    ),
                    'grow' => array(
                        'title' => __('Grow', JLTMA_TD),
                    ),
                ),
                'default'      => 'sweep-filling',
                'label_block'  => false,
                'toggle'       => false,
                'render_type'  => 'template',
                'prefix_class' => 'jltma-animation-',
                'condition'    => array('pointer' => 'background'),
            )
        );

        $element->add_control(
            'animation_text',
            [
                'label'   => __('Animation', JLTMA_TD),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grow',
                'options' => [
                    'grow'   => 'Grow',
                    'shrink' => 'Shrink',
                    'sink'   => 'Sink',
                    'float'  => 'Float',
                    'skew'   => 'Skew',
                    'rotate' => 'Rotate',
                ],
                'render_type'  => 'template',
                'prefix_class' => 'jltma-animation-',
                'condition'    => [
                    'pointer' => 'text',
                ],
            ]
        );

        $element->add_control(
            'animation_filling_direction',
            array(
                'label' => __('Sweep Direction', JLTMA_TD),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'sweep-left' => array(
                        'title' => __('Left', JLTMA_TD),
                        'description' => __('Sweep Left', JLTMA_TD),
                    ),
                    'sweep-right' => array(
                        'title' => __('Right', JLTMA_TD),
                        'description' => __('Sweep Right', JLTMA_TD),
                    ),
                    'sweep-top' => array(
                        'title' => __('Top', JLTMA_TD),
                        'description' => __('Sweep Top', JLTMA_TD),
                    ),
                    'sweep-bottom' => array(
                        'title' => __('Bottom', JLTMA_TD),
                        'description' => __('Sweep Bottom', JLTMA_TD),
                    ),
                ),
                'label_block' => true,
                'toggle' => false,
                'render_type' => 'template',
                'default' => 'sweep-top',
                'prefix_class' => 'jltma-direction-',
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '=',
                            'value' => 'background',
                        ),
                        array(
                            'name' => 'animation_background',
                            'operator' => '=',
                            'value' => 'sweep-filling',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_background_side',
            array(
                'label' => __('Side', JLTMA_TD),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'left' => array('title' => __('Left', JLTMA_TD)),
                    'right' => array('title' => __('Right', JLTMA_TD)),
                    'top' => array('title' => __('Top', JLTMA_TD)),
                    'bottom' => array('title' => __('Bottom', JLTMA_TD)),
                ),
                'label_block' => true,
                'toggle' => false,
                'render_type' => 'template',
                'default' => 'bottom',
                'prefix_class' => 'jltma-animation-side-',
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '=',
                            'value' => 'background',
                        ),
                        array(
                            'name' => 'animation_background',
                            'operator' => '=',
                            'value' => 'advanced-filling-xy',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_background_position_y',
            array(
                'label' => __('Position', JLTMA_TD),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'top' => array('title' => __('Top', JLTMA_TD)),
                    'center' => array('title' => __('Center', JLTMA_TD)),
                    'bottom' => array('title' => __('Bottom', JLTMA_TD)),
                ),
                'label_block' => true,
                'toggle' => false,
                'default' => 'center',
                'selectors_dictionary' => array(
                    'top' => 'top: 0;',
                    'bottom' => 'bottom: 0;',
                    'center' => 'top: 0; bottom: 0;',
                ),
                'selectors' => array(
                    '{{WRAPPER}}.jltma-animation-advanced-filling-xy .jltma-animation:after' => '{{VALUE}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '=',
                            'value' => 'background',
                        ),
                        array(
                            'name' => 'animation_background',
                            'operator' => '=',
                            'value' => 'advanced-filling-xy',
                        ),
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'animation_background_side',
                                    'operator' => '=',
                                    'value' => 'left',
                                ),
                                array(
                                    'name' => 'animation_background_side',
                                    'operator' => '=',
                                    'value' => 'right',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_background_position_x',
            array(
                'label' => __('Start Position', JLTMA_TD),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'left' => array('title' => __('Left', JLTMA_TD)),
                    'center' => array('title' => __('Center', JLTMA_TD)),
                    'right' => array('title' => __('Right', JLTMA_TD)),
                ),
                'label_block' => true,
                'toggle' => false,
                'default' => 'center',
                'selectors_dictionary' => array(
                    'left' => 'left: 0;',
                    'right' => 'right: 0;',
                    'center' => 'left: 0; right: 0;',
                ),
                'selectors' => array(
                    '{{WRAPPER}}.jltma-animation-advanced-filling-xy .jltma-animation:after' => '{{VALUE}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '=',
                            'value' => 'background',
                        ),
                        array(
                            'name' => 'animation_background',
                            'operator' => '=',
                            'value' => 'advanced-filling-xy',
                        ),
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'animation_background_side',
                                    'operator' => '=',
                                    'value' => 'top',
                                ),
                                array(
                                    'name' => 'animation_background_side',
                                    'operator' => '=',
                                    'value' => 'bottom',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        self::register_section_style_animation_advanced($element, $is_multiple);

        $element->end_controls_section();
    }

    /**
     * Register advanced widget controls.
     *
     * Adds additional controls, that adds lots of variations.
     */
    public static function register_section_style_animation_advanced(Widget_Base $element, $is_multiple)
    {
        $element->add_control(
            'animation_advanced_size',
            array(
                'label' => __('Line Size', JLTMA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => array(
                    'unit' => 'px',
                    'size' => '4',
                ),
                'size_units' => array('px', '%', 'em'),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-line-size: {{SIZE}}{{UNIT}};',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'background',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_line_position',
            array(
                'label' => __('Position', JLTMA_TD),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', '%'),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                    '%' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-line-background-position: {{SIZE}}{{UNIT}};',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'background',
                        ),
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'pointer',
                                    'operator' => '=',
                                    'value' => 'underline',
                                ),
                                array(
                                    'name' => 'pointer',
                                    'operator' => '=',
                                    'value' => 'overline',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_use_gradient',
            array(
                'label' => __('Use Gradient', JLTMA_TD),
                'type' => Controls_Manager::SWITCHER,
                'render_type' => 'template',
                'prefix_class' => 'jltma-animation-use-gradient-',
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_color',
            array(
                'label' => __('Color', JLTMA_TD),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-color: {{VALUE}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_color_stop',
            array(
                'label' => __('Location', JLTMA_TD),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('%'),
                'default' => array(
                    'unit' => '%',
                    'size' => 0,
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-color-stop: {{SIZE}}{{UNIT}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                        array(
                            'name' => 'animation_use_gradient',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_second_color',
            array(
                'label' => __('Second Color', JLTMA_TD),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-second-color: {{VALUE}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                        array(
                            'name' => 'animation_use_gradient',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_second_color_stop',
            array(
                'label' => __('Location', JLTMA_TD),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('%'),
                'default' => array(
                    'unit' => '%',
                    'size' => 100,
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-second-color-stop: {{SIZE}}{{UNIT}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                        array(
                            'name' => 'animation_use_gradient',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_gradient_type',
            array(
                'label' => _x('Type', 'Background Control', JLTMA_TD),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'linear' => _x('Linear', 'Background Control', JLTMA_TD),
                    'radial' => _x('Radial', 'Background Control', JLTMA_TD),
                ),
                'default' => 'linear',
                'prefix_class' => 'jltma-color-gradient-',
                'render_type' => 'template',
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                        array(
                            'name' => 'animation_use_gradient',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_gradient_angle',
            array(
                'label' => _x('Angle', 'Background Control', JLTMA_TD),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('deg'),
                'default' => array(
                    'unit' => 'deg',
                    'size' => 90,
                ),
                'range' => array(
                    'deg' => array('step' => 10),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-gradient-angle: {{SIZE}}{{UNIT}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                        array(
                            'name' => 'animation_use_gradient',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                        array(
                            'name' => 'animation_gradient_type',
                            'operator' => '=',
                            'value' => 'linear',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'animation_gradient_position',
            array(
                'label' => _x('Position', 'Background Control', JLTMA_TD),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'center center' => _x('Center Center', 'Background Control', JLTMA_TD),
                    'center left' => _x('Center Left', 'Background Control', JLTMA_TD),
                    'center right' => _x('Center Right', 'Background Control', JLTMA_TD),
                    'top center' => _x('Top Center', 'Background Control', JLTMA_TD),
                    'top left' => _x('Top Left', 'Background Control', JLTMA_TD),
                    'top right' => _x('Top Right', 'Background Control', JLTMA_TD),
                    'bottom center' => _x('Bottom Center', 'Background Control', JLTMA_TD),
                    'bottom left' => _x('Bottom Left', 'Background Control', JLTMA_TD),
                    'bottom right' => _x('Bottom Right', 'Background Control', JLTMA_TD),
                ),
                'default' => 'center center',
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-gradient-radial: at {{VALUE}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'text',
                        ),
                        array(
                            'name' => 'animation_use_gradient',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                        array(
                            'name' => 'animation_gradient_type',
                            'operator' => '=',
                            'value' => 'radial',
                        ),
                    ),
                ),
            )
        );

        $element->add_control(
            'divider_after_gradient',
            array(
                'type' => Controls_Manager::DIVIDER,
                'condition' => array('animation_use_gradient' => 'yes'),
            )
        );

        $element->add_control(
            'animation_advanced_transition',
            array(
                'label' => __('Transition Duration', JLTMA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => array('size' => 0.3),
                'range' => array(
                    'px' => array(
                        'max' => 3,
                        'step' => 0.1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => '--animation-transition-duration: {{SIZE}}s;',
                ),
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'name' => 'pointer',
                            'operator' => '!==',
                            'value' => 'none',
                        ),
                    ),
                ),
            )
        );
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     */
    public static function register_sections_controls(Widget_Base $element, $is_multiple = true, $condition = '')
    {
        self::register_section_animation($element, $is_multiple, $condition);
    }

    /**
     * Get animation class.
     */
    public static function get_animation_class()
    {
        $class = 'jltma-animation';

        return $class;
    }
}
