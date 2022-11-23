<?php
if ( ! class_exists( 'BT_Customize_Default' ) ) {

	class BT_Customize_Default {

		// GENERAL SETTINGS

		public static $favicon = ''; // 32x32

		public static $logo = '';
		public static $alt_logo = '';
		
		public static $mobile_touch_icon = ''; // 196x196
		
		public static $menu_type = 'hRight';
		public static $boxed_menu = true;
		public static $below_menu = false;
		public static $top_tools_in_menu = false;

		public static $hide_headline = true;

		public static $sticky_header = false;
		public static $hide_menu = false;
		public static $template_skin = false;
		public static $footer_skin = false;
	
		public static $sidebar = 'right';
		
		public static $accent_color = '';
		public static $alternate_color = '';
		
		public static $body_font = 'no_change';
		public static $menu_font = 'no_change';
		public static $heading_font = 'no_change';
		public static $heading_supertitle_font = 'no_change';
		public static $heading_subtitle_font = 'no_change';
		
		public static $disable_preloader = false;
		public static $preloader_text = 'Loading...';

		public static $custom_css = '';
		public static $custom_js_top = '';
		public static $custom_js_bottom = '';
		
		public static $custom_text = '';
		
		// BLOG
		
		public static $blog_ghost_slider = false;
		public static $blog_grid_gallery_columns = '4';
		public static $blog_grid_gallery_gap = '0';
		public static $sticky_in_grid = false;
		public static $blog_author = true;
		public static $blog_date = true;
		public static $blog_side_info = false;
		public static $blog_author_info = false;
		public static $blog_share_facebook = true;
		public static $blog_share_twitter = true;
		public static $blog_share_whatsapp = true;
		public static $blog_share_linkedin = true;
		public static $blog_share_vk = true;
		
		// PORTFOLIO
		
		public static $pf_ghost_slider = true;
		public static $pf_grid_gallery_columns = '3';
		public static $pf_grid_gallery_gap = '0';
		public static $pf_share_facebook = true;
		public static $pf_share_twitter = true;
		public static $pf_share_whatsapp = true;
		public static $pf_share_linkedin = true;
		public static $pf_share_vk = true;
		public static $pf_settings_page_slug = '';
		
	}
}

if ( ! function_exists( 'bt_get_option' ) ) {
	function bt_get_option( $opt ) {

		global $bt_options;
		global $bt_page_options;

		if ( isset( BT_Customize_Default::$$opt ) ) {
			if ( isset( $_GET[ $opt ] ) ) {
				$ret = $_GET[ $opt ];
				if ( $ret === 'true' ) {
					$ret = true;
				} else if ( $ret === 'false' ) {
					$ret = false;
				}
				return $ret;
			}			
		}
		if ( $bt_page_options !== null && array_key_exists( BoldThemesPFX . '_' . $opt, $bt_page_options ) && $bt_page_options[ BoldThemesPFX . '_' . $opt ] === 'null' ) {
			return BT_Customize_Default::$$opt;
		}
		if ( $bt_page_options !== null && array_key_exists( BoldThemesPFX . '_' . $opt, $bt_page_options ) ) {
			$ret = $bt_page_options[ BoldThemesPFX . '_' . $opt ];
			if ( $ret === 'true' ) {
				$ret = true;
			} else if ( $ret === 'false' ) {
				$ret = false;
			}
			return $ret;
		}
		if ( $bt_options !== null && $bt_options !== false && array_key_exists( $opt, $bt_options ) ) {
			$ret = $bt_options[ $opt ];
			if ( $ret === 'true' ) {
				$ret = true;
			} else if ( $ret === 'false' ) {
				$ret = false;
			}
			return $ret;
		} else { 
			if ( $bt_options !== null ) {
				return BT_Customize_Default::$$opt;
			} else {
				$bt_options = get_option( BoldThemesPFX . '_theme_options' );
				if ( is_array( $bt_options ) && array_key_exists( $opt, $bt_options ) ) {
					$ret = $bt_options[ $opt ];
					if ( $ret === 'true' ) {
						$ret = true;
					} else if ( $ret === 'false' ) {
						$ret = false;
					}
					return $ret;
				} else {
					return BT_Customize_Default::$$opt;
				}
			}
		}

	}
}

