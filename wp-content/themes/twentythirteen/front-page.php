<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(window).load(function(){ $('#foo2').carouFredSel({
                    responsive  : true,
                    width       : 1245,
                    scroll      : {
                        fx          : "crossfade",
                        easing      : "linear",
                        duration    : 750
                    },
                    auto      : {
                        timeoutDuration  : 7000,
                    },
                    items       : {
                        width       : 1245,
                        height      : "variable",
                        visible     : 1
                    },
                    prev : "#foo2_prev",
                    next : "#foo2_next"
                }); });
                $(window).load(function(){ $('#img_container').masonry({
                     columnWidth: 415,
                     itemSelector: '.tile_img_container',
                     isFitWidth: true
                }); });
            });
        </script>

<?php
    /* Localisation strings can be found here */
    class Slider
    {
       public $photo;
       public $link;
       public $title;
       public $alt;

       public function Slider($photo, $link, $title, $alt) {
            $this->photo = $photo;
            $this->link = $link;
            $this->title = $title;
            $this->alt = $alt;
       }
    }
    if(ICL_LANGUAGE_CODE == 'en'){
        $sliders = array (
                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_1.jpg',
                    'http://diaconescuradu.com/2013/04/bivuac-pe-piatra-iernii-si-din-nou.html',
                    'Bivouac on Winterstein',
                    'Bivuac pe piatra iernii'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_2.jpg',
                    'http://diaconescuradu.com/2013/08/wilder-kaiser-ziua-6-via-classica-din.html',
                    'Via Classica from Wilder Kaiser',
                    'Via Classica din Wilder Kaiser'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_3.jpg',
                    'http://diaconescuradu.com/2012/01/inceput-de-in-fagaras.html',
                    'Vanatoarea lui Buteanu',
                    'Vanatoarea lui Buteanu'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_4.jpg',
                    'http://diaconescuradu.com/2013/08/wilder-kaiser-ziua-4-soclul-din.html',
                    'Wilder Kaiser',
                    'Wilder Kaiser'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_5.jpg',
                    'http://diaconescuradu.com/2013/06/de-la-bordeluri-pe-apa-la-mori-de-vant.html',
                    'Olanda on a bike',
                    'Olanda pe bicicleta'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_6.jpg',
                    'http://diaconescuradu.com/explore/mode/reu/search/categories/drumetii',
                    'Trekking in the Dolomites',
                    'Drumetii in dolomiti'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_7.jpg',
                    'http://diaconescuradu.com/category/dolomiti',
                    'The Dolomites, a kingdom of stone',
                    'Dolomiti, imparatia de stanca'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_8.jpg',
                    'http://diaconescuradu.com/2011/11/lepsezi.html',
                    'Lespezi',
                    'Lespezi'),

                     new Slider(content_url() . '/uploads/header_slider_images/cover_photo_9.jpg',
                    'http://diaconescuradu.com/explore/mode/reu/search/categories/piatra-craiului/germania',
                    'On the hills of Germany',
                    'De pe dealurilei Germaniei'),

                     new Slider(content_url() . '/uploads/header_slider_images/cover_photo_10.jpg',
                    'http://diaconescuradu.com/explore/mode/reu/search/categories/fagaras',
                    'The Fagaras Mountains',
                    'Pe creste Fagarasului'),

                     new Slider(content_url() . '/uploads/header_slider_images/cover_photo_11.jpg',
                    'http://diaconescuradu.com/explore/mode/reu/search/categories/piatra-craiului',
                    'From Piatra Craiului',
                    'Din al nostru Crai'));
    }
    if(ICL_LANGUAGE_CODE == 'ro'){
        $sliders = array (
                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_1.jpg',
                    'http://diaconescuradu.com/2013/04/bivuac-pe-piatra-iernii-si-din-nou.html',
                    'Bivuac pe piatra iernii',
                    'Bivuac pe piatra iernii'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_2.jpg',
                    'http://diaconescuradu.com/2013/08/wilder-kaiser-ziua-6-via-classica-din.html',
                    'Via Classica din Wilder Kaiser',
                    'Via Classica din Wilder Kaiser'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_3.jpg',
                    'http://diaconescuradu.com/2012/01/inceput-de-in-fagaras.html',
                    'Vanatoarea lui Buteanu',
                    'Vanatoarea lui Buteanu'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_4.jpg',
                    'http://diaconescuradu.com/2013/08/wilder-kaiser-ziua-4-soclul-din.html',
                    'Wilder Kaiser',
                    'Wilder Kaiser'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_5.jpg',
                    'http://diaconescuradu.com/2013/06/de-la-bordeluri-pe-apa-la-mori-de-vant.html',
                    'Olanda pe bicicleta',
                    'Olanda pe bicicleta'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_6.jpg',
                    'http://diaconescuradu.com/explore/mode/reu/search/categories/drumetii',
                    'Drumetii in dolomiti',
                    'Drumetii in dolomiti'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_7.jpg',
                    'http://diaconescuradu.com/category/dolomiti',
                    'Dolomiti, imparatia de stanca',
                    'Dolomiti, imparatia de stanca'),

                    new Slider(content_url() . '/uploads/header_slider_images/cover_photo_8.jpg',
                    'http://diaconescuradu.com/2011/11/lepsezi.html',
                    'Lespezi',
                    'Lespezi'),

                     new Slider(content_url() . '/uploads/header_slider_images/cover_photo_9.jpg',
                    'http://diaconescuradu.com/explore/mode/reu/search/categories/piatra-craiului/germania',
                    'De pe dealurilei Germaniei',
                    'De pe dealurilei Germaniei'),

                     new Slider(content_url() . '/uploads/header_slider_images/cover_photo_10.jpg',
                    'http://diaconescuradu.com/explore/mode/reu/search/categories/fagaras',
                    'Pe creste Fagarasului',
                    'Pe creste Fagarasului'),

                     new Slider(content_url() . '/uploads/header_slider_images/cover_photo_11.jpg',
                    'http://diaconescuradu.com/explore/mode/reu/search/categories/piatra-craiului',
                    'Din al nostru Crai',
                    'Din al nostru Crai'));


    }


    if(ICL_LANGUAGE_CODE == 'en'){
        $recentAdventures = 'Recent Adventures';
    }
    if(ICL_LANGUAGE_CODE == 'ro'){
        $recentAdventures = 'Aventuri recente';
    }
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
            <div class="html_carousel site_content">
                <div id="foo2">
                    <?php
                    foreach ($sliders as $slider) {
                        echo '<div class="slide">';
                            echo '<img src="' . $slider->photo . '" alt="' . $slider->alt . '"/>';
                            echo '<div class="slider_title">';
                                echo '<a href="' . $slider->link . '"><h5>' . $slider->title . '</h5></a>';
                            echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <a class="slider_buttons prev" id="foo2_prev" href="#"><span>prev</span></a>
                <a class="slider_buttons next" id="foo2_next" href="#"><span>next</span></a>
                <div class="clearfix"></div>
            </div>
            <div class="horizontalRule site_content"></div>
            <i><h3 class="text-center"><?php echo $recentAdventures?></h3></i>
             <?php
            $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'posts_per_page' => 9, 'category_name' => $cat_name, 'search' => $search));
            list_posts($blog_query);
            wp_reset_postdata();
            ?>  
        </div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
