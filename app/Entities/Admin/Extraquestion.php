<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Extraquestion extends Model
{
    protected $fillable = ['user_id','ProductID','NodeID','Score','Comment','Date',
    												'Active','page','PageMobile','ChangedByPersonID','CreatedByPersonID',
    											];

    public static function delScore($params)
    {
    	$mytime = \Carbon\Carbon::now();
    	$del = Extraquestion::where(['Active' => 3, 'NodeID' => $params['NodeID'], 
    																'page' => $params['Page'], 'user_id' => $params['PersonID']])
    											->where([['Date', '<=', date('Y-m-d', strtotime( $mytime->toDateTimeString() ))]])
    											->delete();
    	
    	return true;
    }

    public static function inputScore($params)
    {
    	$mytime = \Carbon\Carbon::now();
    	$dateMonth = date('Y-m', strtotime( $mytime->toDateTimeString() ));
    	//dd($dateMonth);
    	foreach ($params['ProductID'] as $Produk => $prd){
				$querys = Extraquestion::updateOrCreate(
					[
						'user_id' => $params['PersonID'],
						'ProductID' => $prd,
						'NodeID' => $params['NodeID'],
						'NodeID' => $params['NodeID'],
						'Date' => Extraquestion::where('Date', 'LIKE', $dateMonth.'%')->first()->Date ?? null,
						'page' => $params['Page'],
					],
					[
						'Active' => 3,
						'Score' => $params['Score'][$Produk],
						'Date' => date('Y-m-d', strtotime( $mytime->toDateTimeString() )),
						'ChangedByPersonID' => \Auth::user()->id,
						'CreatedByPersonID' => \Auth::user()->id,
					]
				);
    	}

    	if($params['Last'] == 1){
    		self::inputScoreLast($params);
    	}

    	return true;
    }

    public static function inputScoreLast($params)
    {
    	$mytime = \Carbon\Carbon::now();
    	$dateMonth = date('Y-m', strtotime( $mytime->toDateTimeString() ));
			$sql = Extraquestion::where(['NodeID' => $params['NodeID'], 'user_id' => $params['PersonID'], 'Active' => 3])
														->whereRaw('DATE_FORMAT(Date, "%Y-%m") = ?', [$dateMonth])
														->update(['Active' => 1]);

			return true;
    }
}
