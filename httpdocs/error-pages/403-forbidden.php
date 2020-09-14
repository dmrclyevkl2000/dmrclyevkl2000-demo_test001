<!DOCTYPE html>
<html>
    <head>
<?php
include("../includes/jmcms_db_conn_vistors.php");
include_once('../template/head-themed.php'); 
?>        
        <title>Search | Search Website | Google Search | </title>
        <meta name="description" content="Search for information | Plan |" />
        <meta name="keywords" content="Search, Experience, Free, Plan |" />

        <script src="//www.google.com/jsapi" type="text/javascript"></script>

    </head>
    <body>
        <div id="main">	
            <div id="main2">
                <?php
                /* include ('../template/page_top.php'); */
//page_top.php
                
                ?>
                <!-- page_top -- start -->     

                <!-- head -- start -->
                <div id="head">
                    <a href="/" target="_top">
                        <img class="companylogo" src="/images/companylogo.png" width="433" height="110" alt="company logo goes here" />
                    </a>
                    <a href="/" target="_top">
                        <img class="companyslogan" src="/images/companyslogan.png" width="320" height="90" alt="company slogan goes here" />
                    </a>

                    <ul id="sm_icons">
                        <li class="icons"><a href="//www.facebook.com/pages/#/#" target="_blank"><img src="/images/facebook_icon.png" width="42" height="42" alt="Your Business Name Facebook Social Media Page" /></a></li>
                        <li class="icons"><a href="//www.youtube.com/#" target="_blank"><img src="/images/youtube_icon.png" width="42" height="42" alt="Your Business Name YouTube Social Media Channel" /></a></li>
                        <li class="icons"><a href="//twitter.com/#" target="_blank"><img src="/images/twitter_icon.png" width="42" height="42" alt="Your Business Name Twitter Social Media Channel" /></a></li>  
                    </ul>

                </div>
                <!-- head -- end -->

                <div id="nav_bar">
                    <ul>
                        <li class="first" id="home"><a href="/">Home</a></li>
                        <li id="directions"><a href="/directions/">Directions</a></li>
                        <li id="contact"><a href="/contact/">Contact Us</a></li>
                        <li id="faq"><a href="/faq/">FAQ</a></li>        
                        <li id="distributors"><a href="/distributors/">Distributors</a></li>
                        <li id="videos"><a href="/videos/">Videos</a></li>
                        <li id="articles"><a href="/articles/">Articles</a></li>
                        <li id="search"><a href="/search/">Search</a></li>
                        <li id="social"><a href="/social/">Social</a></li>
                        <li class="last" id="moremenu">
                            <a href="#" onmouseover="mopen('m1')" onmouseout="mclosetime()">More Info</a>
                            <div id="m1" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
                                <a href="//www.angieslist.com/" target="_blank">Angie's List</a>
                            </div>                    	
                        </li>                
                        <!--<li class="last"><a href="#"></a></li> -->
                    </ul>
                </div>  
                <!-- page_top -- end -->                           

                <div id="banner-search">
                    <div id="error-pages">
                        <h1>403 Forbidden.</h1>
                        <h3>BUSTED!... No. Just... No. You are looking for something that you shouldn't be.</h3>
                        <strong>Try using our search feature below to find what you're looking for, or use the Navigation bar above.</strong>
                    </div>                    
                    <div class="search">
                        <h1 class="blue">Search the Your Business Name Website</h1>
                        <p>Enter keywords below to search the Your Business Name Website</p> 
                        <!-- Google Adsense Custom Search -->                        
                        <form action="/search/" id="cse-search-box">
                            <div>
                                <input type="hidden" name="cx" value="partner-pub-6187654813454336:3044592809" />
                                <input type="hidden" name="cof" value="FORID:10" />
                                <input type="hidden" name="ie" value="UTF-8" />
                                <input type="text" name="q" size="55" />
                                <input type="submit" name="sa" value="Search" />
                            </div>
                        </form>
                        <script type="text/javascript" src="//www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>
                        <!-- end Google Adsense Custom Search -->                       

                    </div>

                </div>
                <div id="foot-pad">
                    <div class="shadow-purple"></div>
                    <img src="../images/foot-pad.png" alt="" height="46" width="990" />
                </div>
            </div>
            <?php  include ('../template/page_footer.php');  ?>

        </div>
    </body>
</html>