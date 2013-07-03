<!-- search -->
<form action="<?php echo home_url(); ?>" method="get" role="search" class="searchform">
    <input type="search" onblur="if (this.value == '') {this.value = '<?php _e( 'Search in site', 'otw-carbon-light'); ?>';}" onfocus="if (this.value == '<?php _e( 'Search in site', 'otw-carbon-light'); ?>') {this.value = '';}" value="<?php _e( 'Search in site', 'otw-carbon-light' ); ?>" name="s" class="search-input">
    <input type="submit" title="<?php _e( 'Search', 'otw-carbon-light' ); ?>" name="submit" class="search-submit" value="<?php _e( 'Search', 'otw-carbon-light' ); ?>" role="button">
</form>
<!-- /search -->