<?php
// jmcms_db_conn_cms.php
// $_SESSION['insert_test'] = '';
// $_SESSION['update_test'] = '';
// $_SESSION['hit_me'] = '';
$count_hits = 0;
if (session_id() == '') {
    // session has NOT been started
    // session_destroy();
    session_start();
}

include('config_setup.php');

//////////////////////// VERSION CONTROL /////////////////////////////////
$_SESSION['theme_control'] = 'v0.3beta';

////////////////////// SET PUBLISHER RIGHTS //////////////////////////////	
// Publisher Rights Checking - Will add user_type field to the CMS Login Table...
if ($_SESSION['user_current'] == 'admin' || $_SESSION['user_current'] == 'publisher') {
    $publisher_rights = 1;
} elseif ($_SESSION['user_current'] == 'editor') {
    $publisher_rights = 0;
} else {
    header('Location: index.php?fail=' . ++$failed_logins . '');
}
///////////////////////////////////////////////////////////////////////////////
////////////////////// CHECK THE LOGIN TABLE (COMING SOON???) /////////////////
//TODO: Add a unique Key column to the content table that doesn't rely on AUTO_INCREMENT 
// --- Values to increase by one "automatically", or be synchronized to the content itself 
// --- (eg: SELECT * FROM content WHERE unique_hash_key = '23rie1skdw9')
// - alter table content AUTO_INCREMENT={$id_of_highest_id_in_rows_plus1} //use this for now, when required to edit or delete rows from content DB table (see also: https://stackoverflow.com/questions/1485668/how-to-set-initial-value-and-auto-increment-in-mysql )
# MySQL DB HANDLER
$STH = $DBH->prepare('SELECT * 
            FROM 
                    content                    
            WHERE
                    id is not null
            ORDER BY content_date DESC');
$STH->execute();
$STH->setFetchMode(PDO::FETCH_ASSOC);

$result1 = $STH->fetchAll();
//JSON OBJ FROM PDO
$json_result1 = json_encode($result1);

//define arrays and multidimensional arrays...		
$id = array();
$content_array = array();
$_SESSION['content_array'] = array();
$content_counter = 0;
$id_highest = 0;
foreach ($result1 as $row1) { //pulls multiple results in a loop
    // set variables
    $id = $row1['id'];
    $page_content = $row1['page_content'];
if (isset($_SESSION['content_array'][$id]['id']) && $page_content !== $_SESSION['content_array'][$id]['page_content'] && $id === $_SESSION['content_array'][$id]['id']) {
    $page_content = $_SESSION['content_array'][$id]['page_content'];
    $_SESSION['v'] = $_SESSION['v'].'BARF!'.'<br />';
} else {
    $page_content = $page_content;
    $_SESSION['v'] = $_SESSION['v'].'PUKE!'.'<br />';
}    
    
    $content_array[$id] =
            array('id' => $id,
                'content_file' => $row1['content_file'],
                'author' => $row1['content_author'],                
                'content_type' => $row1['content_type'],
                'content_date' => $row1['content_date'],
                'page_title' => $row1['page_title'],
                'page_desc' => $row1['page_desc'],
                'page_keywords' => $row1['page_keywords'],
                //'page_content' => $row1['page_content'],
                'page_content' => $page_content,
                'content_hlink' => $row1['content_hlink'],
                'page_img_large' => $row1['page_img_large'],
                'page_field1' => $row1['page_field1'],
                'page_img_small' => $row1['page_img_small'],
                'page_field2' => $row1['page_field2'],
                'page_img_extra' => $row1['page_img_extra'],
                'page_field3' => $row1['page_field3'],
                'published_status' => $row1['published_status'],
                'page_permalink' => $row1['page_permalink'],
                'theme_control' => $row1['theme_control']
    );
    $_SESSION['content_array'] = $content_array;
    if ($id_highest < $id) {
        $id_highest = $id;
    }
    $content_counter++;
} //end foreach loop #1 here...
// add 1 (one) to highest 'id' value of records

$id_adder = 1 + $id_highest;

////////////////// UPLOAD AND/OR CHECK FOR NEW FILES ////////////////////////////////////
////////////////// Image and Video $_FILES uploading ////////////////////////////////////
if (!is_null($_FILES) && !empty($_FILES)) {
    $id_now = $_POST['id_content'];

    // test image and video uploading
    echo '<pre>';
    $uploaddir = '../images/cms/' . $id_now . '/'; // this is the directory where files are uploaded for each page 
    foreach ($_FILES as $up_file_name) {
        if (isset($up_file_name['name']) != '' && isset($_POST['id_content'])) {
            if (!file_exists($uploaddir)) {
                mkdir($uploaddir);
            } // if $uploaddir does NOT exist, create it!
            $uploadfile = $uploaddir . basename($up_file_name['name']);
            if (move_uploaded_file($up_file_name['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }
        }
    }
    echo 'Here is some more debugging info:';
    print_r($_FILES);
    print "</pre>";
}

    // DUPE RECORD CHECK - set file_does_exist checker to 'false'
    $file_does_exist = 0;
    foreach ($_SESSION['content_array'] as $record2) {
        $file_id_checker = $record2['id'];
        //if ($id_now == $file_id_checker && $record2[$id_now]['page_field1'] == $page_field1_checker)
        if (isset($_POST['id_content']) && ($_POST['id_content'] == $file_id_checker)) {
            echo "<p>Pre-Test Message: " . $_POST['id_content'] . " matches id of existing record!</p>";
            $file_does_exist = 1;
            //$id_now = $file_id_checker;
        }
    } // end of foreach loop #2
////////////////////////////////////////////////////////////////////////////////////////////
////////////////// PUBLISHER STATUS - WHAT IS THE STATUS OF THE PAGE NOW and AFTER ??? //////////////////
    if (isset($_POST['publish_page']) && isset($_POST['publisher_rights']) == 1) {
        $published_status = "live";
    } elseif ((!isset($_POST['publish_page']) && isset($_POST['publisher_rights']) == 0) && (isset($_POST['submit_for_preview']))) {
        $published_status = "pending";
    } elseif (isset($_POST['deactivate_page']) && isset($_POST['publisher_rights']) == 1) {
        $published_status = "deactivated";
    }

    if (isset($_POST['submit_for_preview']) || isset($_POST['submit_new_page'])) {
        $id_now = $_POST['id_content'];
        /*SMELLY!!!*/
        if (isset($_POST['submit_new_page'])) {        
            // set $page_content in event of page_content_v
            if ($_POST['content_type'] == 'video') {
                $page_content = $_POST['page_content_v'];
            } elseif ($_POST['content_type'] == 'article') {
                $page_content = $_POST['page_content_a'];
            } elseif ($_POST['content_type'] == 'distributor') {
                $page_content = $_POST['page_content_d'];
            }        
        }
        else {        
            if (isset($_POST['page_content'])) {
                $page_content = $_POST['page_content'];
            }
            // bug for TinyMCE WYSIWYG required unique value due to textarea tag conflicts
            if ($_POST['content_type'] == 'article') {
                $page_content = $_POST['page_content_a'];
            }   
        }        
        /*SMELLY!!!*/

        $_SESSION['content_array'][$id_now] = array(
            'id' => $id_now,
            'content_file' => $_SESSION['content_file'], 
            'author' => $_SESSION['user_current'], 
            'content_type' => $_POST['content_type'],
            'content_date' => $_SESSION['date_current'],
            'page_title' => $_POST['page_title'],
            'page_desc' => $_POST['page_desc'],
            'page_keywords' => $_POST['page_keywords'],
            'page_content' => $page_content,
            'content_hlink' => $_POST['content_hlink'],
            'page_img_large' => $_FILES['page_img_large']['name'],
            'page_field1' => $_POST['page_field1'],
            'page_img_small' => $_FILES['page_img_small']['name'],
            'page_field2' => $_POST['page_field2'],
            'page_img_extra' => $_FILES['page_img_extra']['name'],
            'page_field3' => $_POST['page_field3'],
            'published_status' => $_POST['published_status'],
            'page_permalink' => $_POST['page_permalink'],
            'theme_control' => $_POST['theme_control'],
        );
        /**/
    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    /* This Section UPDATES A RECORD based on user input -- Where FILE DOES EXISTS already... */
    /////////////////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['submit_for_preview']) ) { //if submitted with SUBMIT THIS PAGE button...
        // page_img_large column update
        if ($file_does_exist == 1) {
            if (!empty($_FILES['page_img_large']['name']) != $row1[$id_now]['page_img_large']) {
                $img_large_build = ", page_img_large = '" . Prep_Data_x($_FILES['page_img_large']['name'], $DBH) . "'";
                #echo "<p>This is the part where a new image name is updated to the table record => " . $img_large_build . " <= </p>";
            } else {
                $img_large_build = "";
            }
            // page_img_large column update
            if (!empty($_FILES['page_img_small']['name']) != $row1[$id_now]['page_img_small']) {
                $img_small_build = ", page_img_small = '" . Prep_Data_x($_FILES['page_img_small']['name'], $DBH) . "'";
                #echo "<p>This is the part where a new image name is updated to the table record => " . $img_small_build . " <= </p>";
            } else {
                $img_small_build = "";
            }        
            // page_img_extra column update
            if (!empty($_FILES['page_img_extra']['name']) != $row1[$id_now]['page_img_extra']) {
                $img_extra_build = ", page_img_extra = '" . Prep_Data_x($_FILES['page_img_extra']['name'], $DBH) . "'";
            } else {
                $img_extra_build = "";
            }
        }// end if file_does_exist check
        
        /* FIX ME!!!
        // set $page_content in event of page_content_v
        if ($_POST['content_type'] == 'video') {
            $page_content = $_POST['page_content_v'];
        } elseif ($_POST['content_type'] == 'article') {
            $page_content = $_POST['page_content'];
        } elseif ($_POST['content_type'] == 'distributor') {
            $page_content = $_POST['page_content_d'];
        } 
         * 
         */       
        if (isset($_POST['page_content'])) {
            $page_content = $_POST['page_content'];
        }
        // bug for TinyMCE WYSIWYG required unique value due to textarea tag conflicts
        if ($_POST['content_type'] == 'article') {
            $page_content = $_POST['page_content'] = $_POST['page_content_a'];
        }
            
        $query_builder2_update = "
            UPDATE content
            SET
                    content_file = '" . Prep_Data_x($_SESSION['content_file'], $DBH) . "',                                        
                    content_author = '" . Prep_Data_x($_SESSION['user_current'], $DBH) . "', 
                    content_type = '" . Prep_Data_x($_POST['content_type'], $DBH) . "', 
                    content_date = NOW(), 
                    page_title = '" . Prep_Data_x($_POST['page_title'], $DBH) . "', 
                    page_desc = '" . Prep_Data_x($_POST['page_desc'], $DBH) . "', 
                    page_keywords = '" . Prep_Data_x($_POST['page_keywords'], $DBH) . "',                     
                    page_content = '" . Prep_Data_x($page_content, $DBH) . "',
                    content_hlink = '" . Prep_Data_x($_POST['content_hlink'], $DBH) . "',                    
                    page_field1 = '" . Prep_Data_x($_POST['page_field1'], $DBH) . "', 
                    page_field2 = '" . Prep_Data_x($_POST['page_field2'], $DBH) . "', 
                    page_field3 = '" . Prep_Data_x($_POST['page_field3'], $DBH) . "', 
                    published_status = '" . Prep_Data_x($published_status, $DBH) . "', 	
                    page_permalink = '" . Prep_Data_x($page_permalink, $DBH) . "', 
                    theme_control = '" . Prep_Data_x($_SESSION['theme_control'], $DBH) . "'
                    " . $img_large_build . " " . $img_small_build . " " . $img_extra_build . "
            WHERE
                    id = '" . $_POST['id_content'] . "'
                    ";
        $test_message = "SQL UPDATE just happened! - '$file_does_exist' that file exists...";
        $_SESSION['update_test'] = $query_builder2_update;
        // sql etc
        // $query2 = &$DBH->Prepare("$query_builder2_update");
        // $result2 = &$DBH->Execute($query2);
        // $query2 = $DBH->prepare("$query_builder2_update");
        // $result2 = $DBH->execute();
        // $query2 = $DBH->prepare();
        $result2 = $DBH->exec("$query_builder2_update");        
        
        $_SESSION['content_array'][$id_now] = array(
            'id' => $id_now,
            'content_file' => $_SESSION['content_file'], 
            'author' => $_SESSION['user_current'], 
            'content_type' => $_POST['content_type'],
            'content_date' => $_SESSION['date_current'],
            'page_title' => $_POST['page_title'],
            'page_desc' => $_POST['page_desc'],
            'page_keywords' => $_POST['page_keywords'],
            'page_content' => $page_content,
            'content_hlink' => $_POST['content_hlink'],
            'page_img_large' => $_FILES['page_img_large']['name'],
            'page_field1' => $_POST['page_field1'],
            'page_img_small' => $_FILES['page_img_small']['name'],
            'page_field2' => $_POST['page_field2'],
            'page_img_extra' => $_FILES['page_img_extra']['name'],
            'page_field3' => $_POST['page_field3'],
            'published_status' => $_POST['published_status'],
            'page_permalink' => $_POST['page_permalink'],
            'theme_control' => $_POST['theme_control'],
        );
        /**/        
        // get result(s)
        //$row2=$result2->FetchRow(); //pulls a single result	
        //$result2->FetchRow(); //pulls a single result	
        // redirect to video-content-create-page.php
        /*
        if ($_POST['content_type'] == 'video') {
            header('Location: video-content-create-page.php?id=' . $_POST['id_content'] . '&content_type=' . $_POST['content_type'] . '');
        }
        // redirect to article-content-create-page.php
        if ($_POST['content_type'] == 'article') {
            header('Location: article-content-create-page.php?id=' . $_POST['id_content'] . '&content_type=' . $_POST['content_type'] . '');
        }
        if ($_POST['content_type'] == 'distributor') {
            header('Location: distributor-content-create-page.php?id=' . $_POST['id_content'] . '&content_type=' . $_POST['content_type'] . '');
        } 
         * 
         */       
    } // ENDs if 'submit_for_preview' && 'file exists' loop...
    ////////////////////////////////////////////////////////////////
    // if the file DOES NOT YET exist, Create a NEW record in the database //
    //elseif (isset($_POST['submit_for_preview']) && isset($_POST['content_type']) && $file_does_exist == 0) { // validate = YES or NO...				
    elseif (isset($_POST['submit_new_page'])) {
        // set $page_content in event of page_content_v
        if ($_POST['content_type'] == 'video') {
            $page_content = $_POST['page_content_v'];
        } elseif ($_POST['content_type'] == 'article') {
            $page_content = $_POST['page_content_a'];
        } elseif ($_POST['content_type'] == 'distributor') {
            $page_content = $_POST['page_content_d'];
        }
        
$_SESSION['hit_me'] .= ' , $page_content = '.$page_content.' - '.++$count_hits.' times... ';
        $query_builder2_insert = "
            INSERT INTO 
                    content (
                    content_file, 
                    content_author, 
                    content_type, 
                    content_date, 
                    page_title, 
                    page_desc, 
                    page_keywords, 
                    page_content, 
                    content_hlink, 
                    page_img_large, 
                    page_field1, 
                    page_img_small, 
                    page_field2, 
                    page_img_extra, 
                    page_field3, 
                    published_status, 
                    page_permalink, 
                    theme_control)
            VALUES
                    ('" . Prep_Data_x($_POST['content_file'], $DBH) . "',
                     '" . Prep_Data_x($_SESSION['user_current'], $DBH) . "',										
                     '" . Prep_Data_x($_POST['content_type'], $DBH) . "',										 
                     NOW(),
                     '" . Prep_Data_x($_POST['page_title'], $DBH) . "',
                     '" . Prep_Data_x($_POST['page_desc'], $DBH) . "',
                     '" . Prep_Data_x($_POST['page_keywords'], $DBH) . "',
                     '" . Prep_Data_x($page_content, $DBH) . "',
                     '" . Prep_Data_x($_POST['content_hlink'], $DBH) . "',
                     '" . Prep_Data_x($_FILES['page_img_large']['name'], $DBH) . "',
                     '" . Prep_Data_x($_POST['page_field1'], $DBH) . "',
                     '" . Prep_Data_x($_FILES['page_img_small']['name'], $DBH) . "',
                     '" . Prep_Data_x($_POST['page_field2'], $DBH) . "',
                     '" . Prep_Data_x($_FILES['page_img_extra']['name'], $DBH) . "',
                     '" . Prep_Data_x($_POST['page_field3'], $DBH) . "',
                     '" . Prep_Data_x($published_status, $DBH) . "',
                     '" . Prep_Data_x($_POST['page_permalink'], $DBH) . "',
                     '" . Prep_Data_x($_SESSION['theme_control'], $DBH) . "' 							 							 
                     )"; // 'date' is automatic

        $test_message = "SQL INSERT just happened! - '$file_does_exist' that file exists...";
        // test
        $_SESSION['insert_test'] = $query_builder2_insert;
        // sql etc
        // $query2 = &$DBH->Prepare("$query_builder2_insert");
        // $result2 = &$DBH->Execute($query2);
        //
        # MySQL DB HANDLER
        $query2 = $DBH->prepare($query_builder2_insert);
        $query2->execute();
        //        
        // redirect to video-content-create-page.php
/*
        if ($_POST['content_type'] == 'video') {
            header('Location: video-content-create-page.php?id=' . $_POST['id_content'] . '&content_type=' . $_POST['content_type'] . '');
        }
        // redirect to article-content-create-page.php
        elseif ($_POST['content_type'] == 'article') {
            header('Location: article-content-create-page.php?id=' . $_POST['id_content'] . '&content_type=' . $_POST['content_type'] . '');
        }
        // redirect to distributor-content-create-page.php
        elseif ($_POST['content_type'] == 'distributor') {
            header('Location: distributor-content-create-page.php?id=' . $_POST['id_content'] . '&content_type=' . $_POST['content_type'] . '');
        }   
        */
    } // ENDs 'submit_new_page' loop...


    if ((isset($_POST['publish_page']) || isset($_POST['deactivate_page'])) && (!is_null($published_status) && $publisher_rights == 1)) {
        // sql etc
        $query_builder3 = "
            UPDATE content
            SET 
                content_date = NOW(),
                theme_control = '" . Prep_Data_x($_SESSION['theme_control'], $DBH) . "',  									
                published_status = '" . Prep_Data_x($published_status, $DBH) . "'                
            WHERE
                id = '" . $id_now . "' 
                        ";

        $query3 = $DBH->prepare($query_builder3);
        $query3->execute();
            
        $_SESSION['content_array'][$id_now]['published_status'] = $published_status;
        if ($published_status == 'live' || $published_status == 'deactivated') {
            header('Location: home-admin.php?id=' . $id_now . '&content_type=' . $_GET['content_type'] . '&published_status=' . $published_status . '');
        }
    }
    
if (isset($_POST['submit_for_preview']) || isset($_POST['submit_new_page'])) {    
    if ($_POST['content_type'] == 'video') {
        header('Location: video-content-create-page.php?id=' . $_POST['id_content'] . '&content_type=' . $_POST['content_type'] . '');
    }
    // redirect to article-content-create-page.php
    elseif ($_POST['content_type'] == 'article') {
        header('Location: article-content-create-page.php?id=' . $id_now . '&content_type=' . $_POST['content_type'] . '');
    }
    // redirect to distributor-content-create-page.php
    elseif ($_POST['content_type'] == 'distributor') {
        header('Location: distributor-content-create-page.php?id=' . $_POST['id_content'] . '&content_type=' . $_POST['content_type'] . '');
    }
}

?>
