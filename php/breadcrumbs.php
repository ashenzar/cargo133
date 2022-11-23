<?php
if ( ! function_exists( 'bt_breadcrumbs' ) ) {
	function bt_breadcrumbs() {

		global $post;
		
		$post_type = get_post_type( get_the_ID() );
		
		$post_id = get_the_ID();
		
		$home = esc_html__( 'Home', 'cargo' );
		$home_link = home_url( '/' );
		$title = '';
		$output  = '';

		if ( ! is_404() && ! is_home() ) {
		
			$output .= '<div class="btBreadCrumbs"><nav><ul><li><a href="' . esc_url_raw( $home_link ) . '">' . wp_kses_post( $home ) . '</a></li>';
			
			if ( is_category() ) {

				$title = esc_html__( 'Category:', 'cargo' ) . ' ' . single_cat_title( '', false );
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';
		  
			} else if ( is_singular( 'post' ) ) {
			
				$categories = get_the_category();
				$output .= '<li>';
				$n = 0;
				foreach( $categories as $cat ) {
					$n++;
					$output .= '<a href="' . esc_url_raw( get_category_link( $cat->term_id ) ) . '">' . wp_kses_post( $cat->name ) . '</a>';
					if ( $n < count( $categories ) ) $output .= ', ';
				}
				$output .= '</li>';
				$output .= '<li>' . esc_html( get_the_title() ) . '</li>';
				
			} else if ( is_post_type_archive( 'portfolio' ) ) {
				
				$title = esc_html__( 'Portfolio', 'cargo' );
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';
				
			} else if ( is_singular( 'portfolio' ) ) {
				
				$output .= '<li>' . esc_html__( 'Portfolio', 'cargo' ) . '</li>';
				$output .= '<li>' . esc_html( get_the_title() ) . '</li>';
				
			} else if ( is_attachment() ) {
			
				$title = get_the_title();
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';
		  
			} else if ( is_tag() ) {
			
				$title = esc_html__( 'Tag:', 'cargo' ) . ' ' . single_tag_title( '', false );
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';
		  
			} else if ( is_author() ) {
			
				$title = esc_html__( 'Author:', 'cargo' ) . ' ' . get_the_author_meta( 'display_name' );
				$output .= '<li>' .  wp_kses_post( $title ) . '</li>';
				
			} else if ( is_day() ) {

				$title = get_the_time( 'Y / m / d' );
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';
		  
			} else if ( is_month() ) {
			
				$title = get_the_time( 'Y / m' );
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';
		  
			} else if ( is_year() ) {
			
				$title = get_the_time( 'Y' );
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';			
				
			} else if ( is_search() ) {
				
				$title = esc_html__( 'Search:', 'cargo' ) . ' ' . get_query_var( 's' );
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';			
				
			} else {
				$title = get_the_title();
				$output .= '<li>' . wp_kses_post( $title ) . '</li>';
			}
			
			$output .= '</ul></nav></div>';
		}
	return $output;
	}
}