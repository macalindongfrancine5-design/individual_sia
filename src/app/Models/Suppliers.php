<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'contact_info', 'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',  
        'updated_at' => 'datetime:Y-m-d H:i:s', 
    ];

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(Items::class, 'supplier_id');
    }
}
