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

class AboutUsVideoController extends PanelController
{
    public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		
        
		$this->xPanel->setModel('App\Models\AboutUsVideo');
		$this->xPanel->setRoute(admin_uri('about_us_video'));
		$this->xPanel->setEntityNameStrings(trans('About Us Video'), trans('About Us Video'));
		if (!request()->input('order')) {
			$this->xPanel->orderBy('created_at', 'DESC');
		}
		$this->xPanel->enableDetailsRow();
		$this->xPanel->allowAccess(['details_row']);
		
		// $this->xPanel->addButtonFromModelFunction('top', 'bulk_delete_btn', 'bulkDeleteBtn', 'end');
		$this->xPanel->addButtonFromModelFunction('line', 'impersonate', 'impersonateBtn', 'beginning');
		

        
		$this->xPanel->addColumn([
			'name'          => 'video',
			'label'         => trans('Uploads Video'),
			
		]);
		

        $this->xPanel->addColumn([
			'name'  => 'about_text_heading_one',
			'label' => trans('About Text Heading One'),
		]);

        $this->xPanel->addColumn([
			'name'  => 'about_text_heading_two',
			'label' => trans('About Text Heading Two'),
		]);
        $this->xPanel->addColumn([
			'name'  => 'about_text',
			'label' => trans('About Us Text'),
		]);

       

        $wysiwygEditor = config('settings.other.wysiwyg_editor');
		$wysiwygEditorViewPath = '/views/vendor/admin/panel/fields/' . $wysiwygEditor . '.blade.php';

        $this->xPanel->addField([
			'name'       => 'video',
			'label'      => trans('Uploads Video'),
			'type'   => 'image',
			'upload' => true,
			'disk'   => 'public',
		]);
        


       
		$this->xPanel->addField([
			'name'       => 'about_text_heading_one',
			'label'      => trans('About Text Heading One'),
			'type'       => 'text',
			'attributes' => [
				'placeholder' => trans('About Text Heading One'),
			],
		]);
        $this->xPanel->addField([
			'name'       => 'about_text_heading_two',
			'label'      => trans('About Text Heading Two'),
			'type'       => 'text',
			'attributes' => [
				'placeholder' => trans('About Text Heading Two'),
			],
		]);
        
        $this->xPanel->addField([
			'name'       => 'about_text',
			'label'      => trans('About Us Text'),
			'type'       => 'text',
			'attributes' => [
				'placeholder' => trans('About Us Text'),
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

