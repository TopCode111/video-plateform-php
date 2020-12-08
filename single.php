<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package myprofile
 */

get_header();
?>
<?php get_template_part('template-parts/bread'); ?>

<section class=" blog-style-one sec-pad blog-page mrsingle">
    <div class="container">
        <div class="row d-flex justify-content-center">
		
			<?php if(is_active_sidebar('sidebar-left')) : ?> 
			<div class="wp-style content-side col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
			<?php  else : ?>
			<div class="wp-style content-side col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
			<?php  endif ; ?>  
				<div class="wp-style blog-single-post content-side">
                	<!--Blog Detail-->
                <div class="single_post">
				<?php while( have_posts() ): the_post();
								?>
				<?php get_template_part('template-parts/content' , 'post');?>
				
				<!-- Author -->				
				  <?php endwhile;?>
                </div>
            </div>
           </div>

		<?php if(is_active_sidebar('sidebar-left')) { ?>
			<div class="col-lg-4 col-md-4 col-sm-12">
                <div class="sidebar">
				<?php dynamic_sidebar('sidebar-left'); ?>
				</div>
			</div>
			<?php } ?>
            <!--Sidebar-->
            </div>
        </div>
    </section>
<?php
get_footer();
