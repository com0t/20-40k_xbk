<?php

namespace MasterAddons\Inc\Controls;

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Custom Animate-element group control
 *
 */
class MA_Control_Animation_Element extends Group_Control_Base
{

    protected static $fields;

    public static function get_type()
    {
        return 'animation-element';
    }

    protected function init_fields()
    {
        $fields = [];

        $fields['controls'] = [
            'label' => __('', JLTMA_TD),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'running',
            'toggle' => false,
            'options' => [
                'running' => [
                    'title' => __('Play', JLTMA_TD),
                    'icon' => 'fa fa-play',
                ],
                'paused' => [
                    'title' => __('Pause', JLTMA_TD),
                    'icon' => 'fa fa-pause',
                ],
            ],
            'separator' => 'after',
            'selectors' => [
                '{{SELECTOR}}' => 'animation-play-state: {{VALUE}}; -webkit-animation-play-state: {{VALUE}};',
            ],
        ];

        $fields['animation'] = [
            'label' => _x('Animation Type', 'Animation Control', JLTMA_TD),
            'type' => Controls_Manager::SELECT,
            'default' => 'galleggia',
            'options' => [
                'galleggia' => _x('Float', 'Animation Control', JLTMA_TD),
                'attraversa' => _x('Pass through', 'Animation Control', JLTMA_TD),
                'pulsa' => _x('Pulse', 'Animation Control', JLTMA_TD),
                'dondola' => _x('Swing', 'Animation Control', JLTMA_TD),
                'cresci' => _x('Grow', 'Animation Control', JLTMA_TD),
                'esplodi' => _x('Explode', 'Animation Control', JLTMA_TD),
                'brilla' => _x('Shine', 'Animation Control', JLTMA_TD),
                'risali-o-affonda' => _x('Up or Sink', 'Animation Control', JLTMA_TD),
                'rotola' => _x('Spin', 'Animation Control', JLTMA_TD),
                'gira' => _x('Runs', 'Animation Control', JLTMA_TD),
                'saltella' => _x('Bounce', 'Animation Control', JLTMA_TD),
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'animation-name: {{VALUE}}; -webkit-animation-name: {{VALUE}};',
            ],
        ];
        $fields['animation_variation'] = [
            'label' => _x('Animation Variation', 'Animation Control', JLTMA_TD),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                'short' => _x('Short', 'Animation Control', JLTMA_TD),
                '' => _x('Medium', 'Animation Control', JLTMA_TD),
                'long' => _x('Long', 'Animation Control', JLTMA_TD),
            ],
            'condition' => [
                'enabled_animations' => 'yes',
                'animation!' => ['cresci', 'attraversa'],
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'animation-name: {{animation.VALUE}}{{VALUE}}; -webkit-animation-name: {{animation.VALUE}}{{VALUE}};',
            ],
        ];
        $fields['transform_origin'] = [
            'label' => _x('Transform origin', 'Animation Control', JLTMA_TD),
            'type' => Controls_Manager::SELECT,
            'default' => 'center center',
            'options' => [
                'top left' => _x('Top Left', 'Animation Control', JLTMA_TD),
                'top center' => _x('Top Center', 'Animation Control', JLTMA_TD),
                'top right' => _x('Top Right', 'Animation Control', JLTMA_TD),
                'center left' => _x('Center Left', 'Animation Control', JLTMA_TD),
                'center center' => _x('Center Center', 'Animation Control', JLTMA_TD),
                'center right' => _x('Center Right', 'Animation Control', JLTMA_TD),
                'bottom left' => _x('Bottom Left', 'Animation Control', JLTMA_TD),
                'bottom center' => _x('Bottom Center', 'Animation Control', JLTMA_TD),
                'bottom right' => _x('Bottom Right', 'Animation Control', JLTMA_TD),
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'transform-origin: {{VALUE}}; -webkit-transform-origin: {{VALUE}};',
            ],
        ];
        $fields['iteration_mode'] = [
            'label' => __('Iteration Mode', JLTMA_TD),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'infinite',
            'label_on' => __('Infinite', JLTMA_TD),
            'label_off' => __('Count', JLTMA_TD),
            'return_value' => 'infinite',
            'separator' => 'before',
            'selectors' => [
                '{{SELECTOR}}' => 'animation-iteration-count: {{VALUE}}; -webkit-animation-iteration-count: {{VALUE}};',
            ],
        ];
        $fields['iteration_count'] = [
            'label' => __('Iteration Count', JLTMA_TD),
            'type' => Controls_Manager::NUMBER,
            'default' => 1,
            'min' => 1,
            'max' => 100,
            'step' => 1,
            'selectors' => [
                '{{SELECTOR}}' => 'animation-iteration-count: {{VALUE}}; -webkit-animation-iteration-count: {{VALUE}};',
            ],
            'condition' => [
                'iteration_mode' => '',
            ],
        ];
        $fields['duration'] = [
            'label' => _x('Duration', 'Animation Control', JLTMA_TD),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'unit' => 's',
                'size' => 1,
            ],
            'range' => [
                's' => [
                    'min' => 0,
                    'max' => 20,
                    'step' => 0.1,
                ],
            ],
            'size_units' => ['s'],
            'selectors' => [
                '{{SELECTOR}}' => 'animation-duration: {{SIZE}}{{UNIT}}; -webkit-animation-duration: {{SIZE}}{{UNIT}};',
            ],
        ];
        $fields['delay'] = [
            'label' => _x('Delay', 'Animation Control', JLTMA_TD),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'unit' => 's',
                'size' => 0,
            ],
            'range' => [
                's' => [
                    'min' => 0,
                    'max' => 20,
                    'step' => 0.1,
                ],
            ],
            'size_units' => ['s'],
            'selectors' => [
                '{{SELECTOR}}' => 'animation-delay: {{SIZE}}{{UNIT}}; -webkit-animation-delay: {{SIZE}}{{UNIT}};',
            ],
        ];

        $fields['timing_function'] = [
            'label' => _x('Timing Function', 'Animation Control', JLTMA_TD),
            'type' => Controls_Manager::SELECT,
            'default' => 'linear',
            'options' => DCE_Helper::get_anim_timingFunctions(),
            'selectors' => [
                '{{SELECTOR}}' => 'animation-timing-function: {{VALUE}}; -webkit-animation-timing-function: {{VALUE}};',
            ],
        ];
        /* $fields['iteration_mode'] = [
		  'label' => __( 'Iteration Mode', JLTMA_TD ),
		  'type' => Controls_Manager::CHOOSE,
		  'default' => 'counter',
		  'options' => [
		  'counter'    => [
		  'title' => __( 'Counter', JLTMA_TD ),
		  'icon' => 'eicon-counter',
		  ],
		  'infinite' => [
		  'title' => __( 'Infinite', JLTMA_TD ),
		  'icon' => 'eicon-sync',
		  ],
		  'selectors' => [
		  ],
		  ],
		  'condition' => [
		  ],
		  ]; */

        $fields['direction'] = [
            'label' => __('Direction', JLTMA_TD),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'normal',
            'options' => [
                'normal' => [
                    'title' => __('Normal', JLTMA_TD),
                    'icon' => 'eicon-arrow-right',
                ],
                'reverse' => [
                    'title' => __('Reverse', JLTMA_TD),
                    'icon' => 'eicon-arrow-left',
                ],
                'alternate' => [
                    'title' => __('Alternate', JLTMA_TD),
                    'icon' => 'fa fa-refresh',
                ],
                'alternate-reverse' => [
                    'title' => __('Alternate Reverse', JLTMA_TD),
                    'icon' => 'fa fa-retweet',
                ],
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'animation-direction: {{VALUE}}; -webkit-animation-direction: {{VALUE}};',
            ],
        ];
        $fields['fill_mode'] = [
            'label' => __('Fill Mode', JLTMA_TD),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'none',
            'options' => [
                'none' => [
                    'title' => __('None', JLTMA_TD),
                    'icon' => 'eicon-close',
                ],
                'backwards' => [
                    'title' => __('Backwards', JLTMA_TD),
                    'icon' => 'eicon-h-align-right',
                ],
                'both' => [
                    'title' => __('Both', JLTMA_TD),
                    'icon' => 'eicon-h-align-center',
                ],
                'forwards' => [
                    'title' => __('Forwards', JLTMA_TD),
                    'icon' => 'eicon-h-align-left',
                ],
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'animation-fill-mode: {{VALUE}}; -webkit-animation-fill-mode: {{VALUE}};',
            ],
        ];

        return $fields;
    }

    /*
	  animation-timing-function: steps(10);

	  animation-name: example;
	  animation-duration: 4s;

	  animation-iteration-count: 3;
	  animation-iteration-count: infinite;

	  animation-direction: alternate;
	  animation-direction: alternate-reverse;

	  animation-delay: 2s;

	  animation-fill-mode: forwards;
	  animation-fill-mode: backwards;
	  animation-fill-mode: both;

	  -webkit-animation-timing-function: linear;

	  animation-play-state: paused; running

	  animation-timing-function: linear
	  animation-timing-function: ease
	  animation-timing-function: ease-in
	  animation-timing-function: ease-out
	  animation-timing-function: ease-in-out

	  animation: example 5s linear 2s infinite alternate;
	 */

    /**
     * @since 0.5.0
     * @access protected
     */
    protected function get_default_options()
    {
        return [
            'popover' => false,
            /* 'popover' => [
				  'starter_title' => _x( 'Animate', 'Animation Control', JLTMA_TD ),
				  'starter_name' => 'animate_element',
				  ], */
        ];
    }
}
