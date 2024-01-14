<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
       'name',
       'purchase_price',
       'sell_price',
       'manufacturer_id',
       'category_id',
       'company_id',
       'branch_id',
       'active',
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function getActiveAttribute($value)
    {
        return ($value == 1) ? "Active" : "Inactive";
    }
}
