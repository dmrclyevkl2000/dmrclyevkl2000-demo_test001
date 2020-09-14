<?php
// if no 'id' value exists, redirect back to home page
if (!isset($_GET['id'])) {
    header('Location: home-admin.php');
}
// when a page is selected for EDITING, get the 'id' field of the record and use the value to UPDATE the record...
$id_now = $_GET['id'];

//$file_does_exist = 1; // Since edit-existing-page.php links pages must first exist, assume file_does_exist = 1 (true);
include("../includes/jmcms_db_conn_cms.php");
?>

<!DOCTYPE html>
    <head>
        <meta name="robots" content="noindex, nofollow" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Edit Existing Page | </title>
        <link type="text/css" rel="stylesheet" href="../css/style2a.css" />
        <link type="text/css" rel="stylesheet" href="../css/admin-console-style-3b.css" />
        <script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="../js/livevalidation_standalone.compressed.js" type="text/javascript"></script>
        <script src="../js/jquery.textareaCounter.plugin.js" type="text/javascript"></script>
        <script src="../js/flowplayer-3.2.6.min.js"></script>
        <script type="text/javascript">
            // Show/Hide of Article / Video file uploader boxes...
            $(function() {    // Makes sure the code contained doesn't run until
                //     all the DOM elements have loaded
                $('#content_type').change(function() {
                    $('.content_select').hide();
                    $('#' + $(this).val()).show();
                });
            });
            /* textarea Counter and Limiter via jQuery */
            // page_desc
            var options1 = {
                'maxCharacterSize': 130,
                'originalStyle': 'originalDisplayInfo',
                'warningStyle': 'warningDisplayInfo',
                'warningNumber': 10,
                'displayFormat': '#input Characters | #left Characters Left | #words Words'
            };
            // page_keywords
            var options2 = {
                'maxCharacterSize': 200,
                'originalStyle': 'originalDisplayInfo',
                'warningStyle': 'warningDisplayInfo',
                'warningNumber': 40,
                'displayFormat': '#input Characters | #left Characters Left | #words Words'
            };
            // page_content - for video
