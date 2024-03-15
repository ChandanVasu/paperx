<?php

// Elementor Widget Class
class Author_Info_Widget extends \Elementor\Widget_Base {

    // Widget Name
    public function get_name() {
        return 'author-info-widget';
    }

    // Widget Title
    public function get_title() {
        return __( 'Author Info Widget', 'vasutheme' );
    }

    // Widget Icon (Optional)
    public function get_icon() {
        return 'eicon-person';
    }

    // Widget Categories
    public function get_categories() {
        return ['Vasu X'];
    }

    // Widget Controls
    protected function _register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'vasutheme' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        // Author Name Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_name_typography',
                'label' => __('Author Name Typography', 'vasutheme'),
                'description' => __('Set the typography for author name.', 'vasutheme'),
                'selector' => '{{WRAPPER}} .author-name a',
            ]
        );
    
        // Author Name Color
        $this->add_control(
            'author_name_color',
            [
                'label' => __('Author Name Color', 'vasutheme'),
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
                'label' => __('Last Updated Typography', 'vasutheme'),
                'description' => __('Set the typography for last updated text.', 'vasutheme'),
                'selector' => '{{WRAPPER}} .author-name-last-updated p',
            ]
        );
    
        // Last Updated Color
        $this->add_control(
            'last_updated_color',
            [
                'label' => __('Last Updated Color', 'vasutheme'),
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
                'label' => __('Author Name Hover Color', 'vasutheme'),
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
        return __( 'Comment Widget', 'vasutheme' );
    }

    // Widget Icon (Optional)
    public function get_icon() {
        return 'eicon-comments';
    }

    // Widget Categories
    public function get_categories() {
        return ['Vasu X'];
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
        return __( 'Post Thumbnail Widget', 'vasutheme' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['Vasu X'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'vasutheme' ),
            ]
        );

        $this->add_responsive_control(
			'thumbnail_width',
			[
				'label' => __( 'Width', 'vasutheme' ),
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
                'label' => __( 'Border Radius', 'vasutheme' ), // Updated label
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
				'label' => __( 'Height', 'vasutheme' ),
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
            echo '<img src="http://localhost/wordpress1/wp-content/uploads/2024/03/ssc-20240306-s00108h.jpg" alt="' . esc_attr(get_the_title()) . '" />';
            echo '</div>';
        }
    }
}




class Post_Title_Widget extends \Elementor\Widget_Base{

    public function get_name() {
        return 'post-title-widget';
    }

    public function get_title() {
        return __( 'Post Title', 'vasutheme' );
    }

    public function get_icon() {
        return 'eicon-post-title';
    }

    public function get_categories() {
        return [ 'Vasu X' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'vasutheme' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __('Title Typography', 'vasutheme'),
                'description' => __('Set the typography for post titles.', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-post-title-vasutheme h1',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Text Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of post title text.', 'vasutheme'),
                'selectors' => [
                    '{{WRAPPER}} .el-post-title-vasutheme h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __('Text Align', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'description' => __('Set the alignment of the text.', 'vasutheme'),
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
                'default' => 'Left',
                'selectors' => [
                    '{{WRAPPER}} .el-post-title-vasutheme h1' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $post_title = get_the_title(); // Get the current post's title
        ?>
        <div class="el-post-title-vasutheme">
            <h1><?php echo $post_title; ?></h1>
        </div>
        <?php
    }
    
}



class Post_Meta_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'post-meta-widget';
    }

    public function get_title() {
        return __( 'Post Meta', 'vasutheme' );
    }

    public function get_icon() {
        return 'eicon-tags';
    }

    public function get_categories() {
        return [ 'Vasu X' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'vasutheme' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typography',
                'label'    => __('Link Typography', 'vasutheme'),
                'description' => __('Set the typography for post Meta Link.', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-post-meta a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typography_span',
                'label'    => __('Meta Typography', 'vasutheme'),
                'description' => __('Set the typography for post Meta.', 'vasutheme'),
                'selector' => '{{WRAPPER}} .el-post-meta span',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'     => __(' Meta Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of post meta text.', 'vasutheme'),
                'selectors' => [
                    '{{WRAPPER}} .el-post-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_color_a',
            [
                'label'     => __(' Meta Link Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of post meta link text.', 'vasutheme'),
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
                    <span><?php _e('Categories:', 'vasutheme'); ?></span>
                    <?php the_category(', '); ?>
                </div>
            <?php endif; ?>

            <?php if (get_the_tags()) : ?>
                <div class="el-post-tags">
                    <span><?php _e('Tags:', 'vasutheme'); ?></span>
                    <?php the_tags('', ', ', ''); ?>
                </div>
                
            <?php endif; ?>

            <div class="el-post-author">
                <span><?php _e('Author:', 'vasutheme'); ?></span>
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
        return __( 'Breadcrumb', 'vasutheme' );
    }

    public function get_icon() {
        return 'eicon-chevron-right';
    }

    public function get_categories() {
        return [ 'Vasu X' ];
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
        return __( 'Post Excerpt Widget', 'vasutheme' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'Vasu X' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'vasutheme' ),
            ]
        );

        // Add excerpt length control
        $this->add_control(
            'excerpt_length',
            [
                'label' => __( 'Excerpt Length', 'vasutheme' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 20,
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __('Text Align', 'vasutheme'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'description' => __('Set the alignment of the text.', 'vasutheme'),
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
                'label'    => __('Excerpt Typography', 'vasutheme'),
                'description' => __('Set the typography for post titles.', 'vasutheme'),
                'selector' => '{{WRAPPER}} .post-excerpt-widget p',
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => __('Excerpt Color', 'vasutheme'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'description' => __('Set the color of post titles.', 'vasutheme'),
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


