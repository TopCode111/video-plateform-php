<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package myprofile
 */

?>
<footer class="footer">
	<div class="container">
	<?php if ( is_active_sidebar( 'footer-sidebar' ) ): ?>
	<div class="widgets-section">
		<div class="row">
		   <?php dynamic_sidebar( 'footer-sidebar' );?>   
		</div>
	</div>
	<?php endif; ?>
	</div>
</footer>
	
	<div class="footer-bottom">
		<p>
		<?php
			if(get_theme_mod('copyright_txt')){
				echo esc_html(get_theme_mod('copyright_txt'));
			}else{
			  esc_html_e('Copyright &copy;','myprofile');
			  echo date_i18n(__(" 2019 - Y",'myprofile'));
			  
			}
		?>
		
		</p>        
    </div>
<!--Body Wrapper Do not Delete-->
</div>
</div>
<!--Body Wrapper-->

<div class="scroll-top">
    <span class="lnr lnr-chevron-up"></span>
</div>

<?php wp_footer(); ?>
</body>
</html>
