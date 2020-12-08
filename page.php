<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package myprofile
 */

get_header();
?>
<?php get_template_part('template-parts/bread'); ?> 
	
	<div class="main-content-section main_page">
        <div class="container">
            <div class="row d-flex justify-content-center">
            
			
			<?php if(is_active_sidebar('sidebar-left')) : ?> 
			<div class="wp-style content-side col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
			<?php  else : ?>
			<div class="wp-style content-side col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
			<?php  endif ; ?> 
				 <div class="single_post">
						<?php while( have_posts() ): the_post();?>
                            <!-- blog post item -->
					<div class="inner-box">
						<div class="lower-content">
						<div class="text-box text">
                            <?php the_content(); ?>
                           <!-- end comments -->
                            <div class="clearfix"></div>
                            <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'myprofile'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
                         </div>	
						</div> 
					</div>
					<div class="bottom-content">	
						<div class="clearfix"></div>
							<?php comments_template(); ?> 	
                            <!--Posts Nav-->
					</div>		
                        <?php endwhile;?>
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
    </div>
<?php
get_footer();