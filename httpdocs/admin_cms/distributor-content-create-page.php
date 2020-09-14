<?php
$id_now = $_GET['id'];
//$id_now = $_POST['id_content'];

include("../includes/jmcms_db_conn_cms.php");
?>

<!DOCTYPE html>
    <head>
        
        <meta name="robots" content="noindex, nofollow" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?> | Watch Videos | </title>
        <link type="text/css" rel="stylesheet" href="../css/style2a.css" />
        <link type="text/css" rel="stylesheet" href="../css/admin-console-style-3b.css" />
        <script src="../js/flowplayer-3.2.6.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/dd_menu.js"></script>
    </head>

    <body>
        <?php /*CMS admin console template page header goes here? */ ?>
        <div id="main">
            <div id="main2">
                <div id="admin-console">
                <h3 align="center">DISTRIBUTOR PREVIEW PAGE - This is a preview of the distributor content page you have submitted<br />
                    <?php
                    if ($_SESSION['user_current'] == 'admin' || $_SESSION['user_current'] == 'publisher') {
                        ?>
                        <form id="form1" name="form1" method="post" action="#">
                            <input type="hidden" name="publisher_rights" id="publisher_rights" value="<?php echo $publisher_rights; ?>" />
                            <input type="submit" name="publish_page" id="publish_page" value="Publish This Page" />
                            <input type="submit" name="deactivate_page" id="deactivate_page" value="Deactivate This Page" />  
                        </form>
                        <?php
                    }
                    ?>
                </h3>
                <h4 align="center"> -Current Page Status is =><span style="color:#F00;"> <?php echo $_SESSION['content_array'][$id_now]['published_status']; ?> </span> <= - <a href="edit-existing-page.php?id=<?php echo $id_now; ?>" style="background:#FFF;">Make an edit</a> - <a href="home-admin.php" style="background:#FFF;">Back to Home</a></h4>                
                </div>
                <?php include ('../template/page_top.php'); ?>
                <!-- end page_top.php -->        

                <!-- banner -- start -->
                <div id="banner-vid" >
                    <div id="left-video">
                        <h1 class="bluevid"><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?></h1>
                        <!--<div class="distributor-div" style="width:500px; height:375px;">-->
                        <div class="distributor-div">
                            <img src="/images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large']; ?>" width="500" height="375" class="article-image" alt="<?php echo $_SESSION['content_array'][$id_now]['page_field1']; ?>" />                            
                        </div>
                        
                        <?php if (!empty($_SESSION['content_array'][$id_now]['content_hlink']) ) { ?>
                        <div>
                            <p class="black">
                                <a href="<?php echo trim($_SESSION['content_array'][$id_now]['content_hlink']); ?>" target="_blank">Visit the website - <?php echo $_SESSION['content_array'][$id_now]['content_hlink']; ?></a>
                            </p>	
                        </div>                        
                        <?php } ?>
                        
                        <div>
                            <p class="black"><?php echo trim($_SESSION['content_array'][$id_now]['page_content']); ?></p>	
                        </div>
                    </div>
                    <div id="right-video">    
                        <?php
                        //Video for Odd numbers, Article for Even Numbers... //MODIFIED FOR DISTRIBUTORS - left it to offset colors of links (and for randomly selecting which to show [later?])
                        $count_video = 3; // How many videos to show
                        $count_article = 3; // How many articles to show
                        $count_toggler = 1; // 0 start with Video, 1 start with Article
                        $content_counter = 0;
                        $temp_array = $_SESSION['content_array'];
                        do {
                            foreach ($temp_array as $record) {
                                $content_counter++;
                                $id = $record['id'];
                                //echo 'id = '.$id.' => content_type = '.$record['content_type'].' => record count - '.$content_counter.'</p>';	
                                if ($record['content_type'] == 'distributor' && /* $record['published_status'] == 'live' && */ $count_video >= 0 && $count_toggler == 0) {
                                    ?>                    
                                    <div class="right-vid-wrapper">
                                        <div class="right-vid-icon"> 
                                            <a href="../distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                <img src="../images/cms/<?php echo $id; ?>/<?php echo $_SESSION['content_array'][$id]['page_img_large']; ?>" width="120" height="120" />
                                            </a>
                                        </div>

                                        <div class="right-vid-text">
                                            <h4 class="bluevid">
                                                <a href="../distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                    <?php echo $_SESSION['content_array'][$id]['page_title']; ?>
                                                </a>
                                            </h4>
                                            <span class="black">
                                                <?php echo $_SESSION['content_array'][$id]['page_desc']; ?>
                                            </span>
                                            <h5 class="bluevid">
                                                <a href="../distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                    View Distributor
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                    <?php
                                    $count_toggler = 1;
                                    --$count_video;
                                    //echo '<p>count videos - '.$count_video.' => toggler - '.$count_toggler.'</p>';
                                    unset($temp_array[$id]);
                                } elseif ($record['content_type'] == 'distributor' && /* $record['published_status'] == 'live' && */ $count_article >= 0 && $count_toggler == 1) {
                                    ?>                    
                                    <div class="right-vid-wrapper">
                                        <div class="right-vid-icon">
                                            <a href="../distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                <img src="../images/cms/<?php echo $id; ?>/<?php echo $_SESSION['content_array'][$id]['page_img_large']; ?>" alt="" width="120" height="120" />
                                            </a>
                                        </div>

                                        <div class="right-vid-text">
                                            <h4 class="greenart">
                                                <a href="../distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                    <?php echo $_SESSION['content_array'][$id]['page_title']; ?>
                                                </a>
                                            </h4>
                                            <span class="black">
                                                <?php echo $_SESSION['content_array'][$id]['page_desc']; ?>
                                            </span>
                                            <h5 class="greenart">
                                                <a href="../distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                    Read More
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                    <?php
                                    $count_toggler = 0;
                                    --$count_article;
                                    unset($temp_array[$id]);
                                }
                            }
                        } while ($count_article > 0 && $count_video > 0);
                        ?>
                    </div>
                </div>
                <?php include ('../template/page_footer.php'); ?>
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