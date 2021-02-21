<?php


namespace App;

use App\Order;
use App\OrderItem;
use App\Product;
use App\ProductVariant;
use App\Dx;
use App\Notification;

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
     * @var Courier|null
     */
    private $courier = null;

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
        return $this->order->delivery();
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
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
     * Making consignment for given Order
     * @param Order $order
     * @return bool
     */
    public function createConsignment(Order $order)
    {
        $this->setOrder($order);
        $this->prepareConsignment();
        if($this->updateCourierBatchFile()) {
            $this->save();
            return true;
        } else {
            // Generate email to the office to alert batch file did not update
            Notification::sendNotification("Dispatch batch file did not update!", 'Dispatch batch file did not update!');
            return false;
        }
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
        foreach($this->getOrder()->orderItems as $item){
            $this->items[] = $this->getItemDetails($item);
        }
    }

    /**
     * Get each item's data from order
     * @param OrderItems $item
     * @return array
     */
    private function getItemDetails(OrderItems $item)
    {
        return [
            'code' => $item->product->sku_code,
            'quantity' => $item->quantity,
            'weight' => $item->product->weight,
            'width' => $item->product->width,
            'height' => $item->product->height,
            'depth' => $item->product->depth,
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
        $total_parcels = ($k+1);
    }

    /**
     * Set the courier for the consignment
     * This can be vary by the consignment details such as, total number of parcels, total weight, previous dispatches
     * already assigned to the couriers within this current dispatch period.
     */
    private function setCourier()
    {
        // In here I have assigned Dx;
        // TODO the logic of assigning a particular courier from a list is goes here
        $this->courier = new Dx();
    }

    /**
     * This save consignment data in the database
     */
    private function save()
    {
        // Update database if required
        // Send notification to the staff if required
    }

    /**
     * Update relevant courier's dispatch period batch file
     */
    private function updateCourierBatchFile()
    {
        return $this->courier->prepareConsignment($this)->updateDispatchBatchFile();
    }

}