<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package myprofile
 */

?>

<!--Change the Following area If needed -->
<section class="search_area_df">
<div class="container">		 
		<div class="row clearfix">
			
			<div class="col-md-5 col-sm-12 col-xs-12">
				<div class="searcg_img">
				  <img src="<?php echo esc_url(get_template_directory_uri().'/images/search.jpg');?>" alt="<?php esc_attr_e('Image', 'myprofile');?>">
				</div>
			</div>
			
			<div class="col-md-7 col-sm-12 col-xs-12">
				<div class="search_tx_box">
					<h4 class="sr_title">
						
						<?php esc_html_e( 'Oops! Search not Found', 'myprofile' ); ?>
					</h4>
					<div class="search_text">	
						<p><?php esc_html_e( '1. Check the Spelling ', 'myprofile' ); ?>
                       </p>
                       <p><?php esc_html_e( '2. Check the Caps Lock', 'myprofile' ); ?>
						</p>      
						<p><?php esc_html_e( '3. Press Enter correctly or Press F5', 'myprofile' ); ?>
						</p> 
					</div>
					
					<div class="search_page_btn">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="theme-btn btn-style-three"><?php esc_html_e( 'Go Home', 'myprofile' ); ?><span class="icon flaticon-next-4"></span></a>
					</div>
				

					
				</div>
			</div>
	</div>
</div>
</section>

