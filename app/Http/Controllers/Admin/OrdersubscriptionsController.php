<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth,
    DataTables;
use App\Entities\Admin\Product;
use App\User;
use App\Entities\Admin\Company;
use App\Entities\Admin\Companypersonstruct;
use App\Entities\Admin\Producttext;
use App\Entities\Admin\Ordersubscriptions;
use App\Entities\Admin\Ordersubscriptionlines;

class OrdersubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.ordersubscription.list");
    }

    public function getDatatablesData()
    {
        $orders = Ordersubscriptions::select(['id', 'DName','DEmail','Status', 'OrderDate'])
                ->where('Active', '1');

        // $prods = $prods->toSql();
        // $prods = $prods->get();

        // print_r($prods);die;

        return DataTables::of($orders)
                ->addColumn('action', function ($orders) {
                                return '<a href="'.route('ordersubscriptions.edit', ['id' => $orders->id]).'" class="btn btn-xs btn-primary editProds">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>
                                        <a href="'.route('ordersubscriptions.delete', ['id' => $orders->id,'table'=>'Ordersubscriptions']).'" class="btn btn-xs btn-primary deleteorder">
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

        return view("admin.ordersubscription.create",compact(['data']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = new Ordersubscriptions();
        $data->CompanyID = $request->CompanyID;
        $data->PersonID = $request->PersonID;
        $data->Status = $request->Status;
        $data->InsertedByPersonID = Auth::user()->id;
        $data->DeliveryDate = $request->DeliveryDate;
        $data->OrderDate = $request->OrderDate;
        $data->RequiredDate = $request->required;
        $data->DateShipped = $request->sent;
        $data->RetailCompanyID = $request->RetailCompanyID;
        $data->RefInternal = $request->Internelreference;
        $data->IName = $request->iname;
        $data->IEmail = $request->iemail;
        $data->IAddress = $request->iaddress;
        $data->ICity = $request->iplace;
        $data->IZipCode = $request->ipostcode;
        $data->ICountry = $request->icountry;
        $data->DName = $request->dname;
        $data->DEmail = $request->demail;
        $data->DAddress = $request->daddress;
        $data->DCity = $request->dplace;
        $data->DZipCode = $request->dpostcode;
        $data->DCountry = $request->dcountry;
        $data->SalePersonID = $request->SalesPerson;
        $data->Active = $request->active;
        $data->Discount = $request->discounts;
        $data->ResponsiblePersonID = $request->responsible;
        $data->RefCustomer = $request->clientreference;
        $data->RetailKickbackPercent = $request->RetailKickbackPercent;
        $data->CommentInternal = $request->CommentInternal;
        $data->CommentCustomer = $request->CommentCustomer;

        if($data->save()){

            foreach ($request->productid as $key => $value) {
                $dataline = Ordersubscriptionlines::create([
                    'ProductNumber' => "",
                    'OrderID' => $data->id,
                    'ProductID' => $value,
                    'UnitCostPrice' => $request->costprice[$key],
                    'UnitCustPrice' => $request->custprice[$key],
                    'QuantityOrdered' => $request->ordered[$key],
                    'QuantityDelivered' => $request->delivered[$key],
                    'Vat' => $request->vat[$key],
                    'Active' => 1,
                    'LineNum' => $request->linenum[$key],
                    'Comments' => $request->commentline[$key],
                    'VatID' => null,
                    'TaxFree' => null,
                    'ValidFromDate' =>  $request->availablefrom[$key],
                    'ValidToDate' => $request->availableto[$key],
                    'ProductName' => $request->productname[$key],
                    'ProductVariantID' => null,
                    'pricegroupid' => null,
                    'UpdatedByPersonID' => Auth::user()->id,
                    'created_at' => date('Y-m-d'),
                    'Discount' => $request->discount[$key],
                    'TaxAmount' => null,
                    'UnitCustPriceCurrencyID' => null,
                    'UnitCostPriceCurrencyID' => null
                ]);
            }
        }

         return redirect()->route('ordersubscriptions.edit',['id'=>$data->id])->with('success','Data ordersubscription has been created');
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
        $companyid = $this->getStruktur(Auth::user()->id,'company');
        
        $order = Ordersubscriptions::find($id);
        $orderline = Ordersubscriptionlines::where(['Active' => 1, 'OrderID' => $id])->get();

        $data = array();
        $data['dataproduk'] = $this->getlistproduct();
        $data['company'] = $this->getlistcompany();
        $data['person'] = $this->getlistperson();
        $data['order'] = $order;
        $data['orderline'] = $orderline;
        $data['getCompany'] = $companyid;
        $data['getEmployee'] = $this->getStruktur($companyid->id,'employee');

        $orderid =  $id;
        return view("admin.ordersubscription.edit",compact(['data','orderid']));
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
        $data = Ordersubscriptions::find($id);
        $data->CompanyID                = $request->CompanyID;
        $data->PersonID                 = $request->PersonID;
        $data->Status                   = $request->Status;
        $data->UpdatedByPersonID        =  Auth::user()->id;
        $data->DeliveryDate             = $request->DeliveryDate;
        $data->OrderDate                = $request->OrderDate;
        $data->RequiredDate             = $request->required;
        $data->DateShipped              = $request->sent;
        $data->RetailCompanyID          = $request->RetailCompanyID;
        $data->RefInternal              = $request->Internelreference;
        $data->IName                    = $request->iname;
        $data->IEmail                   = $request->iemail;
        $data->IAddress                 = $request->iaddress;
        $data->ICity                    = $request->iplace;
        $data->IZipCode                 = $request->ipostcode;
        $data->ICountry                 = $request->icountry;
        $data->DName                    = $request->dname;
        $data->DEmail                   = $request->demail;
        $data->DAddress                 = $request->daddress;
        $data->DCity                    = $request->dplace;
        $data->DZipCode                 = $request->dpostcode;
        $data->DCountry                 = $request->dcountry;
        $data->SalePersonID             = $request->SalesPerson;
        $data->Active                   = $request->active;
        $data->Discount                 = $request->discounts;
        $data->ResponsiblePersonID      = $request->responsible;
        $data->RefCustomer              = $request->clientreference;
        $data->RetailKickbackPercent    = $request->RetailKickbackPercent;
        $data->CommentInternal          = $request->CommentInternal;
        $data->CommentCustomer          = $request->CommentCustomer;

        if($data->save()){
            $dataline = Ordersubscriptionlines::where(['OrderID'=>$data->id])->get();

            foreach ($dataline as $key => $value) {

                $line = Ordersubscriptionlines::find($value->id);

                $line->ProductNumber = $request->productid[$key];
                $line->OrderID = $data->id;
                $line->ProductID = $request->productid[$key];
                $line->UnitCostPrice = $request->costprice[$key];
                $line->UnitCustPrice = $request->custprice[$key];
                $line->QuantityOrdered = $request->ordered[$key];
                $line->QuantityDelivered = $request->delivered[$key];
                $line->Vat = $request->vat[$key];
                $line->Active = 1;
                $line->LineNum = $request->linenum[$key];
                $line->Comments = $request->commentline[$key];
                $line->VatID = null;
                $line->TaxFree = null;
                $line->ValidFromDate = $request->availablefrom[$key];
                $line->ValidToDate = $request->availableto[$key];
                $line->ProductName = $request->productname[$key];
                $line->ProductVariantID = null;
                $line->pricegroupid = null;
                $line->UpdatedByPersonID = Auth::user()->id;
                $line->Discount = $request->discount[$key];
                $line->TaxAmount = null;
                $line->UnitCustPriceCurrencyID = null;
                $line->UnitCostPriceCurrencyID = null;

                $line->save();
            }

            foreach ($request->id as $key => $value) {
                if($value == ""){

                    $line = new Ordersubscriptionlines();
                    $line->ProductNumber = $request->productid[$key];
                    $line->OrderID = $data->id;
                    $line->ProductID = $request->productid[$key];
                    $line->UnitCostPrice = str_replace(",","", $request->costprice[$key]);
                    $line->UnitCustPrice = str_replace(",","", $request->custprice[$key]);
                    $line->QuantityOrdered = str_replace(",","", $request->ordered[$key]);
                    $line->QuantityDelivered = str_replace(",","", $request->delivered[$key]);
                    $line->Vat = $request->vat[$key];
                    $line->Active = 1;
                    $line->LineNum = $request->linenum[$key];
                    $line->Comments = $request->commentline[$key];
                    $line->VatID = null;
                    $line->TaxFree = null;
                    $line->ValidFromDate = $request->availablefrom[$key];
                    $line->ValidToDate = $request->availableto[$key];
                    $line->ProductName = $request->productname[$key];
                    $line->ProductVariantID = null;
                    $line->pricegroupid = null;
                    $line->InsertedByPersonID = Auth::user()->id;
                    $line->created_at = date('Y-m-d');
                    $line->Discount = $request->discount[$key];
                    $line->TaxAmount = null;
                    $line->UnitCustPriceCurrencyID = null;
                    $line->UnitCostPriceCurrencyID = null;

                    $line->save();
                }
            }

             return back()->with('success','Data has been updated');
        }
    }

    public function invoiced($id)
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
        if($table == 'Ordersubscriptions'){
            $hapus = ordersubscriptions::where(['id'=>$id])->delete();
        }else if($table == 'ordersubscriptionlines'){
            $hapus = ordersubscriptionlines::where(['id'=>$id])->delete();
        }
        
        return back()->with('success','Data has been deleted');
    }
}