if ( ! function_exists( 'bt_logo' ) ) {
	function bt_logo( $type = 'header' ) {
		
		$logo = bt_get_option( 'logo' );
		$alt_logo = bt_get_option( 'alt_logo' );

		$home_link = home_url( '/' );
		if ( $logo != '' && $logo != ' ' ) {
			if ( $type == 'header' ) {
				echo '<a href="' . esc_url_raw( $home_link ) . '"><img class="btMainLogo" src="' . esc_url_raw( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				if ( $alt_logo != '' && $alt_logo != ' ' ) echo '<img class="btAltLogo" src="' . esc_url_raw( $alt_logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				echo '</a>';
			} else if ( $type == 'footer' ) {
				echo '<a href="' . esc_url_raw( $home_link ) . '"><img src="' . esc_url_raw( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
			} else if ( $type == 'preloader' ) {
				echo '<img class="preloaderLogo" src="' . esc_url_raw( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" data-alt-logo="' . esc_attr( $alt_logo ) . '">';
			}
		}
	}
}

if ( ! function_exists( 'bt_custom_controls' ) ) {
	function bt_custom_controls() {
		class BT_Customize_Textarea_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value()); ?></textarea>
				</label>
				<?php
			}
		}
		
		class BT_Reset_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<div style="margin: 5px 0px 10px 0px">
				<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>			
					<input type="submit" onclick="var c = confirm('<?php echo esc_js( esc_html__( 'Reset theme settings to default values?', 'cargo' ) ); ?>'); if (c != true) return false;var href=window.location.href;if (href.indexOf('?') > -1) {window.location.replace(href + '&bt_reset=reset')} else {window.location.replace(href + '?bt_reset=reset')};return false;" name="bt_reset" id="bt_reset" class="button" value="Reset">
				</div>
				<?php
			}
		}
	}
}
add_action( 'customize_register', 'bt_custom_controls' );

