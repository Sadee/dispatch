<?php


namespace App;

use App\Consignment;
use App\Notification;
use Mail\MailTrigger;
use mysql_xdevapi\Collection;

/**
 * Class App
 * @package App
 */
class Dispatch
{
    /**
     * @var string
     */
    private static $dispatchPeriodStart = '08:00:00';

    /**
     * @var string
     */
    private static $dispatchPeriodEnd = '18:00:00';

    /**
     * @var Collection
     */
    private $awaiting_orders;

    /**
     * @return Collection
     */
    public function getAwaitingOrders(): Collection
    {
        return $this->awaiting_orders;
    }

    /**
     * @param Collection $awaiting_orders
     */
    public function setAwaitingOrders(Collection $awaiting_orders)
    {
        $this->awaiting_orders = $awaiting_orders;
    }

    /**
     * This will be calling from automated task (cron)
     * Every day when the dispatch period starting
     */
    public function startDispatchPeriod()
    {
        try {
            $this->setAwaitingOrders($this->collectAwaitingOrders());
            $this->createConsignmentsForAwaiting();
        } catch(\Exception $e){
            // Generate email to the office to alert what went wrong while running automated task
            Notification::sendNotification("App period not started!", 'Error: '.$e->getMessage()
                .' File:'.$e->getFile().' Line:'.$e->getLine());
        }
    }

    /**
     * Collecting the orders that placed once after end of last dispatch period
     */
    private function collectAwaitingOrders()
    {
        // Assign value to $this->awaiting_orders;
        $orders = new Orders();
        return $orders->waitingForDispatch(self::$dispatchPeriodStart);
    }

    /**
     * Create consignments for collected order items from collectAwaitingOrders()
     */
    private function createConsignmentsForAwaiting()
    {
        foreach($this->getAwaitingOrders() as $order){
            $this->addConsignment($order);
        }
    }

    /**
     * This is calling on dispatch period ending
     * This will be calling from automated task (cron)
     */
    public function endDispatchPeriod()
    {
        try {
            $couriers = $this->getAllCouriers();
            foreach($couriers as $courier){
                $courier->sendDispatchData();
            }
            $this->updateDispatchDetails();
        } catch(\Exception $e){
            // Generate email to the office to alert what went wrong while running automated task
            Notification::sendNotification("Error in dispatch period ending", 'Error: '.$e->getMessage()
                .' File:'.$e->getFile().' Line:'.$e->getLine());
        }
    }

    /**
     * Returns all available couriers
     * @return Collection
     */
    private function getAllCouriers(): Collection
    {
        $couriers = null;
        // Collect all couriers from database
        return $couriers;
    }

    /**
     * Update the database as transferred batch file consignments
     */
    private function updateDispatchDetails()
    {
        // Update database as set order's status as dispatched
    }

    /**
     * Update couriers dispatch batch file/Dataset wile placing an Order each time within dispatch period
     * @param Order $order
     * @return bool
     * @throws \Exception
     */
    public function addConsignment(Order $order)
    {
        $consignment = new Consignment();
        return $consignment->createConsignment($order);
    }

}