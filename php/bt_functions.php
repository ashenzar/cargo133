<?php
/**
 * Post media HTML
 *
 * @param string
 * @param array
 * @return string
 */
if ( ! function_exists( 'bt_get_media_html' ) ) {
	function bt_get_media_html( $type, $data ) {
		
		$html = '';
		
		if ( $type == 'image' ) {
		
			$data_attr = '';
			if ( isset( $data[2] ) ) {
				$data_attr = 'data-hw="' . esc_attr( $data[2] ) . '"';
			}
			$html = '<div class="btMediaBox" ' . esc_attr( $data_attr ) . '><div class="bpbItem">';
			$html .= '<a href="' . esc_url_raw( $data[0] ) . '"><img src="' . esc_url_raw( $data[1] ) . '" alt="' . esc_attr( basename( $data[1] ) ) . '"></a>';
			$html .= '</div></div>';
			
		} else if ( $type == 'gallery' ) {
			
			$data_attr = '';
			if ( isset( $data[1] ) ) {
				$data_attr = 'data-hw="' . esc_attr( $data[1] ) . '"';
			}
			$html = '<div class="btMediaBox" ' . esc_attr( $data_attr ) . '>' . do_shortcode( '[gallery ids="' . join( ',', $data[0] ) . '"]' ) . '</div>';
			
		} else if ( $type == 'grid_gallery' ) {
			
			$html = '<div class="btMediaBox">' . do_shortcode( '[bt_grid_gallery ids="' . join( ',', $data[0] ) . '" columns="' . esc_attr( $data[1] ) . '" has_thumb="' . esc_attr( $data[2] ) . '" format="' . esc_attr( $data[3] ) . '" lightbox="' . esc_attr( $data[4] ) . '" grid_gap="' . esc_attr( $data[5] ) . '"]' ) . '</div>';
			
		} else if ( $type == 'video' ) {
		
			$hw = 9 / 16;
			
			$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '"><img class="aspectVideo" src="' . esc_url_raw( get_template_directory_uri() . '/gfx/video-16.9.png' ) . '" alt="' . esc_url_raw( get_template_directory_uri() . '/gfx/video-16.9.png' ) . '" role="presentation" aria-hidden="true">';

			if ( strpos( $data[0], 'vimeo.com/' ) > 0 ) {
				$video_id = substr( $data[0], strpos( $data[0], 'vimeo.com/' ) + 10 );
				$html .= '<ifra' . 'me src="' . esc_url_raw( 'http://player.vimeo.com/video/' . $video_id ) . '" allowfullscreen></ifra' . 'me>';
			} else {
				$yt_id_pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
				$youtube_id = ( preg_replace( $yt_id_pattern, '$1', $data[0] ) );
				if ( strlen( $youtube_id ) == 11 ) {
					$html .= '<ifra' . 'me width="560" height="315" src="' . esc_url_raw( 'https://www.youtube.com/embed/' . $youtube_id ) . '" allowfullscreen></ifra' . 'me>';
				} else {
					$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '">';				
					$html .= do_shortcode( $data[0] );
				}
			}
			
			$html .= '</div>';
			
			if ( $data[0] == '' ) {
				$html = '';
			}
			
		} else if ( $type == 'audio' ) {		
			if ( strpos( $data[0], '</ifra' . 'me>' ) > 0 ) {
				$html = '<div class="btMediaBox audio">' . wp_kses( $data[0], array( 'iframe' => array( 'height' => array(), 'src' =>array() ) ) ) . '</div>';
			} else {
				$html = '<div class="btMediaBox audio">' . do_shortcode( $data[0] ) . '</div>';
			}
			
			if ( $data[0] == '' ) {
				$html = '';
			}
		
		} else if ( $type == 'link' ) {
			$html = '<div class="btMediaBox btDarkSkin btLink"><div class="bpbItem">' . bt_get_icon_html( 's7_e641', esc_url( $data[0] ), '', 'medium colorless borderless' ) . '<a href="' . esc_url_raw( $data[0] ) . '"><strong>' . wp_kses_post( $data[1] ) . '</strong><span class="bUrl">' . esc_url_raw( $data[0] ) . '</span></a></div></div>';
			
			if ( $data[1] == '' || $data[0] == '' ) {
				$html = '';
			}
			
		} else if ( $type == 'quote' ) {
			$html = '<div class="btMediaBox btQuote btDarkSkin"><blockquote>' . bt_get_icon_html( 's7_e6b9', esc_url_raw( $data[2] ), '', 'medium colorless borderless' ) . '<p>' . wp_kses_post( $data[0] ) . '</p><cite>' . wp_kses_post( $data[1] ) . '</cite></blockquote></div>';
			
			if ( $data[0] == '' || $data[1] == '' ) {
				$html = '';
			}
		
		}
		
		return $html;
	}
}

