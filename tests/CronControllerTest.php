<?php

namespace App;

use PHPUnit\Framework\TestCase;

/**
 * Class CronControllerTest
 * @package App
 */
class CronControllerTest extends TestCase
{

    /**
     * Test CronController StartDispatchPeriod method
     */
    public function testStartDispatchPeriod()
    {
        $cronController = new CronController();
        $cronController->startDispatchPeriod();
        $today = (new \DateTime())->setTime(0,0);
        $file_name = self::$batchFilesDirectory.'consignments_'.$today->getTimestamp().'.csv';
        $this->assertExists($_SERVER['DOCUMENT_ROOT'].'/couriers/dx/'.$file_name);

    }

    /**
     * Test CronController EndDispatchPeriod method
     */
    public function testEndDispatchPeriod()
    {
        $cronController = new CronController();

        $cronController->endDispatchPeriod();

    }
}
