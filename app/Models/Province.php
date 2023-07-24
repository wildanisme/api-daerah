<?php

namespace App\Models;

use App\Models\Regency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $guarded = [];

    public function regency()
    {
        return $this->hasMany(Regency::class, 'province_id');
    }
}
