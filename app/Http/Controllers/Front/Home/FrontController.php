<?php

namespace App\Http\Controllers\Front\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use DataTables;
use Input;
use App\Entities\Admin\Nodestructures;
use App\Entities\Admin\Certificate;
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
        $whatWeOffer = Node::where('id', 25)->first();
        $provided = Node::where('id', 37)->first();

        $tigaIcon = $this->menus(12);
        $whatWeOfferChild = $this->menus(25);
        $quotesChild = $this->menus(34);
        $providedChild = $this->menus(37);

        return view('front.home.index', ['homeContent1' => $homeContent1, 
                                            'tigaIcon' => $tigaIcon,
                                            'whatWeOffer' => $whatWeOffer,
                                            'whatWeOfferChild' => $whatWeOfferChild,
                                            'quotesChild' => $quotesChild,
                                            'provided' => $provided,
                                            'providedChild' => $providedChild]);
    }

    public function content($alias = 'home', Request $request)
    {
        $uriPath = urldecode($request->path());

        if($uriPath != '/'){
            $node = Node::where(['Alias' => $uriPath, 'active' => 1])->first();
        }

        $cert = new Certificate();

        if( \Session::get('cert') ){
            $cert = \Session::get('cert');
        }

        return view('front.home.'.$node->template, ['node' => $node, 'cert' => $cert]);
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
}

