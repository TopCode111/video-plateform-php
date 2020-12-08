<?php

	if ( ! function_exists( 'myprofile_setup' ) ) :
		function myprofile_setup() {

	        // Make theme available for translation.
			load_theme_textdomain( 'myprofile', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );


			// Let WordPress manage the document title.
			add_theme_support( 'title-tag' );


			// Enable support for Post Thumbnails on posts and pages.
			add_theme_support( 'post-thumbnails' );

			// Enable Wide angle image in gutenberg

			add_theme_support( 'align-wide' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'main_menu' => esc_html__( 'Main Menu', 'myprofile' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				array(
					'comment-form',
					'comment-list',
					'caption',
				)
			);

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'myprofile_custom_background_args', array(
				'default-color' => 'f4f7f6',
			) ) );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Custom Thumbnail Image Size
			add_image_size("myprofile-landscape",730,400,true);

			//Add support for core custom logo.
			add_theme_support( 'custom-logo', array(
				'height'      => 94,
				'width'       => 200,
				'flex-width'  => true,
				'flex-height' => true,
			) );
		}
	endif;
	add_action( 'after_setup_theme', 'myprofile_setup' );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', myprofile_fonts_url() ) );
	
	function theme_enqueue_styles() {
        wp_enqueue_script( 'ajax-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array('jquery'), '', true );
      }
      add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 */
	function myprofile_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'myprofile_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'myprofile_content_width', 0 );

	/**
	 * Enqueue scripts and styles.
	 */

	require get_template_directory() .'/inc/theme_styles_scripts.php';

	/**
	 * myprofile Widgets.
	 */
	require get_template_directory() .'/inc/theme_widgets.php';

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Functions which enhance the theme by hooking into WordPress.
	 */
	require get_template_directory() . '/inc/template-functions.php';

	/**
	 * Custom Functions for the Theme.
	 */
	require get_template_directory() . '/inc/custom-functions.php';

	/**
	 * Nav Walker bootstrap walker
	 */

	require get_template_directory() .'/inc/bootstrap_walker.php';
	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer/customizer.php';

	/**
	 * Implement the Custom Header feature.
	 */
	require get_template_directory() . '/inc/customizer/custom-header.php';

	/**
	 * Load Jetpack compatibility file.
	 */
	if ( defined( 'JETPACK__VERSION' ) ) {
		require get_template_directory() . '/inc/compatibility/jetpack.php';
	}

function myprofile_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

 function custom_video_type() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'videos', 'Post Type General Name', 'myprofile' ),
        'singular_name'       => _x( 'video', 'Post Type Singular Name', 'myprofile' ),
        'menu_name'           => __( 'videos', 'myprofile' ),
        'parent_item_colon'   => __( 'Parent video', 'myprofile' ),
        'all_items'           => __( 'All videos', 'myprofile' ),
        'view_item'           => __( 'View video', 'myprofile' ),
        'add_new_item'        => __( 'Add New videos', 'myprofile' ),
        'add_new'             => __( 'Add videos', 'myprofile' ),
        'edit_item'           => __( 'Edit videos', 'myprofile' ),
        'update_item'         => __( 'Update videos', 'myprofile' ),
        'search_items'        => __( 'Search videos', 'myprofile' ),
        'not_found'           => __( 'Not Found', 'myprofile' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'myprofile' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'videos', 'myprofile' ),
        'description'         => __( 'video Templates and Snippets', 'myprofile' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( '' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'videos', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_video_type', 0 );
 
//========================= Categories for powerbiexpert Custom Type ===========================//
//create a custom taxonomy name it topics for your posts
 
function video_categories_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $powerbiexpert_cats = array(
    'name' => _x( 'video Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'video Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search video Categories' ),
    'all_items' => __( 'All video Categories' ),
    'parent_item' => __( 'Parent video Category' ),
    'parent_item_colon' => __( 'Parent video Category:' ),
    'edit_item' => __( 'Edit video Category' ), 
    'update_item' => __( 'Update video Category' ),
    'add_new_item' => __( 'Add New video Category' ),
    'new_item_name' => __( 'New video Category' ),
    'menu_name' => __( 'video Categories' ),
  );    
 
// Now register the taxonomy. Replace the parameter powerbiexperts withing the array by the name of your custom post type.
  register_taxonomy('video_categories',array('videos'), array(
    'hierarchical' => true,
    'labels' => $powerbiexpert_cats,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'video categories' ),
  ));
 
}
add_action( 'init', 'video_categories_taxonomy', 0 );

//**************************Q&A Categories******************************

  function custom_qa_type() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Q&A Categorys', 'Post Type General Name', 'myprofile' ),
        'singular_name'       => _x( 'Q&A Category', 'Post Type Singular Name', 'myprofile' ),
        'menu_name'           => __( 'Q&A Categorys', 'myprofile' ),
        'parent_item_colon'   => __( 'Parent Q&A Category', 'myprofile' ),
        'all_items'           => __( 'All Q&A Categorys', 'myprofile' ),
        'view_item'           => __( 'View Q&A Category', 'myprofile' ),
        'add_new_item'        => __( 'Add New Q&A Categorys', 'myprofile' ),
        'add_new'             => __( 'Add Q&A Categorys', 'myprofile' ),
        'edit_item'           => __( 'Edit Q&A Categorys', 'myprofile' ),
        'update_item'         => __( 'Update Q&A Categorys', 'myprofile' ),
        'search_items'        => __( 'Search Q&A Categorys', 'myprofile' ),
        'not_found'           => __( 'Not Found', 'myprofile' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'myprofile' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Q&A Categorys', 'myprofile' ),
        'description'         => __( 'Q&A Category Templates and Snippets', 'myprofile' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( '' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'qacategorys', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_qa_type', 0 );
 
//========================= Categories for powerbiexpert Custom Type ===========================//
//create a custom taxonomy name it topics for your posts
 
function qacategorys_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $qa_cats = array(
    'name' => _x( 'Q&A Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Q&A Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Q&A Categories' ),
    'all_items' => __( 'All Q&A Categories' ),
    'parent_item' => __( 'Parent Q&A Category' ),
    'parent_item_colon' => __( 'Parent Q&A Category:' ),
    'edit_item' => __( 'Edit Q&A Category' ), 
    'update_item' => __( 'Update Q&A Category' ),
    'add_new_item' => __( 'Add New Q&A Category' ),
    'new_item_name' => __( 'New Q&A Category' ),
    'menu_name' => __( 'Q&A Categories' ),
  );    
 
// Now register the taxonomy. Replace the parameter powerbiexperts withing the array by the name of your custom post type.
  register_taxonomy('qa_categories',array('qacategorys'), array(
    'hierarchical' => true,
    'labels' => $qa_cats,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'qa categories' ),
  ));
 
}
add_action( 'init', 'qacategorys_taxonomy', 0 );




add_filter( 'kdmfi_featured_images', function( $featured_images ) {
$args = array(
'id' => 'header-featured-image',
'desc' => 'Select Header Banner Image here.',
'label_name' => 'Header Featured Image',
'label_set' => 'Set header featured image',
'label_remove' => 'Remove header featured image',
'label_use' => 'Set header featured image',
'post_type' => array( 'page' ),
);

$featured_images[] = $args;

return $featured_images;
});


/*
* Meta boc Manage Header Banner Start
*/
function header_register_meta_boxe() {
add_meta_box( 'header_title', __( 'Header Banner Setting', 'textdomain' ), 'subtitle_box_callback', array('page') );
}
add_action( 'add_meta_boxes', 'header_register_meta_boxe' );
//Add field
function subtitle_box_callback( $post ) {

wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

$outline.= '<label for="header_title" style="width:150px; display:inline-block;">'. esc_html__('Header Title', 'text-domain') .'</label>';
$header_title= get_post_meta( $post->ID, '_header_title', true );
$outline .= '<input type="text" name="header_title" id="header_title" class="header_title" value="'. esc_attr($header_title) .'" style="width:100%;"/>';
$outline.= '<label for="header_subtitle" style="width:150px; display:inline-block;">'. esc_html__('Header SubTitle', 'text-domain') .'</label>';
$header_subtitle = get_post_meta( $post->ID, '_header_subtitle', true );
$outline .= '<input type="text" name="header_subtitle" id="header_subtitle" class="header_subtitle" value="'. esc_attr($header_subtitle) .'" style="width:100%;"/>';

echo $outline;
}

function save( $post_id ) {
// Check if our nonce is set.
if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) ) {
return $post_id;
}

$nonce = $_POST['myplugin_inner_custom_box_nonce'];

// Verify that the nonce is valid.
if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) ) {
return $post_id;
}
/*
* If this is an autosave, our form has not been submitted,
* so we don't want to do anything.
*/
if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
return $post_id;
}
// Check the user's permissions.
if ( 'page' == $_POST['post_type'] ) {
if ( ! current_user_can( 'edit_page', $post_id ) ) {
return $post_id;
}
} else {
if ( ! current_user_can( 'edit_post', $post_id ) ) {
return $post_id;
}
}

