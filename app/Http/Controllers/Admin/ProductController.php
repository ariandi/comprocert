<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Admin\Product;
use App\Entities\Admin\Producttext;
use App\Entities\Admin\Productmedia;
use DataTables, Auth, Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $product->Active = 1;
        $classification = [
                            ['key' => 1, 'value' => 'Standard'],
                            ['key' => 2, 'value' => 'Subscription'],
                            ['key' => 3, 'value' => 'Project']
                        ];

        $supplier = [
                            ['key' => 1, 'value' => 'Test Supplier 1'],
                            ['key' => 2, 'value' => 'Test Supplier 2'],
                            ['key' => 3, 'value' => 'Test Supplier 3']
                        ];

        $vat = [
                            ['key' => 0, 'value' => '0%'],
                            ['key' => 10, 'value' => '10%'],
                            ['key' => 15, 'value' => '15%'],
                            ['key' => 20, 'value' => '20%'],
                            ['key' => 25, 'value' => '25%']
                        ];

        return view('admin.product.create', ['classification' => $classification, 'supplier' => $supplier, 'vat' => $vat, 'product' => $product]);
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
            'ProductNumber' => 'required|max:191',
            'ProductName' => 'required|max:191',
        ]);

        if(isset($request->id)){
            $Product = Product::find($request->id);
        }else{
            $Product = new Product();
        }

        $Product->ProductNumber = $request->ProductNumber;
        // $Product->ProductName = $request->ProductName;
        $Product->EAN = $request->EAN;
        $Product->Active = $request->Active;
        $Product->ClassificationID = $request->Classification;
        $Product->SupplierID = $request->Supplier;
        $Product->ProductUnit = $request->Unit;
        $Product->UnitPerLayer = $request->UnitPerLayer;
        $Product->ProductHeight = $request->ProductHeight;
        $Product->QuantityPerUnit = $request->QuantityPerUnit;
        $Product->LayersPerPallet = $request->LayersPerPallet;
        $Product->ProductWidth = $request->ProductWidth;
        $Product->ProductWeight = $request->ProductWeight;
        $Product->ProductVolumeUnit = $request->ProductVolumeUnit;
        $Product->ProductVolume = $request->ProductVolume;
        $Product->ValidFrom = $request->ValidFrom;
        $Product->ValidTo = $request->ValidTo;
        $Product->Stock = $request->Stock;
        $Product->UnitCustPrice = $request->UnitCustPrice;
        $Product->UnitCostPrice = $request->UnitCostPrice;
        $Product->ProductCurrency = $request->ProductCurrency;
        $Product->VatID = $request->VatID;
        $Product->ProductLength = $request->ProductLength;
        $Product->Unit = $request->Unit;
        $Product->CreatedByPersonID = Auth::user()->id;

        if($Product->save()){
            
            $LangaugeID = ['en', 'no'];

            if(isset($request->id)){
                foreach ($LangaugeID as $langID) {
                    $Producttext = Producttext::where(['ProductID' => $request->id, 'LanguageID' => $langID])->first();

                    if(isset($Producttext->id)){
                        $Producttext->ProductName = $request->ProductName;
                        $Producttext->ChangedByPersonID = Auth::user()->id;

                        if(!$Producttext->save()){
                            echo "Error in update product";die;
                        }
                    }                    
                }
                return back()->with('success','Input Product Success')->withInput();
            }else{
                $dataSet = [];
                $i = 0;
                foreach ($LangaugeID as $langID) {
                    $dataSet[$i] = [
                        'ProductID'  => $Product->id,
                        'ProductName'    => $request->ProductName,
                        'LanguageID'       => $langID,
                        'CreatedByPersonID' => Auth::user()->id,
                        'created_at' => date('Y:m:d H:i:s'),
                    ];
                    $i++;
                }

                if( \DB::table('producttexts')->insert($dataSet) ){
                    return back()->with('success','Input Product Success')->withInput();
                }else{
                    echo "Error save product text";die;
                }
            }
        }else{
            echo "Error save product";die;
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
        $product = Product::find($id);
        $product->ProductName = $product->getProdNameOne()['ProductName'];
        
        // dd($product->id);

        $classification = [
                            ['key' => 1, 'value' => 'Standard'],
                            ['key' => 2, 'value' => 'Subscription'],
                            ['key' => 3, 'value' => 'Project']
                        ];

        $supplier = [
                            ['key' => 1, 'value' => 'Test Supplier 1'],
                            ['key' => 2, 'value' => 'Test Supplier 2'],
                            ['key' => 3, 'value' => 'Test Supplier 3']
                        ];

        $vat = [
                            ['key' => 0, 'value' => '0%'],
                            ['key' => 10, 'value' => '10%'],
                            ['key' => 15, 'value' => '15%'],
                            ['key' => 20, 'value' => '20%'],
                            ['key' => 25, 'value' => '25%']
                        ];

        return view('admin.product.create', ['classification' => $classification, 'supplier' => $supplier, 'vat' => $vat, 'product' => $product]);
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
        //
    }

    public function getDatatablesData()
    {
        $prods = Product::join('producttexts', 'products.id', '=', 'producttexts.ProductID')
                ->select(['products.id', 'products.ProductNumber', 
                                    'producttexts.ProductName', 'products.ClassificationID', 
                                    'products.SupplierID', 'products.UnitCostPrice', 'products.UnitCustPrice'])
                ->where(['products.Active' => 1, 'producttexts.Active' => 1])
                ->where('LanguageID', 'en');

        // $prods = $prods->toSql();
        // $prods = $prods->get();

        // print_r($prods);die;

        return DataTables::of($prods)
                ->editColumn('UnitCostPrice', function ($prods) {
                                return number_format($prods->UnitCostPrice, 2);
                            })
                ->editColumn('UnitCustPrice', function ($prods) {
                                return number_format($prods->UnitCustPrice, 2);
                            })
                ->addColumn('action', function ($prods) {
                                return '<a href="'.route('products.edit', ['id' => $prods->id]).'" class="btn btn-xs btn-primary editProds">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>';
                            })
                ->make(true);
    }

    public function editProductText($id)
    {
        $lang = 'en';

        if(Input::get('lang')){
            $lang = Input::get('lang');
        }

        $getProduct = Product::find($id);
        $getProductText = Producttext::where(['ProductID' => $getProduct->id, 'active' => 1, 'LanguageID' => $lang])->first();
        if(!$getProductText){
            $getProductText = new Producttext();
            $getProductText->LanguageID = $lang;
        }
        $langList = [
                        ['key' => 'en', 'value' => 'English'],
                        ['key' => 'no', 'value' => 'Norwegian'],
                        ['key' => 'pl', 'value' => 'Polish'],
                        ['key' => 'id', 'value' => 'Indonesian']
                    ];
        return view('admin.product.producttext', ['product' => $getProduct, 'productText' => $getProductText, 'langList' => $langList]);
    }

    public function editAjax($id)
    {
        $product = Product::find($id);
        $product->ProductName = $product->getProdNameOne()['ProductName'];
        
        // dd($product->getProdNameOne()['ProductName']);

        $classification = [
                            ['key' => 1, 'value' => 'Standard'],
                            ['key' => 2, 'value' => 'Subscription'],
                            ['key' => 3, 'value' => 'Project']
                        ];

        $supplier = [
                            ['key' => 1, 'value' => 'Test Supplier 1'],
                            ['key' => 2, 'value' => 'Test Supplier 2'],
                            ['key' => 3, 'value' => 'Test Supplier 3']
                        ];

        $vat = [
                            ['key' => 0, 'value' => '0%'],
                            ['key' => 10, 'value' => '10%'],
                            ['key' => 15, 'value' => '15%'],
                            ['key' => 20, 'value' => '20%'],
                            ['key' => 25, 'value' => '25%']
                        ];

        return view('admin.product.createajax', ['classification' => $classification, 
                                                    'supplier' => $supplier, 
                                                    'vat' => $vat, 'product' => $product]);
    }

    public function updateAjax(Request $request, $id)
    {
        $mytime = \Carbon\Carbon::now();

        $productText = Producttext::find($request->id);
        if($request->id == null){
            $productText = new Producttext();
            $productText->LanguageID = $request->LanguageID;
            $productText->ProductID = $id;
        }
        $productText->ProductName = $request->ProductName;
        $productText->ProductText = $request->ProductText;
        $productText->TeaserText = $request->TeaserText;
        $productText->SalesText = $request->SalesText;
        $productText->TechnicalText = $request->TechnicalText;
        $productText->FeatureText = $request->FeatureText;
        $productText->ChangedByPersonID = Auth::user()->id;
        $productText->updated_at = $mytime->toDateTimeString();

        if($productText->save()){
            return ['error' => 0];
        }
        return ['error' => 1];
    }

    public function editProductMedia($id)
    {
        $getProduct = Product::find($id);
        $getProductMedia = Productmedia::where(['ProductID' => $getProduct->id, 'active' => 1])->first();
        $getMediaStorage = null;
        if($getProductMedia){
            $getMediaStorage = Mediastorages::where(['media_id' => $getProductMedia->ProductMediaStorageID, 'active' => 1, 
                                                'tablename' => 'products' ])
                            ->get();
        }
        
        
        // echo \Storage::get('FdZ9jk1A9RhHDymREVohoeUpnB0kAtSsmNGE1KIc.png');

        return view('admin.product.productmedia', ['product' => $getProduct, 
                                                    'productmedia' => $getProductMedia,
                                                    'mediastorage' => $getMediaStorage]);
    }

    public function updateProductMediaAjax(Request $request, $id = null)
    {
        $product = Product::find($id);
        $productMediaCek = Productmedia::where(['ProductID' => $id, 'active' => 1])->first();
        $i = 0;

        if (Input::hasFile('uploadImg')){

            if($productMediaCek){
                foreach ($request->uploadImg as $photo) {
                        $filename = $photo->store('images');
                        $mediastorage = Mediastorages::create([
                            'title' => $request->img_title[$i],
                            'external_url' => $request->externalurl[$i],
                            'path' => $filename,
                            'media_id' => $productMediaCek->ProductMediaStorageID,
                            'tablename' => 'products',
                        ]);
                        $i++;
                }
            }else{
                $productMediaStorageID = \DB::table('productmedias')->max('ProductMediaStorageID');
                $productmedia = Productmedia::create([
                        'ProductID' => $id,
                        'ProductMediaStorageID' => $productMediaStorageID+1,
                        'Heading' => null,
                        'Description' => null,
                        'CreatedByPersonID' => Auth::user()->id,
                    ]);

                foreach ($request->uploadImg as $photo) {
                    $filename = $photo->store('images');
                    $mediastorage = Mediastorages::create([
                        'title' => $request->img_title[$i],
                        'external_url' => $request->externalurl[$i],
                        'path' => $filename,
                        'media_id' => $productmedia->id,
                        'tablename' => 'products',
                    ]);
                    $i++;
                }
            }
        }

        if( is_array($request->mediastorage_id) ){
            
            $i = 0;
            foreach ($request->mediastorage_id as $mediastorage_id) {
                    
                    $data = [
                                'title' => $request->img_titledb[$i],
                                'external_url' => $request->externalurldb[$i],
                                'media_id' => $productMediaCek->ProductMediaStorageID,
                                'tablename' => 'products',
                            ];

                    if( isset($request->mediadb[$i]) ){
                        $filename = $request->mediadb[$i]->store('images');
                        $data['path'] = $filename;
                    }

                    $updated = \DB::table('mediastorages')->where('id', $mediastorage_id)->update($data);
                    // if($updated){
                    //     echo $mediastorage_id;
                    // }
                    $i++;
            }

            // return ['error' => 0, 'msg' => 'Success save db data'];
        }

        return ['error' => 0, 'msg' => 'Success save db data'];
    }

    public function deleteProductMediaAjax($id)
    {
        $mediaStorage = Mediastorages::find($id);
        $mediaStorage->active = 0;

        if($mediaStorage->save()){
            return ['error' => 0];
        }

        return ['error' => 1];
    }
}
