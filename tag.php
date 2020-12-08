<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package myprofile
 */
get_header();
?>
<?php get_template_part('template-parts/bread'); ?>
	
<section class="blog-style-one sec-pad blog-page mrmain_blog mrindex">
    <div class="container">
        <div class="row">
			<?php if(is_active_sidebar('sidebar-left')) : ?> 
			<div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
			<?php  else : ?>
			<div class="content-side col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
			<?php  endif ; ?> 
				   
				<div id="primary" class="content-area">
                    <main id="main" class="blog_list site-main ">
				
				<?php if ( have_posts() ) :
                  while( have_posts() ): the_post();?> 
				   <div id="post-<?php the_ID(); ?>" <?php post_class();?>>
                  <?php get_template_part( 'template-parts/content' ); ?>
                        <!-- blog post item -->
                  </div><!-- End Post --> 
				<?php endwhile;?>
					<div class="dope-pagination text-center">
						<?php the_posts_pagination(); ?>
                    </div>
			
			<?php else :
get_template_part( 'template-parts/content', 'none' ); endif;?>

                        </main><!-- #main -->
                    </div>
                </div>			
				<!-- sidebar area -->
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
	