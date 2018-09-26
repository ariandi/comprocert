<?php

namespace App\Http\Controllers\front\analysis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Input;
use App\User;
use App\Entities\Admin\Extraquestion;

class AnalysisController extends Controller
{
		public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($NodeID, $year = null, $month = null, $team = null)
    {
    	$thisMonth = date('m');
    	$thisMonth = intval($thisMonth) - 1;
    	$date = date('Y-m');
    	$dateSel = null;

    	if($year == null){
    		$dateSel['year'] = date('Y');
    	}else{
    		$dateSel['year'] = $year;
        $date = $year.'-'.$thisMonth;
    	}

    	if($month == null){
    		$dateSel['month'] = date('m');
    	}else{
    		$dateSel['month'] = $month;
        $date = $year.'-'.$dateSel['month'];
    	}

    	$bulan['name'] = array('Januar','Februar','Mars','April','Mai','Juni','Juli','August','September', 'Oktober','November','Desember');
    	$bulan['numb'] = array('01','02','03','04','05','06','07','08','09','10','11','12');

      if(Input::has('PersonID')){
        $PersonID = Input::get('PersonID');
      }else{
        $PersonID = Auth::user()->id;
      }
    	
      if($NodeID == 282){
        $NameLanguagestring = "idLeadergroupxreport";
      }else{
        $NameLanguagestring = "-";
      }

    	$params = [
            'NodeID' => $NodeID,
            'laravelwisehouse' => 'projectReportteam',
            'PersonID' => $PersonID,
            'Date' => $date,
            'Tim' => $team,
            'id' => $NodeID,
        ];

      for($ip=7;$ip>=0;$ip--){
        $dateSel['monthprint'][] = date('M',strtotime(date('Y-'.$dateSel['month'].'-d')." - ".$ip." month"));
      }

      $data = \Libnode::getSurveyRes($params);

      // $data = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);

      // dd($data);

      return view('front.analysis.index', compact('bulan', 'team', 'data', 'thisMonth', 'dateSel', 'NodeID','NameLanguagestring'));
    }

    public function getDataDetailLeft($NodeID, $year = null, $month = null)
    {
      $thisMonth = date('m');
      $thisMonth = intval($thisMonth) - 1;
      $date = date('Y-m');
      $dateSel = null;

      if($year == null){
        $dateSel['year'] = date('Y');
      }else{
        $dateSel['year'] = $year;
        $date = $year.'-'.$thisMonth;
      }

      if($month == null){
        $dateSel['month'] = date('m');
      }else{
        $dateSel['month'] = $month;
        $date = $year.'-'.$dateSel['month'];
      }

      $params = [
          'parentnodeid' => $NodeID,
          'PersonID' => Session()->get('userData')->PersonID,
          'Date' => $date,
          'laravelwisehouse' => 'addingDetailLeft',
      ];

      $data = \Libnode::getDetailLeft($params);
      // $data = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);

      return view('front.analysis.detailLeft', compact('tim', 'data', 'thisMonth', 'dateSel', 'NodeID'));
    }

    public function getDataDetailRight($NodeID, $year = null, $month = null)
    {
      $thisMonth = date('m');
      $thisMonth = intval($thisMonth) - 1;
      $date = date('Y-m');
      $dateSel = null;

      if($year == null){
        $dateSel['year'] = date('Y');
      }else{
        $dateSel['year'] = $year;
        $date = $year.'-'.$thisMonth;
      }

      if($month == null){
        $dateSel['month'] = date('m');
      }else{
        $dateSel['month'] = $month;
        $date = $year.'-'.$dateSel['month'];
      }

      $params = [
          'NodeID' => $NodeID,
          'PersonID' => Session()->get('userData')->PersonID,
          'Date' => $date,
          'laravelwisehouse' => 'addingDetailRight',
      ];

      $data = \Libnode::getDetailRight($params);
      // $data = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);

      return view('front.analysis.detailRight', compact('tim', 'data', 'thisMonth', 'dateSel', 'NodeID'));
    }

    public function getSurvey($NodeID, $page = 1, $ParentNodeID)
    {
      $params = [
          'NodeID' => $NodeID,
          'PersonID' => Auth::user()->id,
          'Date' => date('Y-m'),
          'laravelwisehouse' => 'survey',
      ];

      $ParentNodeID = $ParentNodeID;
      // $data = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);
      $data = \Libnode::getSurvey($params);

      $cData = $data['countData'];
      $data['perPage'] = 12;
      $data['page'] = $page;
      $data['from'] = ($data['perPage'] * ($data['page'] - 1)) + 1;
      $persentase['a'] = ceil($cData / $data['perPage']);
      $persentase['b'] = ($data['page'] / $persentase['a'])*100;
      $dataArr['dataAnalysis'] = [];
      $start = ($data['perPage']*$data['page']) - $data['perPage'];
      $end = $data['perPage']*$data['page'];

      if($persentase['a'] == $data['page']){
        $data['perPage'] = $cData;
      }

      foreach ($data['dataAnalysis']['dataChild'] as $kdata => $vdata) {
        if(isset($vdata->dataChildSub)){
          foreach($vdata->dataChildSub as $dataChildSub){
            $dataArr['dataAnalysis'][] = $dataChildSub;
          }
        }
      }

      $dataArr['dataAnalysis'] = array_slice($dataArr['dataAnalysis'], $start, $end);

      return view('front.analysis.survey', compact('tim', 'data', 'NodeID', 'persentase', 'dataArr', 'ParentNodeID'));
    }

