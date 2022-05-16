<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoachPaymentRequest;
use App\Models\PaymentMethod;
use Larapen\Admin\app\Http\Controllers\PanelController;
use App\Http\Requests\Admin\Request as StoreRequest;
use App\Http\Requests\Admin\Request as UpdateRequest;

class CoachPaymentRequestController extends PanelController
{
	public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->xPanel->setModel('App\Models\CoachPaymentRequest');
		$this->xPanel->with(['post', 'package', 'paymentMethod']);
		$this->xPanel->setRoute(admin_uri('coach_payments'));
		$this->xPanel->setEntityNameStrings(trans('Coach payment'), trans('Coach payment'));
		$this->xPanel->denyAccess(['create', 'update', 'delete']);
		$this->xPanel->removeAllButtons(); // Remove also: 'create' & 'reorder' buttons
		if (!request()->input('order')) {
			$this->xPanel->orderBy('created_at', 'DESC');
		}
		
			// Filters
		// -----------------------
		$this->xPanel->disableSearchBar();
		// -----------------------
		
	
		
		
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
		// 	'name'          => 'coach_id',
		// 	'label'         => trans('User name'),
        //     'type'          => 'model_function',
		// 	'function_name' => 'getUserNameHtml',
            
			
		// ]);

		$this->xPanel->addColumn([
			'name'          => 'email',
			'label'         => trans('Email'),
			
		
		]);


		$this->xPanel->addColumn([
			'name'          => 'payment',
			'label'         => trans('admin.Package'),
			
			
		]);
		
		$this->xPanel->addColumn([
			'name'          => 'active',
            'label'         => trans('admin.Approved'),
			'type'          => 'model_function',
			'function_name' => 'getActiveHtml',
            'on_display'    => 'checkbox',
            
            
			
			
		]);


        
		


        $entity = $this->xPanel->getModel()->find(request()->segment(3));
        
        if (!empty($entity)) {
            $ipLink = config('larapen.core.ipLinkBase') . $entity->ip_addr;
            $this->xPanel->addField([
                'name'  => 'ip_addr',
                'type'  => 'custom_html',
                'value' => '<h5 class="mt-4"><strong>IP:</strong> <a href="' . $ipLink . '" target="_blank">' . $entity->ip_addr . '</a></h5>',
            ], 'update');
            if (!empty($entity->email)) {
                $btnUrl = admin_url('blacklists/add') . '?email=' . $entity->email;
                
                $cMsg = trans('admin.confirm_this_action');
                $cLink = "window.location.replace('" . $btnUrl . "'); window.location.href = '" . $btnUrl . "';";
                $cHref = "javascript: if (confirm('" . addcslashes($cMsg, "'") . "')) { " . $cLink . " } else { void('') }; void('')";
                
                $btnText = trans('admin.ban_the_user');
                $btnHint = trans('admin.ban_the_user_email', ['email' => $entity->email]);
                $tooltip = ' data-bs-toggle="tooltip" title="' . $btnHint . '"';
                
                $btnLink = '<a href="' . $cHref . '" class="btn btn-danger"' . $tooltip . '>' . $btnText . '</a>';
                $this->xPanel->addField([
                    'name'              => 'ban_button',
                    'type'              => 'custom_html',
                    'value'             => $btnLink,
                    'wrapperAttributes' => [
                        'style' => 'text-align:center;',
                    ],
                ], 'update');
            }
        }


        

        
		
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
		$entries = CoachPaymentRequest::where('price', '>', 0)->orderBy('currency_code', 'asc')->orderBy('lft', 'asc')->get();
		
		$arr = [];
		if ($entries->count() > 0) {
			foreach ($entries as $entry) {
				$arr[$entry->id] = $entry->name . ' (' . $entry->price . ' ' . $entry->currency_code . ')';
			}
		}
		
		return $arr;
	}
	
	public function getPaymentMethods()
	{
		$entries = PaymentMethod::orderBy('lft', 'asc')->get();
		
		$arr = [];
		if ($entries->count() > 0) {
			foreach ($entries as $entry) {
				$arr[$entry->id] = $entry->display_name;
			}
		}
		
		return $arr;
	}
}
