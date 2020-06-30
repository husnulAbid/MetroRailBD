<?php
/**
 * Created by PhpStorm.
 * User: Abid
 * Date: 13/05/2018
 * Time: 07:58 PM
 */

$startStation = ($_POST['startStation']);
$endStation = ($_POST['endStation']);
$mrtNo = ($_POST['mrtNo']);

$conf= include '../Api/server_conf.php';

$host  = $conf['server_host'];
$user = $conf['server_username'];
$pass = $conf['server_password'];
$db = $conf['server_dbname'];

//bal
$jsonFood = array();
$db_connect = new mysqli($host,$user,$pass,$db) or die('unable to connect');
//echo 'Done connecting Database'."\n\n";


$qry1 = "SELECT stop.orderNo FROM station NATURAL JOIN stop 
            WHERE station.stationName = '$startStation' AND stop.mrtNo = $mrtNo ;";

$res1 = $db_connect->query($qry1)  or die('bad query 1');
$row1 = $res1->fetch_assoc();

//echo "Start order no : ";
 $startStationOrder = $row1["orderNo"];


$qry2 = "SELECT stop.orderNo FROM station NATURAL JOIN stop 
            WHERE station.stationName = '$endStation' AND stop.mrtNo = $mrtNo ;";

$res2 = $db_connect->query($qry2)  or die('bad query 2');
$row2 = $res2->fetch_assoc();

//echo "  End order no : ";
$endStationOrder = $row2["orderNo"];

if($startStationOrder>$endStationOrder){
    $qry3 = "SELECT station.stationName FROM station, (SELECT *  FROM (SELECT * FROM stop WHERE stop.mrtNo = $mrtNo) as t1,
				(SELECT min(stop.orderNo) as minOrderNo FROM stop 
                 	WHERE stop.mrtNo = $mrtNo) as t2
          WHERE t1.orderNo = t2.minOrderNo) as t3
      WHERE station.stationId = t3.stationId;";

    $res3 = $db_connect->query($qry3)  or die('bad query 3');
    $row3 = $res3->fetch_assoc();

    //echo "  Dirrection : ";
    array_push($jsonFood,
        array(
            '$dirrection'=>$row3["stationName"]

        ));
    echo json_encode(array("direction_data"=>$jsonFood,$status=>1,$message=>"Success"));
    //echo $dirrection = $row3["stationName"];
}
else {
    $qry4 = "SELECT station.stationName FROM station, (SELECT *  FROM (SELECT * FROM stop WHERE stop.mrtNo = $mrtNo) as t1,
				(SELECT max(stop.orderNo) as minOrderNo FROM stop 
                 	WHERE stop.mrtNo = $mrtNo) as t2
          WHERE t1.orderNo = t2.minOrderNo) as t3
      WHERE station.stationId = t3.stationId;";

    $res4 = $db_connect->query($qry4)  or die('bad query 4');
    $row4 = $res4->fetch_assoc();

   // echo "  Dirrection : ";
   // echo $dirrection = $row4["stationName"];
    array_push($jsonFood,
        array(
            '$dirrection'=>$row4["stationName"]

        ));
    echo json_encode(array("direction_data"=>$jsonFood,$status=>1,$message=>"Success"));
}


?>