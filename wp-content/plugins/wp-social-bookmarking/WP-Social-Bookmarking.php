<?php
/*
Plugin Name: WP Social Bookmarking
Plugin URI: http://www.premiumresponsive.com/wordpress-plugins/
Description: Plugin to help people share and bookmark your posts on Facebook, Pinterest, Google+, Twitter, Myspace, Friendfeed, Technorati, del.icio.us, Digg, Google,  StumbleUpon.
Version: 3.5
Author: A. Kilius
Author URI: http://www.premiumresponsive.com/wordpress-plugins/
*/
 
register_activation_hook( __FILE__, 'wp_social_activate' );
add_action('admin_menu', 'wp_social_menu');

function wp_social_menu() {
 add_menu_page('WP Social Bookmarking', 'Social Bookmarking', 8, __FILE__, 'wp_social_options');
}

function wp_social_activate() {
	update_option('wp_social_ico', '24px');	
}

function WP_Social_Bookmarking($content) {
    global $post;
	$pldir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); 
$images = $pldir.'images/';
	$post_link = get_permalink($post->ID);	
	$post_link = get_permalink($post->ID);	
    $lang = get_bloginfo('language'); 
	$post_l =  base64_encode( $post_link );	
    $post_title = get_the_title($post->ID);
	$post_tweet = site_url().'/?p='.$post->ID;
    $img_var =  get_option('wp_social_ico');   //"30px";

	if ( is_single()) {
if($img_var == '30px') $gplus	= '';
if($img_var == '24px') $gplus	= '';
if($img_var == '20px') $gplus	= 'size="medium"';
if($img_var == '16px') $gplus	= 'size="small"';
 
		$content .= '<!-- Begin WP-Social-Bookmarking -->' . "\n";
		$content .= '<div class="WP-Social-Bookmarking"> ' . "\n"  
. '<a href="http://www.websitepin.com/?f='.$post_l.'&l='.$lang.'" target="_blank" title="Article Global"><img src="' . $images . 'onlinerel.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Article Global" title="Article Global" /></a>' . "\n"
. '<a href="http://facebook.com/sharer.php?u=' . $post_link . '&amp;t=' . $post_title . '" target="_blank" rel="nofollow" title="Facebook"><img src="' . $images . 'facebook.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Facebook" title="Facebook" /></a>' . "\n"
 . '<a data-pin-config="none" href="//pinterest.com/pin/create/button/?url='.$urlp.'&media='.$image.'&description='.$post_title.'" data-pin-do="buttonPin" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a><script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>' . "\n"	
 . ' <!-- G +1 button --> <g:plusone  '.$gplus.'  annotation="none"></g:plusone>' . "\n"				 
 . '<a href="http://twitter.com/home?status=' . $post_tweet . '  ' . $post_title . '" target="_blank" rel="nofollow" title="Twitter"><img src="' . $images . 'twitter.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Twitter" title="Twitter" /></a>' . "\n"
 . '<a href="http://www.myspace.com/Modules/PostTo/Pages/?c=' . $post_link . '&t=' . $post_title . '" target="_blank" rel="nofollow" title="Myspace"><img src="' . $images . 'myspace.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Myspace" title="Myspace" /></a>' . "\n"				 
 . '<a href="http://friendfeed.com/share?url=' . $post_link . '&title=' . $post_title . '" target="_blank" rel="nofollow" title="Friendfeed"><img src="' . $images . 'friendfeed.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Friendfeed" title="Friendfeed" /></a>' . "\n"
 . '<a href="http://www.technorati.com/faves?add=' . $post_link . '" target="_blank" rel="nofollow" title="Technorati"><img src="' . $images . 'technorati.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Technorati" title="Technorati" /></a>' . "\n"
. '<a href="http://del.icio.us/post?url=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="del.icio.us"><img src="' . $images . 'delicious.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="del.icio.us" title="del.icio.us" /></a>' . "\n"
 . '<a href="http://digg.com/submit?phase=2&amp;url=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="Digg"><img src="' . $images . 'digg.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Digg" title="Digg" /></a>' . "\n"         
 . '<a href="http://google.com/bookmarks/mark?op=add&amp;bkmk=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="Google"><img src="' . $images . 'google.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Google" title="Google" /></a>' . "\n"
 . '<a href="http://stumbleupon.com/submit?url=' . $post_link . '&amp;title=' . $post_title . '&amp;newcomment=' . $post_title . '" target="_blank" rel="nofollow" title="StumbleUpon"><img src="' . $images . 'stumbleupon.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="StumbleUpon" title="StumbleUpon" /></a>' . "\n"
. '<a href="http://www.premiumresponsive.com/?f='.$post_l.'&l='.$lang.'" target="_blank" title="Eli Pets"><img src="' . $images . 'elipets.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Eli Pets" title="Eli Pets" /></a>' . "\n"           
. '</div><br /> 
<!-- G+ script --> <script type="text/javascript">
  (function() {
    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
    po.src = \'https://apis.google.com/js/plusone.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
 <!-- End WP-Social-Bookmarking -->' . "\n\n";				  
    }				  
	return $content;
}

function SetStyle() {
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.plugins_url().'/wp-social-bookmarking/style.css">';
}
add_filter("plugin_action_links", 'WP_Social_Bookmarking_ActionLink', 10, 2);

function WP_Social_Bookmarking_ActionLink( $links, $file ) {
	    static $this_plugin;		
		if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__); 
        if ( $file == $this_plugin ) {
			$settings_link = "<a href='".admin_url( "options-general.php?page=".$this_plugin )."'>". __('Settings') ."</a>";
			array_unshift( $links, $settings_link );
		}
		return $links;
	}

function wp_social_options() {	
	if(isset($_POST['b_update'])) {
		if(!empty($_POST['wp_social_ico'])) {
			update_option('wp_social_ico', $_POST['wp_social_ico']);
		}
	echo "<div class='updated fade'><p><strong>Options saved</strong></p></div>";
	}
	?>
	<div class="wrap">
		<h2>WP Social Bookmarking  Settings </h2>
		<form method="post" action="#">
	 			<table class="form-table">
	 <th scope="row"> Change Icon Size </th>
					<td>
						<select name="wp_social_ico">
							<option value="24px" <?php echo get_option('wp_social_ico') == '24px'?'selected':'';?>>24x24px (Big)</option>
							<option value="20px" <?php echo get_option('wp_social_ico') == '20px'?'selected':'';?>>20x20px</option>
							<option value="16px" <?php echo get_option('wp_social_ico') == '16px'?'selected':'';?>>16x16px (Small)</option>
						</select>
					</td> 	</tr>	</table>
			<p class="submit">
				<input type="submit" name="b_update" class="button-primary" value="  Save Changes  " />
			</p>
		</form>
<hr />
<p><b>WP-Social-Bookmarking plugin will add a image below your posts, allowing your visitors to share your posts with their friends, on FaceBook,Pinterest, Google+, Twitter, Myspace, Friendfeed, Technorati, del.icio.us, Digg,  StumbleUpon and other.
<br /> 
<a href="http://www.premiumresponsive.com/wordpress-plugins/" target="_blank">See Other Plugins</a></b></p>
 
	<?php
}
add_action('wp_head', 'SetStyle');
add_filter('the_content', 'WP_Social_Bookmarking', 30);
                                                           
?>