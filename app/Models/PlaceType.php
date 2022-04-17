<?php

namespace App\Models;

use Dotenv\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class PlaceType extends Model
{

    protected $primaryKey = 'place_type_id';
    protected $table = 'places_types';
    protected $guarded = ['place_type_id'];
    protected $fillable = [
        'place_type_name', 'place_type_img'
    ];




    protected $hidden = [
    ];


    protected static function validation($place_id = null){



        if($place_id != NULL){
            $rule = Rule::unique('places_types', 'place_type_name')->ignore($place_id, 'place_type_id');
        }
        else{
            $rule = Rule::unique('places_types', 'place_type_name');
        }

        return [
            'data.place_type_name'     => ['required', 'string', 'max:100', $rule],
            'data.place_type_img.url'  => ['image', 'mimes:jpg,jpeg,png'],
        ];
    }


    /*************** Aida func ************/
    public static function places($place_type_id)
    {
        /*************** return all places ****************/
        $places = DB::table('places')
            ->select('places.place_id', 'places.place_name')
            ->join('places_types', 'places.place_id', '=', 'places_types.place_type_id')
            ->where('places_types.place_type_id' , '=', $place_type_id)
            ->get();

        return $places;
    }


}
