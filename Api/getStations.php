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
            $sqlQuery = "SELECT * FROM station";
            $getJson = $conn->prepare($sqlQuery);
            $getJson->execute();
            $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $data)
            {
                array_push($jsonFood,
                    array(
                        'stationName'=>$data['stationName'],
                        'stationid'=>$data['stationId'],
                        'Longitude'=>$data['Longitude'],
                        'Latitude'=>$data['Latitude']
                    ));
            }
        }catch (PDOException $e){
            echo "Error while displaying json : " . $e->getMessage();
        }
        if($sqlQuery){
            echo json_encode(array("station_data"=>$jsonFood,$status=>1,$message=>"Success"));
        }else{
            echo json_encode(array("station_data"=>null,$status=>0, $message=>"Failed while displaying Main Data"));
        }
    }
}

    $json = new DisplayJsonFood();
    $json->getAllJsonFood();
