<?php 
include("../includes/jmcms_db_conn_cms.php");
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
      	<h1>Logged in as: <?php echo $_SESSION['user_current'];?> - <a href="/admin_cms/">Log Out</a></h1>

       	  <h2>Congrats, Your page has been added to the LIVE WEB SERVER. </h2>
          <h4>Please review your new page to ensure accuracy. To make changes to the information below, you must click &quot;Edit existing page&quot; and re-submit. </h4>
       	  <p>Click here to <a href="home-admin.php">select an existing page for editing</a></p>
      </div>
        <!-- admin -- end -->
            <div id="foot-pad">
                <div class="shadow-purple"></div>
              <img src="../images/foot-pad.png" height="46" width="990" />
            </div>
<?php include("../template/page_footer_cms.php"); ?>
        
    </div>
</div>
<pre>JMicrositeCMS Content Management System - v0.3 beta</pre>
</body>
</html>