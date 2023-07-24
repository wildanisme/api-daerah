<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;
    protected $table = 'villages';
    protected $guarded = [];

    public function district()
    {
        return $this->hasOne(District::class);
    }
}
