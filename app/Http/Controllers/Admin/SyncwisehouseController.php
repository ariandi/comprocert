<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Admin\Rangeproduct;
use App\Entities\Admin\Product;
use App\Entities\Admin\Producttext;
use App\Entities\Admin\Productmedia;
use App\Entities\Admin\Company;
use App\Entities\Admin\Companystructure;
use App\Entities\Admin\Companypersonstruct;
use App\Entities\Admin\Extraquestion;
use App\Entities\Admin\Ssclub;
use App\Entities\Admin\Role;
use App\Entities\Admin\Roleaction;
use App\Entities\Admin\Roleperson;
use App\Entities\Admin\Statement;
use App\Entities\Admin\Statementstruct;
use Auth;
use Session;

class SyncwisehouseController extends Controller
{
		private
	        $apiURI = 'publish.detailresultx_laravel',
	        $constant = [
	            'languages' => ['en' => 'English', 'no' => 'Norway', 'pl' => 'Polish', 'id' => 'Indonesia'],
	            'roles' => ['admin' => 'Admin', 'viewer' => 'Viewer']
	        ];

	  public function index()
    {
    	return view('admin.sync.index');
    }

    public function syncRangeProduct()
    {
    	$params = [
            			'laravelwisehouse' => 'setSyncRangeProduct',
        				];

    	$data = \Menus::getJsonPostDataNew($this->apiURI, $params);

      foreach ($data as $key => $value) {
        
        $import = Rangeproduct::updateOrCreate(
          [
              'user_id' => $value->PersonID, 'ProductID' => $value->ProductID,
              'date' => date('Y-m-d', strtotime($value->date))
          ], 
          [
              'Child1' => floatval($value->Child1),
              'Child2' => floatval($value->Child2), 
              'Child3' => floatval($value->Child3), 
              'Child4' => floatval($value->Child4),
              'Child5' => floatval($value->Child5), 
              'Child6' => floatval($value->Child6), 
              'nilai' => floatval($value->nilai),
              'ChangedByPersonID' => Auth::user()->id,
              'CreatedByPersonID' => Auth::user()->id, 
          ]
        );
      }

      return back()->with('success', 'Success Sync Rangeproduct Data');
    }

    public function syncProduct()
    {
    	$params = [
            			'laravelwisehouse' => 'setSyncProduct',
        				];

    	$data = \Menus::getJsonPostDataNew($this->apiURI, $params);

      foreach ($data->product as $key => $value) {

        $prodData[] = [
					          		'id' => $value->ProductID,
					          		'ProductNumber' => $value->ProductNumber,
												'SupplierID' => intval($value->SupplierID),
												'UnitCostPrice' => floatval($value->UnitCostPrice),
												'UnitCustPrice' => floatval($value->UnitCustPrice),
												'Active' => intval($value->Active),
												'ValidFrom' => date('Y-m-d', strtotime($value->ValidFrom)),
												'ValidTo' => date('Y-m-d', strtotime($value->ValidTo)),
												'ProductHeight' => $value->ProductHeight,
												'ProductWidth' => $value->ProductWidth,
												'ProductLength' => $value->ProductLength,
												'ProductWeight' => $value->ProductWeight,
												'TaxFreeCustPrice' => $value->TaxFreeCustPrice,
												'ProductUnit' => $value->ProductUnit,
												'VatID' => intval($value->VatID),
												'ProductCurrency' => $value->ProductCurrency,
												'ChangedByPersonID' => Auth::user()->id,
												'CreatedByPersonID' => Auth::user()->id,
												'AccountPlanID' => intval($value->AccountPlanID),
												'ClassificationID' => $value->ClassificationID,
												'ProjectID' => $value->ProjectID,
												'Stock' => $value->Stock,
												'EAN' => $value->EAN,
												'UnitPerLayer' => $value->UnitsPerLayer,
												'ProductVolume' => $value->ProductVolume,
												'QuantityPerUnit' => $value->QuantityPerUnit,
												'LayersPerPallet' => $value->LayersPerPallet,
												'ProductVolumeUnit' => intval($value->ProductVolumeUnit),
					          ];
      	
      }

      \DB::table('products')->truncate();
      \DB::table('products')->insert($prodData);

      foreach ($data->productText as $key2 => $value2) {
        $prodTextData[] = [
								          		'ProductID' => $value2->ProductID, 
								          		'LanguageID' => $value2->LanguageID,
              								'ProductName' => $value2->ProductName,
              								'ProductText' => $value2->ProductText,
								          		'Active' => $value2->Active,
								          		'ChangedByPersonID' => Auth::user()->id,
															'CreatedByPersonID' => Auth::user()->id,
															'TeaserText' => $value2->TeaserText,
															'SalesText' => $value2->SalesText,
															'TechnicalText' => $value2->TechnicalText,
															'FeatureText' => $value2->FeatureText,
								          ];
      }

      \DB::table('producttexts')->truncate();
      \DB::table('producttexts')->insert($prodTextData);

      foreach ($data->productMedia as $key3 => $value3) {
      	$import = Productmedia::updateOrCreate(
          [
              'ProductID' => $value3->ProductID, 'ProductMediaStorageID' => $value3->ProductMediaStorageID
          ], 
          [
							'Heading' => $value3->Heading,
							'Description' => $value3->Description,
							'Active' => $value3->Active,
							'ChangedByPersonID' => Auth::user()->id,
							'CreatedByPersonID' => Auth::user()->id,
          ]
        );
      }

      return back()->with('success', 'Success Sync Product Data');
    }

