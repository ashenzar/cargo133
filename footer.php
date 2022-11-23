		</div><!-- /bt_content -->
<?php

global $bt_has_sidebar;

if ( $bt_has_sidebar ) {
	echo '<aside class="btSidebar">';
		dynamic_sidebar( 'primary_widget_area' );
	echo '</aside>';					
}

?> 
	</div><!-- /contentHolder -->
</div><!-- /contentWrap -->

<?php

$custom_text_html = '';
$custom_text = bt_get_option( 'custom_text' );
if ( $custom_text != '' ) {
	$custom_text_html = '<p class="copyLine">' . wp_kses_post( $custom_text ) . '</p>';
}

$extra_class = '';
if ( bt_get_option( 'footer_skin' ) ) {
	$extra_class = 'btDarkFooterSkin';
}

if ( is_active_sidebar( 'footer_widgets' ) ) {
	echo ' 
	<section class="boldSection gutter btSiteFooterCurve ' . esc_attr( $extra_class ) . '">
		<div class="port">
			<div class="btCurveLeftHolder">
				<svg version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="14px" viewBox="0 0 50 14" enable-background="new 0 0 50 14" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M 0 14 C 27 15 20 0 51 0 c 0 13 0 15 0 15 L 0 15 Z" class="btCurveLeft"/>
				</svg>
			</div>
			<div class="btCurveRightHolder">
				<svg version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="14px" viewBox="0 0 50 14" enable-background="new 0 0 50 14" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M 50 14 c -27 0 -20 -14 -50 -14 c 0 13 0 14 0 145 L 50 14 Z" class="btCurveRight"/>
				</svg>
			</div>
			<div class="btSiteFooterCurveSleeve"></div>
		</div>
	</section>
	<section class="boldSection btSiteFooterWidgets gutter topSemiSpaced topSemiSpaced btDoubleRowPadding ' . esc_attr( $extra_class ) . '">
		<div class="port">
			<div class="boldRow" id="boldSiteFooterWidgetsRow">';
			dynamic_sidebar( 'footer_widgets' ); 
	echo '	
			</div>
		</div>
	</section>';
} 

if ( $custom_text_html != '' || has_nav_menu( 'footer' )) { 
	echo '
	<footer class="boldSection gutter btSiteFooter btGutter ' . esc_attr( $extra_class ) . '">
		<div class="port">
			<div class="boldRow">
				<div class="rowItem btFooterCopy col-md-6 col-sm-12 btTextLeft">
					' . wp_kses_post( $custom_text_html ) . '
				</div><!-- /copy -->
				<div class="rowItem btFooterMenu col-md-6 col-sm-12 btTextRight">';
					wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'ul', 'depth' => 1, 'fallback_cb' => false ) );
	echo '
				</div>
			</div><!-- /boldRow -->
		</div><!-- /port -->
	</footer>';
 } ?>

</div><!-- /pageWrap -->

<?php 

wp_footer();

?>
</body>
</html>