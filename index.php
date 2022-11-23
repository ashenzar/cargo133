<?php

get_header();

?>

<?php if ( have_posts() ) {
	
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
				$media_html = bt_get_media_html( 'gallery', array( $images_ids ) );
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

		$share_html = '<div class="btIconRow">' . ( function_exists( 'bt_get_share_html' ) ? bt_get_share_html( $permalink ) : '' ) . '</div>';
		if ( is_search() ) $share_html = '';
		
		$blog_author = bt_get_option( 'blog_author' );
		$blog_date = bt_get_option( 'blog_date' );		
		
		$blog_side_info = bt_get_option( 'blog_side_info' );
		
		$class_array = array( 'bottomSpaced', 'btArticle', 'articleListItem', 'animate', 'animate-fadein', 'animate-moveup', 'btTextLeft' );
		
		if ( $blog_side_info ) $class_array[] = 'btHasAuthorInfo';
		if ( $media_html != '' ) $class_array[] = 'wPhoto';
		
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$author_html = '<a href="' . esc_url_raw( $author_url ) . '" class="btArticleAuthor">' . esc_html__( 'by', 'cargo' ) . ' ' . esc_html( get_the_author() ) . '</a>';

		$comments_open = comments_open();
		$comments_number = get_comments_number();
		$show_comments_number = true;
		if ( ! $comments_open && $comments_number == 0 ) {
			$show_comments_number = false;
		}
		
		$meta_html = '';
		if ( $blog_author || $blog_date || $show_comments_number ) {
			$meta_html .= '';
			if ( $blog_date && ! $blog_side_info ) $meta_html .= '<span class="btArticleDate">' . esc_html( date_i18n( $bt_date_format, strtotime( get_the_time( 'Y-m-d' ) ) ) ) . ' </span>'; 
			if ( $blog_author && ! $blog_side_info ) $meta_html .= $author_html;
			if ( $show_comments_number ) $meta_html .= '<a href="' . esc_url_raw( $permalink ) . '#comments" class="btArticleComments">' . wp_kses_post( $comments_number ) . '</a>';
		}

		$post_type = get_post_type();
		
		$content_final_html = get_post()->post_excerpt != '' ? '<p>' . esc_html( get_the_excerpt() ) . '</p>' : $content_html;

		echo '<article class="' . implode( ' ', get_post_class( $class_array ) ) . '">';
			echo '<div class="port">';
				if ( $blog_side_info ) {
					echo '<div class="articleSideGutter btTextLeft">';
					$avatar_html = get_avatar( get_the_author_meta( 'ID' ), 144 ); 
					if ( $blog_date ) {
						echo '<div class="asgItem date"><small>' . esc_html( date_i18n( $bt_date_format, strtotime( get_the_time( 'Y-m-d' ) ) ) ) . '</small></div>';
					}						
					if ( $avatar_html != '' ) {
						echo '<div class="asgItem avatar"><a href="' . esc_url_raw( $author_url ) . '">' . wp_kses_post( $avatar_html ) . '</a></div>';
					}
					if ( $blog_author ) {
						echo '<div class="asgItem title"><span>' . wp_kses_post( $author_html ) . '</span></div>';
					}
					
					echo '</div>';
				}

				if($media_html != "") {
					echo '<div class="boldCell"><div class = "boldRow bottomSmallSpaced">';
						echo '<div class="rowItem col-sm-12 btTextCenter">' . bt_get_media_html_render( $media_html ) . '</div>';
					echo '</div></div>';
				}


				echo '<div class="boldCell"><div class = "boldRow">';
					echo '<div class="rowItem col-sm-12">' . bt_get_heading_html( '', '<a href="' . esc_url_raw( $permalink ) . '">' . esc_html( get_the_title() )  . '</a>', $meta_html . $categories_html, 'large', 'bottom', '', '' ) . '</div>';
				echo '</div></div>';
				
				if ( $content_final_html != '' && $post_type == 'post' ) {
					$extra_class = '';
					if ( $post_format == 'link' && $media_html == '' ) {
						$extra_class = 'linkOrQuote';
					}
				echo '<div class="boldCell"><div class="boldRow btArticleBody topSmallSpaced">
						<div class="rowItem col-sm-12">' . wp_kses_post( $content_final_html ) . '<div class="btClear btSeparator topSmallSpaced bottomSmallSpaced border"><hr></div></div>';
				echo '</div></div>';
				}
			
			echo '<div class="boldCell"><footer class="boldRow">
					<div class="rowItem col-md-6 col-sm-12 btTextLeft btReadMore">' . bt_get_icon_html( 'fa_f129', $permalink, esc_html__( 'CONTINUE READING', 'cargo' ), 'colorless extrasmall' ) . '</div> 
					<div class="rowItem col-md-6 col-sm-12 btTextRight btGridShare">' . wp_kses_post( $share_html ) . '</div> 
				</footer></div>			
			</div><!-- port -->
		</article>';

	}
	
	bt_pagination();
	
} else {
	if ( is_search() ) { ?>
		<article class="btNoSearchResults">
			<?php echo bt_get_heading_html( esc_html__( 'We are sorry, no results for: ', 'cargo' ) . get_search_query(), '', "<a href='" . site_url() . "'>" . esc_html__( 'Back to homepage', 'cargo' )."</a>", 'extralarge', 'bottom', '', '' ) ?>
		</article>
	<?php }
}
 
?>

<?php

get_footer();

?>