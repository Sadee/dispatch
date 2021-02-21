<?php


namespace App;


/**
 * Class OrderController
 * All the order related functions should be here
 * @package App
 */
class OrderController
{

    /**
     * This is to call on Order placed. Add new consignments to the dispatch batch file
     * @param Order $order
     * @throws \Exception
     */
    public function orderDispatch(Order $order)
    {
        try {

            $dispatch = new Dispatch();
            if($dispatch->addConsignment($order)) {
                // Return or display relevant success page
                return view('success');
            } else {
                return view('error');
            }

        } catch(\Exception $e){
            // Generate email to the office to alert what went wrong while running automated task
            Notification::sendNotification("Error in order dispatch", 'Order: '.$order->id.' Error: '.$e->getMessage()
                .' File:'.$e->getFile().' Line:'.$e->getLine());
            throw new \Exception('Order: '.$order->id.' Error: '.$e->getMessage() .' File:'.$e->getFile().' Line:'.$e->getLine());
        }
    }

}