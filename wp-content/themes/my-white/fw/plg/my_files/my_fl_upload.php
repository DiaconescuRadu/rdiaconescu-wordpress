<?php
class my_fl_upload
{
    static $first_run = true;
    static $error = '';
    
    function run( $size = 'full' )
    {
        
        if( self::$first_run  )
            self::$first_run = false;
        else
            return null;
        
        $upload_box = array(
            'title' => __( 'File uploader' , 'myThemes' ),
            'boxID' => 'my-uploader-box'
        );
        
        $param = '&size=' . $size;
        
        $rett  = '<iframe id="my-fl-upload-box" src="' . admin_url( '/admin-ajax.php?action=my_fl_upload' . $param ) . '" scrolling="auto" height="400" width="700">';
        $rett .= '</iframe>';
        
        echo ahtml::_popBoxHook( $upload_box , $rett );
    }
    
    function save( $name )
    {   
        if( !isset( $_FILES ) || empty( $_FILES ) )
            return 0;

        /* UPLOAD ERRORS */
        if( !isset( $_FILES[ $name ] ) || empty( $_FILES[ $name ] ) )
            return -1;

        $upload = $_FILES[ $name ];

        if ( !is_array( $upload ) )
            return -1;

        if ( $upload[ 'error' ] > 0 )
            return -1;

        /* NORMAL UPLOAD */
        $filetmp = $upload['tmp_name'];
        $filename = $upload['name'];

        /* GET FILE INFO */
        /* WP CHECKS THE FILE EXTENSION */
        $filetype = pathinfo( $filename );
        $upload_dir = wp_upload_dir();

        if( !in_array( $filetype[ 'extension' ] , array( 'ico' , 'png' , 'jpg' , 'jpeg' , 'gif' , 'bmp' , 'zip' , 'rar' , 'mp3' , 'avi' , 'mpeg' ) ) ){
            self::$error = __( "Undefined file type  : " , 'myThemes' ) . '*.' . $filetype[ 'extension' ];
            return -1;
        }
        /* IF FILE EXISTS RENAME FILE */
        $i = 0;
        while ( file_exists( $upload_dir[ 'path' ] . '/' . $filename ) ) {
            $filename = $filetype[ 'filename' ] . '_' . $i . '.' . $filetype[ 'extension' ];
            $i++;
        }
        $filedest = $upload_dir[ 'path' ] . '/' . $filename;

        /* CHECK WRITE PERMISSIONS */
        if ( !is_writeable( $upload_dir[ 'path' ] ) ) {
            self::$error = __( 'Unable to write to directory %s. Is this directory writable by the server?' , 'myThemes' );
            return -1;
        }

        /* SAVE TEMPORARY FILE TO UPLOADS DIR */
        if ( !@move_uploaded_file($filetmp, $filedest) ){
            self::$error = __( "Error, the file could not moved to : " , 'myThemes' ) . $filedest;
            return -1;
        }

        $attachment = array(
            'post_mime_type' => $upload[ 'type' ],
            'post_title' => $filename,
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment( $attachment , $filedest );
        require_once( get_theme_root() . '/../../wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id , $filedest );
        wp_update_attachment_metadata( $attach_id , $attach_data );

        return $attach_id;
    }
    
    function uploadPanel(){
        
        global $content_width;
        $content_width = 1000;
        
        $name = 'my-file-uploader';
        
        if( isset( $_REQUEST[ 'size' ] ) && !empty( $_REQUEST[ 'size' ] ) ){
            $size = $_REQUEST[ 'size' ];
        }else{
            $size = 'full';
        }
        
        $iud = self::save( $name );

        $rett  = '<form method="post" action="' . $_SERVER[ 'REQUEST_URI' ] . '" enctype="multipart/form-data">';
        $rett .= '<input type="file" name="' . $name . '">';
        $rett .= '<input type="submit" value="' . __( 'Upload' , 'myThemes' ) . '">';
        $rett .= '</form>';
        
        if( $iud > 0 ){
            $rett .= '<div class="my-file-uploaded">';
            $data  = wp_get_attachment_url( $iud );
            $rett .= wp_get_attachment_url( $iud );
            $rett .= '<br/>';
            $rett .= '<input type="hidden" id="my-file-id" value="' . $iud . '">';
            $rett .= '<input type="hidden" id="my-file-src" value="' . $data . '">';
            $rett .= '<input type="button" value="' . __( 'Use attached file' , 'myThemes' ) . '">';
            $rett .= '</div>';
        }else if( $iud < 0 ){
            $rett .= '<div class="my-file-uploaded">';
            $rett .= __( 'Upload error, try again.' , 'myThemes' );
            $rett .= '<br/>';
            $rett .= self::$error;
            $rett .= '<br/>';
            $rett .= '<input type="hidden" id="my-file-id" value="">';
            $rett .= '<input type="hidden" id="my-file-src" value="">';
            $rett .= '<input type="button" value="' . __( 'Use attached file' , 'myThemes' ) . '" >';
            $rett .= '</div>';
        }else{
            $rett .= '<div class="my-file-uploaded">';
            $rett .= '<input type="hidden" id="my-file-id" value="">';
            $rett .= '<input type="hidden" id="my-file-src" value="">';
            $rett .= '<input type="button" value="' . __( 'Use attached file' , 'myThemes' ) . '" style="display:none;">';
            $rett .= '</div>';
        }
        
        echo $rett;
        exit();
    }
}
?>