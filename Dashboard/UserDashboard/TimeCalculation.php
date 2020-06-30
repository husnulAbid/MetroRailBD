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

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">DashBoard</h1>
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
        <form action = "Time.php" method = "post" >

            <!-- station Id: <input type = "text" name = "stationId"/>
            station Name: <input type = "text" name = "stationName"/>
            longitude: <input type = "text" name = "longitude"/>
            latitude: <input type = "text" name = "latitude"/>
            Show: <input type = "submit"/>  -->

            StationName: <input type = "text" name = "stationName"/>
            MRTNO: <input type = "text" name = "mrtNo"/>
            Dirrection : <input type = "text" name = "dirrection"/>
            <input type = "submit" value = "OK"/>


        </form>

        <br>

    </div>
</div>

</html>