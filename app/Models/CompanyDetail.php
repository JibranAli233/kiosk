<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CompanyDetail extends Model
{
    use SoftDeletes;

    public $table = 'company_details';

    protected $fillable = [
        'company_id',
        'year_start_date',
        'year_end_date'
    ];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    // public function getYearStartDateAttribute($value)
    // {
    //     if($value){
    //         return Carbon::parse($value)->format('m-d-Y');
    //     }
    // }

    // public function getYearEndDateAttribute($value)
    // {
    //     if($value){
    //         return Carbon::parse($value)->format('m-d-Y');
    //     }
    // }
}
