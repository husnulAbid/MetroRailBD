<?php
/**
 * Created by PhpStorm.
 * User: Abid
 * Date: 30/04/2018
 * Time: 11:48 AM
 */

$StartStation = ($_POST['startStation']);
$endStation = ($_POST['endStation']);

$conf= include '../Api/server_conf.php';

$host  = $conf['server_host'];
$user = $conf['server_username'];
$pass = $conf['server_password'];
$db = $conf['server_dbname'];


$db_connect = new mysqli($host,$user,$pass,$db) or die('unable to connect');
//echo 'Done connecting Database'."\n\n";

$MRTgraph = array(array(2));
$MRTgraphIndex = 0;

for($i=6; $i<=11; $i++){
    $qry1 = "SELECT * FROM (SELECT DISTINCT(t1.mrtNo) as source FROM stop as t1 , stop as t2 
              WHERE t1.stationId IN (SELECT t3.stationId FROM stop as t3 WHERE t3.mrtNo = $i)
              AND t1.stationId = t2.stationId
              AND t1.mrtNo != t2.mrtNo) AS t4, (SELECT DISTINCT(t1.mrtNo) as destination 
              FROM stop as t1 , stop as t2 
              WHERE t1.stationId IN (SELECT t3.stationId FROM stop as t3 WHERE t3.mrtNo = $i)
              AND t1.stationId = t2.stationId
              AND t1.mrtNo != t2.mrtNo) as t5
              WHERE t4.source = $i
              AND t5.destination != $i;";


    $res1 = $db_connect->query($qry1) or die('bad query 1');
    while($row1 = $res1->fetch_assoc()){
        //echo  $row1["source"]."  ".$row1["destination"]."\n";
        $MRTgraph[$MRTgraphIndex][0] = $row1["source"];
        $MRTgraph[$MRTgraphIndex++][1] = $row1["destination"];
    }
}

$startStationMRTNO = array();
$endStationMRTNO = array();

$qry2 = "select stop.mrtNO from station NATURAL JOIN stop WHERE station.stationName ='$StartStation';";
$res2 = $db_connect->query($qry2)  or die('bad query 2');

$i = 0;
while($row2 = $res2->fetch_assoc()){
    $startStationMRTNO[$i++] = $row2["mrtNO"];
}


$qry3 = "select stop.mrtNO from station NATURAL JOIN stop WHERE station.stationName = '$endStation';";
$res3 = $db_connect->query($qry3)  or die('bad query 3');

$i = 0;
while($row3 = $res3->fetch_assoc()){
    $endStationMRTNO[$i++] = $row3["mrtNO"];
}

/*$MRTgraphIndexCount = count($MRTgraph);
for ($i= 0; $i<$MRTgraphIndexCount; $i++){
    echo $MRTgraph[$i][0]." ".$MRTgraph[$i][1]."\n";
}*/

/* trying to make an adjacent list from that output

$MRTadjacencyList = array(array());

$MRTNumberForGraph = 12;
for ($i= 1; $i<=$MRTNumberForGraph; $i++){               //should be 100
    for ($j= 1; $j<=$MRTNumberForGraph; $j++) {
        $MRTadjacencyList[$i][$j] = 0;
    }
}

for ($i= 0; $i<$MRTgraphIndexCount; $i++){
    $MRTadjacencyList[$MRTgraph[$i][0]][$MRTgraph[$i][1]] = 1; //."\n";
}

for ($i= 1; $i<=$MRTNumberForGraph; $i++){               //should be 100
    for ($j= 1; $j<=$MRTNumberForGraph; $j++) {
        echo $MRTadjacencyList[$i][$j]. " ";          //." ".$MRTgraph[$i][1]."\n";
    }
    echo "\n";
}*/

require_once('GraphClass.php');

$graph24 = array(
    6 => array(7, 8),
    7 => array(6),
    8 => array(6,10,9),
    9 => array(8,10),
    10 => array(8,9),
);

echo "\n\n";

$myRoutes = array();
$g = new Graph($graph24);
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

    echo "Start From : ".$StartStation. " <p>" ;

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
    echo "Destination : ".$endStation. " <p>" ;

}


?>