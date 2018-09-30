<?php

namespace Ariandin1411\Menus;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
//use Empatix\Menu\QueryMenu;

use Illuminate\Support\Facades\DB;
use Auth;

class Menus
{
	public static $options = [];

	public function __construct()
	{
		if( !session()->has('LanguageID') ){
        	session(['LanguageID' => 'no']);
        }
	}

	public static function getNavbar($params)
	{
		if(! isset($params['NodeID']) ){
			return 'No NodeID Selected';
		}

		$where = [
			['ns.parent_node_id', '=', $params['NodeID']],
			['n.active', '=', '1'],
		];

		$data = DB::table('nodestructures AS ns')
		->select('n.alias', 'n.title', 'n.id', 'n.template', 'ms.path As medianode1', 
					'ms2.Path As medianode2', 'ms3.Path As medianode3', 'ms4.Path As medianode4',
					'n.content1', 'n.content2', 'n.content3', 'n.content4', 'n.created_at')
		->leftJoin('nodes AS n', function ($join) {
			$join->on('n.id', '=', 'ns.child_node_id')
				 ->where('ns.active', '1');
		})
		->leftJoin('mediastorages AS ms', function ($join) {
			$join->on('n.media1', '=', 'ms.id')
				 ->where('ms.active', '1');
		})
		->leftJoin('mediastorages AS ms2', function ($join) {
			$join->on('n.media2', '=', 'ms2.id')
				 ->where('ms2.active', '1');
		})
		->leftJoin('mediastorages AS ms3', function ($join) {
			$join->on('n.media3', '=', 'ms3.id')
				 ->where('ms3.active', '1');
		})
		->leftJoin('mediastorages AS ms4', function ($join) {
			$join->on('n.media4', '=', 'ms4.id')
				 ->where('ms4.active', '1');
		})
		->where($where)
		->orderBy('ns.priority', 'ASC');

		if( isset($params['WhereIn']) ){
			$data->whereIn('ns.child_node_id', $params['WhereIn']);
		}

		if( isset($params['whereNotIn']) ){
			$data->whereNotIn('ns.child_node_id', $params['whereNotIn']);
		}

		if( isset($params['offset']) ){
			$data->offset($params['offset']);
		}

		if( isset($params['limit']) ){
			$data->limit($params['limit']);
		}

		return $data->get();
	}

	public static function getNavbarWithImg($limit = null)
	{
		return (new QueryMenu)->getNavImg(self::$options['parent_id'], $limit);
	}

	public static function linkChangeLanguage($countryCode)
	{
		return 'Nanti Dlu';
	}

	public static function getNodeWithImg($params)
	{
		if(! isset($params['NodeID']) ){
			return 'No NodeID Selected';
		}

		$where = [
			['n.id', '=', $params['NodeID']],
			['n.active', '=', '1'],
		];

		$data = DB::table('nodes AS n')
		->select('n.alias', 'n.title', 'n.id', 'ms.path As medianode1', 'ms2.Path As medianode2',
					'ms3.Path As medianode3', 'ms4.Path As medianode4',
					'n.content1', 'n.content2', 'n.content3', 'n.content4')

		->leftJoin('mediastorages AS ms', function ($join) {
			$join->on('n.media1', '=', 'ms.id')
				 ->where('ms.active', '1');
		})
		->leftJoin('mediastorages AS ms2', function ($join) {
			$join->on('n.media2', '=', 'ms2.id')
				 ->where('ms2.active', '1');
		})
		->leftJoin('mediastorages AS ms3', function ($join) {
			$join->on('n.media3', '=', 'ms3.id')
				 ->where('ms3.active', '1');
		})
		->leftJoin('mediastorages AS ms4', function ($join) {
			$join->on('n.media4', '=', 'ms4.id')
				 ->where('ms4.active', '1');
		})
		->where($where)
		->orderBy('n.id', 'ASC');

		$data = $data->first();

		return $data;
	}

	public static function getLanguageString($lang, $langID = null)
	{
		if($langID != null){
			$langID = $langID;
		}else{
			$langID = session()->get('LanguageID');
		}

		$where = [
			['language_string_text_id', '=', $lang],
			['language_id', '=', $langID],
		];

		$data = DB::table('languagestrings')
		->select('language_string')
		->where($where)
		->first();

		if(is_object($data)){
			return $data->language_string;
		}else{
			return $lang;
		}
	}

	public static function getLangNode()
	{

		if(session()->get('LanguageID') == 'no'){
        $nodeLang = 32;
    }else if(session()->get('LanguageID') == 'en'){
        $nodeLang = 49;
    }else{
        $nodeLang = 32;
    }

    return $nodeLang;
	}

	public static function getLangNodeOther()
	{
		$nodeLang = (object) "";
		if(session()->get('LanguageID') == 'no'){
        $nodeLang->om_oss = 3;
        $nodeLang->digital = 26;
        $nodeLang->change66 = 27;
        $nodeLang->course = 28;
        $nodeLang->consultant = 29;
        $nodeLang->node_samping = 2;
        $nodeLang->omoss_samping = 34;
    }else if(session()->get('LanguageID') == 'en'){
        $nodeLang->om_oss = 51;
        $nodeLang->digital = 55;
        $nodeLang->change66 = 56;
        $nodeLang->course = 57;
        $nodeLang->consultant = 58;
        $nodeLang->node_samping = 50;
        $nodeLang->omoss_samping = 60;
    }else{
        $nodeLang->om_oss = 3;
        $nodeLang->digital = 26;
        $nodeLang->change66 = 27;
        $nodeLang->course = 28;
        $nodeLang->consultant = 29;
        $nodeLang->node_samping = 2;
        $nodeLang->omoss_samping = 34;
    }

    return $nodeLang;
	}

	public static function setButton($params)
	{
		if(!Auth::check()){
			return 'this function only for user logged in';
		}

		$attribute = " ";

		if(!isset($params['value'])){
			return 'Invalid attribute for button';
		}

		if(isset($params['class'])){
			$attribute .= " class='".$params['class']."'";
		}

		if(isset($params['type'])){
			$attribute .= " type='".$params['type']."'";
		}

		if(isset($params['id'])){
			$attribute .= " id='".$params['id']."'";
		}

		if(isset($params['name'])){
			$actionName = explode("_", $params['name']);
		}

		$where = [
			['rp.user_id', '=', Auth::user()->id],
			['rp.Active', '=', '1'],
		];

		$getRoles = DB::table('rolepeople AS rp')
		->select('rp.RoleID')
		->where($where)
		->get();

		$roles = [];
		foreach ($getRoles as $kRole => $vRole) {
			$roles[] = $vRole->RoleID;
		}

		$where2 = [
			['ra.Module', '=', $actionName[1]],
			['ra.Action', '=', $actionName[2]],
		];

		$getRoleAction = DB::table('roleactions AS ra')
		->select('ra.id')
		->where($where2)
		->whereIn('ra.RoleID', $roles)
		->count();

		if($getRoleAction > 0){
			return '<button '.$attribute.'>'.$params['value'].'</button>';
		}
		return '';
	}

	public static function getJsonPostData($url, $data)
	{
		// $url = 'https://www.wisehouse.no/internett1/cekperson.php';
  //       $data = ['username' => 'db_duabelas@yahoo.com', 'password' => '433205ari', 'authenLogin' => 1];
        $url = $url;
        $data = $data;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
	}

	public static function getJsonPostDataNew($url, $data)
	{
        #$url = 'https://www.wisehouse.no/internett1/index.php?t='.$url;
        $data = $data;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            #echo $response;
            return json_decode($response);
        }
	}

}
