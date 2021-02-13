<?php


namespace Dispatch;


class Dx extends Courier implements CourierInterface
{
    /**
     * The batch file path
     *
     * @var string
     */
    private static $batchFile;

    /**
     * Connection url/endpoint to transfer batch file
     * @var string
     */
    private static $connectionUrl;

    /**
     * Username to create connection to send batch file
     * @var string
     */
    private static $connectionUsername;

    /**
     * Password to create connection to send batch file
     * @var string
     */
    private static $connectionPassword;

    /**
     * Connection to the Courier
     * @var
     */
    private $connection;

    /**
     * Get the nearest depot of the courier to set delivery
     * Nearest depot identifying algorithm is vary for the courier
     *
     * @param string $postcode
     */
    public function getNearestDepot(string $postcode)
    {

    }

    /**
     * Set the service type such as: Delivery to depot, Collection from warehouse, ..
     */
    public function setServiceType()
    {

    }

    /**
     * Set the service code (Ex: next day delivery, normal delivery, Saturday delivery) according to the delivery date
     * @param string $delivery_dateTime
     */
    public function setServiceCodes(string $delivery_dateTime)
    {

    }

    /**
     * Pass the dispatch details to the data set/batch file
     * @param $order
     */
    public function setDispatchData($order)
    {

    }

    /**
     * Update dispatch batch file with this consignment details
     *
     */
    public function updateDispatchBatchFile()
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
     * Transfer consignment batch file/Data set at the end of the dispatch period
     * This can be: Call an API function, Transfer batch file via FTP, Send email with a batch file, ..
     */
    public function transferBatchData()
    {
        // Use $this->connection and
    }

    /**
     * Send dispatch email
     */
    public function sendDispatchEmail()
    {

    }
}