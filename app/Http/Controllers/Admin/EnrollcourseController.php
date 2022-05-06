<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\Payment;
use Larapen\Admin\app\Http\Controllers\PanelController;
use App\Http\Requests\Admin\Request as StoreRequest;
use App\Http\Requests\Admin\Request as UpdateRequest;


// use Larapen\Admin\app\Http\Controllers\PanelController;
// use Illuminate\Http\Request;


class EnrollcourseController extends PanelController
{
    public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->xPanel->setModel('App\Models\Payment');
		$this->xPanel->with(['post', 'package', 'paymentMethod','payments']);
		$this->xPanel->with(['post', 'users', 'User_id','users']);
		$this->xPanel->setRoute(admin_uri('payments'));
		$this->xPanel->setEntityNameStrings(trans('admin.payment'), trans('admin.payments'));
		$this->xPanel->denyAccess(['create', 'update', 'delete']);
		$this->xPanel->removeAllButtons(); // Remove also: 'create' & 'reorder' buttons
		if (!request()->input('order')) {
			$this->xPanel->orderBy('created_at', 'DESC');
		}
		
		// Filters
		// -----------------------
		$this->xPanel->disableSearchBar();
		// -----------------------
		$this->xPanel->addFilter([
			'name'  => 'id',
			'type'  => 'text',
			'label' => 'ID',
		],
		false,
		function ($value) {
			$this->xPanel->addClause('where', 'id', '=', $value);
		});
        // print_r($value);die;
		// -----------------------
		$this->xPanel->addFilter([
			'name'  => 'from_to',
			'type'  => 'date_range',
			'label' => trans('admin.Date range'),
		],
		false,
		function ($value) {
			$dates = json_decode($value);
			$this->xPanel->addClause('where', 'created_at', '>=', $dates->from);
			$this->xPanel->addClause('where', 'created_at', '<=', $dates->to);
		});
		// -----------------------
		$this->xPanel->addFilter([
			'name'        => 'country',
			'type'        => 'select2',
			'label'       => mb_ucfirst(trans('admin.country')),
			'placeholder' => trans('admin.select'),
		],
		getCountries(),
		function ($value) {
			$this->xPanel->addClause('whereHas', 'post', function($query) use ($value) {
				$query->where('country_code', '=', $value);
			});
		});
		// -----------------------
		$this->xPanel->addFilter([
			'name'  => 'post_id',
			'type'  => 'text',
			'label' => trans('admin.Ad'),
		],
		false,
		function ($value) {
			if (is_numeric($value)) {
				$this->xPanel->addClause('where', 'post_id', '=', $value);
			} else {
				$this->xPanel->addClause('whereHas', 'post', function ($query) use ($value) {
					$query->where('title', 'LIKE', $value . '%');
				});
			}
		});
		// -----------------------
		$this->xPanel->addFilter([
			'name'  => 'Plan',
			'type'  => 'dropdown',
			'label' => trans('admin.Package'),
		],
		$this->getPackages(),
		function ($value) {
			$this->xPanel->addClause('where', 'package_id', '=', $value);

			
		});
		
		
		$this->xPanel->addFilter([
			'name'  => 'name',
			'type'  => 'dropdown',
			'label' => trans('admin.name'),
		],
		$this->getUserMethods(),
		function ($value) {
			$this->xPanel->addClause('where', 'user_id', '=', $value);
			
		});


		
        //-----------------------
        // $this->xPanel->addFilter([
		// 	'name'  => 'name',
		// 	'type'  => 'dropdown',
		// 	'label' => trans('admin.payment'),
		// ],
		// $this->getPayment(),
		// function ($value) {
		// 	$this->xPanel->addClause('where', 'package_id', '=', $value);
		// });
		// -----------------------
		$this->xPanel->addFilter([
			'name'  => 'payment_method',
			'type'  => 'dropdown',
			'label' => trans('admin.Payment Method'),
		],
		$this->getPaymentMethods(),
		function ($value) {
			$this->xPanel->addClause('where', 'payment_method_id', '=', $value);
		});
		// -----------------------
		$this->xPanel->addFilter([
			'name'  => 'status',
			'type'  => 'dropdown',
			'label' => trans('admin.Status'),
		], [
			1 => trans('admin.Unapproved'),
			2 => trans('admin.Approved'),
		], function ($value) {
			if ($value == 1) {
				$this->xPanel->addClause('where', function ($query) {
					$query->where(function ($query) {
						$query->where('active', '!=', 1)->orWhereNull('active');
					});
				});
			}
			if ($value == 2) {
				$this->xPanel->addClause('where', 'active', '=', 1);
			}
		});
		
		
		/*
		|--------------------------------------------------------------------------
		| COLUMNS AND FIELDS
		|--------------------------------------------------------------------------
		*/
		// COLUMNS
		$this->xPanel->addColumn([
			'name'  => 'id',
			'label' => "ID",
		]);
		$this->xPanel->addColumn([
			'name'  => 'created_at',
			'label' => trans('admin.Date'),
		]);

