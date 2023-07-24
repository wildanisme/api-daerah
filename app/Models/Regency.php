<?php

namespace App\Models;

use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Regency extends Model
{
    use HasFactory;
    protected $table = 'regencies';
    protected $guarded = [];

    public function province()
    {
        return $this->hasOne(Province::class);
    }

    public function district()
    {
        return $this->hasMany(District::class, 'regency_id');
    }
}
