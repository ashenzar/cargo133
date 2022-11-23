<?php
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars ) ) {
	$boldthemes_crush_vars = BoldThemesFramework::$crush_vars;
}
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars_def ) ) {
	$boldthemes_crush_vars_def = BoldThemesFramework::$crush_vars_def;
}
if ( isset( $boldthemes_crush_vars['headingFont'] ) ) {
	$headingFont = $boldthemes_crush_vars['headingFont'];
} else {
	$headingFont = "Lato,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['headingSuperTitleFont'] ) ) {
	$headingSuperTitleFont = $boldthemes_crush_vars['headingSuperTitleFont'];
} else {
	$headingSuperTitleFont = "Raleway,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['headingSubTitleFont'] ) ) {
	$headingSubTitleFont = $boldthemes_crush_vars['headingSubTitleFont'];
} else {
	$headingSubTitleFont = "Raleway,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['menuFont'] ) ) {
	$menuFont = $boldthemes_crush_vars['menuFont'];
} else {
	$menuFont = "Lato,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['bodyFont'] ) ) {
	$bodyFont = $boldthemes_crush_vars['bodyFont'];
} else {
	$bodyFont = "Raleway,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['accentColor'] ) ) {
	$accentColor = $boldthemes_crush_vars['accentColor'];
} else {
	$accentColor = "#0B60A9";
}
if ( isset( $boldthemes_crush_vars['alternateColor'] ) ) {
	$alternateColor = $boldthemes_crush_vars['alternateColor'];
} else {
	$alternateColor = "#686d7a";
}
$lightHeadlineColor = $accentColor;$footerBackgroundColor = CssCrush\fn__l_adjust( $accentColor.",-11%" );$accentColorLight20 = CssCrush\fn__l_adjust( $accentColor.",20%" );$accentColorLight30 = CssCrush\fn__l_adjust( $accentColor.",30%" );$accentColorLight9 = CssCrush\fn__l_adjust( $accentColor.",9%" );$accentColorLight_9 = CssCrush\fn__l_adjust( $accentColor.",-9%" );$accentColorLight_10 = CssCrush\fn__l_adjust( $accentColor.",-10%" );$alternateColorLight20 = CssCrush\fn__l_adjust( $alternateColor.",20%" );$alternateColorLight9 = CssCrush\fn__l_adjust( $alternateColor.",9%" );$alternateColorLight_9 = CssCrush\fn__l_adjust( $alternateColor.",-9%" );$css_override = sanitize_text_field("a:hover{
    color: {$accentColor};}
select,
input{font-family: {$bodyFont};}
body{font-family: {$bodyFont};}
h1,
h2,
h3,
h4,
h5,
h6{
    font-family: {$headingFont};}
.btLightSkin a:hover,
.btDarkSkin .btLightSkin a:hover{color: {$accentColor};}
.btDarkSkin a:hover,
.btLightSkin .btDarkSkin a:hover{color: {$accentColor};}
.btLightSkin select:hover,
.btLightSkin textarea:hover,
.btLightSkin input:hover,
.btDarkSkin .btLightSkin select:hover,
.btDarkSkin .btLightSkin textarea:hover,
.btDarkSkin .btLightSkin input:hover{
    -webkit-box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btLightSkin select:focus,
.btLightSkin textarea:focus,
.btLightSkin input:focus,
.btDarkSkin .btLightSkin select:focus,
.btDarkSkin .btLightSkin textarea:focus,
.btDarkSkin .btLightSkin input:focus{
    -webkit-box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);
    box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);}
.btDarkSkin select:hover,
.btDarkSkin textarea:hover,
.btDarkSkin input:hover,
.btLightSkin .btDarkSkin select:hover,
.btLightSkin .btDarkSkin textarea:hover,
.btLightSkin .btDarkSkin input:hover{-webkit-box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btDarkSkin select:focus,
.btDarkSkin textarea:focus,
.btDarkSkin input:focus,
.btLightSkin .btDarkSkin select:focus,
.btLightSkin .btDarkSkin textarea:focus,
.btLightSkin .btDarkSkin input:focus{-webkit-box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);
    box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);}
