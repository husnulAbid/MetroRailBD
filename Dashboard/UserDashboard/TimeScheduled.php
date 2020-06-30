<?php  if(!isset($_SESSION))
{
    session_start();
};
?>
<?php include ("fixedsidebar.php"); ?>

<html>
<?php
if(!isset($_SESSION))   // Checking whether the session is already there or not if
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
                <h1 class="page-header">Time Scheduled</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    <div class="mainbody" style="margin-top: 130px;color:#333;">
        <!-- Main Body -->

        <br>
        <h1>Time Scheduled Of Metro Rail BD</h1>

        <br>
        <table style="width:100%" id="scheduled">

        </table>


        <!-- Main Body -->
        <script>
            $.ajax({
                type: 'POST',
                url: '../../Api/getScheduled.php',
                async: false,
                data: {
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
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var cell6 = row.insertCell(5);
                    var cell7 = row.insertCell(6);
                    cell1.innerHTML = "Train Name";
                    cell2.innerHTML = "Train Id";
                    cell3.innerHTML ="Mrt Id";
                    cell4.innerHTML = "Start Station";
                    cell5.innerHTML = "End Station";
                    cell6.innerHTML = "Start Time";
                    cell7.innerHTML = "Error Time";
                    var obj = JSON.parse(data);
                    var datas=obj.scheduled_data;
                    var i=1;
                    for (var key in datas) {
                        if (datas.hasOwnProperty(key)) {
                            //alert(datas[key].TrainName);
                            var row = table.insertRow(i);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            var cell5 = row.insertCell(4);
                            var cell6 = row.insertCell(5);
                            var cell7 = row.insertCell(6);
                            cell1.innerHTML = ""+datas[key].TrainName;
                            cell2.innerHTML = ""+datas[key].TrainId;
                            cell3.innerHTML = ""+datas[key].mrtId;
                            cell4.innerHTML = ""+datas[key].startStation;
                            cell5.innerHTML = ""+datas[key].endStation;
                            cell6.innerHTML = ""+datas[key].startTime;
                            cell7.innerHTML = ""+datas[key].errorTime;
                            i++;
                        }
                    }

                }
            });
        </script>
    </div>
</div>

</html>