    public function syncCompany()
    {
    	$params = [
            			'laravelwisehouse' => 'setSyncCompany',
        				];

    	$data = \Menus::getJsonPostDataNew($this->apiURI, $params);

      foreach ($data->company as $key => $value) {
        
        $import[] = 
                    [
                        'id' => $value->CompanyID,
                    		'CompanyNumber' => $value->CompanyNumber,
                    		'CompanyName' => $value->CompanyName,
                    		'Phone' => $value->Phone,
                    		'Fax' => $value->Fax,
                    		'Status' => $value->Status,
                    		'Information' => $value->Information,
                    		'Email' => $value->Email,
                    		'WWW' => $value->WWW,
                    		'ResponsiblePersonID' => $value->ResponsiblePersonID,
          							'SalePersonID' => $value->SalePersonID,
          							'Active' => $value->Active,
          							'ValidFrom' => $value->ValidFrom,
          							'ValidTo' => $value->ValidTo,
          							'Longitude' => floatval($value->Longitude),
          							'Latitude' => floatval($value->Latitude),
          							'SubscribeValue' => $value->SubscribeValue,
          							'CurrencyID' => $value->CurrencyID,
          							'BankAccount' => $value->BankAccount,
          							'SWIFT' => $value->SWIFT,
          							'IBAN' => $value->IBAN,
          							'BankName' => $value->BankName,
          							'DeliveryCondition' => $value->DeliveryCondition,
          							'PaymentCondition' => $value->PaymentCondition,
          							'VatOutAccount' => intval($value->VatOutAccount),
          							'VatInAccount' => intval($value->VatInAccount),
          							'VatInvestmentAccount' => intval($value->VatInvestmentAccount),
          							'VatAccount' => intval($value->VatAccount),
          							'AccountSale' => $value->AccountSale,
          							'AccountInvestment' => $value->AccountInvestment,
          							'HourPrice' => $value->HourPrice,
          							'TravelPrice' => $value->TravelPrice,
          							'CostPrice' => $value->CostPrice,
          							'AccountPlanID' => $value->AccountPlanID,
          							'PKPNumber' => $value->PKPNumber,
          							'PKPUsedDate' => intval($value->PKPUsedDate),
          							'EnableSaleNumberSequence' => $value->EnableSaleNumberSequence,
          							'EnableBankNumberSequence' => $value->EnableBankNumberSequence,
          							'EnableCashNumberSequence' => $value->EnableCashNumberSequence,
          							'EnableBuyNumberSequence' => $value->EnableBuyNumberSequence,
          							'EnableSalaryNumberSequence' => $value->EnableSalaryNumberSequence,
          							'EnableAutoNumberSequence' => $value->EnableAutoNumberSequence,
          							'EnableWeeklysaleNumberSequence' => $value->EnableWeeklysaleNumberSequence,
          							'LanguageID' => $value->LanguageID,
          							'InterestRate' => $value->InterestRate,
          							'InterestDate' => $value->InterestDate,
          							'ShareValue' => $value->ShareValue,
          							'ShareNumber' => $value->ShareNumber,
          							'VoucherBankNumber' => $value->VoucherBankNumber,
          							'VoucherSaleNumber' => $value->VoucherSaleNumber,
          							'VoucherBuyNumber' => $value->VoucherBuyNumber,
          							'VoucherSalaryNumber' => $value->VoucherSalaryNumber,
          							'VoucherCashNumber' => $value->VoucherCashNumber,
          							'OpenMon' => intval($value->OpenMon),
          							'OpenTue' => intval($value->OpenTue),
          							'OpenWed' => intval($value->OpenWed),
          							'OpenThu' => intval($value->OpenThu),
          							'OpenFri' => intval($value->OpenFri),
          							'OpenSat' => intval($value->OpenSat),
          							'OpenSun' => intval($value->OpenSun),
          							'CloseMon' => intval($value->CloseMon),
          							'CloseTue' => intval($value->CloseTue),
          							'CloseWed' => intval($value->CloseWed),
          							'CloseThu' => intval($value->CloseThu),
          							'CloseFri' => intval($value->CloseFri),
          							'CloseSat' => intval($value->CloseSat),
          							'CloseSun' => intval($value->CloseSun),
          							'EnableTaxFree' => intval($value->EnableTaxFree),
          							'EnableVat' => intval($value->EnableVat),
          							'Frittisisteledd' => intval($value->Frittisisteledd),
          							'LogoMediaStorageID' => intval($value->LogoMediaStorageID),
          							'ClassificationID' => intval($value->ClassificationID),
          							'FoundedDate' => $value->FoundedDate,
          							'TagLine' => intval($value->TagLine),
          							'AddRegCode' => $value->AddRegCode,
          							'Type' => $value->Type,
          							'OrgNumber' => $value->OrgNumber,
          							'Facebook' => $value->Facebook,
          							'Twitter' => $value->Twitter,
          							'LinkedIn' => $value->LinkedIn,
          							'InsertedByPersonID' => Auth::user()->id,
          							'UpdatedByPersonID' => Auth::user()->id,
          							'isAccountSupplier' => $value->isAccountSupplier,
          							'isAccountCustomer' => $value->isAccountCustomer,
          							'isAccountProspect' => $value->isAccountProspect,
                    ];
      }

      \DB::table('companies')->truncate();
      \DB::table('companies')->insert($import);

      foreach ($data->companyStr as $key2 => $value2) {
      	$import2[] = 
          [
              'ParentCompanyID' => $value2->ParentCompanyID, 
              'ChildCompanyID' => $value2->ChildCompanyID,
          		'Active' => $value2->Active,
          		'InsertedByPersonID' => Auth::user()->id,
          		'UpdatedByPersonID' => Auth::user()->id,
          ];
      }

      \DB::table('companystructures')->truncate();
      \DB::table('companystructures')->insert($import2);

      foreach ($data->companyPerson as $key3 => $value3) {
      	$import3[] = [
              'user_id' => $value3->PersonID, 
              'CompanyID' => $value3->CompanyID,
          		'Active' => $value3->Active,
          		'InsertedByPersonID' => Auth::user()->id,
          		'UpdatedByPersonID' => Auth::user()->id,
          ];
      }

      \DB::table('companypersonstructs')->truncate();
      \DB::table('companypersonstructs')->insert($import3);

      return back()->with('success', 'Success Sync Company Data');
    }