		// $this->xPanel->addColumn([
		// 	'name'  => 'user_id',
		// 	'label' => trans('user_id'),
		// ]);

		$this->xPanel->addColumn([
			'name'          => 'admin.user_id',
			'label'         => trans('admin.name'),
			'type'          => 'model_function',
			'function_name' => 'getUserNameHtml',
		]);

        // $this->xPanel->addColumn([
		// 	'name'          => 'admin.name',
		// 	'label'         => trans('admin.Ad'),
		// 	'type'          => 'model_function',
		// 	'function_name' => 'getPostTitleHtml',
		// ]);
		$this->xPanel->addColumn([
			'name'          => 'post_id',
			'label'         => trans('plan'),
			'type'          => 'model_function',
			'function_name' => 'getPostTitleHtml',
		]);
        
		
		

		$this->xPanel->addColumn([
			'name'          => 'admin.name as payment_method',
			'label'         => trans('admin.Payment Method'),
			'type'          => 'model_function',
			'function_name' => 'getPaymentMethodNameHtml',
		]);
		$this->xPanel->addColumn([
			'name'          => 'active',
			'label'         => trans('admin.Approved'),
			'type'          => 'model_function',
			'function_name' => 'getActiveHtml',
		]);
		
		// FIELDS
	}
	
	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}
	
	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
	
	public function getPackages()
	{
		$entries = Package::where('price', '>', 0)->orderBy('currency_code', 'asc')->orderBy('lft', 'asc')->get();
		
		$arr = [];
		if ($entries->count() > 0) {
			foreach ($entries as $entry) {
				$arr[$entry->id] = $entry->name . ' (' . $entry->price . ' ' . $entry->currency_code . ')';
			}
		}
        // print_r($entry);die;
		
		return $arr;
	}

	// public function getUserName()
	// {
	// 	$entries = Package::where('price', '>', 0)->orderBy('currency_code', 'asc')->orderBy('lft', 'asc')->get();
		
	// 	$arr = [];
	// 	if ($entries->count() > 0) {
	// 		foreach ($entries as $entry) {
	// 			$arr[$entry->id] = $entry->name . ' (' . $entry->price . ' ' . $entry->currency_code . ')';
	// 		}
	// 	}
    //     // print_r($entry);die;
		
	// 	return $arr;
	// }

	
	public function getPaymentMethods()
	{
		$entries = PaymentMethod::orderBy('lft', 'asc')->get();
		
		$arr = [];
		if ($entries->count() > 0) {
			foreach ($entries as $entry) {
				$arr[$entry->id] = $entry->display_name;
			}
		}
        // print_r($arr);die;
		
		return $arr;
	}

	public function getUserMethods()
	{
		$entriess = Payment::get();

		$arr = [];
        
		foreach($entriess as $key=> $userId){
		$userPayment= $userId->user_id;
		
		

		$entries = User::select('name','email')->where('id',$userPayment)->orderBy('id', 'asc')->get();
		// print_r($userPayment);die;
		
		if ($entries->count() > 0) {
			foreach ($entries as $entry) {
				$arr[$entry->id] = $entry->name;
				
			}
		}
       
		
		
	}
	// print_r($arr);die;

	return $arr;
	
	} 
    public function getPayment()
	{
		$entries = Payment::orderBy('id', 'asc')->get();
		
		$arr = [];
		if ($entries->count() > 0) {
			foreach ($entries as $entry) {
				$arr[$entry->id] = $entry->transaction_id;
			}
		}
        // print_r($arr[$entry->id]);die;
		
		return $arr;
	}


    
}
