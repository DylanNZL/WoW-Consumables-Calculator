<?php
/**
 * Created by PhpStorm.
 * User: dylancross
 * Date: 8/08/18
 * Time: 4:09 PM
 */

require ("./Utility/ApiKey.php");


class BlizzardAPI
{
    /**
     * @var json $json
     */
    private $json;

    /**
     * @var string server
     */
    private $server = "frostmourne"; // The server I play on, can be changed to any NA server

    /**
     * @return json
     */
    public function getJson() {
        return $this->json;
    }

    /**
     * @return string
     */
    public function getServer() {
        return $this->server;
    }


    /**
     * @param $json
     */
    public function setJson($json) {
        $this->json = $json;
    }


    /**
     * @param $server
     */
    public function setServer($server) {
        $this->server = $server;
    }

    /**
     * BlizzardAPI constructor.
     */
    public function __construct() {

    }


    /**
     * Calls the blizzard api for the Auction House of the NA server defined in $server
     */
    public function callAPI() {
        // This url will return an array containing one record that points to where the actual auction house data is
        $url = "https://us.api.battle.net/wow/auction/data/" . $this->server . "?locale=en_US&apikey=" . ApiKey::getKey();
        $response = file_get_contents($url);
        $temp = json_decode($response);

        // This is the url that houses the json data of the entire $server auction house at the current point in time
        $urlForAHData = $temp->files[0]->url;
        echo $urlForAHData;
        echo "<br />\n";

        $response = file_get_contents($urlForAHData);

//        $this->json = json_decode($response);
    }

    /**
     * Saves the data stored in $json to the database
     */
    public function saveAPI() {

    }

    /**
     * Prints the data stored in $json
     */
    public function printAPI() {
        print_r($this->json);

        echo "<br />\n";
    }
}