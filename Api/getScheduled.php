<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once __DIR__ . '/Connection.php';
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
(SELECT train.trainName FROM train WHERE train.trainId=mrtSchedule.trainId) as TrainName,
(SELECT train.trainNo FROM train WHERE train.trainId=mrtSchedule.trainId) as TrainId,
(SELECT mrt.mrtNo FROM mrt WHERE mrt.mrtNo=mrtSchedule.mrtNo) as mrtId,
(SELECT station.stationName from station where station.stationId=mrtSchedule.startStation) as startStation,
(SELECT station.stationName from station where station.stationId=mrtSchedule.endStation) as endStation,
startTime,
errorTime
FROM mrtSchedule";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                array_push($jsonFood,
                    array(
                        'TrainName'=>$data['TrainName'],
                        'TrainId'=>$data['TrainId'],
                        'mrtId'=>$data['mrtId'],
                        'startStation'=>$data['startStation'],
                        'endStation'=>$data['endStation'],
                        'startTime'=>$data['startTime'],
                        'errorTime'=>$data['errorTime']
                    ));
            }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo json_encode(array("scheduled_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("scheduled_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
        }
    }
}

$json = new DisplayJsonFood();
$json->getAllJsonFood();
