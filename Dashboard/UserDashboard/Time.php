<?php  if(!isset($_SESSION))
{
    session_start();
};
?>
<?php include ("fixedsidebar.php"); ?>
<?php
$stationName = ($_POST['stationName']);
$mrtNo = ($_POST['mrtNo']);
$dirrection = ($_POST['dirrection']);
?>
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
?>
<!-- js -->
<script  src="../../frontCustom/js/jquery-2.2.3.min.js"></script>
<style>
    table, th, td {
        border: 1px solid black;
        text-align: left;
        color:black;
    }
    #scheduled {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #scheduled td, #scheduled th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #scheduled tr:nth-child(even){background-color: #f2f2f2;}

    #scheduled tr:hover {background-color: #ddd;}

    #scheduled th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
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

    <div class="mainbody" style="margin-top: 130px;color:#333;">
        <!-- Main Body -->


        <br>
        <h1>From '<?php echo $stationName;?>' By '<?php echo $mrtNo;?>' No. Mrt Direction '<?php echo $dirrection;?>'</h1>

        <br>
        <table style="width:100%" id="scheduled">

        </table>

        <script>

            var stationName = '<?php echo $stationName;?>';
            var mrtNo = '<?php echo $mrtNo;?>';
            var direction = '<?php echo $dirrection;?>';

            //alert(stationName+" "+mrtNo+" "+direction);
            //getting stations
            $.ajax({
                type: 'POST',
                url: 'scheduleFindCode.php',
                async: false,
                data: {
                    stationName: stationName,
                    mrtNo: mrtNo,
                    direction:direction
                },
                error: function (ts) {
                    alert(ts.responseText);
                },
                success: function (data) {
                    //when found names sending them in datalist for suggetions
                    //alert(data);
                    var table = document.getElementById("scheduled");
                    var row = table.insertRow(0);
                    var cell1 = row.insertCell(0);

                    cell1.innerHTML = "Time";

                    var obj = JSON.parse(data);
                    var datas=obj.time_data;
                    var i=1;
                    for (var key in datas) {
                        if (datas.hasOwnProperty(key)) {
                            //alert(datas[key].TrainName);
                            var row = table.insertRow(i);
                            var cell1 = row.insertCell(0);

                            cell1.innerHTML = ""+datas[key].time;

                            i++;
                        }
                    }

                }
            });



        </script>


        <!-- Main Body -->
    </div>


</html>

