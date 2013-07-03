<?php
/*Custom CSS*/
if(!empty($jaguza_data['jaguza_custom_css'])){
	echo esc_html($jaguza_data['jaguza_custom_css']);
}

/*Sidebar position*/
if(!empty($jaguza_data['jaguza_sidebar_position']) && $jaguza_data['jaguza_sidebar_position']=='Left' ) { echo '.site-content{ border-left: 1px solid #DDDDDD; border-right: 0 none; float: right; padding-left: 1.5rem;  padding-right: 0;}';}
if(!empty($jaguza_data['jaguza_sidebar_position']) && $jaguza_data['jaguza_sidebar_position']=='None' ) { echo '.site-content {border-left: 0 none;	border-right: 0 none;		float: right;	padding-left: 1.5rem;	padding-right: 0;	width: 98%; max-width: 98%;}.jaguza #secondary{ display: none;}';}

/*Logo*/
if(!empty($jaguza_data['jaguza_logo_left_margin'])) { echo '.site-title{margin-left:'.$jaguza_data['jaguza_logo_left_margin'].';}'; }
if(!empty($jaguza_data['jaguza_logo_bottom_margin'])) { echo '.site-title{margin-bottom:'.$jaguza_data['jaguza_logo_bottom_margin'].';}'; }
if(!empty($jaguza_data['jaguza_logo_top_margin'])) { echo '.site-title{margin-top:'.$jaguza_data['jaguza_logo_top_margin'].';}'; }

/*Social Icons*/
if(isset($jaguza_data['jaguza_show_social_icons']) && $jaguza_data['jaguza_show_social_icons'] == 1 && isset($jaguza_data['jaguza_social_icons_position']) && $jaguza_data['jaguza_social_icons_position'] == "Right") { echo '.jaguza #floating_social_sidebar{ left: auto; right: 0;-webkit-border-radius: 6px 0 0 6px;  -moz-border-radius: 6px 0 0 6px;border-radius: 6px 0 0 6px;  }'; }

/*Slider*/
if(isset($jaguza_data['jaguza_slider_item_img_FullWidth']) && $jaguza_data['jaguza_slider_item_img_FullWidth'] == 1) { echo '.jaguza #jaguza-home-slider .slides img{height: 380px; max-width: 980px;left: -1rem;position: absolute;top: -3rem;}.jaguza #jaguza-home-slider .main-slider-text{background-color: #000;opacity: 0.8; position: absolute; left: -1rem; top: 25px; padding: 1rem;}.jaguza #jaguza-home-slider span.read-more a{bottom: 7px; left: 14px;}.jaguza #jaguza-home-slider ul.slides{color: #FDFDFD;}'; }
if(isset($jaguza_data['jaguza_enable_slider']) && $jaguza_data['jaguza_enable_slider'] == 0) {echo '.jaguza #jaguza_slider_strip{display: none;}.jaguza #jaguza_homepageblocks_strip{padding-top: 0;}';}
 

