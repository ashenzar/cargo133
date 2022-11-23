<?php

$strings = 'tinyMCE.addI18n( "' . esc_js( _WP_Editors::$mce_locale ) . '.bt_theme",
	{
		drop_cap: "' . esc_js( esc_html__( 'Drop Cap', 'cargo' ) ) . '",
		highlight: "' . esc_js( esc_html__( 'Highlight', 'cargo' ) ) . '"
	}
)';