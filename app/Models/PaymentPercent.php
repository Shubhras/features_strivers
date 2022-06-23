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

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\CompatibleApiScope;
use App\Observers\PaymentMethodObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Larapen\Admin\app\Models\Traits\Crud;

class PaymentPercent extends BaseModel
{
	use Crud, HasFactory;
	
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_percent';
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id',
		'admin_percent',
		'updated_at',
	];
    
    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    // protected $hidden = [];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = [];
    
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
	
		PaymentPercent::observe(PaymentMethodObserver::class);
		
        static::addGlobalScope(new ActiveScope());
		static::addGlobalScope(new CompatibleApiScope());
    }
    

    public function deleteBtn($xPanel = false)
	{
		if (auth()->check()) {
			if ($this->id == auth()->user()->id) {
				return null;
			}
			if (isDemoDomain() && $this->id == 1) {
				return null;
			}
		}
		
		$url = admin_url('percent_of_payment/' . $this->id);
		
		$out = '';
		$out .= '<a href="' . $url . '" class="btn btn-xs btn-danger" data-button-type="delete">';
		$out .= '<i class="far fa-trash-alt"></i> ';
		$out .= trans('admin.delete');
		$out .= '</a>';
		
		return $out;
	}

    // public function getCountriesHtml()
    // {
    //     $out = strtoupper(trans('admin.All'));
    //     if (isset($this->countries) && !empty($this->countries)) {
    //         $countriesCropped = Str::limit($this->countries, 50, ' [...]');
    //         $out = '<div title="' . $this->countries . '">' . $countriesCropped . '</div>';
    //     }
        
    //     return $out;
    // }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    // public function payment()
    // {
    //     return $this->hasMany(Payment::class, 'payment_method_id');
    // }
    
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeActive($builder)
    {
        return $builder->where('active', 1);
    }
    
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
	// public function getDescriptionAttribute($value)
	// {
	// 	if (isset($this->name) && $this->name == 'offlinepayment') {
	// 		if (mb_strlen(trans('offlinepayment::messages.payment_method_description')) > 0) {
	// 			$value = trans('offlinepayment::messages.payment_method_description');
	// 		}
	// 	}
		
	// 	return $value;
	// }
	
    public function getCountriesAttribute($value)
    {
        // Get a custom display value
        $value = str_replace(',', ', ', strtoupper($value));
        $value = strtoupper($value);
        
        return $value;
    }
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    // public function setCountriesAttribute($value)
    // {
    //     // Get the MySQL right value
    //     $value = preg_replace('/(,|;)\s*/', ',', $value);
    //     $value = strtolower($value);
        
    //     // Check if the entry is removed
    //     if (empty($value) || $value == strtolower(trans('admin.All'))) {
    //         $value = null;
    //     }
        
    //     $this->attributes['countries'] = $value;
        
    //     return $value;
    // }
}
