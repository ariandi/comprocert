<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Auth,
    DataTables;
use App\Entities\Admin\Product;
use App\User;
use App\Entities\Admin\Company;
use App\Entities\Admin\Companypersonstruct;
use App\Entities\Admin\Producttext;
use App\Entities\Admin\Ordercust;
use App\Entities\Admin\Ordercustline;

class OrderSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view("admin.ordersale.order_list");
    }

    public function getDatatablesData()
    {
        $orders = Ordercust::select(['id', 'DName','Status', 'OrderDate'])
                ->where('Active', '1');

        return DataTables::of($orders)
                ->addColumn('action', function ($orders) {
                                return '<a href="'.route('ordersale.edit', ['id' => $orders->id]).'" class="btn btn-xs btn-primary editProds">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>
                                        <a href="'.route('ordersale.delete', ['id' => $orders->id,'table'=>'Ordercust']).'" class="btn btn-xs btn-primary deleteorder">
                                            <i class="glyphicon glyphicon-trash"></i> Delete
                                        </a>';
                            })
                ->make(true);
    }

    public function getlistproduct()
    {
        $prods = Product::join('producttexts', 'products.id', '=', 'producttexts.ProductID')
                ->select(['products.id', 'products.ProductNumber', 
                                    'producttexts.ProductName', 'products.ClassificationID', 
                                    'products.SupplierID', 'products.UnitCostPrice', 'products.UnitCustPrice','products.VatID'])
                ->where(['products.Active' => 1, 'producttexts.Active' => 1])
                ->where('producttexts.LanguageID', 'en')
                ->get();

        $data = array();
        foreach ($prods as $key => $value) {
            $value->value = $value->ProductName;
            $value->label = $value->ProductName." ".$value->ProductNumber;
            $value->desc = $value->ProductName;
            $data[] = $value;
        }
        
        return json_encode($data);
    }

    public function getlistcompany()
    {
        $company = Company::where('active', '1')->get();
        $data = array();
        foreach ($company as $key => $value) {
            $value->value = $value->id;
            $value->label = $value->CompanyName." ".$value->id;
            $value->desc = $value->id;
            $data[] = $value;
        }
        
        return json_encode($data);
    }

    public function getlistperson()
    {
        $user = User::where('active', '1')->get();
        $data = array();
        foreach ($user as $key => $value) {
            $value->value = $value->id;
            $value->label = $value->first_name." ".$value->id." ".$value->last_name.' '.$value->email;
            $value->desc = $value->id;
            $data[] = $value;
        }
        
        return json_encode($data);
    }

    public function getStruktur($id,$table)
    {
        if($table == "company"){
            $companyPersonStruct = Companypersonstruct::select('c.id', 'c.CompanyName', 'c.Email', 'c.Phone')
                                ->join('companies AS c', 'c.id', '=', 'companypersonstructs.CompanyID')
                                ->where(['companypersonstructs.user_id' => $id, 
                                        'companypersonstructs.Active' => 1,
                                        'c.active' => 1])->first();

        }else if($table == "employee"){
            $companyPersonStruct = Companypersonstruct::select('u.first_name', 'u.last_name', 'u.email', 'u.id')
                                ->join('users AS u', 'u.id', '=', 'companypersonstructs.user_id')
                                ->where(['companypersonstructs.CompanyID' => $id, 
                                        'companypersonstructs.Active' => 1,
                                        'u.active' => 1])->get();

            
        }
        
        return $companyPersonStruct;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $companyid = $this->getStruktur(Auth::user()->id,'company');
        $data = array(
                        'dataprod'      => $this->getlistproduct(),
                        'company'       => $this->getlistcompany(),
                        'getCompany'    => $companyid,
                        'getEmployee'   => $this->getStruktur($companyid->id,'employee'),
                        'person'       => $this->getlistperson()
                    );
        return view("admin.ordersale.create_order",compact(['data']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->all());exit;
        
        $data = new Ordercust();
        $data->Status = $request->Status;                       $data->CompanyID = $request->CompanyID;
        $data->PersonID = $request->PersonID;                   $data->ContactPersonID = $request->SalesPerson;
        $data->ResponsiblePersonID = $request->responsible;     $data->OrderDate = $request->OrderDate;
        $data->RequiredDate = $request->required;               $data->DeliveryDate = $request->DeliveryDate;
        $data->DateShipped = $request->sent;                    $data->DEmail = $request->demail;
        $data->DName = $request->dname;                         $data->DAddress = $request->daddress;
        $data->DZipCode = $request->dpostcode;                  $data->DCity = $request->dplace;
        $data->DCountry = $request->dcountry;                   $data->Active = 1;
        $data->EnableTaxFree = $request->EnableTaxFree;         $data->IEmail = $request->iemail;
        $data->IName = $request->iname;                         $data->IAddress = $request->iaddress;
        $data->ICity = $request->iplace;                        $data->IZipCode = $request->ipostcode;
        $data->ICountry = $request->icountry;                   $data->CommentInternal = $request->CommentInternal;
        $data->CommentCustomer = $request->CommentCustomer;     $data->CreatedByPersonID = Auth::user()->id;
        
        if($data->save()){

            foreach ($request->productid as $key => $value) {
                $dataline = Ordercustline::create([
                    'ProductNumber' => "",
                    'OrderID' => $data->id,
                    'ProductID' => $value,
                    'UnitCostPrice' => $request->costprice[$key],
                    'UnitCustPrice' => $request->custprice[$key],
                    'QuantityOrdered' => $request->ordered[$key],
                    'QuantityDelivered' => $request->delivered[$key],
                    'Vat' => $request->vat[$key],
                    'InsertedByPersonID' => Auth::user()->id,
                    'Active' => 1,
                    'LineNum' => $request->linenum[$key],
                    'Comments' => null,
                    'VatID' => null,
                    'TaxFree' => null,
                    'ValidFromDate' => null,
                    'ValidToDate' => null,
                    'ProductName' => $request->productname[$key],
                    'ProductVariantID' => null,
                    'pricegroupid' => null,
                    'InsertedByPersonID' => null,
                    'UpdatedByPersonID' => null,
                    'created_at' => null,
                    'Discount' => $request->discount[$key],
                    'TaxAmount' => null,
                    'UnitCustPriceCurrencyID' => null,
                    'UnitCostPriceCurrencyID' => null
                ]);
            }

        }

        return redirect()->route('ordersale.edit',['id'=>$data->id])->with('success','Data order has been created');
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
        $order = Ordercust::find($id);
        $orderline = Ordercustline::where(['Active' => 1, 'OrderID' => $id])->get();
    
        $companyid = $this->getStruktur(Auth::user()->id,'company');

        $data = array();
        $data['dataproduk'] = $dataprod = $this->getlistproduct();
        $data['company'] = $this->getlistcompany();
        $data['person'] = $this->getlistperson();
        $data['ordercust'] = $order;
        $data['ordercustline'] = $orderline;
        $data['getCompany'] = $companyid;
        $data['getEmployee'] = $this->getStruktur($companyid->id,'employee');

        $orderid =  $id;
        return view("admin.ordersale.edit",compact(['data','orderid']));
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
        
        $data = Ordercust::find($id);
        $data->Status = $request->Status;
        $data->CompanyID = $request->CompanyID;
        $data->PersonID = $request->PersonID;
        $data->UpdatedByPersonID = Auth::user()->id;
        $data->ContactPersonID = $request->SalesPerson;
        $data->ResponsiblePersonID = $request->responsible;
        $data->OrderDate = $request->OrderDate;
        $data->RequiredDate = $request->required;
        $data->DeliveryDate = $request->DeliveryDate;
        $data->DateShipped = $request->sent;
        $data->DEmail = $request->demail;
        $data->DName = $request->dname;
        $data->DAddress = $request->daddress;
        $data->DZipCode = $request->dpostcode;
        $data->DCity = $request->dplace;
        $data->DCountry = $request->dcountry;
        $data->Active = 1;
        $data->EnableTaxFree = $request->EnableTaxFree;
        $data->IEmail = $request->iemail;
        $data->IName = $request->iname;
        $data->IAddress = $request->iaddress;
        $data->ICity = $request->iplace;
        $data->IZipCode = $request->ipostcode;
        $data->ICountry = $request->icountry;
        $data->CommentInternal = $request->CommentInternal;
        $data->CommentCustomer = $request->CommentCustomer;

        if($data->save()){
            $dataline = Ordercustline::where(['OrderID'=>$data->id])->get();
            foreach ($dataline as $key => $value) {
                //echo $value->id;
                $line = Ordercustline::find($value->id);
                $line->ProductNumber = $request->productid[$key];
                $line->OrderID =  $data->id;
                $line->ProductID = $request->productid[$key];
                $line->UnitCostPrice = str_replace(",","", $request->costprice[$key]);
                $line->UnitCustPrice = str_replace(",","", $request->custprice[$key]);
                $line->QuantityOrdered = str_replace(",","", $request->ordered[$key]);
                $line->QuantityDelivered = str_replace(",","", $request->delivered[$key]);
                $line->Vat = $request->vat[$key];
                $line->Active = 1;
                $line->UpdatedByPersonID = Auth::user()->id;
                $line->LineNum = $request->linenum[$key];
                $line->Comments = null;
                $line->VatID = null;
                $line->TaxFree = null;
                $line->ValidFromDate = null;
                $line->ValidToDate = null;
                $line->ProductName = $request->productname[$key];
                $line->ProductVariantID = null;
                $line->pricegroupid = null;
                $line->InsertedByPersonID = null;
                $line->UpdatedByPersonID = null;
                $line->created_at = null;
                $line->Discount = null;
                $line->TaxAmount = null;
                $line->UnitCustPriceCurrencyID = null;
                $line->UnitCostPriceCurrencyID = null;

                
                $line->save();
                
            }

            foreach ($request->id as $key => $value) {
                if($value == ""){

                    $line = new Ordercustline();
                    $line->ProductNumber = $request->productname[$key];
                    $line->OrderID =  $data->id;
                    $line->ProductID = $request->productid[$key];
                    $line->UnitCostPrice = str_replace(",","", $request->costprice[$key]);
                    $line->UnitCustPrice = str_replace(",","", $request->custprice[$key]);
                    $line->QuantityOrdered = str_replace(",","", $request->ordered[$key]);
                    $line->QuantityDelivered = str_replace(",","", $request->delivered[$key]);
                    $line->Vat = $request->vat[$key];
                    $line->Active = 1;
                    $line->LineNum = $request->linenum[$key];
                    $line->Comments = null;
                    $line->VatID = null;
                    $line->TaxFree = null;
                    $line->ValidFromDate = null;
                    $line->ValidToDate = null;
                    $line->ProductName = $request->productname[$key];
                    $line->ProductVariantID = null;
                    $line->pricegroupid = null;
                    $line->InsertedByPersonID = Auth::user()->id;
                    $line->created_at = null;
                    $line->Discount = null;
                    $line->TaxAmount = null;
                    $line->UnitCustPriceCurrencyID = null;
                    $line->UnitCostPriceCurrencyID = null;

                    
                    $line->save();
                }
            }
            
            return back()->with('success','Data has been updated');
        }

    }

    public function invoiced($OrderID)
    {
        echo " Sorry the page is still maintenance";exit;
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

    public function delete($id,$table)
    {
        if($table == 'Ordercust'){
            $hapus = Ordercust::where(['id'=>$id])->delete();
        }else if($table == 'Ordercustline'){
            $hapus = Ordercustline::where(['id'=>$id])->delete();
        }
        
        return back()->with('success','Data has been deleted');
    }
}
