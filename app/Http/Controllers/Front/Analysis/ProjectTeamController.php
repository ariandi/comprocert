<?php

namespace App\Http\Controllers\front\analysis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Entities\Admin\Company;
use App\Entities\Admin\Companypersonstruct;
use App\Entities\Admin\Xnode;

class ProjectTeamController extends Controller
{
    public function index()
    {
    	$params = [
    		"laravelwisehouse" => "selectPersonTeam",
    		"PersonID" => Auth::user()->id,
    	];
    	
    	// $data = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);
        $user = User::find($params['PersonID']);
        //dd($user);
        $data = $user::getPersonTeam($user->id);
        $dataCompany = $user::getCompanyTeam($user->id);
        $arrCompanyIDTeam = [];
        foreach ($dataCompany as $key => $value) {
            $arrCompanyIDTeam[] = $value->CompanyID;
        }

        $companyIDTeam = implode(',', $arrCompanyIDTeam);

        $arrCompanyChild = [];
        if( count($dataCompany) > 0 ) {
            $z = 0;
            foreach ($dataCompany as $kdc => $vdc) {
                
                $getCompanyChild = Company::getCompanyChild($vdc->CompanyID);
                if( count($getCompanyChild) > 0 ){
                    $arrCompanyChild = [];
                    $i = 0;
                    foreach ($getCompanyChild as $key2 => $value2) {
                        $arrCompanyChild[$z]['subDataCom'][$i]['CompanyID'] = $value2->CompanyID;
                        $arrCompanyChild[$z]['subDataCom'][$i]['CompanyName'] = $value2->CompanyName;
                        
                        $getUserChild = Companypersonstruct::where(['CompanyID' => $value2->CompanyID, 'Active' => 1])->get();
                        if(isset($getUserChild)){
                            foreach ($getUserChild as $key3 => $value3) {
                                // $arrCompanyChild[$i]['subCompanyUserData'] = $value3->user;
                                if( isset($value3) ){
                                   
                                    $j = 0;
                                    foreach ($value3->getUsersCompany() as $key4 => $value4) {
                                        $arrCompanyChild[$z]['subDataCom'][$i]['subCompanyUserData'][$j]['first_name'] = $value4->first_name;
                                        $arrCompanyChild[$z]['subDataCom'][$i]['subCompanyUserData'][$j]['last_name'] = $value4->last_name;
                                        $arrCompanyChild[$z]['subDataCom'][$i]['subCompanyUserData'][$j]['email'] = $value4->email;
                                        $arrCompanyChild[$z]['subDataCom'][$i]['subCompanyUserData'][$j]['id'] = $value4->id;
                                        $j++;
                                    }
                                }
                            }
                        }
                        $i++;
                    }
                }
                $arrCompanyChild[$z]['CompanyID'] = $vdc->CompanyID;
                $arrCompanyChild[$z]['CompanyName'] = $vdc->CompanyName;
                $z++;
            }
        }
    	
    	return view('front.projectteam.index', ['data' => $data, 
                                                            'companyIDTeam' => $companyIDTeam, 
                                                            'dataCompany' => $arrCompanyChild]);
    }

    public function updateSubList(Request $request)
    {
        $params = [
            "laravelwisehouse" => "updateSubList",
            "PersonID" => $request->PersonID,
            "CompanyIDTeam" => $request->CompanyIDTeam,
            "PersonIDGroup" => $request->PersonIDGroup
        ];

        $data = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);
        // print_r($data);
        if($data->error == 0){
            return ['error' => 0];
        }
        return ['error' => 1];
    }

    public function updateList(Request $request)
    {
        $params = [
            "laravelwisehouse" => "updateSubList",
            "PersonID" => $request->PersonID,
            "CompanyIDTeam" => $request->CompanyIDTeam,
            "PersonIDGroup" => $request->PersonIDGroup
        ];

        $data = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);
        // print_r($data);exit;
        if($data->error == 0){
            return ['error' => 0];
        }
        return ['error' => 1];
    }

    public function getNotes($PersonID)
    {
        $date = \Carbon\Carbon::now();
        $xnode = Xnode::where(['Active' => 1, 'user_id' => $PersonID])->get();

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

        $userData = User::find($PersonID)->first_name.' '.User::find($PersonID)->last_name;

        return view('front.projectteam.notes', ['getNoteX' => $xnode, 'userData' => $userData, 'personID' => $PersonID]);
    }
}
