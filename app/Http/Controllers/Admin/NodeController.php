<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Menus;
use Input;
use App\Entities\Admin\Node;
use App\Entities\Admin\Nodestructures;
use App\Entities\Admin\Mediastorages;

class NodeController extends Controller
{
    private
        $apiURI = 'publish.api_person',
        $constant = [
            'languages' => ['en' => 'English', 'no' => 'Norway', 'pl' => 'Polish', 'id' => 'Indonesia'],
            'roles' => ['admin' => 'Admin', 'viewer' => 'Viewer'],
            'template' => [ 'index' => 'Index', 'content' => 'Content', 'contact' => 'Contact', 
                            'news'=>'News', 'news-list' => 'News List', 'cert' => 'Certification'],
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodes = Nodestructures::where(['active' => 1, 'parent_node_id' => 0])
                    ->orderBy('priority', 'ASC')
                    ->get();

        return view('admin.content-management.index', ['nodes' => $nodes, 'lvl' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nodes = new Node();
        $arrTemplates = $this->constant['template'];
        return view('admin.content-management.create', ['nodes' => $nodes, 'parent' => Input::get('parent'), 'arrTemplates' => $arrTemplates]);
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
            'title' => 'required|max:255|min:2',
        ]);

        $Node = new Node();
        $Node->title = $request->title;
        $Node->alias = $request->alias;
        $Node->keyword = $request->keyword;
        $Node->description = $request->description;
        $Node->content1 = $request->content1;
        $Node->template = $request->template;

        if($Node->save()){
            $Nodestructures = new Nodestructures();
            $Nodestructures->child_node_id = $Node->id;
            $Nodestructures->parent_node_id = $request->parent;

            if($Nodestructures->save()){
                return redirect()->route('nodes.edit', ['id' => $Node->id, 'parent' => $request->parent])->with('success','Input Node Success');
            }else{
                return 'Nodestructures Not Save';
            }
        }else{
            return 'Node Not Save';
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
        if(Input::has('parent')){
            $parent = Input::get('parent');
        }else{
            $parent = 0;
        }

        $nodes = Node::find($id);
        $nodestr = Nodestructures::where(['parent_node_id' => $parent, 'child_node_id' => $id])->first();
        
        $nodechildstr = Nodestructures::where(['parent_node_id' => $id, 'active' => 1])->orderBy('priority')->get();

        $arrTemplates = $this->constant['template'];

        $arrNodeID = [];

        return view('admin.content-management.update', 
                        ['nodes' => $nodes, 'parent' => $parent, 'nodestr' => $nodestr, 
                        'arrTemplates' => $arrTemplates, 'nodechildstr' => $nodechildstr, 'arrNodeID' => $arrNodeID]);
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
            'title' => 'required|max:255|min:2',
        ]);

        if($request->active != 1){
            $request->active = 0;
        }

        if($request->template == null){
            $request->template = 'content';
        }

        $Node = Node::find($id);
        $Node->title = $request->title;
        $Node->alias = $request->alias;
        $Node->keyword = $request->keyword;
        $Node->description = $request->description;
        $Node->template = $request->template;

        if($Node->save()){
            return back()->with('success','Input Node Success');
        }else{
            return 'Node Not Save';
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
        // $node = Node::find($id)->delete();

        $NodeStruct = Nodestructures::where(['child_node_id' => $id])->delete();

        return redirect()->route('nodes.index')
                        ->with('success','Content delete successfully');
    }

    public function publish2ajaxnode($parent = 0, $lvl = 1)
    {
        if($lvl == 2){
            $nodes2 = Nodestructures::where(['active' => 1, 'parent_node_id' => $parent])
                        ->orderBy('priority', 'ASC')
                        ->get();
        }else if($lvl == 3){
            $nodes2 = Nodestructures::where(['active' => 1, 'parent_node_id' => $parent])
                        ->orderBy('priority', 'ASC')
                        ->get();
        }else if($lvl == 4){
            $nodes2 = Nodestructures::where(['active' => 1, 'parent_node_id' => $parent])
                        ->orderBy('priority', 'ASC')
                        ->get();
        }

        return view('admin.ajax.ajaxnode', compact(['nodes', 'nodes2', 'parent', 'lvl']));
    }

    public static function getNodeNotIn($params)
    {
        $nodeWhereNodeIn = Node::select('id', 'title', 'alias', 'template')
                            ->where(['active' => 1])
                            ->whereNotIn('id', $params)->get();

        return $nodeWhereNodeIn;
    }

    public function nodeLink(Request $request)
    {
        $Nodestructures = new Nodestructures();
        $Nodestructures->parent_node_id = $request->data['ParentNodeID'];
        $Nodestructures->child_node_id = $request->data['NodeID'];
        $Nodestructures->priority = 0;
        $Nodestructures->active = 1;

        if($Nodestructures->save()){
            return 'Success';
        }
    }

    public function nodeUnLink(Request $request)
    {
        $Nodestructures = Nodestructures::find($request->id);
        $Nodestructures->active = 0;

        if($Nodestructures->save()){
            return 'Success';
        }
    }

    public function nodePriority(Request $request)
    {
        foreach ($request->data as $k => $v) {
            $Nodestructures = Nodestructures::find($v['id']);
            $Nodestructures->priority = $v['val'];
            $Nodestructures->save();
        }

        return 'Success';
    }

