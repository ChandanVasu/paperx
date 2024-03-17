<?php
// Define the custom Elementor widget class
class Grid_Post_1 extends \Elementor\Widget_Base
{
    // Define widget name and title
    public function get_name()
    {
        return 'Grid_Post_1';
    }

    public function get_title()
    {
        return __('Grid Post 1', 'paperx');
    }

    // Define widget icon
    public function get_icon() {
        // Assuming the custom icon is located in the 'assets' folder within your theme or plugin directory
          return 'eicon-post-list';
    }
    

    // Define widget categories
    public function get_categories()
    {
        return ['Paper X'];
    }

    protected function render() {
        $settings = $this->get_settings();

        // Check if dynamic filtering is enabled
        if ($settings['dynamic_filtering'] === 'yes') {
            // Get current query parameters
            $current_query = $GLOBALS['wp_query'];
            $query_args = $current_query->query;
        
            $categories = get_the_category();
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
        
            // Define query args to filter by current post's categories
            if (is_single()) {
                // Apply specific query args for single post page
                $query_args = array(
                    'post_type'      => 'post',
                    'category__in'   => $category_ids,
                );
            }
        
            // Modify query args to filter by current query
            // Example: If on category page, filter by category
            // if (isset($query_args['cat'])) {
            //     $query_args['category__in'] = array($query_args['cat']);
            // }
        
            // Check if the current page is a single post
           
        
            // Don't override posts_per_page if it's already set
            if (!isset($query_args['posts_per_page'])) {
                $query_args['posts_per_page'] = isset($settings['posts_per_page']) ? $settings['posts_per_page'] : 5;
            }
        
            if (!isset($query_args['offset'])){
                $query_args['offset'] = isset($settings['offset']) ? $settings['offset'] : 0;
            }
        
            if(!isset($query_args['order'])) {
                $query_args['order'] = isset($settings['order']) ? $settings['order'] : 'DESC'; 
            }
        
            $query_args['post_type'] = 'post';
        
            // Create new query with modified args
            $posts_query = new WP_Query($query_args);
        } else {
            // Normal query with selected categories
            $query_args = array(
                'post_type'      => 'post',
                'posts_per_page' => isset($settings['posts_per_page']) ? $settings['posts_per_page'] : 5,
                'category__in'   => isset($settings['category']) ? $settings['category'] : array(),
                'offset'         => isset($settings['offset']) ? $settings['offset'] : 0,
                'order' => isset($settings['order']) ? $settings['order'] : 'DESC', // Add ordering
        
            );
        
            $posts_query = new WP_Query($query_args);
        }
        
    
        // Display posts
        if ($posts_query->have_posts()) :
        ?>
<div class="el-g-1-grid-container"> <!-- Modified class name -->
    <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
    <div class="el-g-1-custom-post-item-paperx"> <!-- Modified class name -->
        <div class="el-g-1-post-thumbnail-paperx"> <!-- Modified class name -->
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            <span class="el-g-1-category-meta-paperx">
                <?php the_category(', '); ?>
            </span> <!-- Modified class name -->
        </div>

        <h2 class="el-g-1-post-title-paperx"><a href="<?php the_permalink(); ?>">
                <?php echo wp_trim_words(get_the_title(), $settings['title_length'], '...'); ?>
            </a></h2> <!-- Modified class name -->

        <div class="el-g-1-post-content-paperx"> <!-- Modified class name -->
            <?php echo wp_trim_words(get_the_content(), $settings['content_length'], '...'); ?>
        </div>
        <div class="el-g-1-post-meta-paperx"> <!-- Modified class name -->
            <?php
                            $author_id = get_the_author_meta('ID');
                            $author_avatar = get_avatar_url($author_id, ['size' => 32]);
                            ?>
            <img class="el-g-1-author-avatar-paperx" src="<?php echo esc_url($author_avatar); ?>"
                alt="<?php echo esc_attr(get_the_author()); ?>"> <!-- Modified class name -->
            <a class="el-g-1-name-meta-paperx" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
                <?php the_author(); ?>
            </a>
            <span class="el-g-1-date-meta-paperx">
                <?php echo get_the_date(); ?>
            </span> <!-- Modified class name -->
        </div>
    </div>
    <?php endwhile; ?>
</div>
<?php wp_reset_postdata(); // Reset post data
        else :
            echo '<div class="el-g-1-no-posts-found">' . __('No posts found', 'paperx') . '</div>';
        endif;
    }
    


