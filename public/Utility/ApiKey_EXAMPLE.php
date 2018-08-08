<?php
/**
 * Created by PhpStorm.
 * User: dylancross
 * Date: 8/08/18
 * Time: 4:14 PM
 */

/**
 * Class ApiKey_EXAMPLE
 *
 * This class houses your blizzard api key, you will need to alter this class to properly run this application:
 *  - Copy this class and save it with the name ApiKey.php
 *  - Rename the class to ApiKey
 *  - Swap the key text to your own Blizzard API key
 */
class ApiKey_EXAMPLE
{
    private static const KEY = "ENTER_YOUR_KEY_HERE";

    public static function getKey() {
        return self::KEY;
    }
}