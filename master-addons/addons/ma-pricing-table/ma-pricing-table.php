<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;


use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL : https://master-addons.com
 * Date       : 10/27/19
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Master Addons: Pricing Table
 */
class JLTMA_Pricing_Table extends Widget_Base
{

	public function get_name()
	{
		return 'ma-pricing-table';
	}

	public function get_title()
	{
		return __('Pricing Table', JLTMA_TD);
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-price-table';
	}

	public function get_keywords()
	{
		return [
			'pricing',
			'price',
			'cost table',
			'data table',
			'money table',
			'table',
			'value',
			'pricing table',
			'pricingtable',
			'rate',
			'comparision table'
		];
	}

	public function get_style_depends()
	{
		return [
			'jltma-tippy',
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_script_depends()
	{
		return [
			'jltma-popper',
			'jltma-tippy',
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/pricing-table/';
	}


	protected function register_controls()
	{

		$this->start_controls_section(
			'ma_el_pricing_table_section_start',
			[
				'label' => __('Pricing Contents', JLTMA_TD),
			]
		);

		// Pricing Layout
		$this->add_control(
			'ma_el_pricing_table_layout',
			[
				'label'   => __('Layout', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'   => __('Default', JLTMA_TD),
					'two'   => __('Left Align Content', JLTMA_TD),
					'three' => __('Rounded Table', JLTMA_TD),
					'four'  => __('Table with BG Image', JLTMA_TD),
					'five'  => __('Skew BG Pattern', JLTMA_TD),
				],
			]
		);


		$this->add_control(
			'ma_el_pricing_table_highlight',
			[
				'label' => __('Highlight Table?', JLTMA_TD),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'ma_el_pricing_table_features_show',
			[
				'label'   => __('Show Features?', JLTMA_TD),
				'default' => 'yes',
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();


		// Image
		$this->start_controls_section(
			'ma_el_pricing_table_section_content_image',
			[
				'label'     => __('Image', JLTMA_TD),
				'condition' => ['ma_el_pricing_table_layout' => 'four']
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'ma_el_pricing_table_image',
				'selector' => '{{WRAPPER}} .table-bg-image',
			]
		);

		$this->end_controls_section();



		//Heading

		$this->start_controls_section(
			'ma_el_pricing_table_section_header',
			[
				'label' => __('Header', JLTMA_TD),
			]
		);

		$this->add_control(
			'ma_el_pricing_table_head_color_scheme',
			[
				'label'   => __('Header BG Color', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'default' => 'gradient-1',
				'options' => [
					'gradient-1' => __('Gradient One', JLTMA_TD),
					'gradient-2' => __('Gradient Two', JLTMA_TD),
					'gradient-3' => __('Gradient Three', JLTMA_TD),
					'custom'     => __('Custom (Style Tab Settings)', JLTMA_TD)
				],
				'condition' => [
					'ma_el_pricing_table_layout!' => ['three', 'four', 'five']
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_icon',
			[
				'label'            => esc_html__('Icon', JLTMA_TD),
				'description'      => esc_html__('Please choose an icon from the list.', JLTMA_TD),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'far fa-lightbulb',
					'library' => 'regular',
				],
				'render_type' => 'template',
				'condition'   => ['ma_el_pricing_table_layout' => 'four'],
			]
		);


		$this->add_control(
			'ma_el_pricing_table_heading',
			[
				'label'   => __('Title', JLTMA_TD),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Personal', JLTMA_TD),
			]
		);

		$this->add_control(
			'ma_el_pricing_table_heading_tag',
			[
				'label'   => __('HTML Tag', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h3',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_sub_heading',
			[
				'label'   => __('Subtitle', JLTMA_TD),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Suitable for single website', JLTMA_TD),
			]
		);

		$this->end_controls_section();


		//Pricing

		$this->start_controls_section(
			'ma_el_pricing_table_section_pricing',
			[
				'label' => __('Pricing', JLTMA_TD),
			]
		);

		$this->add_control(
			'ma_el_pricing_table_currency_symbol',
			[
				'label'   => __('Currency Symbol', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''             => __('None', JLTMA_TD),
					'dollar'       => '&#36; ' . _x('Dollar', 'Currency Symbol', JLTMA_TD),
					'euro'         => '&#128; ' . _x('Euro', 'Currency Symbol', JLTMA_TD),
					'baht'         => '&#3647; ' . _x('Baht', 'Currency Symbol', JLTMA_TD),
					'franc'        => '&#8355; ' . _x('Franc', 'Currency Symbol', JLTMA_TD),
					'guilder'      => '&fnof; ' . _x('Guilder', 'Currency Symbol', JLTMA_TD),
					'krona'        => 'kr ' . _x('Krona', 'Currency Symbol', JLTMA_TD),
					'lira'         => '&#8356; ' . _x('Lira', 'Currency Symbol', JLTMA_TD),
					'peseta'       => '&#8359 ' . _x('Peseta', 'Currency Symbol', JLTMA_TD),
					'peso'         => '&#8369; ' . _x('Peso', 'Currency Symbol', JLTMA_TD),
					'pound'        => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', JLTMA_TD),
					'real'         => 'R$ ' . _x('Real', 'Currency Symbol', JLTMA_TD),
					'ruble'        => '&#8381; ' . _x('Ruble', 'Currency Symbol', JLTMA_TD),
					'rupee'        => '&#8360; ' . _x('Rupee', 'Currency Symbol', JLTMA_TD),
					'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', JLTMA_TD),
					'shekel'       => '&#8362; ' . _x('Shekel', 'Currency Symbol', JLTMA_TD),
					'yen'          => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', JLTMA_TD),
					'won'          => '&#8361; ' . _x('Won', 'Currency Symbol', JLTMA_TD),
					'custom'       => __('Custom', JLTMA_TD),
				],
				'default' => 'dollar',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_currency_symbol_custom',
			[
				'label'     => __('Custom Symbol', JLTMA_TD),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'ma_el_pricing_table_currency_symbol' => 'custom',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_price',
			[
				'label'   => __('Price', JLTMA_TD),
				'type'    => Controls_Manager::TEXT,
				'default' => '29.99',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_sale',
			[
				'label' => __('Sale', JLTMA_TD),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'ma_el_pricing_table_original_price',
			[
				'label'     => __('Original Price', JLTMA_TD),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '99',
				'condition' => [
					'ma_el_pricing_table_sale' => 'yes',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_period',
			[
				'label'   => __('Period', JLTMA_TD),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Monthly', JLTMA_TD),
			]
		);

		$this->end_controls_section();



		//Pricing Features

		$this->start_controls_section(
			'ma_el_pricing_table_section_content_features',
			[
				'label'     => __('Features', JLTMA_TD),
				'condition' => [
					'ma_el_pricing_table_features_show' => 'yes'
				]
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('ma_el_pricing_table_features_list_tabs');

		$repeater->start_controls_tab(
			'ma_el_pricing_table_features_list_tab_normal_text',
			[
				'label' => __('Text', JLTMA_TD)
			]
		);

		$repeater->add_control(
			'ma_el_pricing_table_item_text',
			[
				'label'   => __('Text', JLTMA_TD),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Feature', JLTMA_TD),
			]
		);

		$repeater->add_control(
			'ma_el_pricing_table_item_icon_show',
			[
				'label'     => __('Show Icon', JLTMA_TD),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);

		$repeater->add_control(
			'ma_el_pricing_table_item_icon',
			[
				'label'            => esc_html__('Icon', JLTMA_TD),
				'description'      => esc_html__('Please choose an icon from the list.', JLTMA_TD),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-check',
					'library' => 'solid',
				],
				'render_type' => 'template',
				'condition'   => [
					'ma_el_pricing_table_item_icon_show!' => '',
				],
			]
		);

		$repeater->end_controls_tab();

		// Icon Style
		$repeater->start_controls_tab(
			'ma_el_pricing_table_features_list_tab_tooltip_icon',
			[
				'label' => __('Icon', JLTMA_TD),
				'condition'   => [
					'ma_el_pricing_table_item_icon_show!' => '',
				],
			]
		);

		$repeater->add_control(
			'ma_el_pricing_table_item_icon_color',
			[
				'label'     => __('Icon Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details li{{CURRENT_ITEM}} i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .jltma-price-table-details li{{CURRENT_ITEM}} svg path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$repeater->add_responsive_control(
			'ma_el_pricing_table_item_icon_size',
			[
				'label' => __('Icon Size', JLTMA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details li{{CURRENT_ITEM}} i,
					{{WRAPPER}} .jltma-price-table-details li{{CURRENT_ITEM}} svg path' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'ma_el_pricing_table_item_icon_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-details li{{CURRENT_ITEM}} i,
					{{WRAPPER}} .jltma-price-table-details li{{CURRENT_ITEM}} svg path' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'ma_el_pricing_table_item_icon_margin',
			[
				'label'      => __('Margin', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-details li{{CURRENT_ITEM}} i,
					{{WRAPPER}} .jltma-price-table-details li{{CURRENT_ITEM}} svg path' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->end_controls_tab();


		// Tooltips Settings
		$repeater->start_controls_tab(
			'ma_el_pricing_table_features_list_tab_tooltip_text',
			[
				'label' => __('Tooltip', JLTMA_TD)
			]
		);

		$repeater->add_control(
			'ma_el_pricing_table_tooltip_text',
			[
				'label' => __('Text', JLTMA_TD),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$repeater->add_control(
			'ma_el_pricing_table_tooltip_placement',
			[
				'label'   => __('Placement', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top'    => __('Top', JLTMA_TD),
					'bottom' => __('Bottom', JLTMA_TD),
					'left'   => __('Left', JLTMA_TD),
					'right'  => __('Right', JLTMA_TD),
				],
				'condition'   => [
					'ma_el_pricing_table_tooltip_text!' => '',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'ma_el_pricing_table_features_list',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'ma_el_pricing_table_item_text'    => __('Feature #1', JLTMA_TD),
						'ma_el_pricing_table_item_icon'    => 'fa fa-check',
						'ma_el_pricing_table_tooltip_text' => 'Feature One Tooltip',
					],
					[
						'ma_el_pricing_table_item_text'    => __('Feature #2', JLTMA_TD),
						'ma_el_pricing_table_item_icon'    => 'fa fa-check',
						'ma_el_pricing_table_tooltip_text' => 'Feature Two Tooltip',
					],
					[
						'ma_el_pricing_table_item_text'    => __('Feature #3', JLTMA_TD),
						'ma_el_pricing_table_item_icon'    => 'fa fa-check',
						'ma_el_pricing_table_tooltip_text' => 'Feature Three Tooltip',
					],
				],
				'title_field' => '{{{ ma_el_pricing_table_item_text }}}',
			]
		);

		$this->end_controls_section();



		//Pricing Footer

		$this->start_controls_section(
			'ma_el_pricing_table_section_content_footer',
			[
				'label' => __('Footer', JLTMA_TD),
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_text',
			[
				'label'   => __('Button Text', JLTMA_TD),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Purchase Now', JLTMA_TD),
			]
		);

		if (class_exists('Easy_Digital_Downloads')) {
			$edd_posts = get_posts(['numberposts' => 10, 'post_type'   => 'download']);
			$options   = ['0' => __('Select EDD', JLTMA_TD)];
			foreach ($edd_posts as $edd_post) {
				$options[$edd_post->ID] = $edd_post->post_title;
			}
		} else {
			$options = ['0' => __('Not found', JLTMA_TD)];
		}

		$this->add_control(
			'ma_el_pricing_table_edd_as_button',
			[
				'label' => __('Easy Digital Download Integration', JLTMA_TD),
				'type'  => Controls_Manager::SWITCHER,
				'return_value' => 'yes'
			]
		);


		$this->add_control(
			'ma_el_pricing_table_edd_id',
			[
				'label'       => __('Easy Digital Download Item', JLTMA_TD),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => $options,
				'label_block' => true,
				'condition'   => [
					'ma_el_pricing_table_edd_as_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_link',
			[
				'label'       => __('Link', JLTMA_TD),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default'     => [
					'url' => '#',
				],
				'condition' => [
					'ma_el_pricing_table_edd_as_button' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_footer_additional_info',
			[
				'label'   => __('Additional Info', JLTMA_TD),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __('This is footer text', JLTMA_TD),
				'rows'    => 2,
			]
		);

		$this->end_controls_section();




		//Header Style

		$this->start_controls_section(
			'ma_el_pricing_table_section_style_header',
			[
				'label' => __('Header', JLTMA_TD),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_pricing_table_header_bg_color_heading',
			[
				'label'     => __('Header Background', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ma_el_pricing_table_head_color_scheme' => 'custom',
					'ma_el_pricing_table_layout!'           => 'five'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ma_el_pricing_table_header_bg_color',
				'selector'  => '{{WRAPPER}} .jltma-price-table-head',
				'condition' => [
					'ma_el_pricing_table_head_color_scheme' => 'custom',
					'ma_el_pricing_table_layout!'           => 'five'
				]
			]
		);

		$this->add_control(
			'ma_el_pricing_table_header_rounded_bg_color_heading',
			[
				'label'     => __('Rounded Background', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ma_el_pricing_table_layout' => 'three'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ma_el_pricing_table_heading_rounded_bg_color',
				'label'     => __('Rounded BG Color', JLTMA_TD),
				'types'     => ['gradient'],
				'selector'  => '{{WRAPPER}} .table-active-zoom .jltma-table-price-area',
				'condition' => [
					'ma_el_pricing_table_layout' => 'three'
				]
			]
		);

		$this->add_control(
			'ma_el_pricing_table_header_pattern_bg_color_heading',
			[
				'label'     => __('Pattern Background', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ma_el_pricing_table_layout' => 'five'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ma_el_pricing_table_heading_pattern_bg_color',
				'label'     => __('Pattern BG Color', JLTMA_TD),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .table-bg-pattern .jltma-price-table:before, {{WRAPPER}} .table-bg-pattern .jltma-price-table:after',
				'condition' => [
					'ma_el_pricing_table_layout' => 'five'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_heading_pattern_bg_height',
			[
				'label'   => __('Height', JLTMA_TD),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 280,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 25,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .table-bg-pattern .jltma-price-table:before' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_heading_after_pattern_bg_ver_pos',
			[
				'label'   => __('Vertical Position(Pattern Bar)', JLTMA_TD),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 36,
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 25,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .table-bg-pattern .jltma-price-table:after' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_header_margin',
			[
				'label'      => __('Margin', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ma_el_pricing_table_header_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_heading_heading_style',
			[
				'label'     => __('Title', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_heading_color',
			[
				'label'     => __('Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_pricing_table_heading_typography',
				'selector' => '{{WRAPPER}} .jltma-price-table-title',
				'scheme'   => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'ma_el_pricing_table_heading_sub_heading_style',
			[
				'label'     => __('Sub Title', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_sub_heading_color',
			[
				'label'     => __('Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-subheading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_pricing_table_sub_heading_typography',
				'selector' => '{{WRAPPER}} .jltma-price-table-subheading',
				'scheme'   => Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();



		//Pricing Style

		$this->start_controls_section(
			'ma_el_pricing_table_section_style_pricing',
			[
				'label' => __('Pricing', JLTMA_TD),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_pricing_table_pricing_element_bg_color',
			[
				'label'     => __('Background Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-table-price-area' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_pricing_element_margin',
			[
				'label'      => __('Margin', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-table-price-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ma_el_pricing_table_pricing_element_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-table-price-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_price_color',
			[
				'label'     => __('Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-table-price-area, {{WRAPPER}} .jltma-price-table-original-price, {{WRAPPER}} .jltma-table-price-currency, {{WRAPPER}} .jltma-table-price-amount, {{WRAPPER}} .jltma-fraction-price, {{WRAPPER}} .jltma-price-amount-duration' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_pricing_table_price_typography',
				'selector' => '{{WRAPPER}} .jltma-table-price-area',
				'scheme'   => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'ma_el_pricing_table_heading_currency_style',
			[
				'label'     => __('Currency Symbol', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ma_el_pricing_table_currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_currency_size',
			[
				'label' => __('Size', JLTMA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-table-price-currency' => 'font-size: {{SIZE}}px',
				],
				'condition' => [
					'ma_el_pricing_table_currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_currency_vertical_position',
			[
				'label'   => __('Vertical Position', JLTMA_TD),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __('Top', JLTMA_TD),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', JLTMA_TD),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', JLTMA_TD),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'              => 'top',
				'selectors_dictionary' => [
					'top'    => 'top',
					'middle' => 'super',
					'bottom' => 'bottom',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-table-price-currency' => 'vertical-align: {{VALUE}}',
				],
				'condition' => [
					'ma_el_pricing_table_currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_fractional_part_style',
			[
				'label'     => __('Fractional Part', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_fractional-part_size',
			[
				'label' => __('Size', JLTMA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-fraction-price' => 'font-size: {{SIZE}}px',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_fractional_part_vertical_position',
			[
				'label'   => __('Vertical Position', JLTMA_TD),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __('Top', JLTMA_TD),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', JLTMA_TD),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', JLTMA_TD),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'              => 'top',
				'selectors_dictionary' => [
					'top'    => 'top',
					'middle' => 'super',
					'bottom' => 'bottom',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-fraction-price' => 'vertical-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_heading_original_price_style',
			[
				'label'     => __('Original Price', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ma_el_pricing_table_sale'            => 'yes',
					'ma_el_pricing_table_original_price!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_original_price_color',
			[
				'label'     => __('Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-original-price' => 'color: {{VALUE}}',
				],
				'condition' => [
					'ma_el_pricing_table_sale'            => 'yes',
					'ma_el_pricing_table_original_price!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ma_el_pricing_table_original_price_typography',
				'selector'  => '{{WRAPPER}} .jltma-price-table-original-price',
				'scheme'    => Typography::TYPOGRAPHY_1,
				'condition' => [
					'ma_el_pricing_table_sale'            => 'yes',
					'ma_el_pricing_table_original_price!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_original_price_vertical_position',
			[
				'label'   => __('Vertical Position', JLTMA_TD),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __('Top', JLTMA_TD),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', JLTMA_TD),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', JLTMA_TD),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'default'   => 'bottom',
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-original-price' => 'align-self: {{VALUE}}',
				],
				'condition' => [
					'ma_el_pricing_table_sale'            => 'yes',
					'ma_el_pricing_table_original_price!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_heading_period_style',
			[
				'label'     => __('Period', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ma_el_pricing_table_period!' => '',
				],
			]
		);


		$this->add_control(
			'ma_el_pricing_table_show_period',
			[
				'label'     => __('Show Dot', JLTMA_TD),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'ma_el_pricing_table_period!' => '',
				],
			]
		);


		$this->add_control(
			'ma_el_pricing_table_period_color',
			[
				'label'     => __('Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-amount-duration' => 'color: {{VALUE}}',
				],
				'condition' => [
					'ma_el_pricing_table_period!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ma_el_pricing_table_period_typography',
				'selector'  => '{{WRAPPER}} .jltma-price-amount-duration',
				'scheme'    => Typography::TYPOGRAPHY_1,
				'condition' => [
					'ma_el_pricing_table_period!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_period_position',
			[
				'label'   => __('Position', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'below'  => 'Below',
					'beside' => 'Beside',
				],
				'default'   => 'below',
				'condition' => [
					'ma_el_pricing_table_period!' => '',
				],
			]
		);

		$this->end_controls_section();



		//Features Style

		$this->start_controls_section(
			'ma_el_pricing_table_section_style_features',
			[
				'label' => __('Features', JLTMA_TD),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_style_features');

		$this->start_controls_tab(
			'tab_features_normal_text',
			[
				'label' => __('Normal Text', JLTMA_TD)
			]
		);

		$this->add_control(
			'ma_el_pricing_table_features_list_bg_color',
			[
				'label'     => __('Background Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_features_list_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_features_list_color',
			[
				'label'     => __('Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details .jltma-tooltip-content, {{WRAPPER}} .edd_price_options li span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_pricing_table_features_list_typography',
				'selector' => '{{WRAPPER}} .jltma-price-table-details li .jltma-tooltip-content, {{WRAPPER}} .edd_price_options li span',
				'scheme'   => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'ma_el_pricing_table_features_list_alignment',
			[
				'label'   => __('Alignment', JLTMA_TD),
				'type'    => Controls_Manager::CHOOSE,
				'options' => Master_Addons_Helper::jltma_content_alignment(),
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details li' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_item_width',
			[
				'label' => __('Width', JLTMA_TD),
				'type'  => Controls_Manager::SLIDER,
				'size_units'    => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details ul' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_list_divider',
			[
				'label'     => __('Divider', JLTMA_TD),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_divider_style',
			[
				'label'   => __('Style', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'solid'  => __('Solid', JLTMA_TD),
					'double' => __('Double', JLTMA_TD),
					'dotted' => __('Dotted', JLTMA_TD),
					'dashed' => __('Dashed', JLTMA_TD),
				],
				'default'   => 'solid',
				'condition' => [
					'ma_el_pricing_table_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details li:before' => 'border-top-style: {{VALUE}};',
					'{{WRAPPER}} .jltma-pricing-tables.table-active-zoom .jltma-price-table-details li' => 'border-bottom-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_divider_color',
			[
				'label'     => __('Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffc107',
				'condition' => [
					'ma_el_pricing_table_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details li:before' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-pricing-tables.table-active-zoom .jltma-price-table-details li' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_divider_height',
			[
				'label'   => __('height', JLTMA_TD),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'ma_el_pricing_table_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details li:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-pricing-tables.table-active-zoom .jltma-price-table-details li' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_divider_width',
			[
				'label'     => __('Width', JLTMA_TD),
				'type'      => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 45,
						'max' => 1000,
					],
				],
				'condition' => [
					'ma_el_pricing_table_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details li:before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-pricing-tables.table-active-zoom .jltma-price-table-details li' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_divider_gap',
			[
				'label'   => __('Gap', JLTMA_TD),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'condition' => [
					'ma_el_pricing_table_list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-details li:before' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .jltma-pricing-tables.table-active-zoom .jltma-price-table-details li' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_pricing_table_tab_features_tooltip_text',
			[
				'label' => __('Tooltip Text', JLTMA_TD)
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_features_tooltip_width',
			[
				'label'      => esc_html__('Width', JLTMA_TD),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [
					'px', 'em',
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text' => 'width: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_pricing_table_features_tooltip_typography',
				'selector' => '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_features_tooltip_color',
			[
				'label'     => esc_html__('Text Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_features_tooltip_text_align',
			[
				'label'   => esc_html__('Text Alignment', JLTMA_TD),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => Master_Addons_Helper::jltma_content_alignment(),
				'selectors'  => [
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'ma_el_pricing_table_features_tooltip_background',
				'selector' => '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_features_tooltip_arrow_color',
			[
				'label'     => esc_html__('Arrow Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item.tooltip-top .jltma-tooltip-text:after'   => 'border-color: {{VALUE}} transparent transparent transparent',
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item.tooltip-right .jltma-tooltip-text:after' => 'border-color:
						transparent {{VALUE}} transparent transparent',
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item.tooltip-left .jltma-tooltip-text:after'  => 'border-color:
						transparent transparent transparent {{VALUE}}',
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item.tooltip-bottom .jltma-tooltip-text:after' =>
					'border-color: transparent transparent {{VALUE}} transparent',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_features_tooltip_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'render_type' => 'template',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ma_el_pricing_table_features_tooltip_border',
				'label'       => esc_html__('Border', JLTMA_TD),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text',
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_features_tooltip_border_radius',
			[
				'label'      => __('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ma_el_pricing_table_features_tooltip_box_shadow',
				'selector' => '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();




		// Ribbon

		$this->start_controls_section(
			'ma_el_pricing_table_section_content_ribbon',
			[
				'label' => __('Ribbon', JLTMA_TD),
			]
		);

		$this->add_control(
			'ma_el_pricing_table_show_ribbon',
			[
				'label'     => __('Show', JLTMA_TD),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_ribbon_title',
			[
				'label'     => __('Title', JLTMA_TD),
				'type'      => Controls_Manager::TEXT,
				'default'   => __('Popular', JLTMA_TD),
				'condition' => [
					'ma_el_pricing_table_show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_ribbon_align',
			[
				'label'   => __('Align', JLTMA_TD),
				'type'    => Controls_Manager::CHOOSE,
				'options' => Master_Addons_Helper::jltma_content_alignments(),
				'default'   => 'left',
				'condition' => [
					'ma_el_pricing_table_show_ribbon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_ribbon_horizontal_position',
			[
				'label' => __('Horizontal Position', JLTMA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
					],
				],
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'condition' => [
					'ma_el_pricing_table_show_ribbon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_ribbon_vertical_position',
			[
				'label' => __('Vertical Position', JLTMA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
					],
				],
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'condition' => [
					'ma_el_pricing_table_show_ribbon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_ribbon_rotate',
			[
				'label'   => __('Rotate', JLTMA_TD),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
						'step' => 5,
					],
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .jltma-price-table-ribbon-inner' => 'transform: translate({{ma_el_pricing_table_ribbon_horizontal_position.SIZE}}{{UNIT}}, {{ma_el_pricing_table_ribbon_vertical_position.SIZE}}{{UNIT}}) rotate({{SIZE}}deg);',
					'(tablet){{WRAPPER}} .jltma-price-table-ribbon-inner'  => 'transform: translate({{ma_el_pricing_table_ribbon_horizontal_position_tablet.SIZE}}{{UNIT}}, {{ma_el_pricing_table_ribbon_vertical_position_tablet.SIZE}}{{UNIT}}) rotate({{SIZE}}deg);',
					'(mobile){{WRAPPER}} .jltma-price-table-ribbon-inner'  => 'transform: translate({{ma_el_pricing_table_ribbon_horizontal_position_mobile.SIZE}}{{UNIT}}, {{ma_el_pricing_table_ribbon_vertical_position_mobile.SIZE}}{{UNIT}}) rotate({{SIZE}}deg);',
				],
				'condition' => [
					'ma_el_pricing_table_show_ribbon' => 'yes',
				],
			]
		);

		$this->end_controls_section();


		/* Header Style */





		/* Footer Style */

		$this->start_controls_section(
			'ma_el_pricing_table_section_style_footer',
			[
				'label' => __('Footer', JLTMA_TD),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_pricing_table_footer_bg_color',
			[
				'label'     => __('Background Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-footer' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_footer_margin',
			[
				'label'      => __('Margin', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ma_el_pricing_table_footer_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_heading_footer_button',
			[
				'label'     => __('Button', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_size',
			[
				'label'   => __('Size', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'md' => __('Default', JLTMA_TD),
					'sm' => __('Small', JLTMA_TD),
					'xs' => __('Extra Small', JLTMA_TD),
					'lg' => __('Large', JLTMA_TD),
					'xl' => __('Extra Large', JLTMA_TD),
				],
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->start_controls_tabs('ma_el_pricing_table_tabs_button_style');

		$this->start_controls_tab(
			'ma_el_pricing_table_tab_button_normal',
			[
				'label'     => __('Normal', JLTMA_TD),
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_text_color',
			[
				'label'     => __('Text Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-btn' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ma_el_pricing_table_button_background_color',
				'selector'  => '{{WRAPPER}} .jltma-price-table-btn',
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				]
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ma_el_pricing_table_button_border',
				'label'       => __('Border', JLTMA_TD),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-price-table-btn',
				'condition'   => [
					'ma_el_pricing_table_button_text!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_border_radius',
			[
				'label'      => __('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_margin',
			[
				'label'      => __('Margin', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_text_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'after',
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ma_el_pricing_table_button_shadow',
				'selector' => '{{WRAPPER}} .jltma-price-table-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ma_el_pricing_table_button_typography',
				'label'     => __('Typography', JLTMA_TD),
				'scheme'    => Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .jltma-price-table-btn',
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_pricing_table_tab_button_hover',
			[
				'label'     => __('Hover', JLTMA_TD),
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_hover_color',
			[
				'label'     => __('Text Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-btn:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_background_hover_color',
			[
				'label'     => __('Background Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-btn:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_hover_border_color',
			[
				'label'     => __('Border Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-btn:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ma_el_pricing_table_button_text!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_button_hover_animation',
			[
				'label'     => __('Animation', JLTMA_TD),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ma_el_pricing_table_heading_additional_info',
			[
				'label'     => __('Additional Info', JLTMA_TD),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ma_el_pricing_table_footer_additional_info!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_additional_info_color',
			[
				'label'     => __('Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-additional_info p' => 'color: {{VALUE}}',
				],
				'condition' => [
					'ma_el_pricing_table_footer_additional_info!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ma_el_pricing_table_additional_info_typography',
				'selector'  => '{{WRAPPER}} .jltma-price-table-additional_info',
				'scheme'    => Typography::TYPOGRAPHY_1,
				'condition' => [
					'ma_el_pricing_table_footer_additional_info!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_additional_info_margin',
			[
				'label'      => __('Margin', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'    => 15,
					'right'  => 30,
					'bottom' => 0,
					'left'   => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-additional_info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'ma_el_pricing_table_footer_additional_info!' => '',
				],
			]
		);

		$this->end_controls_section();



		//Ribbon
		$this->start_controls_section(
			'ma_el_pricing_table_section_style_ribbon',
			[
				'label'     => __('Ribbon', JLTMA_TD),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ma_el_pricing_table_show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_ribbon_bg_color',
			[
				'label'     => __('Background Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6e3ded',
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-ribbon-inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_ribbon_text_color',
			[
				'label'     => __('Text Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jltma-price-table-ribbon-inner' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_pricing_table_ribbon_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-ribbon-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_pricing_table_ribbon_border_radius',
			[
				'label'      => __('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-price-table-ribbon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'shadow',
				'selector' => '{{WRAPPER}} .jltma-price-table-ribbon-inner',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .jltma-price-table-ribbon-inner',
				'scheme'   => Typography::TYPOGRAPHY_1,
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', JLTMA_TD), '<a href="https://master-addons.com/demos/pricing-table/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', JLTMA_TD), '<a href="https://master-addons.com/docs/addons/pricing-table-elementor-free-widget/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', JLTMA_TD), '<a href="https://www.youtube.com/watch?v=_FUk1EfLBUs" target="_blank" rel="noopener">', '</a>'),
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
					'label'   => esc_html__('Unlock more possibilities', JLTMA_TD),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}


	private function jltma_pt_get_currency_symbol($symbol_name)
	{
		$symbols = [
			'dollar'       => '&#36;',
			'baht'         => '&#3647;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'guilder'      => '&fnof;',
			'indian_rupee' => '&#8377;',
			'krona'        => 'kr',
			'lira'         => '&#8356;',
			'peseta'       => '&#8359',
			'peso'         => '&#8369;',
			'pound'        => '&#163;',
			'real'         => 'R$',
			'ruble'        => '&#8381;',
			'rupee'        => '&#8360;',
			'shekel'       => '&#8362;',
			'won'          => '&#8361;',
			'yen'          => '&#165;',
		];
		return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
	}


	public function jltma_pt_render_image()
	{

		$settings = $this->get_settings();

		if (empty($settings['ma_el_pricing_table_image']['url'])) {
			return;
		}

		$this->add_render_attribute('wrapper', 'class', 'jltma-pricing-table-image');

?>
		<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
			<?php echo Group_Control_Image_Size::get_attachment_image_html($settings); ?>
		</div>
		<?php
	}


	public function jltma_pt_render_heading()
	{
		$settings = $this->get_settings();

		$ma_el_pricing_table_layout = $settings['ma_el_pricing_table_layout'];

		if ($settings['ma_el_pricing_table_heading'] || $settings['ma_el_pricing_table_sub_heading']) { ?>

			<?php if ($ma_el_pricing_table_layout == 'four') {


				if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
					$settings['icon'] = 'far fa-lightbulb';
				}

				$has_icon = !empty($settings['icon']);
				if ($has_icon and 'icon' == $settings['ma_el_pricing_table_icon']) {
					$this->add_render_attribute('jltma-icon', 'class', $settings['ma_el_pricing_table_icon']);
					$this->add_render_attribute('jltma-icon', 'aria-hidden', 'true');
				}

				if (!$has_icon && !empty($settings['ma_el_pricing_table_icon']['value'])) {
					$has_icon = true;
				}

				$migrated = isset($settings['__fa4_migrated']['ma_el_pricing_table_icon']);
				$is_new   = empty($settings['icon']) && Icons_Manager::is_migration_allowed();


				if ($is_new || $migrated) {
					Icons_Manager::render_icon($settings['ma_el_pricing_table_icon'], ['aria-hidden' => 'true']);
				} else {
					echo '<i ' . $this->get_render_attribute_string('jltma-icon') . '></i>';
				}
			} ?>

			<?php if (!empty($settings['ma_el_pricing_table_heading'])) : ?>
				<<?php echo esc_attr($settings['ma_el_pricing_table_heading_tag']); ?> class="jltma-price-table-title">
					<?php echo esc_html($settings['ma_el_pricing_table_heading']); ?>
				</<?php echo esc_attr($settings['ma_el_pricing_table_heading_tag']); ?>>
			<?php endif; ?>

			<?php if (!empty($settings['ma_el_pricing_table_sub_heading'])) { ?>
				<div class="jltma-price-table-subheading"><?php echo esc_html($settings['ma_el_pricing_table_sub_heading']);
															?></div>
			<?php } ?>

		<?php }
	}


	public function jltma_pt_render_price_symbol()
	{
		$settings     = $this->get_settings();
		$price_symbol = '';
		$price        = explode('.', $settings['ma_el_pricing_table_price']);
		$intpart      = $price[0];


		if (!empty($settings['ma_el_pricing_table_currency_symbol'])) {
			if ($settings['ma_el_pricing_table_currency_symbol'] !== 'custom') {
				$price_symbol = $this->jltma_pt_get_currency_symbol($settings['ma_el_pricing_table_currency_symbol']);
			} else {
				$price_symbol = $settings['ma_el_pricing_table_currency_symbol_custom'];
			}
		}

		if ($settings['ma_el_pricing_table_sale'] && !empty($settings['ma_el_pricing_table_original_price'])) { ?>
			<span class="jltma-price-table-original-price">
				<?php echo esc_html($price_symbol . $settings['ma_el_pricing_table_original_price']); ?>
			</span>
		<?php }

		if (!empty($price_symbol) && is_numeric($intpart)) { ?>
			<span class="jltma-table-price-currency">
				<?php echo esc_attr($price_symbol); ?>
			</span>
		<?php }
	}


	public function jltma_pt_render_price_amount()
	{
		$settings = $this->get_settings();
		$price    = explode('.', $settings['ma_el_pricing_table_price']);
		$intpart  = $price[0];

		if (!empty($intpart) || 0 <= $intpart) { ?>
			<span class="jltma-table-price-amount">
				<?php echo esc_attr($intpart); ?>
			</span>
		<?php }

		$this->jltma_pt_render_price_fraction_period();
	}


	public function jltma_pt_render_price_period()
	{
		$settings = $this->get_settings();

		if (!empty($settings['ma_el_pricing_table_period'])) { ?>
			<span class="jltma-price-amount-duration">
				<?php echo wp_kses_post($settings['ma_el_pricing_table_period']); ?>
			</span>
		<?php }
	}


	public function jltma_pt_render_price_fraction_period()
	{
		$settings = $this->get_settings();

		$price         = explode('.', $settings['ma_el_pricing_table_price']);
		$intpart       = $price[0];
		$fraction_part = '';

		if (2 === sizeof($price)) {
			$fraction_part = $price[1];
		}

		$period_position = $settings['ma_el_pricing_table_period_position'];
		$period_class    = ($period_position == 'below') ? ' jltma-price-table-period-position-below' : ' jltma-price-table-period-position-beside';
		$period_element  = '<span class="jltma-price-table-period elementor-typo-excluded' . $period_class . '">' .
			$settings['ma_el_pricing_table_period'] . '</span>';


		if (
			0 < $fraction_part ||
			(!empty($settings['ma_el_pricing_table_period']) && 'beside' === $period_position)
		) { ?>
			<span class="jltma-fraction-price">
				<?php

				if ($settings['ma_el_pricing_table_show_period'] == 'yes') {
					echo '.';
				}

				echo esc_html($fraction_part); ?>
			</span>
		<?php }
	}


	public function jltma_pt_render_price()
	{
		$settings = $this->get_settings();
		?>

		<div class="jltma-table-price-area">

			<?php
			$ma_el_pricing_table_layout = $settings['ma_el_pricing_table_layout'];

			if ($ma_el_pricing_table_layout == 'one') {

				$this->jltma_pt_render_price_symbol();
				$this->jltma_pt_render_price_amount();
				$this->jltma_pt_render_price_period();
			} elseif ($ma_el_pricing_table_layout == 'two' || $ma_el_pricing_table_layout == 'three') {

				$this->jltma_pt_render_price_symbol();
				$this->jltma_pt_render_price_amount();
				$this->jltma_pt_render_price_period();
			} elseif ($ma_el_pricing_table_layout == 'four') {

				$this->jltma_pt_render_price_symbol();
				$this->jltma_pt_render_price_amount();
				$this->jltma_pt_render_price_period();
			} elseif ($ma_el_pricing_table_layout == 'five') {

				$this->jltma_pt_render_price_symbol();
				$this->jltma_pt_render_price_amount();
				$this->jltma_pt_render_price_period();
			}
			?>


		</div><!-- /.table-price-area -->
	<?php }


	public function jltma_pt_render_header()
	{
		$settings = $this->get_settings_for_display();

		$ma_el_table_head_class = $settings['ma_el_pricing_table_head_color_scheme'];

		$this->add_render_attribute(
			'ma_el_pricing_table_head',
			'class',
			[
				'jltma-price-table-head',
				$ma_el_table_head_class
			]
		);

	?>

		<div <?php echo $this->get_render_attribute_string('ma_el_pricing_table_head'); ?>>
			<?php $this->jltma_pt_render_heading(); ?>
			<?php $this->jltma_pt_render_price(); ?>
		</div><!-- /.price-table-head -->
		<?php }


	public function render_features_list()
	{
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'ma_el_pricing_table_tooltip',
			[
				'class' => 'jltma-tooltip'
			]
		);


		if (!empty($settings['ma_el_pricing_table_features_list'])) { ?>
			<ul>
				<?php foreach ($settings['ma_el_pricing_table_features_list'] as $item) {

					$this->add_render_attribute('features', 'class', 'jltma-price-table-feature-text', true);

					// Tooltip settings
					if ($item['ma_el_pricing_table_tooltip_text']) {
						$this->add_render_attribute(
							'features',
							'class',
							[
								'jltma-tooltip-item',
								'tooltip-' . $item['ma_el_pricing_table_tooltip_placement'],
								'elementor-repeater-item-' . esc_attr($item['_id'])
							]
						);
					}

					if (!empty($item['ma_el_pricing_table_tooltip_text'])) {
						$this->add_render_attribute('features', 'data-tippy', '', true);
						$this->add_render_attribute('features', 'data-tippy-content', $item['ma_el_pricing_table_tooltip_text'], true);
					}

					if (!empty($item['ma_el_pricing_table_tooltip_placement'])) {
						$this->add_render_attribute('features', 'data-tippy-placement', $item['ma_el_pricing_table_tooltip_placement'], true);
					}

				?>
					<li <?php echo $this->get_render_attribute_string('features'); ?>>

						<?php if (!empty($item['ma_el_pricing_table_item_icon'])) {


							if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
								$settings['icon'] = 'fa-link';
							}

							$has_icon = !empty($item['icon']);
							if ($has_icon and 'icon' == $item['ma_el_pricing_table_item_icon']) {
								$this->add_render_attribute('jltma-icon', 'class', $item['ma_el_pricing_table_item_icon']);
								$this->add_render_attribute('jltma-icon', 'aria-hidden', 'true');
							}

							if (!$has_icon && !empty($item['ma_el_pricing_table_item_icon']['value'])) {
								$has_icon = true;
							}

							$migrated = isset($item['__fa4_migrated']['ma_el_pricing_table_item_icon']);
							$is_new   = empty($item['icon']) && Icons_Manager::is_migration_allowed();


							if ($is_new || $migrated) {
								Icons_Manager::render_icon($item['ma_el_pricing_table_item_icon'], ['aria-hidden' => 'true']);
							} else {
								echo '<i ' . $this->get_render_attribute_string('jltma-icon') . '></i>';
							}
						}

						if (!empty($item['ma_el_pricing_table_item_text'])) { ?>
							<div class=" jltma-tooltip-content">
								<?php echo $this->parse_text_editor($item['ma_el_pricing_table_item_text']); ?>
							</div>
						<?php } else {
							echo '&nbsp;';
						} ?>

					</li>
				<?php } ?>

			</ul>
			<?php }
	}



	public function render_button()
	{
		$settings         = $this->get_settings();
		$button_size      = ($settings['ma_el_pricing_table_button_size']) ? 'elementor-size-' . $settings['ma_el_pricing_table_button_size'] : '';
		$button_animation = (!empty($settings['button_hover_animation'])) ? ' elementor-animation-' . $settings['ma_el_pricing_table_button_hover_animation'] : '';

		$button_bg_color = ($settings['ma_el_pricing_table_head_color_scheme']) ? $settings['ma_el_pricing_table_head_color_scheme'] : '';

		$this->add_render_attribute(
			'button',
			'class',
			[
				'elementor-button',
				'jltma-price-table-btn',
				$button_bg_color,
				$button_size,
			]
		);

		if (!empty($settings['ma_el_pricing_table_link']['url'])) {
			$this->add_render_attribute('button', 'href', $settings['ma_el_pricing_table_link']['url']);

			if (!empty($settings['ma_el_pricing_table_link']['is_external'])) {
				$this->add_render_attribute('button', 'target', '_blank');
			}
		}

		if (!empty($settings['ma_el_pricing_table_button_hover_animation'])) {
			$this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
		}

		if (jltma_is_plugin_active('easy-digital-downloads/easy-digital-downloads.php')) {
			if ($settings['ma_el_pricing_table_edd_as_button'] === 'yes') {
				echo edd_get_purchase_link([
					'download_id' => $settings['ma_el_pricing_table_edd_id'],
					'price'       => false,
					'text'        => esc_html($settings['ma_el_pricing_table_button_text']),
					'class'       => 'jltma-price-table-button elementor-button ' . $button_size . $button_animation,
				]);
			}
		} else {
			if (!empty($settings['ma_el_pricing_table_button_text'])) { ?>
				<div class="jltma-price-table-bottom">
					<a <?php echo $this->get_render_attribute_string('button'); ?>>
						<?php echo esc_html($settings['ma_el_pricing_table_button_text']); ?>
					</a>
				</div><!-- /.price-table-bottom -->
			<?php }
		}
	}

	public function jltma_render_ribbon()
	{
		$settings = $this->get_settings();

		if ($settings['ma_el_pricing_table_show_ribbon'] && !empty($settings['ma_el_pricing_table_ribbon_title'])) :
			$this->add_render_attribute('ribbon-wrapper', 'class', 'jltma-price-table-ribbon');

			if (!empty($settings['ma_el_pricing_table_ribbon_align'])) :
				$this->add_render_attribute('ribbon-wrapper', 'class', 'elementor-ribbon-' . $settings['ma_el_pricing_table_ribbon_align']);
			endif; ?>

			<div <?php echo $this->get_render_attribute_string('ribbon-wrapper'); ?>>
				<div class="jltma-price-table-ribbon-inner">
					<?php echo esc_html($settings['ma_el_pricing_table_ribbon_title']); ?>
				</div>
			</div>
		<?php endif;
	}


	public function jltma_render_footer()
	{
		$settings = $this->get_settings();

		if (!empty($settings['ma_el_pricing_table_button_text']) || !empty($settings['ma_el_pricing_table_footer_additional_info'])) { ?>

			<div class="jltma-price-table-footer">

				<?php $this->render_button(); ?>

				<?php if (!empty($settings['ma_el_pricing_table_footer_additional_info'])) { ?>
					<div class="jltma-price-table-additional_info">
						<p>
							<?php echo wp_kses_post($settings['ma_el_pricing_table_footer_additional_info']); ?>
						</p>
					</div>
				<?php } ?>
			</div>

		<?php }
	}


	protected function render()
	{
		$settings = $this->get_settings();

		$ma_el_pricing_table_layout = $settings['ma_el_pricing_table_layout'];

		$ma_el_pricing_table_highlight = $settings['ma_el_pricing_table_highlight'];

		$ma_el_table_class = '';
		if ($ma_el_pricing_table_layout == 'one') {

			$ma_el_table_class = "default-table text-center";
		} elseif ($ma_el_pricing_table_layout == 'two') {

			$ma_el_table_class = "table-left-align text-left";
		} elseif ($ma_el_pricing_table_layout == 'three') {

			$ma_el_table_class = "table-active-zoom text-center";
		} elseif ($ma_el_pricing_table_layout == 'four') {

			$ma_el_table_class = "table-bg-image text-left";
		} elseif ($ma_el_pricing_table_layout == 'five') {

			$ma_el_table_class = "table-bg-pattern text-left";
		}

		$this->add_render_attribute(
			'jltma_pricing_table',
			'class',
			[
				'jltma-pricing-tables',
				$ma_el_table_class
			]
		);

		$this->add_render_attribute(
			'ma_el_pricing_table_container',
			'class',
			[
				'jltma-price-table',
				($ma_el_pricing_table_highlight == 'yes') ? 'active gradient-1' : ''
			]
		);

		?>

		<section <?php echo $this->get_render_attribute_string('jltma_pricing_table'); ?>>

			<div <?php echo $this->get_render_attribute_string('ma_el_pricing_table_container'); ?>>

				<?php if (
					$ma_el_pricing_table_layout == 'three' ||
					$ma_el_pricing_table_layout == 'four' ||
					$ma_el_pricing_table_layout == 'five'
				) { ?>
					<div class="jltma-table-inner">
					<?php } ?>

					<?php $this->jltma_pt_render_header(); ?>

					<div class="jltma-price-table-details">

						<?php $this->render_features_list(); ?>

						<?php $this->jltma_render_footer(); ?>

					</div><!-- /.price-table-details -->

					<?php if (
						$ma_el_pricing_table_layout == 'three' ||
						$ma_el_pricing_table_layout == 'four' ||
						$ma_el_pricing_table_layout == 'five'
					) { ?>
					</div><!-- /.jltma-table-inner -->
				<?php } ?>


			</div>

		</section>


<?php
		$this->jltma_render_ribbon();
	}
}
