<?php

namespace Ariandin1411\Menus;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Node;
use App\Nodestructures;

class MenusController extends Controller
{
    public function index()
    {
    	$nodes = Node::all();
    	return $nodes;
    }

    public static function menus($parent = 1) {
    	$menus = Nodestructures::where(['active' => 1, 'parent_node_id' => $parent])->get();
        return $menus;
    }
}
