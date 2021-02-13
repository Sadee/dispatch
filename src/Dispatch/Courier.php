<?php


namespace Dispatch;

use mysql_xdevapi\Collection;

/**
 * Class Courier
 * @package Dispatch
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
    private $serviceType;

    /**
     * @var string
     */
    private $serviceCode;

    /**
     * @var array
     */
    private $dispatchData;

    /**
     * Update the batch file/Dataset of the dispatch period with the consignment data
     * Prepare the required data, such as:
     *  Delivery details such as
     * @param Condignment $consignment
     */
    public function setConsignment(Condignment $consignment)
    {
        $deliveryAddress = $consignment->getDeliveryDetails();
        $this->setOriginDepot($deliveryAddress->postcode);
        $this->setServiceCode($deliveryAddress->deliveryDate);
        $this->prepareDispatchData();
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
     * This is for sevice type such as: collection from warehouse, delivery from depot, door to door, ...
     */
    public function setServiceType()
    {
        // Assigning value to the $this->serviceType
    }

    /**
     * Set the service code (Ex: next day delivery, normal delivery, Saturday delivery) according to the delivery date
     * @param string $deliveryDate
     */
    public function setServiceCode(string $deliveryDate)
    {
        $this->serviceCode;
    }

    /**
     * Create the data set for the consignments batch file
     */
    public function setDispatchData()
    {
        // Assigning values to $this->dispatchData
    }


    /**
     * Update batch file of the dispatch period with this consignment
     */
    public function updateDispatchBatchFile()
    {

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
     * Send/Transfer consignments batch file to the courier
     */
    public function transferBatchData()
    {
        $this->connectCourier();
        // Send the dataset
    }

}
