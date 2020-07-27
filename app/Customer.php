<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //db fields allowed for mass assignment
    //protected $fillable = ['name', 'email', 'active'];

    //nothing is guarded mentioned fields will be restricted to insertin database
    protected $guarded = [];
    protected $attributes = [
        'active' => 1
    ];
    //attribute method for status of customer
    public function getActiveAttribute($attribute)
    {
        return $this->activeOptions()[$attribute];
    }
    //scope declared
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeInactive($query)
    {
        return $query = Customer::where('active', 0);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function activeOptions()
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
            2 => 'In-Progress'
        ];
    }
}
