<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once '../Connection.php';
class DisplayJsonFood{
    function getAllJsonFood(){
        $connection = new Connection();
        $conn = $connection->getConnection();
        $jsonFood = array();
        $status="status";
        $message = "message";
        //$name=$_POST['Name'];
        // echo '<script type="text/javascript">alert("Reached");</script>';
        try{
            $sqlQuery = "SELECT 
mrtNo,
mrtName,
(SELECT stationName from station WHERE station.stationId=mrt.mrtStartP1) as StartP1,
(SELECT stationName from station WHERE station.stationId=mrt.mrtStartP2) as StartP2 
FROM `mrt`";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                array_push($jsonFood,
                    array(
                        'mrtNo'=>$data['mrtNo'],
                        'mrtName'=>$data['mrtName'],
                        'StartP1'=>$data['StartP1'],
                        'StartP2'=>$data['StartP2']
                    ));
            }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo json_encode(array("mrt_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("mrt_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
        }
    }
}

$json = new DisplayJsonFood();
$json->getAllJsonFood();