/*Theme color*/
if(isset($jaguza_data['jaguza_theme_color']) || isset($jaguza_data['jaguza_theme_color_custom']))  {
	switch($jaguza_data['jaguza_theme_color']){
		case 'Blue':
		$themeColor = '#2d5c88';
		break;
		case 'Brown':
		$themeColor = '#ab8b65';
		break;;
		case 'Cyan':
		$themeColor = '#2997ab';
		break;
		case 'GoldenRod':
		$themeColor = '#DAA520';
		break;
		case 'Green':
		$themeColor = '#a0ce4e';
		break;
		case 'Light Blue':
		$themeColor = '#8bbbe0';
		break;
		case 'Light Green':
		$themeColor = '#8eccb3';
		break;
		case 'Orange':
		$themeColor = '#D95B44'; 
		break;
		case 'Pink':
		$themeColor = '#e44884';
		break;
		case 'Purple':
		$themeColor = '#9932CC';
		break;	case 'Red':
		$themeColor = '#a81010';
		break;
		case 'Royal Blue':
		$themeColor = '#4169E1';
		break;
		
	}//endswitch
	/*If the custom theme color is set, it takes precedence*/
	$themeColor = (isset($jaguza_data['jaguza_theme_color_custom']) ? $jaguza_data['jaguza_theme_color_custom'] : $themeColor); 
	echo '.jaguza a,.jaguza .site-content article .entry-content span.read-more a:hover,.jaguza #jaguza_breadcrumbs a,.jaguza .site-header h1 a, .site-header h2 a,.jaguza .widget-area .widget a,.jaguza footer.jaguza_footer a {color:'.$themeColor.';}.jaguza .site-content article footer .the_date,.jaguza #floating_social_sidebar,.jaguza #jaguza-home-slider .read-more a,.jaguza #jaguza-home-slider  .flex-control-paging li a.flex-active {background-color:'.$themeColor.';}.jaguza .main-navigation li a:hover,.jaguza .main-navigation .current-menu-item > a,.jaguza .main-navigation .current-menu-ancestor > a,.jaguza .main-navigation .current_page_item > a,.jaguza .main-navigation .current_page_ancestor > a {border-bottom:4px solid '.$themeColor.';}.jaguza .menu-toggle,.jaguza button,.jaguza input[type="submit"], .jaguza input[type="button"],.jaguza input[type="reset"],.jaguza .reply,.jaguza .pagination .current{background:'.$themeColor.';}';
}

/*----------------------  FONTS --------------------------*/
/*Body Fonts*/
if(isset($jaguza_data['jaguza_body_typography']['face'])){ echo 'body.jaguza{font-family:"'.$jaguza_data['jaguza_body_typography']['face'].'","Open Sans",Helvetica,Arial,sans-serif;}';}
if(isset($jaguza_data['jaguza_body_typography']['size'])) { echo 'body.jaguza{font-size:'.$jaguza_data['jaguza_body_typography']['size'].';}'; }
if(isset($jaguza_data['jaguza_body_typography']['style'])) { echo 'body.jaguza{font-style:'.$jaguza_data['jaguza_body_typography']['style'].';}'; }
if(isset($jaguza_data['jaguza_body_typography']['color'])) { echo 'body.jaguza{color:'.$jaguza_data['jaguza_body_typography']['color'].';}'; }

/*Menu Fonts*/
if(isset($jaguza_data['jaguza_menu_typography']['face'])){ echo 'body.jaguza .main-navigation{font-family:"'.$jaguza_data['jaguza_menu_typography']['face'].'","Open Sans",Helvetica,Arial,sans-serif;}';}
if(isset($jaguza_data['jaguza_menu_typography']['size'])) { echo 'body.jaguza .main-navigation ul li a{font-size:'.$jaguza_data['jaguza_menu_typography']['size'].';}'; }
if(isset($jaguza_data['jaguza_menu_typography']['style'])) { echo 'body.jaguza .main-navigation ul li a{font-style:'.$jaguza_data['jaguza_menu_typography']['style'].';}'; }
if(isset($jaguza_data['jaguza_menu_typography']['color'])) { echo 'body.jaguza .main-navigation ul li a{color:'.$jaguza_data['jaguza_menu_typography']['color'].';}'; }


/*Breadcrumbs Fonts*/
if(isset($jaguza_data['jaguza_breadcrumbs_typography']['face'])){ echo 'body.jaguza #jaguza_breadcrumbs{font-family:"'.$jaguza_data['jaguza_breadcrumbs_typography']['face'].'","Open Sans",Helvetica,Arial,sans-serif;}';}
if(isset($jaguza_data['jaguza_breadcrumbs_typography']['size'])) { echo 'body.jaguza #jaguza_breadcrumbs{font-size:'.$jaguza_data['jaguza_breadcrumbs_typography']['size'].';}'; }
if(isset($jaguza_data['jaguza_breadcrumbs_typography']['style'])) { echo 'body.jaguza #jaguza_breadcrumbs{font-style:'.$jaguza_data['jaguza_breadcrumbs_typography']['style'].';}'; }
if(isset($jaguza_data['jaguza_breadcrumbs_typography']['color'])) { echo 'body.jaguza #jaguza_breadcrumbs{color:'.$jaguza_data['jaguza_breadcrumbs_typography']['color'].';}'; }


