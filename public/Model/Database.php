<?php
/**
 * Created by PhpStorm.
 * User: dylancross
 * Date: 5/08/18
 * Time: 4:07 PM
 */

class Database
{
    public static $db = null; // Database connection

    // TODO: take input for these variables from a file, allowing this to be anonymised for github when it is running on a server
    // currently set to docker details
    const DB_HOST = "wow-consumables-calculator-postgres";
    const DB_PORT = 5432;
    const DB_USER = "postgres";
    const DB_PASS = "postgres";
    const DB_NAME = "postgres";

    function __construct()
    {
        // Initialise the database connection once
        if ($this::$db == null) {
            $connString = "host=" . Database::DB_HOST . " port=" . Database::DB_PORT . " dbname=" . Database::DB_NAME
                . " user=" . Database::DB_USER . " password=" . Database::DB_PASS;
            echo $connString;
            echo "<br/> \n";

            $this::$db = pg_connect("host=wow-consumables-calculator-postgres port=5432 user=postgres password=postgres") or die("Unable to connect to database");

            // Check we connected to database
            if (!$this::$db) {
                // TODO: throw exception?
            } else {
                $this->loadTables();
            }
        }
    }

    // Initialises the tables and functions
    function initTables() {
        // Holds the data that is outputted by the blizzard api
        $auctionsSQL = "CREATE TABLE IF NOT EXISTS auctions (
            history INTEGER NOT NULL,
            auc BIGINT NOT NULL,
            item INTEGER NOT NULL,
            owner VARCHAR(255) NOT NULL,
            ownerRealm VARCHAR(255) NOT NULL,
            bid FLOAT NOT NULL,
            buyout FLOAT,
            quantity INTEGER NOT NULL,
            timeLeft VARCHAR(255),
            
            created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
            updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
            );";

        // Stores the time when the auctions table was last updated, used so we don't have to wipe auctions each time we
        //      receive new data, instead we use the id as the version
        $ahHistorySQL = "CREATE TABLE IF NOT EXISTS ah_history (
            id INTEGER NOT NULL,
            auctions INTEGER,
            
            created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
            updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
            );";

        // Stores item data from that history to save processing on retrieval from ah_history
        $itemCacheSQL = "CREATE TABLE IF NOT EXISTS item_cache (
            history INTEGER NOT NULL,
            item INTEGER NOT NULL,
            quantity INTEGER NOT NULL,
            average_buyout FLOAT NOT NULL,
            min_buyout FLOAT NOT NULL,
            max_buyout FLOAT NOT NULL,
            
            created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
            updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
            );";

        // function used to keep updated_at accurate
        // only used on item_cache table as the rest wont be updated
        $timestampFunction = "CREATE OR REPLACE FUNCTION trigger_set_timestamp()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.updated_at = NOW();
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;";
        $preItemCacheTrigger = "DROP TRIGGER IF EXISTS set_timestamp ON item_cache;";
        $itemCacheTrigger = "CREATE TRIGGER set_timestamp
            BEFORE UPDATE ON item_cache
            FOR EACH ROW
            EXECUTE PROCEDURE trigger_set_timestamp();";

        $sql = $auctionsSQL . $ahHistorySQL . $itemCacheSQL . $timestampFunction . $preItemCacheTrigger . $itemCacheTrigger;

        $result = pg_query($this::$db, $sql);

        if (!$result) {
            exit("Error creating tables");
        }
        echo $result;

    }
}
