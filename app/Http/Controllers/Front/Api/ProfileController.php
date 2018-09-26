<?php

namespace App\Http\Controllers\Front\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Input;
use App\User;
use App\Entities\Admin\Xnode;
use App\Entities\Admin\Companypersonstruct;
use App\Entities\Admin\Ssclub;

class ProfileController extends Controller
{
	public function __construct()
    {
        if( !session()->has('LanguageID') ){
            session(['LanguageID' => 'no']);
        }
    }

    public function index()
    {
    	return view('front.api.profileindex');
    }

    public function update(Request $request)
    {
    	$User = User::find($request->id);
    	$User->first_name = $request->first_name;
    	$User->last_name = $request->last_name;
        $User->birth_date = date('Y-01-01', strtotime($request->years_date));
        $User->gender = $request->gender;
        $User->no_hp = $request->mobile_phone;

    	if( $User->save() ) {
    		return ['error' => 0, 'data' => $User];
    	}
    	return ['error' => 1];
    }

    public function edit($id)
    {
    	return view('front.api.profile');
    }

    public function editPassword()
    {
        return view('front.api.profileUpdatePassword');
    }

    public function passwordStore(Request $request)
    {
        $this->validate(request(), [
            'currentPassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        if(Auth::Check())
        {
          
          $current_password = Auth::User()->password;
          if(Hash::check($request['currentPassword'], $current_password))
          {           
            $user_id = Auth::User()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request['password']);;
            $obj_user->save(); 
            return ['error' => 0];
          }
          else
          {           
            return ['error' => 1, 'msg' => 'Please enter correct current password'];
          }
                  
        }
        else
        {
          return ['error' => 1, 'msg' => 'You not loged in'];
        }
    }

    public function subscription()
    {
      return view('front.api.subscription');
    }

    public function yesdoit()
    {
        return view('front.api.yesdoit');
    }

    public function yesdoitstore(Request $request)
    {
        $note = $request->note;
        $email = Auth::user()->email;
        $date = \Carbon\Carbon::now();

        $xNode = new Xnode();
        $xNode->user_id = Auth::user()->id;
        $xNode->FromPersonID = Auth::user()->id;
        $xNode->UpdatedByPersonID = Auth::user()->id;
        $xNode->InsertedByPersonID = Auth::user()->id;
        $xNode->Note = $note;
        $xNode->NodeID = 2254;
        $xNode->Date = $date->toDateTimeString();

        if( $xNode->save() ){
            return ['error' => 0];
        }else{
            return ['error' => 1, 'msg' => 'Failed input to server'];
        }
    }

    public function action()
    {
        $date = \Carbon\Carbon::now();
        $xnode = Xnode::where(['Active' => 1, 'user_id' => Auth::user()->id])->get();

        foreach ($xnode as $kXnode => $vXnode) {
            $dataques = [];
            $i = 0;
            $prodScore = \Libnode::getProductIDFromNode($vXnode->NodeID, $vXnode->user_id, date('Y-m',strtotime( $date->toDateTimeString() )));
            if(count($prodScore) > 0){
                foreach ($prodScore as $kPs => $vPs) {
                    if($vPs->Score > 0){
                        $dataques[$i] = $vPs->Score;
                    }else{
                        $dataques[$i] = 0;
                    }
                    $i++;
                }
            }else{
                $dataques[0] = 0;
            }
            
            // print_r($dataques);
            $vXnode->colorlist  = array_sum($dataques)/count($dataques);
            $vXnode->colorlist2 = \Libnode::getColorLaravelsub($vXnode->colorlist);
            $vXnode->parent = \Libnode::getParentAction($vXnode->NodeID);
        }

        return view('front.api.action', ['getNoteX' => $xnode]);
    }

    public function actionstore(Request $request)
    {
        $id = $request->id;
        $mywhy = $request->mywhy;

        $xnode = Xnode::find($id);
        $xnode->MyWhy = $mywhy;

        if( $xnode->save() ){
            return ['error' => 0];
        }else{
            return ['error' => 1, 'msg' => 'Failed update to server'];
        }
    }

    public function storecalendar(Request $request)
    {
        $id = $request->id;
        $mywhy = $request->mywhy;
        $Note = $request->Note;
        $NodeName = $request->NodeName;

        // echo $Note.' '.$mywhy.' '.$NodeName;die;

        $params = [
            'Note' => $Note,
            'NodeName' => $NodeName,
            'MyWhy' => $mywhy,
            'PersonID' => Session()->get('userData')->Email,
            'FromPersonID' => Session()->get('userData')->Email,
            'mobile' => 'sendToCalendar',
        ];

        $actionResCal = \Menus::getJsonPostDataNew('publish.send_calendar', $params);

        if($actionResCal == 'suskses'){
            return ['error' => 0];
        }else{
            return ['error' => 1, 'msg' => 'Failed Send email to server'];
        }
    }

    public function selectPersonTeam($PersonID)
    {
        $companypersonstructs = Companypersonstruct::where([['Active', '>', 0],['user_id', '=', $PersonID]])
                                ->get();
        $arrCompanyID = [];
        foreach ($companypersonstructs as $key => $value) {
            $arrCompanyID[] = $value->CompanyID;
        }
        $data['data'] = User::select('users.id AS user_id', 'users.first_name', 'users.last_name', 'users.email', 'ss.id', 
                                'ss.Active AS SActive', 'cp.CompanyID')
                ->leftJoin('companypersonstructs AS cp', 'cp.user_id', '=', 'users.id')
                ->leftJoin('ssclubs AS ss', function ($join) use($arrCompanyID){
                    $join->on('ss.ClubName', '=', 'users.id')
                    ->where('ss.Active',1)
                    ->whereIn('ss.ClubBranch', $arrCompanyID);
                })
                ->where(['cp.Active' => 1, 'users.active' => 1])
                ->where([['users.id', '!=', $PersonID]])
                ->whereIn('cp.CompanyID', $arrCompanyID)
                ->get();

        $NodeID = Input::get('NodeID');

        return view('front.api.selectPersonTeam', ['data' => $data, 'NodeID' => $NodeID]);
    }
}