.btAccentTitle h1,
.btAccentTitle h2,
.btAccentTitle h3,
.btAccentTitle h4,
.btAccentTitle h5,
.btAccentTitle h6{color: {$accentColor} !important;}
.btLightAccentTitle h1,
.btLightAccentTitle h2,
.btLightAccentTitle h3,
.btLightAccentTitle h4,
.btLightAccentTitle h5,
.btLightAccentTitle h6{color: {$accentColorLight20} !important;}
.btDarkAccentTitle h1,
.btDarkAccentTitle h2,
.btDarkAccentTitle h3,
.btDarkAccentTitle h4,
.btDarkAccentTitle h5,
.btDarkAccentTitle h6{color: {$accentColorLight_9} !important;}
.btAlternateTitle h1,
.btAlternateTitle h2,
.btAlternateTitle h3,
.btAlternateTitle h4,
.btAlternateTitle h5,
.btAlternateTitle h6{color: {$alternateColor} !important;}
.btLightAlternateTitle h1,
.btLightAlternateTitle h2,
.btLightAlternateTitle h3,
.btLightAlternateTitle h4,
.btLightAlternateTitle h5,
.btLightAlternateTitle h6{color: {$alternateColorLight20} !important;}
.btDarkAlternateTitle h1,
.btDarkAlternateTitle h2,
.btDarkAlternateTitle h3,
.btDarkAlternateTitle h4,
.btDarkAlternateTitle h5,
.btDarkAlternateTitle h6{color: {$alternateColorLight_9} !important;}
.btLoader{
    border-top: 5px solid {$accentColor};}
.menuPort{font-family: {$menuFont};}
.btDarkSkin ul li ul li a:hover,
.btLightSkin .btDarkSkin ul li ul li a:hover{-webkit-box-shadow: -5px 0 0 {$accentColor} inset;
    box-shadow: -5px 0 0 {$accentColor} inset;}
.btLightSkin ul li ul li a:hover,
.btDarkSkin .btLightSkin ul li ul li a:hover{-webkit-box-shadow: -5px 0 0 {$accentColor} inset;
    box-shadow: -5px 0 0 {$accentColor} inset;}
.btDarkSkin nav ul li.current-menu-ancestor > a:hover,
.btDarkSkin nav ul li.current-menu-item > a:hover,
.btLightSkin .btDarkSkin nav ul li.current-menu-ancestor > a:hover,
.btLightSkin .btDarkSkin nav ul li.current-menu-item > a:hover{color: {$alternateColor};}
.btLightSkin nav ul li.current-menu-ancestor > a:hover,
.btLightSkin nav ul li.current-menu-item > a:hover,
.btDarkSkin .btLightSkin nav ul li.current-menu-ancestor > a:hover,
.btDarkSkin .btLightSkin nav ul li.current-menu-item > a:hover{color: {$alternateColor};}
.topBar .btIco .btIcoHolder:before,
.menuPort .topBarInMenu .btIco .btIcoHolder:before{color: {$accentColorLight_9};}
.topBar .topTools .widget_search .btSearch .btIco.default .btIcoHolder:before,
.menuPort .topBarInMenu .widget_search .btSearch .btIco.default .btIcoHolder:before{
    color: {$accentColor};}
.topBar .widget_search h2,
.topBarInMenu .widget_search h2{
    font-family: {$bodyFont};}
.topBar .widget_search button,
.topBarInMenu .widget_search button{
    background: {$accentColor};}
.topBar .widget_search button:hover,
.topBarInMenu .widget_search button:hover{background: {$accentColorLight_10};}
.btSearchInner.btFromTopBox{
    background: {$accentColor};}
.btSearchInner.btFromTopBox input[type=\"text\"]{
    border: 1px solid {$accentColorLight_9};}
.btSearchInner.btFromTopBox button:before{
    color: {$alternateColor};}
.btSearchInner.btFromTopBox button:hover:before{color: {$accentColor};}
.btLightSkin.btMenuLeft ul li ul li a:hover,
.btDarkSkin .btLightSkin.btMenuLeft ul li ul li a:hover{-webkit-box-shadow: 5px 0 0 {$accentColor} inset !important;
    box-shadow: 5px 0 0 {$accentColor} inset !important;}
.btDarkSkin.btMenuLeft ul li ul li a:hover,
.btLightSkin .btDarkSkin.btMenuLeft ul li ul li a:hover{-webkit-box-shadow: 5px 0 0 {$accentColor} inset !important;
    box-shadow: 5px 0 0 {$accentColor} inset !important;}
.btLightSkin.btMenuCenter .menuPort .leftNav ul li ul li a:hover,
.btDarkSkin .btLightSkin.btMenuCenter .menuPort .leftNav ul li ul li a:hover{-webkit-box-shadow: 5px 0 0 {$accentColor} inset !important;
    box-shadow: 5px 0 0 {$accentColor} inset !important;}
.btDarkSkin.btMenuCenter .menuPort .leftNav ul li ul li a:hover,
.btLightSkin .btDarkSkin.btMenuCenter .menuPort .leftNav ul li ul li a:hover{-webkit-box-shadow: 5px 0 0 {$accentColor} inset !important;
    box-shadow: 5px 0 0 {$accentColor} inset !important;}
