<?php

namespace App\Http\Controllers\Front\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use DataTables;
use Input;
use App\Entities\Admin\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.comments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $comment = Comment::create($request->all());
        if($comment){
            return redirect()->back()->with('success-message', 'Success send meesage to us.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id)->delete();
        if( $comment ){
            return redirect()->back();
        }
    }

    public function getDatatablesData()
    {
        $comments = Comment::orderBy('id', 'Desc');

        return DataTables::of($comments)
                ->editColumn('created_at', function ($comments) {
                                return date('d F y', strtotime($comments->created_at));
                            })
                ->addColumn('action', function ($comments) {

                                $delete = '#';
                                if(Auth::user()->role == 'admin'){
                                    $delete = '<form method="post" action="'.route('comments.destroy', $comments->id).'" 
                                                style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <button class="btn btn-xs btn-danger">
                                            Delete
                                        </button>
                                        </form>';
                                }
                                return $delete;
                            })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function storeFront(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        
        $comment = Comment::create($request->all());
        if($comment){
            return redirect()->back()->with('success-message', 'Success send meesage to us.');
        }
    }
}
