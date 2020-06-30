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
    echo '<script type="text/javascript"> window.open("login.php","_self");</script>';            //  On Successful Login redirects to home.php
    exit();
    /* Redirect browser */
}
else
{
    if($_SESSION['admin']==false)
    {
        echo '<script type="text/javascript"> window.open("login.php","_self");</script>';            //  On Successful Login redirects to home.php
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
                <h1 class="page-header">Mrt Details/Add</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    <div class="mainbody" style="margin-top: 130px;color:#333;">
        <!-- Main Body -->


        <div class="panel-body">
            <form action="../Api/admin/insert_mrt.php" method="post">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="Mrt No" name="mrtNo" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Mrt Name" name="mrtName" type="text" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Mrt Start Point One" name="mrtStartP1" type="text" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Mrt Start Point Two" name="mrtStartP2" type="text" value="">
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <input class="btn btn-lg btn-success btn-block" type="submit" name="add" value="Add">

                </fieldset>
            </form>
            <br>
            <br>
            <h1>All Mrts</h1>

            <br>

            <table style="width:100%" id="scheduled">

            </table>


            <!-- Main Body -->
            <script>
                $.ajax({
                    type: 'POST',
                    url: '../Api/admin/get_mrt.php',
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
                        cell1.innerHTML = "Mrt No";
                        cell2.innerHTML = "Mrt Name";
                        cell3.innerHTML ="Start Point 1";
                        cell4.innerHTML = "Start Point 2";

                        var obj = JSON.parse(data);
                        var datas=obj.mrt_data;
                        var i=1;
                        for (var key in datas) {
                            if (datas.hasOwnProperty(key)) {
                                //alert(datas[key].mrtNo);
                                var row = table.insertRow(i);
                                var cell1 = row.insertCell(0);
                                var cell2 = row.insertCell(1);
                                var cell3 = row.insertCell(2);
                                var cell4 = row.insertCell(3);

                                cell1.innerHTML = ""+datas[key].mrtNo;
                                cell2.innerHTML = ""+datas[key].mrtName;
                                cell3.innerHTML = ""+datas[key].StartP1;
                                cell4.innerHTML = ""+datas[key].StartP2;
                                i++;
                            }
                        }

                    }
                });
            </script>
            <!-- Main Body -->

        </div>
    </div>

</html>