/**
 * Returns heading HTML
 *
 * @param string $superheadline
 * @param string $headline
 * @param string $subheadline
 * @param string $headline_size // small/medium/large/extralarge
 * @param string $dash // no/top/bottom
 * @param string $el_class
 * @param string $el_style
 * @return string
 */
if ( ! function_exists( 'bt_get_heading_html' ) ) {
	function bt_get_heading_html( $superheadline, $headline, $subheadline, $headline_size, $dash, $el_class, $el_style ) {

		if ( $superheadline != '' ) {
			$superheadline = '<p class="btSuperTitle">' . wp_kses_post( $superheadline ) . '</p>';
		}

		if ( $subheadline != '' ) {
			$subheadline = '<p class="btSubTitle">' . wp_kses_post( $subheadline ) . '</p>';
		}
		
		$h_tag = 'h1';
		$class = '';

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $headline_size != 'no' ) {
			$class .= $headline_size;
		}
		if ( $headline_size == 'extralarge' || $headline_size == 'huge' ) {
			$h_tag = 'h1';
		} else if ( $headline_size == 'large' ) {
			$h_tag = 'h2';
		} else if ( $headline_size == 'medium' ) {
			$h_tag = 'h3';
		} else {
			$h_tag = 'h4';
		}

		if ( $dash == 'yes' ) {
			$dash = 'top';
		}
		
		if( $dash != 'no' && $dash != '' ) {
			$class .= ' btDash ' . $dash . 'Dash';
		}

		if ( $el_class != '' ) {
			$class .= ' ' . $el_class;
		}
	
		$output = '<header class="header btClear ' . esc_attr( $class ) . '" ' . wp_kses_post( $style_attr ) . '>';
                    $output .= wp_kses_post( $superheadline );
                    if ( $headline != '' ) $output .= '<div class="dash"><' . esc_html( $h_tag ) . '><span class="headline">' . wp_kses_post( $headline ) . '</span></' . esc_html( $h_tag ) . '></div>';
                    $output .= wp_kses_post( $subheadline );
                $output .= '</header>';	

		return $output;
		
	}
}

/**
 * Returns icon HTML
 *
 * @param string $icon
 * @param string $url
 * @param string $text
 * @param string $el_class 
 * @return string
 */
 if ( ! function_exists( 'bt_get_icon_html' ) ) {
	function bt_get_icon_html( $icon, $url, $text, $el_class, $target = '') {
		
		$icon_set = substr( $icon, 0, 2 );
		$icon = substr( $icon, 3 );
		
		if( substr( $url, 0, 3 ) == 'www') $url = "http://" . $url;

		$link = "";
		
		if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https'  && substr( $url, 0, 6 ) != 'mailto' ) {
			$link_tmp = get_posts(
				array(
					'name'      => $url,
					'post_type' => 'page'
				)
			);
		if ( ( is_array( $link_tmp ) && count( $link_tmp ) > 0 && isset( $link_tmp[0]->ID ) ) ) {
				if ( substr( $url, 0, 4 ) == 'http' ) {
					$link = $url;
				} else {
					$link = get_permalink( $link_tmp[0]->ID );
				}

			} else {
				$link = $url;
			}
		} else {
			$link = $url;
		}

		if ( $text != '' ) $text = '<span>' . wp_kses_post( $text ) . '</span>';
		
		if ( $target != '' ) $target = ' target="' . ( $target ) . '" ';

		$ico_tag = 'a ';
		if ( $link == '' ) {
			$ico_tag = 'span ';
			$ico_tag_end = 'span';	
		} else {
                   
			$ico_tag = 'a href="' . esc_url_raw( $link ) . '" ' . ( $target );
			$ico_tag_end = 'a';
		}

		return '<div class="btIco ' . esc_attr( $el_class ) . '"><' . wp_kses_post( $ico_tag ) . ' data-ico-' . esc_attr( $icon_set ) . '="&#x' . esc_attr( $icon ) . ';" class="btIcoHolder">' . wp_kses_post( $text ) . '</' . wp_kses_post( $ico_tag_end ) . '></div>';
	}
}


