<!DOCTYPE html>
    <head>
<?php 
    include_once("includes/jmcms_db_conn_vistors.php"); //config
    include_once('template/head-themed.php'); //theme
?>        
        <meta name="description" content="Your Business Name | 123 Address City, State/Province Zip/CountryCode | Flooring" />
        <meta name="keywords" content="" />        
        <title>Your Business Name | Tile Flooring | Tile Fixtures | Bathroom | Kitchen | Quality | Cheap</title>
<!-- BEGIN Video.js CDN -->
        <link href="//vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />

        <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
        <script src="//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<!-- END Video.js CDN -->
        <script type="text/javascript" src="/js/jquery.cycle-3.0.3.all.js"></script>        
        <script type="text/javascript">
            $(document).ready(function() {
                $('.slideshow').cycle({
                    fx: 'fade',
                    pause: 1,
                    speed: 1800, //default: 1800
                    timeout: 36000, //default: 8200
                    startingSlide: 0
                    , endingSlide: 1
                            // choose your transition type, ex: fade, scrollUp, shuffle, etc...
                            // Check http://jquery.malsup.com/cycle/ for all options available
                });
            });
        </script>

    </head>

    <body>
        <!-- main -- start -->
        <div id="main">

            <!-- main2 -- start -->
            <div id="main2">
                <!-- main2 -- end -->

                <!-- nav_bar -- start -->
                <!-- nav_bar -- end -->

                <!-- begin page_top.php -->
                <?php include('template/page_top.php'); ?>
                <!-- end page_top.php --> 

                <!-- banner -- start -->
                <div id="banner">

                    <div class="slideshow">
                        <?php //how many times to show the video on the home page? v || show w debug 
                        if (!isset($_SESSION['seen_tv']) || $_SESSION['seen_tv'] < 1 || $_GET['debug']) { 
                        ?>                        
                        <div id="commerical">
                            
                            <video id="my-video" class="video-js" controls preload="auto" width="1280" height="360" data-setup="{}">
                            <!-- poster="/images/banner01.jpg" -->
                                <source src="/videos/SampleVideo_1280x720_2mb.mp4" type="video/mp4" />
                                <!-- <source src="MY_VIDEO.webm" type="video/webm" /> -->
                                <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="//videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                </p>
                            </video>

                            <script src="//vjs.zencdn.net/7.8.4/video.js"></script>
                            
                        </div>
                            <?php
                            // If the User has seen the commercial, don't play it again
                            // $_SESSION['seen_tv'] = 1;
                            ++$_SESSION['seen_tv'];
                        }
                        ?>

                        <div><a href="#"><img src="images/banner01.jpg" alt="Your Business Name - 123 Address City, State/Province Zip/CountryCode" /></a></div>						  

                    </div>
                </div>
                <!-- banner -- end -->

                <div class="shadow"></div>
                <?php include('template/home-page-content.php'); ?>
            </div>
            <!-- main2 -- end -->

            <div id="foot-pad">
                <div class="shadow-purple"></div>
                <img src="images/foot-pad.png" alt="Our Prices Will Floor You at Your Business Name" />
            </div>
            <?php include_once ('template/page_footer.php'); ?>            
        </div>
        <!-- main -- end -->   
    </body>
</html>