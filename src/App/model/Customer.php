<?php


namespace App;


/**
 * Class Customer
 * @package App
 */
class Customer
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';

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
        'user_id' => '0', 'name' => '', 'address1' => '', 'address2' => '', 'town' => '', 'postcode' => '', 'county' => '',
        'home_phone'=>'', 'mobile_phone'=>'', 'email' => '',
        'billing_address1' => '', 'billing_address2' => '', 'billing_town' => '', 'billing_postcode' => '', 'billing_county' => '',
        'status'=>'1'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'address1', 'address2', 'town', 'postcode', 'county', 'home_phone', 'mobile_phone', 'email', 'status'
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

}