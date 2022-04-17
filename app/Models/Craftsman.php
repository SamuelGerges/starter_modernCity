<?php

namespace App\Models;
{
    protected $primaryKey = 'craftsman_id';
    protected $table = 'craftsmen';
    protected $guarded = ['craftsman_id', 'craftsman_type_id', 'city_id'];
    protected $fillable = [
        'first_name', 'last_name', 'email', 'gender', 'password', 'address', 'phone', 'work_state','craftsman_type_id',
        'city_id', 'description', 'craftsman_img',
    ];


    protected $hidden = [
        'password',
    ];


    public function show_craftsman_city($city_id)
    {
        $city = DB::table('cities')
            ->where('city_id', $city_id)
            ->value('city_name');
        return $city;
    }


    public function show_craftsman_type($craft_type_id)
    {

        $group = DB::table('craftsmen_types')
            ->where('craftsman_type_id', $craft_type_id)
            ->value('craftsman_type_name');
        return $group;
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
        ];


    }