if ( ! function_exists( 'bt_customize_register' ) ) {
	function bt_customize_register( $wp_customize ) {
		if ( isset( $_GET['bt_reset'] ) && $_GET['bt_reset'] == 'reset' ) {
			delete_option( BoldThemesPFX . '_theme_options' );
			header( 'Location: ' . wp_customize_url());
		}

		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'title_tagline' );
		$wp_customize->remove_section( 'nav' );
		$wp_customize->remove_section( 'static_front_page' );
		
		$wp_customize->add_section( BoldThemesPFX . '_general_section' , array(
			'title'      => esc_html__( 'General Settings', 'cargo' ),
			'priority'   => 10,
		));
		$wp_customize->add_section( BoldThemesPFX . '_background_section' , array(
			'title'      => esc_html__( 'Background', 'cargo' ),
			'priority'   => 30,
		));
		$wp_customize->add_section( BoldThemesPFX . '_blog_section' , array(
			'title'      => esc_html__( 'Blog', 'cargo' ),
			'priority'   => 50,
		));
		$wp_customize->add_section( BoldThemesPFX . '_pf_section' , array(
			'title'      => esc_html__( 'Portfolio', 'cargo' ),
			'priority'   => 52,
		));
		
		/* GENERAL SETTINGS */
		
		// FAVICON
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[favicon]', array(
			'default'           => BT_Customize_Default::$favicon,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'favicon',
				array(
					'label'    => esc_html__( 'Favicon', 'cargo' ),
					'section'  => BoldThemesPFX . '_general_section',
					'settings' => BoldThemesPFX . '_theme_options[favicon]',
					'priority' => 10,
					'context'  => BoldThemesPFX . '_favicon'
				)
			)
		);
		
		// LOGO
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[logo]', array(
			'default'           => BT_Customize_Default::$logo,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'logo',
				array(
					'label'    => esc_html__( 'Logo', 'cargo' ),
					'section'  => BoldThemesPFX . '_general_section',
					'settings' => BoldThemesPFX . '_theme_options[logo]',
					'priority' => 20,
					'context'  => BoldThemesPFX . '_logo'
				)
			)
		);
		
		// ALTERNATIVE LOGO
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[alt_logo]', array(
			'default'           => BT_Customize_Default::$alt_logo,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'alt_logo',
				array(
					'label'    => esc_html__( 'Alternative Logo', 'cargo' ),
					'section'  => BoldThemesPFX . '_general_section',
					'settings' => BoldThemesPFX . '_theme_options[alt_logo]',
					'priority' => 25,
					'context'  => BoldThemesPFX . '_alt_logo'
				)
			)
		);		
		
		// MOBILE TOUCH ICON
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[mobile_touch_icon]', array(
			'default'           => BT_Customize_Default::$mobile_touch_icon,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'mobile_touch_icon',
				array(
					'label'    => esc_html__( 'Mobile Touch Icon', 'cargo' ),
					'section'  => BoldThemesPFX . '_general_section',
					'settings' => BoldThemesPFX . '_theme_options[mobile_touch_icon]',
					'priority' => 35,
					'context'  => BoldThemesPFX . '_mobile_touch_icon'
				)
			)
		);
		
		// MENU TYPE
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[menu_type]', array(
			'default'           => 'right',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'menu_type', array(
			'label'     => esc_html__( 'Menu Type', 'cargo' ),
			'section'   => BoldThemesPFX . '_general_section',
			'settings'  => BoldThemesPFX . '_theme_options[menu_type]',
			'priority'  => 60,
			'type'      => 'select',
			'choices'   => array(
				'hLeft'     => esc_html__( 'Horizontal Left', 'cargo' ),
				'hCenter' => esc_html__( 'Horizontal Centered', 'cargo' ),
				'hRight'    => esc_html__( 'Horizontal Right', 'cargo' ),
				'vLeft'    => esc_html__( 'Vertical Left', 'cargo' ),
				'vRight'    => esc_html__( 'Vertical Right', 'cargo' )
			)
		));
		
		// HIDE HEADLINE
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[hide_headline]', array(
				'default'           => BT_Customize_Default::$hide_headline,
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'hide_headline', array(
				'label'    => esc_html__( 'Hide Headline', 'cargo' ),
				'section'  => BoldThemesPFX . '_general_section',
				'settings' => BoldThemesPFX . '_theme_options[hide_headline]',
				'priority' => 64,
				'type'     => 'checkbox'
		));
		
		// BOXED MENU
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[boxed_menu]', array(
			'default'           => BT_Customize_Default::$boxed_menu,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'boxed_menu', array(
			'label'    => esc_html__( 'Boxed Menu', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[boxed_menu]',
			'priority' => 65,
			'type'     => 'checkbox'
		));

		// BELOW MENU
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[below_menu]', array(
			'default'           => BT_Customize_Default::$below_menu,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'below_menu', array(
			'label'    => esc_html__( 'Content Below Menu', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[below_menu]',
			'priority' => 70,
			'type'     => 'checkbox'
		));

		// TOP TOOLS IN MENU AREA
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[top_tools_in_menu]', array(
			'default'           => BT_Customize_Default::$top_tools_in_menu,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'top_tools_in_menu', array(
			'label'    => esc_html__( 'Show Top Widgets in Menu Area', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[top_tools_in_menu]',
			'priority' => 70,
			'type'     => 'checkbox'
		));

		// STICKY HEADER
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[sticky_header]', array(
			'default'           => BT_Customize_Default::$sticky_header,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'sticky_header', array(
			'label'    => esc_html__( 'Sticky Header', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[sticky_header]',
			'priority' => 80,
			'type'     => 'checkbox'
		));

		// HIDE MENU
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[hide_menu]', array(
			'default'           => BT_Customize_Default::$hide_menu,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'hide_menu', array(
			'label'    => esc_html__( 'Hide Menu', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[hide_menu]',
			'priority' => 80,
			'type'     => 'checkbox'
		));

		// TEMPLATE SKIN
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[template_skin]', array(
			'default'           => BT_Customize_Default::$template_skin,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'template_skin', array(
			'label'    => esc_html__( 'Use Dark Skin', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[template_skin]',
			'priority' => 80,
			'type'     => 'checkbox'
		));

		// FOOTER SKIN
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[footer_skin]', array(
			'default'           => BT_Customize_Default::$footer_skin,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'footer_skin', array(
			'label'    => esc_html__( 'Use Dark Footer', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[footer_skin]',
			'priority' => 80,
			'type'     => 'checkbox'
		));
		
		// SIDEBAR
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[sidebar]', array(
			'default'           => BT_Customize_Default::$sidebar,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'sidebar', array(
			'label'     => esc_html__( 'Sidebar', 'cargo' ),
			'section'   => BoldThemesPFX . '_general_section',
			'settings'  => BoldThemesPFX . '_theme_options[sidebar]',
			'priority'  => 93,
			'type'      => 'select',
			'choices'   => array(
				'no_sidebar' => esc_html__( 'No Sidebar', 'cargo' ),
				'left'       => esc_html__( 'Left', 'cargo' ),
				'right'      => esc_html__( 'Right', 'cargo' )
			)
		));
	
		// ACCENT COLOR
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[accent_color]', array(
			'default'        	   => BT_Customize_Default::$accent_color,
			'type'           	   => 'option',
			'capability'     	   => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_text_field'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
			'label'    => esc_html__( 'Accent Color', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[accent_color]',
			'priority' => 95
		)));

		// ALTERNATE COLOR
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[alternate_color]', array(
			'default'        	   => BT_Customize_Default::$accent_color,
			'type'           	   => 'option',
			'capability'     	   => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_text_field'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alternate_color', array(
			'label'    => esc_html__( 'Alternate Color', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[alternate_color]',
			'priority' => 95
		)));
		
		global $bt_fonts;
		require_once( get_template_directory() . '/php/web_fonts.php' );
		$choices = array( 'no_change' => esc_html__( 'No Change', 'cargo' ) );
		foreach ( $bt_fonts as $font ) {
			$choices[$font['css-name']] = $font['font-name'];
		}

		// BODY FONT
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[body_font]', array(
			'default'           => 'no_change',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'body_font', array(
			'label'     => esc_html__( 'Body Font', 'cargo' ),
			'section'   => BoldThemesPFX . '_general_section',
			'settings'  => BoldThemesPFX . '_theme_options[body_font]',
			'priority'  => 97,
			'type'      => 'select',
			'choices'   => $choices
		));
		
		// HEADING FONT
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[heading_font]', array(
			'default'           => 'no_change',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'heading_font', array(
			'label'     => esc_html__( 'Heading Font', 'cargo' ),
			'section'   => BoldThemesPFX . '_general_section',
			'settings'  => BoldThemesPFX . '_theme_options[heading_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => $choices
		));

		// SUPERTITLE HEADING FONT
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[heading_supertitle_font]', array(
			'default'           => 'no_change',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'heading_supertitle_font', array(
			'label'     => esc_html__( 'Heading Supertitle Font', 'cargo' ),
			'section'   => BoldThemesPFX . '_general_section',
			'settings'  => BoldThemesPFX . '_theme_options[heading_supertitle_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => $choices
		));

		// HEADING SUBTITLE FONT
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[heading_subtitle_font]', array(
			'default'           => 'no_change',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'heading_subtitle_font', array(
			'label'     => esc_html__( 'Heading Subtitle Font', 'cargo' ),
			'section'   => BoldThemesPFX . '_general_section',
			'settings'  => BoldThemesPFX . '_theme_options[heading_subtitle_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => $choices
		));

		// MENU FONT
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[menu_font]', array(
			'default'           => 'no_change',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'menu_font', array(
			'label'     => esc_html__( 'Menu Font', 'cargo' ),
			'section'   => BoldThemesPFX . '_general_section',
			'settings'  => BoldThemesPFX . '_theme_options[menu_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => $choices
		));
		
		// DISABLE PRELOADER
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[disable_preloader]', array(
			'default'           => BT_Customize_Default::$disable_preloader,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'disable_preloader', array(
			'label'    => esc_html__( 'Disable Preloader', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[disable_preloader]',
			'priority' => 101,
			'type'     => 'checkbox'
		));		
		
		// PRELOADER TEXT
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[preloader_text]', array(
			'default'           => BT_Customize_Default::$preloader_text,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'preloader_text', array(
			'label'    => esc_html__( 'Preloader Text', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[preloader_text]',
			'priority' => 102,
			'type'     => 'text'
		));

		// CUSTOM CSS
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[custom_css]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( new BT_Customize_Textarea_Control( 
			$wp_customize, 
			'custom_css', array(
				'label'    => esc_html__( 'Custom CSS', 'cargo' ),
				'section'  => BoldThemesPFX . '_general_section',
				'priority' => 104,
				'settings' => BoldThemesPFX . '_theme_options[custom_css]'
			)
		));
		
		// CUSTOM TEXT
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[custom_text]', array(
			'default'           => BT_Customize_Default::$custom_text,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'custom_text', array(
			'label'    => esc_html__( 'Custom Footer Text', 'cargo' ),
			'section'  => BoldThemesPFX . '_general_section',
			'settings' => BoldThemesPFX . '_theme_options[custom_text]',
			'priority' => 120,
			'type'     => 'text'
		));

		// RESET
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[reset]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( new BT_Reset_Control( 
			$wp_customize, 
			'reset', array(
				'label'    => esc_html__( 'Reset Theme Settings', 'cargo' ),
				'section'  => BoldThemesPFX . '_general_section',
				'priority' => 130,
				'settings' => BoldThemesPFX . '_theme_options[reset]'
			)
		));
		
		/* BLOG */
		
		// GHOST SLIDER
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[blog_ghost_slider]', array(
			'default'           => BT_Customize_Default::$blog_ghost_slider,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_ghost_slider', array(
			'label'    => esc_html__( 'Ghost Slider', 'cargo' ),
			'section'  => BoldThemesPFX . '_blog_section',
			'settings' => BoldThemesPFX . '_theme_options[blog_ghost_slider]',
			'priority' => 1,
			'type'     => 'checkbox'
		));
		
		// GRID GALLERY COLUMNS
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[blog_grid_gallery_columns]', array(
			'default'           => BT_Customize_Default::$blog_grid_gallery_columns,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_grid_gallery_columns', array(
			'label'     => esc_html__( 'Grid Gallery Columns', 'cargo' ),
			'section'   => BoldThemesPFX . '_blog_section',
			'settings'  => BoldThemesPFX . '_theme_options[blog_grid_gallery_columns]',
			'priority'  => 6,
			'type'      => 'select',
			'choices'   => array(
				'3' => esc_html__( '3', 'cargo' ),
				'4' => esc_html__( '4', 'cargo' ),
				'5' => esc_html__( '5', 'cargo' ),
				'6' => esc_html__( '6', 'cargo' )				
			)
		));
		
		// GRID GALLERY GAP
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[blog_grid_gallery_gap]', array(
			'default'           => BT_Customize_Default::$blog_grid_gallery_gap,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_grid_gallery_gap', array(
			'label'     => esc_html__( 'Grid Gallery Gap', 'cargo' ),
			'section'   => BoldThemesPFX . '_blog_section',
			'settings'  => BoldThemesPFX . '_theme_options[blog_grid_gallery_gap]',
			'priority'  => 7,
			'type'      => 'select',
			'choices'   => array(
				'0' => esc_html__( '0', 'cargo' ),
				'1' => esc_html__( '2', 'cargo' ),
				'2' => esc_html__( '4', 'cargo' ),
				'3' => esc_html__( '6', 'cargo' ),
				'4' => esc_html__( '8', 'cargo' ),
				'5' => esc_html__( '10', 'cargo' )
			)
		));
		
		// STICKY POSTS IN GRID/TILES
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[sticky_in_grid]', array(
			'default'           => BT_Customize_Default::$sticky_in_grid,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'sticky_in_grid', array(
			'label'    => esc_html__( 'Sticky Posts in Grid/Tiles', 'cargo' ),
			'section'  => BoldThemesPFX . '_blog_section',
			'settings' => BoldThemesPFX . '_theme_options[sticky_in_grid]',
			'priority' => 8,
			'type'     => 'checkbox'
		));		

		// AUTHOR
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[blog_author]', array(
			'default'           => BT_Customize_Default::$blog_author,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_author', array(
			'label'    => esc_html__( 'Show Author Name', 'cargo' ),
			'section'  => BoldThemesPFX . '_blog_section',
			'settings' => BoldThemesPFX . '_theme_options[blog_author]',
			'priority' => 9,
			'type'     => 'checkbox'
		));

		// DATE
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[blog_date]', array(
			'default'           => BT_Customize_Default::$blog_date,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_date', array(
			'label'    => esc_html__( 'Show Post Date', 'cargo' ),
			'section'  => BoldThemesPFX . '_blog_section',
			'settings' => BoldThemesPFX . '_theme_options[blog_date]',
			'priority' => 10,
			'type'     => 'checkbox'
		));
		
		// BLOG SIDE INFO
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[blog_side_info]', array(
			'default'           => BT_Customize_Default::$blog_side_info,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_side_info', array(
			'label'    => esc_html__( 'Show Author Avatar in List', 'cargo' ),
			'section'  => BoldThemesPFX . '_blog_section',
			'settings' => BoldThemesPFX . '_theme_options[blog_side_info]',
			'priority' => 12,
			'type'     => 'checkbox'
		));
		
		// AUTHOR INFO
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[blog_author_info]', array(
			'default'           => BT_Customize_Default::$blog_author_info,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_author_info', array(
			'label'    => esc_html__( 'Show Author Info in Post', 'cargo' ),
			'section'  => BoldThemesPFX . '_blog_section',
			'settings' => BoldThemesPFX . '_theme_options[blog_author_info]',
			'priority' => 15,
			'type'     => 'checkbox'
		));
		
		/* PORTFOLIO */
		
		// GHOST SLIDER
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[pf_ghost_slider]', array(
			'default'           => BT_Customize_Default::$pf_ghost_slider,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'pf_ghost_slider', array(
			'label'    => esc_html__( 'Ghost Slider', 'cargo' ),
			'section'  => BoldThemesPFX . '_pf_section',
			'settings' => BoldThemesPFX . '_theme_options[pf_ghost_slider]',
			'priority' => 3,
			'type'     => 'checkbox'
		));
		
		// GRID GALLERY COLUMNS
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[pf_grid_gallery_columns]', array(
			'default'           => BT_Customize_Default::$pf_grid_gallery_columns,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'pf_grid_gallery_columns', array(
			'label'     => esc_html__( 'Grid Gallery Columns', 'cargo' ),
			'section'   => BoldThemesPFX . '_pf_section',
			'settings'  => BoldThemesPFX . '_theme_options[pf_grid_gallery_columns]',
			'priority'  => 5,
			'type'      => 'select',
			'choices'   => array(
				'3' => esc_html__( '3', 'cargo' ),
				'4' => esc_html__( '4', 'cargo' ),
				'5' => esc_html__( '5', 'cargo' ),
				'6' => esc_html__( '6', 'cargo' )				
			)
		));

		// GRID GALLERY GAP
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[pf_grid_gallery_gap]', array(
			'default'           => BT_Customize_Default::$pf_grid_gallery_gap,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'pf_grid_gallery_gap', array(
			'label'     => esc_html__( 'Grid Gallery Gap', 'cargo' ),
			'section'   => BoldThemesPFX . '_pf_section',
			'settings'  => BoldThemesPFX . '_theme_options[pf_grid_gallery_gap]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'0' => esc_html__( '0', 'cargo' ),
				'1' => esc_html__( '2', 'cargo' ),
				'2' => esc_html__( '4', 'cargo' ),
				'3' => esc_html__( '6', 'cargo' ),
				'4' => esc_html__( '8', 'cargo' ),
				'5' => esc_html__( '10', 'cargo' )
			)
		));
		
		// SETTINGS PAGE SLUG
		$wp_customize->add_setting( BoldThemesPFX . '_theme_options[pf_settings_page_slug]', array(
			'default'           => BT_Customize_Default::$pf_settings_page_slug,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'pf_settings_page_slug', array(
			'label'    => esc_html__( 'Settings Page Slug', 'cargo' ),
			'section'  => BoldThemesPFX . '_pf_section',
			'settings' => BoldThemesPFX . '_theme_options[pf_settings_page_slug]',
			'priority' => 60,
			'type'     => 'text'
		));

	}
}
add_action( 'customize_register', 'bt_customize_register' );

