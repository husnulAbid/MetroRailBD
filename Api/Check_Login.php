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
        $Email   = $_POST['email'];
        $Password   = $_POST['password'];

            if(!empty($Email) && !empty($Password))
            {
                $sqlQuery = "SELECT * FROM user WHERE Email='$Email' AND Password='$Password'";
                $getJson = $conn->prepare($sqlQuery);
                $getJson->execute();
                $result = $getJson->fetchAll(PDO::FETCH_ASSOC);

                if(count($result) > 0) {
                    foreach($result as $data)
                    {
                        $_SESSION['userId']=$data['id'];
                        $_SESSION['userName']=$data['Name'];
                        $_SESSION['userEmail']=$Email;
                    }
                    $_SESSION['loggedIn']=true;
                    $_SESSION['admin']=false;

                    echo '<script type="text/javascript"> window.open("../Dashboard/UserDashboard/","_self");</script>';            //  On Successful Login redirects to home.php
                    die();
                }

                else{
                    echo '<script type="text/javascript">alert("Authentication Error !!!");</script>';
                    echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
                    die();
                }
            }
            else{
                echo '<script type="text/javascript">alert("Please Fill Email And Password...");</script>';
                echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
                die();
            }
    }
}
if(isset($_POST['login']))   // it checks whether the user clicked login button or not
{
    $insert = new InsertDetails();
    $insert->startInsertDetails();
}
else
{
    echo '<script type="text/javascript">alert("Bad Request !!!");</script>';
    echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
    die();
}