<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/25/19
 */

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Call_to_Action extends Widget_Base
{

	public function get_name()
	{
		return 'ma-call-to-action';
	}

	public function get_title()
	{
		return esc_html__('Call to Action', JLTMA_TD);
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-call-to-action';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_style_depends()
	{
		return [
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/call-to-action/';
	}


	protected function register_controls()
	{

		/**
		 * Master Call to Action: Content
		 */
		$this->start_controls_section(
			'ma_el_call_to_action_content_section',
			[
				'label' => esc_html__('Content', JLTMA_TD),
			]
		);


		$this->add_control(
			'ma_el_call_to_action_style_preset',
			[
				'label' 		=> esc_html__('Style Preset', JLTMA_TD),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'style-01',
				'separator' 	=> 'after',
				'options' 		=> [
					'style-01' => esc_html__('Default Style', JLTMA_TD),
					'style-02' => esc_html__('Center Style', JLTMA_TD),
					'style-03' => esc_html__('Quote Style', JLTMA_TD),
					'style-04' => esc_html__('Quote Style 2', JLTMA_TD),
					'style-07' => esc_html__('Left Icon', JLTMA_TD)
				],
			]
		);



		$this->add_control(
			'ma_el_call_to_action_title',
			[
				'label' => esc_html__('CTA Content', JLTMA_TD),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Purchase Master Addons now and unlimited Options', JLTMA_TD),
			]
		);


		$this->add_control(
			'ma_el_call_to_action_content_desc',
			[
				'label' => esc_html__('Description', JLTMA_TD),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', JLTMA_TD),

				// 'condition' => [
				// 	'ma_el_call_to_action_style_preset' => 'style2',
				// ],
			]
		);

		$this->add_control(
			'ma_el_call_to_action_button_text',
			[
				'label' => esc_html__('Button Text', JLTMA_TD),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Purchase Now', JLTMA_TD),
			]
		);

		$this->add_control(
			'ma_el_call_to_action_button_link',
			[
				'label' => __('Call To Action URL', JLTMA_TD),
				'type' => Controls_Manager::URL,
				'placeholder' => __('https://jeweltheme.com/shop/master-addons-elementor', JLTMA_TD),
				'label_block' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
				],
			]
		);

		$this->add_control(
			'ma_el_call_to_action_icon',
			[
				'label'         	=> esc_html__('Icon', JLTMA_TD),
				'description' 		=> esc_html__('Please choose an icon from the list.', JLTMA_TD),
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'default'       	=> [
					'value'     => 'fas fa-bell',
					'library'   => 'solid',
				],
				'render_type'      => 'template',
				'condition' => [
					'ma_el_call_to_action_style_preset' => ['style-07'],
				],
			]
		);


		$this->end_controls_section();


		/**
		 * Master Addons: Call to Action Content Section
		 */
		$this->start_controls_section(
			'ma_el_call_to_action_style',
			[
				'label' => esc_html__('Presets Style ', JLTMA_TD),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ma_el_call_to_action_desc_bg',
				'label' => __('CTA Background', JLTMA_TD),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .jltma-call-to-action'
			]
		);



		$this->add_control(
			'ma_el_call_to_action_border_color',
			[
				'label'		=> esc_html__('Border Color', JLTMA_TD),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#4b00e7',
				'selectors'	=> [
					'{{WRAPPER}} .style-03 .jltma-call-action-content .jltma-row' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .style-04 .jltma-call-action-content .jltma-row' => 'border-color: {{VALUE}};',
				],

				'condition' => [
					'ma_el_call_to_action_style_preset' => ['style-03', 'style-04'],
				],
			]
		);


		$this->add_control(
			'ma_el_call_to_action_icon_color',
			[
				'label'		=> esc_html__('Icon Color', JLTMA_TD),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#4b00e7',
				'selectors'	=> [
					'{{WRAPPER}} .style-07 .jltma-media-left i' => 'color: {{VALUE}};',
				],

				'condition' => [
					'ma_el_call_to_action_style_preset' => ['style-07'],
				],
			]
		);

		$this->add_control(
			'jltma_call_to_action_icon_size',
			[
				'label'      => esc_html__('Size', JLTMA_TD),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'selectors'	=> [
					'{{WRAPPER}} .style-07 .jltma-media-left i' => 'font-size: {{SIZE}}{{UNIT}};',
				],

				'condition' => [
					'ma_el_call_to_action_style_preset' => ['style-07'],
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'ma_el_call_to_action_title_style_section',
			[
				'label' => __('Title Style', JLTMA_TD),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'ma_el_call_to_action_title_color',
			[
				'label'		=> esc_html__('Title Color', JLTMA_TD),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#393c3f',
				'selectors'	=> [

					'{{WRAPPER}} .style-02 .jltma-call-action-title' => 'color: #fff;',
					'{{WRAPPER}} .jltma-call-action-title' => 'color: {{VALUE}} !important;',
				],

			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_cta_title_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-call-action-title',
			]
		);


		$this->end_controls_section();




		$this->start_controls_section(
			'ma_el_call_to_action_desc_style_section',
			[
				'label' => __('Description Style', JLTMA_TD),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_call_to_action_description_color',
			[
				'label'		=> esc_html__('Text Color', JLTMA_TD),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#78909c',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-call-action-description' => 'color: {{VALUE}};'
				]
			]
		);




		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_call_to_action_text_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-call-action-description',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'ma_el_call_to_action_button_section',
			[
				'label' => __('Button Style', JLTMA_TD),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs('ma_el_call_to_action_button_style_tabs');

		$this->start_controls_tab(
			'ma_el_call_to_action_button_style_tab',
			[
				'label' => esc_html__('Normal', JLTMA_TD)
			]
		);

		$this->add_control(
			'ma_el_call_to_action_button_bg_color',
			[
				'label'		=> esc_html__('Background Color', JLTMA_TD),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#4b00e7',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_call_to_action_button_color',
			[
				'label'		=> esc_html__('Text Color', JLTMA_TD),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'jltma_call_to_action_button_width',
			[
				'label'      => esc_html__('Width', JLTMA_TD),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'jltma_call_to_action_button_padding',
			[
				'label' 		=> esc_html__('Padding', JLTMA_TD),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'ma_el_call_to_action_button_border',
				'selector'      => '{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn'
			]
		);

		$this->add_responsive_control(
			'ma_el_call_to_action_button_border_radius',
			array(
				'label'      => esc_html__('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab('ma_el_call_to_action_button_hover', [
			'label' => esc_html__(
				'Hover',
				JLTMA_TD
			)
		]);

		$this->add_control(
			'ma_el_call_to_action_button_bg_hover_color',
			[
				'label'		=> esc_html__('Background Color', JLTMA_TD),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#4b00e7',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn:hover'
					=> 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_call_to_action_button_hover_color',
			[
				'label'		=> esc_html__('Text Color', JLTMA_TD),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn:hover'
					=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'jltma_call_to_action_button_width_hover',
			[
				'label'      => esc_html__('Width', JLTMA_TD),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn:hover' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'jltma_call_to_action_button_padding_hover',
			[
				'label' 		=> esc_html__('Padding', JLTMA_TD),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn:hover' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'ma_el_call_to_action_border_hover',
				'selector'      => '{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn:hover'
			]
		);

		$this->add_responsive_control(
			'ma_el_call_to_action_button_border_hover_radius',
			array(
				'label'      => esc_html__('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-call-action-content .jltma-call-action-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_call_to_action_button_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-call-action-btn',
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', JLTMA_TD), '<a href="https://master-addons.com/demos/call-to-action/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', JLTMA_TD), '<a href="https://master-addons.com/docs/addons/call-to-action/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', JLTMA_TD), '<a href="https://www.youtube.com/watch?v=iY2q1jtSV5o" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();



		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_upgrade_pro',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', JLTMA_TD)
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
					'description' => '<span class="pro-feature"> Upgrade to <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute('ma_el_call_to_action_wrapper', [
			'class'	=> [
				'jltma-call-to-action'
			],
			'id' => 'jltma-action-content-' . $this->get_id()
		]);



		if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
			$settings['icon'] = 'fas fa-bell';
		}

		$has_icon  = !empty($settings['icon']);
		if ($has_icon and 'icon' == $settings['ma_el_call_to_action_icon']) {
			$this->add_render_attribute('jltma-icon', 'class', $settings['ma_el_call_to_action_icon']);
			$this->add_render_attribute('jltma-icon', 'aria-hidden', 'true');
		}

		if (!$has_icon && !empty($settings['ma_el_call_to_action_icon']['value'])) {
			$has_icon = true;
		}

		$migrated  = isset($settings['__fa4_migrated']['ma_el_call_to_action_icon']);
		$is_new    = empty($settings['icon']) && Icons_Manager::is_migration_allowed();
?>

		<section <?php echo $this->get_render_attribute_string('ma_el_call_to_action_wrapper'); ?>>
			<div class="<?php echo esc_attr($settings['ma_el_call_to_action_style_preset']); ?>">
				<div class="jltma-call-action-content">
					<div class="jltma-row">
						<div class="jltma-col-9">

							<?php if ($settings['ma_el_call_to_action_style_preset'] == "style-07") { ?>
								<div class="jltma-cta-icon-section jltma-media">

									<div class="jltma-cta-icon jltma-media-left">
										<?php
										if ($is_new || $migrated) {
											Icons_Manager::render_icon($settings['ma_el_call_to_action_icon'], ['aria-hidden' => 'true']);
										} else {
											echo '<i ' . $this->get_render_attribute_string('jltma-icon') . '></i>';
										}
										?>
									</div>

									<div class="jltma-media-body">
										<h3 class="jltma-call-action-title">
											<?php echo esc_html($settings['ma_el_call_to_action_title']); ?>
										</h3>
										<p class="jltma-call-action-description">
											<?php echo esc_html($settings['ma_el_call_to_action_content_desc']); ?>
										</p>
									</div>

								</div>
							<?php } else { ?>
								<h3 class="jltma-call-action-title">
									<?php echo esc_html($settings['ma_el_call_to_action_title']); ?>
								</h3>

								<p class="jltma-call-action-description">
									<?php echo esc_html($settings['ma_el_call_to_action_content_desc']); ?>
								</p>
							<?php } ?>
						</div>
						<div class="jltma-col-3 text-right">
							<a href="<?php echo esc_url($settings['ma_el_call_to_action_button_link']['url']); ?>" class="jltma-call-action-btn">
								<?php echo esc_html($settings['ma_el_call_to_action_button_text']); ?>
							</a>
						</div>
					</div>
				</div>
			</div>

		</section>
<?php
	}
}