.btMenuVerticalLeft .btCloseVertical:before,
.btMenuVerticalRight .btCloseVertical:before{
    color: {$accentColor};}
.btMenuVerticalLeft .menuPort ul a:hover,
.btMenuVerticalRight .menuPort ul a:hover{color: {$alternateColor};}
.btMenuVerticalLeft .menuPort ul li .subToggler .btIcoHolder:before,
.btMenuVerticalRight .menuPort ul li .subToggler .btIcoHolder:before{color: {$alternateColor};}
.btSiteFooter .menu li a{color: {$accentColorLight30};}
.btSiteFooter .menu li a:hover{color: {$accentColor};}
.btSiteFooterWidgets .btBox h4{color: {$accentColorLight20};}
.btSiteFooterWidgets .btBox a:hover{color: {$accentColorLight30};}
.btSiteFooterWidgets .recentTweets small:before{color: {$accentColorLight20};}
.btSiteFooterCurve .btSiteFooterCurveSleeve{background: {$footerBackgroundColor};}
.btSiteFooterCurve .btCurveLeft,
.btSiteFooterCurve .btCurveRight{fill: {$footerBackgroundColor};}
.btLightSkin .btSiteFooterWidgets,
.btDarkSkin .btLightSkin .btSiteFooterWidgets{background: {$footerBackgroundColor};}
.btLightSkin .btSiteFooter,
.btDarkSkin .btLightSkin .btSiteFooter{
    background: {$footerBackgroundColor};}
.btDarkSkin .btSiteFooterWidgets,
.btLightSkin .btDarkSkin .btSiteFooterWidgets{background: {$footerBackgroundColor};}
.btDarkSkin .btSiteFooter,
.btLightSkin .btDarkSkin .btSiteFooter{
    background: {$footerBackgroundColor};}
.sticky .btSubTitle:after{background: {$alternateColor};}
.commentsBox h4,
h3.comment-reply-title{
    color: {$alternateColor};}
.btBox h4{
    color: {$accentColor};}
.btBox h5{
    color: {$alternateColor};}
.btLightSkin .btSidebar .btBox a:hover,
.btDarkSkin .btLightSkin .btSidebar .btBox a:hover{color: {$accentColor};}
.btDarkSkin .btSidebar .btBox a:hover,
.btLightSkin .btDarkSkin .btSidebar .btBox a:hover{color: {$alternateColor};}
.btBox.widget_calendar table caption{background: {$accentColor};
    font-family: {$headingFont};}
.btBox.widget_archive ul li a,
.btBox.widget_categories ul li a{
    font-family: {$headingFont};}
.btLightSkin .btBox.widget_archive ul li a:hover,
.btLightSkin .btBox.widget_categories ul li a:hover,
.btDarkSkin .btLightSkin .btBox.widget_archive ul li a:hover,
.btDarkSkin .btLightSkin .btBox.widget_categories ul li a:hover{
    background: {$accentColor};}
.btDarkSkin .btBox.widget_archive ul li a:hover,
.btDarkSkin .btBox.widget_categories ul li a:hover,
.btLightSkin .btDarkSkin .btBox.widget_archive ul li a:hover,
.btLightSkin .btDarkSkin .btBox.widget_categories ul li a:hover{
    background: {$accentColor};}
.btBox.widget_recent_comments .comment-author-link a{color: {$accentColor};}
.btBox.widget_recent_comments .comment-author-link a:hover{color: {$alternateColor};}
.btBox.widget_rss li a.rsswidget{font-family: {$headingFont};}
.btBox.widget_rss li cite:before{
    color: {$accentColor};}
.btBox .btSearch button{
    background: {$alternateColor};
    border: 1px solid {$alternateColorLight_9};
    -webkit-box-shadow: 0 0 0 2px transparent inset,0 1px 0 {$alternateColorLight_9} inset;
    box-shadow: 0 0 0 2px transparent inset,0 1px 0 {$alternateColorLight_9} inset;}
.btBox .btSearch button:hover{
    border: 1px solid {$alternateColor};
    -webkit-box-shadow: 0 0 0 2px {$alternateColor} inset,0 1px 0 transparent inset;
    box-shadow: 0 0 0 2px {$alternateColor} inset,0 1px 0 transparent inset;
    color: {$alternateColor};}
.btBox.widget_tag_cloud .tagcloud a{
    background: {$accentColor};}
.btBox.widget_tag_cloud .tagcloud a:hover{background: {$alternateColor};}
.btTags ul li a{
    background: {$accentColor};}
.btTags ul li a:hover{background: {$alternateColor};}
.btHasGhost .fullScreenHeight.btGhost .btArticleComments:hover:before{color: {$accentColor} !important;}
.btArticleComments:hover,
.btArticleComments:hover:before{
    color: {$accentColor} !important;}
