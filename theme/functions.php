<?php
/**
 * thequeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thequeen
 */

if ( ! defined( 'THEQUEEN_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'THEQUEEN_VERSION', '0.1.0' );
}

if ( ! defined( 'THEQUEEN_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `thequeen_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'THEQUEEN_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'thequeen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thequeen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thequeen, use a find and replace
		 * to change 'thequeen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'thequeen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'Primary-menu' => __( 'Primary-menu', 'thequeen' ),
				'Footer-menu' => __( 'Footer Menu', 'thequeen' ),
				'not-logged' => __('not-logged', 'thequeen' ),
				'logged' => __('logged', 'thequeen' ),
				'Top-left' => __( 'Top-left', 'thequeen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'thequeen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thequeen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'thequeen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'thequeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'thequeen_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thequeen_scripts() {
	wp_enqueue_style( 'thequeen-style', get_stylesheet_uri(), array(), THEQUEEN_VERSION );

	// 커스텀 스타일시트 추가
	wp_enqueue_style('custom-style', get_template_directory_uri() .  '/main.css');
	wp_enqueue_script( 'thequeen-script', get_template_directory_uri() . '/js/script.min.js', array(), THEQUEEN_VERSION, true );
	
	// 커스텀 스크립트 추가
	wp_enqueue_script( 'thequeen-custom-scripts', get_template_directory_uri() . '/js/tqk_scripts.js', array(), THEQUEEN_VERSION, true );
	wp_enqueue_script( 'thequeen-custom-gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js', array(), THEQUEEN_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thequeen_scripts' );




/**
 * 커스텀 폰트
 */
function enqueue_custom_fonts(){
	if(!is_admin()){
		wp_register_style('Abril Fatface', 'https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap');
		wp_enqueue_style('Abril Fatface');
		
		wp_register_style('Overpass', 'https://fonts.googleapis.com/css2?family=Overpass:wght@100;200;300;400;500;600;700;800;900&display=swap');
		wp_enqueue_style('Overpass');
		
		wp_register_style('Pretendard', 'https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.6/dist/web/static/pretendard-dynamic-subset.css');
		wp_enqueue_style('Pretendard');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_custom_fonts');


/**
 * Enqueue the block editor script.
 */
function thequeen_enqueue_block_editor_script() {
	wp_enqueue_script(
		'thequeen-editor',
		get_template_directory_uri() . '/js/block-editor.min.js',
		array(
			'wp-blocks',
			'wp-edit-post',
		),
		THEQUEEN_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'thequeen_enqueue_block_editor_script' );

/**
 * Create a JavaScript array containing the Tailwind Typography classes from
 * THEQUEEN_TYPOGRAPHY_CLASSES for use when adding Tailwind Typography support
 * to the block editor.
 */
function thequeen_admin_scripts() {
	?>
	<script>
		tailwindTypographyClasses = '<?php echo esc_attr( THEQUEEN_TYPOGRAPHY_CLASSES ); ?>'.split(' ');
	</script>
	<?php
}
add_action( 'admin_print_scripts', 'thequeen_admin_scripts' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function thequeen_tinymce_add_class( $settings ) {
	$settings['body_class'] = THEQUEEN_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'thequeen_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * 'course' 포스트 타입에 대한 쿼리를 반환하는 액션 훅
 */
function my_custom_get_course_query($query)
{
	if (!is_admin() && $query->is_main_query() && is_front_page()) {
		$query->set('post_type', array('course'));
	}
}
add_action('pre_get_posts', 'my_custom_get_course_query');

/**
 * 우커머스 지원 선언
 */
function mytheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

/**
 * sensei 지원 선언
 */
function declare_sensei_support() {
	add_theme_support( 'sensei' );
}
add_action( 'after_setup_theme', 'declare_sensei_support' );


/**
 * 강의상품 중복 장바구니 담아도 수량 1개 유지
 */
function limit_product_quantity_in_cart($passed, $product_id)
{
	$limited_categories = array('category-slug-1', 'category-slug-2'); // 제한하고 싶은 카테고리의 슬러그를 여기에 입력하세요.
	
	if (has_term($limited_categories, 'product_cat', $product_id)) {
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$cart_product_id = $cart_item['product_id'];
			
			// If the product is already in the cart, block addition and ensure quantity is 1
			if ($cart_product_id === $product_id) {
				WC()->cart->set_quantity($cart_item_key, 1);
				wc_add_notice(__('The product is already in the cart, quantity has been reset to 1.', 'domain'), 'notice');
				return false;
			}
		}
	}
	
	return $passed;
}
add_filter('woocommerce_add_to_cart_validation', 'limit_product_quantity_in_cart', 10, 2);

/**
 * 수강계속하기 버튼 함수
 */
function get_first_active_lesson($course_id, $user_id)
{
	$lessons_completed = Sensei()->course->course_lessons_completed($course_id, $user_id);
	$course_lessons = Sensei()->course->course_lessons($course_id);

	$first_active_lesson = false;
	foreach ($course_lessons as $lesson) {
		if (!in_array($lesson->ID, $lessons_completed)) {
			$first_active_lesson = $lesson->ID;
			break;
		}
	}

	return $first_active_lesson;
}
