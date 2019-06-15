<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name' , 'email','logo','website'
    ];

    /**
     * Get the employees for the company.
     */
    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }
}
