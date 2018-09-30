<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use DataTables;
use Input;
use App\Entities\Admin\Company;
use App\Entities\Admin\Companypersonstruct;
use App\Entities\Admin\CompanyRelationStruct;
use App\Entities\Admin\Companystructure;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent = 0;
        if(Input::has('parent')){
            $parent = Input::get('parent');
        }

        $company = new Company();
        $arrLangList = [ 'en' => 'English', 'no' => 'Norwegian', 'pl' => 'Polish', 'id' => 'Indonesian'];
        return view('admin.company.list', ['company' => $company, 'arrLangList' => $arrLangList, 'parent' => $parent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getCompany = new Company();
        $getCompany->Active = 1;
        $langList = [
                        ['key' => 'en', 'value' => 'English'],
                        ['key' => 'no', 'value' => 'Norwegian'],
                        ['key' => 'pl', 'value' => 'Polish'],
                        ['key' => 'id', 'value' => 'Indonesian']
                    ];
        $classification = [
            ['key' => 1, 'val' => 'Root'],
            ['key' => 2, 'val' => 'Root 2'],
            ['key' => 3, 'val' => 'Do not display',],
            ['key' => 4, 'val' => 'Custommer',],
            ['key' => 6, 'val' => 'Customer 2',],
        ];

        $type = [
            ['key' => 1, 'val' => 'OH Trail'],
            ['key' => 2, 'val' => 'OH Light'],
            ['key' => 3, 'val' => 'OH Standard',],
            ['key' => 4, 'val' => 'OH Pro',],
            ['key' => 5, 'val' => 'OH Standard',],
            ['key' => 6, 'val' => 'OH Pro',],
            ['key' => 7, 'val' => 'OH Expire',],
        ];

        return view('admin.company.create', ['company' => $getCompany, 
                                            'langList' => $langList, 
                                            'classification' => $classification,
                                            'type' => $type]);
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
            'CompanyName' => 'required',
        ]);


        $input = $request->all();

        $company = Company::create($input);
        return redirect()->route('companies.edit', $company->id)
                        ->with('success','Company created successfully');
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
        $getCompany = Company::find($id);
        $getCompany->Active = 1;

        $template = 'edit';

        $langList = [
                        ['key' => 'en', 'value' => 'English'],
                        ['key' => 'no', 'value' => 'Norwegian'],
                        ['key' => 'pl', 'value' => 'Polish'],
                        ['key' => 'id', 'value' => 'Indonesian']
                    ];
        $classification = [
            ['key' => 1, 'val' => 'Root'],
            ['key' => 2, 'val' => 'Root 2'],
            ['key' => 3, 'val' => 'Do not display',],
            ['key' => 4, 'val' => 'Custommer',],
            ['key' => 6, 'val' => 'Customer 2',],
        ];

        $type = [
            ['key' => 1, 'val' => 'OH Trail'],
            ['key' => 2, 'val' => 'OH Light'],
            ['key' => 3, 'val' => 'OH Standard',],
            ['key' => 4, 'val' => 'OH Pro',],
            ['key' => 5, 'val' => 'OH Standard',],
            ['key' => 6, 'val' => 'OH Pro',],
            ['key' => 7, 'val' => 'OH Expire',],
        ];

        if(Input::has('ajax')){
            $template = 'edit-ajax';
        }

        return view('admin.company.'.$template, ['company' => $getCompany, 
                                            'langList' => $langList, 
                                            'classification' => $classification,
                                            'type' => $type]);
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
        $companyUpdate  = Company::where('id',$id)->first();
        if ($companyUpdate) {
           $company = $companyUpdate->update($request->all());
        }

        return redirect()->route('companies.edit', $id)
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
        $company = Company::find($id)->delete();

        return redirect()->back();
    }

    public function getDatatablesData($parent = 0)
    {
        $company = Company::select(['companies.id', 'companies.CompanyName', 'companies.Discount', 'companies.OrgNumber', 
                                    'companies.ExternalID', 'companies.DCity'])
                    ->join('companystructures AS cs', 'cs.ChildCompanyID', '=', 'companies.id')
                    ->where(['companies.Active' => 1, 'cs.Active' => 1, 'cs.ParentCompanyID' => $parent]);

        // dd($company->toSql());

        return DataTables::of($company)
                ->editColumn('UnitCostPrice', function ($company) {
                                return number_format($company->Discount, 2);
                            })
                ->addColumn('action', function ($company) {

                                $companyStructure = Companystructure::where(['ParentCompanyID' => $company->id, 'Active' => 1])
                                                    ->count();

                                $edit = ' <a href="'.route('companies.edit', ['id' => $company->id]).'" class="btn btn-xs btn-primary editProds">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>';
                                $child = ' <a href="'.route('companies.index', ['parent' => $company->id]).'" class="btn btn-xs btn-warning editProds">
                                            <i class="glyphicon glyphicon-th-large"></i> See Child 
                                        </a>';
                                $detail = ' <a href="'.route('companies.edit', ['id' => $company->id]).'" class="btn btn-xs btn-success editProds">
                                            <i class="glyphicon glyphicon-zoom-in"></i> See Detail
                                        </a>';

                                $delete = '';
                                if(Auth::user()->role == 'admin'){
                                    $delete = '<form method="post" action="'.route('companies.destroy', $company->id).'" 
                                            style="display: inline;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                            <button class="btn btn-xs btn-danger">
                                                Delete
                                            </button>
                                            </form>';
                                }

                                if($companyStructure <= 0){
                                    $child = '';
                                }

                                return $edit.$child.$detail.$delete;
                            })
                ->make(true);
    }

    public function getEmployee($id)
    {
        $company = Company::find($id);
        $companyPersonStruct = Companypersonstruct::select('u.first_name', 'u.last_name', 'u.email', 'u.id')
                                ->join('users AS u', 'u.id', '=', 'companypersonstructs.user_id')
                                ->where(['companypersonstructs.CompanyID' => $id, 
                                        'companypersonstructs.Active' => 1,
                                        'u.active' => 1])->get();

        return view('admin.company.get-employee', ['company' => $company, 
                                            'companyPersonStruct' => $companyPersonStruct]);
    }

    public function getRelatedCompany($id)
    {
        $company = Company::find($id);
        $companyAll = Company::where('Active', 1)
                        ->where([['CompanyName', '!=', '']])
                        ->whereNotIn('id', [$id])
                        ->orderBy('CompanyName', 'ASC')
                        ->get();
        $companyRelationStruct = CompanyRelationStruct::where(['FromCompanyID' => $id, 'Active' => 1])
                                    ->get();

        return view('admin.company.get-related-company', ['company' => $company, 
                                            'companyRelationStruct' => $companyRelationStruct,
                                            'companyAll' => $companyAll]);
    }

    public function  saveRelatedCompany(Request $request)
    {
        $input = $request->all();

        $request = CompanyRelationStruct::create($input);
        return ['error' => 0];
    }
}
