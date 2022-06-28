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

class StickyHeaderLogoController extends PanelController
{
    public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		
        
		$this->xPanel->setModel('App\Models\StickyHeaderLogo');
		$this->xPanel->setRoute(admin_uri('sticky_header_logo'));
		$this->xPanel->setEntityNameStrings(trans('Sticky Header Logo'), trans('Sticky Header Logo'));
		if (!request()->input('order')) {
			$this->xPanel->orderBy('created_at', 'DESC');
		}
		$this->xPanel->enableDetailsRow();
		$this->xPanel->allowAccess(['details_row']);
		
		// $this->xPanel->addButtonFromModelFunction('top', 'bulk_delete_btn', 'bulkDeleteBtn', 'end');
		$this->xPanel->addButtonFromModelFunction('line', 'impersonate', 'impersonateBtn', 'beginning');
		

        
		$this->xPanel->addColumn([
			'name'          => 'picture',
			'label'         => trans('Sticky Header logo'),
			
		]);
		



        $wysiwygEditor = config('settings.other.wysiwyg_editor');
		$wysiwygEditorViewPath = '/views/vendor/admin/panel/fields/' . $wysiwygEditor . '.blade.php';

        $this->xPanel->addField([
			'name'       => 'picture',
			'label'      => trans('Sticky Header logo'),
			'type'   => 'image',
			'upload' => true,
			'disk'   => 'public',
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


