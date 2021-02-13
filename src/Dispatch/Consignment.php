<?php


namespace Dispatch;

use Order;
use OrderItem;
use Product;
use ProductVariant;
use Dispatch\Dx;

class Consignment
{
    /**
     * Order data
     * @var Order
     */
    private $order;

    /**
     * Items of consignment
     * @var
     */
    private $items;

    /**
     * Total weight of consignment
     * @var float
     */
    private $total_weight;

    /**
     * Totals number of parcels in a consignment
     * @var int
     */
    private $total_parcels;

    /**
     * @var Courier|null
     */
    private $courier = null;

    /**
     * Making consignment for given Order
     * @param Order $order
     */
    public function createConsignment(Order $order)
    {
        $this->setOrder($order);
        $this->prepareConsignment();
        $this->updateCourierBatchFile();
        $this->save();
    }

    /**
     * Set order
     * @param Order $order
     */
    private function setOrder(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the items from the Order
     * and set the Item details such as weight, quantity, metric volume (if needed)
     * For the consignment, and assign the courier
     */
    private function prepareConsignment()
    {
        $this->extractItemDetailsOfOrder();
        $this->setTotals();
        $this->setCourier();
    }

    /**
     * Extract the Order items and get the Item details that need to set delivery
     */
    private function extractItemDetailsOfOrder()
    {
        foreach($this->order->items as $item){
            $this->items[] = $this->getItemDetails($item);
        }
    }

    /**
     * Get each item's data from order
     * @param OrderItem $item
     * @return array
     */
    private function getItemDetails(OrderItem $item)
    {
        return [
            'code' => $item->getCode(),
            'quantity' => $item->getQuantity(),
            'weight' => $item->getWeight(),
            'width' => $item->getWidth(),
            'height' => $item->getHeight(),
            'depth' => $item->getDepth(),
            ];
    }

    /**
     * Set total values of items
     */
    private function setTotals()
    {
        $k = 0;
        foreach($this->items as $k=>$i){
            $this->total_weight += $i['weight'];
        }
        $this->total_parcels = ($k+1);
    }

    /**
     * Set the courier for the consignment
     * This can be vary by the consignment details such as, total number of parcels, total weight, previous dispatches
     * already assigned to the couriers within this current dispatch period.
     */
    private function setCourier()
    {
        // In here I have assigned Dx;
        $this->courier = new Dx();
    }

    /**
     * This save consignment data in the database
     */
    private function save()
    {

    }

    /**
     * Update relevant courier's dispatch period batch file
     */
    private function updateCourierBatchFile()
    {
        $this->courier->setConsignment($this);
    }

    /**
     * Get the consignment items details
     * Calling from Courier
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get delivery data
     * Calling from Courier
     * @return mixed
     */
    public function getDeliveryDetails()
    {
        return $this->order->getDeliveryDetails();
    }



}