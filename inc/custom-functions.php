<?php

/**
 * Load all comments in the single post.
 */

if ( ! function_exists( 'myprofile_post_comment' ) ) :

	function myprofile_post_comment( $comment, $args, $depth ) {
		// $GLOBALS['comment'] = $comment;

		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>

            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-5">
                <a class="pull-left" href="#">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </a>

                <div class="media-body">
                    <div class="media-body-wrap card">

                        <div class="card-header">
                            <div class="div">
	                            <?php /* translators: %s: author name*/ ?>
                                <h4 class="mt-0"><?php printf( wp_kses( '%s <span class="says">says:</span>', 'myprofile' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link(),'myprofile' ) ); ?></h4>
                                <div class="comment-meta">
                                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                        <time datetime="<?php comment_time( 'c' ); ?>">
											<?php
											/* translators: 1%s: date, 2%s: time. */
                                            printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'myprofile' ), esc_html(get_comment_date()), esc_html(get_comment_time()) ); ?>
                                        </time>
                                    </a>
									<?php edit_comment_link( __( '<span style="margin-left: 5px;" class="lnr lnr-pencil"></span> Edit', 'myprofile' ), '<span class="edit-link">', '</span>' ); ?>
                                </div>
                            </div>
							<?php comment_reply_link(
								array_merge(
									$args, array(
										'add_below' => 'div-comment',
										'depth' 	=> $depth,
										'max_depth' => $args['max_depth'],
										'before' 	=> '<div class="reply comment-reply">',
										'after' 	=> '</div><!-- .reply -->'
									)
								)
							); ?>
                        </div>

						<?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'myprofile' ); ?></p>
						<?php endif; ?>

                        <div class="comment-content card-block">
							<?php comment_text(); ?>
                        </div><!-- .comment-content -->

                    </div>
                </div><!-- .media-body -->

            </article><!-- .comment-body -->


		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-5">
				<a class="pull-left" href="#">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</a>

				<div class="media-body">
					<div class="media-body-wrap card">

						<div class="card-header">
							<div class="div">
								<h4 class="mt-0"><?php printf( wp_kses( '%s <span class="says">says:</span>', 'myprofile' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h4>
								<div class="comment-meta">
									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<time datetime="<?php comment_time( 'c' ); ?>">
											<?php
											/* translators: 1%s: date, 2%s: time. */
                                            printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'myprofile' ), esc_html(get_comment_date()), esc_html(get_comment_time()) ); ?>
										</time>
									</a>
                                        <?php edit_comment_link( __( '<span style="margin-left: 5px;" class="lnr lnr-pencil"></span> Edit', 'myprofile' ), '<span class="edit-link">', '</span>' ); ?>
								</div>
							</div>
							<?php comment_reply_link(
								array_merge(
									$args, array(
										'add_below' => 'div-comment',
										'depth' 	=> $depth,
										'max_depth' => $args['max_depth'],
										'before' 	=> '<div class="reply comment-reply">',
										'after' 	=> '</div><!-- .reply -->'
									)
								)
							); ?>
						</div>

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'myprofile' ); ?></p>
						<?php endif; ?>

						<div class="comment-content card-block">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->

					</div>
				</div><!-- .media-body -->

			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif;



/**
 * Custom Excerpt Length
 */

function myprofile_excerpt_length( $length ) {
	return 58;
}
add_filter( 'excerpt_length', 'myprofile_excerpt_length', 999 );

if( !function_exists( 'myprofile_set' ) ) {
	function myprofile_set( $var, $key, $def = '' )
	{
		if( !$var ) return false;
	
		if( is_object( $var ) && isset( $var->$key ) ) return $var->$key;
		elseif( is_array( $var ) && isset( $var[$key] ) ) return $var[$key];
		elseif( $def ) return $def;
		else return false;
	}
}


