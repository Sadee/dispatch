<?php


namespace App;

use mysql_xdevapi\Collection;

/**
 * Class Courier
 * @package App
 */
abstract class Courier
{

    /**
     * Set of consignments of the dispatch period will be saved in this file
     * This file can be csv, xml, json any other depending on the Courier company
     * @var string
     */
    private static $batchFile;

    /**
     * Connection url of endpoint/ path to host batch file
     * @var
     */
    private static $connectionUrl;

    /**
     * User credential (username) for connecting Courier
     * @var
     */
    private static $connectionUsername;

    /**
     * User credential for connecting Courier
     * @var
     */
    private static $connectionPassword;

    /**
     * @var string
     */
    private $originDepot;

    /**
     * @var int|string
     */
    protected $serviceType;

    /**
     * @var string
     */
    private $serviceCode;

    /**
     * @var array
     */
    private $dispatchData;

    /**
     * @var string
     */
    private $tradingName = "G4M";

    /**
     * @var Consignment[]
     */
    protected $consignments = [];

    /**
     * @var string[]
     */
    protected $consignmentItem = [];

    /**
     * @return array
     */
    public function getDispatchData(): array
    {
        return $this->dispatchData;
    }

    /**
     * @return string
     */
    public static function getBatchFile(): string
    {
        return self::$batchFile;
    }

    /**
     * @return mixed
     */
    public static function getConnectionUrl()
    {
        return self::$connectionUrl;
    }

    /**
     * @return mixed
     */
    public static function getConnectionUsername()
    {
        return self::$connectionUsername;
    }

    /**
     * @return mixed
     */
    public static function getConnectionPassword()
    {
        return self::$connectionPassword;
    }

    /**
     * @return string
     */
    public function getOriginDepot(): string
    {
        return $this->originDepot;
    }

    /**
     * @return int|string
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * @return string
     */
    public function getTradingName(): string
    {
        return $this->tradingName;
    }

    /**
     * Add the Order item to the Courier and it s consignment
     * Prepare the required data, such as: Delivery details, Item details, quantity, ...
     * @param Consignment $consignment
     */
    public function setConsignment(Consignment $consignment)
    {

    }

    /**
     * @param string[] $consignmentItem
     */
    public function setConsignmentItem(array $consignmentItem)
    {
        $this->consignmentItem = $consignmentItem;
    }

    /**
     * @return string[]
     */
    public function getConsignments(): array
    {
        return $this->consignments;
    }

    /**
     * The function is to determine parcels collecting depot/delivery origin depot
     * according to the given dispatch postcode (collection) and the set of data/algorithm given by the chosen Courier company.
     * @param $postcode
     */
    public function setOriginDepot($postcode)
    {
        // Assigning value to the $this->originDepot
    }

    /**
     * This is for service type such as: collection from warehouse, delivery from depot
     * @param int $serviceType
     */
    public function setServiceType(int $serviceType)
    {
        $this->serviceType = $serviceType;
    }

    /**
     * Set the service code (Ex: next day delivery, normal delivery, Saturday delivery) according to the delivery date
     *
     */
    private function setServiceCode()
    {

    }

    /**
     * Send the consignments batch file to the courier
     */
    public function sendDispatchData()
    {
        // Send dispatch batch file to the courier
    }

    /**
     * Prepare Courier specific data set as they need to do the delivery
     * and assign the values to the dispatch data
     * @param Consignment $consignment
     */
    public function prepareConsignment(Consignment $consignment)
    {
        $deliveryAddress = $consignment->getDeliveryDetails();
        $this->setOriginDepot($deliveryAddress->postcode);
        $this->setServiceCode($deliveryAddress->deliveryDate);
        $this->setServiceType();
        $this->prepareDispatchData();
    }

    /**
     * Update batch file of the dispatch period with the consignment
     */
    public function updateDispatchBatchFile()
    {
        if($csvFile = self::getBatchFile()) {
            $fp = fopen($csvFile, 'w');

            foreach ($this->consignments as $item) {
                fputcsv($fp, $item);
            }

            fclose($fp);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Send courier specified dispatched email to the customer
     */
    public function sendDispatchEmail()
    {

    }

    /**
     * Connect the courier system
     * This can be API, FTP, Email, ..
     */
    private function connectCourier()
    {
        // Use endpoint url & credentials to create a connection and set it to $this->connection
    }

    /**
     * Disconnect the courier system
     */
    private function disconnectCourier()
    {

    }

    /**
     * Send/Transfer consignments batch file to the courier
     */
    public function transferBatchData()
    {
        $this->connectCourier();
        // Send the dataset
    }

}
