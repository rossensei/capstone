<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'qty',
        'unit_id',
    ];

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class)
            ->withPivot('qty');
    }

    public function getTotalQuantity()
    {
        return $this->transactions->sum('pivot.qty');
    }
}
