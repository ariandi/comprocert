<?php

namespace App\Http\Controllers\front\analysis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{
    public function member($PersonID)
    {
    	$params = [
            'PersonID' => $PersonID,
            'laravelwisehouse' => 'selectPersonTeam',
        ];

        $data = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);
        $dataquestion = \Menus::getJsonPostDataNew('publish.resultanalyse_laravel', ['laravelwisehouse' =>'getstatement','subnode' =>98]);
     // 	echo "<pre>";
     // 	print_r($data);
    	// echo "<pre>";
    	// exit;
    	return view('front.analysis.inviteteam', ['data' => $data,'dataquestion'=>$dataquestion]);
    }

    public function sendEmail(Request $Request)
    {
        
    	$params = [
            'PersonID'  => Session()->get('userData')->Email,
            'ToPersonID' => $Request->personmail,
            'NodeName' => $Request->extraquestion,
            'Note' => $Request->textnote,
            'laravelwisehouse' => 'InviteTeamMember',
        ];
        
        $actionResCal = \Menus::getJsonPostDataNew('publish.send_email', $params);
        //print_r($actionResCal);exit;
        return redirect()->route('profile.analysis.index',['NodeID'=>$Request->nodeid])->with('invite','Email Has been send');
    }
}
