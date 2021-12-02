<?php

namespace MasterAddons\Inc\Controls;

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class MA_Group_Control_Outline extends Group_Control_Base
{

    protected static $fields;

    public static function get_type()
    {
        return 'outline';
    }

    protected function init_fields()
    {
        $fields = [];

        $fields['outline'] = [
            'label' => _x('Outline Type', 'Outline Control', JLTMA_TD),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => __('None', JLTMA_TD),
                'solid' => _x('Solid', 'Outline Control', JLTMA_TD),
                'double' => _x('Double', 'Outline Control', JLTMA_TD),
                'dotted' => _x('Dotted', 'Outline Control', JLTMA_TD),
                'dashed' => _x('Dashed', 'Outline Control', JLTMA_TD),
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'outline-style: {{VALUE}};',
            ],
        ];
        $fields['width'] = [
            'label' => __('Width', JLTMA_TD),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'unit' => 'px',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ],
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{SELECTOR}}' => 'outline-width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'outline!' => '',
            ],
        ];
        $fields['offset'] = [
            'label' => _x('Offset', 'Outline Control', JLTMA_TD),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'unit' => 'px',
            ],
            'range' => [
                'px' => [
                    'min' => -100,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{SELECTOR}}' => 'outline-offset: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'outline!' => '',
            ],
        ];
        $fields['color'] = [
            'label' => _x('Color', 'Outline Control', JLTMA_TD),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{SELECTOR}}' => 'outline-color: {{VALUE}};',
            ],
            'condition' => [
                'outline!' => '',
            ],
        ];

        return $fields;
    }

    protected function get_default_options()
    {
        return [
            //'popover' => true,
            'popover' => [
                'starter_title' => _x('Outline', 'Outline Control', JLTMA_TD),
                'starter_name' => 'outline_wgt',
            ],
        ];
    }
}
