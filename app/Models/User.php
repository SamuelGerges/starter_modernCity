<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'user_id';
    protected $table = 'users';
    protected $guarded = ['user_id', 'user_group_id', 'city_id'];
    protected $fillable = [
        'first_name', 'last_name', 'password', 'phone', 'address','user_group_id', 'city_id','email', 'gender', 'user_img'
    ];


    protected $hidden = [
        'password',
    ];


    public function show_user_city($city_id)
    {

        $city = DB::table('cities')
            ->where('city_id', $city_id)
            ->value('city_name');
        return $city;
    }


    public function show_user_group($group_id)
    {

        $group = DB::table('users_groups')
            ->where('user_group_id', $group_id)
            ->value('user_group_name');
        return $group;
    }



    public function show_user_type($email)
    {

        $type = DB::table('users')
            ->select(['users.user_group_id', 'users_groups.user_group_name'])
            ->join('users_groups', 'users.user_group_id', '=', 'users_groups.user_group_id')
            ->where('users.email', '=',  $email )
            ->first();

        return $type;
    }

    protected static function validation($user_id = null, $edit_password_rule = []){


        if($user_id != NULL){
            /**************  edit validation  ***************/
            $email_rule = Rule::unique('users', 'email')->ignore($user_id, 'user_id');
            $phone_rule = Rule::unique('users', 'phone')->ignore($user_id, 'user_id');

            $password_rule = $edit_password_rule;
            $confirm_password_rule = ['string'];
        }
        else{
            /************** create validation  ***************/
            $email_rule = Rule::unique('users', 'email');
            $phone_rule = Rule::unique('users', 'phone');
            $password_rule = ['required', 'min:6', 'string'];
            $confirm_password_rule = ['required', 'same:data.password'];

        }

        return[
           'data.first_name'      => ['required', 'string', 'max:30'],
           'data.last_name'       => ['required', 'string', 'max:30'],
           'data.user_group_id'   => ['required', 'exists:users_groups,user_group_id'],
           'data.gender'          => ['required', 'in:male,female'],
           'data.email'           => ['required', 'string', 'email', 'max:100', $email_rule],
           'data.phone'           => ['required', 'min:11', 'numeric', $phone_rule],
           'data.city_id'         => ['required', 'exists:cities,city_id'],
           'data.address'         => ['required', 'string', 'max:150'],
           'data.user_img.url'    => ['image', 'mimes:jpg,jpeg,png'],
           'data.user_img.alt'    => ['string'],
           'data.password'        =>  $password_rule,
           'data.confirm_password'=> $confirm_password_rule,
        ];


    }


}

