<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package myprofile
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):?>
	<link rel="shortcut icon" href="<?php echo esc_url($icon_href); ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo esc_url($icon_href); ?>" type="image/x-icon">
	
	<link rel="icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css" type="image/x-icon">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php endif; ?>
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
if ( function_exists( "wp_body_open" ) ) {
wp_body_open();
}
?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'myprofile' ); ?></a>
<div class="page-wrapper">

<?php get_template_part('template-parts/header'); ?> 

    <!-- Main Header-->
	<div class="about-us-banner">
<?php if ( !is_page("home") ) {
if ( ( !is_single() || ( is_page() ) || (is_category()) || (is_tag()) || (is_archive()) || (is_404()) ) && !is_page( 'my-account' ) ) :

if(kdmfi_get_featured_image_src( 'header-featured-image', 'full' )!=''){
$featured_img_url = kdmfi_get_featured_image_src( 'header-featured-image', 'full' );
}

if($featured_img_url !='')
{
$bg_img = $featured_img_url;
}
else{
$bg_img = get_template_directory_uri() . '/assets/images/banner-image.jpg';
}

echo '<section class="banner text-center d-flex align-items-center" style=background-image:url("'.$bg_img.'")>';
echo '<div class="banner_title float-left">

<div class="container"> ';

foreach((get_the_category()) as $category) {

$cate_name_post = $category->cat_name;
}

$tag = get_queried_object();
$tag_names = $tag->name;


echo '<div class="banner-icon d-inline-block">';
if(get_post_meta( $post->ID, '_header_title', true )!=''){

echo ' <h3 class=" banner_title-text d-inline-block">';
echo ' <div class="title-hedar-inner"> <span class="title-hedar">'.get_post_meta( $post->ID, '_header_title', true );
echo ' </span> </div>';
echo ' <span class="sub-title">'.get_post_meta( $post->ID, '_header_subtitle', true ).'</span>';
echo ' </h3>';
}
elseif( $title_post_names !='')
{

echo '<h3 class=" banner_title-text all_products_page_3-title-text d-inline-block">'.$title_post_names . '</h3>';


}
elseif( $tag_names !='')
{

echo '<h3 class=" banner_title-text all_products_page_3-title-text d-inline-block">'.$tag_names . '</h3>';


}
elseif( is_404())
{

echo '<h3 class=" title-hedar">404</h3>';
echo '<span class="sub-title" style="font-weight: 700;">Oops! That page can’t be found.</span>';
}
else{

the_title( '<h3 class=" banner_title-text all_products_page_3-title-text d-inline-block ">', '</h3>' );

}


echo '</div>';


echo '
</div>
</div>';
//echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );

echo '</section>';
endif;
}
?>
</div>
    