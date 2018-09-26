<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Input;
use DataTables;
use App\Entities\Admin\Statement;
use App\Entities\Admin\Statementstruct;
use App\Entities\Admin\Product;
use App\Entities\Admin\Producttext;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['lvl1Val' => 0]);
        $lvl = 1;

        if(Input::has('lvl')){
            $lvl = Input::get('lvl');
        }

        $statementstr = Statementstruct::where(['parent_id' => 0, 'active' => 1])
                        ->orderBy('priority', 'ASC')
                        ->get();
        return view('admin.statements.index', ['statementstr' => $statementstr, 'lvl' => $lvl]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session(['lvl1Val' => 1]);
        if(Input::has('lvl')){
            session(['lvl1Val' => Input::get('lvl')]);
        }
        
        $parent = 0;

        if(Input::has('parent')){
            $parent = Input::get('parent');
        }

        $statement = new Statement();
        return view('admin.statements.create', ['statement' => $statement, 'parent' => $parent]);
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
            'title' => 'required',
        ]);

        $input = $request->all();

        $statement = Statement::create($input);

        if($statement){
            $statementStruct = new Statementstruct();
            $statementStruct->child_id = $statement->id;
            $statementStruct->parent_id = Input::get('parent');
            $statementStruct->active = 1;
            $statementStruct->priority = 0;
            $statementStruct->InsertedByPersonID = Auth::user()->id;
            $statementStruct->UpdatedByPersonID = Auth::user()->id;

            if($statementStruct->save()){
                return redirect()->route('statements.edit', ['id' => $statement->id,'parent' => Input::get('parent'), 'lvl' => session()->get('lvl1Val')])
                        ->with('success','Role created successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = [
            ['statements.active' , '=', 1],
            ['st.active' , '=', 1],
            ['st.parent_id' , '=', 0],
        ];
        $statement = Statement::select('statements.id', 'statements.title')
                        ->join('statementstructs AS st', 'st.child_id', '=', 'statements.id')
                        ->where($where)
                        ->get();

        $arr = [];

        foreach ($statement as $key => $value) {
            $arr[$key]['id'] = $value->id;
            $arr[$key]['label'] = $value->title;
            $arr[$key]['type'] = 'folder';
        }

        return response()->json($arr, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        session(['lvl1Val' => 1]);
        if(Input::has('lvl')){
            session(['lvl1Val' => Input::get('lvl')]);
        }
        
        $parent = 0;

        if(Input::has('parent')){
            $parent = Input::get('parent');
        }

        $statement = Statement::find($id);
        $statementchildstr = Statementstruct::select('s.title', 'statementstructs.child_id', 'statementstructs.priority', 'statementstructs.id')
                                ->join('statements AS s', 's.id', '=', 'statementstructs.child_id')
                                ->where(['statementstructs.parent_id' => $id, 'statementstructs.active' => 1])
                                ->where(['s.active' => 1])
                                ->orderBy('statementstructs.priority')->get();

        return view('admin.statements.edit', ['statement' => $statement, 
                                                'parent' => $parent, 
                                                'statementchildstr' => $statementchildstr]);
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
        $stateUpdate  = Statement::where('id',$id)->first();
        if ($stateUpdate) {
           $state = $stateUpdate->update($request->all());
        }

        return redirect()->route('statements.edit', ['id' => $id,'parent' => Input::get('parent'), 'lvl' => session()->get('lvl1Val')])
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
        $statement = Statement::find($id)->delete();

        $statementStruct = Statementstruct::where(['child_id' => $id])->delete();
        // $statementStruct2 = Statementstruct::where(['parent_id' => $id])->delete();

        return redirect()->route('statements.index')
                        ->with('success','Statement delete successfully');
    }

    public function statementAjaxList($parent = 0, $lvl = 1)
    {
        if($lvl == 2){
            $statementstr = Statementstruct::where(['active' => 1, 'parent_id' => $parent])
                        ->orderBy('priority', 'ASC')
                        ->get();
        }else if($lvl == 3){
            $statementstr = Statementstruct::where(['active' => 1, 'parent_id' => $parent])
                        ->orderBy('priority', 'ASC')
                        ->get();
        }else if($lvl == 4){
            $statementstr = Statementstruct::where(['active' => 1, 'parent_id' => $parent])
                        ->orderBy('priority', 'ASC')
                        ->get();
        }else if($lvl == 5){
            $statementstr = Statementstruct::where(['active' => 1, 'parent_id' => $parent])
                        ->orderBy('priority', 'ASC')
                        ->get();
        }

        return view('admin.statements.ajax-list', ['statementstr' => $statementstr, 'parent' => $parent, 'lvl' => $lvl]);
    }

    public function getDatatablesData($id = 0)
    {
        $statementchildstr = Statementstruct::select('s.id')
                                ->join('statements AS s', 's.id', '=', 'statementstructs.child_id')
                                ->where(['statementstructs.parent_id' => $id, 'statementstructs.active' => 1])
                                ->where(['s.active' => 1])
                                ->orderBy('statementstructs.priority')
                                ->get();

        $arrNotIn = [];

        foreach ($statementchildstr as $key => $value) {
            array_push($arrNotIn, $value->id);
        }

        $statements = Statement::select('title', 'id')
                                ->where([['title', '!=', '']])
                                ->where(['active' => 1])
                                ->whereNotIn('id', $arrNotIn)
                                ->orderBy('title', 'ASC');

        return DataTables::of($statements)
                ->addColumn('action', function ($statements) use($id){
                                return '<a href="'.route('statements.link-unlink', ['id' => $statements->id, 'parent' => $id, 'link' => 1]).'" class="unlink" data-method="PUT">Link</a>';
                            })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function linkUnlink($id, $parent)
    {
        if(Input::get('link') == 0){
            $statementStruct = Statementstruct::find($id)->delete();
            return 'Success';
        }

        $statementStruct = new Statementstruct();
        $statementStruct->parent_id = $parent;
        $statementStruct->child_id = $id;
        $statementStruct->active = 1;
        $statementStruct->priority = 0;
        $statementStruct->is_main_path = 0;
        $statementStruct->InsertedByPersonID = Auth::user()->id;
        $statementStruct->UpdatedByPersonID = Auth::user()->id;

        if($statementStruct->save()){
            return 'Success';
        }
    }

    public function priority(Request $request)
    {
        foreach ($request->data as $key => $value) {
            $statementStruct = Statementstruct::find($value['id']);
            $statementStruct->priority = $value['val'];
            $statementStruct->save();
        }
        return 'Success';
    }

    public function getProductData($id)
    {
        $where = [
            ['statements.active','=', 1],
            ['p.Active','=',1],
            ['pt.Active','=',1],
            ['pt.LanguageID','=','en'],
            ['statements.id','=',$id],
        ];
        $stateProd = Statement::select('statements.id', 'statements.title', 'p.id AS product_id', 'pt.ProductName', 'statements.tablename')
                        ->join('products AS p', 'p.id', '=', 'statements.primarykey')
                        ->join('producttexts AS pt', 'p.id', '=', 'pt.ProductID')
                        ->where($where)
                        ->get();
        $stateDet = Statement::find($id);

        return view('admin.statements.statement-product', ['statement' => $stateProd, 'stateDet' => $stateDet]);
    }

    public function getProductDataAll($id)
    {
        $where = [
            ['statements.active','=', 1],
            ['p.Active','=',1],
            ['pt.Active','=',1],
            ['pt.LanguageID','=','en'],
            ['statements.id','=',$id],
        ];
        $stateProd = Statement::select('statements.id', 'statements.title', 'p.id AS product_id', 'pt.ProductName')
                        ->join('products AS p', 'p.id', '=', 'statements.primarykey')
                        ->join('producttexts AS pt', 'p.id', '=', 'pt.ProductID')
                        ->where($where)
                        ->get();

        $arrProd = [];
        foreach ($stateProd as $key => $value) {
            array_push($arrProd, $value->product_id);
        }

        $prod = Product::select('products.id', 'pt.ProductName')
                ->join('producttexts AS pt', 'products.id', '=', 'pt.ProductID')
                ->where([['products.Active', '=', 1], ['pt.Active', '=', 1], ['pt.LanguageID', '=', 'en']])
                ->whereNotIn('products.id', $arrProd);

        return DataTables::of($prod)
                ->addColumn('action', function ($prod) use($id){
                                return '<a href="'.route('statements.product-link', ['id' => $prod->id, 'link' => 1, 'sid' => $id]).'" class="unlink-prod" data-method="PUT">Link</a>';
                            })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function editAjax($id)
    {
        session(['lvl1Val' => 1]);
        if(Input::has('lvl')){
            session(['lvl1Val' => Input::get('lvl')]);
        }
        
        $parent = 0;

        if(Input::has('parent')){
            $parent = Input::get('parent');
        }

        $statement = Statement::find($id);
        $statementchildstr = Statementstruct::select('s.title', 'statementstructs.child_id', 'statementstructs.priority', 'statementstructs.id')
                                ->join('statements AS s', 's.id', '=', 'statementstructs.child_id')
                                ->where(['statementstructs.parent_id' => $id, 'statementstructs.active' => 1])
                                ->where(['s.active' => 1])
                                ->orderBy('statementstructs.priority')->get();

        return view('admin.statements.edit-ajax', ['statement' => $statement, 
                                                'parent' => $parent, 
                                                'statementchildstr' => $statementchildstr]);
    }

    public function editTablename(Request $request, $id)
    {
        $statement = Statement::find($id);
        $statement->tablename = $request->data;
        if($statement->save()){
            return 'Success';
        }

        return 'Failed';
    }

    public function productLink($id)
    {
        $statement = Statement::find( Input::get('sid') );
        if(Input::get('link') == 0){
            $statement->primarykey = 0;
            if($statement->save()){
                return 'Success';
            }
        }
        $statement->primarykey = $id;
        if($statement->save()){
            return 'Success';
        }
    }
}
