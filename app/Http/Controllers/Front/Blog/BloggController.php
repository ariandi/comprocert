<?php

namespace App\Http\Controllers\Front\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Entities\Admin\Nodestructures;
use App\Entities\Admin\Node;

class BloggController extends Controller
{
    public function __construct()
    {
        if( session()->get('LanguageID') == null ){
            session(['LanguageID' => 'no']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function bloggcontent($alias = 'home', Request $request)
    {

        $uriPath = urldecode($request->path());

        $datauser = auth()->user();

        $parentn = 43;


        if($uriPath != '/'){
            if($uriPath == "no/blogg"){
                $node = Nodestructures::where(['parent_node_id' => $parentn, 'active' => 1])
                        ->whereNotIn('child_node_id', ['30'])
                        ->orderBy('created_at','DESC')
                        ->first();
                $node = $node->node;
            }else{
                $node = Node::where(['Alias' => $uriPath, 'active' => 1])->first();
            }

    
            $nodeForImg = Node::where(['Alias' => "no/blogg", 'active' => 1])->first();
            $bgslide1 = Node::where('id', 43)->first();
            $bgslide2 = Node::where('id', $node->id)->first();
            //dd($bgslide1->getImages());
        }

        $sideNode = Nodestructures::where(['parent_node_id' => $parentn, 'active' => 1])
                    ->whereNotIn('child_node_id', ['30'])
                    ->get();


        return view('front.blog.'.$node->template, compact(['node', 'bgslide1','bgslide2', 'sideNode','datauser']));
    }

    public function edit($id, $parent = 0)
    {

        $nodes = Node::find($id);
        $nodestr = Nodestructures::where(['parent_node_id' => $parent, 'child_node_id' => $id])->first();

        $sideNode = Nodestructures::where(['parent_node_id' => $parent, 'active' => 1])
                    ->whereNotIn('child_node_id', ['30'])
                    ->get();

        $nodechildstr = Nodestructures::where(['parent_node_id' => $id, 'active' => 1])->orderBy('priority')->get();

        if(!$nodestr){
            $nodestr = Nodestructures::where(['parent_node_id' => 0, 'child_node_id' => $id])->first();
        }

        return view('front.blog.bloggedit',
                        compact(['nodes', 'parent', 'nodestr', 'nodechildstr','sideNode']));
    }

    public function update(Request $request,$id)
    {
        #echo $id;exit;
        $Node = Node::find($id);

        $Node->title = $request->title;
        $Node->alias = str_replace(" ", "_", $request->alias);
        $Node->keyword = $request->keyword;
        $Node->description = $request->description;
        $Node->content1 = $request->content1;
        $Node->template = $request->template;

        if($Node->save()){
            $Nodestructures = Nodestructures::find($request->nodestrid);
            $Nodestructures->child_node_id = $id;
            $Nodestructures->parent_node_id = $request->parent;
            $Nodestructures->active = $request->active;

            if($Nodestructures->save()){
                return back()->with('success','Update Blogg Success');
            }else{
                return 'Nodestructures Not Save';
            }
        }else{
            return 'Blogg Not Save';
        }

    }


    public function store(Request $request)
    {
        #var_dump($request);exit;
        $this->validate($request, [
            'title' => 'required|max:255|min:2',
            //'file' => 'required|file|max:2000', // max 2MB
        ]);

        $Node = new Node();
        $Node->title = $request->title;
        $Node->alias = str_replace(" ", "_", $request->alias);
        $Node->keyword = $request->keyword;
        $Node->description = $request->description;
        $Node->content1 = $request->content1;
        $Node->template = $request->template;


        if($Node->save()){
            $Nodestructures = new Nodestructures();
            $Nodestructures->child_node_id = $Node->id;
            $Nodestructures->parent_node_id = $request->parent;

            if($Nodestructures->save()){
                return back()->with('success','Input Blogg Success');
            }else{
                return 'Nodestructures Not Save';
            }
        }else{
            return 'Blogg Not Save';
        }

    }

    public function bloggcreate()
    {
        $datauser = auth()->user();


        $sideNode = Nodestructures::where(['parent_node_id' => 43, 'active' => 1])
                    ->whereNotIn('child_node_id', ['30'])
                    ->get();

        return view('front.blog.bloggcreate', compact(['sideNode']));
    }

}