/*Footer Fonts*/
if(isset($jaguza_data['jaguza_footer_typography']['face'])){ echo 'body.jaguza footer.jaguza_footer{font-family:"'.$jaguza_data['jaguza_footer_typography']['face'].'","Open Sans",Helvetica,Arial,sans-serif;}';}
if(isset($jaguza_data['jaguza_footer_typography']['size'])) { echo 'body.jaguza footer.jaguza_footer{font-size:'.$jaguza_data['jaguza_footer_typography']['size'].';}'; }
if(isset($jaguza_data['jaguza_footer_typography']['style'])) { echo 'body.jaguza footer.jaguza_footer{font-style:'.$jaguza_data['jaguza_footer_typography']['style'].';}'; }
if(isset($jaguza_data['jaguza_footer_typography']['color'])) { echo 'body.jaguza footer.jaguza_footer{color:'.$jaguza_data['jaguza_footer_typography']['color'].';}'; }

/*Link Color*/
if(isset($jaguza_data['jaguza_link_color'])) { echo 'body.jaguza a{color:'.$jaguza_data['jaguza_link_color'].';}'; }

/*Headings*/
if(isset($jaguza_data['jaguza_headings_typography']['face'])){ echo 'body.jaguza h1,body.jaguza h2,body.jaguza h3,body.jaguza h4,body.jaguza h5,body.jaguza h6{font-family:"'.$jaguza_data['jaguza_headings_typography']['face'].'","Open Sans",Helvetica,Arial,sans-serif;}';}
if(isset($jaguza_data['jaguza_headings_typography']['style'])) { echo 'body.jaguza h1,body.jaguza h2,body.jaguza h3,body.jaguza h4,body.jaguza h5,body.jaguza h6{font-style:'.$jaguza_data['jaguza_headings_typography']['style'].';}'; }
if(isset($jaguza_data['jaguza_headings_typography']['color'])) { echo 'body.jaguza h1,body.jaguza h2,body.jaguza h3,body.jaguza h4,body.jaguza h5,body.jaguza h6{color:'.$jaguza_data['jaguza_headings_typography']['color'].';}'; }

/*H1-H6 Font Sizes*/
if(isset($jaguza_data['jaguza_headings_font_size_h1']['size'])) { echo 'body.jaguza h1{font-size:'.$jaguza_data['jaguza_headings_font_size_h1']['size'].';}'; }
if(isset($jaguza_data['jaguza_headings_font_size_h2']['size'])) { echo 'body.jaguza h2{font-size:'.$jaguza_data['jaguza_headings_font_size_h2']['size'].';}'; }
if(isset($jaguza_data['jaguza_headings_font_size_h3']['size'])) { echo 'body.jaguza h3{font-size:'.$jaguza_data['jaguza_headings_font_size_h3']['size'].';}'; }
if(isset($jaguza_data['jaguza_headings_font_size_h4']['size'])) { echo 'body.jaguza h4{font-size:'.$jaguza_data['jaguza_headings_font_size_h4']['size'].';}'; }
if(isset($jaguza_data['jaguza_headings_font_size_h5']['size'])) { echo 'body.jaguza h5{font-size:'.$jaguza_data['jaguza_headings_font_size_h5']['size'].';}'; }
if(isset($jaguza_data['jaguza_headings_font_size_h6']['size'])) { echo 'body.jaguza h6{font-size:'.$jaguza_data['jaguza_headings_font_size_h6']['size'].';}'; }

?>