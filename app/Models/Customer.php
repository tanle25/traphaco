<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use LogsActivity;
    protected $table = "customers";

    protected $fillable = ['DMS_code', 'CRM_code', 'contract_code', 'fullname', 'address', 'phone', 'zone', 'sale_chanel', 'pharmacy_name'];

    public $timestamps = true;

    protected static $logAttributes = ['DMS_code', 'CRM_code', 'contract_code', 'fullname', 'address', 'phone', 'zone', 'sale_chanel', 'pharmacy_name'];

    protected static $logOnlyDirty = true;

    public function list_tests()
    {
        return $this->hasMany('App\Models\CustomerTest', 'customer_id', 'id');
    }

}