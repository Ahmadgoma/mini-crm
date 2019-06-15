<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'company_id','email', 'phone'
    ];

    /**
     * Get the company that owns the employee.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
