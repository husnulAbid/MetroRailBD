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
            $sqlQuery = "SELECT stopId,stop.stationId as statid,stationName,mrtNo,orderNo,reachTimeFromP1,reachTimeFromP2 
FROM `stop` , station 
where stop.stationId=station.stationId";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                array_push($jsonFood,
                    array(
                        'stopId'=>$data['stopId'],
                        'stationId'=>$data['statid'],
                        'stationName'=>$data['stationName'],
                        'mrtNo'=>$data['mrtNo'],
                        'orderNo'=>$data['orderNo'],
                        'reachTimeFromP1'=>$data['reachTimeFromP1'],
                        'reachTimeFromP2'=>$data['reachTimeFromP2']
                    ));
            }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo json_encode(array("stoppage_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("stoppage_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
        }
    }
}

$json = new DisplayJsonFood();
$json->getAllJsonFood();
