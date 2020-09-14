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
        <title><?php echo $_SESSION['content_array'][$id_now]['page_title']; ?> | Your Business Name  | Distributor</title>        

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
                        <!--<div class="distributor-div" style="width:500px; height:375px;">-->
                        <div class="distributor-div">
                            <img src="../images/cms/<?php echo $id_now . '/' . $_SESSION['content_array'][$id_now]['page_img_large']; ?>" width="500" height="375" class="article-image" alt="<?php echo $_SESSION['content_array'][$id_now]['page_field1']; ?>" />                            
                        </div>

                        <?php if (!empty($_SESSION['content_array'][$id_now]['content_hlink'])) { ?>
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
                                if ($record['content_type'] == 'distributor' && /* $record['published_status'] == 'live' && */ $count_video >= 0 && $count_toggler == 0) {
                                    ?>                    
                                    <div class="right-vid-wrapper">
                                        <div class="right-vid-icon"> 
                                            <a href="/distributors/distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                <img src="../images/cms/<?php echo $id; ?>/<?php echo $_SESSION['content_array'][$id]['page_img_large']; ?>" width="120" height="120" />
                                            </a>
                                        </div>

                                        <div class="right-vid-text">
                                            <h4 class="bluevid">
                                                <a href="/distributors/distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                    <?php echo $_SESSION['content_array'][$id]['page_title']; ?>
                                                </a>
                                            </h4>
                                            <span class="black">
                                                <?php echo $_SESSION['content_array'][$id]['page_desc']; ?>
                                            </span>
                                            <h5 class="bluevid">
                                                <a href="/distributors/distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
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
                                            <a href="/distributors/distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                <img src="../images/cms/<?php echo $id; ?>/<?php echo $_SESSION['content_array'][$id]['page_img_large']; ?>" alt="" width="120" height="120" />
                                            </a>
                                        </div>

                                        <div class="right-vid-text">
                                            <h4 class="greenart">
                                                <a href="/distributors/distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
                                                    <?php echo $_SESSION['content_array'][$id]['page_title']; ?>
                                                </a>
                                            </h4>
                                            <span class="black">
                                                <?php echo $_SESSION['content_array'][$id]['page_desc']; ?>
                                            </span>
                                            <h5 class="greenart">
                                                <a href="/distributors/distributor.php?id=<?php echo $_SESSION['content_array'][$id]['id']; ?>&tag=<?php echo $_SESSION['content_array'][$id]['page_field1']; ?>">
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
                            if ($content_counter > 50) {
                                break;
                            } //explosion prevention!
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