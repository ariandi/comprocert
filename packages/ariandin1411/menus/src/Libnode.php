<?php

namespace Ariandin1411\Menus;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\DB;
use Auth;

class Libnode
{
	public static $options = [];

	public function __construct()
	{
		// Waiting id needed
	}

	public static function getSurveyRes($params)
	{		
		$PersonID = Auth::user()->id;
		$myDate = date( 'Y-m-d', strtotime($params['Date']) );
		$Tim = $params['Tim'];
		$buln = date( 'm', strtotime($params['Date']) );

		$getSurveyRes = self::getStatement($params);


		$i = 0;
		$a = 0;
		$data1 = array();
		foreach ($getSurveyRes as $key1 => $value1) {
		
			$data1[$a] = $value1;
			$dataquestion = [];
			$dataquestionN = [];
			$datahead = [];
			$dataheadN = [];
			$dataheadN8 = [];
			$b = 0;

			$getSurveyResSub1 = self::getStatement(['id' => $value1->id]);
			foreach( $getSurveyResSub1 as $key2 => $value2 ){
				// dd($value2);
				$data1[$a]->dataChild[$b] = $value2;
				
				$dataques = [];
				$dataquesN = [];
				$datavalsa = 0;
				$dataques1 = [];
				$ij = 0;

				// dd(self::getProductIDFromNode($value2->id));
				$getProductIDFromNode1 = self::getProductIDFromNode($value2->id,$PersonID,date('Y-m', strtotime($myDate)));
				foreach ( $getProductIDFromNode1 as $key3 => $value3 ) {

					$data1[$a]->dataChild[$b]->dataChildSub[$ij] = $value3;
					$data1[$a]->dataChild[$b]->dataChildSub[$ij]->Score = $value3->Score;

					/////////////////////////////////////////Looping month Aziz////////////////
					// $dataquestionbln = [];
					// $valquess = [];
					// for($ip=7;$ip>=0;$ip--){

					// 	$blantotal = date('Y-m',strtotime(date('Y-'.$buln.'-d')." - ".$ip." month"));

					// 	$valquess[$ip]= self::getExtraQuestion($PersonID,$value3->ProductID,$blantotal,$Tim);
						
					// 	if($valquess[$ip][1] != 0) {
					// 		$dataques1[$ip][] = $valquess[$ip][1];
					// 	}else{
					// 		$dataques1[$ip][] = 0;
					// 	}
					// }
					////////////////////////////////////////Not Team///////////////////


					////////////////////////////////////////Not Team/////////////////////////
					if($data1[$a]->dataChild[$b]->dataChildSub[$ij]->Score != 0){
						$dataques[] = $data1[$a]->dataChild[$b]->dataChildSub[$ij]->Score;
					}
					//////////////////////////////////////Looping month/////////////////////////
					$i++;
					$ij++;
				}

				
				// For Head Color looping Aziz/////////////////////////////////////////////////////////
				// $databls = [];
				// $databls[0] = array_sum( $dataques1[0])/count($dataques1[0] );
				// $databls[1] = array_sum( $dataques1[1])/count($dataques1[1] );
				// $databls[2] = array_sum( $dataques1[2])/count($dataques1[2] );
				// $databls[3] = array_sum( $dataques1[3])/count($dataques1[3] );
				// $databls[4] = array_sum( $dataques1[4])/count($dataques1[4] );
				// $databls[5] = array_sum( $dataques1[5])/count($dataques1[5] );
				// $databls[6] = array_sum( $dataques1[6])/count($dataques1[6] );
				// $databls[7] = array_sum( $dataques1[7])/count($dataques1[7] );

				// for($iqq=7;$iqq>=0;$iqq--){
				// 	if($databls[$iqq] != 0){
				// 		$dataheadN8[$iqq][] = $databls[$iqq];
				// 	}else{
				// 		$dataheadN8[$iqq][] = 0;
				// 	}
				// }
				// For Head Color looping Aziz//////////////////////////////////////////////////////////

				// For Head Color group /////////////////////////////////////////////////////////
				if(count($dataques) > 0 || array_sum($dataques) > 0){
					$colorbullet  = array_sum($dataques)/count($dataques);
				}
				else{
					$colorbullet  = 0;
				}
				$dataquestion[] = $colorbullet;

				if($colorbullet != 0){
					$datahead[] = $colorbullet;
				}
				// For Head Color group //////////////////////////////////////////////////////////

				/// Warna Buat yang group
				$bulletcolor = $dataquestion[$key2];
				$data1[$a]->dataChild[$b]->childColorN = self::getColorLaravelsub($bulletcolor);
				/// Warna Buat yang group


				//////////////////////// For Right Color Not Team////////////////////////////////////////
				$x = [];
				$y = [];
				if($value1->title == 'PERSONRESULTATER' || $value1->title == 'SAKSRESULTATER'){
					$getSurveyResSub2 = self::getStatement(['id' => $value2->id]);
					foreach( $getSurveyResSub2 as $key2sub => $value2sub ){

						$datavalsa = 0;
						$prd = [];
						$getProductIDFromNode2 = self::getProductIDFromNode($value2sub->id,$PersonID,date('Y-m', strtotime($myDate)));					
						foreach($getProductIDFromNode2 as $valrange){						
							// $vals = self::getExtraQuestion($PersonID, $valrange->ProductID, date('Y-m', strtotime($myDate)), $Tim);
							$vals[1] = $valrange->Score;
							if($vals[1] > 0){
								$datavalsa += $vals[1];
								$prd[] = $vals[1];
							}
						}

						if(count($prd) > 0){
							$x[] = $datavalsa;
							$y[] = count($prd);
						}

					}

					$jml = array_sum($y);
					$z = array_sum($x);

					if($jml > 0){
						$ratacolor = number_format(($z / $jml),1);
					}else{
						$ratacolor = number_format(0,1);
					}
					
					$data1[$a]->dataChild[$b]->childColor2 = self::getColorLaravelsub($ratacolor);
				}
				//////////////////////// For Right Color ////////////////////////////////////////

				$b++;
			}

			if(count($datahead) > 0){
				$results1  = round( array_sum($datahead)/count($datahead) ,1);
			}else{
				$results1  = 0;
			}
			$data1[$a]->parentColorN = self::getColorLaravel($results1);

			/////////////////////Looping Month Aziz
			// for($iq=7;$iq>=0;$iq--){
			// 	$results1N8  = round( array_sum($dataheadN8[$iq])/count($dataheadN8[$iq]) ,1);
			// 	$data1[$a]->parentColorN8[] = self::getColorLaravelsub($results1N8);
			// }
			////////////////////Looping month Aziz
			$a++;

		}

		$data['dataAnalysis'] = $data1;
		$data['NodeName'] = self::getNameNode($params['id']);
		$data['SurveyRes'] = self::getCountValTeam($PersonID, date('Y-m', strtotime($myDate)), $Tim);

		return $data;
	}