    public function syncExtraquestion($limit = 10000, $offset = 0)
    {
    	$params = [
            			'laravelwisehouse' => 'setSyncExtraquest',
            			'limit' => $limit,
            			'offset' => $offset,
        				];

    	$data = \Menus::getJsonPostDataNew($this->apiURI, $params);

    	if($offset == 0){
      	\DB::table('extraquestions')->truncate();
      }

      foreach ($data->extraQuest as $key => $value) {
        $extraData[] = [
          	'user_id' => $value->PersonID, 
          	'ProductID' => $value->ProductID,
            'Date' => $value->Date, 
            'NodeID' => $value->NodeID,
            'Score' => $value->Score,
						// 'Comment' => $value->PersonID,
						'Active' => $value->Active,
						'page' => $value->page,
						// 'PageMobile' => $value->PageMobile,
						'ChangedByPersonID' => Auth::user()->id,
						'CreatedByPersonID' => Auth::user()->id,
          ];
      }
      // echo count($extraData);die;
      if(count($extraData) >= 10000){
      	$nilai = count($extraData);
				$bagi = 5;
				$nilaibagi = round($nilai/$bagi);
				$nilaiakhir = $nilai - $nilaibagi;
				$mulai = 0;
				$akhir = $nilaibagi;
				for($i = 0; $i < $bagi; $i++){
						$newData = array_slice($extraData, $mulai, $nilaibagi);
						\DB::table('extraquestions')->insert($newData);
				    $mulai = $akhir;
				    $akhir = $mulai+$nilaibagi;
				}
      }
      else{
      	\DB::table('extraquestions')->insert($extraData);
      }

      foreach ($data->ssClub as $key2 => $value2) {
      	$import = Ssclub::updateOrCreate(
          [
              'ClubName' => $value2->ClubName, 'ClubGroup' => $value2->ClubGroup, 
              'ClubBranch' => $value2->ClubBranch, 'Active' => $value2->Active
          ], 
          [
							'Sport' => $value2->Sport,
							'SportBranch' => $value2->SportBranch,
							'Leder' => $value2->Leder,
							'ChangedByPersonID' => Auth::user()->id,
							'CreatedByPersonID' => Auth::user()->id,
          ]
        );
      }

      return redirect()->route('sync.index')->with('success', 'Success Sync Extraquestion Data');
    }

