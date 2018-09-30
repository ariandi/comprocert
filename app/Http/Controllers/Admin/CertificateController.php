<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Menus;
use Input;
use DataTables;
use Storage;
use App\Entities\Admin\Certificate;
use App\Entities\Admin\Company;

class CertificateController extends Controller
{

    private $cons = [
        'status' => ['active' => 'Active', 'suspend' => 'Suspend', 
                        'withdraw' => 'Withdraw', 'hide' => 'Hide']
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.certificates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::pluck('CompanyName', 'id')->all();
        $status = $this->cons['status'];
        $cert = new Certificate();
        return view('admin.certificates.create', ['companies' => $companies,
                                                    'status' => $status,
                                                    'cert' => $cert]);
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
            'company_id' => 'required',
            'certificate_no' => 'required',
            'file' => 'required|max:2000',
        ]);

        $input = $request->all();
        $input['company_name'] = Company::find($request->company_id)->CompanyName;
        $input['status'] = 'active';

        if(Input::hasFile('file')){
            $uploadedFile = $request->file('file');
            $path = $uploadedFile->store('public/files');
            $input['file'] = $path;
        }

        $cert = Certificate::create($input);

        if($cert){
            return redirect()->route('certificates.edit', $cert->id)
                        ->with('success','Success to create certificate.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $cert = Certificate::where(['company_name' => $request->company_name, 
                                    'certificate_no' => $request->certificate_no])
                ->first();

        if($cert && $cert->status == 'active'){
            return redirect()->back()
                        ->with(['success' => 'Certificate found and valid', 'cert' => $cert]);
        }elseif ($cert && $cert->status != 'hide') {
            return redirect()->back()
                        ->with(['failed' => 'Certificate found and '.$cert->status, 'cert' => $cert]);
        }

        $cert = new Certificate();
        $cert->company_name = $request->company_name;
        $cert->certificate_no = $request->certificate_no;
        return redirect()->back()
                        ->with(['failed' => 'Certificate not found', 'cert' => $cert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::pluck('CompanyName', 'id')->all();
        $status = $this->cons['status'];
        $cert = Certificate::find($id);
        return view('admin.certificates.edit', ['companies' => $companies,
                                                    'status' => $status,
                                                    'cert' => $cert]);
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
        $this->validate($request, [
            'company_id' => 'required',
            'certificate_no' => 'required',
            'file' => 'nullable|max:2000',
        ]);

        $input = $request->all();
        $input['company_name'] = Company::find($request->company_id)->CompanyName;

        if(Input::hasFile('file')){
            $uploadedFile = $request->file('file');
            $path = $uploadedFile->store('public/files');
            $input['file'] = $path;
        }

        $cert = Certificate::find($id);
        if($cert){
            $cert = $cert->update($input);

            if($cert){
                return redirect()->route('certificates.edit', $id)
                            ->with('success','Success to update certificate.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cert = Certificate::find($id)->delete();

        if($cert){
            return redirect()->back();
        }
    }

    public function getDatatablesData()
    {
        $certificates = Certificate::query();

        return DataTables::of($certificates)
                ->editColumn('file', function ($certificates) {
                                return '<a href="'.url(Storage::url($certificates->file)).'">'.$certificates->file.'</a>'
                                        ;
                            })
                ->editColumn('created_at', function ($certificates) {
                                return date('d F y', strtotime($certificates->created_at));
                            })
                ->addColumn('action', function ($certificates) {

                        $delete = '';
                        if(Auth::user()->role == 'admin'){
                            $delete = '<form method="post" action="'.route('certificates.destroy', $certificates->id).'" 
                                        style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <button class="btn btn-xs btn-danger">
                                            Delete
                                        </button>
                                        </form>';
                        }

                        return '<a href="'.route('certificates.edit', ['id' => $certificates->id]).'" class="btn btn-xs btn-primary editProds">
                                    Edit
                                </a> '.$delete;
                                        })
                ->rawColumns(['action', 'file'])
                ->make(true);
    }
}
