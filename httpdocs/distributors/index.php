<!DOCTYPE html>
<html>
    <head>
<?php 
$current_content_type = 'distributor'; //must be set!
$id_now = $_GET['id'];
    include_once("../includes/jmcms_db_conn_vistors.php"); //config
    include_once('../template/head-themed.php'); //theme
?>                
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <title>More Distributors for Tile, Flooring & Fixtures for renovations & remodeling</title>

    </head>
    <body>
        <!-- main -- start  --> 
        <div id="main"> 

            <!-- main2 -- start -->
            <div id="main2">
                <!-- main2 -- end -->

                <!-- begin page_top.php -->
                <?php include ('../template/page_top.php'); ?>
                <!-- end page_top.php -->

                <!-- banner -- start -->
                <div id="banner-vid" >
                    <!-- begin left-morevideo div -->
                    <div id="left-morevideo">

                        <h1 id="title" class="bluevid">Distributors & Partners</h1>  
                        <?php
                        // show videos on left side...
                        foreach ($left_column_distributor_array as $left_record) {
                            $id_left = $left_record['id'];
                            if ($distributor_count > -1 && $_SESSION['content_array'][$id_left]['published_status'] == 'live' && (isset($left_record['id']))) {
                                echo '                        
                            <div class="right-vid-wrapper">
                                
                          <div class="right-vid-icon"><a href="distributor.php?id=' . $_SESSION['content_array'][$id_left]['id'] . '&tag=' . $_SESSION['content_array'][$id_left]['page_field1'] . '"><img src="../images/cms/' . $id_left . '/' . $_SESSION['content_array'][$id_left]['page_img_large'] . '" alt="' . $_SESSION['content_array'][$id_left]['page_field1'] . '" width="120" height="120" /></a></div>
                            
                                <div class="right-vid-text">
                                    <h4 class="bluevid"><a href="distributor.php?id=' . $_SESSION['content_array'][$id_left]['id'] . '&tag=' . $_SESSION['content_array'][$id_left]['page_field1'] . '">' . $_SESSION['content_array'][$id_left]['page_title'] . '</a></h4>
                                    <span class="black">' . $_SESSION['content_array'][$id_left]['page_desc'] . '</span>
                                    <h5 class="bluevid"><a href="distributor.php?id=' . $_SESSION['content_array'][$id_left]['id'] . '&tag=' . $_SESSION['content_array'][$id_left]['page_field1'] . '">Distributor Details</a></h5>
                                </div>
                            </div>
              		 ';
                                unset($left_record);
                                $distributor_count--;
                                $toggler = 1;
                            }
                            /*
                              elseif ($distributor_count < 0)
                              {
                              '';
                              }
                             */
                        }
                        ?>                       

                    </div>
                    <!-- end left-morevideo div -->
                    <!-- begin right-morevideo div -->
                    <div id="right-morevideo">
<?php
// show  video on right side...
foreach ($right_column_distributor_array as $right_record) {
    $id_right = $right_record['id'];
    if ($distributor_count > -1 && $_SESSION['content_array'][$id_right]['published_status'] == 'live' && (isset($right_record['id']))) {
        echo '                        
                          <div class="right-vid-wrapper">
                                
                          <div class="right-vid-icon"><a href="distributor.php?id=' . $_SESSION['content_array'][$id_right]['id'] . '&tag=' . $_SESSION['content_array'][$id_right]['page_field1'] . '"><img src="../images/cms/' . $id_right . '/' . $_SESSION['content_array'][$id_right]['page_img_large'] . '" alt="' . $_SESSION['content_array'][$id_right]['page_field1'] . '" width="120" height="120" /></a></div>
                            
                                <div class="right-vid-text">
                                    <h4 class="bluevid"><a href="distributor.php?id=' . $_SESSION['content_array'][$id_right]['id'] . '&tag=' . $_SESSION['content_array'][$id_right]['page_field1'] . '">' . $_SESSION['content_array'][$id_right]['page_title'] . '</a></h4>
                                    <span class="black">' . $_SESSION['content_array'][$id_right]['page_desc'] . '</span>
                                    <h5 class="bluevid"><a href="distributor.php?id=' . $_SESSION['content_array'][$id_right]['id'] . '&tag=' . $_SESSION['content_array'][$id_right]['page_field1'] . '">Distributor Details</a></h5>
                                </div>
                            </div>
              		 ';
        //echo "<p>$count_right_article</p>";
        unset($right_record);
        $distributor_count--;
        $toggler = 0;
    } // end if for toggler right columns
}// each foreach loop for left content
;
?>                    
                        <!-- end right-morevideo div -->  

                    </div>
                    <!-- banner -- end -->

                    <!-- footer -- start -->

                </div>
                    <!-- foot-pad - start -->
                    <div id="foot-pad">
                        <div class="shadow-purple"></div>
                        <img src="../images/foot-pad.png" alt="" height="46" width="990" />
                    </div>
                    <!-- foot-pad -- end -->                
<?php include ('../template/page_footer.php'); ?>


                <!-- main2 -- end -->
            </div>
            <!-- main -- end -->
<?php /*
  echo '<p>'.print_r($left_column_distributor_array, 1).'</p>';
  echo '<p>'.print_r($right_column_distributor_array, 1).'</p>';
 */ ?>        
    </body>
</html>