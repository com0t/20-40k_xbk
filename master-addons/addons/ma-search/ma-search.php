<?php

namespace MasterAddons\Addons;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;


use MasterAddons\Inc\Controls\MA_Control_Visual_Select;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL : https://master-addons.com
 * Date       : 3/15/2020
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * MA Header Search
 */
class JLTMA_Search extends Widget_Base
{

    public function get_name()
    {
        return 'ma-search';
    }
    public function get_title()
    {
        return __('Search', JLTMA_TD);
    }

    public function get_categories()
    {
        return ['master-addons'];
    }

    public function get_icon()
    {
        return 'jltma-icon eicon-search';
    }

    public function get_keywords()
    {
        return ['search', 'search bar', 'header search', 'header', 'footer'];
    }

    public function get_help_url()
    {
        return 'https://master-addons.com/demos/search-element/';
    }


    private function jltma_get_post_types()
    {
        $args = array('public' => true);

        $post_types = get_post_types($args, 'objects');
        $posts      = array();

        foreach ($post_types as $post_type) {
            $labels           = get_post_type_labels($post_type);
            $posts[$post_type->name] = $labels->name;
        }

        return $posts;
    }

    protected function register_controls()
    {


        $this->start_controls_section(
            'jltma_search_general',
            array(
                'label' => __('Content', JLTMA_TD),
            )
        );

        $this->add_control(
            'jltma_search_type',
            array(
                'label'   => __('Type', JLTMA_TD),
                'type'    => Controls_Manager::SELECT,
                'default' => 'form',
                'options' => array(
                    'form' => __('Form', JLTMA_TD),
                    'icon' => __('Icon Popup', JLTMA_TD)
                )
            )
        );

        $this->add_control(
            'jltma_search_submit_type',
            array(
                'label'   => __('Submit Button Type', JLTMA_TD),
                'type'    => Controls_Manager::SELECT,
                'options' => array(
                    'icon'   => __('Icon', JLTMA_TD),
                    'button' => __('Button', JLTMA_TD),
                ),
                'default'   => 'icon',
                'condition' => array(
                    'jltma_search_type' => 'form'
                )
            )
        );


        $this->add_control(
            'jltma_search_submit_button',
            array(
                'label'     => __('Button Text', JLTMA_TD),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Search',
                'condition' => array(
                    'jltma_search_submit_type' => 'button'
                )
            )
        );


        $this->add_control(
            'jltma_search_icon',
            array(
                'label'            => __('Icon', JLTMA_TD),
                'description'      => __('Please choose an icon from the list.', JLTMA_TD),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-search',
                    'library' => 'fa-solid',
                ],
                'conditions'   => array(
                    'relation' => 'or',
                    'terms'    => array(
                        array(
                            'name'     => 'jltma_search_type',
                            'operator' => '==',
                            'value'    => 'icon'
                        ),
                        array(
                            'name'     => 'jltma_search_submit_type',
                            'operator' => '==',
                            'value'    => 'icon'
                        )
                    )
                )
            )
        );

        // $this->add_control(
        //     'jltma_search_has_category',
        //     array(
        //         'label'       => __('Searcy by Category', JLTMA_TD),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'label_on'     => __( 'On', JLTMA_TD ),
        //         'label_off'    => __( 'Off', JLTMA_TD ),
        //         'return_value' => true,
        //         'default'      => false,
        //         'condition' => array(
        //             'jltma_search_type' => 'form'
        //         )
        //     )
        // );



        // $this->add_control(
        //     'jltma_search_post_types',
        //     array(
        //         'label'       => __('Post Types', JLTMA_TD),
        //         'type'        => Controls_Manager::SELECT2,
        //         'multiple' => true,
        //         'options'     => $this->jltma_get_post_types()
        //     )
        // );


        $this->end_controls_section();




        $this->start_controls_section(
            'jltma_search_icon_popup_section',
            array(
                'label'      => __('Popup Settings', JLTMA_TD),
                'conditions' => array(
                    'relation' => 'or',
                    'terms'    => array(
                        array(
                            'name'     => 'jltma_search_type',
                            'operator' => '===',
                            'value'    => 'icon'
                        ),
                        array(
                            'name'     => 'jltma_search_submit_type',
                            'operator' => '===',
                            'value'    => 'icon'
                        )
                    )
                )
            )
        );


        $this->add_control(
            'jltma_search_icon_popup_search_text',
            [
                'label'       => __('Input Text', JLTMA_TD),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Search ...', JLTMA_TD),
                'default'     => __('Search ...', JLTMA_TD),
            ]
        );