.btArticleCategories a:hover{color: {$accentColor} !important;}
.btContent table tr th,
.btContent table thead tr th{background: {$accentColor};}
.btContent table tbody tr:nth-child(even) th{background: {$accentColorLight_9};}
.btContent table tbody tr:nth-child(odd) th{background: {$accentColor};}
.post-password-form input[type=\"submit\"]{
    background: {$accentColor};
    font-family: {$headingFont};}
.btPagination .paging a{
    color: {$alternateColor};}
.btPagination .paging a:after{
    -webkit-box-shadow: 0 0 0 0 {$accentColor} inset;
    box-shadow: 0 0 0 0 {$accentColor} inset;}
.btPagination .paging a:hover:after{background: {$accentColor};
    -webkit-box-shadow: 0 0 0 50px {$accentColor} inset;
    box-shadow: 0 0 0 50px {$accentColor} inset;}
.btLinkPages a:hover{background: {$accentColor};}
.articleSideGutter{
    background: {$alternateColor};}
.articleSideGutter .asgItem.avatar a:hover:before{-webkit-box-shadow: 0 0 0 3px {$accentColor} inset;
    box-shadow: 0 0 0 3px {$accentColor} inset;}
.btLightSkin .articleSideGutter:before,
.btDarkSkin .btLightSkin .articleSideGutter:before{border-right-color: {$alternateColorLight20};}
.btDarkSkin .articleSideGutter:before,
.btLightSkin .btDarkSkin .articleSideGutter:before{border-right-color: {$alternateColorLight_9};}
.comment-respond .btnOutline.btnNormalColor button[type=\"submit\"]{font-family: {$headingFont};
    color: {$alternateColor} !important;}
.comment-respond .btnOutline.btnNormalColor:hover{
    -webkit-box-shadow: 0 0 0 2px {$alternateColor} inset,0 1px 0 transparent inset;
    box-shadow: 0 0 0 2px {$alternateColor} inset,0 1px 0 transparent inset;}
.gridItem .boldPhotoSlide .slick-arrow:hover{-webkit-box-shadow: 0 0 0 25px {$accentColor} inset;
    box-shadow: 0 0 0 25px {$accentColor} inset;}
.btSingleLatestPost .btLatestPostsDate{background: {$accentColor};}
.btSingleLatestPost .btLatestPostsDate:before{
    border-color: transparent transparent transparent {$alternateColorLight20};}
.btLightSkin .btLatestPostsDate:before,
.btDarkSkin .btLightSkin .btLatestPostsDate:before{border-left-color: {$alternateColorLight20};}
.btDarkSkin .btLatestPostsDate:before,
.btLightSkin .btDarkSkin .btLatestPostsDate:before{border-left-color: {$alternateColorLight_9};}
.fancy-select .trigger.open{
    background: {$accentColor};}
.fancy-select .options li.selected{background: {$alternateColor};}
.fancy-select .options li:hover,
.fancy-select .options li.selected:hover{background-color: {$alternateColor} !important;}
.btLightSkin .fancy-select .options li.selected,
.btDarkSkin .btLightSkin .fancy-select .options li.selected{background: {$alternateColor};}
.btLightSkin .fancy-select .options li:hover,
.btDarkSkin .btLightSkin .fancy-select .options li:hover,
.btLightSkin .fancy-select .options li.selected:hover,
.btDarkSkin .btLightSkin .fancy-select .options li.selected:hover{background-color: {$alternateColor} !important;}
.btDarkSkin .fancy-select .options li.selected,
.btLightSkin .btDarkSkin .fancy-select .options li.selected{background: {$alternateColor};}
.btDarkSkin .fancy-select .options li:hover,
.btLightSkin .btDarkSkin .fancy-select .options li:hover,
.btDarkSkin .fancy-select .options li.selected:hover,
.btLightSkin .btDarkSkin .fancy-select .options li.selected:hover{background-color: {$alternateColor} !important;}
.btDropdown .fancy-select .trigger.open{border-color: {$accentColor};}
.recentTweets small:before{
    color: {$accentColor};}
.btIco .btIcoHolder:before{color: {$accentColor};
    border: 1px solid {$accentColor};}
.btIco.white .btIcoHolder:before{
    color: {$accentColor};}
.btIco.accent .btIcoHolder:before{background-color: {$accentColor};}
.btReadMore .btIco.default .btIcoHolder:before{background: {$alternateColor};
    border-color: {$alternateColor};}
.btReadMore .btIco.default:hover .btIcoHolder:before{background: {$accentColor};
    border-color: {$accentColorLight_9};}