/**
 * Returns button HTML
 *
 * @param string $icon
 * @param string $url
 * @param string $text
 * @param string $el_class 
 * @param string $el_style 
 * @param string $target 
 * @return string
 */
if ( ! function_exists( 'bt_get_button_html' ) ) {
	function bt_get_button_html( $icon, $url, $text, $el_class, $el_style = '', $target = '' ) {
		
		if ( substr( $url, 0, 3 ) == 'www' ) {
			$url = 'http://' . esc_url_raw( $url );
		}
		
		$link = '';
		
		if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https' && substr( $url, 0, 6 ) != 'mailto' ) {
			$link_tmp = get_posts(
				array(
					'name'      => $url,
					'post_type' => 'page'
				)
			);
			if ( ( is_array( $link_tmp ) && count( $link_tmp ) > 0 && isset( $link_tmp[0]->ID ) ) ) {
				if ( substr( $url, 0, 4 ) == 'http' ) {
					$link = $url;
				} else {
					$link = get_permalink( $link_tmp[0]->ID );
				}

			} else {
				$link = $url;
			}
		} else {
			$link = $url;
		}
		
		$style_attr = '';
		if ( $el_style != '' ) { 
			$style_attr = 'style="' . esc_attr( $el_style ) . '" ';
		}

		if ( is_array( $el_class ) ) $el_class = implode( ' ', $el_class );

		$output = '<div class="btBtn ' . esc_attr( $el_class ) . '"' . ' ' . wp_kses_post( $style_attr ) . '>';
			if ( $icon == '' ) {
				if ( $link != '' ) {
					if ( $target != '' ) {
						$target = ' target="' . esc_attr( $target ) . '" ';
					} else {
						$target= '';
					}
					$output .= '<a href="' . esc_attr( $link ) . '"' . wp_kses_post( $target ) . '>' . wp_kses_post( $text ) . '</a>';
				} else {
					$output .= $text;
				}
			} else {
				$output .= bt_get_icon_html( $icon, $url, $text, 'borderless extrasmall', $target );
			}
		$output .= '</div>';
		
		return $output;
	}
}

/**
 * Top bar HTML output
 */
 if ( ! function_exists( 'bt_top_bar_html' ) ) {
	function bt_top_bar_html( $type = "top" ) { 
		if ( is_active_sidebar( 'header_left_widgets' ) || is_active_sidebar( 'header_right_widgets' ) ) {
			if ( $type == "top" ) { ?>
				<div class="topBar btClear">
					<div class="topBarPort btClear">
						<div class="topTools ttLeft col-ms-6 btTextLeft">
							<?php dynamic_sidebar( 'header_left_widgets' ); ?>
						</div><!-- /ttLeft -->
						<div class="topTools ttRight col-ms-6 btTextRight">
							<?php dynamic_sidebar( 'header_right_widgets' ); ?>
						</div><!-- /ttRight -->
					</div><!-- /topBarPort -->
				</div><!-- /topBar -->
			<?php }	 else { ?>
				<div class="topBarInMenu">
					<div class="topBarInMenuCell">
						<?php dynamic_sidebar( 'header_left_widgets' ); ?>
						<?php dynamic_sidebar( 'header_right_widgets' ); ?>
					</div><!-- /topBarInMenu -->
				</div><!-- /topBarInMenuCell -->
			<?php }		
		}

	}
}

