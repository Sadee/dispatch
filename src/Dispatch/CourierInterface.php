<?php


namespace Dispatch;


interface CourierInterface
{
    function setServiceType();
    function getNearestDepot($postcode);
    function setServiceCodes($delivery_dateTime);
    function setDispatchData($order);
    function updateDispatchBatchFile();
    function transferBatchData();
    function sendDispatchEmail();
}