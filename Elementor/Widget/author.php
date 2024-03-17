<?php
// Elementor Widget Class
class Custom_Post_Share_Widget extends \Elementor\Widget_Base {

    // Widget Name
    public function get_name() {
        return 'custom-post-share-widget';
    }

    // Widget Title
    public function get_title() {
        return __( 'Post Share', 'paperx' );
    }

    // Widget Icon (Optional)
    public function get_icon() {
        return 'eicon-share';
    }

    // Widget Categories
    public function get_categories() {
        return [ 'Paper X' ];
    }

    // Widget Controls
    protected function _register_controls() {
        // Color Control
        $this->start_controls_section(
            'section_social_colors',
            [
                'label' => __( 'Social Media Icons Colors', 'paperx' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', 'paperx' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-social-mededi-icon a i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label' => __( 'Icon Hover Color', 'paperx' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-social-mededi-icon a:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __('Background Color', 'paperx'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the background color of the container.', 'paperx'),
                'selectors' => [
                    '{{WRAPPER}} .el-social-mededi-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_border_radius',
            [
                'label' => __('Background Border Radius', 'paperx'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'description' => __('Set the border radius of the container background.', 'paperx'),
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .el-social-mededi-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'description' => __('Add box shadow to the container.', 'paperx'),
                'selector' => '{{WRAPPER}} .el-social-mededi-icon',
            ]
        );

        $this->add_control(
            'border_style',
            [
                'label' => __('Border Style', 'paperx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'description' => __('Set the style of the container border.', 'paperx'),
                'default' => 'none',
                'options' => [
                    'solid' => __('Solid', 'paperx'),
                    'dotted' => __('Dotted', 'paperx'),
                    'dashed' => __('Dashed', 'paperx'),
                    'double' => __('Double', 'paperx'),
                    'groove' => __('Groove', 'paperx'),
                    'ridge' => __('Ridge', 'paperx'),
                    'inset' => __('Inset', 'paperx'),
                    'outset' => __('Outset', 'paperx'),
                    'none' => __('None', 'paperx'),
                    'hidden' => __('Hidden', 'paperx'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-social-mededi-icon' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __('Border Color', 'paperx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of the container border.', 'paperx'),
                'selectors' => [
                    '{{WRAPPER}} .el-social-mededi-icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'border_width',
            [
                'label' => __('Border Width', 'paperx'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'description' => __('Set the width of the container border.', 'paperx'),
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .el-social-mededi-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Widget Render
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="el-social-mededi-icon">
            <ul class="social-mededi-icon-share">
                <li> <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="currentColor" d="M9.78 2.05a.5.5 0 0 1 .527.055l4.5 3.5a.5.5 0 0 1 .025.769l-4.5 4A.5.5 0 0 1 9.5 10V8.056c-.236.04-.544.11-.904.23c-.873.292-2.054.879-3.242 2.068a.5.5 0 0 1-.852-.4c.143-1.571.601-2.717 1.224-3.543a4.693 4.693 0 0 1 2.095-1.574A5.372 5.372 0 0 1 9.5 4.493V2.5a.5.5 0 0 1 .28-.45M2 5.5A2.5 2.5 0 0 1 4.5 3h2a.5.5 0 0 1 0 1h-2A1.5 1.5 0 0 0 3 5.5v6A1.5 1.5 0 0 0 4.5 13h6a1.5 1.5 0 0 0 1.5-1.5v-1a.5.5 0 0 1 1 0v1a2.5 2.5 0 0 1-2.5 2.5h-6A2.5 2.5 0 0 1 2 11.5z"/></svg>  <span>Share</span> </li>
                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"
                        rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="#1877f2" d="M256 128C256 57.308 198.692 0 128 0C57.308 0 0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445"/><path fill="#fff" d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A128.959 128.959 0 0 0 128 256a128.9 128.9 0 0 0 20-1.555V165z"/></svg></a></li>
                <li><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"
                        target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 128 128"><path d="M75.916 54.2L122.542 0h-11.05L71.008 47.06L38.672 0H1.376l48.898 71.164L1.376 128h11.05L55.18 78.303L89.328 128h37.296L75.913 54.2ZM60.782 71.79l-4.955-7.086l-39.42-56.386h16.972L65.19 53.824l4.954 7.086l41.353 59.15h-16.97L60.782 71.793Z"/></svg></a></li>
                <li><a href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"
                        target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 128 128"><path fill="#0076b2" d="M116 3H12a8.91 8.91 0 0 0-9 8.8v104.42a8.91 8.91 0 0 0 9 8.78h104a8.93 8.93 0 0 0 9-8.81V11.77A8.93 8.93 0 0 0 116 3"/><path fill="#fff" d="M21.06 48.73h18.11V107H21.06zm9.06-29a10.5 10.5 0 1 1-10.5 10.49a10.5 10.5 0 0 1 10.5-10.49m20.41 29h17.36v8h.24c2.42-4.58 8.32-9.41 17.13-9.41C103.6 47.28 107 59.35 107 75v32H88.89V78.65c0-6.75-.12-15.44-9.41-15.44s-10.87 7.36-10.87 15V107H50.53z"/></svg></a></li>
                <li><a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php the_title(); ?>"
                        target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="#cb1f27" d="M0 128.002c0 52.414 31.518 97.442 76.619 117.239c-.36-8.938-.064-19.668 2.228-29.393c2.461-10.391 16.47-69.748 16.47-69.748s-4.089-8.173-4.089-20.252c0-18.969 10.994-33.136 24.686-33.136c11.643 0 17.268 8.745 17.268 19.217c0 11.704-7.465 29.211-11.304 45.426c-3.207 13.578 6.808 24.653 20.203 24.653c24.252 0 40.586-31.149 40.586-68.055c0-28.054-18.895-49.052-53.262-49.052c-38.828 0-63.017 28.956-63.017 61.3c0 11.152 3.288 19.016 8.438 25.106c2.368 2.797 2.697 3.922 1.84 7.134c-.614 2.355-2.024 8.025-2.608 10.272c-.852 3.242-3.479 4.401-6.409 3.204c-17.884-7.301-26.213-26.886-26.213-48.902c0-36.361 30.666-79.961 91.482-79.961c48.87 0 81.035 35.364 81.035 73.325c0 50.213-27.916 87.726-69.066 87.726c-13.819 0-26.818-7.47-31.271-15.955c0 0-7.431 29.492-9.005 35.187c-2.714 9.869-8.026 19.733-12.883 27.421a127.897 127.897 0 0 0 36.277 5.249c70.684 0 127.996-57.309 127.996-128.005C256.001 57.309 198.689 0 128.005 0C57.314 0 0 57.309 0 128.002"/></svg></a></li>
                <!-- Add more social media share links as needed -->
                <li><a href="javascript:void(0);" onclick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="1.09em" height="1em" viewBox="0 0 1664 1536"><path fill="#FF9900" d="M384 1408h896v-256H384zm0-640h896V384h-160q-40 0-68-28t-28-68V128H384zm1152 64q0-26-19-45t-45-19t-45 19t-19 45t19 45t45 19t45-19t19-45m128 0v416q0 13-9.5 22.5t-22.5 9.5h-224v160q0 40-28 68t-68 28H352q-40 0-68-28t-28-68v-160H32q-13 0-22.5-9.5T0 1248V832q0-79 56.5-135.5T192 640h64V96q0-40 28-68t68-28h672q40 0 88 20t76 48l152 152q28 28 48 76t20 88v256h64q79 0 135.5 56.5T1664 832"/></svg></a></li>
            </ul>
        </div>
        <?php
    }
}

// Register the widget
function register_custom_post_share_widget() {
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Custom_Post_Share_Widget() );
}
add_action( 'elementor/widgets/widgets_registered', 'register_custom_post_share_widget' );

