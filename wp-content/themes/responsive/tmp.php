        <div class="html_carousel">
            <div id="foo2">
                <div class="slide">
                    <img src="<?php echo content_url()?>/uploads/header_slider_images/DSC_5482.jpg" alt="carousel 1"/>
                    <div>
                        <h4>Text epic 1</h4>
                        <p>Descriere text epic 1</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo content_url()?>/uploads/header_slider_images/DSC_5522.jpg" alt="carousel 2"/>
                    <div>
                        <h4>Text epic 2</h4>
                        <p>Descriere text epic 2</p>
                    </div>
                </div>
            </div>
            <a class="prev" id="foo2_prev" href="#"><span>prev</span></a>
            <a class="next" id="foo2_next" href="#"><span>next</span></a>
            <div class="clearfix"></div>
        </div>
        
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $("#foo2").carouFredSel({
                    responsive  : true,
                    scroll      : {
                        fx          : "crossfade",
                        easing      : "linear",
                        duration    : 750
                    },
                    items       : {
                        visible     : 1
                    },
                    prev : "#foo2_prev",
                    next : "#foo2_next"

                });
               
            });
        </script>