.btCounterHolder{font-family: {$headingFont};}
.btLightSkin .btCounterHolder,
.btDarkSkin .btLightSkin .btCounterHolder{color: {$accentColor};}
.btLightSkin .btProgressContent .btProgressAnim,
.btDarkSkin .btLightSkin .btProgressContent .btProgressAnim{background-color: {$accentColor};}
.btDarkSkin .btProgressContent .btProgressAnim,
.btLightSkin .btDarkSkin .btProgressContent .btProgressAnim{background-color: {$accentColor};}
.btPriceTable .btPriceTableHeader{background: {$accentColor};}
.btPriceTable .btPriceTableSticker{
    background: {$alternateColor};}
.header .btSuperTitle{font-family: {$headingSuperTitleFont};}
.header .btSubTitle{font-family: {$headingSubTitleFont};}
.btDash.bottomDash .dash:after,
.btDash.topDash .dash:before{
    border-bottom: 3px solid {$accentColor};}
.header.large .dash:after,
.header.large .dash:before{border-color: {$accentColor};}
.header.extralarge .dash:after,
.header.extralarge .dash:before{border-color: {$accentColor};}
.header.huge .dash:after,
.header.huge .dash:before{border-color: {$accentColor};}
.header.small.btDarkAccentDash .dash:after,
.header.medium.btDarkAccentDash .dash:after,
.header.large.btDarkAccentDash .dash:after,
.header.extralarge.btDarkAccentDash .dash:after,
.header.huge.btDarkAccentDash .dash:after,
.header.small.btDarkAccentDash .dash:before,
.header.medium.btDarkAccentDash .dash:before,
.header.large.btDarkAccentDash .dash:before,
.header.extralarge.btDarkAccentDash .dash:before,
.header.huge.btDarkAccentDash .dash:before{border-color: {$accentColorLight_9};}
.header.small.btLightAccentDash .dash:after,
.header.medium.btLightAccentDash .dash:after,
.header.large.btLightAccentDash .dash:after,
.header.extralarge.btLightAccentDash .dash:after,
.header.huge.btLightAccentDash .dash:after,
.header.small.btLightAccentDash .dash:before,
.header.medium.btLightAccentDash .dash:before,
.header.large.btLightAccentDash .dash:before,
.header.extralarge.btLightAccentDash .dash:before,
.header.huge.btLightAccentDash .dash:before{border-color: {$accentColorLight20};}
.header.small.btAlternateDash .dash:after,
.header.medium.btAlternateDash .dash:after,
.header.large.btAlternateDash .dash:after,
.header.extralarge.btAlternateDash .dash:after,
.header.huge.btAlternateDash .dash:after,
.header.small.btAlternateDash .dash:before,
.header.medium.btAlternateDash .dash:before,
.header.large.btAlternateDash .dash:before,
.header.extralarge.btAlternateDash .dash:before,
.header.huge.btAlternateDash .dash:before{border-color: {$alternateColor};}
.header.small.btDarkAlternateDash .dash:after,
.header.medium.btDarkAlternateDash .dash:after,
.header.large.btDarkAlternateDash .dash:after,
.header.extralarge.btDarkAlternateDash .dash:after,
.header.huge.btDarkAlternateDash .dash:after,
.header.small.btDarkAlternateDash .dash:before,
.header.medium.btDarkAlternateDash .dash:before,
.header.large.btDarkAlternateDash .dash:before,
.header.extralarge.btDarkAlternateDash .dash:before,
.header.huge.btDarkAlternateDash .dash:before{border-color: {$alternateColorLight_9};}
.header.small.btLightAlternateDash .dash:after,
.header.medium.btLightAlternateDash .dash:after,
.header.large.btLightAlternateDash .dash:after,
.header.extralarge.btLightAlternateDash .dash:after,
.header.huge.btLightAlternateDash .dash:after,
.header.small.btLightAlternateDash .dash:before,
.header.medium.btLightAlternateDash .dash:before,
.header.large.btLightAlternateDash .dash:before,
.header.extralarge.btLightAlternateDash .dash:before,
.header.huge.btLightAlternateDash .dash:before{border-color: {$alternateColorLight20};}
.btBtn{
    font-family: {$bodyFont};}
