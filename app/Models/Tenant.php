<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'tenant_id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'tenant_id');
    }
}
