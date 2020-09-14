<?php
$home_check = true;
include("../includes/jmcms_db_conn_cms.php");
//session_content_array_loader();
$id_now = $id_adder;
?>
<!--
<!DOCTYPE html>-->
<!DOCTYPE html>
<html lang="en" ng-app="admin-console">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex, nofollow" />
        <title>Admin Home | JMicrositeCMS Content Management System - v0.3 beta | </title>
        <link type="text/css" rel="stylesheet" href="../css/style2a.css" />
        <script src="../js/flowplayer-3.2.6.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <!-- Angular! --> 
        <script type="text/javascript" src="../js/angular-v1.3.13.min.js"></script>
        <!-- this app code-->
        <script type="text/javascript" src="../js/admin-angular.js"></script>

    </head>
    <body style="background:#FFF" ng-controller="AdminController as admin">
        <a href="https://nordvpn.com/pricing/?ref=4oo9bNL" target="_blank">Nord VPN - Protect your privacy</a>
        <div id="admin_header" style="background:none;" class="container-fluid clearfix" >
            <h1 align="center" class="lead">JMicrositeCMS Content Management System - v0.3 beta</h1>	
            <div style="background:#FFF;" class="row">        
                <!-- admin -- start -->
                <div id="admin-console-main" style="background:none;">
                    <h1>Logged in as: <?php echo $_SESSION['user_current']; ?> - <a href="/admin_cms/">Log Out</a></h1> 
                    <?php
                    if (isset($_GET['id']) && isset($_GET['content_type']) && isset($_GET['published_status'])) {
                        echo "<h2 style=\"color:red;\">You have successfully edited the <i>" . $_GET['content_type'] . "</i> page (id = <i>" . $_GET['id'] . "</i>) and set its published_status to <i>" . $_GET['published_status'] . "</i>.</h2>";
                    }
                    ?>                
                    <h3>For new content, click to <a href="create-new-page.php">Create a New Page</a></h3>

                    <!-- --------------------------------------------------------------------- -->

                    <section ng-controller="PanelController as panel">                    
                        <h4>Justified Tabs</h4>
                        <ul class="nav nav-tabs nav-justified">
                            <li ng-class="{active:panel.isSelected('ShowAll')}"> 
                                <a href ng-click="panel.selectTab('ShowAll')">Show All</a>
                            </li>

                            <li ng-class="{active:panel.isSelected('Pending')}"> 
                                <a href ng-click="panel.selectTab('Pending')">Pending</a>
                            </li>

                            <li ng-class="{active:panel.isSelected('Articles')}"> 
                                <a href ng-click="panel.selectTab('Articles')">Articles</a>
                            </li>

                            <li ng-class="{active:panel.isSelected('Videos')}"> 
                                <a href ng-click="panel.selectTab('Videos')">Videos</a>
                            </li>

                            <li ng-class="{active:panel.isSelected('Distributor')}"> 
                                <a href ng-click="panel.selectTab('Distributor')">Distributor</a>
                            </li>

                            <li ng-class="{active:panel.isSelected('FAQ')}"> 
                                <a href ng-click="panel.selectTab('FAQ')">FAQ</a>
                            </li>

                            <li ng-class="{active:panel.isSelected('Deactivated')}"> 
                                <a href ng-click="panel.selectTab('Deactivated')">Deactivated</a>
                            </li>                          

                        </ul>


                        <div style="overflow-y:scroll;height:400px;" class="panel" ng-show="panel.isSelected('Pending') || panel.isSelected('ShowAll')"> 
                            
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="page in admin.pages" ng-show="page.status == 'pending'">
                                    <h3>{{page.name}}</h3>
                                </li>


                                <div id="pending">
                                    <h3><a name="pending">Pending</a></h3>
                                    <table border="0" width="100%" cellpadding="5px" align="center" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>STATUS</th>
                                                <th>TYPE</th>
                                                <th>TITLE</th>
                                                <th>THUMB</th>
                                                <th>AUTHOR</th>
                                                <th>DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody align="center">
                                            <?php
                                            $count = 0; //counter
                                            foreach ($_SESSION['content_array'] as $record) {
                                                if ($record['published_status'] == 'pending') {
                                                    //convert to a different format for Date and Time
                                                    $old_date_timestamp = strtotime($record['content_date']);
                                                    $new_date = date('m-d-y h:i:s a', $old_date_timestamp);
                                                    echo '
                                                             <tr>
                                                             <td>' . $record['id'] . '</td>
                                                             <td><a href="' . $record['content_type'] . '-content-create-page.php?id=' . $record['id'] . '&content_type=' . $record['content_type'] . '">' . $record['published_status'] . '</a></td>
                                                             <td>' . $record['content_type'] . '</td>						
                                                             <td><a href="edit-existing-page.php?id=' . $record['id'] . '">' . $record['page_title'] . '</a></td>						
                                                             <td><img src="../images/cms/' . $record['id'] . '/' . $record['page_img_large'] . '" height="30" width="30" /></td>						
                                                             <td>' . $record['author'] . '</td>	
                                                             <td>' . $new_date . '</td>																													
                                                             </tr>						
                                                             ';
                                                }
                                            }
                                            ?>
                                        </tbody></table><br />
                                </div>

                            </ul>
                        </div>                                                

                        <div style="overflow-y:scroll;height:400px;" class="panel" ng-show="panel.isSelected('Articles') || panel.isSelected('ShowAll')"> 
                            <b>This is the {{page.type}} Panel showing </b>
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="page in admin.pages" ng-show="page.type == 'article' && page.status == 'live'">
                                    <h3>{{page.name}}</h3>
                                </li>
                            </ul>

                            <div id="articles">
                                <h3><a name="articles">Articles</a></h3>
                                <table border="0" width="100%" cellpadding="5px" align="center" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>STATUS</th>
                                            <th>TYPE</th>
                                            <th>TITLE</th>
                                            <th>THUMB</th>
                                            <th>AUTHOR</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $count = 0; //counter
                                        foreach ($_SESSION['content_array'] as $record) {
                                            if ($record['content_type'] == "article" && $record['published_status'] == 'live') {
                                                //convert to a different format for Date and Time
                                                $old_date_timestamp = strtotime($record['content_date']);
                                                $new_date = date('m-d-y h:i:s a', $old_date_timestamp);
                                                echo '
                                                        <tr>
                                                        <td>' . $record['id'] . '</td>
                                                        <td><a href="' . $record['content_type'] . '-content-create-page.php?id=' . $record['id'] . '&content_type=' . $record['content_type'] . '">' . $record['published_status'] . '</a></td>
                                                        <td>' . $record['content_type'] . '</td>						
                                                        <td><a href="edit-existing-page.php?id=' . $record['id'] . '">' . $record['page_title'] . '</a></td>						
                                                        <td><img src="../images/cms/' . $record['id'] . '/' . $record['page_img_large'] . '" height="30" width="30" /></td>						
                                                        <td>' . $record['author'] . '</td>	
                                                        <td>' . $new_date . '</td>																													
                                                        </tr>
                                                        ';
                                            }
                                        }
                                        ?>
                                    </tbody></table><br />
                            </div>

                        </div>                        

                        <div style="overflow-y:scroll;height:400px;" class="panel" ng-show="panel.isSelected('Videos') || panel.isSelected('ShowAll')"> 
                            <b>This is the {{page.type}} Panel showing </b>
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="page in admin.pages" ng-show=" page.type == 'videos' && page.status == 'live'">
                                    <h3>{{page.name}}</h3>
                                </li>
                            </ul>

                            <div id="videos">
                                <h3><a name="videos">Videos</a></h3>
                                <table border="0" width="100%" cellpadding="5px" align="center" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>STATUS</th>
                                            <th>TYPE</th>
                                            <th>TITLE</th>
                                            <th>THUMB</th>
                                            <th>AUTHOR</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $count = 0; //counter
                                        foreach ($_SESSION['content_array'] as $record) {
                                            if ($record['content_type'] == "video" && $record['published_status'] == 'live') {
                                                //convert to a different format for Date and Time
                                                $old_date_timestamp = strtotime($record['content_date']);
                                                $new_date = date('m-d-y h:i:s a', $old_date_timestamp);
                                                echo '
                                                        <tr>
                                                        <td>' . $record['id'] . '</td>
                                                        <td><a href="' . $record['content_type'] . '-content-create-page.php?id=' . $record['id'] . '&content_type=' . $record['content_type'] . '">' . $record['published_status'] . '</a></td>
                                                        <td>' . $record['content_type'] . '</td>						
                                                        <td><a href="edit-existing-page.php?id=' . $record['id'] . '">' . $record['page_title'] . '</a></td>						
                                                        <td><img src="../images/cms/' . $record['id'] . '/' . $record['page_img_large'] . '" height="30" width="30" /></td>						
                                                        <td>' . $record['author'] . '</td>	
                                                        <td>' . $new_date . '</td>																													
                                                        </tr>
                                                        ';
                                            }
                                        }
                                        ?>
                                    </tbody></table><br />
                            </div>

                        </div>                                                     

                        <div style="overflow-y:scroll;height:400px;" class="panel" ng-show="panel.isSelected('Distributor') || panel.isSelected('ShowAll')"> 
                            <b>This is the {{page.type}} Panel showing </b>
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="page in admin.pages" ng-show="page.type == 'distributor' && page.status == 'live'">
                                    <h3>{{page.name}}</h3>
                                </li>
                            </ul>


                            <div id="distributor">
                                <h3><a name="distributor">Distributor</a></h3>
                                <table border="0" width="100%" cellpadding="5px" align="center" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>STATUS</th>
                                            <th>TYPE</th>
                                            <th>TITLE</th>
                                            <th>THUMB</th>
                                            <th>AUTHOR</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $count = 0; //counter
                                        foreach ($_SESSION['content_array'] as $record) {
                                            if ($record['content_type'] == "distributor" && $record['published_status'] == 'live') {
                                                //convert to a different format for Date and Time
                                                $old_date_timestamp = strtotime($record['content_date']);
                                                $new_date = date('m-d-y h:i:s a', $old_date_timestamp);
                                                echo '
                                                        <tr>
                                                        <td>' . $record['id'] . '</td>
                                                        <td><a href="' . $record['content_type'] . '-content-create-page.php?id=' . $record['id'] . '&content_type=' . $record['content_type'] . '">' . $record['published_status'] . '</a></td>
                                                        <td>' . $record['content_type'] . '</td>						
                                                        <td><a href="edit-existing-page.php?id=' . $record['id'] . '">' . $record['page_title'] . '</a></td>						
                                                        <td><img src="../images/cms/' . $record['id'] . '/' . $record['page_img_large'] . '" height="30" width="30" /></td>						
                                                        <td>' . $record['author'] . '</td>	
                                                        <td>' . $new_date . '</td>																													
                                                        </tr>						
                                                        ';
                                            }
                                        }
                                        ?>
                                    </tbody></table><br />

                            </div>       

                        </div>                                                     

                        <div style="overflow-y:scroll;height:400px;" class="panel" ng-show="panel.isSelected('FAQ') || panel.isSelected('ShowAll')"> 
                            <b>This is the {{page.type}} Panel showing </b>
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="page in admin.pages" ng-show="page.type == 'faq' && page.status == 'live'">
                                    <h3>{{page.name}}</h3>
                                </li>
                            </ul>
                            <span>coming soon</span>
                        </div>                             

                        <div style="overflow-y:scroll;height:400px;" class="panel" ng-show="panel.isSelected('Deactivated') || panel.isSelected('ShowAll')"> 
                            
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="page in admin.pages" ng-show=" page.status == 'deactivated'">
                                    <h3>{{page.name}}</h3>
                                </li>
                            </ul>

                            <div id="deactivated">
                                <h3><a name="deactive">Deactivated</a></h3>
                                <table border="0" width="100%" cellpadding="5px" align="center" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>STATUS</th>
                                            <th>TYPE</th>
                                            <th>TITLE</th>
                                            <th>THUMB</th>
                                            <th>AUTHOR</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $count = 0; //counter
                                        foreach ($_SESSION['content_array'] as $record) {
                                            if (/* ($record['content_type'] == "video" || $record['content_type'] == "video") && */ $record['published_status'] == 'deactivated') {
                                                //convert to a different format for Date and Time
                                                $old_date_timestamp = strtotime($record['content_date']);
                                                $new_date = date('m-d-y h:i:s a', $old_date_timestamp);
                                                echo '
                                                        <tr>
                                                        <td>' . $record['id'] . '</td>
                                                        <td><a href="' . $record['content_type'] . '-content-create-page.php?id=' . $record['id'] . '&content_type=' . $record['content_type'] . '">' . $record['published_status'] . '</a></td>
                                                        <td>' . $record['content_type'] . '</td>						
                                                        <td><a href="edit-existing-page.php?id=' . $record['id'] . '">' . $record['page_title'] . '</a></td>						
                                                        <td><img src="../images/cms/' . $record['id'] . '/' . $record['page_img_large'] . '" height="30" width="30" /></td>						
                                                        <td>' . $record['author'] . '</td>	
                                                        <td>' . $new_date . '</td>																													
                                                        </tr>						
                                                        ';
                                            }
                                        }
                                        ?>
                                    </tbody></table><br />
                            </div>

                        </div>                          

                    </section>

                    <!-- --------------------------------------------------------------------- -->



                </div>        
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
