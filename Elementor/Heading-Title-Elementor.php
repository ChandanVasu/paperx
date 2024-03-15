<?php
/**
 * Plugin Name: Custom Title Widget
 * Description: Adds a custom Elementor widget for titles with various styling options.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Custom_Title_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom-title';
    }

    public function get_title() {
        return __('Custom Title', 'vasutheme');
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return ['Vasu X'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'vasutheme'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Enter your title here', 'vasutheme'),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => __('H1', 'vasutheme'),
                    'h2' => __('H2', 'vasutheme'),
                    'h3' => __('H3', 'vasutheme'),
                    'h4' => __('H4', 'vasutheme'),
                    'h5' => __('H5', 'vasutheme'),
                    'h6' => __('H6', 'vasutheme'),
                    'div' => __('DIV', 'vasutheme'),
                    'span' => __('SPAN', 'vasutheme'),
                ],
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label' => __('Title Alignment', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'vasutheme'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'vasutheme'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'vasutheme'),
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
                'label' => __('Title Style', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => __('Normal', 'vasutheme'),
                    'bold' => __('Bold', 'vasutheme'),
                    'italic' => __('Italic', 'vasutheme'),
                    'underline' => __('Underline', 'vasutheme'),
                    'strikethrough' => __('Strikethrough', 'vasutheme'),
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->add_control(
            'title_box_style',
            [
                'label' => __('Title Box Style', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __('None', 'vasutheme'),
                    'style1' => __('Style 1', 'vasutheme'),
                    'style2' => __('Style 2', 'vasutheme'),
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

        echo $title_box_html;
    }

}