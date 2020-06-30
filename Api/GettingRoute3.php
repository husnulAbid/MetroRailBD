<?php
error_reporting(E_ALL);
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
        $start = $_POST['startStation'];
        $end = $_POST['endStation'];
        //$start  = 'Mirpur 11 Station';
        //$end  = 'banani';
        $jsonFood = array();
        //get mrt of start and end position
        $sqlQuerystart = "SELECT mrtNo FROM `station` NATURAL JOIN stop WHERE stationName='$start'";
        $sqlQueryend = "SELECT mrtNo FROM `station` NATURAL JOIN stop WHERE stationName='$end'";
        $getJson = $conn->prepare($sqlQuerystart);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        $startmrt = 0;
        $endmrt = 0;
        foreach ($result as $data) {
            $startmrt = $data['mrtNo'];
        }
        //echo "Start MRT " . $startmrt . "\n";
        $getJson = $conn->prepare($sqlQueryend);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $data) {
            $endmrt = $data['mrtNo'];
        }
        //echo "End MRT " . $endmrt . "\n";
        //get all connections
        $sqlConnections = "SELECT * FROM (SELECT mrtNo as smrt,stationid as sstation FROM stop) as t1,
                        (SELECT mrtNo as emrt,stationid as estation FROM stop) as t2 
                        WHERE t1.sstation=t2.estation and t1.smrt!=t2.emrt ORDER BY t1.smrt,t2.emrt ASC";
        $getJson = $conn->prepare($sqlConnections);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
       // echo "getting all connections \n";
        //$jsonFood[$startmrt] = null;
        foreach ($result as $data) {
            $jsonFood = $this->insertMultipleValueinKey($data['smrt'], $data['emrt'], $jsonFood);
        }
        //abid pro's work
        $conf= include 'server_conf.php';

        $host  = $conf['server_host'];
        $user = $conf['server_username'];
        $pass = $conf['server_password'];
        $db = $conf['server_dbname'];

        $db_connect = new mysqli($host,$user,$pass,$db) or die('unable to connect');
        $startStationMRTNO = array();
        $endStationMRTNO = array();
        $qry2 = "select stop.mrtNO from station NATURAL JOIN stop WHERE station.stationName ='$start';";
        $res2 = $db_connect->query($qry2)  or die('bad query 2');
        $i = 0;
        while($row2 = $res2->fetch_assoc()){
            $startStationMRTNO[$i++] = $row2["mrtNO"];
        }
        $qry3 = "select stop.mrtNO from station NATURAL JOIN stop WHERE station.stationName = '$end';";
        $res3 = $db_connect->query($qry3)  or die('bad query 3');
        $i = 0;
        while($row3 = $res3->fetch_assoc()){
            $endStationMRTNO[$i++] = $row3["mrtNO"];
        }
        require_once('../route/GraphClass.php');
        //echo "\n\n";
        $myRoutes = array();
        $g = new Graph($jsonFood);
        //$g->breadthFirstSearch(7, 10);
        for ($i= 0; $i<count($startStationMRTNO); $i++){               //should be 100
            for ($j= 0; $j<count($endStationMRTNO); $j++) {
                $myRoutes = $g->breadthFirstSearch($startStationMRTNO[$i], $endStationMRTNO[$j]);
                //echo "<p>";
            }
        }
        // echo json_encode(array("route_data"=>$myRoutes));
        $length = count($myRoutes);
       // echo "length : ".$length;
            $sql="SELECT t1.stationId, station.stationName as Name FROM (SELECT stationId FROM stop WHERE mrtNo='$myRoutes[0]') as t1, 
        (SELECT stationId FROM stop WHERE mrtNo='$myRoutes[1]') as t2, station WHERE t1.stationId=t2.stationId AND station.stationId=t1.stationId";
        //jokhon singel ekta point pay tokhon ei $myRoutes[1] data to o passe na :3
        //ho sheita to apnare koisilam . kintu still 3 ta point diyeu kaj kortasilo na :/
        //kaj kortase amar pc te bt tor pc te ektu besi error dhore ekta input de to amare jeta toc pc te kortase na
        //single point ?
        //yo

         for ($i = 1; $i < $length-1; $i++) {
            $j=$i+1;
            $sql=$sql." UNION "."SELECT t1.stationId,station.stationName as Name FROM (SELECT stationId FROM stop WHERE mrtNo='$myRoutes[$i]') as t1,
              (SELECT stationId FROM stop WHERE mrtNo='$myRoutes[$j]') as t2, station WHERE t1.stationId=t2.stationId AND station.stationId=t1.stationId";
        }
        //echo $sql;
        $jsonFood = array();
        $getJson = $conn->prepare($sql);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        array_push($jsonFood,$start);
        foreach($result as $data)
        {
            array_push($jsonFood,$data['Name']);
        }
        array_push($jsonFood,$end);
        //echo json_encode(array("mrt_No"=>$myRoutes,"route_names"=>$jsonFood));
        $length = count($jsonFood);
        $sql="SELECT * FROM station WHERE stationName='$jsonFood[0]'";
        for ($i = 1; $i < $length; $i++) {
            $sql=$sql." UNION "."SELECT * FROM station WHERE stationName='$jsonFood[$i]'";
        }
        //echo $sql;
        $latLong = array();
        $getJson = $conn->prepare($sql);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $data)
        {
            array_push($latLong,
                array
                (
                    'stationId'=>$data['stationId'],
                    'stationName'=>$data['stationName'],
                    'Longitude'=>$data['Longitude'],
                    'Latitude'=>$data['Latitude']
                ));
        }

        echo json_encode(array("route_Details"=>$latLong,"mrt_data"=>$myRoutes));
    }
    function insertMultipleValueinKey($key, $value, $jsonFood)
    {
        $jf=$jsonFood;
        //solved
        if(!array_key_exists($key, $jf))
        {
            $arr=array($value);
            $jf[$key]=$arr;
        }
        /*
            if($jf[$key]===null)
            {
                $arr=array($value);
                $jf[$key]=$arr;
                //echo json_encode(array("mrt_Connections"=>$jsonFood));
            }
        */
        else{
            $arr=$jf[$key];
            array_push($arr,$value);
            $jf[$key]=$arr;
            //echo json_encode(array("mrt_Connections"=>$jsonFood));
        }
        return $jf;
    }
}
$insert = new InsertDetails();
$insert->startInsertDetails();
?>