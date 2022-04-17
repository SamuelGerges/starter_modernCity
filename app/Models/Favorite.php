<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    protected $table = 'favorite_places_lists';
    protected $primaryKey = 'fav_list_id';
    protected $guarded = ['fav_list_id'];

    public $timestamps = false;







}
