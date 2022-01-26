<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashOnDelivery extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'online_status', 'type', 'rider_id', 'delivery_id', 'staff_id', 'verified'];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }

}
