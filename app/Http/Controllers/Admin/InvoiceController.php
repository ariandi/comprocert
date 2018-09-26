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
use App\Entities\Admin\Invoiceouts;
use App\Entities\Admin\Invoiceoutlines;
use App\Entities\Admin\Producttext;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.invoice.list");
    }

    public function getDatatablesData()
    {
        $orders = Invoiceouts::select(['id', 'DName','DEmail','Status', 'OrderDate'])
                ->where('Active', '1');

        // $prods = $prods->toSql();
        // $prods = $prods->get();

        // print_r($prods);die;

        return DataTables::of($orders)
                ->addColumn('action', function ($orders) {
                                return '<a href="'.route('invoice.edit', ['id' => $orders->id]).'" class="btn btn-xs btn-primary editProds">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>
                                        <a href="'.route('invoice.delete', ['id' => $orders->id,'table'=>'Invoiceouts']).'" class="btn btn-xs btn-primary deleteorder">
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
        

        return view("admin.invoice.create",compact(['data']));
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
        $data = new Invoiceouts();
        $data->CompanyID = $request->CompanyID;
        $data->PersonID = $request->PersonID;
        $data->Status = $request->Status;
        $data->InsertedByPersonID = Auth::user()->id;
        $data->DeliveryCondition = $request->DeliveryCondition;
        $data->InvoiceDate = $request->InvoiceDate;
        $data->DueDate = $request->DueDate;
        $data->DateShipped = $request->DateShipped;
        $data->DeliveryDate = $request->DeliveryDate;
        $data->PaymentDate = $request->PaymentDate;
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
        $data->Dpack = $request->Dpack;
        $data->Discount = $request->discounts;
        $data->PaymentCondition = $request->PaymentCondition;
        $data->ResponsiblePersonID = $request->responsible;
        $data->CurrencyID = $request->CurrencyID;
        $data->RefCustomer = $request->clientreference;
        $data->RetailKickbackPercent = $request->RetailKickbackPercent;
        $data->ProjectNameInternal = $request->ProjectNameInternal;
        $data->CommentInternal = $request->CommentInternal;
        $data->ProjectNameCustomer = $request->ProjectNameCustomer;
        $data->CommentCustomer = $request->CommentCustomer;

        if($data->save()){

            foreach ($request->productid as $key => $value) {
                $dataline = Invoiceoutlines::create([
                    'ProductNumber' => $value,
                    'InvoiceID' => $data->id,
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
                    'ValidFromDate' =>  null,
                    'ValidToDate' => null,
                    'ProductName' => $request->productname[$key],
                    'ProductVariantID' => null,
                    'pricegroupid' => null,
                    'InsertedByPersonID' => Auth::user()->id,
                    'created_at' => null,
                    'Discount' => $request->discount[$key],
                    'TaxAmount' => null,
                    'UnitCustPriceCurrencyID' => null,
                    'UnitCostPriceCurrencyID' => null
                ]);
            }
        }

        return redirect()->route('invoice.edit',['id'=>$data->id])->with('success','Data ordersubscription has been created');
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
        $invoice = Invoiceouts::find($id);
        $invoiceline = Invoiceoutlines::where(['Active' => 1, 'InvoiceID' => $id])->get();

        $companyid = $this->getStruktur(Auth::user()->id,'company');

        $data = array();
        $data['dataproduk'] = $this->getlistproduct();
        $data['company'] = $this->getlistcompany();
        $data['person'] = $this->getlistperson();
        $data['invoice'] = $invoice;
        $data['invoiceline'] = $invoiceline;
        $data['getCompany'] = $companyid;
        $data['getEmployee'] =$this->getStruktur($companyid->id,'employee');
        $invoiceid =  $id;
        
        return view("admin.invoice.edit",compact(['data','invoiceid']));
         
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
        $data = Invoiceouts::find($id);
        $data->CompanyID = $request->CompanyID;
        $data->PersonID = $request->PersonID;
        $data->Status = $request->Status;
        $data->UpdatedByPersonID = Auth::user()->id;
        $data->DeliveryCondition = $request->DeliveryCondition;
        $data->InvoiceDate = $request->InvoiceDate;
        $data->DueDate = $request->DueDate;
        $data->DateShipped = $request->DateShipped;
        $data->DeliveryDate = $request->DeliveryDate;
        $data->PaymentDate = $request->PaymentDate;
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
        $data->Dpack = $request->Dpack;
        $data->Discount = $request->discounts;
        $data->PaymentCondition = $request->PaymentCondition;
        $data->ResponsiblePersonID = $request->responsible;
        $data->CurrencyID = $request->CurrencyID;
        $data->RefCustomer = $request->clientreference;
        $data->RetailKickbackPercent = $request->RetailKickbackPercent;
        $data->ProjectNameInternal = $request->ProjectNameInternal;
        $data->CommentInternal = $request->CommentInternal;
        $data->ProjectNameCustomer = $request->ProjectNameCustomer;
        $data->CommentCustomer = $request->CommentCustomer;

        if($data->save()){
            
            foreach ($request->id as $key => $value) {

                if($value == ""){

                    $line = new Invoiceoutlines();
                    $line->ProductNumber = $value;
                    $line->InvoiceID = $data->id;
                    $line->ProductID = $value;
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
                    $line->ValidFromDate =  null;
                    $line->ValidToDate =null;
                    $line->ProductName = $request->productname[$key];
                    $line->ProductVariantID = null;
                    $line->pricegroupid = null;
                    $line->UpdatedByPersonID = Auth::user()->id;
                    $line->created_at = null;
                    $line->Discount = $request->discount[$key];
                    $line->TaxAmount = null;
                    $line->UnitCustPriceCurrencyID = null;
                    $line->UnitCostPriceCurrencyID = null;

                    $line->save();
                }else{

                    $line = Invoiceoutlines::find($value);
                    $line->ProductNumber = $value;
                    $line->InvoiceID = $data->id;
                    $line->ProductID = $value;
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
                    $line->ValidFromDate =  null;
                    $line->ValidToDate =null;
                    $line->ProductName = $request->productname[$key];
                    $line->ProductVariantID = null;
                    $line->pricegroupid = null;
                    $line->InsertedByPersonID = null;
                    $line->UpdatedByPersonID = null;
                    $line->created_at = null;
                    $line->Discount = $request->discount[$key];
                    $line->TaxAmount = null;
                    $line->UnitCustPriceCurrencyID = null;
                    $line->UnitCostPriceCurrencyID = null;

                    $line->save();

                }
            }
        }

        return back()->with('success','Data has been updated');
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
        if($table == 'Invoiceouts'){
            $hapus = Invoiceouts::where(['id'=>$id])->delete();
        }else if($table == 'Invoiceoutlines'){
            $hapus = Invoiceoutlines::where(['id'=>$id])->delete();
        }
        
        return back()->with('success','Data has been deleted');
    }
}
