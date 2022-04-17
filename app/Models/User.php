<?php

namespace App\Models;


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
        ];


    }
in
