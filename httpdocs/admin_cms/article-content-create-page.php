<?php
ob_start(); 
?>

<!DOCTYPE html>
    <head>
        <?php
        $id_now = $_GET['id'];
        include("../includes/jmcms_db_conn_cms.php");
        ?>    

        <meta name="robots" content="noindex, nofollow" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?> | Read Articles | </title>
        <link type="text/css" rel="stylesheet" href="../css/style2a.css" />
        <link type="text/css" rel="stylesheet" href="../css/admin-console-style-3b.css" />
        <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
        <script src="../js/flowplayer-3.2.6.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/dd_menu.js"></script>                

    </head>

    <body>
        <div id="main">
            <div id="main2">
                <?php include ('../template/page_top.php'); ?>
                <!-- end page_top.php -->
                <h3 align="center">ARTICLE PREVIEW PAGE - This is a preview of the article content page you have submitted<br />
                    <?php
                    if ($_SESSION['user_current'] == 'admin' || $_SESSION['user_current'] == 'publisher') {
                        echo '
<form id="form1" name="form1" method="post" action="#">
  <input type="hidden" name="publisher_rights" id="publisher_rights" value="' . $publisher_rights . '" />
  <input type="submit" name="publish_page" id="publish_page" value="Publish This Page" />
  <input type="submit" name="deactivate_page" id="deactivate_page" value="Deactivate This Page" />  
</form>';
                    }
                    ?>
                </h3>
                <h4 align="center"> -Current Page Status is => <span style="color:#F00;"><?php echo $_SESSION['content_array'][$id_now]['published_status']; ?></span> <= - <a href="edit-existing-page.php?id=<?php echo $id_now; ?>" style="background:#FFF;">Make an edit</a> - <a href="home-admin.php" style="background:#FFF;">Back to Home</a></h4>
                <!-- banner == start -->

                <div id="banner-article">
                    <div id="left-article">
                        <div id="right-article">
                            <?php
                            //Video for Odd numbers, Article for Even Numbers...
                            $count_video = 3; // How many videos to show
                            $count_article = 3; // How many articles to show
                            $count_toggler = 0;
                            $content_counter = 0;
                            $temp_array = $_SESSION['content_array'];
                            do {
                                foreach ($temp_array as $record) {
                                    $content_counter++;
                                    $id = $record['id'];
                                    //echo 'id = '.$id.' => content_type = '.$record['content_type'].' => record count - '.$content_counter.'</p>';	
                                    if ($record['content_type'] == 'video' && /* $record['published_status'] == 'live' && */ $count_video >= 0 && $count_toggler == 0) {
                                        echo '                    
							<div class="right-vid-wrapper">
								<div class="right-vid-icon"> <a href="../video.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '"><img src="../images/cms/' . $id . '/' . $_SESSION['content_array'][$id]['page_img_large'] . '" width="120" height="120" /></a>
							</div>
							
								<div class="right-vid-text">
									<h4 class="bluevid"><a href="../video.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '">' . $_SESSION['content_array'][$id]['page_title'] . '</a></h4>
									<span class="black">' . $_SESSION['content_array'][$id]['page_desc'] . '</span>
									<h5 class="bluevid"><a href="../video.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '" >Watch Video</a></h5>
								</div>
							</div>
							';
                                        $count_toggler = 1;
                                        --$count_video;
                                        //echo '<p>count videos - '.$count_video.' => toggler - '.$count_toggler.'</p>';
                                        unset($temp_array[$id]);
                                    } elseif ($record['content_type'] == 'article' && /* $record['published_status'] == 'live' && */ $count_article >= 0 && $count_toggler == 1) {
                                        echo '                    
							<div class="right-vid-wrapper">
								<div class="right-vid-icon"><a href="../article.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '"><img src="../images/cms/' . $id . '/' . $_SESSION['content_array'][$id]['page_img_large'] . '" alt="" width="120" height="120" /></a></div>
								
								<div class="right-vid-text">
									<h4 class="greenart"><a href="../article.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '">' . $_SESSION['content_array'][$id]['page_title'] . '</a></h4>
									<span class="black">' . $_SESSION['content_array'][$id]['page_desc'] . '</span>
									<h5 class="greenart"><a href="../article.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '" >Read More</a></h5>
								</div>
							</div>
						 ';
                                        $count_toggler = 0;
                                        --$count_article;
                                        unset($temp_array[$id]);
                                    }
                                }
                            } while ($count_article > 0 && $count_video > 0);
                            ?>
                        </div>

                        <h1 class="deep-green"><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?></h1>

                        <div class="article">
                            <img src="../images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large']; ?>" width="190" height="190" class="article-image" />

                        </div>
                        <div class="content">
                            <?php echo $_SESSION['content_array'][$id_now]['page_content']; ?>
                        </div>
                    </div><!-- begin right-video div --></div><!-- banner == end -->
                <!-- footer == start -->
                <!-- foot-pad - start --><!-- foot-pad == end -->
<?php include ('../template/page_footer.php'); ?>
                <!-- footer == end -->
            </div><!-- main2 == end -->
        </div><!-- main == end -->

        <pre>JMicrositeCMS Content Management System - v0.3 beta</pre>
    </body>
</html>
