<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use API,
    Session;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registerfronts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   //print_r($data);exit;
        return Validator::make($data, [
            //'name' => 'required|string|max:255',
            //'username' => 'required|string|min:6|max:255',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'companyid' => 'required|integer',
            //'categories' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {  //dd($data);
        
        $dataregister = \Menus::getJsonPostDataNew('http://laravel-cms.dev.tixcloud.no/api/user/register', $data);
        #print_r($dataregisterr->error);exit;
        $checkdata = User::where('email',$data['email'])->first();

        if(isset($checkdata)){
            $reg = User::find($checkdata->id);
            $reg->name               = $data['firstname'].' '.$data['lastname'];
            $reg->first_name         = $data['firstname'];
            $reg->last_name          = $data['lastname'];
            $reg->company            = $data['companyid'];
            $reg->categories         = 0;
            $reg->username           = $data['email'];
            $reg->gender             = "M";
            $reg->active             = 1;
            $reg->role               = 'viewer';
            $reg->lang_id            = 'en';
            $reg->profile_img        = 'images/profiles/user_default.png';
            $reg->email              = $data['email'];
            $reg->password           = bcrypt($data['password']);

            $reg->save();
        }else{

            $reg = User::create([
                'name'          => $data['firstname'].' '.$data['lastname'],
                'first_name'    => $data['firstname'],
                'last_name'     => $data['lastname'],
                'company'       => $data['companyid'],
                'categories'    => 0,# $data['categories'],
                'username'      => $data['email'],
                'gender'        => 'M',
                'active'        => 1,
                'role'          => 'viewer',
                'lang_id'       => 'en',
                'profile_img'   => 'images/profiles/user_default.png',
                'email'         => $data['email'],
                'password'      => bcrypt($data['password']),
            ]);

        }
        
        $reg;

        if($dataregister->error == 0){

            Session::flash('message', 'Thank you, you can now download the app and log inn with your selected username and password');

            return $reg;#back()->with('success','Data has been updated');
        }else{

            return back()->with('message','Data not registered');
        }
    }
}