.btBtn.btnBorderless.btBtnAccentLight a,
.btBtn.btnBorderless.btBtnAccentLight a:before{color: {$accentColorLight20} !important;}
.btLightSkin .btBtn.btnBorderless.btBtnAccentLight a:hover,
.btLightSkin .btBtn.btnBorderless.btBtnAccentLight a:before,
.btLightSkin .btBtn.btnBorderless.btBtnAccentLight a:hover:before,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btBtnAccentLight a:hover,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btBtnAccentLight a:before,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btBtnAccentLight a:hover:before{color: {$accentColor} !important;}
.btLightSkin .btBtn.btnBorderless.btnAccentColor a:hover,
.btLightSkin .btBtn.btnBorderless.btnAccentColor a:before,
.btLightSkin .btBtn.btnBorderless.btnAccentColor a:hover:before,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btnAccentColor a:hover,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btnAccentColor a:before,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btnAccentColor a:hover:before{color: {$accentColorLight_9} !important;}
.btLightSkin .btBtn.btnBorderless.btnNormalColor a:hover,
.btLightSkin .btBtn.btnBorderless.btnNormalColor a:before,
.btLightSkin .btBtn.btnBorderless.btnNormalColor a:hover:before,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btnNormalColor a:hover,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btnNormalColor a:before,
.btDarkSkin .btLightSkin .btBtn.btnBorderless.btnNormalColor a:hover:before{color: {$alternateColorLight_9} !important;}
.btLightSkin .btnFilled.btnAccentColor,
.btLightSkin .btnOutline.btnAccentColor:hover,
.btDarkSkin .btLightSkin .btnFilled.btnAccentColor,
.btDarkSkin .btLightSkin .btnOutline.btnAccentColor:hover,
.btDarkSkin .btnFilled.btnAccentColor,
.btDarkSkin .btnOutline.btnAccentColor:hover,
.btLightSkin .btDarkSkin .btnFilled.btnAccentColor,
.btLightSkin .btDarkSkin .btnOutline.btnAccentColor:hover{background: {$accentColor};}
.btLightSkin .btnOutline.btnAccentColor,
.btDarkSkin .btLightSkin .btnOutline.btnAccentColor,
.btDarkSkin .btnOutline.btnAccentColor,
.btLightSkin .btDarkSkin .btnOutline.btnAccentColor{
    border: 2px solid {$accentColor};
    color: {$accentColor};}
.btLightSkin .btnOutline.btnAccentColor a,
.btDarkSkin .btLightSkin .btnOutline.btnAccentColor a,
.btDarkSkin .btnOutline.btnAccentColor a,
.btLightSkin .btDarkSkin .btnOutline.btnAccentColor a,
.btLightSkin .btnOutline.btnAccentColor a:before,
.btDarkSkin .btLightSkin .btnOutline.btnAccentColor a:before,
.btDarkSkin .btnOutline.btnAccentColor a:before,
.btLightSkin .btDarkSkin .btnOutline.btnAccentColor a:before,
.btLightSkin .btnOutline.btnAccentColor button,
.btDarkSkin .btLightSkin .btnOutline.btnAccentColor button,
.btDarkSkin .btnOutline.btnAccentColor button,
.btLightSkin .btDarkSkin .btnOutline.btnAccentColor button{color: {$accentColor};}
.btLightSkin .btnFilled.btnAccentColor:hover,
.btDarkSkin .btLightSkin .btnFilled.btnAccentColor:hover,
.btDarkSkin .btnFilled.btnAccentColor:hover,
.btLightSkin .btDarkSkin .btnFilled.btnAccentColor:hover{background: {$accentColorLight_9};}
.btLightSkin .btnFilled.btnNormalColor,
.btLightSkin .btnOutline.btnNormalColor:hover,
.btDarkSkin .btLightSkin .btnFilled.btnNormalColor,
.btDarkSkin .btLightSkin .btnOutline.btnNormalColor:hover,
.btDarkSkin .btnFilled.btnNormalColor,
.btDarkSkin .btnOutline.btnNormalColor:hover,
.btLightSkin .btDarkSkin .btnFilled.btnNormalColor,
.btLightSkin .btDarkSkin .btnOutline.btnNormalColor:hover{background: {$alternateColor};}
.btLightSkin .btnOutline.btnNormalColor,
.btDarkSkin .btLightSkin .btnOutline.btnNormalColor,
.btDarkSkin .btnOutline.btnNormalColor,
.btLightSkin .btDarkSkin .btnOutline.btnNormalColor{
    border: 2px solid {$alternateColor};
    color: {$alternateColor};}
