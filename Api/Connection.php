<?php
/**
 * Created by PhpStorm.
 * User: putuguna
 * Date: 1/24/2017
 * Time: 10:13 AM
 */

class Connection{

    function getConnection(){
        $conf= include 'server_conf.php';

        $host       = $conf['server_host'];
        $username   = $conf['server_username'];
        $password   = $conf['server_password'];
        $dbname     = $conf['server_dbname'];
        //echo $host." ".$username." ".$password." ".$dbname;
        try{
            $conn    = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch (PDOException $e){
            echo "ERROR CONNECTIONF : " . $e->getMessage();
        }
    }
}
