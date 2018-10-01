<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Entities\Admin\Companypersonstruct;
use App\Entities\Admin\Ssclub;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'gender', 'birth_date', 'no_hp', 'email', 'password', 
        'profile_img', 'lang_id', 'company', 'role', 'active', 'username', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function companypersonstructs()
    {
        return $this->hasMany('App\Entities\Admin\Companypersonstruct');
    }

    public static function api_syncPerson($users)
    {
        foreach ($users as $user) {
            $hasUser = User::where('email', $user->Email);

            if($user->BirthDate == '0000-00-00 00:00:00' || $user->BirthDate == ''){
                $user->BirthDate = '2000-00-00 00:00:00';
            }

            $data = User::updateOrCreate(
                [
                    'email' => $user->Email
                ], 
                [
                    'name' => $user->FirstName . ' ' . $user->LastName,
                    'first_name' => $user->FirstName, 
                    'last_name' => $user->LastName, 
                    'gender' => substr($user->Gender, 0, 1),
                    'birth_date' => date('Y-m-d', strtotime($user->BirthDate)), 
                    'no_hp' => $user->MobilePhoneNumber, 
                    'email' => $user->Email, 
                    'password' => (($hasUser->count() < 1) ? Hash::make(123456):$hasUser->first()->password),
                    'profile_img' => 'internett1/demojm/images/user_default_img.png',
                    'lang_id' => $user->LanguageID, 
                    'active' => 1,
                    'username' => $user->Email,
                ]
            );

            # The API CompanyID parameter still using comma as seperator for multiple CompanyID, Don't change it !
            if (is_array($idCompanies = explode(',', $user->CompanyID))) {
                if ($idCompanies[0]) {
                    Companypersonstruct::where('user_id', $data->id)->delete();

                    $companies = [];
                    for ($i = 0; $i < count($idCompanies); $i++) {
                        $companies[] = [
                            'user_id' => $data->id,
                            'CompanyID' => $idCompanies[$i],
                            // 'InsertedByPersonID' => \Auth::user()->id,
                            // 'UpdatedByPersonID' => \Auth::user()->id,
                        ];
                    }

                    User::find($data->id)
                        ->companypersonstructs()
                        ->createMany($companies);
                }
            }
        }

        return TRUE;
    }


    public static function api_storePerson($apiURI, $user)
    {
        $data = User::create([
            'name' => $user['firstName'] . ' ' . $user['lastName'],
            'username' => $user['email'],
            'first_name' => $user['firstName'],
            'last_name' => $user['lastName'],
            'gender' => $user['gender'],
            'birth_date' => date('Y-m-d', strtotime($user['birthDate'])),
            'no_hp' => $user['mobilePhoneNumber'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
            'profile_img' => 'internett1/demojm/images/user_default_img.png',
            'lang_id' => $user['languageID'],
            'active' => 1,
            'role' => $user['role']
        ]);

        $companies = [];
        for ($i = 0; $i < count($user['company']); $i++) {
            $companies[] = [
                'user_id' => $data->id,
                'CompanyID' => $user['company'][$i],
                'InsertedByPersonID' => \Auth::user()->id,
                'UpdatedByPersonID' => \Auth::user()->id,
            ];
        }
        User::find($data->id)
        ->companypersonstructs()
        ->createMany($companies);

        return TRUE;
    }

    public static function getPersonTeam($id)
    {
        $companypersonstructs = self::getCompanyTeam($id);
        $arrCompanyID = [];
        foreach ($companypersonstructs as $key => $value) {
            $arrCompanyID[] = $value->CompanyID;
        }

        $team = User::select('users.id AS user_id', 'users.first_name', 'users.last_name', 'users.email', 'ss.id', 
                                'ss.Active AS SActive', 'cp.CompanyID')
                ->leftJoin('companypersonstructs AS cp', 'cp.user_id', '=', 'users.id')
                ->leftJoin('ssclubs AS ss', function ($join) use($arrCompanyID){
                    $join->on('ss.ClubName', '=', 'users.id')
                    ->where('ss.Active',1)
                    ->whereIn('ss.ClubBranch', $arrCompanyID);
                })
                ->where(['cp.Active' => 1, 'users.active' => 1])
                ->where([['users.id', '!=', $id]])
                ->whereIn('cp.CompanyID', $arrCompanyID)
                ->get();

        return $team;
    }

    public static function getCompanyTeam($id)
    {
        $companypersonstructs = Companypersonstruct::select('c.id AS CompanyID', 'c.CompanyName')
                                ->join('companies AS c', 'c.id', '=', 'companypersonstructs.CompanyID')
                                ->where('c.Active', 1)
                                ->where([['companypersonstructs.Active', '>', 0],['companypersonstructs.user_id', '=', $id]])
                                ->get();

        return $companypersonstructs;
    }


    public static function getApiData($url, $data)
    {
        $url = 'https://www.wisehouse.no/internett1/index.php?t='.$url;
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

    public static function api_updatePerson($apiURI, $id, $user)
    {
        $data = User::find($id);

        $data->update([
            'name' => $user['firstName'] . ' ' . $user['lastName'],
            'first_name' => $user['firstName'],
            'last_name' => $user['lastName'],
            'gender' => $user['gender'],
            'birth_date' => date('Y-m-d', strtotime($user['birthDate'])),
            'no_hp' => $user['mobilePhoneNumber'],
            'email' => $user['email'],
            'password' => (( ! $user['password']) ? $data->password:Hash::make($user['password'])),
            'profile_img' => 'internett1/demojm/images/user_default_img.png',
            'lang_id' => $user['languageID'],
            'role' => $user['role']
        ]);

        $isCompanyUpdate = FALSE;

        Companypersonstruct::where('user_id', $id)->delete();

        $companies = [];
        for ($i = 0; $i < count($user['company']); $i++) {
            $companies[] = [
                'user_id' => $id,
                'CompanyID' => $user['company'][$i],
                'InsertedByPersonID' => \Auth::user()->id,
                'UpdatedByPersonID' => \Auth::user()->id,
            ];
        }

        $data
            ->companypersonstructs()
            ->createMany($companies);

        $isCompanyUpdate = TRUE;

        return TRUE;
    }
}