function myprofile_get_the_breadcrumb()
{
	global $wp_query;
	$queried_object = get_queried_object();
	
	$breadcrumb = '';
	$delimiter = ' ';
	$before = '<li>';
	$after = '</li>';
	if ( ! is_home())
	{
		$breadcrumb .= '<li><a href="'.esc_url(home_url('/')).'">'.esc_html__('Home', 'myprofile').'</a></li>';
		
		/** If category or single post */
		if(is_category())
		{
			$cat_obj = $wp_query->get_queried_object();
			$this_category = get_category( $cat_obj->term_id );
	
			if ( $this_category->parent != 0 ) {
				$parent_category = get_category( $this_category->parent );
				$breadcrumb .= get_category_parents($parent_category, TRUE, $delimiter );
			}
			
			$breadcrumb .= '<li><a href="'.esc_url(get_category_link(get_query_var('cat'))).'">'.single_cat_title('', FALSE).'</a></li>';
		}
		elseif(is_tax())
		{
			$breadcrumb .= '<li><a href="'.esc_url(get_term_link($queried_object)).'">'.$queried_object->name.'</a></li>';
		}
		elseif(is_page()) /** If WP pages */
		{
			global $post;
			if($post->post_parent)
			{
                $anc = get_post_ancestors($post->ID);
                foreach($anc as $ancestor)
				{
                    $breadcrumb .= '<li><a href="'.esc_url(get_permalink($ancestor)).'">'.get_the_title($ancestor).'</a></li>';
                }
				$breadcrumb .= '<li>'.get_the_title($post->ID).'</li>';
				
            }else $breadcrumb .= '<li>'.get_the_title().'</li>';
		}
		elseif (is_singular())
		{
			if($category = wp_get_object_terms(get_the_ID(), 'category'))
			{
				if( !is_wp_error($category) )
				{
					$breadcrumb .= '<li><a href="'.esc_url(get_term_link(myprofile_set($category, '0'))).'">'.myprofile_set( myprofile_set($category, '0'), 'name').'</a></li>';
					$breadcrumb .= '<li>'.get_the_title().'</li>';
					
				} else $breadcrumb .= '<li>'.get_the_title().'</li>';
			}else{
				$breadcrumb .= '<li>'.get_the_title().'</li>';
			}
		}
		elseif(is_tag()) $breadcrumb .= '<li><a href="'.esc_url(get_term_link($queried_object)).'">'.single_tag_title('', FALSE).'</a></li>'; /**If tag template*/
		elseif(is_day()) $breadcrumb .= '<li><a href="#">'.esc_html__('Archive for ', 'myprofile').get_the_time('F jS, Y').'</a></li>'; /** If daily Archives */
		elseif(is_month()) $breadcrumb .= '<li><a href="' .esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) .'">'.esc_html__('Archive for ', 'myprofile').get_the_time('F, Y').'</a></li>'; /** If montly Archives */
		elseif(is_year()) $breadcrumb .= '<li><a href="'.esc_url(get_year_link(get_the_time('Y'))).'">'.esc_html__('Archive for ', 'myprofile').get_the_time('Y').'</a></li>'; /** If year Archives */
		elseif(is_author()) $breadcrumb .= '<li><a href="'. esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) .'">'.esc_html__('Archive for ', 'myprofile').get_the_author().'</a></li>'; /** If author Archives */
		elseif(is_search()) $breadcrumb .= '<li>'.esc_html__('Search Results for ', 'myprofile').get_search_query().'</li>'; /** if search template */
		elseif(is_404()) $breadcrumb .= '<li>'.esc_html__('404 - Not Found', 'myprofile').'</li>'; /** if search template */
		elseif ( is_post_type_archive('product') ) 
		{
			
			$shop_page_id = wc_get_page_id( 'shop' );
			if( get_option('page_on_front') !== $shop_page_id  )
			{
				$shop_page    = get_post( $shop_page_id );
				
				$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
		
				if ( ! $_name ) {
					$product_post_type = get_post_type_object( 'product' );
					$_name = $product_post_type->labels->singular_name;
				}
		
				if ( is_search() ) {
		
					$breadcrumb .= $before . '<a href="' . esc_url(get_post_type_archive_link('product')) . '">' . $_name . '</a>' . $delimiter . esc_html__( 'Search results for &ldquo;', 'myprofile' ) . get_search_query() . '&rdquo;' . $after;
		
				} elseif ( is_paged() ) {
		
					$breadcrumb .= $before . '<a href="' . esc_url(get_post_type_archive_link('product')) . '">' . $_name . '</a>' . $after;
		
				} else {
		
					$breadcrumb .= $before . $_name . $after;
		
				}
			}	
		}
		else $breadcrumb .= '<li><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></li>'; /** Default value */
	}
	return '<ul class="page-breadcrumb">'.$breadcrumb.'</ul>';
}