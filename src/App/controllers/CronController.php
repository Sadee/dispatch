<?php

namespace App;

use DateTime;
use App\Dispatch;
use App\Order;


/**
 * Class CronController
 * All the actions calling by cronjob tasks (automated tasks)
 * @package App
 */
class CronController
{

    /**
     * This is the function calling by the automated tasks in the server on starting the Dispatch period
     * cronjob: 8 * * * * /usr/bin/wget -qO- g4m.test/cron/startDispatchPeriod >> /home/g4m/www/cron/startDispatchPeriod.log
     *
     */
    public function startDispatchPeriod()
    {
        try {
            $dispatch = new Dispatch();
            $dispatch->startDispatchPeriod();
        } catch(\Exception $e){
            // Generate email to the office to alert what went wrong while running automated task
            Notification::sendNotification("Error in starting dispatch period", 'Error: '.$e->getMessage()
                .' File:'.$e->getFile().' Line:'.$e->getLine());
        }
    }


    /**
     * This is the function calling by the automated tasks in the server on ending the Dispatch period
     * cronjob: 20 * * * * /usr/bin/wget -qO- g4m.test/cron/endDispatchPeriod >> /home/g4m/www/cron/endDispatchPeriod.log
     */
    public function endDispatchPeriod()
    {
        try {
            $dispatch = new Dispatch();
            $dispatch->stopDispatchPeriod();
        } catch(\Exception $e){
            // Generate email to the office to alert what went wrong while running automated task
            Notification::sendNotification("Error in dispatch period ending", 'Error: '.$e->getMessage()
                .' File:'.$e->getFile().' Line:'.$e->getLine());
        }
    }
}