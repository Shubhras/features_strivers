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

class LogoHeaderAndFooterAndImagesChangeController extends PanelController
{
	// use VerificationTrait;
	
	public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->xPanel->setModel('App\Models\LogoHeaderAndFooterAndImagesChange');
		// $this->xPanel->with(['post', 'package', 'paymentMethod']);
		$this->xPanel->setRoute(admin_uri('logo_and_image_change'));
		// $this->xPanel->setEntityNameStrings(trans('admin.logo_header_and_footer'), trans('admin.logo_header_and_footer'));
		$this->xPanel->setEntityNameStrings(trans('Header Logo'), trans('Header Logo'));
		if (!request()->input('order')) {
			$this->xPanel->orderBy('created_at', 'DESC');
		}
		$this->xPanel->enableDetailsRow();
		$this->xPanel->allowAccess(['details_row']);
		
		// $this->xPanel->addButtonFromModelFunction('top', 'bulk_delete_btn', 'bulkDeleteBtn', 'end');
		$this->xPanel->addButtonFromModelFunction('line', 'impersonate', 'impersonateBtn', 'beginning');
		
	
		
		
		/*
		|--------------------------------------------------------------------------
		| COLUMNS AND FIELDS
		|--------------------------------------------------------------------------
		*/
		// COLUMNS
		$this->xPanel->addColumn([
			'name'          => 'picture',
			'label'         => trans('Home Header Logo'),
			
		]);
		$this->xPanel->addColumn([
			'name'  => 'change_strivre_name',
			'label' => trans('strivre name'),
		]);

		$wysiwygEditor = config('settings.other.wysiwyg_editor');
		$wysiwygEditorViewPath = '/views/vendor/admin/panel/fields/' . $wysiwygEditor . '.blade.php';


		// $this->xPanel->addField([
		// 	'name'  => 'id',
		// 	'label' => "ID",
		// ]);
		// $this->xPanel->addField([
		// 	'name'  => 'index_header_logo_1',
		// 	'label' => trans('Header Logo 1'),
		// ]);
		$wysiwygEditor = config('settings.other.wysiwyg_editor');
		$wysiwygEditorViewPath = '/views/vendor/admin/panel/fields/' . $wysiwygEditor . '.blade.php';

        $this->xPanel->addField([
			'name'       => 'picture',
			'label'      => trans('Home Banner (Recommended Size 500px X 250px)'),
			'type'   => 'image',
			'upload' => true,
			'disk'   => 'public',
		]);
        
		
		$this->xPanel->addField([
			'name'       => 'home_page_section_banner_text_top_heading',
			'label'      => trans('Home Page Section Banner Top Heading text'),
			'type'       => 'text',
			'attributes' => [
				'placeholder' => trans('Home Page Section Banner Top Heading text'),
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
