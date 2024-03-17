<?php

// Elementor Widget Class
class Author_Info_Widget extends \Elementor\Widget_Base {

    // Widget Name
    public function get_name() {
        return 'author-info-widget';
    }

    // Widget Title
    public function get_title() {
        return __( 'Author Info', 'paperx' );
    }

    // Widget Icon (Optional)
    public function get_icon() {
        return 'eicon-person';
    }

    // Widget Categories
    public function get_categories() {
        return ['Paper X'];
    }

    // Widget Controls
    protected function _register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'paperx' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        // Author Name Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_name_typography',
                'label' => __('Author Name Typography', 'paperx'),
                'description' => __('Set the typography for author name.', 'paperx'),
                'selector' => '{{WRAPPER}} .author-name a',
            ]
        );
    
        // Author Name Color
        $this->add_control(
            'author_name_color',
            [
                'label' => __('Author Name Color', 'paperx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author-name a' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        // Last Updated Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'last_updated_typography',
                'label' => __('Last Updated Typography', 'paperx'),
                'description' => __('Set the typography for last updated text.', 'paperx'),
                'selector' => '{{WRAPPER}} .author-name-last-updated p',
            ]
        );
    
        // Last Updated Color
        $this->add_control(
            'last_updated_color',
            [
                'label' => __('Last Updated Color', 'paperx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author-name-last-updated p' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        // Additional Author Name Hover Color
        $this->add_control(
            'author_name_hover_color',
            [
                'label' => __('Author Name Hover Color', 'paperx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author-name a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_section();
    }
    


    // Widget Render
    protected function render() {
        // Include the content of post-share-social-media.php
        include( get_template_directory() . '/Template/author-info.php' );
    }
}



// Elementor Widget Class
class Comment_Widget extends \Elementor\Widget_Base {

    // Widget Name
    public function get_name() {
        return 'comment-widget';
    }

    // Widget Title
    public function get_title() {
        return __( 'Comment Widget', 'paperx' );
    }

    // Widget Icon (Optional)
    public function get_icon() {
        return 'eicon-comments';
    }

    // Widget Categories
    public function get_categories() {
        return ['Paper X'];
    }

    // Widget Controls
    protected function _register_controls() {
        // No controls needed as the widget will display comments
    }

    // Widget Render
	protected function render() {
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    }

}



class Post_Thumbnail_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'post-thumbnail-widget';
    }

    public function get_title() {
        return __( 'Post Thumbnail', 'paperx' );
    }

    public function get_icon() {
        return 'eicon-image-rollover';
    }

    public function get_categories() {
        return ['Paper X'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'paperx' ),
            ]
        );

        $this->add_responsive_control(
			'thumbnail_width',
			[
				'label' => __( 'Width', 'paperx' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1600,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-thumbnailss-single1 img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'thumbnail_border_radius', // Changed the control ID
            [
                'label' => __( 'Border Radius', 'paperx' ), // Updated label
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100, // Changed max value to 100 for border-radius
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-thumbnailss-single1 img' => 'border-radius: {{SIZE}}{{UNIT}};', // Updated selector and property
                ],
            ]
        );
        
		
		$this->add_responsive_control(
			'thumbnail_height',
			[
				'label' => __( 'Height', 'paperx' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1600,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-thumbnailss-single1 img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    
        // Check if the current post has a thumbnail
        if (has_post_thumbnail()) {
            // Output the thumbnail inside a container
            echo '<div class="post-thumbnailss-single1">';
            echo '<img src="' . esc_url(get_the_post_thumbnail_url(null, 'full')) . '" alt="' . esc_attr(get_the_title()) . '" />';
            echo '</div>';
        } else {
            // Output a placeholder if no thumbnail is set
            echo '<div class="post-thumbnailss-single1">';
            echo '<img src="' . esc_url(get_template_directory_uri()) . '/Assets/Image/noimage.jpg" alt="No Image">';
            echo '</div>';
        }
        
    }
}




class Post_Title_Widget extends \Elementor\Widget_Base{

    public function get_name() {
        return 'post-title-widget';
    }

    public function get_title() {
        return __( 'Post Title', 'paperx' );
    }

    public function get_icon() {
        return 'eicon-editor-h1';
    }

    public function get_categories() {
        return [ 'Paper X' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'paperx' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __('Title Typography', 'paperx'),
                'description' => __('Set the typography for post titles.', 'paperx'),
                'selector' => '{{WRAPPER}} .el-post-title-paperx h1',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Text Color', 'paperx'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of post title text.', 'paperx'),
                'selectors' => [
                    '{{WRAPPER}} .el-post-title-paperx h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __('Text Align', 'paperx'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'description' => __('Set the alignment of the text.', 'paperx'),
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
                'default' => 'Left',
                'selectors' => [
                    '{{WRAPPER}} .el-post-title-paperx h1' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $post_title = get_the_title(); // Get the current post's title
        ?>
        <div class="el-post-title-paperx">
        <h1><?php echo esc_html($post_title); ?></h1>
        </div>
        <?php
    }
    
}



class Post_Meta_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'post-meta-widget';
    }

    public function get_title() {
        return __( 'Post Meta', 'paperx' );
    }

    public function get_icon() {
        return 'eicon-tags';
    }

    public function get_categories() {
        return [ 'Paper X' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'paperx' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typography',
                'label'    => __('Link Typography', 'paperx'),
                'description' => __('Set the typography for post Meta Link.', 'paperx'),
                'selector' => '{{WRAPPER}} .el-post-meta a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typography_span',
                'label'    => __('Meta Typography', 'paperx'),
                'description' => __('Set the typography for post Meta.', 'paperx'),
                'selector' => '{{WRAPPER}} .el-post-meta span',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'     => __(' Meta Color', 'paperx'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of post meta text.', 'paperx'),
                'selectors' => [
                    '{{WRAPPER}} .el-post-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_color_a',
            [
                'label'     => __(' Meta Link Color', 'paperx'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of post meta link text.', 'paperx'),
                'selectors' => [
                    '{{WRAPPER}} .el-post-meta span' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="el-post-meta">
            <?php if (get_the_category()) : ?>
                <div class="el-post-categories">
                    <span><?php _e('Categories:', 'paperx'); ?></span>
                    <?php the_category(', '); ?>
                </div>
            <?php endif; ?>

            <?php if (get_the_tags()) : ?>
                <div class="el-post-tags">
                    <span><?php _e('Tags:', 'paperx'); ?></span>
                    <?php the_tags('', ', ', ''); ?>
                </div>
                
            <?php endif; ?>

            <div class="el-post-author">
                <span><?php _e('Author:', 'paperx'); ?></span>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                    <?php the_author(); ?>
                </a>
            </div>
        </div>
        <?php
    }
}



class Breadcrumb_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'breadcrumb-widget';
    }

    public function get_title() {
        return __( 'Breadcrumb', 'paperx' );
    }

    public function get_icon() {
        return 'eicon-chevron-right';
    }

    public function get_categories() {
        return [ 'Paper X' ];
    }

    protected function _register_controls() {
        // No additional controls needed for this widget
    }

    protected function render() {
        ?>
    <ul class="breadcrumb-single2">
        <li><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
        <li><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></li>
    </ul>
        <?php
    }
}



class Post_Excerpt_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'post-excerpt-widget';
    }

    public function get_title() {
        return __( 'Post Excerpt Widget', 'paperx' );
    }

    public function get_icon() {
        return 'eicon-editor-paragraph';
    }

    public function get_categories() {
        return [ 'Paper X' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'paperx' ),
            ]
        );

        // Add excerpt length control
        $this->add_control(
            'excerpt_length',
            [
                'label' => __( 'Excerpt Length', 'paperx' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 20,
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __('Text Align', 'paperx'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'description' => __('Set the alignment of the text.', 'paperx'),
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
                'default' => 'left', // 'Left' should be lowercase
                'selectors' => [
                    '{{WRAPPER}} .post-excerpt-widget p' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'Excerpt_typo',
                'label'    => __('Excerpt Typography', 'paperx'),
                'description' => __('Set the typography for post titles.', 'paperx'),
                'selector' => '{{WRAPPER}} .post-excerpt-widget p',
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => __('Excerpt Color', 'paperx'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of post titles.', 'paperx'),
                'selectors' => [
                    '{{WRAPPER}} .post-excerpt-widget p' => 'color: {{VALUE}};',
                ],
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $args = array(
            'posts_per_page' => 1,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $posts_query = new WP_Query($args);

        if ($posts_query->have_posts()) {
            while ($posts_query->have_posts()) {
                $posts_query->the_post();

                echo '<div class="post-excerpt-widget">';

                echo '<p>' . wp_trim_words(get_the_excerpt(), $settings['excerpt_length']) . '</p>';

                echo '</div>';
            }
            wp_reset_postdata();
        } else {
            echo '<div class="post-excerpt-widget"><p>No posts found.</p></div>';
        }
    }
}



// Define namespace and class name

class Custom_Nav_Menu_Widget extends \Elementor\Widget_Base {

    // Define widget name
    public function get_name() {
        return 'custom-nav-menu-widget';
    }

    // Define widget title
    public function get_title() {
        return __( ' Nav Menu', 'paperx' );
    }

    // Define widget icon
    public function get_icon() {
        return 'eicon-nav-menu';
    }

    // Define widget categories
    public function get_categories() {
        return [ 'Paper X' ];
    }

    // Define widget controls
    protected function _register_controls() {
        $this->start_controls_section(
            'section_menu',
            [
                'label' => __( 'Menu', 'paperx' ),
            ]
        );

        $this->add_control(
            'menu',
            [
                'label' => __( 'Select Menu', 'paperx' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_available_menus(),
                'default' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'paperx' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // You can add style controls here if needed

        $this->end_controls_section();
    }

    // Define widget content output
    protected function render() {
        $settings = $this->get_settings_for_display();
    
        $menu_id = ! empty( $settings['menu'] ) ? $settings['menu'] : '';
    
        // Check if menu location is set
        $theme_location = ! empty( $settings['theme_location'] ) ? $settings['theme_location'] : '';
    
        if ( $menu_id || $theme_location ) {
            ?>
            <nav class="paper-header-menu">
                <?php
                // Pass theme_location instead of menu ID directly
                wp_nav_menu(array(
                    'theme_location' => $theme_location,
                    'menu' => $menu_id, // Keep this for backward compatibility, if necessary
                    'container' => false,
                    'menu_class' => 'primary-menu',
                    'fallback_cb' => false,
                ));
                ?>
            </nav>
    
            <div class='menu-mobile-icon'>
                <img onclick="callHamburger()" class="image-menu-close-icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/Assets/Image/close.png" alt="">
                <img class="image-menu-icon" onclick="callHamburger()" src="<?php echo esc_url(get_template_directory_uri()); ?>/Assets/Image/menu.png" alt="">
                <div class="paper-header-menu-mobile">
    
                    <div class='search-box-mobile-menu'>
                        <?php get_search_form(); ?>
                    </div>
    
                    <nav class="mobile-nav">
                        <?php
                        // Pass theme_location instead of menu ID directly
                        wp_nav_menu(array(
                            'theme_location' => $theme_location,
                            'menu' => $menu_id, // Keep this for backward compatibility, if necessary
                            'container' => false,
                            'menu_class' => 'primary-menu',
                            'fallback_cb' => false,
                        ));
                        ?>
                    </nav>
                </div>
            </div>
            <?php
        }
    }
    
    // Get available menus
    protected function get_available_menus() {
        $menus = wp_get_nav_menus();
        $options = [];
        foreach ( $menus as $menu ) {
            $options[$menu->term_id] = $menu->name;
        }
        return $options;
    }
}