        $this->add_control(
            'jltma_search_icon_popup_search_details_desc',
            [
                'label'       => __('Description', JLTMA_TD),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __('Hit enter to search or click X to close', JLTMA_TD),
                'default'     => __('Hit enter to search or click X to close', JLTMA_TD),
            ]
        );

        $this->end_controls_section();




        $this->start_controls_section(
            'jltma_search_icon_section',
            array(
                'label'      => __('Icon', JLTMA_TD),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => array(
                    'relation' => 'or',
                    'terms'    => array(
                        array(
                            'name'     => 'jltma_search_type',
                            'operator' => '===',
                            'value'    => 'icon'
                        ),
                        array(
                            'name'     => 'jltma_search_submit_type',
                            'operator' => '===',
                            'value'    => 'icon'
                        )
                    )
                )
            )
        );


        $this->add_responsive_control(
            'jltma_search_icon_size',
            array(
                'label'      => __('Size', JLTMA_TD),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em'),
                'range'      => array(
                    'px' => array(
                        'max' => 100,
                        'min' => 10
                    ),
                    'em' => array(
                        'max' => 10,
                        'min' => .5
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} .jltma-btn--search' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jltma-btn--search svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jltma-search-submit' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jltma-search-submit svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                )
            )
        );

        $this->add_control(
            'jltma_search_icon_color',
            array(
                'label'     => __('Icon color', JLTMA_TD),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => array(
                    '{{WRAPPER}} .jltma-btn--search i, {{WRAPPER}} .jltma-search-form .jltma-search-submit i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .jltma-btn--search svg, {{WRAPPER}} .jltma-search-submit svg' => 'fill: {{VALUE}}',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'jltma_search_border',
                'label'       => __('Border', JLTMA_TD),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .jltma-search-form .jltma-search-submit,{{WRAPPER}} .jltma-btn--search',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'jltma_search_icon_padding',
            array(
                'label'      => __('Icon Padding', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-btn--search i, {{WRAPPER}} .jltma-search-form .jltma-search-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_responsive_control(
            'jltma_search_icon_margin',
            array(
                'label'      => __('Icon Margin', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-btn--search i, {{WRAPPER}} .jltma-search-form .jltma-search-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->end_controls_section();





        /*  Form Section
            /*-------------------------------------*/
        $this->start_controls_section(
            'jltma_search_form_section',
            array(
                'label'      => __('Form', JLTMA_TD),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => array(
                    'relation' => 'or',
                    'terms'    => array(
                        array(
                            'name'     => 'jltma_search_type',
                            'operator' => '===',
                            'value'    => 'form'
                        )
                    )
                )
            )
        );

        $this->add_control(
            'jltma_search_form_bg_color',
            array(
                'label'     => __('Background', JLTMA_TD),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFF',
                'selectors' => array(
                    '{{WRAPPER}} .jltma-search-wrapper' => 'background-color: {{VALUE}}',
                )
            )
        );


        $this->add_responsive_control(
            'jltma_search_form_width',
            array(
                'label'      => __('Width', JLTMA_TD),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    '%' => array(
                        'min'  => 1,
                        'max'  => 120,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => 1,
                        'max'  => 120,
                        'step' => 1
                    ),
                    'px' => array(
                        'min'  => 1,
                        'max'  => 1900,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} .jltma-search-wrapper' => 'max-width:{{SIZE}}{{UNIT}};'
                ),
            )
        );

        $this->add_responsive_control(
            'jltma_search_form_margin',
            array(
                'label'      => __('Form Margin', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-search-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_responsive_control(
            'jltma_search_form_padding',
            array(
                'label'      => __('Form Padding', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-search-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'      => 'form_border',
                'selector'  => '{{WRAPPER}} .jltma-search-wrapper',
                'separator' => 'none'
            )
        );

        $this->add_control(
            'jltma_search_form_border_radius',
            array(
                'label'      => __('Border Radius', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-search-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;'
                ),
                'allowed_dimensions' => 'all',
                'separator'          => 'after'
            )
        );


        // Form Control/Input Styles

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'jltma_search_form_typgraphy',
                'scheme'   => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .jltma-search-form .jltma-form-control'
            )
        );

        $this->add_control(
            'jltma_search_form_control_color',
            array(
                'label'     => __('Color', JLTMA_TD),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => array(
                    '{{WRAPPER}} .jltma-search-form .jltma-form-control' => 'color: {{VALUE}}',
                )
            )
        );

        $this->add_responsive_control(
            'jltma_search_form_control_width',
            array(
                'label'      => __('Width', JLTMA_TD),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    '%' => array(
                        'min'  => 1,
                        'max'  => 120,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => 1,
                        'max'  => 120,
                        'step' => 1
                    ),
                    'px' => array(
                        'min'  => 1,
                        'max'  => 1900,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} .jltma-form-control' => 'max-width:{{SIZE}}{{UNIT}};'
                ),
            )
        );

        $this->add_responsive_control(
            'jltma_search_form_control_margin',
            array(
                'label'      => __('Margin', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-form-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_responsive_control(
            'jltma_search_form_control_padding',
            array(
                'label'      => __('Padding', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_control(
            'jltma_search_form_control_bg_color',
            array(
                'label'     => __('Form Input Color', JLTMA_TD),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFF',
                'selectors' => array(
                    '{{WRAPPER}} .jltma-form-control' => 'background-color: {{VALUE}}',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'      => 'input_border',
                'selector'  => '{{WRAPPER}} .jltma-form-control',
                'separator' => 'none'
            )
        );

        $this->add_control(
            'jltma_search_form_control_border_radius',
            array(
                'label'      => __('Border Radius', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;'
                ),
                'allowed_dimensions' => 'all',
                'separator'          => 'after'
            )
        );

        $this->end_controls_section();



        /*  Icon Section
            /*-------------------------------------*/
        $this->start_controls_section(
            'jltma_search_button_section',
            array(
                'label'      => __('Button', JLTMA_TD),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => array(
                    'relation' => 'and',
                    'terms'    => array(
                        array(
                            'name'     => 'jltma_search_type',
                            'operator' => '===',
                            'value'    => 'form'
                        ),
                        array(
                            'name'     => 'jltma_search_submit_type',
                            'operator' => '===',
                            'value'    => 'button'
                        )
                    )
                )
            )
        );

        $this->add_control(
            'jltma_search_button_background_color',
            array(
                'label'     => __('Background Color', JLTMA_TD),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#303030',
                'selectors' => array(
                    '{{WRAPPER}} .jltma-search-form .jltma-search-submit' => 'background-color: {{VALUE}}',
                )
            )
        );

        $this->add_control(
            'jltma_search_button_color',
            array(
                'label'     => __('Color', JLTMA_TD),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#303030',
                'selectors' => array(
                    '{{WRAPPER}} .jltma-search-form .jltma-search-submit' => 'color: {{VALUE}}',
                )
            )
        );

        $this->add_responsive_control(
            'jltma_search_button_padding',
            array(
                'label'      => __('Padding', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-search-form .jltma-search-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_responsive_control(
            'jltma_search_button_margin',
            array(
                'label'      => __('Margin', JLTMA_TD),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .jltma-search-form .jltma-search-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'jltma_search_button_typgraphy',
                'scheme'   => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .jltma-search-form .jltma-search-submit'
            )
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
                'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', JLTMA_TD), '<a href="https://master-addons.com/demos/search-element/" target="_blank" rel="noopener">', '</a>'),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_2',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', JLTMA_TD), '<a href="https://master-addons.com/docs/addons/search-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_3',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', JLTMA_TD), '<a href="https://www.youtube.com/watch?v=Uk6nnoN5AJ4" target="_blank" rel="noopener">', '</a>'),
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


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $jltma_search_type = $settings['jltma_search_type'];
        // $settings['jltma_search_has_category']
        $jltma_search_submit_type   = $settings['jltma_search_submit_type'];
        $jltma_search_submit_button = $settings['jltma_search_submit_button'];
        $jltma_search_icon          = $settings['jltma_search_icon'];

        // $icon_migrated = isset($settings['__fa4_migrated']['jltma_search_icon']);
        // $icon_is_new   = empty($settings['jltma_search_icon_new']);


        $this->add_render_attribute('ma_el_search_wrap', [
            'class'    => [
                'jltma-search-wrapper',
                'jltma-search-wrapper-' . $jltma_search_type,

            ],
            'id'               => 'jltma-search-wrapper-' . $this->get_id(),
            'data-search-type' => $jltma_search_type
        ]);
?>

        <div <?php echo $this->get_render_attribute_string('ma_el_search_wrap'); ?>>

            <?php if ($jltma_search_type == "icon") { ?>

                <main class="jltma-search-main-wrap">
                    <div class="jltma-search-wrap">
                        <button id="jltma-btn-search" class="jltma-btn--search">
                            <?php
                            if (!empty($jltma_search_icon['value'])) {
                                echo '<i class="' . $jltma_search_icon['value'] . '"></i>';
                            } else {
                                echo '<i class="fas fa-search"></i>';
                            }
                            ?>
                        </button>
                    </div>
                </main><!-- /main-wrap -->

                <div class="jltma-search">
                    <button id="jltma-btn-search-close" class="jltma-btn--search-close" aria-label="Close search form">
                        <svg class="jltma-icon--search" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: url(#linear-gradient);
                                    }

                                    .cls-2 {
                                        fill: url(#linear-gradient-2);
                                    }

                                    .cls-3 {
                                        fill: #fff;
                                    }
                                </style>
                                <linearGradient id="linear-gradient" y1="40" x2="40" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#c6027a" />
                                    <stop offset="1" stop-color="#143df4" />
                                </linearGradient>
                                <linearGradient id="linear-gradient-2" y1="40" x2="40" gradientUnits="userSpaceOnUse">
                                    <stop offset="1" stop-color="#c6027a" />
                                    <stop offset="1" stop-color="#143df4" />
                                </linearGradient>
                            </defs>
                            <title>close_03</title>
                            <rect class="cls-1" width="40" height="40" />
                            <rect class="cls-2" width="40" height="40" />
                            <path class="cls-3" d="M22.12,20l6.72-6.72a1.5,1.5,0,1,0-2.12-2.12L20,17.88l-6.72-6.72a1.5,1.5,0,1,0-2.12,2.12L17.88,20l-6.72,6.72a1.5,1.5,0,1,0,2.12,2.12L20,22.12l6.72,6.72a1.5,1.5,0,1,0,2.12-2.12Z" />
                        </svg>
                    </button>

                    <form class="jltma-search__form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                        <input class="jltma-search__input" name="s" id="s" placeholder="<?php echo esc_attr($settings['jltma_search_icon_popup_search_text']); ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />


                        <?php
                        // if ( $args['has_category'] ) {
                        //     $all_taxs     = get_taxonomies( array( '_builtin' => FALSE ) );
                        //     $accepted_tax = array('product_cat', 'news-category', 'portfolio-cat');
                        //     $taxonomies   = array( 'category' );

                        //     foreach ( $all_taxs as $tax => $value ) {
                        //         if( in_array( $tax, $accepted_tax ) ) {
                        //             array_push( $taxonomies, $tax );
                        //         }
                        //     }

                        //     $dropdown_args = array (
                        //         'show_option_all' =>  __('All Categories', JLTMA_TD),
                        //         'taxonomy' => $taxonomies
                        //     );
                        // }

                        // if ( $args['has_category'] ) {
                        //     wp_dropdown_categories( $dropdown_args );
                        // }
                        ?>


                        <?php
                        // $jltma_search_post_types = $settings['jltma_search_post_types'];
                        // $query_types = get_query_var('post_type');
                        // foreach ($jltma_search_post_types as $post_type) {
                        //     if (in_array($post_type, $query_types)) {
                        //         $checked_types =  'checked="checked"';
                        //     }
                        //     echo '<input type="checkbox" name="post_type[]" value="'. $post_type .'"' . $checked_types .' /><label>'. ucwords($post_type) .'</label>';
                        // }
                        ?>


                        <?php if (!empty($settings['jltma_search_icon_popup_search_details_desc'])) { ?>
                            <span class="jltma-search__info">
                                <?php echo esc_attr($settings['jltma_search_icon_popup_search_details_desc']); ?>
                            </span>
                        <?php } ?>
                    </form>
                </div><!-- /search -->

            <?php } else if ($jltma_search_type == "form") { ?>

                <form method="get" class="jltma-search-form" action="<?php echo esc_url(home_url('/')); ?>">

                    <div class="jltma-input-group">

                        <input type="text" class="jltma-form-control jltma-search-field" name="s" title="Search for:" placeholder="<?php echo esc_html__('Search', JLTMA_TD); ?>" required="">

                        <div class="jltma-input-group-append">
                            <button type="submit" class="jltma-search-submit jltma-btn <?php if ($jltma_search_submit_type == "button") echo "jltma-text"; ?>">
                                <?php
                                if (!empty($jltma_search_icon['value'])) {
                                    echo '<i class="' . $jltma_search_icon['value'] . '"></i>';
                                } else {
                                    echo '<i class="fas fa-search"></i>';
                                }
                                ?>

                                <?php
                                if ($jltma_search_submit_button) {
                                    echo '<span>' . $jltma_search_submit_button . '</span>';
                                } ?>
                            </button>
                        </div>
                    </div>

                </form>

            <?php } ?>

        </div> <!-- .search-wrapper -->

<?php

    }
}
