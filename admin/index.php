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



        <!-- Main Body -->

    </div>
</div>

</html>
