<?php


namespace Dispatch;

use \Dispatch\Consignment;
use mysql_xdevapi\Collection;

/**
 * Class Dispatch
 * @package Dispatch
 */
class Dispatch
{
    /**
     * @var Collection
     */
    private $awaiting_orders;

    /**
     * This will be calling from automated task (cron)
     * Every day when the dispatch period starting
     */
    public function startDispatchPeriod()
    {
        try {
            $this->collectAwaitingOrders();
            $this->createConsignmentsForAwaiting();
        } catch(\Exception $e){
            // Generate email to the office to alert what went wrong while running automated task
        }
    }

    /**
     * Collecting the orders that placed once after end of last dispatch period
     */
    private function collectAwaitingOrders()
    {
        // Assign value to $this->awaiting_orders;
    }

    /**
     * Create consignments for collected order items from collectAwaitingOrders()
     */
    private function createConsignmentsForAwaiting()
    {
        $consignment = new Consignment();
        foreach($this->awaiting_orders as $order){
            $consignment->createConsignment($order);
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
                $courier->transferBatchData();
            }
            $this->updateDispatchDetails();
        } catch(\Exception $e){
            // Generate email to the office to alert what went wrong while running automated task
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

    }

    /**
     * Update couriers dispatch batch file/Dataset wile placing an Order each time within dispatch period
     * @param Order $order
     * @throws \Exception
     */
    public function addConsignment(Order $order)
    {
        try {
            $consignment = new Consignment();
            $consignment->createConsignment($order);
        } catch(\Exception $e){
            // Generate email to the office to alert
            throw new \Exception("Error: ".$e->getMessage());
        }
    }
}