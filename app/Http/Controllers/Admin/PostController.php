<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return 'hi ini index loh...';
        $posts = [
            ['id' => 1, 'title' => 'Post Title 1', 'body' => 'Post body 1'],
            ['id' => 2, 'title' => 'Post Title 2', 'body' => 'Post body 2'],
            ['id' => 3, 'title' => 'Post Title 3', 'body' => 'Post body 3'],
            ['id' => 4, 'title' => 'Post Title 4', 'body' => 'Post body 4'],
            ['id' => 5, 'title' => 'Post Title 5', 'body' => 'Post body 5'],
        ];

        //$posts = DB::table('posts')->where('id', 1)->get();
        //$posts = DB::table('posts')->where('id', 1)->first();
        $posts = Post::all();
        //$posts = Post::find(1);
        //$posts = Post::where('user_id', 1)->orderBy('id', 'desc')->take(1)->get();
        //print_r($posts);die;

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //print_r(Auth::check());
        if ( !Auth::check() ){
            return redirect('/post');
        }
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');
        //return dd($request->all());
        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => 1
        ];

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;

        $post->save();

        //DB::table('posts')->insert($data);
        return redirect('/post')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'ini halaman show dengan id : '.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'ini halaman edit dengan id : '.$id;
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
        $data = [
            'title' => 'Title Nadia',
            'body'  => 'Emang anak nya nadia masuk angin'
        ];

        $updated = DB::table('posts')->where('id', 1)->update($data);

        $post = Post::find(1);
        $post->title = $request->title;
        $post->save();
        return $updated;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $delete = DB::table('posts')->where('id', 1)->delete();
        
        // $post = Post::find(1);
        // $post->delete();

        $post = Post::destroy($id);

        // $post = Post::destroy([1,2,3]);
        return redirect('/post')->with('success', 'Delete success');
    }
}