	public static function getDetailLeft($params)
	{		
		$parentnodeid = $params['parentnodeid'];
		$PersonID = $params['PersonID'];
		$month = $params['Date'];

		$data  = [];
		$question = self::getProductIDFromNode($parentnodeid, $PersonID, date('Y-m', strtotime($month)));

		$productName = [];

		foreach($question as $ques)
		{	
			$data[]  = $ques->ProductID;
			$productName[] = $ques->ProductName;
		}

		foreach($data as $numarray=> $datas){
			$valextra[] = self::getExtraQuestion($PersonID, $datas, $month,'');
		}

		$nodeName = self::getNameNode($params['parentnodeid']);

		$response = ['quest' => $valextra, 'nodeName' => $nodeName];

		return $response;
	}

	public static function getDetailRight($params)
	{
		$NodeID = $params['NodeID'];
		$PersonID = $params['PersonID'];
		$mytime = \Carbon\Carbon::now();

		$arr1 = [];
		// $data1 = $modelari->getNav($NodeID);
		$data1 = self::getStatement(['id' => $NodeID]);

		$i = 0;
		foreach ($data1 as $key1 => $value1) {
			$arr1[$i] = $value1;
			$arr1[$i]->subdata = self::getProductIDFromNodeSimple($value1->id);
			// print_r($arr1[$i]->subdata);die;
			$j = 0;
			foreach ($arr1[$i]->subdata as $key2 => $value2) {
				$arr1[$i]->subdata[$j] = $value2;
				$arr1[$i]->subdata[$j]->warna = self::getExtraQuestion( $PersonID, $value2->ProductID, date('Y-m', 
																																strtotime($mytime->toDateTimeString() )))[0];
				$j++;
			}

			$i++;
		}

		$nodeName = self::getNameNode($NodeID);

		$data = ['data' => $arr1, 'nodeName' => $nodeName];

		return $data;
	}

