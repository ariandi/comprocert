<?php

namespace App\Http\Controllers\Front\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use DataTables;
use Input;
use App\Entities\Admin\Nodestructures;
use App\Entities\Admin\Node;
use App\User;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function __construct()
    {
        if( !session()->has('LanguageID') ){
            session(['LanguageID' => 'no']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($alias = 'home', Request $request)
    {
        $uriPath = $request->path();

        $homeContent1 = Node::where('id', 11)->first();

        $tigaIcon = $this->menus(12);
        // $node = Node::where('id', \Menus::getLangNode())->first();

        // $node_om_oss = Node::where('id', \Menus::getLangNodeOther()->om_oss)->first();

        // $icon1 = Node::where('id', \Menus::getLangNodeOther()->digital)->first();
        // $icon2 = Node::where('id', \Menus::getLangNodeOther()->change66)->first();
        // $icon3 = Node::where('id', \Menus::getLangNodeOther()->course)->first();
        // $icon4 = Node::where('id', \Menus::getLangNodeOther()->consultant)->first();

        // $slideTitleChild = $this->menus(\Menus::getLangNodeOther()->omoss_samping);

        // if($uriPath != '/'){
        //     $node = Node::where(['Alias' => $uriPath, 'active' => 1])->first();
        // }

        // $selProd = $this->searchnode(10);

        // $selProdChild = $this->menus(10);

        // $blogchild = $this->menus(43);

        // foreach ($blogchild as $keyb => $valueb) {
        //     if(!strpos($valueb->path,"images")){
        //         $blogchild[$keyb]->imagepath = $valueb->path;
        //     }
        // }

        return view('front.home.index', ['homeContent1' => $homeContent1, 'tigaIcon' => $tigaIcon]);
    }

    public function content($alias = 'home', Request $request)
    {
        $uriPath = urldecode($request->path());

        if($alias == 'profile'){
            $uriPath = 'profile';
            $datauser = Session()->get('userData');
        }

        if($uriPath != '/'){
            $node = Node::where(['Alias' => $uriPath, 'active' => 1])->first();
            $bgslide1 = Node::where('id', $node->id)->first();
        }

        $parentn = \Menus::getLangNodeOther()->node_samping;

        $sideNode = Nodestructures::where(['parent_node_id' => $parentn, 'active' => 1])
                    ->whereNotIn('child_node_id', ['30'])
                    ->get();


        return view('front.home.'.$node->template, compact(['node', 'bgslide1', 'sideNode','datauser']));
    }

    public function omoss($alias = 'home', Request $request)
    {
        // dd('bjørge_stensbøl_stensbøl_consulting');
        $uriPath = urldecode($request->path());

        if($uriPath != '/'){
            $node = Node::where(['Alias' => $uriPath, 'active' => 1])->first();
        }

        $parentn = \Menus::getLangNodeOther()->omoss_samping;

        $sideNode = Nodestructures::where(['parent_node_id' => $parentn, 'active' => 1])
                    ->whereNotIn('child_node_id', ['30'])
                    ->get();


        return view('internett1.front.omoss.index', ['node' => $node, 'sideNode' => $sideNode]);
    }


    public function searchnode($id = 1)
    {
        $node = Node::select('title', 'alias', 'id', 'content1', 'content4', 'content3', 'content4')->where(['id' => $id])->first();
        return $node;
    }

    public function menus($parent = 1)
    {
        $selProdChild = Nodestructures::select('n.title', 'n.alias', 'n.id',
                                                'n.content1', 'n.content2', 'n.content3', 'n.content4',
                                                'ms.path', 'n.keyword', 'n.description')
                            ->join('nodes as n', 'n.id', '=', 'nodestructures.child_node_id')
                            ->leftjoin('mediastorages as ms', 'n.media1', '=', 'ms.id')
                            ->where(['nodestructures.parent_node_id' => $parent, 'nodestructures.active' => 1, 'n.active' => 1])->get();
        return $selProdChild;
    }

    public function changeLanguage($langID = 'no')
    {
        session(['LanguageID' => $langID]);
        return back();
    }

    public function resetPasswordAllUser()
    {
        $userUpdates = \DB::table('users')->update(['password' => bcrypt('123456')]);
        return $userUpdates;
    }

    public function sendEmailSubscript(Request $request)
    {   
        //$input = $request->all();
        $checkdata = User::where('email',$request->email)->first();

        if(! isset($checkdata)){ 

            $createnew = User::create([
                'name'          => $request->name, 
                'username'      => explode(' ', $request->name)[0],
                'gender'        => 'M',
                'role'          => 'viewer',
                'lang_id'       => 'en',
                'profile_img'   => 'images/profiles/user',
                'active'        => 1,
                'email'         => $request->email,
                'password'      => bcrypt("123456"),
            ]);

        }


        $objDemo = new \stdClass();
        $objDemo->sento = '1';
        $objDemo->name  = $request->name;
        $objDemo->email = $request->email;
 
        Mail::to($request->email)->send(new SendEmail($objDemo));

        $objDemos = new \stdClass();
        $objDemos->sento = '2';
        $objDemos->name  = $request->name;
        $objDemos->email = $request->email;

        Mail::to('rune@wisehouse.no')->send(new SendEmail($objDemos));
 
        //$sendemail = Mail::to($datauser->email)->send(new SendEmail($objDemo));
        return redirect()->route('front.home')
                        ->with('success','Tusen takk');
    }

    public function registerfront(Request $request)
    {
        return view('front.auth.loginfront');
    }
}