<?php
if ($_SESSION['content_array'][$id_now]['content_type'] == 'video') {
    echo "
                var options3 = {  
                        'maxCharacterSize': 300,  
                        'originalStyle': 'originalDisplayInfo',  
                        'warningStyle': 'warningDisplayInfo',  
                        'warningNumber': 60,  
                        'displayFormat': '#input Characters | #left Characters Left | #words Words'  
                };";
    $content_js_var = "$('#page_content').textareaCount(options3);";
} else if ($_SESSION['content_array'][$id_now]['content_type'] == 'distributor') {
    echo "
                var options3 = {  
                        'maxCharacterSize': 300,  
                        'originalStyle': 'originalDisplayInfo',  
                        'warningStyle': 'warningDisplayInfo',  
                        'warningNumber': 60,  
                        'displayFormat': '#input Characters | #left Characters Left | #words Words'  
                };";
    $content_js_var = "$('#page_content').textareaCount(options3);";
} else {
    $content_js_var = "";   
}
?>
            // This will trigger the textarea elements to have real-time character counters and limits
            window.onload = function() {
                $('#page_desc').textareaCount(options1);
                $('#page_keywords').textareaCount(options2);
                //$('#page_content').textareaCount(options3);  
<?php echo $content_js_var; ?>
            }
            /***** Live Validation vars and params *****/
            $(document).ready(function() {

                /* ///// Required fields ////// */
                /*
                 // Thumbnail / Preview Image(s)
                 var val_page_img_large = new LiveValidation('page_img_large', { validMessage: " ", onlyOnSubmit: true});
                 val_page_img_large.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                /*
                 // Content Type
                 var val_content_type = new LiveValidation('content_type', { validMessage: " ", onlyOnSubmit: true});
                 val_content_type.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */

                // For VIDEO content Pages...
                /*
                 // Video File Checker ///// CURRENTLY DISABLED /////
                 var val_page_img_extra = new LiveValidation('page_img_extra', { validMessage: " ", onlyOnSubmit: true});
                 //val_effdate.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */


                /* ///// Required and exclude certain chars ///// */
                // URL Tag Validation
                var val_page_field1 = new LiveValidation('page_field1', {validMessage: " ", onlyOnSubmit: false});
                val_page_field1.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                //val_page_field1.add(Validate.Exclusion, {failureMessage: " ", within: ['~', '_', ')', '(', '?', '$', '<', '>', '}', '{', '[', ']', '%', '@', '*', ':', ';', '\\', '|', '^', '!', '+', '=', '.', '\'', '"', ',', ' '], partialMatch: true});

                // Page Title Validation
                var val_page_title = new LiveValidation('page_title', {validMessage: " ", onlyOnSubmit: false});
                val_page_title.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                val_page_title.add(Validate.Exclusion, {failureMessage: " ", within: ['~', '_', ')', '(', '$', '<', '>', '}', '{', '[', ']', '%', '@', '*', ';', '\\', '|', '^', '!', '+', '=', '.', '\'', '"'], partialMatch: true});

                // Page Description Validation
                var val_page_desc = new LiveValidation('page_desc', {validMessage: " ", onlyOnSubmit: false});
                val_page_desc.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                val_page_desc.add(Validate.Exclusion, {failureMessage: " ", within: ['~', '_', '<', '>', '}', '{', '[', ']', '@', '*', '\\', '|', '^', '+', '='], partialMatch: true});

                // Page Keywords Validation
                var val_page_keywords = new LiveValidation('page_keywords', {validMessage: " ", onlyOnSubmit: false});
                val_page_keywords.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                val_page_keywords.add(Validate.Exclusion, {failureMessage: " ", within: ['~', '_', ')', '(', '?', '$', '<', '>', '}', '{', '[', ']', '%', '@', '&', '*', ':', ';', '\\', '|', '^', '!', '+', '=', '.', '\'', '"'], partialMatch: true});

                // More to come...

                // Page Content section ///// Video Blurb Section /////
                // (Optional) Page Content Hyperlink section (needs tested!)/////                 
                var val_content_hlink = new LiveValidation('content_hlink', {validMessage: " ", onlyOnSubmit: false});
                //val_effdate.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                //val_content_hlink.add(Validate.Inclusion, { pattern: /^http:\/\//, failureMessage: "URL must start with http://" } );                                         

            if ('<?php echo $_SESSION['content_array'][$id_now]['content_type']; ?>' === 'article') {
                page_content_a = '<?php echo $_SESSION['content_array'][$id_now]['page_content']; ?>';
                var val_page_content = new LiveValidation('page_content_a', {validMessage: " ", onlyOnSubmit: false});
            } else {
                var val_page_content = new LiveValidation('page_content', {validMessage: " ", onlyOnSubmit: false});
                //val_effdate.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
            }
            });
        </script>
        <!-- CDN hosted by Cachefly -->
        <script src="//tinymce.cachefly.net/4/tinymce.min.js"></script>
        <script>
        tinymce.init({selector: 'textarea#page_content_a'});
        </script>                  
    </head>

    <body>

        <div id="main">
            <h1 align="center">JMicrositeCMS Content Management System - v0.3 beta</h1>

            <div id="main2">
                <!--<?php //include("../template/page_top_cms.php");      ?>-->
                <!-- end page_top.php -->

                <!-- admin -- start -->
                <div id="admin-console">

                    <h1>Logged in as: <?php echo $_SESSION['user_current']; ?> - <a href="/admin_cms/">Log Out</a></h1>

                    <h4>
                        <?php 
                        echo 'Now Editing PAGE ID =&gt; ' . $_SESSION['content_array'][$id_now]['id'];
                        ?>
                    </h4>
                    <h3>THIS CONTENT PAGE IS CURRENTLY SET TO "<u><?php echo $_SESSION['content_array'][$id_now]['published_status']; ?></u>", SUBMITTING CHANGES WILL SET THIS CONENT TO "<u>pending</u>" AFTER SUBMISSION.</h3>
                    <p>Click here to <a href="home-admin.php">select an edit an existing page</a></p>
                    <p><a href="create-new-page.php">Create A New Page</a> </p>

                    <form action="<?php echo $_SESSION['content_array'][$id_now]['content_type']; ?>-content-create-page.php" method="post" enctype="multipart/form-data" name="create_page" id="create_page">
                        <input type="hidden" name="id_content" id="id_content" value="<?php echo $_GET['id']; ?>"  />
                        <p>
                            Content Type: <?php echo $_SESSION['content_array'][$id_now]['content_type']; ?>
                            <input type="hidden" name="content_type" id="content_type" value="<?php echo $_SESSION['content_array'][$id_now]['content_type']; ?>" />
                            - You cannot change the content type, you must create a new page instead.
                        </p>                        
                        <p>
                            ALT Tag for image - LIMIT 100 chars<br />
                            <input type="text" name="page_field1" id="page_field1" size="100" maxlength="100" value="<?php echo $_SESSION['content_array'][$id_now]['page_field1']; ?>" />
                        </p>
                        <p>
                            Page Title: LIMIT 28 chars<br />
                            <input name="page_title" id="page_title" type="text" size="50" maxlength="28" value="<?php echo $_SESSION['content_array'][$id_now]['page_title']; ?>" />
                        </p>
                        <p>
                            Content Image (resized to 190px x 190px and 120px x 120px)<br />
                            <input name="page_img_large" id="page_img_large" type="file" size="50" /> 
                            Current: <?php echo $_SESSION['content_array'][$id_now]['page_img_large']; ?><br />
                            <img src="../images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large']; ?>" width="190" height="190"  />
                            <img src="../images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large']; ?>" width="120" height="120"  />
                        </p>        
                        <p>        
                            Page Description: LIMIT 130 chars<br />
                            <textarea name="page_desc" id="page_desc" cols="100" rows="2" ><?php echo $_SESSION['content_array'][$id_now]['page_desc']; ?></textarea>
                        </p>
                            <p>
                                Page Keywords: LIMIT 200 chars<br />
                                <textarea name="page_keywords" id="page_keywords" cols="100" rows="6"><?php echo $_SESSION['content_array'][$id_now]['page_keywords']; ?></textarea>
                            </p>      
                            <p>
                                (Optional) Content Hyperlink - LIMIT 120 chars<br />
                                <input name="content_hlink" type="text" id="content_hlink" size="50" maxlength="120" value="<?php echo $_SESSION['content_array'][$id_now]['content_hlink']; ?>" />                                
                            </p>   
                            <!-- begin VIDEO type fields -->
                            <?php
                            if ($_SESSION['content_array'][$id_now]['content_type'] == 'video') {
                                ?>

                                <p>
                                    Upload a Video: LIMIT 20MB with DIMENSIONS of 500px (width) x 375px (height)<br />
                                    <input name="page_img_extra" id="page_img_extra" type="file" size="50" />
                                    Current:<?php echo $_SESSION['content_array'][$id_now]['page_img_extra']; ?>
                                </p>

                                <div class="video-div" style="width:500px; height:375px;">
                                    <!-- dynamic video page content begins -->
                                    <!-- OBJECT tag for Internet Explorer 3+ -->
                                    <object id="flowplayer" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="500" height="375">
                                        <param name="movie" value="//releases.flowplayer.org/swf/flowplayer-3.2.7.swf" /> 
                                        <param name="flashvars" value='config={"clip":"http://<?php echo $_SERVER['HTTP_HOST'] . '/images/cms/' . $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_extra'] . ''; ?>"}' />
                                        <!-- EMBED tag for Netscape Navigator 2.0+ and Mozilla compatible browsers -->
                                        <embed type="application/x-shockwave-flash" width="500" height="375" src="//releases.flowplayer.org/swf/flowplayer-3.2.7.swf" flashvars='config={"clip":"http://<?php echo $_SERVER['HTTP_HOST'] . '/images/cms/' . $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_extra'] . ''; ?>"}' />

                                    </object>                      
                                </div>
                                <!-- create Video Content section for blurb beneath the video (limit 300 chars)-->        
                                <p>Video Blurb Section: LIMIT 300 chars<br />
                                    <textarea name="page_content" id="page_content" cols="100" rows="6"><?php echo $_SESSION['content_array'][$id_now]['page_content']; ?></textarea>
                                </p>                    
                                <?php
                            } //end video upload and video preview sections... if condition "if content_type == "video"...
                            else if ($_SESSION['content_array'][$id_now]['content_type'] == 'article') {
                                ?>

                                <h5 align="center">Article Content Editor</h5>
                                <textarea name="page_content_a" id="page_content_a" cols="100" rows="6">
                                <script>
                                // <![CDATA[                                    
                                    setTimeout(function(){
                                    tinymce.activeEditor.setContent("<?php echo $_SESSION['content_array'][$id_now]['page_content']; ?>");                                    
                                    }, 5000);
                                // ]]>                                    
                                </script>
                                    <?php //$_SESSION['content_array'][$id_now]['page_content']; ?>
                                </textarea>
                                <?php
                            } else if ($_SESSION['content_array'][$id_now]['content_type'] == 'distributor') {
                                ?>
                                <h5 align="center">Distributor Content Editor</h5>
                                <div id="distributor">              
                                    <p>
                                        (Optional) Thumbnail/Preview Image SMALL: LIMIT 150kb - Image will be placed into 500px x 375px area (MAXIMUM SIZE)<br />
                                        <input name="page_img_small" id="page_img_small" type="file" size="50" /> 
                                        Current: <?php echo $_SESSION['content_array'][$id_now]['page_img_small']; ?><br />
                                        <img src="../images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_small']; ?>" width="250" height="187" />                                            
                                    </p>   
                                    <p>
                                        (Optional) ALT Tag for image - LIMIT 50 chars<br />
                                        <input type="text" name="page_field2" id="page_field2" size="50" maxlength="50" value="<?php echo $_SESSION['content_array'][$id_now]['page_field2']; ?>" />
                                    </p>                            

                                    <p>
                                        Distributor Info Section: LIMIT 300 chars<br />
                                        <textarea name="page_content" id="page_content" cols="100" rows="6"><?php echo $_SESSION['content_array'][$id_now]['page_content']; ?></textarea>
                                    </p>
                                </div> 
                                <?php
                            }
                            ?> 

                            <p align="center">
                                <input type="submit" name="submit_for_preview" id="submit_for_preview" value="PREVIEW CONTENT CHANGES" />
                            </p>
                    </form>
                    </p>          
                </div>
                <!-- admin -- end -->
                <!--          <div id="foot-pad">
                                <div class="shadow-purple"></div>
                              <img src="../images/foot-pad.png" height="46" width="990" />
                            </div>
                <!--<?php //include("../template/page_footer_cms.php");      ?>-->

            </div>
        </div>
        <?php
        if ($_SESSION['user_current'] == 'admin' && isset($_GET['debug'])) {
            include_once 'debugging.php';
        }
        ?>

        <pre>JMicrositeCMS Content Management System - v0.3 beta</pre>
    </body>
</html>