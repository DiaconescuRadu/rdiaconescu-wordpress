<?php
/*
Plugin Name: Andrei Pana's Picasa Photos
Plugin URI: www.andreipana.net/wp/picasaphotos
Description: Picasa Photos extends the wordpress media dialog allowing the user to insert photos from Picasa.
Version: 0.1.0
Author: Andrei Pana
Author URI: www.andreipana.net
License: GPL2
*/

function picasa_photos_media_upload_tab_name( $tabs ) {
    $newtab = array( 'tab_slug' => 'Insert from Picasa' );
    return array_merge( $tabs, $newtab );
}

add_filter( 'media_upload_tabs', 'picasa_photos_media_upload_tab_name' );
add_action( 'media_upload_tab_slug', 'custom_media_upload_tab_content' );

function custom_media_upload_tab_content() {

?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo(plugins_url('/picasa-photos.js', __FILE__));?>"></script>
    <link rel=StyleSheet href="<?php echo(plugins_url('/picasa-photos.css', __FILE__));?>" type="text/css" />

    <div id="DivAlbums">
        <div id="DivUser" style="font-family: sans-serif; margin-left: 10px;">
            <span>Picasa account:</span>
            <input type="text" id="UserName" onkeypress="return UserName_OnKeyPress(event)" />
            <button onclick="OnGetAlbums();">Get Albums</button>
        </div>
        <div id="DivAlbums2" style="display: none;">
            <h1 style="font-family: sans-serif; font-size: 22px; font-weight: 200; margin-left: 10px;">Select Album</h1>
            <div id="DivAlbumsContainer"></div>
        </div>
    </div>

    <div id="DivImages" style="display: none;">
        
        <h1 style="font-family: sans-serif; font-size: 22px; font-weight: 200; margin-left: 10px; margin-bottom: 0px;">
            <span id="SpanAlbumTitle"></span>
        </h1>
        <div style="font-family: arial, sans-serif; margin-left: 8px; margin-bottom: 8px;">
            <a id="BackToAlbumsButton" href="javascript:void(0);" >Back to Albums</a>
            <span>|</span>
            <a id="InsertAllImagesButton" href="javascript:void(0);" >Insert All</a>
            <span id="NumberOfImagesSpan"></span>
        </div>
        <div id="DivImagesContainer"></div>
    </div>
<?php
}
?>