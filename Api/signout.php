<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Al Rifat
 * Date: 20-Mar-18
 * Time: 4:37 PM
 */
if(!isset($_SESSION))
{
    session_start();
}

$_SESSION['user']=null;
$_SESSION['loggedIn']=false;
session_destroy();
echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';
die();
?>