.btLightSkin .btnOutline.btnNormalColor a,
.btDarkSkin .btLightSkin .btnOutline.btnNormalColor a,
.btDarkSkin .btnOutline.btnNormalColor a,
.btLightSkin .btDarkSkin .btnOutline.btnNormalColor a,
.btLightSkin .btnOutline.btnNormalColor a:before,
.btDarkSkin .btLightSkin .btnOutline.btnNormalColor a:before,
.btDarkSkin .btnOutline.btnNormalColor a:before,
.btLightSkin .btDarkSkin .btnOutline.btnNormalColor a:before,
.btLightSkin .btnOutline.btnNormalColor button,
.btDarkSkin .btLightSkin .btnOutline.btnNormalColor button,
.btDarkSkin .btnOutline.btnNormalColor button,
.btLightSkin .btDarkSkin .btnOutline.btnNormalColor button{color: {$alternateColor};}
.btLightSkin .btnFilled.btnNormalColor:hover,
.btDarkSkin .btLightSkin .btnFilled.btnNormalColor:hover,
.btDarkSkin .btnFilled.btnNormalColor:hover,
.btLightSkin .btDarkSkin .btnFilled.btnNormalColor:hover{background: {$alternateColorLight_9};}
.btLightSkin .gridItem .btGridContent .btSuperTitle a:hover,
.btDarkSkin .btLightSkin .gridItem .btGridContent .btSuperTitle a:hover{color: {$alternateColor};}
.btDarkSkin .gridItem .btGridContent .btSuperTitle a:hover,
.btLightSkin .btDarkSkin .gridItem .btGridContent .btSuperTitle a:hover{color: {$alternateColor};}
.btCatFilter .btCatFilterItem{
    color: {$accentColor};}
.btCatFilter .btCatFilterItem:hover{color: {$alternateColor};
    border-bottom-color: {$alternateColor};}
.btCatFilter .btCatFilterItem:hover:after{background: {$alternateColor};}
.btMediaBox blockquote{
    background-color: {$accentColor};}
.btMediaBox.btLink{
    background-color: {$accentColor};}
.btMediaBox blockquote{background-color: {$accentColor};}
.nbsImgHolder{
    border: 3px solid {$accentColor};}
span.nbsDir{
    color: {$alternateColor};}
.btLightSkin span.nbsTitle,
.btDarkSkin .btLightSkin span.nbsTitle{color: {$accentColor};}
.slided .slick-dots li button:hover,
.slided .slick-dots li.slick-active button:hover{border-color: {$alternateColor};}
.slided .slick-dots li.slick-active button{border-color: {$accentColor};}
.btLightSkin .btTestimonialsSlider .slidedItem .btSliderPort .btSliderCell .header .btSubTitle,
.btDarkSkin .btLightSkin .btTestimonialsSlider .slidedItem .btSliderPort .btSliderCell .header .btSubTitle{color: {$alternateColor};}
.btLightSkin .btTestimonialsSlider .slidedItem .btSliderPort .btSliderCell .btCircleImage,
.btDarkSkin .btLightSkin .btTestimonialsSlider .slidedItem .btSliderPort .btSliderCell .btCircleImage{border-color: {$alternateColor};}
.btLightSkin .btTestimonialsSlider .slidedItem .btSliderPort .btSliderCell .btSliderPort .btCircleImage .btImage,
.btDarkSkin .btLightSkin .btTestimonialsSlider .slidedItem .btSliderPort .btSliderCell .btSliderPort .btCircleImage .btImage{border-color: {$alternateColor};}
.btInfoBarMeta p strong{color: {$accentColor};}
.tabsHeader li.on{
    color: {$accentColor};}
.btLightSkin .tabsHeader li.on,
.btDarkSkin .btLightSkin .tabsHeader li.on{color: {$accentColor};}
.btDarkSkin .tabsHeader li.on,
.btLightSkin .btDarkSkin .tabsHeader li.on{color: {$accentColor};}
.btLightSkin .tabsHeader li:not(on):hover,
.btDarkSkin .btLightSkin .tabsHeader li:not(on):hover{color: {$accentColor};
    border-bottom-color: {$accentColor};}
.btDarkSkin .tabsHeader li:not(on):hover,
.btLightSkin .btDarkSkin .tabsHeader li:not(on):hover{color: {$accentColor};
    border-bottom-color: {$accentColor};}
.tabsVertical .tabAccordionTitle:hover{color: {$accentColor};}
.btLightSkin .tabAccordionTitle.on,
.btDarkSkin .btLightSkin .tabAccordionTitle.on{
    color: {$accentColor};}
.btDarkSkin .tabAccordionTitle.on,
.btLightSkin .btDarkSkin .tabAccordionTitle.on{
    color: {$accentColor};}
.btLightSkin .btLatestPostsContainer .btSingleLatestPostContent .header.small h4 a:hover,
.btDarkSkin .btLightSkin .btLatestPostsContainer .btSingleLatestPostContent .header.small h4 a:hover{color: {$accentColor};}
.btDarkSkin .btLatestPostsContainer .btSingleLatestPostContent .header.small h4 a:hover,
.btLightSkin .btDarkSkin .btLatestPostsContainer .btSingleLatestPostContent .header.small h4 a:hover{color: {$accentColor};}
.btCustomMenu{
    font-family: {$menuFont};}
