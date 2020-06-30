<?php
if(!isset($_SESSION))
{
    session_start();
}
// include db connect class
require_once 'Connection.php';
class InsertDetails{
    function startInsertDetails(){
        $connection = new Connection();
        $conn = $connection->getConnection();
        //array for json response
        $response = array();
        $issueDate  = $_POST['issueDate'];
        $validDate  = $_POST['validDate'];
        $price  = $_POST['price'];
        $userId  =  $_SESSION['userId'];
        $type=$_POST['ticketType'];
        //echo $issueDate." ".$validDate." ".$price." user id".$userId;
        try{
            //isset for int numbers they can be 0
            //!empty values can't be 0
            if(!empty($issueDate) && isset($validDate) && isset($price) && isset($userId) && isset($type)){
                $sqlInsert = "INSERT INTO tickets (ticketId, issueDate, validDate, price, ticketType, customerId)
                VALUES (0, '$issueDate', '$validDate', '$price', '$type', '$userId')";
                $id=$conn->exec($sqlInsert);
                $sqlInsert = "UPDATE customer SET customerBalance=customerBalance-'$price' WHERE customerId='$id'";
                $conn->exec($sqlInsert);


            }
        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
        //cek is the row was inserted or not
        if($sqlInsert){
            //success inserted
            echo '<script type="text/javascript">alert("Successfully Bought Ticket !!!");</script>';
            //echo $sqlInsert;
            echo '<script type="text/javascript"> window.open("GenerateTicket.php","_self");</script>';
            die();
        }else{
            echo '<script type="text/javascript">alert("Error , Try Again!!!");</script>';
            echo '<script type="text/javascript"> window.open("../Dashboard/UserDashboard/tickets.php","_self");</script>';
            die();
        }
    }
}

$insert = new InsertDetails();
$insert->startInsertDetails();
