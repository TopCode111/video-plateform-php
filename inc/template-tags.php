<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package myprofile
 */

if ( ! function_exists( 'myprofile_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function myprofile_posted_on() {
		echo '<a href="#"><i class="lnr lnr-calendar-full "></i>' . wp_kses_post(get_the_date()) . '</a>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'myprofile_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function myprofile_posted_by() {?>				
			<a class="author_meta" href=" <?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><i class="lnr lnr-users "></i><?php echo esc_html( get_the_author() )?></a>        
	<?php }
endif;

if ( ! function_exists( 'myprofile_comments_number' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function myprofile_comments_number() {?>				
			<a class="comment_meta" href=" <?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><i class="lnr lnr-bubble "></i><?php echo esc_html( comments_number() )?></a>        
	<?php }
endif;



if ( ! function_exists( 'myprofile_meta_info' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function myprofile_meta_info() {
		// Hide category and tag text for pages.
	
			if (is_single()) {
								
				echo wp_kses_post('<div class="meta-info">');
				myprofile_posted_by();
				myprofile_posted_on();
				myprofile_comments_number();
				echo wp_kses_post('</div>');
			
			}else{
				
				echo wp_kses_post('<div class="meta-info">');
				myprofile_posted_by();
				myprofile_posted_on();
				myprofile_comments_number();
				echo wp_kses_post( '</div>');
				
			}
	}
endif;

if ( ! function_exists( 'myprofile_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function myprofile_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			
			<div class="image">
				<?php the_post_thumbnail('myprofile-landscape'); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
<div class="image">
		<a class="overlay-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'myprofile-landscape', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>
</div>
		<?php
		endif; // End is_singular().
	}
endif;
