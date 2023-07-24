<?php

namespace App\Http\Controllers\Api;

use App\Models\Regency;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\MainResource;

class MainController extends Controller
{
    public function indexProvince()
    {
        $provinces  = Province::all();

        return new MainResource(true, "List Data Provinsi", $provinces);
    }
    
    public function getDetailProvince($id)
    {
        $province   = Province::find($id);
        $province   = Province::with(['regency'])->where('id', $id)->get();

        return new MainResource(true, "Detail Data Provinsi", $province);
    }
    
    public function indexRegency()
    {
        $regencies  = Regency::paginate(50);
        
        // dd($regencies);
        return new MainResource(true, "List Data Kabupaten Kota", $regencies);
    }

    public function getDetailRegency($id)
    {
        $regency    = Regency::find($id);
        $regency    = Regency::with(['district'])->where('id', $id)->get();

        // dd($regency);
        return new MainResource(true, "Detail Kabupaten/Kota", $regency);
    }

    public function indexDistrict()
    {
        $district   = District::paginate(50);
        
        return new MainResource(true, "List Data Kecamatan", $district);
    }
    
    public function getDetailDistrict($id) 
    {
        $district   = District::find($id);
        $district   = District::with(['village'])->where('id', $id)->get();
        // dd($district);    
        return new MainResource(true, "Detail Data Kecamatan", $district);
    }

    public function getParentChild($id)
    {
        $provinceId = Province::find($id);
        // $province = Province::with('regency.district.village')->find($provinceId);

        $province = DB::table('provinces as p')
            ->select('p.*', 'r.*', 'd.*', 'v.*')
            ->join('regencies as r', 'r.province_id', '=', 'p.id')
            ->join('districts as d', 'd.regency_id', '=', 'r.id')
            ->join('villages as v', 'v.district_id', '=', 'd.id')
            ->where('p.id', '=', $provinceId)
            // ->orWhere('r.province_id', '=', $provinceId)
            // ->orWhere('d.regency_id', '=', 'r.id')
            ->get();

        dd($province);

        return new MainResource(true, "Detail", $province);
    }
}
