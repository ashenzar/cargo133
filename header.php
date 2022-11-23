<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
	<?php
	
	bt_set_override();
	bt_header_init();
	bt_header_meta();

	wp_head();
	
	?>
	
</head>

<body <?php body_class(); ?>>

<?php echo bt_preloader_html(); ?>

<div class="btPageWrap" id="top">
	
    <header class="mainHeader btClear">
		<?php if ( ! bt_get_option( 'top_tools_in_menu' ) ) echo bt_top_bar_html("top"); ?>
        <div class="port">
			<div class="menuHolder btClear">
				<div class="btVerticalMenuTrigger">&nbsp;<?php echo bt_get_icon_html( 'fa_f0c9', '#', '', 'borderless extrasmall' ); ?></div>
				<div class="btHorizontalMenuTrigger">&nbsp;<?php echo bt_get_icon_html( 'fa_f0c9', '#', '', 'borderless extrasmall' ); ?></div>
				<div class="logo">
					<span>
						<?php bt_logo( 'header' ); ?>
					</span>
				</div><!-- /logo -->
				<div class="menuPort">
					<?php if ( bt_get_option( 'top_tools_in_menu' ) ) echo bt_top_bar_html("menu"); ?>
					<nav>
						<ul>
							<?php bt_nav_menu(); ?>
						</ul>
					</nav>
				</div><!-- .menuPort -->
				
			</div><!-- /menuHolder -->
		</div>
		<div class="btCurveHeader">
			<div class="btCurveHolder">
				<div class="btCurveLeftHolder">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="20px" viewBox="0 0 80 20" enable-background="new 0 0 80 20" xml:space="preserve">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M 81 20 c 0 0 -16 0 -30 0 c -30 0 -23 -15 -50 -15 l 0 -5 L 81 0 L 81 20 Z" class="btCurveLeft"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M 81 -1 L 31 -1 c 27 -1 21 15 51 16 C 82 3 82 -1 82 -1 Z" class="btCurveLeftFill"/>
					</svg>
				</div>
				<div class="btCurveRightHolder">
					<svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="20px" viewBox="0 0 80 20" enable-background="new 0 0 80 20" xml:space="preserve">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M 0 20 c 0 0 16 0 30 0 c 30 0 23 -15 50 -15 l 0 -5 L 0 0 L 0 20 Z" class="btCurveRight"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M -1 -1 L 50 -1 C 23 -1 30 15 -1 15 C -1 3 -1 -1 -1 -1 Z" class="btCurveRightFill"/>
					</svg>
				</div>
				<div class="btSiteHeaderCurveSleeve"></div>
			</div>
		</div><!-- /port -->
		
    </header><!-- /.mainHeader -->
	<div class="btContentWrap btClear">
		<div class="btContentHolder">
			<div class="btContent">
			<?php bt_header_headline() ?>