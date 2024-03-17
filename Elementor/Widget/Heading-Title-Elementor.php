<?php
/**
 * Plugin Name: Custom Title Widget
 * Description: Adds a custom Elementor widget for titles with various styling options.
 * Version: 1.0
 * Author: paperx
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Custom_Title_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom-title';
    }

    public function get_title() {
        return __('Heading', 'paperx');
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return ['Paper X'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'paperx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'paperx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Enter your title here', 'paperx'),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'paperx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => __('H1', 'paperx'),
                    'h2' => __('H2', 'paperx'),
                    'h3' => __('H3', 'paperx'),
                    'h4' => __('H4', 'paperx'),
                    'h5' => __('H5', 'paperx'),
                    'h6' => __('H6', 'paperx'),
                    'div' => __('DIV', 'paperx'),
                    'span' => __('SPAN', 'paperx'),
                ],
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label' => __('Title Alignment', 'paperx'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'paperx'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'paperx'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'paperx'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'title_style',
            [
                'label' => __('Title Style', 'paperx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => __('Normal', 'paperx'),
                    'bold' => __('Bold', 'paperx'),
                    'italic' => __('Italic', 'paperx'),
                    'underline' => __('Underline', 'paperx'),
                    'strikethrough' => __('Strikethrough', 'paperx'),
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'paperx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->add_control(
            'title_box_style',
            [
                'label' => __('Title Box Style', 'paperx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __('None', 'paperx'),
                    'style1' => __('Style 1', 'paperx'),
                    'style2' => __('Style 2', 'paperx'),
                    // Add more styles here if needed
                ],
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $title_tag = $settings['title_tag'];
        $title_alignment = $settings['title_alignment'];
        $title_style = $settings['title_style'];
        $title_color = $settings['title_color'];
        $title = $settings['title'];

        // Render title style box if selected
        $title_box_style = $settings['title_box_style'];
        $title_box_html = '';
        if ($title_box_style == 'style1') {
            $title_box_html = '<div class="title_box" style="display: inline-flex; align-items: center;">
                <div class="before_title" style="height: 25px; width: 5px; background-color: rgb(219, 17, 17); display: inline-flex; margin-right: 10px; border-radius: 5px;"></div>
                
                <' . $title_tag . ' style="color: ' . $title_color . '; font-weight: ' . ($title_style == 'bold' ? 'bold' : 'normal') . '; font-style: ' . ($title_style == 'italic' ? 'italic' : 'normal') . '; text-decoration: ' . ($title_style == 'underline' ? 'underline' : ($title_style == 'strikethrough' ? 'line-through' : 'none')) . ';">' . $title . '</' . $title_tag . '>
            </div>';
        } elseif ($title_box_style == 'style2') {
            // Add another style here if needed
        } else {
            // Default style without title box
            echo '<' . $title_tag . ' style="text-align: ' . $title_alignment . '; color: ' . $title_color . '; font-weight: ' . ($title_style == 'bold' ? 'bold' : 'normal') . '; font-style: ' . ($title_style == 'italic' ? 'italic' : 'normal') . '; text-decoration: ' . ($title_style == 'underline' ? 'underline' : ($title_style == 'strikethrough' ? 'line-through' : 'none')) . ';">' . $title . '</' . $title_tag . '>';
            return;
        }

        echo esc_html($title_box_html);
    }

}