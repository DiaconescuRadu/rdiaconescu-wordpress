<?php
    class tools
    {
        function getPageSlug( $sett )
        {
            return isset( $sett[ 'pageSlug' ] ) && !empty( $sett[ 'pageSlug' ] ) ? $sett[ 'pageSlug' ] : '';
        }

        function getFieldName( $sett )
        {
            return isset( $sett[ 'fieldName' ] ) && !empty( $sett[ 'fieldName' ] ) ? $sett[ 'fieldName' ] : '';
        }
        
        function getInputName( $sett , $attr = false )
        {
            /* SET PAGE SLUG */
            $pageSlug = self::getPageSlug( $sett );

            /* SET FIELD NAME */
            $fieldName = self::getFieldName( $sett );
            
            if( !$attr ){
                if( isset( $sett[ 'type' ][ 'metabox' ] ) ) {
                    return !empty( $fieldName ) ? 'mythemes-' . $fieldName : '';
                }
                else{
                    return !empty( $fieldName ) ? 'mythemes-' . $fieldName : '';
                }
            }
            else{
                if( isset( $sett[ 'type' ][ 'multiple' ] ) ) {
                    return !empty( $fieldName ) ? 'name="mythemes-' . $fieldName . '"' : '';
                }
                else{
                    return !empty( $fieldName ) ? 'name="mythemes-' . $fieldName . '"' : '';
                }
            }
        }
        
        function allowArchiveComments( )
        {
            if( is_category() ){
                $catID = get_query_var( 'cat' );
                
                $layout = myTheme::get( 'templates-category-' . $catID . '-layout' );
                
                if( empty( $layout ) ){
                    return myTheme::get( 'templates-category-comments' );
                }
                else{
                    return myTheme::get( 'templates-category-' . $catID . '-comments' );
                }
            }
            
            return false;
        }
        
        function allowComments( $postID )
        {
            if( is_single() ){
                $categories = wp_get_post_terms( $postID , 'category' );
                if( !empty( $categories ) && isset( $categories[ 0 ] -> term_id ) ){
                    
                    $layout = myTheme::get( 'templates-category-' . $categories[ 0 ] -> term_id . '-layout' );
                    
                    if( empty( $layout  ) ){
                        $allow = myTheme::get( 'templates-category-comments' );
                    }else{
                        $allow = myTheme::get( 'templates-category-' . $categories[ 0 ] -> term_id . '-comments' );
                    }
                    
                    if( $allow ){
                        return true;
                    }
                }
                else{
                    if( myTheme::get( 'templates-category-comments' ) ){
                        return true;
                    }
                }
            }
            
            return false;
        }
    }
?>