<?php

get_header();

global $date_format;

if ( have_posts() ) {

	the_post();

	$images = bt_rwmb_meta( BoldThemesPFX . '_images', 'type=image' );
	if ( $images == null ) $images = array();
	$video = bt_rwmb_meta( BoldThemesPFX . '_video' );
	$audio = bt_rwmb_meta( BoldThemesPFX . '_audio' );
	$data_items_split = 2;

	$categories = wp_get_post_terms( get_the_ID(), 'portfolio_category' );
	$categories_html = '';
	if ( $categories ) {
		foreach ( $categories as $cat ) {
			$categories_html .= $cat->name . ', '; 
		}
		
	} else {
		$data_items_split ++;
	}
	
	$permalink = get_permalink();

	$first_img = '';

	$subheading = bt_rwmb_meta( BoldThemesPFX . '_subheading' );
	
	$cf = array_values( bt_rwmb_meta( BoldThemesPFX . '_custom_fields' ) );
	$cf_right_html = '';
	if ( $cf != '' ) {
		for ( $i = 0; $i < $data_items_split; $i++ ) {
			if ( $i < count( $cf ) ) {
				$item = $cf[ $i ];
				$item_key = substr( $item, 0, strpos( $item, ':' ) );
				$item_value = substr( $item, strpos( $item, ':' ) + 1 );
                               
				$cf_right_html .= '<dt>' . wp_kses_post( $item_key ) . '</dt>';
				$cf_right_html .= '<dd>' . wp_kses_post( $item_value ) . '</dd>';
			}
		}
	}
	
	$categories_html = trim( $categories_html, ', ' );	

	$meta_right_html = '';
	
	if ( $categories_html != '' ) {
		$meta_right_html .= '<dt>' . esc_html__( 'Category', 'cargo' ) . '</dt>';
		$meta_right_html .= '<dd>' . esc_html( $categories_html ) . '</dd>';
	}
	
	$meta_right_html = $meta_right_html . $cf_right_html;
	
	$slider_images = array();
			
	if ( has_post_thumbnail() ) {

		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$first_img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		$first_img = $first_img[0];
		
		$first_thumb = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );
		$first_thumb = $first_thumb[0];
		
		$first_post = get_post( $post_thumbnail_id );
		$first_text = $first_post->post_excerpt;
		$first_description = $first_post->post_content;
		
		if ( count( $images ) > 0 ) {
			$n = 0;
			foreach ( $images as $img ) {
				$src = wp_get_attachment_image_src( $img['ID'], 'full' );
				$src = $src[0];
				
				$thumb = wp_get_attachment_image_src( $img['ID'], 'medium' );
				$thumb = $thumb[0];
				
				$img_post = get_post( $img['ID'] );
				$text = $img_post->post_excerpt;
				
				$slider_images[ $n ]['src'] = $src;
				$slider_images[ $n ]['thumb'] = $thumb;
				$slider_images[ $n ]['text'] = $text;
				$slider_images[ $n ]['description'] = $img_post->post_content;
				
				$n++;
			}
		}
		
	} else if ( count( $images ) > 0 ) {
		$n = 0;
		foreach ( $images as $img ) {
		
			if ( $n == 0 ) {
			
				$first_img = wp_get_attachment_image_src( $img['ID'], 'full' );
				$first_img = $first_img[0];
				
				$first_thumb = wp_get_attachment_image_src( $img['ID'], 'medium' );
				$first_thumb = $first_thumb[0];
					
				$first_post = get_post( $img['ID'] );
				$first_text = $first_post->post_excerpt;
				$first_description = $first_post->post_content;

			} else {
		
				$src = wp_get_attachment_image_src( $img['ID'], 'full' );
				$src = $src[0];
				
				$thumb = wp_get_attachment_image_src( $img['ID'], 'medium' );
				$thumb = $thumb[0];

				$this_post = get_post( $img['ID'] );

				$text = $this_post->post_excerpt;

				$slider_images[ $n ]['src'] = $src;
				$slider_images[ $n ]['thumb'] = $thumb;
				$slider_images[ $n ]['text'] = $text;
				$slider_images[ $n ]['description'] = $this_post->post_content;
			
			}
			
			$n++;
		}
	
	}

	if ( $first_img != '' ) {
		if ( bt_get_option( 'pf_ghost_slider' ) ) {
			$gr_class = '';
		} else {
			$gr_class = ' btRemoveGhost';
		}
		$st = 'background-image:url(' . esc_url_raw( $first_img ) . ');';
	
	?>
		<section class="boldSection fullScreenHeight btMiddleVertical btGhost btDarkSkin<?php echo esc_attr( $gr_class ); ?>">
			<div class="port">
				<div class="boldCell">
					<div class="boldRow ">
						<div class="rowItem col-sm-12 col-md-12 btTextLeft inherit">
							<div class="rowItemContent">
								<div class="btCloseGhost"><?php echo bt_get_icon_html( 's7_e681', '#', '', 'borderless colorless medium' ); ?></div>
								<div class="slidedVariable largeSliderHeight"<?php if ( count( $slider_images ) == 0 ) echo ' ' . 'data-nocenter="yes"'; ?>>
								
								<?php if ( bt_get_option( 'pf_ghost_slider' ) ) { ?>
									<div class="slidedItem firstItem <?php if ( count( $slider_images ) == 0 ) echo 'onlyItem'; ?>" data-thumb="<?php echo esc_attr( $first_thumb ); ?>" data-text="<?php echo esc_attr( $first_text ); ?>" data-description="<?php echo esc_attr( $first_description ); ?>">
										<div class="port wBackground cover" style="<?php echo esc_attr( $st ); ?>">
											<div class="boldCell" data-slick="yes">
												<div class="btSlideGutter">
													<div class="btSlidePane">
														<div class="col-sm-9">
															<?php echo bt_get_heading_html( '', get_the_title(), $subheading, 'extralarge', 'bottom', '', '' ); ?>
														</div><!-- /boldBlogArticle -->
														<dl class="articleMeta col-sm-3 btTextRight">
															<?php echo wp_kses_post( $meta_right_html ); ?>
														</dl>
													</div>
												</div><!-- /.boldCell-->
											</div><!-- /.boldCell-->
										</div><!-- /.fullScreen -->
									</div><!-- /.slidedItem -->
								<?php }
								
								foreach( $slider_images as $slider_image ) {
									echo '<div class="slidedItem" data-thumb="' . esc_attr( $slider_image['thumb'] ) . '" data-text="' . esc_attr( $slider_image['text'] ) . '" data-description="' . esc_attr( $slider_image['description'] ) . '">';
										echo '<div class="variableImg"><img src="' . esc_attr( $slider_image['src'] ) . '" alt="' . esc_attr( $slider_image['src'] ) . '"></div>';
									echo '</div><!-- /.slidedItem -->';
								} ?>
								</div><!-- /slided -->
								<div class="btGetInfo"><?php echo bt_get_icon_html( 'fa_f129', '#', '', 'default colorless extrasmall' ); ?></div>
								<div class="btInfoBar">
									<div class="btInfoBarMeta">
										<p><strong><?php esc_html_e( 'Project:', 'cargo' ); ?></strong> <?php echo get_the_title(); ?></p>
										<p><strong><?php esc_html_e( 'Title:', 'cargo' ); ?></strong> <span class="btPortfolioSliderCaption"></span></p>
										<p><strong><?php esc_html_e( 'Description:', 'cargo' ); ?></strong> <span class="btPortfolioSliderDescription"></span></p>
									</div><!-- /boldInfoBarMeta -->
								</div><!-- /boldInfoBar -->
							</div><!-- /rowItemContent -->
						</div><!-- /rowItem -->
					</div><!-- /boldRow -->
				</div><!-- /boldCell -->
			</div><!-- /port -->
		</section>
		
	<?php } ?>

	<?php
	
	$permalink = get_permalink();

	$media_html = '';
	
	$has_thumb = 'no';
	
	if ( has_post_thumbnail() ) {
	
		$has_thumb = 'yes';
		
	}
	
	if ( count( $images ) == 1 ) {
	
		foreach ( $images as $img ) {
			$img = wp_get_attachment_image_src( $img['ID'], 'large' );
			$media_html = bt_get_media_html( 'image', array( $permalink, $img[0] ) );
			break;
		}
		
	} else if ( count( $images ) > 1 ) {
	
		$images_ids = array();
		foreach ( $images as $img ) {
			$images_ids[] = $img['ID'];
		}
		if ( intval( bt_rwmb_meta( BoldThemesPFX . '_grid_gallery' ) ) != 0 ) {
			$media_html = bt_get_media_html( 'grid_gallery', array( $images_ids, bt_get_option( 'pf_grid_gallery_columns' ), $has_thumb, bt_rwmb_meta( BoldThemesPFX . '_grid_gallery_format' ), 'no', bt_get_option( 'pf_grid_gallery_gap' ) ) );
		} else {
			$media_html = bt_get_media_html( 'gallery', array( $images_ids ) );
		}
		
	} else if ( $video != '' ) {
		
		$media_html = bt_get_media_html( 'video', array( $video ) );
		
	} else if ( $audio != '' ) {
		
		$media_html = bt_get_media_html( 'audio', array( $audio ) );
		
	}

	$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
	$content_html = str_replace( ']]>', ']]&gt;', $content_html );
	
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
	
	$class_array = array( 'boldArticle', 'portfolioItem', 'gutter' );
	if ( $content_html != '' ) $class_array[] = 'divider';

	$extra_class = 'col-sm-12';
	if ( ( $cf != '' && count( $cf ) > $data_items_split ) || $categories_html != '' ) {
		$extra_class = ' col-sm-9';
	}
	
	echo '<article class="' . esc_attr( implode( ' ', get_post_class( $class_array ) ) ) . '">';
		echo '<div class="port">';
			if ( $media_html != '' ) {
				echo '<div class="boldCell"><div class="boldRow bottomSmallSpaced">';
					echo '<div class="rowItem col-sm-12 btTextCenter">' . bt_get_media_html_render( $media_html ) . '</div><!-- /rowItem -->';
				echo '</div></div><!-- /boldRow / boldCell -->';
			}
			echo '<div class="boldCell"><div class="boldRow btArticleHeader">';
				echo '<div class="rowItem col-sm-12">';
					
					echo bt_get_heading_html( '', get_the_title(), $subheading, 'large', 'bottom', 'wArticleMeta', '' ) ;
					
				echo '</div><!-- /rowItem -->';
			echo '</div></div><!-- /boldRow / boldCell-->';
			echo '<div class="boldCell"><div class="boldRow">';
				echo '<div class="rowItem ' . esc_attr( $extra_class ) . '">';
					
					echo '<div class="boldArticleBody portfolioBody">' . wp_kses_post( $content_html ) . '</div>';

				echo '</div><!-- /rowItem -->';

					if ( ( $cf != '' && count( $cf ) > $data_items_split ) || $categories_html != '' ) {
						echo '<div class="rowItem col-sm-3 btTextRight">';
							echo '<dl class="btArticleMeta onBottom">';
							if ( $categories_html != '' ) {
								echo '<dt>' . esc_html__( 'Category', 'cargo' ) . '</dt>';
								echo '<dd>' . esc_html( $categories_html ) . '</dd>';
							}
							echo wp_kses_post( $cf_right_html );
							for ( $i = $data_items_split; $i < count( $cf ); $i++ ) {
								$item = $cf[ $i ];
								$item_key = substr( $item, 0, strpos( $item, ':' ) );
								$item_value = substr( $item, strpos( $item, ':' ) + 1 );
								echo '<dt>' . wp_kses_post( $item_key ) . '</dt>';
								echo '<dd>' . wp_kses_post( $item_value ) . '</dd>';
							}
							echo '</dl>';
						echo '</div><!-- /rowItem -->';
					}

			echo '</div></div><!-- /boldRow / boldCell -->';
			echo '<div class="boldCell"><div class="boldRow bottomSmallSpaced">';
				echo '<div class="rowItem col-sm-12 btTextRight btGridShare">';
					echo '<div class="btClear btSeparator topSmallSpaced bottomSmallSpaced border"><hr></div>';
					echo '<div class="socialRow">' . ( function_exists( 'bt_get_share_html' ) ? bt_get_share_html( $permalink, 'pf' ) : '' ) . '</div>';
				echo '</div><!-- /rowItem -->';
			echo '</div></div><!-- /boldRow / boldCell -->';
			echo '<div class="boldCell"><div class="boldRow">';
				echo '<div class="rowItem col-sm-12">';
					
				wp_link_pages( array( 
					'before'      => '<p class="btLinkPages">' . esc_html__( 'Pages:', 'cargo' ),
					'separator'   => ' ',
					'after'       => '</p>'
				));
				
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				
				echo '</div><!-- /rowItem -->';
			echo '</div></div><!-- /boldRow / boldCell -->';
			echo '<div class="boldRow btNextPrevRow bottomSmallSpaced">';
				echo '<div class="boldCell"><div class="rowItem col-ms-12">' . wp_kses_post( $prev_next_html ) . '</div><!-- /rowItem -->';
			echo '</div></div><!-- /boldRow / boldCell-->';
		echo '</div><!-- /port -->';
	echo '</article>';
	

}

?>

<?php

get_footer();

?>