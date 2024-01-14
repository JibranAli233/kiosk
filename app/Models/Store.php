<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
       'name',
       'branch_id',
       'active',
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
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
