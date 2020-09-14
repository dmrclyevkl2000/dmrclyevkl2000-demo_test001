<?php
//gallery page template
include("includes/jmcms_db_conn_vistors.php");
//$_SESSION['user_current'] = 'visitor';
$id_now = $_GET['id'];
?>
<!DOCTYPE html>
    <head>
        <meta name="description" content="<?php echo $_SESSION['content_array'][$id_now]['page_desc']; ?>" />
        <meta name="keywords" content="<?php echo $_SESSION['content_array'][$id_now]['page_keywords']; ?>" />        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?>|Gallery|</title>
        <link type="text/css" rel="stylesheet" href="css/style2a.css" />
        <script type="text/javascript" src="js/dd_menu.js"></script>
        <script src="js/flowplayer-3.2.6.min.js" type="text/javascript"></script>
    </head>
    <body>
        <!-- main == start -->

        <div id="main">
            <!-- main2 == start -->

            <div id="main2">
                <!-- main2 == end -->
                <!-- nav_bar == start -->
                <!-- begin page_top.php -->
<?php include ('template/page_top.php'); ?>
                <!-- end page_top.php -->
                <!-- banner == start -->

                <div id="banner-article">
                    <div id="left-article">
                        <div id="right-article">
                            <?php
                            //Video for Odd numbers, Article for Even Numbers...
                            $count_video = 3; // How many videos to show
                            $count_article = 3; // How many articles to show
                            $count_toggler = 1; // 1 starts with articles, 0 starts with videos
                            $content_counter = 0;
                            $temp_array = $_SESSION['content_array'];
                            unset($temp_array[$id_now]);

                            do {
                                foreach ($temp_array as $record) {
                                    $content_counter++;
                                    $id = $record['id'];
                                    //echo 'id = '.$id.' => content_type = '.$record['content_type'].' => record count - '.$content_counter.'</p>';	
                                    if ($record['content_type'] == 'video' && $record['published_status'] == 'live' && $count_video >= 0 && $count_toggler == 0) {
                                        echo '                    
							<div class="right-vid-wrapper">
								<div class="right-vid-icon"> <a href="video.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '"><img src="images/cms/' . $id . '/' . $_SESSION['content_array'][$id]['page_img_large'] . '" width="120" height="120" alt="' . $_SESSION['content_array'][$id]['page_field1'] . '" /></a>
							</div>
							
								<div class="right-vid-text">
									<h4 class="bluevid"><a href="video.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '">' . $_SESSION['content_array'][$id]['page_title'] . '</a></h4>
									<span class="black">' . $_SESSION['content_array'][$id]['page_desc'] . '</span>
									<h5 class="bluevid"><a href="video.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '" >Watch Video</a></h5>
								</div>
							</div>
							';
                                        $count_toggler = 1;
                                        --$count_video;
                                        //echo '<p>count videos - '.$count_video.' => toggler - '.$count_toggler.'</p>';
                                        unset($temp_array[$id]);
                                    } elseif ($record['content_type'] == 'article' && $record['published_status'] == 'live' && $count_article >= 0 && $count_toggler == 1) {
                                        if ($record['id'] != $id_now) {
                                            echo '                    
							<div class="right-vid-wrapper">
								<div class="right-vid-icon"><a href="article.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '"><img src="images/cms/' . $id . '/' . $_SESSION['content_array'][$id]['page_img_large'] . '" alt="' . $_SESSION['content_array'][$id]['page_field1'] . '" width="120" height="120" /></a></div>
								
								<div class="right-vid-text">
									<h4 class="greenart"><a href="../article.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '">' . $_SESSION['content_array'][$id]['page_title'] . '</a></h4>
									<span class="black">' . $_SESSION['content_array'][$id]['page_desc'] . '</span>
									<h5 class="greenart"><a href="article.php?id=' . $_SESSION['content_array'][$id]['id'] . '&tag=' . $_SESSION['content_array'][$id]['page_field1'] . '" >Read More</a></h5>
								</div>
							</div>
						 ';

                                            $count_toggler = 0;
                                            --$count_article;
                                            //echo '<p>count article - '.$count_article.' => toggler - '.$count_toggler.'</p>';
                                            unset($temp_array[$id]);
                                        } // END nested IF - prevents "preview" of an ARTICLE page while viewing the content page with the same id.
                                    }
                                    /*
                                      else
                                      {
                                      echo "<p>WIFF! on id= $id -
                                      type= ".$record['content_type']." -
                                      toggler= $count_toggler -
                                      vids= $count_video -
                                      arts= $count_article </p>";
                                      }
                                     */
                                }
                                if ($content_counter > 50) {
                                    break;
                                }
                            } while (($count_article > 0 && $count_video > 0));
                            echo '<!-- <p>content_counter = ' . $content_counter . '</p> -->';
                            ;
                            ?>
                            <h4 class="greenart" align="right"><a href="more-articles.php">Read All Articles</a></h4>
                        </div>

                        <h1 class="deep-green"><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?></h1>

                        <div class="article">
                            <img src="images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large']; ?>" width="190" height="190" class="article-image" alt="<?php echo $_SESSION['content_array'][$id_now]['page_field1']; ?>" />
<?php echo $_SESSION['content_array'][$id_now]['page_content']; ?>
                        </div>
                    </div>            
                </div>
                <!-- banner == end -->

                <!-- footer -- start -->
                <!-- foot-pad - start -->
                <div id="foot-pad">
                    <div class="shadow-purple"></div>
                    <img src="images/foot-pad.png" alt="" height="46" width="990" />
                </div>
                <!-- foot-pad -- end -->
            </div>
<?php include ('template/page_footer.php'); ?>


            <!-- main2 -- end -->
        </div>
        <!-- main -- end -->

    </body>
</html>