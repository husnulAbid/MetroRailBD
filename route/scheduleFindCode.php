<?php
/**
 * Created by PhpStorm.
 * User: Abid
 * Date: 13/05/2018
 * Time: 07:58 PM
 */

$stationName = ($_POST['stationName']);
$mrtNo = ($_POST['mrtNo']);
$dirrection = ($_POST['dirrection']);


$conf= include '../Api/server_conf.php';

$host  = $conf['server_host'];
$user = $conf['server_username'];
$pass = $conf['server_password'];
$db = $conf['server_dbname'];

$db_connect = new mysqli($host,$user,$pass,$db) or die('unable to connect');
//echo 'Done connecting Database'."\n\n";


$qry12 = "SELECT * FROM station WHERE station.stationName = '$dirrection';";
$res12 = $db_connect->query($qry12)  or die('bad query 12');
$row12 = $res12->fetch_assoc();

$dirrectionId = $row12["stationId"];


$qry1 = "SELECT mrt.mrtStartP1, stop.reachTimeFromP1, mrt.mrtStartP2, stop.reachTimeFromP2 FROM station NATURAL JOIN stop NATURAL JOIN mrt
          WHERE station.stationName = '$stationName' AND stop.mrtNo = $mrtNo;";
$res1 = $db_connect->query($qry1)  or die('bad query 1');
$row1 = $res1->fetch_assoc();

$mrtStartP1 = $row1["mrtStartP1"];
$mrtStartP2 = $row1["mrtStartP2"];
$reachTimeFromP1 = $row1["reachTimeFromP1"];
$reachTimeFromP2 = $row1["reachTimeFromP2"];

if($dirrectionId == $mrtStartP1){     //$mrtStartP1 er stationId
    //echo "From  ".$mrtStartP2. "  takes  ".  $reachTimeFromP2 ."  minutes" . "   Dirrection  ".  $mrtStartP1.  "<p>";
    echo "Station Name : ". $stationName . "<p>".  "Dirrection :  ". $dirrection.  "<p><p>";

    $qry2 = "SELECT DATE_ADD(mrtSchedule.startTime, INTERVAL $reachTimeFromP2 MINUTE) as time FROM mrtSchedule
              WHERE mrtSchedule.startStation = $mrtStartP2
              AND mrtSchedule.mrtNo = $mrtNo;";

    $res2 = $db_connect->query($qry2)  or die('bad query 2');
    while ($row2 = $res2->fetch_assoc()){
        echo $row2["time"]."<br>";
    }
}
else if($dirrectionId == $mrtStartP2){

    echo "Station Name : ". $stationName . "<p>".  "Dirrection :  ". $dirrection.  "<p><p>";

    $qry3 = "SELECT DATE_ADD(mrtSchedule.startTime, INTERVAL $reachTimeFromP1 MINUTE) as time FROM mrtSchedule
              WHERE mrtSchedule.startStation = $mrtStartP1
              AND mrtSchedule.mrtNo = $mrtNo;";

    $res3 = $db_connect->query($qry3)  or die('bad query 3');
    while ($row3 = $res3->fetch_assoc()){
        echo $row3["time"]."<br>";
    }
}




?>