	public static function getSurveyAll($params){

		$ParentNodeID = $params['NodeID'];
		$PersonID = $params['PersonID'];
		$myDate = $params['Date'];
		$data1 = [];
		$buln = date( 'm', strtotime($myDate) );
		$b = 0;
		$c = 0;

		$getSurveyResSub1 = self::getStatement(['id' => $ParentNodeID]);
		foreach( $getSurveyResSub1 as $key => $value ){

			$getSurveyResSub2 = self::getStatement(['id' => $value->id]);
			foreach( $getSurveyResSub2 as $key2 => $value2 ){

				$data1['dataChild'][$b] = $value2;
				$ij = 0;

				$getProdScore = self::getProductIDFromNode($value2->id, $PersonID, $myDate);
				foreach ( $getProdScore as $key3 => $value3 ) {

					$data1['dataChild'][$b]->dataChildSub[$ij] = $value3;
					$data1['dataChild'][$b]->dataChildSub[$ij]->Score = $value3->Score;

					$ij++;
					$c++;
				}

				$b++;
			}

		}

		$data['dataAnalysis'] = $data1;
		$data['nodeName'] = self::getNameNode($ParentNodeID);
		$data['countData'] = $c;

		return $data;

	}

	public static function getSurvey($params){

		$ParentNodeID = $params['NodeID'];
		$PersonID = $params['PersonID'];
		$myDate = $params['Date'];
		$data1 = [];
		$buln = date( 'm', strtotime($myDate) );
		$b = 0;
		$c = 0;
			
			$getSurveyResSub1 = self::getStatement(['id' => $ParentNodeID]);
			foreach( $getSurveyResSub1 as $key2 => $value2 ){

				$data1['dataChild'][$b] = $value2;
				// print_r($data1);			
				$ij = 0;

				$getProdScore = self::getProductIDFromNode($value2->id, $PersonID, $myDate);
				foreach ( $getProdScore as $key3 => $value3 ) {

					$data1['dataChild'][$b]->dataChildSub[$ij] = $value3;
					$data1['dataChild'][$b]->dataChildSub[$ij]->Score = $value3->Score;

					$ij++;
					$c++;
				}

				$b++;
			}

		$data['dataAnalysis'] = $data1;
		$data['nodeName'] = self::getNameNode($ParentNodeID);
		$data['countData'] = $c;

		return $data;

	}

	public static function getStatement($params)
	{
		if(! isset($params['id']) ){
			return 'No NodeID Selected';
		}

		//add by aziz
		if( isset($params['Aktif']) ){
			$aktif  = $params['Aktif'];
		}else{
			$aktif  = 1;
		}
		//end add by aziz

		$where = [
			['ss.parent_id', '=', $params['id']],
			['s.active', '=', $aktif],
			['ss.active', '=', $aktif],
		];


		$data = DB::table('statementstructs AS ss')
		->select('s.id', 's.title')
		->Join('statements AS s', function ($join) {
			$join->on('s.id', '=', 'ss.child_id');
		})
		->where($where)
		->orderBy('ss.priority', 'ASC');

		if( isset($params['WhereIn']) ){
			$data->whereIn('ss.child_id', $params['WhereIn']);
		}

		if( isset($params['whereNotIn']) ){
			$data->whereNotIn('ss.child_id', $params['whereNotIn']);
		}

		if( isset($params['offset']) ){
			$data->offset($params['offset']);
		}

		if( isset($params['limit']) ){
			$data->limit($params['limit']);
		}

		return $data->get();
	}

