<form action="<?php echo home_url()?>/" method="get" id="searchform">
    <fieldset>
        <div id="searchbox">
            <input class="input" name="s" type="text" id="keywords" value="<?php _e( 'type here...' , 'myThemes' ); ?>" onfocus="if (this.value == '<?php _e( 'type here...' , 'myThemes' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'type here...' , 'myThemes' ); ?>';}"/>
            <input type="submit" class="mytheme-bkg mytheme-bkg-dark-hover" value="">
        </div>
    </fieldset>
</form>