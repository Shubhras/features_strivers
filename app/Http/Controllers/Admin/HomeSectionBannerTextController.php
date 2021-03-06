<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Categories\AdjacentToNested;

namespace App\Http\Controllers\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Scopes\VerifiedScope;
use App\Models\User;
use Illuminate\Support\Str;
use Larapen\Admin\app\Http\Controllers\PanelController;
use App\Http\Requests\Admin\PageRequest as StoreRequest;
use App\Http\Requests\Admin\PageRequest as UpdateRequest;
use Prologue\Alerts\Facades\Alert;

// use App\Http\Requests\Admin\HomePageBannerRequest as StoreRequest;
// use App\Http\Requests\Admin\HomePageBannerRequest as UpdateRequest;

class HomeSectionBannerTextController extends PanelController
{
    public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		
        
		$this->xPanel->setModel('App\Models\HomeSectionBannerText');
		$this->xPanel->setRoute(admin_uri('home_section_banner'));
		$this->xPanel->setEntityNameStrings(trans('Home Page Section 1'), trans('Home Page Section 1'));
		if (!request()->input('order')) {
			$this->xPanel->orderBy('created_at', 'DESC');
		}
		$this->xPanel->enableDetailsRow();
		$this->xPanel->allowAccess(['details_row']);
		
		$this->xPanel->addButtonFromModelFunction('top', 'bulk_delete_btn', 'bulkDeleteBtn', 'end');
		$this->xPanel->addButtonFromModelFunction('line', 'impersonate', 'impersonateBtn', 'beginning');
		

        
		$this->xPanel->addColumn([
			'name'          => 'picture',
			'label'         => trans('Home Banner Image'),
			
		]);
		$this->xPanel->addColumn([
			'name'  => 'home_page_section_banner_text',
			'label' => trans('Home Page text'),
		]);

        
     
		


        $wysiwygEditor = config('settings.other.wysiwyg_editor');
		$wysiwygEditorViewPath = '/views/vendor/admin/panel/fields/' . $wysiwygEditor . '.blade.php';

        $this->xPanel->addField([
			'name'       => 'picture',
			'label'      => trans('Home Banner (Recommended Size 1800px ?? 1000px)'),
			'type'   => 'image',
			'upload' => true,
			'disk'   => 'public',
		]);
        
		// $this->xPanel->addField([
		// 	'name'       => 'home_page_section_banner_text',
		// 	'label'      => trans('home page section banner text'),
		// 	'type'       => ($wysiwygEditor != 'none' && file_exists(resource_path() . $wysiwygEditorViewPath))
		// 		? $wysiwygEditor
		// 		: 'textarea',
		// 	'attributes' => [
		// 		'placeholder' => trans('home page section banner text'),
		// 		'rows'        => 20,
		// 	],
		// ]);

		$this->xPanel->addField([
			'name'       => 'home_page_section_banner_text',
			'label'      => mb_ucfirst(trans('Text')),
			'type'       => 'text',
			'attributes' => [
				'placeholder' => mb_ucfirst(trans('Text')),
			],
		]);
	
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
