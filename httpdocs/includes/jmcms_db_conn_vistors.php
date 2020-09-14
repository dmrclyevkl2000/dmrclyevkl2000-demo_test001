<?php //jmcms_db_conn_vistors.php
if (session_id() == '') {
    // session has NOT been started
    session_start();
}

include_once("config_setup.php"); // db handler and other settings are here

// added to mix up content on article.php and video.php for greater visibility
if (isset($current_content_type)) {
    $sql_content_type = ' and content_type = "'.$current_content_type.'"';
    // added ability to show both articles and videos on the same page
    if ($current_content_type == 'article' || $current_content_type == 'video') {
        $sql_content_type = ' and content_type in ("article","video")';
    }
} else {
    $sql_content_type = '';
}

//////////////////// PDO //////////////////////////
$STH = $DBH->prepare('SELECT * 
            FROM 
                    content                    
            WHERE
                    id is not null
                    and published_status = "live"
                    '.$sql_content_type.'
            ORDER BY content_date DESC');

$STH->bindParam(1, $sql_content_type);
$STH->execute();
$STH->setFetchMode(PDO::FETCH_ASSOC);

$result1 = $STH->fetchAll();

//define arrays and multidimensional arrays...		
$id = array();
$content_array = array();
$_SESSION['content_array'] = array();
$left_column_article_array = array();
$right_column_article_array = array();
$left_column_video_array = array();
$right_column_video_array = array();
$left_column_distributor_array = array();
$right_column_distributor_array = array();
// declare vars and set counters
$content_counter = 0;

$article_count = 0;
$video_count = 0;
$distributor_count = 0;

$id_highest = 0;
$toggler_a_loader = 0;
$toggler_v_loader = 0;
$toggler_d_loader = 0;

/* SESSION ARRAY BUILDER - CONTENT ARRAY */
foreach ($result1 as $row1) { //pulls multiple results in a loop    
    $id = $row1['id'];

    $content_array[$id] = array('id' => $id,
        'page_field1' => $row1['page_field1'],
        'content_author' => $row1['content_author'],
        'content_type' => $row1['content_type'],
        'content_date' => $row1['content_date'],
        'page_title' => $row1['page_title'],
        'page_desc' => $row1['page_desc'],
        'page_keywords' => $row1['page_keywords'],
        'page_content' => $row1['page_content'],
        'page_img_large' => $row1['page_img_large'],
        'content_hlink' => $row1['content_hlink'],
        'page_img_small' => $row1['page_img_small'],
        'page_img_extra' => $row1['page_img_extra'],
        'published_status' => $row1['published_status'],
        'page_permalink' => $row1['page_permalink'],
        'theme_control' => $row1['theme_control'],
    );
    $_SESSION['content_array'] = $content_array;

    $content_counter++;

        if ($row1['content_type'] == 'article' && $row1['published_status'] == 'live') {
            //$temp_array_article[$article_count] = $content_array[$id];
            $article_count++;
            if ($toggler_a_loader == 0) {
                $left_column_article_array[$id] = array('id' => $row1['id']);
                $toggler_a_loader = 1;
            } elseif ($toggler_a_loader == 1) {
                $right_column_article_array[$id] = array('id' => $row1['id']);
                $toggler_a_loader = 0;
            }
        }

        if ($row1['content_type'] == 'video' && $row1['published_status'] == 'live') {
            //$temp_array_video[$video_count] = $content_array[$id];				
            $video_count++;
            if ($toggler_v_loader == 0) {
                $left_column_video_array[$id] = array('id' => $row1['id']);
                $toggler_v_loader = 1;
            } elseif ($toggler_v_loader == 1) {
                $right_column_video_array[$id] = array('id' => $row1['id']);
                $toggler_v_loader = 0;
            }
        }
    
    if ($row1['content_type'] == 'distributor' && $row1['published_status'] == 'live') {
        //$temp_array_video[$video_count] = $content_array[$id];				
        $distributor_count++;
        if ($toggler_d_loader == 0) {
            $left_column_distributor_array[$id] = array('id' => $row1['id']);
            $toggler_d_loader = 1;
        } elseif ($toggler_d_loader == 1) {
            $right_column_distributor_array[$id] = array('id' => $row1['id']);
            $toggler_d_loader = 0;
        }
    }    
} //end foreach loop #1 here...

//$DB1->Close(); // This connection builds the 'content_array' in the $_SESSION - SELECT from DB and Tables
closePDO( $DBH );

