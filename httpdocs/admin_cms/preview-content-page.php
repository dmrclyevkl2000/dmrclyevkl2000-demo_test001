<?php
if (!isset($_POST) || isset($_GET['id'])) {
    $_POST['id_content'] = $_GET['id'];
}
$id_now = $_POST['id_content']; //sets the 'id' to match the record SUBMITTED from create-new-page.php -OR- edit-existing-page.php...

include("../includes/jmcms_db_conn_cms.php");
$_SESSION['content_array'][$id_now] = array('id' => $id_now,
    'author' => $_SESSION['user_current'],
    'page_field1' => $_POST['page_field1'],
    'content_type' => $_POST['content_type'],
    'content_date' => $_SESSION['date_current'],
    'page_title' => $_POST['page_title'],
    'page_desc' => $_POST['page_desc'],
    'page_keywords' => $_POST['page_keywords'],
    'page_content' => $_POST['page_content'],
    'page_img_large' => $_FILES['page_img_large']['name'],
    'video_file' => $_FILES['video_file']['name']
);

?>

<!DOCTYPE html>
    <head>
        
        <meta name="robots" content="noindex, nofollow" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Create A New Page</title>
        <link type="text/css" rel="stylesheet" href="../css/style2a.css" />
        <script src="../js/flowplayer-3.2.6.min.js"></script>

    </head>

    <body>

        <div id="main">


            <div id="main2">
                <?php include("../template/page_top_cms.php"); ?>
                <!-- end page_top.php -->

                <!-- admin -- start -->
                <div id="admin-console">

                    <h1>Logged in as: <?php echo $_SESSION['user_current']; ?> - <a href="/admin_cms/">Log Out</a></h1>

                    <h2>PAGE PREVIEW: Please review your new page to ensure accuracy. </h2>
                    <h2><a href="edit-existing-page.php?id=<?php echo $id_now; ?>">To make changes to this page, click here.</a></h2>
                    <h2>ONLY PUBLISHERS can SUBMIT  the content  for use on the web.</h2>
                    <p>Click here to <a href="home-admin.php">select an existing page for editing</a></p>

                    <form enctype="multipart/form-data" name="create_page" id="create_page" action="review-new-page.php" method="post">
                        <input type="hidden" name="id_content" id="id_content" value="<?php echo $id_now; ?>"  />
                        <p>
                            URL Tag: (eg. buy-things-from-me) 3 to 5 words seperate by dashes, LIMIT 50 chars<br />
                            <input name="page_field1" type="text" id="page_field1" size="50" maxlength="50" value="<?php echo $_POST['page_field1']; ?>" />.php
                        </p>
                        <p>
                            Content Type: <select id="content_type" name="content_type">
                                <?php
                                if (isset($_POST['content_type'])) {
                                    echo '<option value="' . $_POST['content_type'] . '">' . $_POST['content_type'] . '</option>';
                                }
                                ?>
                                <option value="article">Article</option>
                                <option value="video">Video</option>	
                            </select> 
                        </p>
                        <p>
                            Page Title: LIMIT 20 chars<br />
                            <input name="page_title" id="page_title" type="text" size="50" maxlength="20" value="<?php echo $_POST['page_title']; ?>" />
                        </p>        
                        <p>
                            Page Description: LIMIT 90 chars<br />
                            <textarea name="page_desc" id="page_desc" cols="100" rows="2" ><?php echo $_POST['page_desc']; ?></textarea>
                        </p>   
                        <p>
                            Page Keywords: LIMIT 200 chars<br />
                            <textarea name="page_keywords" id="page_keywords" cols="100" rows="6"><?php echo $_POST['page_keywords']; ?></textarea>
                        </p>              
                        <!-- begin VIDEO type fields -->
                        <p>
                            Upload a Video: LIMIT 100MB with DIMENSIONS of '500 pixels' (width) x '375 pixels' (height)<br />
                            <input type="file" name="video_file" id="video_file" /> Pending: <?php echo $_SESSION['content_array'][$id_now]['video_file']; ?>  
                            <br />
                            PREVIEW: <img src="../images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['video_file']; ?>" width="500" height="375"  />
                        </p>
                        <!-- end VIDEO type fields -->
                        <!-- begin ARTICLE type fields -->
                        <p>
                            Article Image LARGE: LIMIT 150kb with DIMENSIONS of '190 pixels' x '190 pixels'<br />
                            <input type="file" name="page_img_large" id="page_img_large" /> Pending: <?php echo $_SESSION['content_array'][$id_now]['page_img_large']; ?>
                            <br />
                            <img src="../images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large']; ?>" width="190" height="190"  />
                            <img src="../images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large']; ?>" width="120" height="120"  />
                        </p>                    
                        <!--
                        <p>
                                Article Image SMALL: LIMIT 75kb with DIMENSIONS of '?pixels' x '?pixels'<br />
                          <input type="file" name="page_img_small" id="page_img_small" /> Pending: <?php echo $_SESSION['content_array'][$id_now]['page_img_small']; ?> PREVIEW: <img src="http://'.$_SERVER['HTTP_HOST'].'/images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_small']; ?>"  />
                        </p>
                        -->                              
                        <!-- end ARTICLE type fields -->
                        <p align="center">Article Content Editor - (removing SPAW v2 - replace with TinyMCE)
                            <br />
                            <input type="submit" name="submit_for_publish" id="submit_for_publish" value="SUBMIT THIS PAGE - (BUTTON FOR PUBLISHER ONLY)" />
                            <input type="hidden" name="publish_page" id="publish_page" value="1" />
                            <!--
                            <input type="submit" name="submit_preview_page" id="submit_preview_page" value="PREVIEW" />
                            <input type="submit" name="submit_final_page" id="submit_final_page" value="SUBMIT THIS PAGE" />
                            -->
                        </p>
                    </form>
                              
                </div>
                <!-- admin -- end -->
                <div id="foot-pad">
                    <div class="shadow-purple"></div>
                    <img src="../images/foot-pad.png" height="46" width="990" />
                </div>
<?php include("../template/page_footer_cms.php"); ?>

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