/**
 * Preloader HTML output
 */
 if ( ! function_exists( 'bt_preloader_html' ) ) {
	function bt_preloader_html() {
		if ( ! bt_get_option( 'disable_preloader' ) ) { ?>
			<div id="btPreloader" class="btPreloader fullScreenHeight">
				<div class="animation">
					<div><?php bt_logo( 'preloader' ); ?></div>
					<div class="btLoader"></div>
					<p><?php echo bt_get_option( 'preloader_text' ); ?></p>
				</div>
			</div><!-- /.preloader -->
		<?php }
	}
}

/**
 * Returns image with link HTML
 *
 * @param string $image
 * @param string $caption_text
 * @param string $size
 * @param string $url 
 * @param string $el_style 
 * @param string $el_class 
 * @return string
 */

 if ( ! function_exists( 'bt_get_image_html' ) ) {
	function bt_get_image_html( $image, $caption, $caption_text, $size, $shape, $url, $show_titles, $el_style, $el_class ) {

		$el_style = sanitize_text_field( $el_style );
		$el_class = sanitize_text_field( $el_class );
		
		if ( $size == '' ) $size = 'large';
		if ( $shape == 'circle' ) $el_class .= ' btCircleImage';
			
		$style_html = '';
		if ( $el_style != '' ) {
			$style_html= ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}	
		
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image ));
		if ( $attachment ) {
			$image_alt = get_post_meta( $attachment[0], '_wp_attachment_image_alt', true);
		} else {
			$image_alt = basename( $image );
		}
        		
		$output = '<div class = "btImage"><img src="' . esc_url_raw( $image ) . '" alt="' . esc_attr( $image_alt ) . '"></div>';
		
		if ( strpos( $url, '<a href') === 0 ) {
			$link = $url;
		} else {
			$link = '<a href="' . esc_url_raw( $url ) . '" target="_self"></a>';
		}
		
		if ( $url != '' ) {
			$link_output = '<div class="bpgPhoto ' . esc_attr( $el_class ) . '" ' . wp_kses_post( $style_html ) . '> 
					' . wp_kses_post( $link ) . '
					<div class="boldPhotoBox"><div class="bpbItem">' . wp_kses_post( $output ) . '</div></div>
					<div class="captionPane">
						<div class="captionTable">
							<div class="captionCell">
								<div class="captionTxt">'
									. bt_get_heading_html( '', $caption, $caption_text, 'small', 'bottom', '', '' ) . 
								'</div>
							</div>
						</div>
					</div>';
					if ( $show_titles ) {
						$link_output .= '
						<div class="btShowTitle">
							<span class="btShowTitleCaptionTxt">'
									. bt_get_heading_html( '', $caption, $caption_text, 'small', 'bottom', '', '' ) . 
								'</span>
						</div>';
					}
			$link_output .= '</div>';
			
			$output = $link_output;
		} else {
			$output = '<div class="bpgPhoto ' . esc_attr( $el_class ) . '" ' . wp_kses_post( $style_html ) . '>' . wp_kses_post( $output ) . '</div>';
		}
 		
		return $output;
	}
}


/**
 * Returns search form HTML
 *
 * @return string
 */

if ( ! function_exists( 'bt_get_search_form_html' ) ) {
    function bt_get_search_form_html() {
            $form = bt_get_icon_html( 'fa_f002', '#', '', 'default extrasmall', '' );
            $form .= '
            <div class="btSearch">
                <div class="btSearchInner" role="search">
                        <div class="btSearchInnerContent">
                                <form action="' . home_url( '/' ) . '" method="get"><input type="text" name="s" placeholder="' . esc_attr( esc_html__( 'Looking for...', 'cargo' ) ) . '" class="untouched">
                                <button type="submit" data-icon="&#xf105;"></button>
                                </form>
                                <div class="btSearchInnerClose">' . bt_get_icon_html( 'fa_f00d', '#', '', 'borderless small', '' ) . '</div>
                        </div>
                </div>
            </div>';
            return $form;
    }
}