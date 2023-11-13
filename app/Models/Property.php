<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'department_id',
        'name',
        'description',
        'tag_no',
        'date_acquired',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
