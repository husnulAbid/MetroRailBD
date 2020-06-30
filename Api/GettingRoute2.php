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
        $start = $_POST['startStation'];
        $end = $_POST['endStation'];
        //$start  = 'Motijheel';
        //$end  = 'shongkor';
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
        echo "Start MRT " . $startmrt . "\n";
        $getJson = $conn->prepare($sqlQueryend);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $data) {
            $endmrt = $data['mrtNo'];
        }
        echo "End MRT " . $endmrt . "\n";
        //get all connections
        $sqlConnections = "SELECT * FROM (SELECT mrtNo as smrt,stationid as sstation FROM stop) as t1,
                        (SELECT mrtNo as emrt,stationid as estation FROM stop) as t2 
                        WHERE t1.sstation=t2.estation and t1.smrt!=t2.emrt ORDER BY t1.smrt,t2.emrt ASC";
        $getJson = $conn->prepare($sqlConnections);
        $getJson->execute();
        $result = $getJson->fetchAll(PDO::FETCH_ASSOC);
        echo "getting all connections \n";
        $jsonFood[$startmrt] = null;
        foreach ($result as $data) {
            $jsonFood = $this->insertMultipleValueinKey($data['smrt'], $data['emrt'], $jsonFood);
        }





        $user = 'root';
        $pass = '000000';
        $db = 'projectx';

        $db_connect = new mysqli('localhost',$user,$pass,$db) or die('unable to connect');

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



        echo "\n\n";

        $myRoutes = array();
        $g = new Graph($jsonFood);
        //$g->breadthFirstSearch(7, 10);

        for ($i= 0; $i<count($startStationMRTNO); $i++){               //should be 100
            for ($j= 0; $j<count($endStationMRTNO); $j++) {
                $myRoutes = $g->breadthFirstSearch($startStationMRTNO[$i], $endStationMRTNO[$j]);
                echo "<p>";

            }

            /*echo "<p>..........<p>";
            for ($i= 0; $i<count($myRoutes); $i++){
                echo $myRoutes[$i]. " ";
            }*/

            echo "Start From : ".$start. " <p>" ;

            for ($i= 0; $i<count($myRoutes)-1; $i++){
                $k = $i+1;
                echo "Take MRT : ".$myRoutes[$i]. " <p>";

                $qry4 = "SELECT t1.stationId FROM stop as t1 , stop as t2 WHERE t1.mrtNo = '$myRoutes[$i]'
                AND t2.mrtNo = '$myRoutes[$k]' AND t1.stationId = t2.stationId LIMIT 1;";
                $res4 = $db_connect->query($qry4)  or die('bad query 4');
                $row4 = $res4->fetch_assoc();
                $stationName1 = $row4["stationId"];


                $qry5 = "SELECT station.stationName FROM station WHERE station.stationId = $stationName1;";
                $res5 = $db_connect->query($qry5)  or die('bad query 5');
                $row5 = $res5->fetch_assoc();
                $stationName2 = $row5["stationName"];
                echo "Get off from MRT at : ".$stationName2. " <p>";
                //echo $stationName2. " ";
            }

            echo "Take MRT : ".$myRoutes[$i]. " <p>";
            echo "Destination : ".$end. " <p>" ;

        }
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
