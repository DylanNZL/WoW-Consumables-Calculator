<?php
/**
 * Created by PhpStorm.
 * User: dylancross
 * Date: 5/08/18
 * Time: 4:20 PM
 */

//require("./Model/Database.php");
//
//$database = new Database();
require('BlizzardAPI.php');

$apiCall = new BlizzardAPI();

$apiCall->callAPI();
$apiCall->printAPI();



echo "\n";
