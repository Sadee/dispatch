<?php


namespace App;


/**
 * Class ConsignmentItem
 * @package App
 */
class ConsignmentItem
{

    /**
     * @var string
     */
    private $trading_name = '';
    /**
     * @var string
     */
    private $order_number = '';
    /**
     * @var string
     */
    private $recipient_reference = '';
    /**
     * @var string
     */
    private $recipient_name = '';
    /**
     * @var string
     */
    private $recipient_address1 = '';
    /**
     * @var string
     */
    private $recipient_address2 = '';
    /**
     * @var string
     */
    private $recipient_town = '';
    /**
     * @var string
     */
    private $recipient_postcode = '';
    /**
     * @var string
     */
    private $recipient_home_phone = '';
    /**
     * @var string
     */
    private $recipient_mobile_phone = '';
    /**
     * @var string
     */
    private $recipient_email = '';
    /**
     * @var int
     */
    private $quantity = 0;
    /**
     * @var string
     */
    private $code = '';
    /**
     * @var string
     */
    private $description = '';
    /**
     * @var int
     */
    private $parts = 0;
    /**
     * @var float
     */
    private $weight = 0.00;
    /**
     * @var string
     */
    private $delivery_charge = '';
    /**
     * @var string
     */
    private $delivery_instructions = '';
    /**
     * @var string
     */
    private $other_instructions = '';
    /**
     * @var string
     */
    private $service_type = '';
    /**
     * @var bool
     */
    private $unpack_items = false;
    /**
     * @var bool
     */
    private $packaging_disposal = false;
    /**
     * @var bool
     */
    private $assemble = false;
    /**
     * @var bool
     */
    private $disassemble = false;
    /**
     * @var bool
     */
    private $collect_disposal = false;
    /**
     * @var string
     */
    private $confirmed_delivery_date = '';

    /**
     * @return string
     */
    public function getTradingName(): string
    {
        return $this->trading_name;
    }

    /**
     * @param string $trading_name
     */
    public function setTradingName(string $trading_name)
    {
        $this->trading_name = $trading_name;
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->order_number;
    }

    /**
     * @param string $order_number
     */
    public function setOrderNumber(string $order_number)
    {
        $this->order_number = $order_number;
    }

    /**
     * @return string
     */
    public function getRecipientReference(): string
    {
        return $this->recipient_reference;
    }

    /**
     * @param string $recipient_reference
     */
    public function setRecipientReference(string $recipient_reference)
    {
        $this->recipient_reference = $recipient_reference;
    }

    /**
     * @return string
     */
    public function getRecipientName(): string
    {
        return $this->recipient_name;
    }

    /**
     * @param string $recipient_name
     */
    public function setRecipientName(string $recipient_name)
    {
        $this->recipient_name = $recipient_name;
    }

    /**
     * @return string
     */
    public function getRecipientAddress1(): string
    {
        return $this->recipient_address1;
    }

    /**
     * @param string $recipient_address1
     */
    public function setRecipientAddress1(string $recipient_address1)
    {
        $this->recipient_address1 = $recipient_address1;
    }

    /**
     * @return string
     */
    public function getRecipientAddress2(): string
    {
        return $this->recipient_address2;
    }

    /**
     * @param string $recipient_address2
     */
    public function setRecipientAddress2(string $recipient_address2)
    {
        $this->recipient_address2 = $recipient_address2;
    }

    /**
     * @return string
     */
    public function getRecipientTown(): string
    {
        return $this->recipient_town;
    }

    /**
     * @param string $recipient_town
     */
    public function setRecipientTown(string $recipient_town)
    {
        $this->recipient_town = $recipient_town;
    }

    /**
     * @return string
     */
    public function getRecipientPostcode(): string
    {
        return $this->recipient_postcode;
    }

    /**
     * @param string $recipient_postcode
     */
    public function setRecipientPostcode(string $recipient_postcode)
    {
        $this->recipient_postcode = $recipient_postcode;
    }

