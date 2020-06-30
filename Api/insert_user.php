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
        $first   = $_POST['first'];
        $last  = $_POST['last'];
        $Name=$first." ".$last;
        $Email   = $_POST['email'];
        $Password  = $_POST['password'];
        try{
            //isset for int numbers they can be 0
            //!empty values can't be 0
            if(!empty($Name) && isset($Email) && isset($Password)){
                $sqlInsert = "INSERT INTO user (id, Name, Email, Password)
                VALUES (0, '$Name', '$Email', '$Password')";
                $conn->exec($sqlInsert);

                $sqlInsert = "INSERT INTO customer
                (customerId, customerName, customerBankAcc, customerAddress, customerPhoneNumber, customerBloodGroup, customerBalance)
                 VALUES (0, '$Name', NULL, NULL, NULL, NULL, 0)";
                $conn->exec($sqlInsert);
            }
        }catch (PDOException $e){
            echo "Error while inserting ".$e->getMessage();
        }
        //cek is the row was inserted or not
        if($sqlInsert){
            //success inserted
            echo '<script type="text/javascript">alert("Successfully Inserted !!!");</script>';
            //echo $sqlInsert;
            echo '<script type="text/javascript"> window.open("../signup.php","_self");</script>';
            die();
        }else{
            echo '<script type="text/javascript">alert("Error , Try Again!!!");</script>';
            //echo '<script type="text/javascript"> window.open("../pages/dashboard.php","_self");</script>';
            die();
        }
    }
}

    $insert = new InsertDetails();
    $insert->startInsertDetails();
