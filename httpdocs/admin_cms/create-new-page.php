<?php
include("../includes/jmcms_db_conn_cms.php");
$id_now = $id_adder;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="robots" content="noindex, nofollow" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Create A New Page</title>

        <link type="text/css" rel="stylesheet" href="../css/style2a.css" />
        <link type="text/css" rel="stylesheet" href="../css/admin-console-style-3b.css" />
        <script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="../js/livevalidation_standalone.compressed.js" type="text/javascript"></script>
        <script src="../js/jquery.textareaCounter.plugin.js" type="text/javascript"></script>
        <script src="../js/flowplayer-3.2.6.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            /* textarea Counter and Limiter via jQuery */
            // page_desc
            var options1 = {
                'maxCharacterSize': 90,
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
            // page_content - for video (#page_content_v)
            var options3 = {
                'maxCharacterSize': 300,
                'originalStyle': 'originalDisplayInfo',
                'warningStyle': 'warningDisplayInfo',
                'warningNumber': 60,
                'displayFormat': '#input Characters | #left Characters Left | #words Words'
            };

            // This will trigger the textarea elements to have real-time character counters and limits 
            function charCount() {
                $('#page_desc').textareaCount(options1);
                $('#page_keywords').textareaCount(options2);
                $('#page_content_v').textareaCount(options3);
                $('#page_content_d').textareaCount(options3);
            }
            ;
            // Show/Hide of Article / Video file uploader boxes...
            $(function()
            { // Makes sure the code contained doesn't run until all the DOM elements have loaded            
                $('#content_type').change(
                        function showhide()
                        {
                            $('.content_select').hide();
                            $('#' + $(this).val()).show();
                        });
                charCount();
            });

            /***** Live Validation vars and params *****/
            $(document).ready(function() {

                /* ///// Required fields ////// */

                // Thumbnail / Preview Image(s)
                var val_page_img_large = new LiveValidation('page_img_large', {validMessage: " ", onlyOnSubmit: false});
                val_page_img_large.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */

                // Content Type
                var val_content_type = new LiveValidation('content_type', {validMessage: " ", onlyOnSubmit: false});
                val_content_type.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */

                /* ///// Required and exclude certain chars ///// */
                // URL Tag Validation
                var val_page_field1 = new LiveValidation('page_field1', {validMessage: " ", onlyOnSubmit: false});
                val_page_field1.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                val_page_field1.add(Validate.Exclusion, {failureMessage: " ", within: ['~', '_', ')', '(', '?', '$', '<', '>', '}', '{', '[', ']', '%', '@', '*', ':', ';', '\\', '|', '^', '!', '+', '=', '.', '\'', '"', ',', ' '], partialMatch: true});

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

                // Article Content section ///// CURRENTLY DISABLED /////
                var val_page_content_a = new LiveValidation('page_content_a', {validMessage: " ", onlyOnSubmit: false});
                //val_page_content.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */	

                // Video Blurb Section ///// CURRENTLY DISABLED /////
                var val_page_content_v = new LiveValidation('page_content_v', {validMessage: " ", onlyOnSubmit: false});
                //val_page_content_v.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */	

                // Video Blurb Section ///// CURRENTLY DISABLED /////
                var val_page_content_d = new LiveValidation('page_content_d', {validMessage: " ", onlyOnSubmit: false});
                //val_page_content_v.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */	                

                // Video File Checker ///// CURRENTLY DISABLED /////
                var val_page_img_extra = new LiveValidation('page_img_extra', {validMessage: " ", onlyOnSubmit: false});
                //val_page_img_extra.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */

                // (Optional) Page Content Hyperlink section /////                 

                var val_content_hlink = new LiveValidation('content_hlink', {validMessage: " ", onlyOnSubmit: false});
                //val_effdate.add(Validate.Presence, {failureMessage: " "}); // Must exist (required)                                                 

                // begin content selector options
                $('.content-type').change(function() {
                    if ($(this).val() == 'article') {
                        // For ARTICLE content Pages...

                        //var val_page_content = new LiveValidation('page_content', { validMessage: " ", onlyOnSubmit: false});
                        val_page_content_a.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                        //alert('page_content validation is ACTIVE');					

                        val_page_img_extra.empty();
                        val_page_content_v.empty();
                        val_page_content_d.empty();
                        $('#article').show('fast');
                        $('#video').hide('fast');
                        $('#distributor').hide('fast');
                        //															                        
                        $('#page_content_d').disable();
                        $('#page_content_v').disable();
                        $('#page_content_a').enable();
                        $('#page_img_extra').disable();
                        /*
                         val_page_content.enable();
                         val_page_content_v.disable();
                         val_page_img_extra.disable();									
                         */
                    }
                    else if ($(this).val() == 'video') {
                        // For VIDEO content Pages...
                        //var val_page_img_extra = new LiveValidation('page_img_extra', { validMessage: " ", onlyOnSubmit: false});
                        val_page_img_extra.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */

                        //var val_page_content_v = new LiveValidation('page_content_v', { validMessage: " ", onlyOnSubmit: false});
                        val_page_content_v.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                        //alert('page_img_extra and page_content_v validation are ACTIVE');	
                        val_page_content_a.empty();
                        val_page_content_d.empty();

                        $('#video').show('fast');
                        $('#article').hide('fast');
                        $('#distributor').hide('fast');
                        //				
                        $('#page_content_a').disable();
                        $('#page_content_d').disable();
                        $('#page_content_v').enable();
                        $('#page_img_extra').enable();
                        /*			
                         val_page_content.disable();
                         val_page_content_v.enable();	
                         val_page_img_extra.enable();
                         */
                    }
                    else if ($(this).val() == 'distributor') {
                        // For VIDEO content Pages...
                        //var val_page_img_extra = new LiveValidation('page_img_extra', { validMessage: " ", onlyOnSubmit: false});
                        val_page_img_extra.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */

                        val_content_hlink.add(Validate.Inclusion, {pattern: /^http:\/\//, failureMessage: "URL must start with http://"});

                        //var val_page_content_v = new LiveValidation('page_content_v', { validMessage: " ", onlyOnSubmit: false});
                        val_page_content_d.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
                        //alert('page_img_extra and page_content_v validation are ACTIVE');	
                        val_page_content_a.empty();
                        val_page_content_v.empty();

                        $('#distributor').show('fast');
                        $('#video').hide('fast');
                        $('#article').hide('fast');
                        //				
                        $('#page_content_a').disable();
                        $('#page_content_v').disable();
                        $('#page_content_d').enable();
                        $('#page_img_extra').enable();
                        /*			
                         val_page_content.disable();
                         val_page_content_v.enable();	
                         val_page_img_extra.enable();
                         */
                    }
                });

            });

            function changeAction()
            {
                var content_type_var = document.getElementById('content_type').value;
                //	alert('Content_type is set to ' + content_type_var + ' with an $id_now value of <?php echo $id_now; ?> .');	

                if (content_type_var == "article") {
                    //alert('BEFORE ARTICLE!');//	
                    //alert('val_page_content = ' + val_page_content + ' Content_type is set to go to article-content-create-page.php');
                    //	document.create_page.action = "article-content-create-page.php?id=<?php //echo $id_now;  ?>";
                    document.create_page.action = "article-content-create-page.php";
                    //	alert('AFTER ARTICLE!');//	
                }
                else if (content_type_var == "video") {
                    //alert('BEFORE VIDEO changeAction var assignment!');//			
                    //	alert('val_page_content_v = ' + val_page_content_v + ' Content_type is set to go to video-content-create-page.php');		
                    //	document.create_page.action = "video-content-create-page.php?id=<?php //echo $id_now;  ?>";
                    document.create_page.action = "video-content-create-page.php";
                    //alert('AFTER VIDEO changeAction var assignment!');//			
                }
                else if (content_type_var == "distributor") {
                    //alert('BEFORE DISTRIBUTOR changeAction var assignment!');//			
                    //	alert('val_page_content_v = ' + val_page_content_v + ' Content_type is set to go to video-content-create-page.php');		
                    //	document.create_page.action = "video-content-create-page.php?id=<?php //echo $id_now;  ?>";
                    document.create_page.action = "distributor-content-create-page.php";
                    //alert('AFTER VIDEO changeAction var assignment!');//			
                }
                /*	else {
                 alert('Javascript function changeAction() has ended without a result; content_type is set to ' + content_type_var + 'with an $id_now value of <?php echo $id_now; ?> .');
                 } */
            }

        </script> 
        <!-- CDN hosted by Cachefly -->
        <script src="//tinymce.cachefly.net/4/tinymce.min.js"></script>
        <script>
                    tinymce.init({selector: 'textarea#page_content_a'});
        </script>        
    </head>

    <body>

        <div id="main">            

            <div id="main2">
                <?php //include("../template/page_top_cms.php");  ?>
                <!-- end page_top.php -->

                <!-- admin start -->
                <div id="admin-console">
                    <h1 align="center">JMicrositeCMS Content Management System - v0.3 beta</h1>	

                    <h1>Logged in as: <?php echo $_SESSION['user_current']; ?> - <a href="/admin_cms/">Log Out</a></h1>

                    <p>Click here to <a href="home-admin.php">select an edit an existing page</a></p>

                    <!--<form enctype="multipart/form-data" name="create_page" id="create_page" action="preview-content-page.php" method="post" onsubmit="changeAction()">-->     
                    <form enctype="multipart/form-data" name="create_page" id="create_page" action="#" method="post" onsubmit="changeAction()">                             
                        <input type="hidden" name="id_content" id="id_content" value="<?php echo $id_now; ?>"  />        
                        <p>
                            ALT Tag for image - LIMIT 50 chars<br />
                            <input name="page_field1" type="text" id="page_field1" size="50" maxlength="50" />
                        </p>
                        <p>
                            Page Title: LIMIT 28 chars<br />
                            <input name="page_title" id="page_title" type="text" size="50" maxlength="28" />
                        </p>        
                        <p>
                            Thumbnail/Preview Image LARGE: LIMIT 150kb - Image will be resized to 190px x 190px and 120px x 120px thumbnails<br />
                            <input type="file" name="page_img_large" id="page_img_large" />
                        </p>    
                        <p>
                            Page Description: LIMIT 90 chars<br />
                            <textarea name="page_desc" id="page_desc" cols="100" rows="2" ></textarea>
                        </p>   
                        <p>
                            Page Keywords: LIMIT 200 chars<br />
                            <textarea name="page_keywords" id="page_keywords" cols="100" rows="6" ></textarea>
                        </p> 
                        <p>
                            Content Type: <select id="content_type" name="content_type" >
                                <option value="" selected="selected">Choose One</option>
                                <option value="distributor">Distributor</option>
                                <option value="article">Article</option>
                                <option value="video">Video</option>	
                            </select> 
                        </p>
                        <!-- begin VIDEO type fields -->
                        <div id="video" class="content_select" style="display:none">              
                            <p>
                                Upload a Video: LIMIT 100MB with DIMENSIONS of 500 pixels (width) x 375 pixels (height)<br />
                                <input type="file" name="page_img_extra" id="page_img_extra" />
                            </p>              
                            <p>
                                Video Blurb Section: LIMIT 300 chars<br />
                                <textarea name="page_content_v" id="page_content_v" cols="100" rows="6"></textarea>
                            </p>
                            <p align="center">
                                <input type="submit" name="submit_for_preview" id="submit_for_preview" value="PREVIEW" />
                            </p>       
                        </div>                                                  
                        <!-- end VIDEO type fields -->                          
                        <!-- begin DISTRIBUTORS type fields -->
                        <div id="distributor" class="content_select" style="display:none">              
                            <p>
                                (Optional) Thumbnail/Preview Image SMALL: LIMIT 150kb - Image will be placed into 500px x 375px area (MAXIMUM SIZE)<br />
                                <input type="file" name="page_img_small" id="page_img_small" />
                            </p>   
                            <p>
                                (Optional) ALT Tag for image - LIMIT 50 chars<br />
                                <input name="page_field2" type="text" id="page_field2" size="50" maxlength="50" />
                            </p>                            
                            <p>
                                (Optional) Content Hyperlink - LIMIT 120 chars<br />
                                <input name="content_hlink" type="text" id="content_hlink" size="50" maxlength="120" />                                
                            </p>  
                            <p>
                                Distributor Info Section: LIMIT 300 chars<br />
                                <textarea name="page_content_d" id="page_content_d" cols="100" rows="6"></textarea>
                            </p>
                            <p align="center">
                                <input type="submit" name="submit_for_preview" id="submit_for_preview" value="PREVIEW" />
                            </p>       
                        </div>                                                  
                        <!-- end DISTRIBUTORS type fields -->
                        <!-- begin ARTICLE type fields -->
                        <div id="article" class="content_select" style="display:none" >             
                            <span align="center">Article Content Editor</span>		  
                                <textarea name="page_content_a" id="page_content_a" cols="100" rows="6">
                                <script>
                                    setTimeout(function(){
                                    tinymce.activeEditor.setContent("some text");
                                    //tinymce.activeEditor.setContent("<?php //echo $_SESSION['content_array'][$id_now]['page_content']; ?>");                                    
                                    }, 1000);
                                </script>
                                </textarea>
                            <p align="center">
                                <input type="submit" name="submit_new_page" id="submit_new_page" value="PREVIEW" />
                            </p>       
                        </div>                                                  
                        <!-- end ARTICLE type fields -->     


                    </form>
                </div>
                <!-- admin -- end -->

                <!-- footer -- start -->

                <?php include("../template/page_footer.php"); ?>

            </div>
        </div>
        <pre>JMicrositeCMS Content Management System - v0.3 beta</pre>
    </body>
</html>