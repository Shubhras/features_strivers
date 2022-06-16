<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
// use App\Models\PaymentMethod;
use Larapen\Admin\app\Http\Controllers\PanelController;
use App\Http\Requests\Admin\Request as StoreRequest;
use App\Http\Requests\Admin\Request as UpdateRequest;

class ContactController extends PanelController
{
	// use VerificationTrait;
	
	public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->xPanel->setModel('App\Models\Contact');
		// $this->xPanel->with(['post', 'package', 'paymentMethod']);
		$this->xPanel->setRoute(admin_uri('Contact'));
		$this->xPanel->setEntityNameStrings(trans('admin.Contact'), trans('admin.Contact'));
		// $this->xPanel->denyAccess(['create', 'update', 'delete']);
		// $this->xPanel->removeAllButtons(); // Remove also: 'create' & 'reorder' buttons
		// if (!request()->input('order')) {
		// 	$this->xPanel->orderBy('created_at', 'DESC');
		// }
		if (!request()->input('order')) {
			$this->xPanel->orderBy('created_at', 'DESC');
		}
		$this->xPanel->enableDetailsRow();
		$this->xPanel->allowAccess(['details_row']);
		
		$this->xPanel->addButtonFromModelFunction('top', 'bulk_delete_btn', 'bulkDeleteBtn', 'end');
		$this->xPanel->addButtonFromModelFunction('line', 'impersonate', 'impersonateBtn', 'beginning');
		$this->xPanel->removeButton('delete');
		$this->xPanel->addButtonFromModelFunction('line', 'delete', 'deleteBtn', 'end');
		
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
            'label' => '',
            'type'  => 'checkbox',
            'orderable' => false,
        ]);
        // $this->xPanel->addColumn([
		// 	'name'  => 'id',
		// 	'label' => "ID",
		// ]);
        $this->xPanel->addColumn([
            'name'  => 'created_at',
            'label' => trans('Date'),
            'type'  => 'datetime',
        ]);
		
		$this->xPanel->addColumn([
			'name'  => 'first_name',
			'label' => trans('First Name'),
		]);

		$this->xPanel->addColumn([
			'name'  => 'last_name',
			'label' => trans('Last Name'),
		]);

		$this->xPanel->addColumn([
			'name'  => 'email',
			'label' => trans('Email'),
		]);

		$this->xPanel->addColumn([
			'name'  => 'phone',
			'label' => trans('Contact Number'),
		]);

		$this->xPanel->addColumn([
			'name'  => 'subject',
			'label' => trans('Subject'),
		]);

		$this->xPanel->addColumn([
			'name'  => 'message',
			'label' => trans('Message'),
		]);

		

		// $wysiwygEditor = config('settings.other.wysiwyg_editor');
		// $wysiwygEditorViewPath = '/views/vendor/admin/panel/fields/' . $wysiwygEditor . '.blade.php';


		// $this->xPanel->addField([
		// 	'name'  => 'id',
		// 	'label' => "ID",
		// ]);
		// $this->xPanel->addField([
		// 	'name'  => 'index_header_logo_1',
		// 	'label' => trans('Header Logo 1'),
		// ]);
	// 	$this->xPanel->addField([
	// 		'name'   => 'index_header_logo_1',
	// 		'label'  => trans('Header Logo 1'),
	// 		'type'   => 'image',
	// 		'upload' => true,
	// 		'disk'   => 'public',
	// 	]);
	// 	$this->xPanel->addField([
	// 		'name'   => 'index_header_logo_2',
	// 		'label'  => trans('Header Logo 2'),
	// 		'type'   => 'image',
	// 		'upload' => true,
	// 		'disk'   => 'public',
	// 	]);

	// 	$this->xPanel->addField([
	// 		'name'   => 'index_footer_logo_1',
	// 		'label'  => trans('Footer Logo 1'),
	// 		'type'   => 'image',
	// 		'upload' => true,
	// 		'disk'   => 'public',
	// 	]);

	// 	$this->xPanel->addField([
	// 		'name'   => 'index_footer_logo_2',
	// 		'label'  => trans('Footer Logo 2'),
	// 		'type'   => 'image',
	// 		'upload' => true,
	// 		'disk'   => 'public',
	// 	]);

	// 	$this->xPanel->addField([
	// 		'name'   => 'index_section_3_image',
	// 		'label'  => trans('Index Section 3 Image'),
	// 		'type'   => 'image',
	// 		'upload' => true,
	// 		'disk'   => 'public',
	// 	]);

	// 	$this->xPanel->addField([
	// 		'name'   => 'index_header_logo_1',
	// 		'label'  => trans('Header Logo 1'),
	// 		'type'   => 'image',
	// 		'upload' => true,
	// 		'disk'   => 'public',
	// 	]);
		

	// 	$this->xPanel->addField([
	// 		'name'  => 'index_section_1_text',
	// 		'label' => trans('Section 1 Text'),
	// 	]);

	// 	$this->xPanel->addField([
	// 		'name'  => 'index_section_2',
	// 		'label' => trans('Index Section 2'),
	// 	]);

	

	// 	$this->xPanel->addField([
	// 		'name'       => 'content',
	// 		'label'      => trans('admin.Content'),
	// 		'type'       => ($wysiwygEditor != 'none' && file_exists(resource_path() . $wysiwygEditorViewPath))
	// 			? $wysiwygEditor
	// 			: 'textarea',
	// 		'attributes' => [
	// 			'placeholder' => trans('admin.Content'),
	// 			'id'          => 'pageContent',
	// 			'rows'        => 20,
	// 		],
	// 	],

	// );
		
	// $this->xPanel->addField([
	// 	'name'  => 'target_blank',
	// 	'label' => trans('admin.Open the link in new window'),
	// 	'type'  => 'checkbox_switch',
	// ]);
	
	// $this->xPanel->addField([
	// 	'name'  => 'seo_tags',
	// 	'type'  => 'custom_html',
	// 	'value' => '<br><h4 style="margin-bottom: 0;">' . trans('admin.seo_tags') . '</h4>',
	// ]);
	// $this->xPanel->addField([
	// 	'name'  => 'seo_start',
	// 	'type'  => 'custom_html',
	// 	'value' => '<hr style="border: 1px dashed #EFEFEF; margin-top: 0; margin-bottom: 2px;">',
	// ]);
	// $this->xPanel->addField([
	// 	'name'  => 'dynamic_variables_hint',
	// 	'type'  => 'custom_html',
	// 	'value' => trans('admin.dynamic_variables_hint'),
	// ]);
	// $this->xPanel->addField([
	// 	'name'              => 'seo_title',
	// 	'label'             => trans('admin.Title'),
	// 	'type'              => 'text',
	// 	'attributes'        => [
	// 		'placeholder' => trans('admin.Title'),
	// 	],
	// 	'hint'       => trans('admin.seo_title_hint'),
	// ]);
	// $this->xPanel->addField([
	// 	'name'       => 'seo_description',
	// 	'label'      => trans('admin.Description'),
	// 	'type'       => 'textarea',
	// 	'attributes' => [
	// 		'placeholder' => trans('admin.Description'),
	// 	],
	// 	'hint'       => trans('admin.seo_description_hint'),
	// ]);
	// $this->xPanel->addField([
	// 	'name'       => 'seo_keywords',
	// 	'label'      => trans('admin.Keywords'),
	// 	'type'       => 'textarea',
	// 	'attributes' => [
	// 		'placeholder' => trans('admin.Keywords'),
	// 	],
	// 	'hint'  => trans('admin.comma_separated_hint') . ' ' . trans('admin.seo_keywords_hint'),
	// ]);
	
	// $this->xPanel->addField([
	// 	'name'  => 'seo_end',
	// 	'type'  => 'custom_html',
	// 	'value' => '<hr style="border: 1px dashed #EFEFEF;">',
	// ]);
	
	
	// $this->xPanel->addField([
	// 	'name'  => 'active',
	// 	'label' => trans('admin.Active'),
	// 	'type'  => 'checkbox_switch',
	// ]);

		


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
