<!DOCTYPE html>
<html>
    <head>
<?php 
$id_now = $_GET['id'];
    include_once("../includes/jmcms_db_conn_vistors.php"); //config
    include_once('../template/head-themed.php'); //theme
?>           
        <meta name="description" content="<?php echo $_SESSION['content_array'][$id_now]['page_desc']; ?>" />
        <meta name="keywords" content="<?php echo $_SESSION['content_array'][$id_now]['page_keywords']; ?>" />    
        <title><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?>|Video|</title>
        <!-- BEGIN Video.js CDN -->
        <link href="//vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />

        <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
        <script src="//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
        <!-- END Video.js CDN -->
    </head>

    <body>
        <!-- main -- start -->
        <div id="main">	
            <!-- main2 -- start -->
            <div id="main2">
                <!-- main2 -- end -->	  
                <!-- nav_bar -- start -->
                <!-- begin page_top.php -->
                <?php include ('../template/page_top.php'); ?>
                <!-- end page_top.php -->        
                <!-- banner -- start -->
                <div id="banner-vid" >
                    <div id="left-video">
                        <h1 class="bluevid"><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?></h1>
                        <div class="video-div" style="width:500px; height:375px;">

                            
                            <?php $poster_image =  '../images/cms/' . $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large'] ; ?>
                            <?php if (isset($_GET['debug'])) {echo '<pre>'.$poster_image.'</pre>';} ?>
                            <!-- Add the following to <video> below for thumbnail: poster="/images/poster-image-goes-here.jpg" -->
                            <video id="my-video" class="video-js" 
                            controls preload="auto" 
                            width="500" height="375" 
                            poster="<?php echo $poster_image; ?>"
                            data-setup="{}">
                                <!-- TODO: add video/media type selector based on file extension? -->
                                <!-- <source src="/videos/MY_VIDEO.mp4" type="video/mp4" /> -->
                                <!-- <source src="/videos/MY_VIDEO.webm" type="video/webm" /> -->
                                <?php $video_url = '/images/cms/' . $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_extra'] ; ?>
                                <?php echo '<pre>'.$video_url.'</pre>';?>
                                <source src="<?php echo $video_url;?>" type="video/mp4" />                                                                
                                <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="//videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                </p>
                            </video>

                            <script src="//vjs.zencdn.net/7.8.4/video.js"></script>

                        </div>
                        <div>
                            <p class="black"><?php echo $_SESSION['content_array'][$id_now]['page_content']; ?></p>	
                        </div>
                        <h4 class="bluevid" align="right"><a href="/videos/">Watch All Videos</a></h4>
                    </div>

                    <!-- begin right-video div - DYNAMIC-->
                    <div id="right-video">    
                        <?php
                        //Video for Odd numbers, Article for Even Numbers...
                        $count_video = 3; // How many videos to show
                        $count_article = 3; // How many articles to show
                        $count_toggler = 0; // 1 starts with articles, 0 starts with videos
                        $content_counter = 0;
                        $temp_array = $_SESSION['content_array'];
                        unset($temp_array[$id_now]);
                        do {
                            foreach ($temp_array as $record) {
                                $content_counter++;
                                $id = $record['id'];
                                //echo 'id = '.$id.' => content_type = '.$record['content_type'].' => record count - '.$content_counter.'</p>';	
                                if ($record['content_type'] == 'video' && $record['published_status'] == 'live' && $count_video >= 0 && $count_toggler == 0) {
                                    if ($record['id'] != $id_now) {
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
                                    }
                                } elseif ($record['content_type'] == 'article' && $record['published_status'] == 'live' && $count_article >= 0 && $count_toggler == 1) {
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
                        <!-- end right-video div -->  

                    </div>
                    <!-- banner -- end -->

                    <!-- footer -- start -->
                    <!-- foot-pad - start -->
                    <div id="foot-pad">
                        <div class="shadow-purple"></div>
                        <img src="../images/foot-pad.png" alt="" height="46" width="990" />
                    </div>
                    <!-- foot-pad -- end -->
                </div>
<?php include ('../template/page_footer.php'); ?>


                <!-- main2 -- end -->
            </div>
            <!-- main -- end -->

    </body>
</html>