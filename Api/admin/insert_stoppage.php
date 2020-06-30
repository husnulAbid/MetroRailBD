<?php
if(!isset($_SESSION))
{
    session_start();
}
// include db connect class
require_once '../Connection.php';
class InsertDetails{
    function startInsertDetails(){
        $connection = new Connection();
        $conn = $connection->getConnection();
        //array for json response
        $response = array();
        $stationName   = $_POST['stationName'];
        //echo $first;
        $mrtNo  = $_POST['mrtNo'];
        $orderNo   = $_POST['orderNo'];
        $reachTimeP1  = $_POST['reachTimeP1'];
        $reachTimeP2  = $_POST['reachTimeP2'];
        try{
            //isset for int numbers they can be 0
            //!empty values can't be 0
            if(!empty($stationName) && isset($mrtNo) && isset($orderNo) && isset($reachTimeP1) && isset($reachTimeP2)){
                $sqlInsert = "INSERT INTO stop(stopId, stationId, mrtNo, orderNo, reachTimeFromP1, reachTimeFromP2) 
                VALUES (0,'$stationName','$mrtNo','$orderNo','$reachTimeP1','$reachTimeP2')";
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
            echo '<script type="text/javascript"> window.open("../../admin/stoppage.php","_self");</script>';
            die();
        }else{
            echo '<script type="text/javascript">alert("Error , Try Again!!!");</script>';
            echo '<script type="text/javascript"> window.open("../../admin/stoppage.php","_self");</script>';
            die();
        }
    }
}

$insert = new InsertDetails();
$insert->startInsertDetails();
