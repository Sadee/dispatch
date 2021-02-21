<?php


namespace App;


class OrderItems
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orderItem';

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
        'order_id' => '0', 'product_id' => '0', 'quantity' => '0', 'description' => ''
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'description'
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
     * Get the order
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}