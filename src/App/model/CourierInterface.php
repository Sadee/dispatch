<?php


namespace App;


/**
 * Interface CourierInterface
 * @package App
 */
interface CourierInterface
{
    /**
     * @return mixed
     */
    function getDispatchData();

    /**
     * @return mixed
     */
    static function getBatchFile();

    /**
     * @return mixed
     */
    function getTradingName();

    /**
     * @param Consignment $consignment
     * @return mixed
     */
    function setConsignment(Consignment $consignment);

    /**
     * @param array $consignmentItem
     * @return mixed
     */
    function setConsignmentItem(array $consignmentItem);

    /**
     * @return mixed
     */
    function getConsignments();

    /**
     * @param int $serviceType
     * @return mixed
     */
    function setServiceType(int $serviceType);

    /**
     * @return mixed
     */
    function setServiceCode();

    /**
     * @return mixed
     */
    function sendDispatchData();

    /**
     * @param Consignment $consignment
     * @return mixed
     */
    function prepareConsignment(Consignment $consignment);

    /**
     * @return mixed
     */
    function updateDispatchBatchFile();

    /**
     * @return mixed
     */
    function sendDispatchEmail();

    /**
     * @return mixed
     */
    function transferBatchData();
}