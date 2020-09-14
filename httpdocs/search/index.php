<!DOCTYPE html>
<html>
    <head>
<?php 
// $current_content_type = 'video'; //must be set!
// $id_now = $_GET['id'];
    include_once("../includes/jmcms_db_conn_vistors.php"); //config
    include_once('../template/head-themed.php'); //theme
?>               
        <title>Search | Search Website | Google Search | </title>
        <meta name="description" content="Search for information | Plan |" />
        <meta name="keywords" content="Search, Experience, Free, Plan |" />

        <script src="//www.google.com/jsapi" type="text/javascript"></script>

    </head>
    <body>
        <div id="main">	
            <div id="main2">
                <?php include ('../template/page_top.php'); ?>
                <div id="banner-search">
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

                        <div id="cse-search-results"></div>
                        <script type="text/javascript">
                            var googleSearchIframeName = "cse-search-results";
                            var googleSearchFormName = "cse-search-box";
                            var googleSearchFrameWidth = 800;
                            var googleSearchDomain = "www.google.com";
                            var googleSearchPath = "/cse";
                        </script>
                        <script type="text/javascript" src="//www.google.com/afsonline/show_afs_search.js"></script>

                    </div>

                </div>
                <div id="foot-pad">
                    <div class="shadow-purple"></div>
                    <img src="../images/foot-pad.png" alt="" height="46" width="990" />
                </div>
            </div>
            <?php include ('../template/page_footer.php'); ?>
        </div>
    </body>
</html>