    // Define widget settings fields
    protected function _register_controls()
    {
// Content Section
$this->start_controls_section(
    'section_content',
    [
        'label' => __('Content', 'paperx'),
    ]
);

$this->add_control(
    'dynamic_filtering',
    [
        'label' => __('Current Query', 'paperx'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'description' => __('Toggle to Archive Posts based on current query.', 'paperx'),
        'default' => 'no',
    ]
);

// Only show category selection if dynamic filtering is disabled
$this->add_control(
    'category',
    [
        'label' => __('Select Category', 'paperx'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'description' => __('Select the categories you want to display.', 'paperx'),
        'options' => $this->get_all_categories_options(),
        'multiple' => true,
        'condition' => [
            'dynamic_filtering!' => 'yes',
        ],
    ]
);

$this->add_control(
    'posts_per_page',
    [
        'label'   => __('Posts Per Page', 'paperx'),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the number of posts to display per page.', 'paperx'),
        'default' => 8, // Default number of posts to display
    ]
);

$this->add_control(
    'offset',
    [
        'label'   => __('Post Offset', 'paperx'),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the number of posts to offset.', 'paperx'),
        'default' => 0, // Default offset value
    ]
);

$this->add_control(
    'title_length',
    [
        'label'   => __('Title Length', 'paperx'),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the maximum length of the title.', 'paperx'),
        'default' => 10, // Default number of words to display in title
    ]
);

$this->add_control(
    'content_length',
    [
        'label'   => __('Content Length', 'paperx'),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the maximum length of the content.', 'paperx'),
        'default' => 20, // Default number of words to display in content
    ]
);

$this->add_responsive_control(
    'items_per_row_desktop',
    [
        'label'     => __('Items Per Row ', 'paperx'),
        'type'      => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the number of items to display per row on desktop.', 'paperx'),
        'selectors' => [
            '{{WRAPPER}} .el-g-1-grid-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
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
            '{{WRAPPER}} .el-g-1-custom-post-item-paperx' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'order',
    [
        'label' => __('Order', 'paperx'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'ASC' => __('Ascending', 'paperx'),
            'DESC' => __('Descending', 'paperx'),
        ],
        'default' => 'DESC', // Default ordering
    ]
);

// $this->end_controls_section();

// // Style Section
// $this->start_controls_section(
//     'section_style',
//     [
//         'label' => __('Style', 'paperx'),
//     ]
// );

$this->add_responsive_control(
	'show_image',
	[
		'label' => __( 'Show Image', 'paperx' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'paperx' ),
		'label_off' => __( 'Off', 'paperx' ),
        'description' => __('Toggle to display or hide post image.', 'paperx'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-1-post-thumbnail-paperx' => 'display: {{VALUE}}',
		],
	]
);

$this->add_responsive_control(
	'show_post_meta',
	[
		'label' => __( 'Show Meta', 'paperx' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'paperx' ),
		'label_off' => __( 'Off', 'paperx' ),
        'description' => __('Toggle to display or hide post meta.', 'paperx'),
		'return_value'	=> 'none',
		'default'	=> 'flex',
		'selectors' => [
			'{{WRAPPER}} .el-g-1-post-meta-paperx' => 'display: {{VALUE}}',
		],
	]
);

$this->add_responsive_control(
	'show_category',
	[
		'label' => __( 'Show Category', 'paperx' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'paperx' ),
		'label_off' => __( 'Off', 'paperx' ),
        'description' => __('Toggle to display or hide post categories.', 'paperx'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-1-category-meta-paperx' => 'display: {{VALUE}}',
		],
	]
);


$this->add_responsive_control(
	'show_post_title',
	[
		'label' => __( 'Show Post Title', 'paperx' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'paperx' ),
		'label_off' => __( 'Off', 'paperx' ),
        'description' => __('Toggle to display or hide post title.', 'paperx'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-1-post-title-paperx' => 'display: {{VALUE}}',
		],
	]
);

$this->add_responsive_control(
	'show_post_content',
	[
		'label' => __( 'Show Post Content', 'paperx' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'paperx' ),
		'label_off' => __( 'Off', 'paperx' ),
        'description' => __('Toggle to display or hide post content.', 'paperx'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-1-post-content-paperx' => 'display: {{VALUE}}',
		],
	]
);


$this->add_responsive_control(
	'show_author_image',
	[
		'label' => __( 'Show Author Image', 'paperx' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'paperx' ),
		'label_off' => __( 'Off', 'paperx' ),
        'description' => __('Toggle to display or hide author image.', 'paperx'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-1-author-avatar-paperx' => 'display: {{VALUE}}',
		],
	]
);


$this->add_responsive_control(
	'show_date',
	[
		'label' => __( 'Show Post Date', 'paperx' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'paperx' ),
		'label_off' => __( 'Off', 'paperx' ),
        'description' => __('Toggle to display or hide post date.', 'paperx'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-l-1-date-meta-paperx' => 'display: {{VALUE}}',
		],
	]
);

$this->end_controls_section();



// Post Style Subsection
$this->start_controls_section(
    'section_post_style',
    [
        'label' => __('Post Style', 'paperx'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'image_border_radius',
    [
        'label'     => __('Image Border Radius', 'paperx'),
        'type'      => \Elementor\Controls_Manager::DIMENSIONS,
        'description' => __('Set border radius for post images.', 'paperx'),
        'size_units' => ['px', '%'],
        'selectors' => [
            '{{WRAPPER}} .el-g-1-post-thumbnail-paperx img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'transform_hover',
    [
        'label' => __('Hover Transform', 'paperx'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'description' => __('Set the scale factor for post items on hover.', 'paperx'),
        'size_units' => [''],
        'range' => [
            'px' => [
                'min' => 0.5,
                'max' => 2,
                'step' => 0.01,
            ],
        ],
        'default' => [
            'unit' => '',
            'size' => 1.03,
        ],
        'selectors' => [
            '{{WRAPPER}} .el-g-1-post-thumbnail-paperx img:hover' => 'transform: scale({{SIZE}});',
        ],
    ]
);



$this->add_responsive_control(
    'image_height',
    [
        'label' => esc_html__( 'Image Height', 'paperx' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 150,
        ],
        'selectors' => [
            '{{WRAPPER}} .el-g-1-post-thumbnail-paperx img' => 'height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();

// Title Style Section
$this->start_controls_section(
    'section_title_style',
    [
        'label' => __('Title', 'paperx'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'title_color',
    [
        'label'     => __('Title Color', 'paperx'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post titles.', 'paperx'),
        'selectors' => [
            '{{WRAPPER}} .el-g-1-post-title-paperx a' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'title_hover_text_decoration',
    [
        'label' => __('Title Text Decoration (Hover)', 'paperx'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'description' => __('Set the text decoration for post titles on hover.', 'paperx'),
        'default' => 'none',
        'options' => [
            'none' => __('None', 'paperx'),
            'underline' => __('Underline', 'paperx'),
            'overline' => __('Overline', 'paperx'),
            'line-through' => __('Line Through', 'paperx'),
        ],
        'selectors' => [
            '{{WRAPPER}} .el-g-1-post-title-paperx:hover ' => 'text-decoration: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'title_hover_text_color',
    [
        'label' => __('Title Text Color (Hover)', 'paperx'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post titles on hover.', 'paperx'),
        'selectors' => [
            '{{WRAPPER}} .el-g-1-post-title-paperx:hover' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'title_typography',
        'label'    => __('Title Typography', 'paperx'),
        'description' => __('Set the typography for post titles.', 'paperx'),
        'selector' => '{{WRAPPER}} .el-g-1-post-title-paperx a',
    ]
);

$this->end_controls_section();

// Category Style Section
$this->start_controls_section(
    'section_category_style',
    [
        'label' => __('Category', 'paperx'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'category_text_color',
    [
        'label'     => __('Category Text Color', 'paperx'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post category text.', 'paperx'),
        'selectors' => [
            '{{WRAPPER}} .el-g-1-category-meta-paperx a' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'category_bg_color',
    [
        'label'     => __('Category Background Color', 'paperx'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the background color of post category.', 'paperx'),
        'selectors' => [
            '{{WRAPPER}} .el-g-1-category-meta-paperx a' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'border_radius',
    [
        'label' => __('Border Radius', 'paperx'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'description' => __('Set the border radius of post category.', 'paperx'),
        'size_units' => ['px', '%'],
        'selectors' => [
            '{{WRAPPER}} .el-g-1-category-meta-paperx a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'category_position',
    [
        'label' => __('Category Position', 'paperx'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'description' => __('Set the position of post category.', 'paperx'),
        'size_units' => ['px', '%'],
        'selectors' => [
            '{{WRAPPER}} .el-g-1-category-meta-paperx a' => 'left: {{LEFT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'category_typography',
        'label'    => __('Category Typography', 'paperx'),
        'description' => __('Set the typography for post category.', 'paperx'),
        'selector' => '{{WRAPPER}} .el-g-1-category-meta-paperx',
    ]
);

$this->end_controls_section();

// Author Style Section
$this->start_controls_section(
    'section_author_style',
    [
        'label' => __('Author', 'paperx'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'author_color',
    [
        'label'     => __('Author Color', 'paperx'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post author.', 'paperx'),
        'selectors' => [
            '{{WRAPPER}} .el-g-1-post-meta-paperx a' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'author_typography',
        'label'    => __('Author Typography', 'paperx'),
        'description' => __('Set the typography for post author.', 'paperx'),
        'selector' => '{{WRAPPER}} .el-g-1-post-meta-paperx a',
    ]
);

$this->end_controls_section();

// Date Style Section
$this->start_controls_section(
    'section_date_style',
    [
        'label' => __('Date', 'paperx'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'date_typography',
        'label'    => __('Date Typography', 'paperx'),
        'description' => __('Set the typography for post date.', 'paperx'),
        'selector' => '{{WRAPPER}} .el-g-1-date-meta-paperx',
    ]
);

$this->end_controls_section();

// Content Style Section
$this->start_controls_section(
    'section_content_style',
    [
        'label' => __('Content', 'paperx'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'content_color',
    [
        'label'     => __('Content Color', 'paperx'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post content.', 'paperx'),
        'selectors' => [
            '{{WRAPPER}} .el-g-1-post-content-paperx' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'content_typography',
        'label'    => __('Content Typography', 'paperx'),
        'description' => __('Set the typography for post content.', 'paperx'),
        'selector' => '{{WRAPPER}} .el-g-1-post-content-paperx',
    ]
);

$this->end_controls_section();

// Container Style Section
$this->start_controls_section(
    'section_container_style',
    [
        'label' => __('Container', 'paperx'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'border_color',
    [
        'label' => __('Border Color', 'paperx'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of the container border.', 'paperx'),
        'selectors' => [
            '{{WRAPPER}} .el-g-1-custom-post-item-paperx' => 'border-color: {{VALUE}};',
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
            '{{WRAPPER}} .el-g-1-custom-post-item-paperx' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
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
            '{{WRAPPER}} .el-g-1-custom-post-item-paperx' => 'border-style: {{VALUE}};',
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
            '{{WRAPPER}} .el-g-1-custom-post-item-paperx' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .el-g-1-custom-post-item-paperx' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'box_shadow',
        'description' => __('Add box shadow to the container.', 'paperx'),
        'selector' => '{{WRAPPER}} .el-g-1-custom-post-item-paperx',
    ]
);

$this->end_controls_section();

    }
    private function get_all_categories_options()
    {
        $categories = get_categories();
        $options = [];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }
        // Add dynamic filtering option
        // $options['dynamic_filtering'] = 'Dynamic Filtering';
        
        return $options;
    }

    

    
}