    public function contentText($id)
    {
        $nodes = Node::find($id);

        return view('admin.content-management.update-content-ajax', 
                        ['nodes' => $nodes]);
    }

    public function contentImg($id)
    {
        $nodes = Node::find($id);

        return view('admin.content-management.update-img-ajax', 
                        ['nodes' => $nodes]);
    }

    public function contentDet($id)
    {
        if(Input::has('parent')){
            $parent = Input::get('parent');
        }else{
            $parent = 0;
        }

        $nodes = Node::find($id);
        $nodestr = Nodestructures::where(['parent_node_id' => $parent, 'child_node_id' => $id])->first();
        
        $nodechildstr = Nodestructures::where(['parent_node_id' => $id, 'active' => 1])->orderBy('priority')->get();

        $arrTemplates = [ 'index' => 'Index', 'content' => 'Content', 
                            'contact' => 'Contact','blogg'=>'Blogg',
                            'course' => 'course', 'om_oss' => 'Om Oss'
                        ];

        if(!$nodestr){
            return 'Node not have parent '.$parent;
        }

        $arrNodeID = [];

        return view('admin.content-management.update-detail-ajax', 
                        ['nodes' => $nodes, 'parent' => $parent, 'nodestr' => $nodestr, 
                        'arrTemplates' => $arrTemplates, 'nodechildstr' => $nodechildstr, 'arrNodeID' => $arrNodeID]);
    }

    public function contentTextUpdate(Request $request, $id)
    {
        $contentText = Node::find($id)->update($request->all());
        if($contentText){
            return 'Success';
        }

        return 'Failed';
    }

    public function contentImgUpdate(Request $request, $id)
    {
        $node = Node::find($id);

        if(Input::hasFile('media1')){

            $uploadedFile = $request->file('media1');        
            $path = $uploadedFile->store('public/files');

            if($node->media1 > 0 || $node->media1 != null){
                $msID = $this->exsMediaStorage($request, $path, $id, $request->mediastorage_id1);
            }else{
                $msID = $this->newMediaStorage($request, $path, $id);
                $node->media1 = $msID->id;
                $node->save();
            }
        }else{
            $msID = $this->exsMediaStorage($request, null, $id, $request->mediastorage_id1);
        }

        if(Input::hasFile('media2')){

            $uploadedFile = $request->file('media2');        
            $path = $uploadedFile->store('public/files');
            $request->img_title1 = $request->img_title2;
            $request->externalurl1 = $request->externalurl2;

            if($node->media2 > 0 || $node->media2 != null){
                $msID = $this->exsMediaStorage($request, $path, $id, $request->mediastorage_id2);
            }else{
                $msID = $this->newMediaStorage($request, $path, $id);
                $node->media2 = $msID->id;
                $node->save();
            }
        }else{
            $request->img_title1 = $request->img_title2;
            $request->externalurl1 = $request->externalurl2;
            $msID = $this->exsMediaStorage($request, null, $id, $request->mediastorage_id2);
        }

        if(Input::hasFile('media3')){

            $uploadedFile = $request->file('media3');        
            $path = $uploadedFile->store('public/files');
            $request->img_title1 = $request->img_title3;
            $request->externalurl1 = $request->externalurl3;

            if($node->media3 > 0 || $node->media3 != null){
                $msID = $this->exsMediaStorage($request, $path, $id, $request->mediastorage_id3);
            }else{
                $msID = $this->newMediaStorage($request, $path, $id);
                $node->media3 = $msID->id;
                $node->save();
            }
        }else{
            $request->img_title1 = $request->img_title3;
            $request->externalurl1 = $request->externalurl3;
            $msID = $this->exsMediaStorage($request, null, $id, $request->mediastorage_id3);
        }

        if(Input::hasFile('media4')){

            $uploadedFile = $request->file('media4');        
            $path = $uploadedFile->store('public/files');
            $request->img_title1 = $request->img_title4;
            $request->externalurl1 = $request->externalurl4;
            if($node->media4 > 0 || $node->media4 != null){
                $msID = $this->exsMediaStorage($request, $path, $id, $request->mediastorage_id4);
            }else{
                $msID = $this->newMediaStorage($request, $path, $id);
                $node->media4 = $msID->id;
                $node->save();
            }
        }else{
            $request->img_title1 = $request->img_title4;
            $request->externalurl1 = $request->externalurl4;
            $msID = $this->exsMediaStorage($request, null, $id, $request->mediastorage_id4);
        }

        return 'Success';
    }

    public function newMediaStorage($request, $path, $id)
    {
        $params = [
            'title' => $request->img_title1,
            'external_url' => $request->externalurl1,
            'path' => $path,
            'media_id' => $id,
            'tablename' => 'nodes',
        ];

        $mediastorage = Mediastorages::create($params);
        return $mediastorage;
    }

    public function exsMediaStorage($request, $path, $id, $id2)
    {
        $params = [
            'title' => $request->img_title1,
            'external_url' => $request->externalurl1,
            'media_id' => $id,
        ];

        if($path != null){
            $params['path'] = $path;
        }

        $mediastorage = Mediastorages::find($id2);
        if($mediastorage){
            $mediastorage = $mediastorage->update($params);
        }
        return $mediastorage;
    }
}