    public function getSurveyall($NodeID, $page = 1)
    {
      $params = [
          'NodeID' => $NodeID,
          'PersonID' => Auth::user()->id,
          'Date' => date('Y-m'),
          'laravelwisehouse' => 'surveyall',
      ];

      $data = \Libnode::getSurveyAll($params);

      $cData = $data['countData'];
      $data['perPage'] = 12;
      $data['page'] = $page;
      $data['from'] = ($data['perPage'] * ($data['page'] - 1)) + 1;
      $persentase['a'] = ceil($cData / $data['perPage']);
      $persentase['b'] = round(($data['page'] / $persentase['a'])*100, 2);
      $dataArr['dataAnalysis'] = [];
      $start = ($data['perPage']*$data['page']) - $data['perPage'];
      $end = $data['perPage']*$data['page'];

      if($persentase['a'] == $data['page']){
        $data['perPage'] = $cData;
      }

      foreach ($data['dataAnalysis']['dataChild'] as $kdata => $vdata) {
        if(isset($vdata->dataChildSub)){
          foreach($vdata->dataChildSub as $dataChildSub){
            $dataArr['dataAnalysis'][] = $dataChildSub;
          }
        }
      }

      $dataArr['dataAnalysis'] = array_slice($dataArr['dataAnalysis'], $start, $end);

      return view('front.analysis.surveyAll', compact('tim', 'data', 'NodeID', 'persentase', 'dataArr', 'ParentNodeID'));
    }

    public function yesdoitstorebynode(Request $request)
    {
      $params = [
                    'note' => $request->note, 
                    'laravelwisehouse' => 'yesdoit',
                    'email' => Auth::user()->email,
                    'NodeID' => $request->NodeID,
                ];

      $yesdoitRes = \Menus::getJsonPostDataNew('publish.detailresultx_laravel', $params);

      if($yesdoitRes[0] == "Success"){
          return ['error' => 0];
      }else{
          return ['error' => 1, 'msg' => 'Failed input to server'];
      }
    }

    public function getSurveyStore(Request $request, $NodeID)
    {
      $Score = [];
      foreach ($request->Score as $k => $score) {
        $Score[$k] = $score;
      }

      if(isset($request->Not)){
        foreach ($request->Not as $key => $value) {
          $Score[$key] = 0;
        }
      }

      $params = [
        'Page' => $request->page,
        'ProductID' => $request->ProductID,
        'Score' => $Score,
        'NodeID' => $NodeID,
        'PersonID' => Auth::user()->id,
      ];

      $nexPage = intval($request->page)+1;

      if($request->page == $request->totalpage){
        $params['Last'] = 1;
        $redirect = '/no/profile/analysissurvey/finish/'.$NodeID.'/'.$request->ParentNodeID;
      }else{
        $params['Last'] = 0;
        $redirect = '/no/profile/analysissurvey/'.$NodeID.'/'.$nexPage.'/'.$request->ParentNodeID;
      }

      $delScore = Extraquestion::delScore($params);
      if($delScore){

        $inpScore = Extraquestion::inputScore($params);
        if($inpScore){
          return redirect($redirect);
        }

      }

      return 'getError';

    }

    public function getSurveyStoreAll(Request $request, $NodeID)
    {
      $Score = [];
      foreach ($request->Score as $k => $score) {
        $Score[$k] = $score;
      }

      if(isset($request->Not)){
        foreach ($request->Not as $key => $value) {
          $Score[$key] = 0;
        }
      }

      $params = [
        'Page' => $request->page,
        'ProductID' => $request->ProductID,
        'Score' => $Score,
        'parentnodeid' => $NodeID,
        'PersonID' => Auth::user()->id,
      ];

      $nexPage = intval($request->page)+1;

      if($request->page == $request->totalpage){
        $params['Last'] = 1;
        $redirect = '/no/profile/analysissurvey/finishall/'.$NodeID;
      }else{
        $params['Last'] = 0;
        $redirect = '/no/profile/analysissurveyall/'.$NodeID.'/'.$nexPage;
      }

      $delScore = Extraquestion::delScore($params);
      if($delScore){

        $inpScore = Extraquestion::inputScore($params);
        if($inpScore){
          return redirect($redirect);
        }

      }

      return 'getError';
    }

    public function getSurveyFinish($NodeID, $ParentNodeID)
    {
      $NodeID = $ParentNodeID;
      return view('front.analysis.surveyFinish', compact('NodeID'));
    }

    public function getSurveyFinishAll($NodeID)
    {
      $NodeID = $NodeID;
      return view('front.analysis.surveyFinish', compact('NodeID'));
    }

    public function deleteanalyses($PersonID)
    {
      $PersonID = $PersonID;
      return view('front.analysis.deleteanalyses', compact('PersonID'));
    }

    public function delete(request $request)
    {
      $params = [
        'PersonID' => Session()->get('userData')->PersonID,
        'NodeID' => $request->nodeid,
        'clear' => $request->clear,
        'laravelwisehouse' => 'deleteanalyse',
      ];

      $datadelete = \Menus::getJsonPostDataNew('publish.resultanalyse_laravel', $params);
      
      return redirect()->route('profile.analysis.index',['NodeID'=>$Request->nodeid])->with('invite','Score Has been deleted');;
    }
}
