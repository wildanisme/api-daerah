<?php

namespace App\Models;

use App\Models\Regency;
use App\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $guarded = [];

    public function regency()
    {
        return $this->hasOne(Regency::class);
    }

    public function village()
    {
        return $this->hasMany(Village::class, 'district_id');
    }
}
