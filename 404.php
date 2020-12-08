<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package myprofile
 */
 
get_header();
?>
<?php get_template_part('template-parts/bread'); ?>


<section class="error-section eror_df">
        <div class="container">
				<h1><span class="left-icon now-in-view"></span><?php esc_html_e( '404', 'myprofile' ); ?><span class="right-icon now-in-view"></span></h1>
				
                <h2><?php esc_html_e( 'Oops! That page can not be found', 'myprofile' ); ?></h2>
				
                <div class="text"><?php esc_html_e( 'Sorry, but the page you are looking for does not existing', 'myprofile' ); ?></div>
				
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="theme-btn btn-style-three"> <?php esc_html_e( 'Go to Home', 'myprofile' ); ?></a>
        </div>
</section>
  
<?php
get_footer();