	public static function getParentAction($ChildNodeID){
		$where = [
			['s.active' ,'=', 1],
			['ss.active' ,'=', 1],
			['ss.child_id' ,'=', $ChildNodeID],
		];

		$sql = DB::table('statements AS s')
		->select('s.id', 's.title')
		->Join('statementstructs AS ss', function ($join) {
			$join->on('s.id', '=', 'ss.parent_id');
		})
		->where($where)
		->orderBy('ss.priority');

		return $sql->get();
	}

	public static function getProductIDFromNode($id, $user_id = null, $date = null)
	{
		$where = [
			['ss.child_id', '=', $id],
			['s.tablename', '=', 'product'],
			['pt.LanguageID', '=', 'en'],
			['s.active', '=', 1],
			['ss.active', '=', 1],
			['p.Active', '=', 1],
			['pt.Active', '=', 1],
		];
		
		$year = date('Y', strtotime($date));
		$month = date('m', strtotime($date));

		$data = DB::table('statements AS s')
		->select('s.id', 's.title', 'p.id AS ProductID', 'eq.Score', 'pt.ProductName')
		->Join('statementstructs AS ss', function ($join) {
			$join->on('s.id', '=', 'ss.parent_id');
		})
		->Join('products AS p', function ($join) {
			$join->on('s.primarykey', '=', 'p.id');
		})
		->Join('producttexts AS pt', function ($join) {
			$join->on('pt.ProductID', '=', 'p.id');
		})
		->leftJoin(\DB::raw('(
											select max(id) maxid, ProductID from extraquestions eq 
											where eq.user_id = '.$user_id.' 
											and date_format(eq.Date, "%Y-%m")  <= "'.$date.'" 
											and eq.Active = 1 group by ProductID
										) eqq'), function($join){
      $join->on([['p.id', '=', 'eqq.ProductID']]);
    })
    ->leftJoin('extraquestions AS eq', function ($join) use($user_id, $year, $month){
			$join->on([['eq.ProductID', '=', 'eqq.ProductID'], ['eq.id', '=', 'eqq.maxid']])
			->where([['eq.Active', '=', 1],['eq.user_id', '=', $user_id]])
			->whereYear('eq.Date', '<=', $year)
		  ->whereMonth('eq.Date', '<=', $month);
		})
		->where($where)
		->orderBy('ss.id', 'ASC');
		// if($id == 1643){
		// 	print_r($data->toSql());die;
		// }
		return $data->get();
	}

	public static function getProductIDFromNodeSimple($id)
	{
		$where = [
			['ss.child_id', '=', $id],
			['s.tablename', '=', 'product'],
			['pt.LanguageID', '=', 'en'],
			['s.active', '=', 1],
			['ss.active', '=', 1],
			['p.Active', '=', 1],
			['pt.Active', '=', 1],
		];

		$data = DB::table('statements AS s')
		->select('s.id', 's.title', 'p.id AS ProductID', 'pt.ProductName')
		->Join('statementstructs AS ss', function ($join) {
			$join->on('s.id', '=', 'ss.parent_id');
		})
		->Join('products AS p', function ($join) {
			$join->on('s.primarykey', '=', 'p.id');
		})
		->Join('producttexts AS pt', function ($join) {
			$join->on('pt.ProductID', '=', 'p.id');
		})
		->where($where)
		->orderBy('ss.id', 'ASC');
		// if($id == 1643){
		// 	print_r($data->toSql());die;
		// }
		return $data->get();
	}

	public static function getExtraQuestion($PersonID, $ProductID, $Date, $Tim = null)
	{
		$where = [
								['e.ProductID', '=', $ProductID],
								['e.Date', '<=', date('Y-m-t',strtotime($Date."-01"))],
								['e.Active', '=', 1],
							];

		if($Tim == 'team'){
				$datagroupextra = [];
				
				$sqlClub = DB::table('ssclubs AS sc')
									->select('sc.ClubGroup', 'sc.ClubName')
									->where(['sc.ClubGroup' => $PersonID,  'sc.Active' => 1])
									->get();
				
				foreach ($sqlClub as $keydatapersongroupextra => $datapersongroupextra) {
					$sql = DB::table('extraquestions AS e')
									->select('e.Score')
									->where($where)
									->where('e.user_id', $datapersongroupextra->ClubName)
									->orderBy('e.id', 'DESC')
									->limit(1)
									->first();

					if( $sql ){
							$datagroupextra[] = round($sql->Score, 1 );
					}
				}
				
				$scorepersongroupextra  = array_sum($datagroupextra)/count($datagroupextra);
				$scoreextra			 	 			= $scorepersongroupextra;
				$mycolorextra   		 		= $this->getColorLaravelsub($scoreextra);

		}else{
			$sql = DB::table('extraquestions AS e')
			->select('e.Score')
			->where($where)
			->where('e.user_id', $PersonID)
			->orderBy('e.id', 'DESC')
			->limit(1)
			->first();

			if(!$sql){
				$Score = 0;
			}else{
				$Score = $sql->Score;
			}

			$scoreextra		= round( $Score, 1 );
			$mycolorextra   = self::getColorLaravelsub($scoreextra);	
		}
		
		return [$mycolorextra, $scoreextra, $sql, self::getProdName($ProductID)];
	}

	public static function getProdName($ProductID)
	{
		$sql = DB::table('producttexts AS pt')
			->select('pt.ProductName')
			->where(['ProductID' => $ProductID, 'LanguageID' => 'en', 'Active' => 1])
			->first();

		return $sql->ProductName;
	}

	public static function getColorLaravel($score){	
		if($score > '0.0' and $score <= '1.7'){
    	$warna = 'red';
    }else if($score >= '1.71' and $score <= '2.5' ){
    	$warna = 'rgba(255, 43, 43, 0.63) none repeat scroll 0% 0%';//merah muda
    }else if($score >= '2.51' and $score <= '3.20' ){
    	$warna = 'yellow';
    }else if($score >= '3.21' and $score <= '4.1' ){
      $warna = 'rgba(58, 222, 58, 0.71) none repeat scroll 0% 0%';//hijau muda	
    }else if($score >= '4.11' and $score <= '5.0' ){
    	$warna = 'green';
    }else{
  		$warna = '#ccc';
  	}
		
		return $warna;
	}

	public static function getColorLaravelsub($score){	
		if($score > '0.0' and $score <= '1.7'){
    	$warna = 'red';
    }else if($score >= '1.71' and $score <= '2.5' ){
    	$warna = 'salmon';//merah muda
    }else if($score >= '2.51' and $score <= '3.20' ){
    	$warna = 'yellow';
    }else if($score >= '3.21' and $score <= '4.1' ){
      $warna = '#ADFF2F';//hijau muda	
    }else if($score >= '4.11' and $score <= '5.0' ){
    	$warna = 'green';
    }else{
  		$warna = '#fff';
  	}
		
		return $warna;
	}

	public static function getNameNode($id){	
		
		$sql = DB::table('statements AS s')
			->select('s.title')
			->where(['s.id' => $id])
			->first();
		
		return $sql->title;

	}

	public static function getCountValTeam($PersonID, $Date, $Tim = null){	
		if($Tim == 'team'){
				$sql = DB::table('rangeproducts AS rp')
								->select('rp.nilai')
								->leftJoin('users AS u', function ($join) {
												$join->on('u.id', '=', 'rp.user_id');
											})
								->leftJoin('ssclubs AS ss', function ($join) {
												$join->on('ss.ClubGroup', '=', 'u.id')
												->where('ss.Active', 1);
											})
								->where(['ss.ClubGroup' => $PersonID, 'rp.Active' => 1])
								//->where('date_format(rp.date, "%Y-%m")', $Date)
								->whereRaw("DATE_FORMAT(rp.date, '%Y-%m') = '".$Date."'")
								->count();
		}else{
				$sql = DB::table('rangeproducts AS rp')
								->select('rp.nilai')
								->where(['rp.user_id' => $PersonID, 'rp.Active' => 1])
								//->where('date_format(rp.date, "%Y-%m")', $Date)
								->whereRaw("DATE_FORMAT(rp.date, '%Y-%m') = '".$Date."'")
								->count();
		}
			
		return $sql;
	}
}
