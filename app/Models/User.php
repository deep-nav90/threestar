<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Str;
use Hash;
use Session;
use App\Models\UnderTakeUser;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'custom_user_id',
        'name',
        'dob',
        's_w_d',
        'swd_name',
        'nomination_name',
        'nomination_dob',
        'mobile_number',
        'country_code',
        'email',
        'adhar_number',
        'pan_number',
        'bank_account_number',
        'bank_name',
        'bank_ifsc_code',
        'bank_branch_name',
        'address',
        'country',
        'city',
        'state',
        'zip_code',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public static function loginValidation($validation="", $message = ""){
        
        $validation = [
            'custom_user_id'             => 'required',
            'password'                  => 'required',

        ];
        $message = [
            'custom_user_id.required'            => 'Please enter User ID.',
            'password.required'                 => 'Please enter password.'
        ];

        return $data = ['validation' => $validation, 'message' => $message];
    }

    public static function login($request){
        
        if(auth()->guard('admin')->attempt(['custom_user_id'=>$request->custom_user_id, 'password'=>$request->password])) {
            
            $remember_token = Str::random(32);
            User::where(['custom_user_id'=>$request->custom_user_id])->update(['remember_token'=>$remember_token]);
            $request->session()->put('remember_token', $remember_token);
            return "1";
              
        }else {
            return "0";
        }
    }

    public static function changePassword($request){

        $admin = auth()->guard('admin')->user();

        $old_password       = $request->old_password;
        $new_password       = $request->new_password;
        $confirm_password   = $request->confirm_password;

        if(Hash::check($old_password, $admin->password)){
            $admin->password = Hash::make($new_password);
            $admin->update();
            $request->session()->flush();
            $request->session()->regenerate();
            Session::flash('message','Password has been changed successfully.');
            return "success";
        }else{
            Session::flash('danger', "Old password doesn't match.");
            return "failed";
        }
    }

    public function sponserDetails(){
        return $this->hasOne(UnderTakeUser::class, 'user_id', 'id')->with('sponserUser');
    }

    public function uplineDetails(){
        return $this->hasOne(UnderTakeUser::class, 'user_id', 'id')->with('uplineUser');
    }
}