    public function syncRole()
    {
    	$params = [
            			'laravelwisehouse' => 'setSyncRole',
        				];

    	$data = \Menus::getJsonPostDataNew($this->apiURI, $params);
    	
      foreach ($data->role as $key => $value) {
        
        $import[] = [
              'id' => $value->RoleID,
							'RoleName' => $value->RoleName,
							'Interface' => $value->Interface,
							'Description' => $value->Description,
							'Active' => $value->Active,
							'DefaultInterface' => $value->DefaultInterface,
							'DefaultModule' => $value->DefaultModule,
							'DefaultTemplate' => $value->DefaultTemplate,
							'Priority' => $value->Priority,
							'ChangedByPersonID' => Auth::user()->id,
							'CreatedByPersonID' => Auth::user()->id,
          ];
      }

      \DB::table('roles')->truncate();
      \DB::table('roles')->insert($import);

      foreach ($data->roleAction as $key2 => $value2) {
      	$import2[] = [
              'Module' => $value2->Module, 
              'Action' => $value2->Action, 
              'RoleID' => $value2->RoleID, 
              'Access' => $value2->Access,
							'ChangedByPersonID' => Auth::user()->id,
							'CreatedByPersonID' => Auth::user()->id,
          ];
      }

      \DB::table('roleactions')->truncate();
      \DB::table('roleactions')->insert($import2);

      foreach ($data->rolePerson as $key3 => $value3) {
      	$import3[] = [
              'user_id' => $value3->PersonID,  
              'RoleID' => $value3->RoleID,
          		'Active' => $value3->Active,
          		'CompanyID' => $value3->CompanyID,
							'ChangedByPersonID' => Auth::user()->id,
							'CreatedByPersonID' => Auth::user()->id,
          ];
      }

      \DB::table('rolepeople')->truncate();
      \DB::table('rolepeople')->insert($import3);

      return back()->with('success', 'Success Sync Role Data');
    }

    public function syncStatement()
    {
    	$params = [
            			'laravelwisehouse' => 'setStatement',
        				];

    	$data = \Menus::getJsonPostDataNew($this->apiURI, $params);
    	
      foreach ($data->statement as $key => $value) {
        
        $statements[] = [
              'id' => $value->NodeID,
							'title' => $value->Title,
							'tablename' => $value->TableName,
							'primarykey' => $value->PrimaryKey,
							'description' => $value->NodeDescription,
							'active' => $value->Active,
							'InsertedByPersonID' => Auth::user()->id,
							'UpdatedByPersonID' => Auth::user()->id,
          ];
      }

      \DB::table('statements')->truncate();
      \DB::table('statements')->insert($statements);

      foreach ($data->statementStruct as $key2 => $value2) {
      	$StatementStrs[] = [
              'child_id' => $value2->ChildNodeID, 
              'parent_id' => $value2->ParentNodeID, 
          		'active' => $value2->Active, 
          		'priority' => $value2->Priority,
          		'is_main_path' => $value2->isMainPath,
							'InsertedByPersonID' => Auth::user()->id,
							'UpdatedByPersonID' => Auth::user()->id,
          ];
      }

      \DB::table('statementstructs')->truncate();
      \DB::table('statementstructs')->insert($StatementStrs);

      return back()->with('success', 'Success Sync Statement Data');
    }
}
