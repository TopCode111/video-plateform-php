<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package myprofile
 */

?>
<section class="page-title">
    <div class="container">
        <h3><?php wp_title(''); ?></h3>        
    </div><!-- /.thm-container -->
</section><!-- /.page-title -->
<div class="breadcumb-wrapper">
    <div class="container">
      <?php echo wp_kses_post(myprofile_get_the_breadcrumb()); ?>
    </div><!-- /.thm-container -->
</div><!-- /.breadcumb-wrapper -->    