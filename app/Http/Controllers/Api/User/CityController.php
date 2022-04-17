<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use GeneralTrait;

    public function StoreCity(Request $request)
    {
        $data = $request->validate([
            'city_name' => 'required|string|max:60'
        ]);
        City::create($data);
        return $this->returnSuccessMessage(200,'City Saved Successfully');
    }
}
