<?php

get_header();

if ( have_posts() ) {
	
	while ( have_posts() ) {
	
		the_post();
		
		$images = bt_rwmb_meta( BoldThemesPFX . '_images', 'type=image' );
		if ( $images == null ) $images = array();
		$video = bt_rwmb_meta( BoldThemesPFX . '_video' );
		$audio = bt_rwmb_meta( BoldThemesPFX . '_audio' );
		
		$link_title = bt_rwmb_meta( BoldThemesPFX . '_link_title' );
		$link_url = bt_rwmb_meta( BoldThemesPFX . '_link_url' );
		$quote = bt_rwmb_meta( BoldThemesPFX . '_quote' );
		$quote_author = bt_rwmb_meta( BoldThemesPFX . '_quote_author' );
		
		$permalink = get_permalink();
		
		$post_format = get_post_format();
	
		$media_html = '';

		if ( has_post_thumbnail() ) {
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$img = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
			$thumb_img_slider = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
			$thumb_img_slider = $thumb_img_slider[0];
			if ( $img != '' ) {
				$media_html = bt_get_media_html( 'image', array( $permalink, $img[0] ) );
			}
		}
	
		if ( $post_format == 'image' ) {
		
			foreach ( $images as $img ) {
				$img = wp_get_attachment_image_src( $img['ID'], 'large' );
				$media_html = bt_get_media_html( 'image', array( $permalink, $img[0] ) );
				break;
			}
			
		} else if ( $post_format == 'gallery' ) {
		
			if ( count( $images ) > 0 ) {
				$images_ids = array();
				foreach ( $images as $img ) {
					$images_ids[] = $img['ID'];
				}			
				if ( intval( bt_rwmb_meta( BoldThemesPFX . '_grid_gallery' ) ) != 0 ) {
					$media_html = bt_get_media_html( 'grid_gallery', array( $images_ids , bt_get_option( 'blog_grid_gallery_columns' ), has_post_thumbnail(), bt_rwmb_meta( BoldThemesPFX . '_grid_gallery_format' ), 'yes', bt_get_option( 'blog_grid_gallery_gap' ) ) );
				} else {
					$media_html = bt_get_media_html( 'gallery', array( $images_ids ) );
				};
			}
			 
		} else if ( $post_format == 'video' ) {
			
			$media_html = bt_get_media_html( 'video', array( $video ) );
			
		} else if ( $post_format == 'audio' ) {
			
			$media_html = bt_get_media_html( 'audio', array( $audio ) );
			
		} else if ( $post_format == 'link' ) {
			
			$media_html = bt_get_media_html( 'link', array( $link_url, $link_title ) );
			
		} else if ( $post_format == 'quote' ) {
			
			$media_html = bt_get_media_html( 'quote', array( $quote, $quote_author, $permalink ) );
			
		}

		global $bt_date_format;

		
		$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
		$content_html = str_replace( ']]>', ']]&gt;', $content_html );
		
		$categories = get_the_category();
		$categories_html = '';
		if ( $categories ) {
			$categories_html = '<span class="btArticleCategories">';
			foreach ( $categories as $cat ) {
				$categories_html .= '<a href="' . esc_url_raw( get_category_link( $cat->term_id ) ) . '" class="btArticleCategory">' . esc_html( $cat->name ) . '</a>';
			}
			$categories_html .= '</span>';
		}
		
		$tags = get_the_tags();
		$tags_html = '';
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tags_html .= '<li><a href="' . esc_url_raw( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li>';
			}
			$tags_html = rtrim( $tags_html, ', ' );
			$tags_html = '<div class="btTags"><ul>' . wp_kses_post( $tags_html ) . '</ul></div>';
		}
		
		$prev_next_html = '';
		$prev = get_adjacent_post( false, '', true );
		$prev_next_html .= '<div class="col-sm-12 col-md-6 btTextLeft">';
		if ( '' != $prev ) {
			$prev_next_html .= '<h4 class="nbs nsPrev"><a href="' . esc_url_raw( get_permalink( $prev ) ) . '">';
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $prev->ID ), 'thumbnail' );
			$url = $thumb[0];	
			if ($url != '') $prev_next_html .= '<span class="nbsImage"><span class="nbsImgHolder" style="background-image:url(\'' . esc_url_raw( $url ) . '\');"></span></span>';
			$prev_next_html .= '<span class="nbsItem"><span class="nbsDir">' . esc_html__( 'previous', 'cargo' ) . '</span><span class="nbsTitle">' . esc_html( $prev->post_title ) . '</span></span>';
			$prev_next_html .= '</a></h4>';
		}
		$prev_next_html .= '</div>';

		$next = get_adjacent_post( false, '', false );
		
		$prev_next_html .= '<div class="col-sm-12 col-md-6 btTextRight">';
		if ( '' != $next ) {
			$prev_next_html .= '<h4 class="nbs nsNext"><a href="' . esc_url_raw( get_permalink( $next ) ) . '">';
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'thumbnail' );
			$url = $thumb[0];
			$prev_next_html .= '<span class="nbsItem"><span class="nbsDir">' . esc_html__( 'next', 'cargo' ) . '</span><span class="nbsTitle">' . esc_html( $next->post_title ) . '</span></span>';
			if ($url != '') $prev_next_html .= '<span class="nbsImage"><span class="nbsImgHolder" style="background-image:url(\'' . esc_url_raw( $url ) . '\');"></span></span>';
			$prev_next_html .= '</a></h4>';
			
		}
		$prev_next_html .= '</div>';

		if ( '' != $prev_next_html  ) {
			$prev_next_html = '<div class="neighboringArticles">' . wp_kses_post( $prev_next_html ) . '</div>';
		}		
		
		$about_author_html = '';
		if ( bt_get_option( 'blog_author_info' ) ) {
		
			$avatar_html = get_avatar( get_the_author_meta( 'ID' ), 280 );
			$avatar_html = str_replace ( 'width=\'280\'', 'width=\'140\'', $avatar_html );
			$avatar_html = str_replace ( 'height=\'280\'', 'height =\'140\'', $avatar_html );
			$avatar_html = str_replace ( 'width="280"', 'width="140"', $avatar_html );
			$avatar_html = str_replace ( 'height="280"', 'height ="140"', $avatar_html );
			
			$about_author_html = '<div class="btAboutAuthor">';
			
			$user_url = get_the_author_meta( 'user_url' );
			if ( $user_url != '' ) {
				$author_html = '<a href="' . esc_url_raw( $user_url ) . '" class="btArticleAuthor">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>';
			} else {
				$author_html = esc_html( get_the_author_meta( 'display_name' ) );
			}
			
			if ( $avatar_html ) {
				$about_author_html .= '<div class="aaAvatar">' . wp_kses_post( $avatar_html ) . '</div>';
			}
			
			$about_author_html .= '<div class="aaTxt"><h4>' . wp_kses_post( $author_html );
			$about_author_html .= '</h4>
					<p>' . get_the_author_meta( 'description' ) . '</p>
				</div>
			</div>';
		}		

		$share_html = function_exists( 'bt_get_share_html' ) ? bt_get_share_html( $permalink ) : '';
		
		$comments_open = comments_open();
		$comments_number = get_comments_number();
		$show_comments_number = true;
		if ( ! $comments_open && $comments_number == 0 ) {
			$show_comments_number = false;
		}
		
		$blog_author = bt_get_option( 'blog_author' );
		$blog_date = bt_get_option( 'blog_date' );
		
		$class_array = array( 'btArticle', 'gutter' );
		if ( $content_html != '' ) $class_array[] = 'divider';
		if ( $media_html == '' ) $class_array[] = 'noPhoto';

		if ( has_post_thumbnail() && bt_get_option( 'blog_ghost_slider' ) ) {
		 
				$slider_class = '';
		
				$meta_slider_html = '';
				
				$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$author_html = '<a href="' . esc_url_raw( $author_url ) . '" class="btArticleAuthor">' . esc_html__( 'by', 'cargo' ) . ' ' . esc_html( get_the_author() ) . '</a>';				
				
				if ( $blog_author || $blog_date || $show_comments_number ) {
				
					// $meta_slider_html .= '<p class="btSubTitle btArticleMeta">';
					
					if ( $blog_date ) $meta_slider_html .= '<span class="btArticleDate">' . esc_html( date_i18n( $bt_date_format, strtotime( get_the_time( 'Y-m-d' ) ) ) ) . '</span>'; 

					if ( $blog_author ) $meta_slider_html .= wp_kses_post( $author_html );

					if ( $show_comments_number ) $meta_slider_html .= '<a href="' . esc_url_raw( $permalink ) . '#comments" class="btArticleComments">' . wp_kses_post( $comments_number ) . '</a>';

					$meta_slider_html .= $categories_html;
					
					
					// $meta_slider_html .= '</p>';
				}
		
		?>
			<section class="btSection fullScreenHeight btMiddleVertical btGhost btDarkSkin wBackground cover<?php echo esc_attr( $slider_class ); ?>" style="background-image: url('<?php echo esc_attr( $thumb_img_slider ); ?>')">
				<div class="port">
					<div class="boldCell">
						<div class="boldRow btTableRow">
							<div class="rowItem col-ms-12 cellCenter btMiddleVertical btTextCenter">
								<div class="btCloseGhost"><?php echo bt_get_icon_html( 's7_e681', '#', '', 'borderless colorless medium' ); ?></div>
								<div class="rowItemContent">
									<?php echo bt_get_heading_html( '', get_the_title(), $meta_slider_html, 'extralarge', 'bottom', '', '' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php }
		
		echo '<article class="' . implode( ' ', get_post_class( $class_array ) ) . '">';
			
			$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
			$author_html = '<a href="' . esc_url_raw( $author_url ) . '" class="btArticleAuthor">' . esc_html__( 'by', 'cargo' ) . ' ' . esc_html( get_the_author() ) . '</a>';

			$meta_html = '';
			if ( $blog_author || $blog_date || $show_comments_number ) {
				$meta_html .= '';
				if ( $blog_date ) $meta_html .= '<span class="btArticleDate">' . esc_html( date_i18n( $bt_date_format, strtotime( get_the_time( 'Y-m-d' ) ) ) ) . ' </span>'; 
				if ( $blog_author ) $meta_html .= wp_kses_post( $author_html );
				if ( $show_comments_number ) $meta_html .= '<a href="' . esc_url_raw( $permalink ) . '#comments" class="btArticleComments">' . wp_kses_post( $comments_number ) . '</a>';
			}
			
			echo '<div class="port">';

				if ( $media_html != '' ) {
					echo '<div class="boldCell"><div class="boldRow bottomSmallSpaced">';
						echo '<div class="rowItem col-sm-12 btTextCenter btGridGap5">' . bt_get_media_html_render( $media_html ) . '</div><!-- /rowItem -->';
					echo '</div></div><!-- /boldRow / boldCell -->';
				}

				echo '<div class="boldCell"><div class="boldRow">';
					echo '<div class="rowItem btTextLeft col-sm-12 btArticleHeader">';

						echo bt_get_heading_html( '', get_the_title(), $meta_html . $categories_html, 'large', 'bottom', '', '' ) ;

					echo '</div><!-- /rowItem -->';
				echo '</div></div><!-- /boldRow / boldCell -->';
							
				echo '<div class="boldCell"><div class="boldRow">';
					echo '<div class="rowItem col-sm-12">';
			
				$extra_class = '';
				
				if ( $post_format == 'link' && $media_html == '' ) {
					$extra_class = 'linkOrQuote';
				}
				
						echo '<div class="btArticleBody portfolioBody ' . esc_attr( $extra_class ) . '">' . $content_html;
						echo '<div class="btClear btSeparator topSmallSpaced bottomSmallSpaced border"><hr></div>';
					echo '</div>';
				echo '</div><!-- /rowItem -->';
			echo '</div></div><!-- /boldRow / boldCell -->';

			echo '<div class="boldCell"><div class="boldRow bottomSmallSpaced">';
				echo '<div class="rowItem col-sm-6 tagsRowItem btTextLeft">';

					echo wp_kses_post( $tags_html );

				echo '</div><!-- /rowItem -->'; 
				echo '<div class="rowItem col-sm-6 cellRight shareRowItem btTextRight btGridShare">';

					echo '<div class="socialRow">' . wp_kses_post( $share_html ) . '</div>';
			
				echo '</div><!-- /rowItem -->';
			echo '</div></div><!-- /boldRow / boldCell -->';
			echo '<div class="boldCell"><div class="boldRow bottomSmallSpaced">';
				echo '<div class="rowItem col-sm-12">';
					
					wp_link_pages( array( 
						'before'      => '<p class="btLinkPages">' . esc_html__( 'Pages:', 'cargo' ),
						'separator'   => ' ',
						'after'       => '</p>'
					));
					
					echo wp_kses_post( $about_author_html );

				echo '</div><!-- /rowItem -->';
			echo '</div></div><!-- /boldRow / boldCell -->';				
		echo '</div><!-- /port -->';
	echo '</article>';

	echo '<section class="btSection gutter">';
		echo '<div class="port">';
			echo '<div class="boldCell"><div class="boldRow btCommentsRow">';
					echo '<div class="rowItem col-ms-12">';
						
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}		

					echo '</div><!-- /rowItem -->';
				echo '</div></div><!-- /boldRow / boldCell-->';
				echo '<div class="boldRow btNextPrevRow bottomSmallSpaced">';
					echo '<div class="boldCell"><div class="rowItem col-ms-12">' . wp_kses_post( $prev_next_html ) . '</div><!-- /rowItem -->';
				echo '</div></div><!-- /boldRow / boldCell-->';
		echo '</div><!-- /port -->';
	echo '</section>';
		
	}
	
}

	?>
	

<?php

get_footer();

?>