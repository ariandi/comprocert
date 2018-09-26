<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use DataTables;
use Input;
use App\Entities\Admin\Languagestring;

class LanguagestringController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Languagestring = new Languagestring();
        $arrLangList = [ 'en' => 'English', 'no' => 'Norwegian', 'pl' => 'Polish', 'id' => 'Indonesian'];
        return view('admin.languagestring.list', compact(['Languagestring', 'arrLangList']));
    }

    public function getLangs()
    {
        $langs = Languagestring::select(['id', 'language_id', 'language_string_text_id', 'language_string']);

        return DataTables::of(Languagestring::query())
                ->addColumn('action', function ($langs) {
                                return '<a href="#" class="btn btn-xs btn-primary editLangs" 
                                            id="lang_'.$langs->id.'"
                                            languageid="'.$langs->language_id.'"
                                            textid="'.$langs->language_string_text_id.'"
                                            langstr="'.$langs->language_string.'">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>';
                            })
                ->make(true);
    }

    public function store(Request $request)
    {
        if(! Input::get('id')){
            $Languagestring = new Languagestring();
        }else{
            $Languagestring = Languagestring::find(Input::get('id'));
        }
        
        $Languagestring->language_string_text_id = Input::get('language_string_text_id');
        $Languagestring->language_string = Input::get('language_string');
        $Languagestring->language_id = Input::get('language_id');

        if($Languagestring->save()){
            return 'Success';
        }else{
           return 'Error when input'; 
        }
    }

    public function getLanguageString($languagetext, $langid)
    {
        $language = \Menus::getLanguageString($languagetext, $langid);

        $response = [
            'msg' => 'Language string res',
            'language' => $language,
            'error' => 0,
        ];

        return response()->json($response, 200);
    }
}