// Sanitize the user input.
$header_subtitle = sanitize_text_field( $_POST['header_subtitle'] );
$header_title = sanitize_text_field( $_POST['header_title'] );


// Update the meta field.
update_post_meta( $post_id, '_header_subtitle', $header_subtitle );
update_post_meta( $post_id, '_header_title', $header_title );

}
add_action( 'save_post','save');
/*
 * Set post views count using post meta
 */
function setPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}


	if ( ! function_exists( 'parseVideoUrl' ) ) {
		function parseVideoUrl($url, $thumb = '') {
			//$vUrl = trim(explode('=', explode(' ', rtrim(ltrim($url,'['),']'))[3])[1],'"');
			//echo $vUrl;
			if(strpos($url, 'iframe') === false){
				return '0';
			}
			
			return $url;
		}
	}

add_action('get_header', 'readpost');
function readpost() {
    global $browsing_histories;
    $browsing_histories = null;
    $set_this_ID = null;
    $postread = null;
    if (is_singular('videos')){
        if (isset($_COOKIE['postid_history'])){
            // cookieの値を呼び出し
            $browsing_histories = explode(",", $_COOKIE['postid_history']);
            if ($browsing_histories[0] != get_the_ID()) {
                if (count($browsing_histories) >= 3 ) {
                    $set_browsing_histories = array_slice($browsing_histories , 0, 2);
                } else {
                    $set_browsing_histories = $browsing_histories;
                }
                // 値の先頭が現在の記事IDでなければ文字列の一番最初に追加
                $set_this_ID = get_the_ID().','.implode(",", $set_browsing_histories);
                setcookie( 'postid_history', $set_this_ID, time() + 60 * 60 * 24 * 365 * 1,'/');
            }
        } else {
            // cookieがなければ、現在の記事IDを保存
            $set_this_ID = get_the_ID();
            setcookie('postid_history', $set_this_ID, time() + 60 * 60 * 24 * 365 * 1,'/');            
        }
        //詳細ページ以外なら呼び出しのみ
    } else {
        if (isset($_COOKIE['postid_history'])) {
            $browsing_histories = explode(",", $_COOKIE['postid_history']);
            $postread = explode(",", $_COOKIE['postid_history']);
            $postread = array_unique($postread);
            $postread = array_values($postread);
        }else{
            $postread = null;
        }
    }
    return $postread;
}