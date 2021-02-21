<?php


namespace App;


/**
 * Class Delivery
 * @package App
 */
class Delivery
{
    /**
     * Delivery type constant values next day, saturday delivery, delivery within 2 days & normal delivery (3+ days)
     * This will be set by the customer while placing the order & value will be saved in the delivery.delivery_type
     */
    const TYPE_NEXTDAY = 1;
    const TYPE_IN2DAYS = 2;
    const TYPE_SATDAY = 3;
    const TYPE_NORMAL = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'delivery';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'order_id' => '0', 'customer_id' => '0', 'courier_id' => '0', 'reference'=>"", 'name' => '', 'address1' => '', 'address2' => '',
        'town' => '', 'postcode' => '', 'county' => '', 'home_phone'=>'', 'mobile_phone'=>'', 'delivery_date'=>'', 'delivery_type'=>'',
        'delivery_instruction'=>'', 'charge'=>"0.00", 'need_disassemble' => 0, 'collect_disposal'=> 0, 'status'=>'1'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'customer_id', 'reference', 'name', 'address1', 'address2', 'town', 'postcode', 'county', 'mobile_phone',
        'delivery_instruction', 'charge', 'need_disassemble', 'collect_disposal', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * @var string[]
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the order
     */
    public function order()
    {
        return $this->belongsTo('App\Orders', 'order_id', 'id');
    }

    /**
     * Get the customer
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * Get the Courier
     */
    public function courier()
    {
        return $this->belongsTo('App\Couriers', 'courier_id', 'id');
    }
}