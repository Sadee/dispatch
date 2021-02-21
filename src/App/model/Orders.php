<?php


namespace App;


/**
 * Class Orders
 * @package App
 */
class Orders
{

    /**
     * Status of the an order. This can moved to the separate model OrderStatus
     */
    const ORDER_PLACED = 1;
    const ORDER_CONFIRMED = 2;
    const ORDER_DISPATCHED = 3;
    const ORDER_DELIVERED = 4;
    const ORDER_RETURN = 5;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
        'customer_id' => '0', 'transaction_id' => '0', 'amount' => '0.00', 'status_id' => '1',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'transaction_id', 'amount', 'status_id'
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
     * Get the customer data of the order
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * Get the payment transaction data of the order
     */
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    /**
     * Get all the items of the order
     */
    public function orderItems()
    {
        return $this->hasMany('App\OrderItems', 'order_id', 'id');
    }

    /**
     * Get the delivery details associated with the order.
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /**
     * Returns all orders that status changed as confirmed once after end of yesterday dispatched period
     * @param string $from
     * @return mixed
     */
    public function waitingForDispatch(string $from)
    {
        $dt = new DateTime();
        $dt->modify('-1 day');
        $dt = new DateTime($dt->format('Y-m-d').' '.$from);
        return $this->with('order_items')->where('status_id', '=', self::ORDER_CONFIRMED)->where('updated_at', '>=', $dt->getTimestamp())->get();
    }
}