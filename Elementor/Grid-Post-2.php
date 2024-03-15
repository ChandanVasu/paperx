<?php
// Define the custom Elementor widget class
class Grid_Post_2 extends \Elementor\Widget_Base
{
    // Define widget name and title
    public function get_name()
    {
        return 'Grid_Post_2';
    }

    public function get_title()
    {
        return __('Grid Style 2 - vasuthemes', 'vasutheme');
    }

    // Define widget icon
    public function get_icon() {
        // Assuming the custom icon is located in the 'assets' folder within your theme or plugin directory
          return 'eicon-post-list';
    }
    

    // Define widget categories
    public function get_categories()
    {
        return ['Vasu X'];
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
<div class="el-g-2-grid-container"> <!-- Modified class name -->
    <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
    <div class="el-g-2-custom-post-item-vasutheme"> <!-- Modified class name -->
        <div class="el-g-2-post-thumbnail-vasutheme"> <!-- Modified class name -->
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            
        </div>
             <span class="el-g-2-category-meta-vasutheme">
                <?php the_category(', '); ?>
            </span> 
            <h2 class="el-g-2-post-title-vasutheme"><a href="<?php the_permalink(); ?>">
                <?php echo wp_trim_words(get_the_title(), $settings['title_length'], '...'); ?>
            </a></h2> <!-- Modified class name -->

        <div class="el-g-2-post-meta-vasutheme"> <!-- Modified class name -->
            <?php
                            $author_id = get_the_author_meta('ID');
                            $author_avatar = get_avatar_url($author_id, ['size' => 32]);
                            ?>
            <img class="el-g-2-author-avatar-vasutheme" src="<?php echo esc_url($author_avatar); ?>"
                alt="<?php echo esc_attr(get_the_author()); ?>"> <!-- Modified class name -->
            <a class="el-g-2-name-meta-vasutheme" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
                <?php the_author(); ?>
            </a>
            <span class="el-g-2-date-meta-vasutheme">
                <?php echo get_the_date(); ?>
            </span> <!-- Modified class name -->
        </div>

        <div class="el-g-2-post-content-vasutheme"> <!-- Modified class name -->
            <?php echo wp_trim_words(get_the_content(), $settings['content_length'], '...'); ?>
        </div>
       
    </div>
    <?php endwhile; ?>
</div>
<?php wp_reset_postdata(); // Reset post data
        else :
            echo '<div class="el-g-2-no-posts-found">' . __('No posts found', 'vasutheme') . '</div>';
        endif;
    }
    