.btCustomMenu ul li a{
    -webkit-box-shadow: 0 0 0 {$accentColor} inset;
    box-shadow: 0 0 0 {$accentColor} inset;}
.btCustomMenu ul li a:hover{
    -webkit-box-shadow: -5px 0 0 {$accentColor} inset;
    box-shadow: -5px 0 0 {$accentColor} inset;}
.btCustomMenu ul li .customSubToggler a.btIcoHolder:before{
    color: {$alternateColor};}
.btCustomMenu ul li.current-menu-item > a{color: {$accentColor};}
.btLightSkin .wpcf7-submit,
.btDarkSkin .btLightSkin .wpcf7-submit,
.btDarkSkin .wpcf7-submit,
.btLightSkin .btDarkSkin .wpcf7-submit{background: {$accentColor};}
.btLightSkin .wpcf7-submit:hover,
.btDarkSkin .btLightSkin .wpcf7-submit:hover,
.btDarkSkin .wpcf7-submit:hover,
.btLightSkin .btDarkSkin .wpcf7-submit:hover{
    color: {$accentColor};}
.btQuoteBooking .btQuoteSwitch.on .btQuoteSwitchInner,
.btQuoteBooking .ui-slider .ui-slider-handle,
.btQuoteBooking .btQuoteBookingForm .btQuoteTotal,
.btDatePicker .ui-datepicker-header,
.btQuoteBooking .btContactSubmit{background: {$accentColor};}
.btQuoteBooking .btContactNext{border-color: {$accentColor};}
.btQuoteBooking .btQuoteSwitch:hover{-webkit-box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking input[type=\"text\"]:hover,
.btQuoteBooking input[type=\"email\"]:hover,
.btQuoteBooking input[type=\"password\"]:hover,
.btQuoteBooking textarea:hover,
.btQuoteBooking .fancy-select .trigger:hover{-webkit-box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .dd.ddcommon.borderRadius:hover .ddTitleText{-webkit-box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking input[type=\"text\"]:focus,
.btQuoteBooking input[type=\"email\"]:focus,
.btQuoteBooking textarea:focus,
.btQuoteBooking .fancy-select .trigger.open{-webkit-box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);
    box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);}
.btQuoteBooking .dd.ddcommon.borderRadiusTp .ddTitleText,
.btQuoteBooking .dd.ddcommon.borderRadiusBtm .ddTitleText{-webkit-box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);
    box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory input:hover,
.btQuoteBooking .btContactFieldMandatory textarea:hover{-webkit-box-shadow: 0 0 0 1px #AAA inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px #AAA inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory .dd.ddcommon.borderRadius:hover .ddTitleText{-webkit-box-shadow: 0 0 0 1px #AAA inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px #AAA inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory input:focus,
.btQuoteBooking .btContactFieldMandatory textarea:focus{-webkit-box-shadow: 0 0 0 1px #AAA inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px #AAA inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory .dd.ddcommon.borderRadiusTp .ddTitleText{-webkit-box-shadow: 0 0 0 1px #AAA inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px #AAA inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea{border: 1px solid {$accentColor};
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius .ddTitleText{border: 1px solid {$accentColor};
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input:hover,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:hover{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius:hover .ddTitleText{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btPayPalButton:hover{-webkit-box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input,
.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input,
.btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea,
.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea{border-color: {$accentColor};}
.btQuoteBooking .btContactNext{background: {$accentColor};
    border: 1px solid {$accentColor};
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset,0 1px 0 transparent inset;
    box-shadow: 0 0 0 1px {$accentColor} inset,0 1px 0 transparent inset;}
.btQuoteBooking .btContactNext:hover{background: {$accentColorLight_9};
    border: 1px solid {$accentColorLight_9};
    -webkit-box-shadow: 0 0 0 1px transparent inset,0 1px 0 {$accentColorLight_9} inset;
    box-shadow: 0 0 0 1px transparent inset,0 1px 0 {$accentColorLight_9} inset;}
.btQuoteBooking .btContactSubmit{background: {$accentColor};
    border: 1px solid {$accentColor};
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset,0 1px 0 transparent inset;
    box-shadow: 0 0 0 1px {$accentColor} inset,0 1px 0 transparent inset;}
.btQuoteBooking .btContactSubmit:hover{background: {$accentColorLight_9};
    border: 1px solid {$accentColorLight_9};
    -webkit-box-shadow: 0 0 0 1px transparent inset,0 1px 0 {$accentColorLight_9} inset;
    box-shadow: 0 0 0 1px transparent inset,0 1px 0 {$accentColorLight_9} inset;}
.wp-block-button__link:hover{color: {$accentColor} !important;}
", array() );