<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'category_id', 'supplier_id', 'created_by'
    ];
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',  
        'updated_at' => 'datetime:Y-m-d H:i:s', 
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public static function getItems()
    {
        return self::query()
                ->with(['category:id,name', 'supplier:id,name', 'createdBy:id,username'])
                ->get()
                ->makeHidden(['category_id', 'supplier_id', 'created_by']);
    }

    public static function getGeneralStock()
    {
        return self::selectRaw('SUM(quantity) as total_stock, SUM(price * quantity) as total_stock_value, AVG(price) as average_price')
        ->first();
    }

    public static function getStockLimit()
    {
        return self::select('id', 'name', 'quantity', 'price', 'created_at', 'updated_at')
        ->where('quantity', '<', 200)
        ->get();
    }

    public static function getItemsByCategory($id)
    {
        return self::query()
                ->with(['category:id,name', 'supplier:id,name', 'createdBy:id,username'])
                ->where('category_id', $id)
                ->get()
                ->makeHidden(['category_id', 'supplier_id', 'created_by']);
    }

    public static function getItemsByCategorySummary()
    {
        return self::selectRaw('category_id, categories.name, SUM(quantity) as total_stock, SUM(price * quantity) as total_stock_value, AVG(price) as average_price')
        ->join('categories', 'categories.id', '=', 'items.category_id')
                   ->groupBy('category_id')
                   ->get();
    }
    public static function getItemsBySupplierSummary()
    {
        return self::selectRaw('supplier_id, suppliers.name, SUM(quantity)as total_stock, SUM(price * quantity) as total_stock_value')
        ->join('suppliers', 'suppliers.id', '=', 'items.supplier_id')
        ->groupBy('supplier_id')
        ->get();
    }

    public static function getAllSummary()
    {
        return self::selectRaw('
            SUM(quantity) as total_stock, 
            SUM(price * quantity) as total_stock_value, 
            (SELECT COUNT(*) FROM categories) as total_categories,
            (SELECT COUNT(*) FROM suppliers) as total_suppliers')
        ->first();
    }


}