    // Define widget settings fields
    protected function _register_controls()
    {
// Content Section
$this->start_controls_section(
    'section_content',
    [
        'label' => __('Content', 'vasutheme'),
    ]
);

$this->add_control(
    'dynamic_filtering',
    [
        'label' => __('Current Query', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'description' => __('Toggle to Archive Posts based on current query.', 'vasutheme'),
        'default' => 'no',
    ]
);

// Only show category selection if dynamic filtering is disabled
$this->add_control(
    'category',
    [
        'label' => __('Select Category', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'description' => __('Select the categories you want to display.', 'vasutheme'),
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
        'label'   => __('Posts Per Page', 'vasutheme'),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the number of posts to display per page.', 'vasutheme'),
        'default' => 8, // Default number of posts to display
    ]
);

$this->add_control(
    'offset',
    [
        'label'   => __('Post Offset', 'vasutheme'),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the number of posts to offset.', 'vasutheme'),
        'default' => 0, // Default offset value
    ]
);

$this->add_control(
    'title_length',
    [
        'label'   => __('Title Length', 'vasutheme'),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the maximum length of the title.', 'vasutheme'),
        'default' => 10, // Default number of words to display in title
    ]
);

$this->add_control(
    'content_length',
    [
        'label'   => __('Content Length', 'vasutheme'),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the maximum length of the content.', 'vasutheme'),
        'default' => 20, // Default number of words to display in content
    ]
);

$this->add_responsive_control(
    'items_per_row_desktop',
    [
        'label'     => __('Items Per Row ', 'vasutheme'),
        'type'      => \Elementor\Controls_Manager::NUMBER,
        'description' => __('Set the number of items to display per row on desktop.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-grid-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
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
            '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'order',
    [
        'label' => __('Order', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'ASC' => __('Ascending', 'vasutheme'),
            'DESC' => __('Descending', 'vasutheme'),
        ],
        'default' => 'DESC', // Default ordering
    ]
);

// $this->end_controls_section();

// // Style Section
// $this->start_controls_section(
//     'section_style',
//     [
//         'label' => __('Style', 'vasutheme'),
//     ]
// );

$this->add_responsive_control(
	'show_image',
	[
		'label' => __( 'Show Image', 'vasutheme' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'vasutheme' ),
		'label_off' => __( 'Off', 'vasutheme' ),
        'description' => __('Toggle to display or hide post image.', 'vasutheme'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-2-post-thumbnail-vasutheme' => 'display: {{VALUE}}',
		],
	]
);

$this->add_responsive_control(
	'show_post_meta',
	[
		'label' => __( 'Show Meta', 'vasutheme' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'vasutheme' ),
		'label_off' => __( 'Off', 'vasutheme' ),
        'description' => __('Toggle to display or hide post meta.', 'vasutheme'),
		'return_value'	=> 'none',
		'default'	=> 'flex',
		'selectors' => [
			'{{WRAPPER}} .el-g-2-post-meta-vasutheme' => 'display: {{VALUE}}',
		],
	]
);

$this->add_responsive_control(
	'show_category',
	[
		'label' => __( 'Show Category', 'vasutheme' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'vasutheme' ),
		'label_off' => __( 'Off', 'vasutheme' ),
        'description' => __('Toggle to display or hide post categories.', 'vasutheme'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-2-category-meta-vasutheme' => 'display: {{VALUE}}',
		],
	]
);


$this->add_responsive_control(
	'show_post_title',
	[
		'label' => __( 'Show Post Title', 'vasutheme' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'vasutheme' ),
		'label_off' => __( 'Off', 'vasutheme' ),
        'description' => __('Toggle to display or hide post title.', 'vasutheme'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-2-post-title-vasutheme' => 'display: {{VALUE}}',
		],
	]
);

$this->add_responsive_control(
	'show_post_content',
	[
		'label' => __( 'Show Post Content', 'vasutheme' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'vasutheme' ),
		'label_off' => __( 'Off', 'vasutheme' ),
        'description' => __('Toggle to display or hide post content.', 'vasutheme'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-2-post-content-vasutheme' => 'display: {{VALUE}}',
		],
	]
);


$this->add_responsive_control(
	'show_author_image',
	[
		'label' => __( 'Show Author Image', 'vasutheme' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'vasutheme' ),
		'label_off' => __( 'Off', 'vasutheme' ),
        'description' => __('Toggle to display or hide author image.', 'vasutheme'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-g-2-author-avatar-vasutheme' => 'display: {{VALUE}}',
		],
	]
);


$this->add_responsive_control(
	'show_date',
	[
		'label' => __( 'Show Post Date', 'vasutheme' ),
        'type'    => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'On', 'vasutheme' ),
		'label_off' => __( 'Off', 'vasutheme' ),
        'description' => __('Toggle to display or hide post date.', 'vasutheme'),
		'return_value'	=> 'none',
		'default'	=> 'block',
		'selectors' => [
			'{{WRAPPER}} .el-l-2-date-meta-vasutheme' => 'display: {{VALUE}}',
		],
	]
);

$this->end_controls_section();



// Post Style Subsection
$this->start_controls_section(
    'section_post_style',
    [
        'label' => __('Post Style', 'vasutheme'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'image_border_radius',
    [
        'label'     => __('Image Border Radius', 'vasutheme'),
        'type'      => \Elementor\Controls_Manager::DIMENSIONS,
        'description' => __('Set border radius for post images.', 'vasutheme'),
        'size_units' => ['px', '%'],
        'selectors' => [
            '{{WRAPPER}} .el-g-2-post-thumbnail-vasutheme img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'transform_hover',
    [
        'label' => __('Hover Transform', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'description' => __('Set the scale factor for post items on hover.', 'vasutheme'),
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
            '{{WRAPPER}} .el-g-2-post-thumbnail-vasutheme img:hover' => 'transform: scale({{SIZE}});',
        ],
    ]
);



$this->add_responsive_control(
    'image_height',
    [
        'label' => esc_html__( 'Image Height', 'vasutheme' ),
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
            '{{WRAPPER}} .el-g-2-post-thumbnail-vasutheme img' => 'height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();

// Title Style Section
$this->start_controls_section(
    'section_title_style',
    [
        'label' => __('Title', 'vasutheme'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'title_color',
    [
        'label'     => __('Title Color', 'vasutheme'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post titles.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-post-title-vasutheme a' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'title_hover_text_decoration',
    [
        'label' => __('Title Text Decoration (Hover)', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'description' => __('Set the text decoration for post titles on hover.', 'vasutheme'),
        'default' => 'none',
        'options' => [
            'none' => __('None', 'vasutheme'),
            'underline' => __('Underline', 'vasutheme'),
            'overline' => __('Overline', 'vasutheme'),
            'line-through' => __('Line Through', 'vasutheme'),
        ],
        'selectors' => [
            '{{WRAPPER}} .el-g-2-post-title-vasutheme:hover ' => 'text-decoration: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'title_hover_text_color',
    [
        'label' => __('Title Text Color (Hover)', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post titles on hover.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-post-title-vasutheme:hover' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'title_typography',
        'label'    => __('Title Typography', 'vasutheme'),
        'description' => __('Set the typography for post titles.', 'vasutheme'),
        'selector' => '{{WRAPPER}} .el-g-2-post-title-vasutheme a',
    ]
);

$this->end_controls_section();

// Category Style Section
$this->start_controls_section(
    'section_category_style',
    [
        'label' => __('Category', 'vasutheme'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'category_text_color',
    [
        'label'     => __('Category Text Color', 'vasutheme'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post category text.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-category-meta-vasutheme a' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'category_bg_color',
    [
        'label'     => __('Category Background Color', 'vasutheme'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the background color of post category.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-category-meta-vasutheme a' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'border_radius',
    [
        'label' => __('Border Radius', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'description' => __('Set the border radius of post category.', 'vasutheme'),
        'size_units' => ['px', '%'],
        'selectors' => [
            '{{WRAPPER}} .el-g-2-category-meta-vasutheme a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);


$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'category_typography',
        'label'    => __('Category Typography', 'vasutheme'),
        'description' => __('Set the typography for post category.', 'vasutheme'),
        'selector' => '{{WRAPPER}} .el-g-2-category-meta-vasutheme',
    ]
);
$this->add_control(
    'category_border_padding',
    [
        'label' => __('Category Padding', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'description' => __('Set the Category Padding of post category.', 'vasutheme'),
        'size_units' => ['px', '%'],
        'selectors' => [
            '{{WRAPPER}} .el-g-2-category-meta-vasutheme a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();

// Author Style Section
$this->start_controls_section(
    'section_author_style',
    [
        'label' => __('Author', 'vasutheme'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'author_color',
    [
        'label'     => __('Author Color', 'vasutheme'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post author.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-post-meta-vasutheme a' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'author_typography',
        'label'    => __('Author Typography', 'vasutheme'),
        'description' => __('Set the typography for post author.', 'vasutheme'),
        'selector' => '{{WRAPPER}} .el-g-2-post-meta-vasutheme a',
    ]
);

$this->end_controls_section();

// Date Style Section
$this->start_controls_section(
    'section_date_style',
    [
        'label' => __('Date', 'vasutheme'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'date_typography',
        'label'    => __('Date Typography', 'vasutheme'),
        'description' => __('Set the typography for post date.', 'vasutheme'),
        'selector' => '{{WRAPPER}} .el-g-2-date-meta-vasutheme',
    ]
);

$this->end_controls_section();

// Content Style Section
$this->start_controls_section(
    'section_content_style',
    [
        'label' => __('Content', 'vasutheme'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'content_color',
    [
        'label'     => __('Content Color', 'vasutheme'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of post content.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-post-content-vasutheme' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'content_typography',
        'label'    => __('Content Typography', 'vasutheme'),
        'description' => __('Set the typography for post content.', 'vasutheme'),
        'selector' => '{{WRAPPER}} .el-g-2-post-content-vasutheme',
    ]
);

$this->end_controls_section();

// Container Style Section
$this->start_controls_section(
    'section_container_style',
    [
        'label' => __('Container', 'vasutheme'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'border_color',
    [
        'label' => __('Border Color', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the color of the container border.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'border-color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'border_width',
    [
        'label' => __('Border Width', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'description' => __('Set the width of the container border.', 'vasutheme'),
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
            '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'border_style',
    [
        'label' => __('Border Style', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'description' => __('Set the style of the container border.', 'vasutheme'),
        'default' => 'none',
        'options' => [
            'solid' => __('Solid', 'vasutheme'),
            'dotted' => __('Dotted', 'vasutheme'),
            'dashed' => __('Dashed', 'vasutheme'),
            'double' => __('Double', 'vasutheme'),
            'groove' => __('Groove', 'vasutheme'),
            'ridge' => __('Ridge', 'vasutheme'),
            'inset' => __('Inset', 'vasutheme'),
            'outset' => __('Outset', 'vasutheme'),
            'none' => __('None', 'vasutheme'),
            'hidden' => __('Hidden', 'vasutheme'),
        ],
        'selectors' => [
            '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'border-style: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'background_border_radius',
    [
        'label' => __('Background Border Radius', 'vasutheme'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'description' => __('Set the border radius of the container background.', 'vasutheme'),
        'size_units' => ['px', '%'],
        'selectors' => [
            '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'background_color',
    [
        'label'     => __('Background Color', 'vasutheme'),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'description' => __('Set the background color of the container.', 'vasutheme'),
        'selectors' => [
            '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'box_shadow',
        'description' => __('Add box shadow to the container.', 'vasutheme'),
        'selector' => '{{WRAPPER}} .el-g-2-custom-post-item-vasutheme',
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