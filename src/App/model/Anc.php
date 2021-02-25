<?php


namespace App;

use Mail\MailTrigger;
use mysql_xdevapi\Collection;
use \App\Consignment;
use \App\Delivery;

/**
 * Class Anc
 * @package App
 */
class Anc extends Courier implements CourierInterface
{
    /**
     * Define available collection types (collecting from warehouse, drop to depot, ..) to the courier
     */
    const SERVICE_TYPE_COLLECTING = 1;
    const SERVICE_TYPE_DROP = 2;

    /**
     * Define default courier delivery collection type
     * @var int
     */
    private static $default_service_type = self::SERVICE_TYPE_COLLECTING;

    /**
     * The batch files directory path
     *
     * @var string
     */
    private static $batchFilesDirectory = "/couriers/anc/";

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
     * @return int
     */
    public static function getDefaultServiceType(): int
    {
        return self::$default_service_type;
    }

    /**
     * @param int $default_service_type
     */
    public static function setDefaultServiceType(int $default_service_type)
    {
        self::$default_service_type = $default_service_type;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return string[]
     */
    public function getConsignmentItem(): array
    {
        return $this->consignmentItem;
    }

    /**
     * Update consignment items with consignmentItem arrays
     * @param ConsignmentItem $consignmentItem
     */
    public function setConsignments(ConsignmentItem $consignmentItem)
    {
        $this->consignments[] =
            [
                'Trading Name' => $consignmentItem->getTradingName(),
                'Order Number' => $consignmentItem->getOrderNumber(),
                'Recipient Reference' => $consignmentItem->getRecipientReference(),
                'Recipient Name' => $consignmentItem->getRecipientName(),
                'Address 1' => $consignmentItem->getRecipientAddress1(),
                'Address 2' => $consignmentItem->getRecipientAddress2(),
                'Town/City' => $consignmentItem->getRecipientTown(),
                'Postcode' => $consignmentItem->getRecipientPostcode(),
                'Home Number' => $consignmentItem->getRecipientHomePhone(),
                'Mobile Number' => $consignmentItem->getRecipientMobilePhone(),
                'Email Address' => $consignmentItem->getRecipientEmail(),
                'Code' => $consignmentItem->getCode(),
                'QTY' => $consignmentItem->getQuantity(),
                'Description' => $consignmentItem->getDescription(),
                'Parts' => $consignmentItem->getParts(),
                'Weight (KG)' => $consignmentItem->getWeight(),
                'Delivery Charge' => $consignmentItem->getDeliveryCharge(),
                'Delivery Instructions' => $consignmentItem->getDeliveryInstructions(),
                'Other Instructions' => $consignmentItem->getOtherInstructions(),
                'Service Type' => $consignmentItem->getServiceType(),
                'Unpack Items' => $consignmentItem->isUnpackItems(),
                'Packaging Disposal' => $consignmentItem->isPackagingDisposal(),
                'Assemble' => $consignmentItem->isAssemble(),
                'Dis-assemble' => $consignmentItem->isDisassemble(),
                'Collect Disposal' => $consignmentItem->isCollectDisposal(),
                'CONFIRMED DELIVERY DATE' => $consignmentItem->getConfirmedDeliveryDate()
            ];

    }

    /**
     * Get the batch file
     * @return string
     */
    public static function getBatchFile(): string
    {
        $today = (new \DateTime())->setTime(0,0);
        $file_name = self::$batchFilesDirectory.'consignments_'.$today->getTimestamp().'.csv';
        if(!file_exists($file_name)) {
            $pathToFile = $_SERVER['DOCUMENT_ROOT'].$file_name;
            $out = fopen($pathToFile, 'w');
            chmod($pathToFile, 0755);
            fclose($out);
            self::setBatchFile($pathToFile);
        }
        return self::$batchFile;
    }

    /**
     * @param string $batchFile
     */
    public static function setBatchFile(string $batchFile)
    {
        self::$batchFile = $batchFile;
    }

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
     * @param int $defaultServiceType
     */
    public function setServiceType(int $defaultServiceType)
    {
        switch($defaultServiceType){
            case self::SERVICE_TYPE_DROP:
                $this->serviceType = "DROP";
                break;
            case self::SERVICE_TYPE_COLLECTING:
            default:
                $this->serviceType = "COLLECTING";
                break;

        }
    }

    /**
     * Set the service code (Ex: next day delivery, normal delivery, Saturday delivery) according to the delivery date
     */
    public function setServiceCode()
    {
        $delivery_type = ($this->consignment->getOrder()->delivery()->delivery_type??Delivery::TYPE_NORMAL);
        switch($delivery_type){
            case Delivery::TYPE_NEXTDAY:
                $this->serviceType = "NEXT_DAY";
                break;
            case Delivery::TYPE_IN2DAYS:
                $this->serviceType = "WITHIN_2_DAYS";
                break;
            case Delivery::TYPE_SATDAY:
                $this->serviceType = "SATURDAY";
                break;
            case Delivery::TYPE_NORMAL:
            default:
                $this->serviceType = "NORMAL";
                break;

        }
    }

    /**
     * Connect the courier system
     * This can be API, FTP, Email, ..
     */
    private function connectCourier()
    {
        // Use endpoint url & credentials to create a connection and set it to $this->connection
        $this->connection = ftp_connect(self::$connectionUrl);

        // FTP login with username and password
        $login_result = ftp_login($this->connection, self::$connectionUsername, self::$connectionPassword);
    }

    /**
     * Disconnect the courier system
     */
    private function disconnectCourier()
    {
        // close the connection
        ftp_close($this->connection);
    }

    /**
     * Send dispatch email
     */
    public function sendDispatchEmail()
    {

    }

    /**
     * Extract the order details & products.
     * Set each products as a consignment
     * Update the batch file/Dataset of the dispatch period with the consignment data
     * Prepare the required data, such as: Item details, Delivery details
     * @param Consignment $consignment
     * @return $this
     */
    public function prepareConsignment(Consignment $consignment)
    {
        $deliveryDetails = $consignment->getDeliveryDetails();
        $this->setOriginDepot($deliveryDetails->postcode);
        $this->setServiceCode();
        $this->setServiceType(self::getDefaultServiceType());

        foreach($this->consignment->getOrder()->orderItems() as $item){
            $consignmentItem = new ConsignmentItem();
            $consignmentItem->setTradingName($this->getTradingName());
            $consignmentItem->setOrderNumber($this->order->id);
            $consignmentItem->setRecipientReference($this->order->delivery()->reference);
            $consignmentItem->setRecipientName($this->order->delivery()->name);
            $consignmentItem->setRecipientAddress1($this->order->delivery()->address1);
            $consignmentItem->setRecipientAddress2($this->order->delivery()->address2);
            $consignmentItem->setRecipientTown($this->order->delivery()->town);
            $consignmentItem->setRecipientPostcode($this->order->delivery()->postcode);
            $consignmentItem->setRecipientHomePhone($this->order->delivery()->home_phone);
            $consignmentItem->setRecipientMobilePhone($this->order->delivery()->mobile_phone);
            $consignmentItem->setRecipientEmail($this->order->customer()->email);
            $consignmentItem->setCode($this->getServiceCode());
            $consignmentItem->setQuantity($item->quantity);
            $consignmentItem->setDescription($item->description);
            $consignmentItem->setParts($item->product()->parts);
            $consignmentItem->setWeight($item->product()->weight);
            $consignmentItem->setDeliveryCharge($this->order->delivery()->charge);
            $consignmentItem->setDeliveryInstructions($item->product()->delivery_instruction);
            $consignmentItem->setOtherInstructions($this->order->delivery()->delivery_instruction);
            $consignmentItem->setServiceType($this->getServiceType());
            $consignmentItem->setUnpackItems($item->product()->need_unpack);
            $consignmentItem->setPackagingDisposal($item->product()->need_packaging_disposal);
            $consignmentItem->setAssemble($item->product()->need_assemble);
            $consignmentItem->setDisassemble($this->order->delivery()->need_disassemble);
            $consignmentItem->setCollectDisposal($this->order->delivery()->collect_disposal);
            $consignmentItem->setConfirmedDeliveryDate($this->order->delivery()->delivery_date);

            // Set as a set of consignments of this courier
            $this->setConsignments($consignmentItem);

        }
        return $this;
    }

    /**
     * Update dispatch batch file with this consignment details
     * @return bool|void
     */
    public function updateDispatchBatchFile()
    {
        // If the batch file exists for today
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
     * Transfer consignment batch file/Data set at the end of the dispatch period
     * This can be: Call an API function, Transfer batch file via FTP, Send email with a batch file, ..
     */
    public function sendDispatchData()
    {
        try {
            // if the batch file exists
            if($csvFile = self::getBatchFile()) {

                // Send file as FTP transfer
                $this->ftpTransfer($csvFile);

                return true;
            } else {
                return false;
            }
        } catch(\Exception $e){
            Notification::sendNotification("Unable to transfer file to the courier", 'Error: '.$e->getMessage()
                .' File:'.$e->getFile().' Line:'.$e->getLine());
        }
    }

    /**
     * Transfer batch file to the Courier via FTP connection
     * @param string $data_file
     */
    private function ftpTransfer(string $data_file)
    {
        $today = (new \DateTime());
        $remote_file = 'G4M_'.$today->format('Ymd').'.csv';

        // Create FTP connection
        $this->connectCourier();

        // upload a file by using FTP connection
        if (ftp_put($this->connection, $remote_file, $data_file, FTP_ASCII)) {
            echo "successfully uploaded $data_file\n";
        } else {
            echo "There was a problem while uploading $data_file\n";
        }

        // Disconnect FTP
        $this->disconnectCourier();
    }
}