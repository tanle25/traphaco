<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = ['DMS_code', 'CRM_code', 'contract_code', 'fullname', 'address', 'phone', 'zone', 'sale_chanel', 'pharmacy_name'];

    public $timestamps = true;

    public function list_tests()
    {
        return $this->hasMany('App\Models\CustomerTest', 'customer_id', 'id');
    }

}