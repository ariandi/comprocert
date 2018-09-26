<?php

namespace App\Http\Controllers\front\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Auth;
use App\Entities\Admin\Statement;
use App\Entities\Admin\Statementstruct;
use App\Entities\Admin\Companypersonstruct;

class MyanalyseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAnalyse($Title,$active){
        $statements = Statement::leftJoin('statementstructs', 'statementstructs.parent_id', '=', 'statements.id')
                ->select(['statementstructs.child_id','statementstructs.parent_id','s.title','s.created_at','s.updated_at','s.active'])
                ->leftJoin('statements as s', 's.id', '=', 'statementstructs.child_id')
                ->where(['statements.active' => 3, 'statementstructs.Active' => $active, 's.Active' => $active])
                ->where('statements.title', $Title)
                ->get();

        foreach ($statements as $keys => $values) {
            if($values->updated_at == "0000-00-00 00:00:00"){
                $statements[$keys]->updated_at = "-";
            }

            $datas = Statementstruct::where('parent_id',$values->child_id)->get();
            
            $total = 0;

            foreach ($datas as $key => $value) {

                $datastatement = Statementstruct::where('parent_id',$value->child_id)->count();
                $total += $datastatement;
            }

            $statements[$keys]->totalstatement = $total;
        }

        return $statements;
    }

    public function getCompanyID($id)
    {
       $companyPersonStruct = Companypersonstruct::select('c.id', 'c.CompanyName', 'c.Email', 'c.Phone')
                                ->join('companies AS c', 'c.id', '=', 'companypersonstructs.CompanyID')
                                ->where(['companypersonstructs.user_id' => $id, 
                                        'companypersonstructs.Active' => 1,
                                        'c.active' => 1])->first();
        
        return $companyPersonStruct;
    }

    public function CheckData($id=null,$title=null,$active){
        

        if($title <> null){
            $where =[
                        ['statements.title', '=', $title],
                        ['statements.active', '=', $active],
                    ];
        }
        if($id <> null) {
            $where =[
                        ['statements.id', '=', $id],
                        ['statements.active', '=', $active],
                    ];
        }

        $statements = Statement::where($where)->first();
        return $statements;
    }
    public function index()
    {

        $datamyanalist = $this->getAnalyse(Auth::user()->id,3);
        $datamyprojectanalist = $this->getAnalyse(Auth::user()->id,4);
        
        return view('front.api.myanalyses',compact(['datamyanalist','datamyprojectanalist']));
    }

    public function detail($id,$tipe, $year = null, $month = null){

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

        if($tipe == 'myanalyse'){
            $aktif = "3";
        }else if($tipe == 'myprojectanalyse'){
            $aktif = "4";
        }

        $bulan['name'] = array('Januar','Februar','Mars','April','Mai','Juni','Juli','August','September', 'Oktober','November','Desember');
        $bulan['numb'] = array('01','02','03','04','05','06','07','08','09','10','11','12');
        $tim = null;
        $NodeID = $id;
        $tipe = $tipe;
       

        $params = [
            'NodeID' => $NodeID,
            'laravelwisehouse' => 'detailanalyse',
            'PersonID' => Auth::user()->id,
            'Date' => $date,
            'Aktif' => $aktif,
            'Tim' => null,
            'id' => $NodeID,
        ];

        for($ip=7;$ip>=0;$ip--){
            
            $dateSel['monthprint'][] = date('M',strtotime(date('Y-'.$dateSel['month'].'-d')." - ".$ip." month"));
        
        }
        
        $data = \Libnode::getSurveyRes($params);
        //$data = \Menus::getJsonPostDataNew('publish.resultanalyse_laravel', $params);
        
        //dd($data);
        return view('front.api.detailanalyses',compact('bulan', 'tim', 'data', 'thisMonth', 'dateSel', 'NodeID','tipe'));

    }

    public function save(Request $request){

        if($request->Active == 0){
            $params = [
                        'NodeID' => $request->Node,
                        'PersonID' => Auth::user()->id,
                        'Date' => date('Y-m'),
                        'laravelwisehouse' => 'survey',
            ];
            $datasub = \Libnode::getSurvey($params);

            if(isset($datasub['dataAnalysis']['dataChild'])){

                foreach ($datasub['dataAnalysis']['dataChild'] as $keysub => $valuesub) {

                    $datasub = Statement::where('id', $valuesub->id)->delete();
                    $datastruct = Statementstruct::where('child_id', $valuesub->id)->delete();
                    $datastructs = Statementstruct::where('parent_id', $valuesub->id)->delete();
                }

            }else{
                
            }

            $data = Statement::where('id', $request->Node)->delete();
            $datastruct = Statementstruct::where('child_id', $request->Node)->delete();
            $datastructs = Statementstruct::where('parent_id', $request->Node)->delete();
        }else{
            $data = Statement::find($request->Node);
            $data->title = $request->NodeName;
            $data->active = $request->Active;
            $data->UpdatedByPersonID = Auth::user()->id;
            $data->save();
        }
        
        return redirect()->route('api.myanalyses.index')->with('success','Data person has been inputed');
    }

    public function add(Request $request){
        
        $tipe = $request->tipe;
        $companyid =  $this->getCompanyID(Auth::user()->id);
        $checkcomp = $this->CheckData(null,$companyid->id,3);
        $checkperson = $this->CheckData(null,Auth::user()->id,3);
        
        $datachild = 0;

        if(isset($checkcomp)){
            $datachild = $checkcomp->id;
        }else{
            #print_r("input");exit;
            //input statement for company
            $data = new Statement();
            $data->title = $companyid->id;                       
            $data->active = 3;
            $data->InsertedByPersonID = Auth::user()->id; 

            if($data->save()){
                //input statement struct for company
                $datachild = $data->id; 
                $datas = new Statementstruct();
                $datas->child_id = $datachild;                       
                $datas->parent_id = 0;
                $datas->active = 3; 

                $datas->save();
            }

        }

        if(isset($checkperson)){
            $datachild = $checkperson->id;
        }else{
            $data = new Statement();
            $data->title = Auth::user()->id;                       
            $data->active = 3;
            $data->InsertedByPersonID = Auth::user()->id; 

            if($data->save()){
                //input statement struct for new statement
                $datas = new Statementstruct();
                $datas->child_id = $data->id;                       
                $datas->parent_id = $datachild;
                $datas->active = 3; 

                $datas->save();
                $datachild = $data->id; 
            }
        }

        $data = new Statement();
        $data->title = $request->NodeName;                       
        $data->active = $request->active;
        $data->InsertedByPersonID = Auth::user()->id; 

        if($data->save()){
            //input statement struct for new statement
            $datas = new Statementstruct();
            $datas->child_id = $data->id;                       
            $datas->parent_id = $datachild;
            $datas->active = $request->active; 

            $datas->save();
            $datachild = $data->id; 
        }

        if( $tipe == "myanalysis" ){

            $titlenode = array( 'PERSONRESSURSER','SAKSRESSURSER',
                            'ARBEIDSPROSESSER / ARBEIDSMÅTER',
                            'PERSONRESULTATER ','SAKSRESULTATER'
                          );
            

            foreach ($titlenode as $key => $value) {
                
                $data = Statement::create([
                    'title' => $value,
                    'active' => $request->active,
                    'InsertedByPersonID' => Auth::user()->id,
                ]);

               
                $datas = Statementstruct::create([
                    'child_id' => $data->id,
                    'parent_id' => $datachild,
                    'active' => $request->active,
                ]);
                
            }

        }else if($tipe == "myprojectanalysis"){

            $params = [
                        'NodeID' => 281,
                        'PersonID' => Auth::user()->id,
                        'Date' => date('Y-m'),
                        'laravelwisehouse' => 'survey',
            ];

            $dataproj = \Libnode::getSurvey($params);

            foreach ($dataproj['dataAnalysis']['dataChild'] as $keyproj => $valueproj) {
                
                $data = new Statement();
                $data->title = $valueproj->title;                       
                $data->active = $request->active;
                $data->InsertedByPersonID = Auth::user()->id; 

                $data->save();
                //input statement struct for new statement
                $datas = new Statementstruct();
                $datas->child_id = $data->id;                       
                $datas->parent_id = $datachild;
                $datas->active = $request->active; 

                $datas->save();
                
                $params = [
                        'NodeID' => $valueproj->id,
                        'PersonID' => Auth::user()->id,
                        'Date' => date('Y-m'),
                        'laravelwisehouse' => 'survey',
                ];

                $dataquestion = \Libnode::getSurvey($params);

                foreach ($dataquestion['dataAnalysis']['dataChild'] as $keypro => $valuepro) {
                   
                   //input statement struct for new statement
                    $datas = new Statementstruct();
                    $datas->child_id = $valuepro->id;                       
                    $datas->parent_id = $data->id;
                    $datas->active = 1;
                    $datas->save(); 
                }

            }

        }
        

        return redirect()->route('api.myanalyses.index')->with('success','Data has been inputed');
    }

    public function liststatement($mainnode,$subnode,$tipe){

        $dataexist =  Statementstruct::where('parent_id',$mainnode)->get();

        $data = array();
        
        foreach ($dataexist as $key => $value) {
            $data[] = $value->child_id;
        }

        $params = [ 
            'id'  => $subnode,
            'whereNotIn' => $data,
        ];


        $data = array();
        $data['mainnode']   = $mainnode;
        $data['subnode']    = $subnode;
        $data['tipe']       = $tipe;
        $data['statements'] = \Libnode::getStatement($params);
        return view('internett1.front.analysis.ListStatement',compact('data'));
    }

    public function addstatement(Request $request){
        
        if(is_array($request->statement)){

            foreach ($request->statement as $keys => $values) {
                
                $data = new Statementstruct();
                $data['child_id']       = $values;
                $data['parent_id']      = $request->parentnode;
                $data['is_main_path']   = 1;

                if($request->simpan){
                    $data->save();
                }

            }

        }

        $parent = Statementstruct::where('child_id',$request->parentnode)->first();

        return redirect()->route('analyses.detail',['id' => $parent->parent_id,'tipe' => $request->tipe])->with('success','Data statement is added');
    }

    public function removestatement($id,$parent,$mainnode,$tipe){

        $mainnode = $mainnode;
        
        $remove = Statementstruct::where([['parent_id',$parent],['child_id',$id]])->delete();

        return redirect()->route('analyses.detail',['id' => $mainnode,'tipe' => $tipe])->with('success','Data is deleted');
    }
}
