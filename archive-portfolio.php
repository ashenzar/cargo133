<?php

get_header();

?>

<?php bt_breadcrumbs(); ?>

<?php if ( have_posts() ) {
	
	while ( have_posts() ) {
	
		the_post();
		
		$images = bt_rwmb_meta( BoldThemesPFX . '_images', 'type=image' );
		if ( $images == null ) $images = array();
		$video = bt_rwmb_meta( BoldThemesPFX . '_video' );
		$audio = bt_rwmb_meta( BoldThemesPFX . '_audio' );
		
		$permalink = get_permalink();
	
		$media_html = '';
		
		if ( has_post_thumbnail() ) {
		
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$img = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
			
			if ( $img != '' ) {
				$media_html = bt_get_media_html( 'image', array( $permalink, $img[0] ) );
			}

		} else if ( count( $images ) == 1 ) {
		
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
			$media_html = bt_get_media_html( 'gallery', array( $images_ids ) );
			
		} 
		var_dump( $video );
		if ( $video != '' ) {
			
			$media_html = bt_get_media_html( 'video', array( $video ) );
			
		} else if ( $audio != '' ) {
			
			$media_html = bt_get_media_html( 'audio', array( $audio ) );
			
		}
		
		$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
		$content_html = str_replace( ']]>', ']]&gt;', $content_html );
		
		$class_array = array( 'boldArticle', 'articleListItem' );

		if ( $media_html != '' ) $class_array[] = 'wPhoto';
var_dump( $media_html );
		echo '<article class="' . esc_attr( implode( ' ', get_post_class( $class_array ) ) ) . '">' . bt_get_media_html_render( $media_html );
			
			echo bt_get_heading_html( '', '<a href="' . esc_url_raw( $permalink ) . '">' . esc_html( get_the_title() ) . '</a>', bt_rwmb_meta( BoldThemesPFX . '_subheading' ), 'large', 'top', '', '' );
			
			$content_final_html = get_post()->post_excerpt != '' ? '<p>' . esc_html( get_the_excerpt() ) . '</p>' : $content_html;
			
			if ( $content_final_html != '' ) {
				echo '<div class="boldArticleBody divider">' . wp_kses_post( $content_final_html ) . '</div>';
			}
			
			echo '<footer>
				<div class="socialRow">
					' . ( function_exists( 'bt_get_share_html' ) ? bt_get_share_html( $permalink, 'pf' ) : '' ) . '
				</div>
				<p class="boldContinue"><a href="' . esc_url_raw( $permalink ) . '">' . esc_html__( 'CONTINUE READING', 'cargo' ) . '</a></p>
			</footer>			
		</article>';
		
	}
	
	bt_pagination();
	
	
	
} else {
	if ( is_search() ) { ?>
		<section class="btNoSearchResults">
			<?php echo bt_get_heading_html( esc_html__( 'We are sorry, no results for: ', 'cargo' ) . get_search_query(), '', "<a href='" . site_url() . "'>" . esc_html__( 'Back to homepage', 'cargo' )."</a>", 'extralarge', 'bottom', '', '' ) ?>
		</section>
	<?php }
}

?>

<?php

get_footer();

?>