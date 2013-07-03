<?php
/**
 * The template for displaying search forms.
 *
 * @file      searchform.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
?>
 
<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<input class="searchfield" type="text" value="<?php _e('Search', 'curiosity');?>" name="s" id="s" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" />
</form>
