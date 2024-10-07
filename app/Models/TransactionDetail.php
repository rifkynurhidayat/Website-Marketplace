<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        'transactions_id',
        'products_id',
        'price',
        'shipping_status',
        'resi',
        'code',
        'qty_buy',
    ];

    protected $hidden =[

    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }


}
