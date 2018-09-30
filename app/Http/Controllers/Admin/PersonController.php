<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerson,
    App\Http\Requests\UpdatePerson;
use App\User;
use Auth,
    Session,
    DataTables,
    Input;
use App\Entities\Admin\Company;
use App\Entities\Admin\Roleperson;
use App\Entities\Admin\Role;
use App\Entities\Admin\Companypersonstruct;

class PersonController extends Controller
{
    private
        $apiURI = 'publish.api_person',
        $constant = [
            'languages' => ['en' => 'English', 'no' => 'Norway', 'pl' => 'Polish', 'id' => 'Indonesia'],
            'roles' => ['admin' => 'Admin', 'viewer' => 'Viewer']
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.person.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::where('Active',1)->get();
        return view('admin.person.create', [
            'languages' => $this->constant['languages'],
            'roles' => $this->constant['roles'],
            'companies' => $company
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerson $request)
    {
        User::api_storePerson($this->apiURI, $request->validated());

        return redirect()
            ->route('persons.index')
            ->with('success','Data person has been inserted.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.person.edit', [
            'languages' => $this->constant['languages'],
            'roles' => $this->constant['roles'],
            'companies' => Company::where([['Active', '=', 1], ['CompanyName', '!=', '']])->orderBy('CompanyName', 'ASC')->get(),
            'user' => [
                'data' => User::find($id),
                'hasCompany' => array_column(User::find($id)->companypersonstructs->toArray(), 'CompanyID'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerson $request, $id)
    {
        // dd($request);
        $user = User::find($id);
        if($user){
            $dataCompany = $request->companies;

            $userUpdate = $user->update($request->all());

            if($userUpdate){

                Companypersonstruct::where('user_id', $id)->delete();

                $companies = [];
                for ($i = 0; $i < count($dataCompany); $i++) {
                    $companies[] = [
                        'user_id' => $id,
                        'CompanyID' => $dataCompany[$i],
                        'InsertedByPersonID' => \Auth::user()->id,
                        'UpdatedByPersonID' => \Auth::user()->id,
                    ];
                }

                $user->companypersonstructs()->createMany($companies);

                return redirect()
                        ->back()
                        ->with('success','Data person has been updated.');
            }
        }

        return 'Gagal';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return redirect()
                        ->back()
                        ->with('success','Data person has been deleted.');
    }

    public function sync()
    {        
        $userSync = User::api_syncPerson(User::getApiData($this->apiURI, [
            'method' => __FUNCTION__
        ]));
        
        if($userSync){
            return 'Success';
        }

        return 'Failed';
    }

    public function getAPI()
    {
        $data = User::select(['first_name', 'last_name', 'email']);

        return DataTables::of(User::query())->addColumn('action', function ($data) {
            $delete = '';
            if(Auth::user()->role == 'admin'){
                $delete = '<form method="post" action="'.route('persons.destroy', $data->id).'" 
                                                style="display: inline;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                                <button class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                                </form>';
            }

            return '
                <a href="' . route('persons.edit', [$data->id]) . '" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a> '.$delete;
        })->make(true);
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if($user = User::where('email', $email)->first()){
            $credentials = [
                'email' => $email,
                'password' => $password,
            ];

            $arrCompany = [];
            $company = $user::getCompanyTeam($user->id);
            foreach ($company as $key => $value) {
                $arrCompany[] = $value->CompanyName;
            }
            $company = implode(',', $arrCompany);

            $response = [
                'msg' => 'User Success to login',
                'userData' => $user,
                'FromApp' => 'Change66',
                'error' => 0,
                'LanguageID' => $user->lang_id,
                'PersonID' => $user->id,
                'username' => $user->email,
                'userCompany' => $company,
            ];

            return response()->json($response, 201);
        }

        $response = [
            'msg' => 'An error occurred',
            'error' => 1,
        ];

        return response()->json($response, 404);
    }

    public function register(Request $request)
    {
        
        $user = new User();
        $user->first_name = $request->input('firstname');
        $user->last_name = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->lang_id = 'en';

        if($user->save()){
            $company = new Companypersonstruct();
            $company->CompanyID = $request->input('companyid');
            $company->user_id = $user->id;
            $company->InsertedByPersonID = Auth::user()->id;
            $company->UpdatedByPersonID = Auth::user()->id;

            if($company->save()){
                    $response = [
                    'msg' => 'User Success to login',
                    'userData' => $user,
                    'FromApp' => 'Change66',
                    'error' => 0,
                    'LanguageID' => $user->lang_id,
                    'PersonID' => $user->id,
                    'username' => $user->email,
                    'userCompany' => $company,
                ];

                return response()->json($response, 201);
            }
            
        }

        $response = [
            'msg' => 'An error occurred',
            'error' => 1,
        ];

        return response()->json($response, 404);
    }

    public function editAjax($id)
    {
        return view('admin.person.edit-ajax', [
            'languages' => $this->constant['languages'],
            'roles' => $this->constant['roles'],
            'companies' => Company::where([['Active', '=', 1], ['CompanyName', '!=', '']])->orderBy('CompanyName', 'ASC')->get(),
            'user' => [
                'data' => User::find($id),
                'hasCompany' => array_column(User::find($id)->companypersonstructs->toArray(), 'CompanyID'),
            ]
        ]);
    }

    public function personRole($user_id)
    {
        $rolePerson = Roleperson::select('rolepeople.RoleID', 'r.RoleName', 'r.Description', 'rolepeople.id')
                        ->join('roles AS r', 'r.id', '=', 'rolepeople.RoleID')
                        ->where(['rolepeople.user_id' => $user_id, 'rolepeople.Active' => 1, 'r.Active' => 1])
                        ->orderBy('RoleID', 'ASC')->get();

        return view('admin.person.person-role', [
            'rolePerson' => $rolePerson,
            'user' => [
                'data' => User::find($user_id),
                'hasCompany' => array_column(User::find($user_id)->companypersonstructs->toArray(), 'CompanyID'),
            ]
        ]);
    }

    public function listOfRole($user_id)
    {
        $rolePerson = Roleperson::join('roles AS r', 'r.id', '=', 'rolepeople.RoleID')
                        ->where(['rolepeople.user_id' => $user_id, 'rolepeople.Active' => 1, 'r.Active' => 1])
                        ->orderBy('RoleID', 'ASC')->get();

        $arrNot = [];
        foreach ($rolePerson as $key => $value) {
            $arrNot[] = $value->RoleID;
        }

        $roles = Role::where('Active', 1)->whereNotIn('id', $arrNot);

        $aduh = $user_id;

        return DataTables::of($roles)
                ->addColumn('action', function ($roles) use($aduh) {
                                global $user_id;

                                $insert = ' <form method="post" 
                                                action="'.route('persons.input-person-role', ['user_id' => $aduh, 'role_id' => $roles->id]).'" id="personRoleForm"
                                                style="display: inline;">
                                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                                <input type="hidden" id="user_id_'.$roles->id.'" value="'.$aduh.'">
                                                <button type="submit" 
                                                class="btn btn-success btn-sm insertRole" role_id="'.$roles->id.'">Insert</button>
                                                </form>';

                                return $insert;
                            })
                ->rawColumns(['Description', 'action'])
                ->make(true);
    }

    public function inputPersonRole($user_id, $role_id)
    {
        $rolePerson = new Roleperson();
        $rolePerson->RoleID = $role_id;
        $rolePerson->user_id = $user_id;
        $rolePerson->CompanyID = 0;
        $rolePerson->Active = 1;
        $rolePerson->ChangedByPersonID = Auth::user()->id;
        $rolePerson->CreatedByPersonID = Auth::user()->id;

        if($rolePerson->save()){
            return ['error' => 0];
        }

        return ['error' => 1];
    }

    public function deletePersonRole($id)
    {
        $rolePerson = Roleperson::find($id);
        if($rolePerson){
            if($rolePerson->delete()){
                return ['error' => 0];
            }
        }

        return ['error' => 1];
    }
}