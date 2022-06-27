<?php
/**
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Larapen\Admin\app\Http\Controllers\PanelController;
use App\Http\Requests\Admin\PercentPaymentRequest as StoreRequest;
use App\Http\Requests\Admin\PercentPaymentRequest as UpdateRequest;

class PaymentPercentController extends PanelController
{
	public function setup()
	{

        
        
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->xPanel->setModel('App\Models\PaymentPercent');
		$this->xPanel->setRoute(admin_uri('percent_of_payment'));
		$this->xPanel->setEntityNameStrings(trans('Percentage Management'), trans('Percentage Management'));
		
        if (!request()->input('order')) {
			$this->xPanel->orderBy('created_at', 'DESC');
		}
		$this->xPanel->enableDetailsRow();
		$this->xPanel->allowAccess(['details_row']);
		
		
		// Get Countries codes
		$countries = Country::get(['code']);
		$countriesCodes = [];
		if ($countries->count() > 0) {
			$countriesCodes = $countries->keyBy('code')->keys()->toArray();
		}
		
		// Get the current Entry
		$entry = null;
		if (request()->segment(4) == 'edit') {
			$entry = $this->xPanel->model->find(request()->segment(3));
		}
		
		/*
		|--------------------------------------------------------------------------
		| COLUMNS AND FIELDS
		|--------------------------------------------------------------------------
		*/
		// COLUMNS
		$this->xPanel->addColumn([
            'name'  => 'id',
            'label' => 'ID',
            'type'  => 'checkbox',
            'orderable' => false,
        ]);
		$this->xPanel->addColumn([
			'name'  => 'admin_percent',
			'label' => trans('Percent'),
		]);
		$this->xPanel->addColumn([
			'name'          => 'updated_at',
			'label'         => trans('updated_at'),
			
		]);
		
		// FIELDS
        
		
		
		// $skippedId = (is_numeric($this->entryId)) ? $this->entryId : -1;
		$wysiwygEditor = config('settings.other.wysiwyg_editor');
		$wysiwygEditorViewPath = '/views/vendor/admin/panel/fields/' . $wysiwygEditor . '.blade.php';
		
		$this->xPanel->addField([
			'name'       => 'admin_percent',
			'label'      => trans('Percent'),
			'type'       => 'text',
			
		]);
		
	
		// $this->xPanel->addField([
		// 	'name'        => 'icon_class',
		// 	'label'       => trans('admin.Icon'),
		// 	'type'        => 'select2_from_array',
		// 	'options'     => collect(config('fontello'))->map(function ($iconCode, $iconClass) {
		// 		return $iconClass . ' (' . $iconCode . ')';
		// 	})->toArray(),
		// 	'allows_null' => true,
		// 	'hint'        => trans('admin.Used in the categories area on the home and sitemap pages'),
		// ]);
		
		
		
	
		// $this->xPanel->addField([
		// 	'name'  => 'seo_end',
		// 	'type'  => 'custom_html',
		// 	'value' => '<hr style="border: 1px dashed #EFEFEF;">',
		// ]);
		
		// $this->xPanel->addField([
		// 	'name'    => 'active',
		// 	'label'   => trans('admin.Active'),
		// 	'type'    => 'checkbox_switch',
		// 	'default' => '1',
		// ], 'create');
		// $this->xPanel->addField([
		// 	'name'  => 'active',
		// 	'label' => trans('admin.Active'),
		// 	'type'  => 'checkbox_switch',
		// ], 'update');
	}
	
	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}
	
	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
	
}
