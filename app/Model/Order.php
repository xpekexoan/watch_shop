<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const CONFIRMING = 1;
    public const DELIVERING = 2;
    public const DELIVERED = 3;
    public const CANCELED = 4;

    protected $fillable = [
        'id_cus', 'id_saler', 'id_shipper', 'name', 'tel', 'id_district', 'address',
        'order_at', 'confirm_at', 'receive_at', 'cancel_at', 'status',
        'total_money', 'ship_money'
    ];

    protected $table = 'order';

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function saler()
    {
        return $this->belongsTo(User::class, 'id_saler');
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'id_shipper');
    }
    
    public function district()
    {
        return $this->belongsTo(District::class, 'id_district', 'id');
    }

    public function fullAddress()
    {
        return $this->address . ", " . $this->district->name . ", " . $this->district->province->name;
    }

    public function detail()
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id');
    }

    public function getTotalMoney()
    {
        return $this->total_money + $this->ship_money;
    }

    public function displayStatus()
    {
        switch ($this->status) {
            case self::CONFIRMING:
                return 'Đang chờ xử lý';
            case self::DELIVERING:
                return 'Đang giao hàng';
            case self::DELIVERED:
                return 'Đã nhận hàng';
            case self::CANCELED:
                return 'Đã hủy';
        }
    }
}
