<!DOCTYPE html>
<html>
    <head>
<?php 
    include_once("../includes/jmcms_db_conn_vistors.php"); //config
    include_once('../template/head-themed.php'); //theme
?>             
        <meta name="description" content="Driving Directions | Your Business Name  |  " />
        <meta name="keywords" content="Driving Directions, Your Business Name, " />
        <title>Your Business Name | 123 Address City, State/Province Zip/CountryCode</title>           
        <!-- Google Maps API v3 integration || see stylesheet for CSS references from this page -->      
    <script>
        // Show/Hide of Article / Video file uploader boxes...
            
        $(function(){
            $("#pre-directions-panel").show();
            $("#directions-panel").hide();
            //alert('This works!');
            $("#directions-panel").on("onchange","input", function(){                
                alert('This works!');
                $("#directions-panel, #pre-directions-panel").toggle();
            });
        });     
        //onchange="calcRoute();"
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1z_l8SWyF1RiuiyLta-lB6UaWc-YA6zs&sensor=true"></script>                
    <script>         
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: new google.maps.LatLng(27.871184, -82.705585)
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('directions-panel'));

  var control = document.getElementById('control');
  control.style.display = 'block';
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
  
  var myLatlng = new google.maps.LatLng(27.871184, -82.705585);

  // var markerImage = '//www.salonjimbotts.com/images/logo_maps_marker.png';

  var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        icon: markerImage,
        title: 'Your Business Name \nAddress \nLocation'
        });   
}

function calcRoute() {
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
  // jQuery Show/Hide for removing basic directions and replacing with turn by turn directions from Google Maps API v3
    $(function(){
        $("#pre-directions-panel").hide();
        $("#directions-panel").show();
        //alert('This works!');
    });     
    //onchange="calcRoute();"  
} 
        
google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    </head>
    <body>
        <div id="main">
            <div id="main2">
                <?php include ('../template/page_top.php'); ?>
                <div id="banner-vid">
                <div id="control">
                  <strong>Get Directions From Your Address:</strong><br />
                  <input type="text" id="start" name="start" onchange="calcRoute();" placeholder="Enter Your Address Here for Directions" />
                  <!--<strong>End:</strong>-->
                  <input type="hidden" id="end" name="end" onchange="calcRoute();" value="123 Address, City, State, Zip" />
                  <button id="getDirections" name="getDirections" onclick="calcRoute();" value="Get Directions">Get Directions</button>
                </div>
                <div id="directions-panel"></div>     
                <div id="pre-directions-panel">
                    
                    <img src="../images/left_green_arrow.directions2.png" alt="Driving Directions to Your Business Name" />
<h2>
Business Name <br />
123 Address St NSEW <br />
City, State/Province 12345 <br />
</h2>                    

<p>
Enter Your (Origination) Address in the Search Box on the top right (and then press 'Enter') to get directions from your desired location. 
</p>
                </div>                    
                
                <div id="map-canvas"></div>

                </div>
                <div id="foot-pad">
                    <div class="shadow-purple"></div>
                    <img src="../images/foot-pad.png" alt="Driving Directions | Your Business Name  |  |  |  |  | " height="46" width="990" />
                </div>
            </div>
            <?php include ('../template/page_footer.php'); ?>
        </div>
    </body>
</html>