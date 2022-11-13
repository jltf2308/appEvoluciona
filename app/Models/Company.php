<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'business_name',
        'register_number',
    ];

    public function person()
    {
        return $this->hasMany(Person::class);
    }

    public function professionals(){
        return $this->belongsToMany(Person::class);
    }
}