    /**
     * @return string
     */
    public function getRecipientHomePhone(): string
    {
        return $this->recipient_home_phone;
    }

    /**
     * @param string $recipient_home_phone
     */
    public function setRecipientHomePhone(string $recipient_home_phone)
    {
        $this->recipient_home_phone = $recipient_home_phone;
    }

    /**
     * @return string
     */
    public function getRecipientMobilePhone(): string
    {
        return $this->recipient_mobile_phone;
    }

    /**
     * @param string $recipient_mobile_phone
     */
    public function setRecipientMobilePhone(string $recipient_mobile_phone)
    {
        $this->recipient_mobile_phone = $recipient_mobile_phone;
    }

    /**
     * @return string
     */
    public function getRecipientEmail(): string
    {
        return $this->recipient_email;
    }

    /**
     * @param string $recipient_email
     */
    public function setRecipientEmail(string $recipient_email)
    {
        $this->recipient_email = $recipient_email;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getParts(): int
    {
        return $this->parts;
    }

    /**
     * @param int $parts
     */
    public function setParts(int $parts)
    {
        $this->parts = $parts;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight(float $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getDeliveryCharge(): string
    {
        return $this->delivery_charge;
    }

    /**
     * @param string $delivery_charge
     */
    public function setDeliveryCharge(string $delivery_charge)
    {
        $this->delivery_charge = $delivery_charge;
    }

    /**
     * @return string
     */
    public function getDeliveryInstructions(): string
    {
        return $this->delivery_instructions;
    }

    /**
     * @param string $delivery_instructions
     */
    public function setDeliveryInstructions(string $delivery_instructions)
    {
        $this->delivery_instructions = $delivery_instructions;
    }

    /**
     * @return string
     */
    public function getOtherInstructions(): string
    {
        return $this->delivery_instructions;
    }

    /**
     * @param string $other_instructions
     */
    public function setOtherInstructions(string $other_instructions)
    {
        $this->other_instructions = $other_instructions;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->service_type;
    }

    /**
     * @param string $service_type
     */
    public function setServiceType(string $service_type)
    {
        $this->service_type = $service_type;
    }

    /**
     * @return bool
     */
    public function isUnpackItems(): bool
    {
        return $this->unpack_items;
    }

    /**
     * @param bool $unpack_items
     */
    public function setUnpackItems(bool $unpack_items)
    {
        $this->unpack_items = $unpack_items;
    }

    /**
     * @return bool
     */
    public function isPackagingDisposal(): bool
    {
        return $this->packaging_disposal;
    }

    /**
     * @param bool $packaging_disposal
     */
    public function setPackagingDisposal(bool $packaging_disposal)
    {
        $this->packaging_disposal = $packaging_disposal;
    }

    /**
     * @return bool
     */
    public function isAssemble(): bool
    {
        return $this->assemble;
    }

    /**
     * @param bool $assemble
     */
    public function setAssemble(bool $assemble)
    {
        $this->assemble = $assemble;
    }

    /**
     * @return bool
     */
    public function isDisassemble(): bool
    {
        return $this->disassemble;
    }

    /**
     * @param bool $disassemble
     */
    public function setDisassemble(bool $disassemble)
    {
        $this->disassemble = $disassemble;
    }

    /**
     * @return bool
     */
    public function isCollectDisposal(): bool
    {
        return $this->collect_disposal;
    }

    /**
     * @param bool $collect_disposal
     */
    public function setCollectDisposal(bool $collect_disposal)
    {
        $this->collect_disposal = $collect_disposal;
    }

    /**
     * @return string
     */
    public function getConfirmedDeliveryDate(): string
    {
        return $this->confirmed_delivery_date;
    }

    /**
     * @param string $confirmed_delivery_date
     */
    public function setConfirmedDeliveryDate(string $confirmed_delivery_date)
    {
        $this->confirmed_delivery_date = $confirmed_delivery_date;
    }


}