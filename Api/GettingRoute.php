<?php
if(!isset($_SESSION))
{
    session_start();
}

// include db connect class
require_once 'Connection.php';
class InsertDetails{

    function startInsertDetails()
    {
        $connection = new Connection();
        $conn = $connection->getConnection();
        //array for json response
        $response = array();
        $start  = $_POST['startStation'];
        $end  = $_POST['endStation'];
        //$start  = 'Motijheel';
        //$end  = 'shongkor';
        $jsonFood = array();
        //get mrt of start and end position
        $sqlQuerystart = "SELECT mrtNo FROM `station` NATURAL JOIN stop WHERE stationName='$start'";
        $sqlQueryend = "SELECT mrtNo FROM `station` NATURAL JOIN stop WHERE stationName='$end'";
        $getJson = $conn->prepare($sqlQuerystart);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        $startmrt=0;
        $endmrt=0;
        foreach($result as $data)
        {
            $startmrt=$data['mrtNo'];
        }
        echo "Start MRT ".$startmrt."\n";
        $getJson = $conn->prepare($sqlQueryend);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $data)
        {
            $endmrt=$data['mrtNo'];
        }
        echo "End MRT ".$endmrt."\n";
        //get all connections
        $sqlConnections="SELECT * FROM (SELECT mrtNo as smrt,stationid as sstation FROM stop) as t1,
                        (SELECT mrtNo as emrt,stationid as estation FROM stop) as t2 
                        WHERE t1.sstation=t2.estation and t1.smrt!=t2.emrt ORDER BY t1.smrt,t2.emrt ASC";
        $getJson = $conn->prepare($sqlConnections);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        echo "getting all connections \n";
        $jsonFood[$startmrt]=null;
        foreach($result as $data)
        {
            $jsonFood=$this->insertMultipleValueinKey($data['smrt'], $data['emrt'], $jsonFood);
        }
        echo json_encode(array("mrt_Connections"=>$jsonFood));

    }

    function insertMultipleValueinKey($key, $value, $jsonFood)
    {

        if($jsonFood[$key]==null)
        {
            $arr=array($value);

            $jsonFood[$key]=$arr;
            //echo json_encode(array("mrt_Connections"=>$jsonFood));
        }
        else{

            $arr=$jsonFood[$key];
            array_push($arr,$value);
            $jsonFood[$key]=$arr;
            //echo json_encode(array("mrt_Connections"=>$jsonFood));
        }
        return $jsonFood;

    }

}

    $insert = new InsertDetails();
    $insert->startInsertDetails();
