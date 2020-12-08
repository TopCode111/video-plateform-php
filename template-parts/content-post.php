<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package myprofile
 */

?>
 <div class="single-blog-post">
  <div class="blog_post">
	<div class="img-box">
		<?php myprofile_post_thumbnail(); ?>

		<?php myprofile_meta_info(); ?>		
	</div><!-- /.img-box -->
	<div class="single_text_block">
		<div class="text">
			<div class="text-box ">
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'myprofile'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
		</div>
	<!-- /.text-box -->
	</div>
	</div>
	</div>	

<div class="tags clearfix">
	<?php the_tags('<i class="icon-hastag"></i> Tags: ', '<span class="commax">,</span>  ', ''); ?>
</div>	
</div>	
<!-- Comment -->
<?php comments_template(); ?> 	