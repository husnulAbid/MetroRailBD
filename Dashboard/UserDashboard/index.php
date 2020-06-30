<?php  if(!isset($_SESSION))
{
    session_start();
};
?>
<?php include ("fixedsidebar.php"); ?>

<html>
<?php
if(!isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
    // true then header redirect it to the home page directly
{
    echo '<script type="text/javascript"> window.open("../../index.php","_self");</script>';            //  On Successful Login redirects to home.php
    exit();
    /* Redirect browser */
}
else
{
    if($_SESSION['loggedIn']==false)
    {
        echo '<script type="text/javascript"> window.open("../../index.php","_self");</script>';            //  On Successful Login redirects to home.php
        exit();
    }
}
?><?php  if(!isset($_SESSION))
{
    session_start();
};
?>
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

    <div class="mainbody" style="margin-top: 130px;color:#333;">
        <!-- Main Body -->

        <form action="rout.php" method="post">
            <div class="row">

                <div class="col-md-3">
                    <select id="startStation" class="form-control option" name = "startStation">
                        <option>Transport From</option>

                    </select>
                </div>
                <div class="col-md-3">
                    <select id="endStation" class="form-control option" name = "endStation" >
                        <option>Transport To</option>

                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary submit">Submit</button>
                </div>
            </div>
        </form>



        <!-- Main Body -->
    </div>
    <script type="text/javascript">

        $(document).ready(function() {
            var startStation = document.getElementById("startStation");
            var endStation = document.getElementById("endStation");
            //alert("data");
            //getting stations
            $.ajax({
                type: 'POST',
                url: '../../Api/getStations.php',
                async:false,
                data: {
                },
                error: function (ts) {
                    alert(ts.responseText);
                },
                success: function(data) {
                    //when found names sending them in datalist for suggetions
                    //alert(data);
                    var obj = JSON.parse(data);

                    var datas=obj.station_data;
                    for (var key in datas) {
                        if (datas.hasOwnProperty(key)) {
                            var option = document.createElement("option");
                            option.text = datas[key].stationName;
                            startStation.add(option);

                        }
                    }
                    for (var key in datas) {
                        if (datas.hasOwnProperty(key)) {
                            var option = document.createElement("option");
                            option.text = datas[key].stationName;

                            endStation.add(option);
                        }
                    }
                }
            });
        });

    </script>

</html>