if ( ! function_exists( 'bt_js_bottom' ) ) {
	function bt_js_bottom() {
		$j = bt_get_option( 'custom_js_bottom' );
		wp_register_script( 'bt-js-bottom-script', '' );
		wp_enqueue_script( 'bt-js-bottom-script' );
		wp_add_inline_script( 'bt-js-bottom-script', '' . wp_kses_post( $j ) . '' );
	}
}

if ( ! function_exists( 'bt_customize_css_js' ) ) {
	function bt_customize_css_js() {
		
		if ( bt_get_option( 'custom_css' ) != '' ) {
			wp_register_style( 'bt-custom-style', false );
			wp_enqueue_style( 'bt-custom-style' );
			wp_add_inline_style( 'bt-custom-style', bt_get_option( 'custom_css' ) );
		}
		
		if ( bt_get_option( 'custom_js_top' ) != '' ) {
			$j = bt_get_option( 'custom_js_top' );
			wp_register_script( 'bt-js-top-script', '' );
			wp_enqueue_script( 'bt-js-top-script' );
			wp_add_inline_script( 'bt-js-top-script', '' . wp_kses_post( $j ) . '' );
		}

		if ( bt_get_option( 'custom_js_bottom' ) != '' ) {
			add_action( 'wp_footer', 'bt_js_bottom' );
		}
		
	}
}
add_action( 'wp_head', 'bt_customize_css_js' );

function bt_custom_text( $text ) {
	return $text;
}

function bt_custom_js( $js ) {
	return trim( $js );
}