<?php
/**
 * Created by PhpStorm.
 * User: dylancross
 * Date: 7/08/18
 * Time: 5:04 PM
 */

// Representation of the Auction table
class Auction extends Database
{
    /**
     * @var integer history ID
     */
    private $_history;

    /**
     * @var integer auction id
     */
    private $_auc;

    /**
     * @var integer item ID
     */
    private $_item;

    /**
     * @var string owner name
     */
    private $_owner;

    /**
     * @var string owner realm
     */
    private $_ownerRealm;

    /**
     * @var float current bid
     */
    private $_bid;

    /**
     * @var float buyout price
     */
    private $_buyout;

    /**
     * @var integer quantity
     */
    private $_quantity;

    /**
     * @var string time left
     */
    private $_timeLeft;

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
    public function getAuc(): int
    {
        return $this->_auc;
    }

    /**
     * @param int $auc
     */
    public function setAuc(int $auc)
    {
        $this->_auc = $auc;
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
     * @return string
     */
    public function getOwner(): string
    {
        return $this->_owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner)
    {
        $this->_owner = $owner;
    }

    /**
     * @return string
     */
    public function getOwnerRealm(): string
    {
        return $this->_ownerRealm;
    }

    /**
     * @param string $ownerRealm
     */
    public function setOwnerRealm(string $ownerRealm)
    {
        $this->_ownerRealm = $ownerRealm;
    }

    /**
     * @return float
     */
    public function getBid(): float
    {
        return $this->_bid;
    }

    /**
     * @param float $bid
     */
    public function setBid(float $bid)
    {
        $this->_bid = $bid;
    }

    /**
     * @return float
     */
    public function getBuyout(): float
    {
        return $this->_buyout;
    }

    /**
     * @param float $buyout
     */
    public function setBuyout(float $buyout)
    {
        $this->_buyout = $buyout;
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
     * @return string
     */
    public function getTimeLeft(): string
    {
        return $this->_timeLeft;
    }

    /**
     * @param string $timeLeft
     */
    public function setTimeLeft(string $timeLeft)
    {
        $this->_timeLeft = $timeLeft;
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
     * @param integer $auc
     * @param integer $item
     * @param string $owner
     * @param string $ownerRealm
     * @param float $bid
     * @param float $buyout
     * @param integer $quantity
     * @param string $timeLeft
     * @return Auction
     *
     * Constructs a Auction object from the variables provided
     */
    public static function __constructWithVariables($history, $auc, $item, $owner, $ownerRealm, $bid, $buyout, $quantity, $timeLeft) {
        $auction = new Auction();

        $auction->setHistory($history);
        $auction->setAuc($auc);
        $auction->setItem($item);
        $auction->setOwner($owner);
        $auction->setOwnerRealm($ownerRealm);
        $auction->setBid($bid);
        $auction->setBuyout($buyout);
        $auction->setQuantity($quantity);
        $auction->setTimeLeft($timeLeft);

        return $auction;
    }

    /**
     * @return bool
     *
     * Saves the current variables into the database
     */
    function save() {
        $query = "INSERT INTO auctions VALUES(" . $this->getHistory() . ", " . $this->getAuc() . ", "
            . $this->getItem() . ", " . $this->getOwner() . ", " . $this->getOwnerRealm() . ", "
            . $this->getBid() . ", " . $this->getBuyout() . ", " . $this->getQuantity() . ", "
            . $this->getTimeLeft() . ");";
        $result = pg_query($this->db, $query);

        if (!$result) {
            // error saving data
            return false;
        } else {
            return true;
        }
    }
}