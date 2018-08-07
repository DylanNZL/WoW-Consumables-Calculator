<?php
/**
 * Created by PhpStorm.
 * User: dylancross
 * Date: 7/08/18
 * Time: 7:11 PM
 */

class ItemCache extends Database
{
    /**
     * @var integer history id
     */
    private $_history;

    /**
     * @var integer item
     */
    private $_item;

    /**
     * @var integer quantity
     */
    private $_quantity;

    /**
     * @var float average buyout
     */
    private $_average_buyout;

    /**
     * @var float min buyout
     */
    private $_min_buyout;

    /**
     * @var float max buyout
     */
    private $_max_buyout;

    /**
     * @var timestamptz record created
     */
    private $_created_at;

    /**
     * @var timestamptz record last updated
     */
    private $_updated_at;

    /*
     * =========================================================
     * ==================== Getters/Setters ====================
     * =========================================================
     */

    /**
     * @return int
     */
    public function getHistory(): int
    {
        return $this->_history;
    }

    /**
     * @param int $history
     */
    public function setHistory(int $history)
    {
        $this->_history = $history;
    }

    /**
     * @return int
     */
    public function getItem(): int
    {
        return $this->_item;
    }

    /**
     * @param int $item
     */
    public function setItem(int $item)
    {
        $this->_item = $item;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->_quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->_quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getAverageBuyout(): float
    {
        return $this->_average_buyout;
    }

    /**
     * @param float $average_buyout
     */
    public function setAverageBuyout(float $average_buyout)
    {
        $this->_average_buyout = $average_buyout;
    }

    /**
     * @return float
     */
    public function getMinBuyout(): float
    {
        return $this->_min_buyout;
    }

    /**
     * @param float $min_buyout
     */
    public function setMinBuyout(float $min_buyout)
    {
        $this->_min_buyout = $min_buyout;
    }

    /**
     * @return float
     */
    public function getMaxBuyout(): float
    {
        return $this->_max_buyout;
    }

    /**
     * @param float $max_buyout
     */
    public function setMaxBuyout(float $max_buyout)
    {
        $this->_max_buyout = $max_buyout;
    }

    /**
     * @return timestamptz
     */
    public function getCreatedAt(): timestamptz
    {
        return $this->_created_at;
    }

    /**
     * @param timestamptz $created_at
     */
    public function setCreatedAt(timestamptz $created_at)
    {
        $this->_created_at = $created_at;
    }

    /**
     * @return timestamptz
     */
    public function getUpdatedAt(): timestamptz
    {
        return $this->_updated_at;
    }

    /**
     * @param timestamptz $updated_at
     */
    public function setUpdatedAt(timestamptz $updated_at)
    {
        $this->_updated_at = $updated_at;
    }

    /*
     * =========================================================
     * ======================= Functions =======================
     * =========================================================
     */

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param integer $history
     * @param integer $item
     * @param integer $quantity
     * @param float $averageBuyout
     * @param float $minBuyout
     * @param float $maxBuyout
     * @return ItemCache
     *
     * constructs an ItemCache object from the provided variables
     */
    public static function __constructWithVariables($history, $item, $quantity, $averageBuyout, $minBuyout, $maxBuyout) {
        $itemCache = new ItemCache();

        $itemCache->setHistory($history);
        $itemCache->setItem($item);
        $itemCache->setQuantity($quantity);
        $itemCache->setAverageBuyout($averageBuyout);
        $itemCache->setMinBuyout($minBuyout);
        $itemCache->setMaxBuyout($maxBuyout);

        return $itemCache;
    }

    public function save() {
        $query = "INSERT INTO item_cache VALUES (" . $this->getHistory(). ", " . $this->getItem(). ", " .
            $this->getQuantity(). ", " . $this->getAverageBuyout(). ", " . $this->getMinBuyout(). ", " .
            $this->getMaxBuyout(). ");";

        $result = pg_query($this->db, $query);

        if (!$result) {
            // error
            return false;
        } else {
            return true;
        }
    }

}