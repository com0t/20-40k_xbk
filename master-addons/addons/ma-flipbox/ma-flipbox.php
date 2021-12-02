<?php

namespace MasterAddons\Addons;

/**
 * Author Name: Liton Arefin
 * Author URL : https: //jeweltheme.com
 * Date       : 6/26/19
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Stack;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Core\Schemes\Color;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use MasterAddons\Inc\Helper\Master_Addons_Helper;


if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Flipbox extends Widget_Base
{

	public function get_name()
	{
		return 'ma-flipbox';
	}

	public function get_title()
	{
		return esc_html__('Flipbox', JLTMA_TD);
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-flip-box';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/flipbox/';
	}

	protected function register_controls()
	{


		/*-----------------------------------------------------------------------------------*/
		/*	STYLE PRESETS
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_flipbox_style',
			[
				'label' => esc_html__('Style Preset', JLTMA_TD)
			]
		);



		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'ma_flipbox_layout_style',
				[
					'label'   => __('Design Variation', JLTMA_TD),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'one'   => __('Default', JLTMA_TD),
						'two'   => __('Front Image', JLTMA_TD),
						'three' => __('Diagnonal', JLTMA_TD),
						'four'  => __('Front Icon', JLTMA_TD)
					],
					'default' => 'one',
				]
			);

			//Free Codes
		} else {
			$this->add_control(
				'ma_flipbox_layout_style',
				[
					'label'   => __('Design Variation', JLTMA_TD),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'one'           => __('Default', JLTMA_TD),
						'four'          => __('Front Icon', JLTMA_TD),
						'flipbox-pro-1' => __('Front Image (Pro)', JLTMA_TD),
						'flipbox-pro-2' => __('Diagnonal (Pro)', JLTMA_TD),

					],
					'default'     => 'one',
					'description' => sprintf(
						'2+ more Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', JLTMA_TD)
					)
				]
			);
		}




		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'animation_style',
				[
					'label'   => __('Animation Style', JLTMA_TD),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'horizontal'                          => esc_html__('Flip Horizontal', JLTMA_TD),
						'vertical'                            => esc_html__('Flip Vertical', JLTMA_TD),
						'fade'                                => esc_html__('Fade', JLTMA_TD),
						'flipcard flipcard-rotate-top-down'   => esc_html__('Cube - Top Down', JLTMA_TD),
						'flipcard flipcard-rotate-down-top'   => esc_html__('Cube - Down Top', JLTMA_TD),
						'flipcard flipcard-rotate-left-right' => esc_html__('Cube - Left Right', JLTMA_TD),
						'flipcard flipcard-rotate-right-left' => esc_html__('Cube - Right Left', JLTMA_TD),
						'flip box'                            => esc_html__('Flip Box', JLTMA_TD),
						'flip box fade'                       => esc_html__('Flip Box Fade', JLTMA_TD),
						'flip box fade up'                    => esc_html__('Fade Up', JLTMA_TD),
						'flip box fade hideback'              => esc_html__('Fade Hideback', JLTMA_TD),
						'flip box fade up hideback'           => esc_html__('Fade Up Hideback', JLTMA_TD),
						'nananana'                            => esc_html__('Nananana', JLTMA_TD),
						'rollover'                            => esc_html__('Rollover', JLTMA_TD),
						'flip3d'                              => esc_html__('3d Flip', JLTMA_TD),

						// New Styles
						'left-to-right'       => esc_html__('Left to Right', JLTMA_TD),
						'right-to-left'       => esc_html__('Right to Left', JLTMA_TD),
						'top-to-bottom'       => esc_html__('Top to Bottom', JLTMA_TD),
						'bottom-to-top'       => esc_html__('Bottom to Top', JLTMA_TD),
						'top-to-bottom-angle' => esc_html__('Diagonal (Top to Bottom)', JLTMA_TD),
						'bottom-to-top-angle' => esc_html__('Diagonal (Bottom to Top)', JLTMA_TD),
						'fade-in-out'         => esc_html__('Fade In Out', JLTMA_TD),


					],
					'default'      => 'vertical',
					'prefix_class' => 'jltma-flip-animate-'
				]
			);


			//Free Codes

		} else {

			$this->add_control(
				'animation_style',
				[
					'label'   => __('Animation Style', JLTMA_TD),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'horizontal'       => esc_html__('Flip Horizontal', JLTMA_TD),
						'vertical'         => esc_html__('Flip Vertical', JLTMA_TD),
						'fade'             => esc_html__('Fade', JLTMA_TD),
						'flipbox-anim-1'   => esc_html__('Cube - Top Down (Pro)', JLTMA_TD),
						'flipbox-anim-2'   => esc_html__('Cube - Down Top (Pro)', JLTMA_TD),
						'flipbox-anim-3'   => esc_html__('Cube - Left Right (Pro)', JLTMA_TD),
						'flipbox-anim-4'   => esc_html__('Cube - Right Left (Pro)', JLTMA_TD),
						'flip box'         => esc_html__('Flip Box', JLTMA_TD),
						'flip box fade'    => esc_html__('Flip Box Fade', JLTMA_TD),
						'flip box fade up' => esc_html__('Fade Up', JLTMA_TD),
						'flipbox-anim-5'   => esc_html__('Fade Hideback (Pro)', JLTMA_TD),
						'flipbox-anim-6'   => esc_html__('Fade Up Hideback (Pro)', JLTMA_TD),
						'flipbox-anim-14'  => esc_html__('Nananana (Pro)', JLTMA_TD),
						'flipbox-anim-15'  => esc_html__('Rollover (Pro)', JLTMA_TD),
						//not
						// working


						// New Styles
						'flipbox-anim-16' => esc_html__('3d Flip (Pro)', JLTMA_TD),
						'flipbox-anim-7'  => esc_html__('Left to Right (Pro)', JLTMA_TD),
						'flipbox-anim-8'  => esc_html__('Right to Left (Pro)', JLTMA_TD),
						'flipbox-anim-9'  => esc_html__('Top to Bottom (Pro)', JLTMA_TD),
						'flipbox-anim-10' => esc_html__('Bottom to Top (Pro)', JLTMA_TD),
						'flipbox-anim-11' => esc_html__('Diagonal (Top to Bottom) (Pro)', JLTMA_TD),
						'flipbox-anim-12' => esc_html__('Diagonal (Bottom to Top) (Pro)', JLTMA_TD),
						'flipbox-anim-13' => esc_html__('Fade In Out (Pro)', JLTMA_TD),


					],
					'default'      => 'vertical',
					'prefix_class' => 'jltma-flip-animate-',
					'description'  => sprintf(
						'15+ more Flipbox Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', JLTMA_TD)
					)
				]
			);
		}

		$this->end_controls_section();



		/*-----------------------------------------------------------------------------------*/
		/*	Front Box
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_front_box',
			[
				'label' => esc_html__('Front Box', JLTMA_TD)
			]
		);

		$this->add_control(
			'front_icon_view',
			[
				'label'   => esc_html__('Icon Style', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__('Default', JLTMA_TD),
					'stacked' => esc_html__('Stacked', JLTMA_TD),
					'framed'  => esc_html__('Framed', JLTMA_TD),
				],
				'default' => 'default',

			]
		);

		$this->add_control(
			'front_icon_shape',
			[
				'label'   => __('Shape', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'circle' => __('Circle', JLTMA_TD),
					'square' => __('Square', JLTMA_TD),
				],
				'default'   => 'circle',
				'condition' => [
					'front_icon_view!' => 'default',
				],

			]
		);

		$this->add_control(
			'front_icon',
			[
				'label'            => esc_html__('Icon', JLTMA_TD),
				'description'      => esc_html__('Please choose an icon from the list.', JLTMA_TD),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fab fa-elementor',
					'library' => 'brand',
				],
				'render_type' => 'template'
			]
		);


		$this->add_control(
			'front_title',
			[
				'label'   => esc_html__('Title', JLTMA_TD),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('Enter text', JLTMA_TD),
				'default'     => esc_html__('Front Title Here', JLTMA_TD),
			]
		);


		$this->add_control(
			'front_text',
			[
				'label'   => esc_html__('Description', JLTMA_TD),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('Enter text', JLTMA_TD),
				'default'     => esc_html__('Add some nice text here.', JLTMA_TD),
			]
		);

		$this->add_responsive_control(
			'front_box_front_text_align',
			[
				'label'       => esc_html__('Alignment', JLTMA_TD),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'front_title_html_tag',
			[
				'label'   => esc_html__('Title HTML Tag', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_back_box',
			[
				'label' => __('Back Box', JLTMA_TD)
			]
		);

		$this->add_control(
			'back_icon_view',
			[
				'label'   => __('View', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => __('Default', JLTMA_TD),
					'stacked' => __('Stacked', JLTMA_TD),
					'framed'  => __('Framed', JLTMA_TD),
				],
				'default' => 'default',

			]
		);

		$this->add_control(
			'back_icon_shape',
			[
				'label'   => __('Shape', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'circle' => __('Circle', JLTMA_TD),
					'square' => __('Square', JLTMA_TD),
				],
				'default'   => 'circle',
				'condition' => [
					'back_icon_view!' => 'default',
				],

			]
		);


		$this->add_control(
			'back_icon',
			[
				'label'            => esc_html__('Icon', JLTMA_TD),
				'description'      => esc_html__('Please choose an icon from the list.', JLTMA_TD),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fab fa-wordpress',
					'library' => 'brand',
				],
				'render_type' => 'template'
			]
		);



		$this->add_control(
			'back_title',
			[
				'label'   => __('Title', JLTMA_TD),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __('Enter text', JLTMA_TD),
				'default'     => __('Text Title', JLTMA_TD),
			]
		);

		$this->add_control(
			'back_text',
			[
				'label'   => __('Description', JLTMA_TD),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __('Enter text', JLTMA_TD),
				'default'     => __('Add some nice text here.', JLTMA_TD),
			]
		);


		$this->add_responsive_control(
			'front_box_back_text_align',
			[
				'label'       => esc_html__('Alignment', JLTMA_TD),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'back_title_html_tag',
			[
				'label'   => __('HTML Tag', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h3',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section-action-button',
			[
				'label' => __('Action Button', JLTMA_TD),
			]
		);

		$this->add_control(
			'action_text',
			[
				'label'       => __('Button Text', JLTMA_TD),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __('Buy', JLTMA_TD),
				'default'     => __('Buy Now', JLTMA_TD),
			]
		);

		$this->add_control(
			'link',
			[
				'label'   => __('Link to', JLTMA_TD),
				'type'    => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __('http://your-link.com', JLTMA_TD),
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();




		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section-general-style',
			[
				'label' => __('General', JLTMA_TD),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'ma_el_flip_3d',
			[
				'label'   => __('3d Flip Style', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'flip_3d_left'   => __('Slide Right to Left', JLTMA_TD),
					'flip_3d_right'  => __('Slide Left to Right', JLTMA_TD),
					'flip_3d_top'    => __('Slide Top to Bottom', JLTMA_TD),
					'flip_3d_bottom' => __('Slide Bottom to Top', JLTMA_TD),
				],
				'default'   => '3d_left',
				'condition' => [
					'animation_style' => 'flip3d'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'flip_box_border',
				'label'    => __('Box Border', JLTMA_TD),
				'selector' => '{{WRAPPER}} .jltma-flip-box-inner > div',
			]
		);



		$this->add_control(
			'box_border_radius',
			[
				'label'      => __('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .jltma-flip-box-back'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_height',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __('Flip Box Height', JLTMA_TD),
				'placeholder' => __('250', JLTMA_TD),
				'default'     => __('250', JLTMA_TD),
				'selectors'   => [
					'{{WRAPPER}} .jltma-flip-box-inner'                           => 'height: {{VALUE}}px;',
					'{{WRAPPER}}.jltma-flip-animate-flipcard .jltma-flip-box-front' => 'transform-origin: center center calc(-{{VALUE}}px/2);-webkit-transform-origin:center center calc(-{{VALUE}}px/2);',
					'{{WRAPPER}}.jltma-flip-animate-flipcard .jltma-flip-box-back'  => 'transform-origin: center center calc(-{{VALUE}}px/2);-webkit-transform-origin:center center calc(-{{VALUE}}px/2);',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section-front-box-style',
			[
				'label' => __('Front Box', JLTMA_TD),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);



		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'front_box_bg_color',
				'label'     => __('Background', JLTMA_TD),
				'types'     => ['classic', 'gradient'],
				'default'   => '#fff',
				'selector'  => '{{WRAPPER}} .jltma-flip-box-front',
				'condition' => [
					'ma_flipbox_layout_style' => ['one', 'three', 'four']
				]
			]
		);


		$this->add_control(
			'front_box_image',
			[
				'label'   => __('Image', JLTMA_TD),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ma_flipbox_layout_style' => 'two',
				],
			]
		);


		$this->add_control(
			'front_box_background_color',
			[
				'label'     => esc_html__('Background Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'front_box_title_color',
			[
				'label'  => __('Title', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#393c3f',
				'selectors' => [
					'{{WRAPPER}} .front-icon-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'front_title!' => ''
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'front_box_title_typography',
				'label'    => __('Title Typography', JLTMA_TD),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .front-icon-title',
			]
		);

		$this->add_control(
			'front_box_text_color',
			[
				'label'  => __('Description Color', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#78909c',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front p' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'front_box_text_typography',
				'label'    => __('Description Typography', JLTMA_TD),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-flip-box-front p',
			]
		);


		/**
		 *  Front Box icons styles
		 **/
		$this->add_control(
			'front_box_icon_color',
			[
				'label'  => __('Icon Color', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#4b00e7',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'front_icon!' => ''
				],
			]
		);

		$this->add_control(
			'front_box_icon_fill_color',
			[
				'label'  => __('Icon Fill Color', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#41dcab',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-icon-view-stacked' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'front_icon_view' => 'stacked'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'front_box_icon_border',
				'label'       => __('Box Border', JLTMA_TD),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-flip-box-front .jltma-flip-icon-view-framed, {{WRAPPER}} .jltma-flip-box-front .jltma-flip-icon-view-stacked',
				'label_block' => true,
				'condition'   => [
					'front_icon_view!' => 'default'
				],
			]
		);

		$this->add_control(
			'front_icon_size',
			[
				'label' => __('Icon Size', JLTMA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'front_icon_padding',
			[
				'label'     => __('Icon Padding', JLTMA_TD),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'size' => 1.5,
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
					],
				],
				'condition' => [
					'front_icon_view!' => 'default',
				],
			]
		);





		$this->end_controls_section();



		$this->start_controls_section(
			'section-back-box-style',
			[
				'label' => esc_html__('Back Box', JLTMA_TD),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'back_box_background',
				'label'    => __('Back Box Background', JLTMA_TD),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .jltma-flip-box-back',
			]
		);

		$this->add_control(
			'back_box_title_color',
			[
				'label'  => __('Title', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .back-icon-title' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'back_box_title_typography',
				'label'    => __('Title Typography', JLTMA_TD),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .back-icon-title',
			]
		);

		$this->add_control(
			'back_box_text_color',
			[
				'label'  => __('Description Color', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back p' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'back_box_text_typography',
				'label'    => __('Description Typography', JLTMA_TD),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-flip-box-back p',
			]
		);


		/**
		 *  Back Box icons styles
		 **/
		$this->add_control(
			'back_box_icon_color',
			[
				'label'  => __('Icon Color', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back .icon-wrapper i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-flip-box-back .icon-wrapper svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'back_icon!' => ''
				],
			]
		);

		$this->add_control(
			'back_box_icon_fill_color',
			[
				'label'  => __('Icon Fill Color', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back .jltma-flip-icon-view-stacked' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'front_icon_view' => 'stacked'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'back_box_icon_border',
				'label'       => __('Box Border', JLTMA_TD),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-flip-box-back .jltma-flip-icon-view-framed, {{WRAPPER}} .jltma-flip-box-back .jltma-flip-icon-view-stacked',
				'label_block' => true,
				'condition'   => [
					'back_icon_view!' => 'default'
				],
			]
		);

		$this->add_control(
			'back_icon_size',
			[
				'label' => __('Icon Size', JLTMA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'back_icon_padding',
			[
				'label'     => __('Icon Padding', JLTMA_TD),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'size' => 1.5,
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
					],
				],
				'condition' => [
					'back_icon_view!' => 'default',
				],
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'section_action_button_style',
			[
				'label' => __('Action Button', JLTMA_TD),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs('jltma_flipbox_action_btn_style');

		$this->start_controls_tab(
			'jltma_flipbox_action_btn_style_normal',
			[
				'label' => esc_html__('Normal', JLTMA_TD)
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __('Text Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4b00e7',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __('Typography', JLTMA_TD),
				'scheme'    			=> Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button',
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'  => __('Background Color', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => __('Border', JLTMA_TD),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_padding',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab(
			'jltma_flipbox_action_btn_style_hover',
			[
				'label' => esc_html__('Hover', JLTMA_TD)
			]
		);


		$this->add_control(
			'button_text_color_hover',
			[
				'label'     => __('Text Color', JLTMA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4b00e7',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'typography',
		// 		'label' => __( 'Typography', JLTMA_TD ),
		// 'scheme'    			=> Typography::TYPOGRAPHY_4,
		// 		'selector' => '{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover',
		// 	]
		// );

		$this->add_control(
			'background_color_hover',
			[
				'label'  => __('Background Color', JLTMA_TD),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_4
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border_hover',
				'label'       => __('Border', JLTMA_TD),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover',
			]
		);

		$this->add_control(
			'border_radius_hover',
			[
				'label'      => __('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_padding_hover',
			[
				'label'      => __('Padding', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();




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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', JLTMA_TD), '<a href="https://master-addons.com/demos/flipbox/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', JLTMA_TD), '<a href="https://master-addons.com/docs/addons/how-to-configure-flipbox-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', JLTMA_TD), '<a href="https://www.youtube.com/watch?v=f-B35-xWqF0" target="_blank" rel="noopener">', '</a>'),
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

		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', JLTMA_TD),
					'tab'   => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'ma_el_control_get_pro_style_tab',
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
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with
Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'ma_el_flipbox',
			'class',
			[
				'jltma-flip-box'
			]
		);


		$this->add_render_attribute('front-icon-wrapper', 'class', 'icon-wrapper');
		$this->add_render_attribute('front-icon-wrapper', 'class', 'jltma-flip-icon-view-' . $settings['front_icon_view']);
		$this->add_render_attribute('front-icon-wrapper', 'class', 'jltma-flip-icon-shape-' . $settings['front_icon_shape']);
		$this->add_render_attribute('front-icon-title', 'class', 'front-icon-title');
		$this->add_render_attribute('front-icon', 'class', $settings['front_icon']);


		$this->add_render_attribute('back-icon-wrapper', 'class', 'icon-wrapper');
		$this->add_render_attribute('back-icon-wrapper', 'class', 'jltma-flip-icon-view-' . $settings['back_icon_view']);
		$this->add_render_attribute('back-icon-wrapper', 'class', 'jltma-flip-icon-shape-' . $settings['back_icon_shape']);
		$this->add_render_attribute('back-icon-title', 'class', 'back-icon-title');
		$this->add_render_attribute('back-icon', 'class', $settings['back_icon']);

		$this->add_render_attribute('button', 'class', 'jltma-flip-button');
		if (!empty($settings['link']['url'])) {
			$this->add_render_attribute('button', 'href', $settings['link']['url']);

			if (!empty($settings['link']['is_external'])) {
				$this->add_render_attribute('button', 'target', '_blank');
			}
		}



		$flip_box = $this->get_settings_for_display('front_box_image');

		if (isset($flip_box['id']) && $flip_box['id'] != "") {
			$flip_box_url_src = Group_Control_Image_Size::get_attachment_image_src(
				$flip_box['id'],
				'full',
				$settings
			);
		}

		if (!empty($flip_box['url'])) {
			$flip_box_url = $flip_box['url'];
		} else {
			$flip_box_url = isset($flip_box_url_src);
		}
?>

		<div class="jltma-flip-box-wrapper <?php echo $settings['ma_flipbox_layout_style'] ?> <?php if ($settings['ma_el_flip_3d']) {
																									echo $settings['ma_el_flip_3d'];
																								}; ?>">

			<div class="jltma-flip-box-inner">
				<div class="jltma-flip-box-front">
					<div class="jltma-flipbox-content">

						<?php if ($settings['ma_flipbox_layout_style'] == "two") { ?>

							<?php if (isset($flip_box_url) && $flip_box_url != "") { ?>
								<img src="<?php echo esc_url($flip_box_url); ?>" alt="<?php echo get_post_meta($flip_box['id'], '_wp_attachment_image_alt', true); ?>">
							<?php } ?>

						<?php } else if (($settings['ma_flipbox_layout_style'] == "one") || ($settings['ma_flipbox_layout_style'] == "three")) { ?>


							<?php if ((!empty($settings['icon']) || !empty($settings['front_icon']['value']))) { ?>
								<div <?php echo $this->get_render_attribute_string('front-icon-wrapper'); ?>>
									<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-elementor', 'icon', $settings['front_icon'], '', 'front-icon'); ?>
								</div>
							<?php } ?>

							<?php if (!empty($settings['front_title'])) { ?>
								<<?php echo tag_escape($settings['front_title_html_tag']); ?> <?php echo $this->get_render_attribute_string('front-icon-title'); ?>>
									<?php echo esc_html($settings['front_title']); ?>
								</<?php echo tag_escape($settings['front_title_html_tag']); ?>>
							<?php } ?>

							<?php //if(!empty($settings['front_text'])){
							?>
							<p>
								<?php echo $settings['front_text']; ?>
							</p>
							<?php //}
							?>

						<?php } ?>


						<?php //else if( $settings['ma_flipbox_layout_style'] == "three") {}
						?>



						<?php if ($settings['ma_flipbox_layout_style'] == "four") { ?>

							<?php if (!empty($settings['front_icon'])) { ?>
								<div <?php echo $this->get_render_attribute_string('front-icon-wrapper'); ?>>
									<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-elementor', 'icon', $settings['front_icon'], '', 'front-icon'); ?>
								</div>
							<?php } ?>

						<?php } ?>


					</div>
				</div>

				<div class="jltma-flip-box-back">
					<div class="jltma-flipbox-content">

						<?php if (!empty($settings['back_icon'])) { ?>
							<div <?php echo $this->get_render_attribute_string('back-icon-wrapper'); ?>>
								<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-elementor', 'icon', $settings['back_icon'], '', 'back-icon'); ?>
							</div>
						<?php } ?>

						<?php if (!empty($settings['back_title'])) { ?>
							<<?php echo tag_escape($settings['back_title_html_tag']); ?> <?php echo $this->get_render_attribute_string('back-icon-title'); ?>>
								<?php echo esc_html($settings['back_title']); ?>
							</<?php echo tag_escape($settings['back_title_html_tag']); ?>>
						<?php } ?>

						<?php if (!empty($settings['back_text'])) { ?>
							<p>
								<?php echo $settings['back_text']; ?>
							</p>
						<?php } ?>

						<?php if (!empty($settings['action_text'])) { ?>
							<div class="jltma-flip-button-wrapper">
								<a <?php echo $this->get_render_attribute_string('button'); ?>>
									<span class="elementor-button-text">
										<?php echo $settings['action_text']; ?>
									</span>
								</a>
							</div>
						<?php  }  ?>

					</div>
				</div>
			</div>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
