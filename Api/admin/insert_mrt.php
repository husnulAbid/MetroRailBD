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
        $first   = $_POST['first'];
        $last  = $_POST['last'];
        $Name=$first." ".$last;
        $Email   = $_POST['email'];
        $Password  = $_POST['password'];
        try{
            //isset for int numbers they can be 0
            //!empty values can't be 0
            if(!empty($Name) && isset($Email) && isset($Password)){
                $sqlInsert = "";
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
            echo '<script type="text/javascript"> window.open("../../admin/mrt.php","_self");</script>';
            die();
        }else{
            echo '<script type="text/javascript">alert("Error , Try Again!!!");</script>';
            echo '<script type="text/javascript"> window.open("../../admin/mrt.php","_self");</script>';
            die();
        }
    }
}

$insert = new InsertDetails();
$insert->startInsertDetails();
