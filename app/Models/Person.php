<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'register_number',
        'email',
        'position',
        'type',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function clients(){
        return $this->belongsToMany(Company::class);
    }
}
