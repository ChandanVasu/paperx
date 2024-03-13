<?php
/**
 * Template Name: Custom Elementor Footer Template
 * Template Post Type: page
 */
class PostType{

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct(){

        add_action( 'init', [$this, 'register_post_type'], 0 );

        add_action('elementor/init', [ $this, 'add_elementor_support']);
    }

    public function register_post_type(){

        $labels = array(
            'name'                  => _x( 'Paper Template', 'Post Type General Name', 'vasutheme' ),
            'singular_name'         => _x( 'Paper Template', 'Post Type Singular Name', 'vasutheme' ),
            'menu_name'             => __( 'Paper Template', 'vasutheme' ),
            'name_admin_bar'        => __( 'Paper Template', 'vasutheme' ),
            'archives'              => __( 'List Archives', 'vasutheme' ),
            'parent_item_colon'     => __( 'Parent List:', 'vasutheme' ),
            'all_items'             => __( 'All Paper Template', 'vasutheme' ),
            'add_new_item'          => __( 'Add New Paper Template', 'vasutheme' ),
            'add_new'               => __( 'Add New', 'vasutheme' ),
            'new_item'              => __( 'New Paper Template', 'vasutheme' ),
            'edit_item'             => __( 'Edit Paper Template', 'vasutheme' ),
            'update_item'           => __( 'Update Paper Template', 'vasutheme' ),
            'view_item'             => __( 'View Paper Template', 'vasutheme' ),
            'search_items'          => __( 'Search Paper Template', 'vasutheme' ),
            'not_found'             => __( 'Not found', 'vasutheme' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'vasutheme' )
        );
        $args = array(
            'label'                 => __( 'Post List', 'vasutheme' ),
            'labels'                => $labels,
            'supports'              => array( 'title','editor' ),
            'public'                => true,
            'rewrite'               => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => false,
            'exclude_from_search'   => true,
            'capability_type'       => 'page',
            'hierarchical'          => false,
            'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="1.13em" height="1em" viewBox="0 0 576 512"><path fill="currentColor" d="M566.6 9.4c12.5 12.5 12.5 32.8 0 45.3l-192 192l34.7 34.7c4.2 4.2 6.6 10 6.6 16c0 12.5-10.1 22.6-22.6 22.6h-29L256 211.7v-29.1c0-12.5 10.1-22.6 22.6-22.6c6 0 11.8 2.4 16 6.6l34.7 34.7l192-192c12.5-12.5 32.8-12.5 45.3 0zm-344 225.5l118.5 118.5c3.7 42.7-11.7 85.2-42.3 115.8c-27.4 27.4-64.6 42.8-103.3 42.8H22.1C9.9 512 0 502.1 0 489.9c0-6.3 2.7-12.3 7.3-16.5l126.4-113.7c4.2-3.7-.4-10.4-5.4-7.9l-51.1 25.6c-6.1 3-13.2-1.4-13.2-8.2c0-31.5 12.5-61.7 34.8-84l8-8c30.6-30.6 73.1-45.9 115.8-42.3M464 352a80 80 0 1 1 0 160a80 80 0 1 1 0-160"/></svg>
            '),         // Corrected parameter name
        );
        
        register_post_type( 'vasu_theme', $args );

    }

    public function add_elementor_support(){

        add_post_type_support( 'vasu_theme', 'elementor' );
    }

    

}

PostType::instance();





class MetaBoxes{

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct(){

        add_action("add_meta_boxes", [$this, 'add_meta_boxes']);

        add_filter( 'manage_vasu_theme_posts_columns', [$this, 'add_column'] );
        add_action('manage_vasu_theme_posts_custom_column', [$this, 'column_data'], 10, 2);
    }

    public function add_meta_boxes(){
        add_meta_box('ae-shortcode-box','Anywhere Elementor Usage',[$this, 'ae_shortcode_box'],'vasu_theme','side','high');  
    }

    function ae_shortcode_box($post){
        ?>
        <h4 style="margin-bottom:5px;">Shortcode</h4>
        <input type='text' class='widefat' value='[Paper_Template id="<?php echo $post->ID; ?>"]' readonly="">
    
        <h4 style="margin-bottom:5px;">Php Code</h4>
        <input type='text' class='widefat' value="&lt;?php echo do_shortcode('[Paper_Template id=&quot;<?php echo $post->ID; ?>&quot;]'); ?&gt;" readonly="">
        <?php
    }

    function add_column($columns){
        $columns['paper_template_column'] = __( 'Paper Template', 'vasutheme' );
	    return $columns;
    }

    function column_data($column, $post_id){
        switch ( $column ) {

            case 'paper_template_column' :
                echo '<input type=\'text\' class=\'widefat\' value=\'[Paper_Template id="'.$post_id.'"]\' readonly="">';
                break;
        }
    }

}

MetaBoxes::instance();




use Elementor\Plugin;

class Shortcode{

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct(){

        add_shortcode('Paper_Template', [$this, 'render_shortcode']);

        add_filter( 'widget_text', 'do_shortcode' );
    }

    public function render_shortcode($atts){
        

        if(!class_exists('Elementor\Plugin')){
            return '';
        }
        if(!isset($atts['id']) || empty($atts['id'])){
            return '';
        }

        $post_id = $atts['id'];


        $response = Plugin::instance()->frontend->get_builder_content_for_display($post_id);
        return $response;
    }

}

Shortcode::instance();



