<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use DataTables;
use Input;
use App\Entities\Admin\Role;
use App\Entities\Admin\Roleaction;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        $role->Active = 1;
        return view('admin.roles.create', ['role' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'RoleName' => 'required',
        ]);


        $input = $request->all();

        $role = Role::create($input);
        return redirect()->route('roles.edit', $role->id)
                        ->with('success','Role created successfully');
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
        $role = Role::find($id);
        return view('admin.roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roleUpdate  = Role::where('id',$id)->first();
        if ($roleUpdate) {
           $role = $roleUpdate->update($request->all());
        }

        return redirect()->route('roles.edit', $id)
                        ->with('success','Company update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDatatablesData()
    {
        $roles = Role::where('Active', 1);

        return DataTables::of($roles)
                ->addColumn('action', function ($roles) {

                                $edit = ' <a href="'.route('roles.edit', ['id' => $roles->id]).'" class="btn btn-xs btn-primary editProds">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>';
                                $delete = ' <a href="'.route('roles.edit', ['id' => $roles->id]).'" class="btn btn-xs btn-danger editProds">
                                            <i class="glyphicon glyphicon-zoom-in"></i> Danger
                                        </a>';

                                return $edit.$delete;
                            })
                ->rawColumns(['Description', 'action'])
                ->make(true);
    }

    public function getRoleActionList()
    {
        return view('admin.roles.role-action-list');
    }

    public function getDatatablesDataAction()
    {
        $where = [
            ['RoleID', '!=', 0],
            ['Module', '!=', ''],
            ['Action', '!=', ''],
        ];
        $roles = Roleaction::where($where);

        return DataTables::of($roles)
                ->addColumn('action', function ($roles) {

                                $edit = ' <a href="'.route('roles.edit', ['id' => $roles->id]).'" class="btn btn-xs btn-primary editProds">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>';
                                $delete = ' <a href="'.route('roles.edit', ['id' => $roles->id]).'" class="btn btn-xs btn-danger editProds">
                                            <i class="glyphicon glyphicon-zoom-in"></i> Danger
                                        </a>';

                                return $edit.$delete;
                            })
                ->rawColumns(['Description', 'action'])
                ->make(true);
    }

    public function roleActionCreate()
    {
        $role = new Roleaction();
        $role->Access = 1;
        $role->ChangedByPersonID = Auth::user()->id;
        $role->CreatedByPersonID = Auth::user()->id;

        $roles = Role::where('Active', 1)
                ->where([['RoleName', '!=', '']])
                ->orderBy('RoleName')->get();

        return view('admin.roles.create-action', ['role' => $role, 'roles' => $roles]);
    }

    public function roleActionStore(Request $request)
    {
        $this->validate($request, [
            'Module' => 'required',
            'Action' => 'required',
            'RoleID' => 'required',
        ]);


        $input = $request->all();

        $roleAction = Roleaction::create($input);
        return redirect()->route('roles.role-action-edit', $roleAction->id)
                        ->with('success','Company created successfully');
    }

    public function roleActionEdit($id)
    {
        $role = Roleaction::find($id);
        
        $roles = Role::where('Active', 1)
                ->where([['RoleName', '!=', '']])
                ->orderBy('RoleName')->get();

        return view('admin.roles.edit-action', ['role' => $role, 'roles' => $roles]);
    }

    public function roleActionUpdate(Request $request, $id)
    {
        $roleUpdate  = Roleaction::where('id',$id)->first();
        if ($roleUpdate) {
           $role = $roleUpdate->update($request->all());
        }

        return redirect()->route('roles.role-action-edit', $id)
                        ->with('success','Company update successfully');
    }
}
