<?php


namespace App;


class Product
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

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
        'name' => '', 'sku_code' => '', 'description' => '', 'features' => '', 'parts'=>'1', 'width' => '0.00', 'height' => '0.00',
        'depth' => '0.00', 'weight' => '0.00', 'delivery_instruction'=>"",
        'need_unpack' => 0, 'need_packaging_disposal' => 0, 'need_assemble' => 0,
        'status'=>'1'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sku_code', 'parts', 'width', 'height', 'depth', 'weight', 'delivery_instruction', 'status'
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