<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    use GeneralTrait;

    /**
     * @throws \Illuminate\Validation\ValidationException
     */


    public function RegisterUser(Request $request )
    {
        // req = null => cities  || req == val =>validation
        if ((is_null($request))){
            $data['cities'] = City::select('city_id', 'city_name')->get();
            return response()->json($data['cities']);
        }
        else
        {
        $validator = Validator::make($request->all(),[
            'city_id'      => 'required|exists:cities,city_id',
            'first_name'   => 'required|string|max:30',
            'last_name'    => 'required|string|max:30',
            'email'        => 'required|email|unique:users',
            'gender'       => 'required|string|max:30',
            'password'     => 'required|min:4|max:40',
            'address'      => 'required|string|max:30',
            'phone'        => 'required|unique:users|max:11',
            'user_img'     => 'nullable|image|mimes:jpg,jpeg,png',
            'token'        => 'nullable|unique:users',
            'created_at'   => 'nullable',
            'updated_at'   => 'nullable',
        ]);

        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = new User(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password) ,
                'user_group_id' => 1,
                'token'    =>Str::random(20).now().Str::random(21) ,
                'created_at'   => now(),
                'updated_at'  => now(),

                ])
        );
        $user->save();
        return $this->returnSuccessMessage('200','User successfully registered');
        }


    }

    public function LoginUser(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required"

        ]);
        if ($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
//            login
        $credentials = $request->only(['email', 'password']);
        User::where('email',$request->email)->update(['token' => Str::random(20).now().Str::random(21)]);
        $user_token = auth()->guard('api_user')->attempt($credentials);
        if (!$user_token){
            return $this->returnError('E001', 'The Data is not Correct');
        }
        $user = Auth::guard('api_user')->user();

//        //return token
        return $this->returnData('User', $user,'This Data is selected');
    }

    public function getToken(Request $request)
    {
        $token = $request->token;

    }
}
