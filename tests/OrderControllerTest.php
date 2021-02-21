<?php

namespace App;

use PHPUnit\Framework\TestCase;

/**
 * Class OrderControllerTest
 * @package App
 */
class OrderControllerTest extends TestCase
{
    /**
     * Test OrderController orderDispatch method
     * @throws \Exception
     */
    public function testOrderDispatch()
    {
        $orderDependency = \Mockery::mock(Order::class);

        $orderController = new OrderController();

        $response = $orderController->orderDispatch($orderDependency);

        // Assert
        $this->assertEquals(200, $response->getStatusCode());

    }

}
