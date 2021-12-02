<?php

namespace MasterAddons\Addons;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/26/19
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;



if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Progress_Bars extends Widget_Base
{

	public function get_name()
	{
		return 'ma-progressbars';
	}

	public function get_title()
	{
		return esc_html__('Progressbars', JLTMA_TD);
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-skill-bar';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_script_depends()
	{
		return [
			'master-addons-waypoints',
			'master-addons-scripts',
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/multiple-progress-bars/';
	}


	protected function register_controls()
	{

		$this->start_controls_section(
			'section_stats_bars',
			[
				'label' => __('Stats Bars', JLTMA_TD),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'stats_title',
			[
				'label'       => __('Stats Title', JLTMA_TD),
				'type'        => Controls_Manager::TEXT,
				'description' => __('The title for the stats bar', JLTMA_TD),
				'default'     => __('My stats title', JLTMA_TD),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'percentage_value',
			[
				'label'       => __('Percentage Value', JLTMA_TD),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 100,
				'step'        => 1,
				'default'     => 30,
				'description' => __('The percentage value for the stats.', JLTMA_TD),
			]
		);

		$repeater->add_control(
			'bar_color',
			[
				'label'   => __('Bar Color', JLTMA_TD),
				'type'    => Controls_Manager::COLOR,
				'default' => '',
			]
		);


		$this->add_control(
			'stats_bars',
			[
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'stats_title' => __('Web Design', JLTMA_TD),
						'percentage_value' => 87,
					],

					[
						'stats_title' => __('SEO Services', JLTMA_TD),
						'percentage_value' => 76,
					],

					[
						'stats_title' => __('Brand Marketing', JLTMA_TD),
						'percentage_value' => 40,
					],
				],
				'fields' 				=> $repeater->get_controls(),
				'title_field' => '{{{ stats_title }}}',
			]
		);

		$this->end_controls_section();




		/**
		 * Content Tab: Docs Links
		 */
		$this->start_controls_section(
			'jltma_section_help_docs',
			[
				'label' => esc_html__('Help Docs', JLTMA_TD),
			]
		);


		$this->add_control(
			'help_doc_1',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', JLTMA_TD), '<a href="https://master-addons.com/demos/multiple-progress-bars/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', JLTMA_TD), '<a href="https://master-addons.com/docs/addons/progress-bars-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', JLTMA_TD), '<a href="https://www.youtube.com/watch?v=Mc9uDWJQMIY" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();


		//Upgrade to Pro
		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', JLTMA_TD),
				]
			);

			$this->add_control(
				'jltma_control_get_pro_style_tab',
				[
					'label' => esc_html__('Unlock more possibilities', JLTMA_TD),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}


		$this->start_controls_section(
			'section_stats_bar_styling',
			[
				'label' => esc_html__('Stats Bar', JLTMA_TD),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'stats_bar_bg_color',
			[
				'label' => esc_html__('Bar BG Color', JLTMA_TD),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .jltma-stats-bar-bg' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stats_bar_active_bar_bg_color',
			[
				'label' 		=> esc_html__('Active Bar Color', JLTMA_TD),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '#704aff'
			]
		);



		$this->add_control(
			'stats_bar_spacing',
			[
				'label' => esc_html__('Vertical Spacing', JLTMA_TD),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 18,
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 128,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'stats_bar_height',
			[
				'label' 		=> __('Bar Height', JLTMA_TD),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> ['px'],
				'default' 		=> [
					'size' 	=> 10,
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 1,
						'max' => 96,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .jltma-stats-bar-bg, {{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .jltma-stats-bar-content' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .jltma-stats-bar-bg' => 'margin-top: -{{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'stats_bar_border_radius',
			[
				'label' => __('Stats Bar Border Radius', JLTMA_TD),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .jltma-stats-bar-bg, {{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .jltma-stats-bar-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->end_controls_section();


		$this->start_controls_section(
			'section_stats_title',
			[
				'label' => __('Stats Title', JLTMA_TD),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'stats_title_color',
			[
				'label' => __('Color', JLTMA_TD),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .ma-el-stats-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'stats_title_typography',
				'selector' => '{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .ma-el-stats-title',
			]
		);

		$this->end_controls_section();



		// Stats Percentage
		$this->start_controls_section(
			'section_stats_percentage',
			[
				'label' => __('Stats Percentage', JLTMA_TD),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'stats_percentage_align',
			[
				'label' 		=> esc_html__('Alignment', JLTMA_TD),
				'type' 			=> Controls_Manager::CHOOSE,
				'label_block' 	=> false,
				'options' 		=> [
					'left' 	=> [
						'title' 	=> esc_html__('Left', JLTMA_TD),
						'icon' 		=> 'eicon-h-align-left',
					],
					'inherit' 	=> [
						'title' 	=> esc_html__('Default', JLTMA_TD),
						'icon' 		=> 'eicon-h-align-center',
					],
					'right' 		=> [
						'title' 		=> esc_html__('Right', JLTMA_TD),
						'icon' 			=> 'eicon-h-align-right',
					],
				],
				'default' 		 => 'inherit',
				'style_transfer' => true,
				'selectors' => [
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .ma-el-stats-title span' => 'float: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'stats_percentage_spacing',
			[
				'label' => __('Padding', JLTMA_TD),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 5,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .ma-el-stats-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'isLinked' => false
			]
		);

		$this->add_control(
			'stats_percentage_color',
			[
				'label' => __('Color', JLTMA_TD),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .ma-el-stats-title span' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'stats_percentage_typography',
				'selector' => '{{WRAPPER}} .jltma-stats-bars .jltma-stats-bar .ma-el-stats-title span',
			]
		);

		$this->end_controls_section();



		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_upgrade_pro',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', JLTMA_TD),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'maad_el_control_get_pro',
				[
					'label' => esc_html__('Unlock more possibilities', JLTMA_TD),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					//						wp_redirect( '' )
					'description' => '<span class="pro-feature"> Upgrade to <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}

	protected function render()
	{

		$settings = $this->get_settings_for_display();

		$settings = apply_filters('ma_el_stats_bars_' . $this->get_id() . '_settings', $settings);

		$output = '<div class="jltma-stats-bars">';

		foreach ($settings['stats_bars'] as $stats_bar) :

			$color_style = '';
			$color = ($stats_bar['bar_color']) ? $stats_bar['bar_color'] : $settings['stats_bar_active_bar_bg_color'];

			if ($color)
				$color_style = ' style="background:' . esc_attr($color) . ';"';

			$child_output = '<div class="jltma-stats-bar">';

			$child_output .= '<div class="jltma-stats-title">';

			$child_output .= esc_html($stats_bar['stats_title']);

			$child_output .= '<span>' . esc_attr($stats_bar['percentage_value']) . '%</span>';

			$child_output .= '</div>';

			$child_output .= '<div class="jltma-stats-bar-wrap">';

			$child_output .= '<div ' . $color_style . ' class="jltma-stats-bar-content" data-perc="' . esc_attr($stats_bar['percentage_value']) . '"></div>';

			$child_output .= '<div class="jltma-stats-bar-bg"></div>';

			$child_output .= '</div>';

			$child_output .= '</div><!-- .jltma-stats-bar -->';

			$output .= apply_filters('ma_el_stats_bar_output', $child_output, $stats_bar, $settings);

		endforeach;

		$output .= '</div><!-- .jltma-stats-bars -->';

		echo apply_filters('ma_el_stats_bars_output', $output, $settings);
	}

	protected function content_template()
	{
	}
}
