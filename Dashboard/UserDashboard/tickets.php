<?php  if(!isset($_SESSION))
{
    session_start();
};
?>
<?php include ("fixedsidebar.php"); ?>

<html>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        padding-left: 300px;
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        color: #000;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
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

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tickets</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    <!-- The Modal -->
    <div id="Modal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="text"></p>
            <form action="../../Api/buyTicket.php" method="post">
                Customar Name: <?php echo $_SESSION['userName']?><br>
                Issue Date:<br>
                <input type="text" name="issueDate" id="issueDate" readonly>
                <br>
                Valid Till:<br>
                <input type="text" name="validDate" id="validDate" readonly >
                <br>
                Price:<br>
                <input type="text" name="price" id="price" readonly>
                <br>
                Ticket Type:<br>
                <input type="text" name="ticketType" id="ticketType" readonly>
                <br><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <div class="mainbody" style="margin-top: 130px;color:#333;">
        <!-- Main Body -->

        <button style="font-size:24px" id="singel" onclick="singelTicket()">Singel Ticket <i class="fa fa-ticket" style="color:yellow"></i></button>
        <button style="font-size:24px" id="daily" onclick="dailyTicket()">Daily Ticket <i class="fa fa-ticket" style="color:blue"></i></button>
        <button style="font-size:24px" id="weekly" onclick="weeklyTicket()">Weekly Ticket <i class="fa fa-ticket" style="color:green"></i></button>
        <button style="font-size:24px" id="monthly" onclick="monthlyTicket()">Monthly Ticket <i class="fa fa-ticket" style="color:red"></i></button>

        <!-- Main Body -->
    </div>

    <script>
        // Get the modal
        var Modal = document.getElementById('Modal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var ticketPrices=[];
        var ticketIds=[];
        var ticketTypes=[];
        $.ajax({
            type: 'POST',
            url: '../../Api/getTicketPrice.php',
            async: false,
            data: {
            },
            error: function (ts) {
                alert(ts.responseText);
            },
            success: function (data) {
                //when found names sending them in datalist for suggetions
                //alert(data);

                var obj = JSON.parse(data);
                var datas=obj.ticket_data;
                for (var key in datas) {
                    if (datas.hasOwnProperty(key)) {
                        //alert(datas[key].ticketPrice);
                        ticketPrices.push(datas[key].ticketPrice);
                        ticketIds.push(datas[key].id);
                        ticketTypes.push(datas[key].ticketType);

                    }
                }
            }
        });
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            Modal.style.display = "none";

        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                Modal.style.display = "none";
            }
        }

        function singelTicket() {

            Modal.style.display = "block";
            document.getElementById("text").innerHTML="Singel ";
            document.getElementById("price").value=ticketPrices[0];
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd = '0'+dd
            }
            if(mm<10) {
                mm = '0'+mm
            }
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("validDate").value=today;
            document.getElementById("ticketType").value=ticketIds[0];
        }
        function dailyTicket() {

            Modal.style.display = "block";
            document.getElementById("text").innerHTML="Daily";
            var today = new Date();
            var numberOfDaysToAdd = 1;
            today.setDate(today.getDate() + numberOfDaysToAdd);
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd = '0'+dd
            }
            if(mm<10) {
                mm = '0'+mm
            }
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("validDate").value=today;
            document.getElementById("price").value=ticketPrices[1];
            document.getElementById("ticketType").value=ticketIds[1];


        }
        function weeklyTicket() {

           Modal.style.display = "block";
            document.getElementById("text").innerHTML="Weekly";
            var today = new Date();
            var numberOfDaysToAdd = 7;
            today.setDate(today.getDate() + numberOfDaysToAdd);
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            if(dd<10) {
                dd = '0'+dd
            }
            if(mm<10) {
                mm = '0'+mm
            }
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("validDate").value=today;
            document.getElementById("price").value=ticketPrices[2];
            document.getElementById("ticketType").value=ticketIds[2];

        }
        function monthlyTicket() {
            Modal.style.display = "block";
            document.getElementById("text").innerHTML="Monthly";
            var today = new Date();
            var numberOfDaysToAdd = 30;
            today.setDate(today.getDate() + numberOfDaysToAdd);
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            if(dd<10) {
                dd = '0'+dd
            }
            if(mm<10) {
                mm = '0'+mm
            }
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("validDate").value=today;
            document.getElementById("price").value=ticketPrices[3];
            document.getElementById("ticketType").value=ticketIds[3];
        }
        window.onload = function(e) {

             var today = new Date();
             var dd = today.getDate();
             var mm = today.getMonth()+1; //January is 0!
             var yyyy = today.getFullYear();
             if(dd<10) {
             dd = '0'+dd
             }
             if(mm<10) {
             mm = '0'+mm
             }
             today = yyyy + '-' + mm + '-' + dd;
             document.getElementById("issueDate").value=today;
                       //load();
        };
    </script>
</html>
