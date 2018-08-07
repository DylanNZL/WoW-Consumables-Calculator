<?php
/**
 * Created by PhpStorm.
 * User: dylancross
 * Date: 7/08/18
 * Time: 6:14 PM
 */

class AuctionHouseHistory extends Database
{
    /**
     * @var integer id
     */
    private $id;

    /**
     * @var integer auctions
     */
    private $auctions;

    /**
     * @var timestamptz record created
     */
    private $created_at;

    /**
     * @var timestamptz record last updated
     */
    private $updated_at;

    /*
     * =========================================================
     * ==================== Getters/Setters ====================
     * =========================================================
     */

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getAuctions(): int
    {
        return $this->auctions;
    }

    /**
     * @param int $auctions
     */
    public function setAuctions(int $auctions)
    {
        $this->auctions = $auctions;
    }

    /**
     * @return timestamptz
     */
    public function getCreatedAt(): timestamptz
    {
        return $this->created_at;
    }

    /**
     * @param timestamptz $created_at
     */
    public function setCreatedAt(timestamptz $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return timestamptz
     */
    public function getUpdatedAt(): timestamptz
    {
        return $this->updated_at;
    }

    /**
     * @param timestamptz $updated_at
     */
    public function setUpdatedAt(timestamptz $updated_at)
    {
        $this->updated_at = $updated_at;
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
     * @param $auctions
     * @return AuctionHouseHistory
     *
     * constructs an AuctionHouseHistory object with the provided number of auctions
     */
    public static function __constructWithVariables($auctions) {
        $auctionHouseHistory = new AuctionHouseHistory();

        $auctionHouseHistory->setAuctions($auctions);

        return $auctionHouseHistory;
    }

    public function save() {
        $query = "INSERT INTO ah_history VALUES (". $this->getAuctions().");";

        $result = pg_query($this->db, $query);

        if (!$result) {
            // error
            return false;
        } else {
            return true;
        }
    }
}