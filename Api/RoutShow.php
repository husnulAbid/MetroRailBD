
<?php
$start = $_POST['startStation'];
$end = $_POST['endStation'];
?>

<html>

<!-- js -->
<script  src="../frontCustom/js/jquery-2.2.3.min.js"></script>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Routs</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */

        #map {
            height: 100%;
            width: 100%;

        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <div class="mainbody" style="margin-top: 130px;color:#333;">
        <!-- Main Body -->
        
        <p id="text"></p>
        <div id="map"></div>


        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyC_kc1V76gDeVh9UykgJl4ogGcZTzyEzWQ">
        </script>
        <script>
            var coords=[];
            var names=[];
            var mrt=[];
            var directions=[];
            var startStation = '<?php echo $start;?>';
            var endStation = '<?php echo $end;?>';
            var directionsDisplay;
            var directionsService = new google.maps.DirectionsService();
            alert(startStation+" "+endStation);
            //getting stations
            $.ajax({
                type: 'POST',
                url: 'GettingRoute3.php',
                async: false,
                data: {
                    startStation: startStation,
                    endStation: endStation
                },
                error: function (ts) {
                    alert(ts.responseText);
                },
                success: function (data) {
                    //when found names sending them in datalist for suggetions
                    alert(data);

                    var obj = JSON.parse(data);
                    var datas=obj.route_Details;
                    for (var key in datas) {
                        if (datas.hasOwnProperty(key)) {
                            //alert(datas[key].Latitude);
                            coords.push(new google.maps.LatLng(datas[key].Latitude, datas[key].Longitude));
                            names.push(datas[key].stationName);
                        }
                    }
                    var obj = JSON.parse(data);
                    var rt=obj.mrt_data;

                    for (var i=0;i<rt.length;i++) {
                        //alert(rt[i]);
                        mrt.push(rt[i]);
                    }
                    //getting directions
                    for (var i=0;i<rt.length;i++) {
                        $.ajax({
                            type: 'POST',
                            url: '../route/findDirrectionCode.php',
                            async: false,
                            data: {
                                startStation: names[i],
                                endStation: names[i+1],
                                mrtNo:mrt[i]
                            },
                            error: function (ts) {
                                alert(ts.responseText);
                            },
                            success: function (data) {
                                //when found names sending them in datalist for suggetions
                                // alert(data);

                                var obj = JSON.parse(data);
                                var datas=obj.direction_data;
                                for (var key in datas) {
                                    if (datas.hasOwnProperty(key)) {
                                        directions.push(datas[key].$dirrection);

                                    }
                                }

                            }
                        });
                    }
                    //alert(mrt);
                    initMap();
                }
            });

            function initMap() {

                directionsDisplay = new google.maps.DirectionsRenderer();
                myLatLng= {lat: 23.806866, lng: 90.368609};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: myLatLng
                });
                directionsDisplay.setMap(map);
                //alert(coords);
                document.getElementById("text").innerHTML += "You Want To Go From "+startStation+ " To " +endStation+"<br />";
                for (var i = 0; i < coords.length; i++) {

                    var marker = new google.maps.Marker({
                        map: map,
                        position: coords[i],
                        title: names[i]
                    });
                    if(i==0)
                    {
                        document.getElementById("text").innerHTML += "Start From "+names[i]+" From MRT "+mrt[i]+" Direction :"+directions[i]+"<br />";
                    }
                    else if(i<coords.length-1)
                    {
                        document.getElementById("text").innerHTML += "Then Get Down at "+names[i]+" From MRT "+mrt[i-1]+"<br />";
                        document.getElementById("text").innerHTML += "Then Get Up From "+names[i]+" From MRT "+mrt[i]+" Direction :"+directions[i]+"<br />";
                    }
                    else {
                        document.getElementById("text").innerHTML += "Then Get Down at "+names[i]+" From MRT "+mrt[i-1]+"<br />";
                    }
                    if(i>0)
                    {
                        //calcRoute(coords[i-1],coords[i]);
                    }
                }

            }

            function calcRoute(start,end) {
                var start = start;
                //var end = new google.maps.LatLng(38.334818, -181.884886);
                var end = end;
                var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        directionsDisplay.setMap(map);
                    } else {
                        alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                    }
                });
            }


        </script>


        <!-- Main Body -->
    </div>


</html>
