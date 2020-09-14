<!DOCTYPE html>
<html>
    <head>
<?php 
// $current_content_type = 'video'; //must be set!
// $id_now = $_GET['id'];
    include_once("../includes/jmcms_db_conn_vistors.php"); //config
    include_once('../template/head-themed.php'); //theme
?>               
        <meta name="description" content="Driving Directions | Your Business Name  |  |  | " />
        <meta name="keywords" content="Driving Directions, Your Business Name,, " />
        <title>Your Business Name | 123 Address City, State/Province Zip/CountryCode</title>

        <style>
            #social-div {
                padding: 1%;
                margin: 15px;
                width: 100%;
                height: 560px;
                text-align: center; 
            }
            #facebook-feed 
            {
                border:none; 
                overflow:hidden; 
                width:40%; 
                height:540px;
            }
            iframe[id^='twitter-widget-']
            { 
                width:40%;
                height:540px;
            }
        </style>
    </head>
    <body>
        <div id="main">
            <div id="main2">
                <?php include ('../template/page_top.php'); ?>
                <div id="banner-contact">
                    <h1 class="blue">Get Social with Your Business Name</h1>                 

                    <hr />
                    <div id="social-div">                    
                        <strong>Like Us on Facebook & Follow Us on Twitter</strong>
                        <strong>Visit our page often for Specials and Local Events!</strong>
                        <p />
                        <iframe id="facebook-feed" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FYourFBPagesNAME%2FYourFBPagesID&amp;width=450&amp;height=550&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" allowTransparency="true"></iframe>

                        <a class="twitter-timeline"  href="https://twitter.com/#"  data-widget-id="410848702689841152">Tweets by @#</a>
                        <script>!function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                            if (!d.getElementById(id)) {
                                js = d.createElement(s);
                                js.id = id;
                                js.src = p + "://platform.twitter.com/widgets.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }
                        }(document, "script", "twitter-wjs");</script>

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