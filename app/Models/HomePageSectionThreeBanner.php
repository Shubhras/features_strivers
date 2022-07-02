<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Helpers\Date;
use App\Helpers\Files\Storage\StorageDisk;
use App\Models\Scopes\LocalizedScope;
use App\Models\Scopes\VerifiedScope;
use App\Models\Traits\CountryTrait;
use App\Notifications\ResetPasswordNotification;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Larapen\Admin\app\Models\Traits\Crud;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Scopes\ActiveScope;
use Prologue\Alerts\Facades\Alert;
use App\Observers\PageObserver;

class HomePageSectionThreeBanner extends BaseUser
{
    

    use Crud, HasRoles, CountryTrait, HasApiTokens, Notifiable, HasFactory;
	
	
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'home_page_section_three_banner';
	
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
	// public $timestamps = false;
	
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
		'picture',
		'home_page_section_banner_text_three_heading',
		'home_page_section_banner_text_three',
		
	];
	public $translatable = ['picture', 'home_page_section_banner_text_three_heading','home_page_section_banner_text_three'];
	
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
	protected $dates = ['created_at', 'updated_at'];
	
	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/
	protected static function boot()
	{
		parent::boot();
		
		
        HomePageSectionThreeBanner::observe(PageObserver::class);
		
		static::addGlobalScope(new ActiveScope());
	}
	
	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */


	

    public function routeNotificationForMail()
	{
		return $this->email;
	}
	
	public function routeNotificationForNexmo()
	{
		$phone = phoneFormatInt($this->phone, $this->country_code);
		$phone = setPhoneSign($phone, 'nexmo');
		
		return $phone;
	}
	
	public function routeNotificationForTwilio()
	{
		$phone = phoneFormatInt($this->phone, $this->country_code);
		$phone = setPhoneSign($phone, 'twilio');
		
		return $phone;
	}
	
	public function sendPasswordResetNotification($token)
	{
		if (request()->filled('email') || request()->filled('phone')) {
			if (request()->filled('email')) {
				$field = 'email';
			} else {
				$field = 'phone';
			}
		} else {
			if (!empty($this->email)) {
				$field = 'email';
			} else {
				$field = 'phone';
			}
		}
		
		try {
			$this->notify(new ResetPasswordNotification($this, $token, $field));
		} catch (\Throwable $e) {
			flash($e->getMessage())->error();
		}
	}
	
	/**
	 * @return bool
	 */
	public function canImpersonate()
	{
		// Cannot impersonate from Demo website,
		// Non admin users cannot impersonate
		if (isDemoDomain() || !$this->can(Permission::getStaffPermissions())) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * @return bool
	 */
	public function canBeImpersonated()
	{
		// Cannot be impersonated from Demo website,
		// Admin users cannot be impersonated,
		// Users with the 'can_be_impersonated' attribute != 1 cannot be impersonated
		if (isDemoDomain() || $this->can(Permission::getStaffPermissions()) || $this->can_be_impersonated != 1) {
			return false;
		}
		
		return true;
	}
	
	public function impersonateBtn($xPanel = false)
	{
		// Get all the User's attributes
		$user = self::findOrFail($this->getKey());
		
		// Get impersonate URL
		$impersonateUrl = dmUrl($this->country_code, 'impersonate/take/' . $this->getKey(), false, false);
		
		// If the Domain Mapping plugin is installed,
		// Then, the impersonate feature need to be disabled
		if (config('plugins.domainmapping.installed')) {
			return null;
		}
		
		// Generate the impersonate link
		$out = '';
		if ($user->getKey() == auth()->user()->getAuthIdentifier()) {
			$tooltip = '" data-bs-toggle="tooltip" title="' . t('Cannot impersonate yourself') . '"';
			// $out .= '<a class="btn btn-xs btn-warning" ' . $tooltip . '><i class="fa fa-lock"></i></a>';
		} else if ($user->can(Permission::getStaffPermissions())) {
			$tooltip = '" data-bs-toggle="tooltip" title="' . t('Cannot impersonate admin users') . '"';
			// $out .= '<a class="btn btn-xs btn-warning" ' . $tooltip . '><i class="fa fa-lock"></i></a>';
		} else if (!isVerifiedUser($user)) {
			$tooltip = '" data-bs-toggle="tooltip" title="' . t('Cannot impersonate unactivated users') . '"';
			// $out .= '<a class="btn btn-xs btn-warning" ' . $tooltip . '><i class="fa fa-lock"></i></a>';
		} else {
			
		}
		
		return $out;
	}
	
	// public function deleteBtn($xPanel = false)
	// {
	// 	if (auth()->check()) {
	// 		if ($this->id == auth()->user()->id) {
	// 			return null;
	// 		}
	// 		if (isDemoDomain() && $this->id == 1) {
	// 			return null;
	// 		}
	// 	}
		
	// 	$url = admin_url('logo_and_image_change/' . $this->id);
		
	// 	$out = '';
	// 	$out .= '<a href="' . $url . '" class="btn btn-xs btn-danger" data-button-type="delete">';
	// 	$out .= '<i class="far fa-trash-alt"></i> ';
	// 	$out .= trans('admin.delete');
	// 	$out .= '</a>';
		
	// 	return $out;
	// }
	
	public function isOnline()
	{
		$isOnline = ($this->last_activity > Carbon::now(Date::getAppTimeZone())->subMinutes(5));
		
		// Allow only logged users to get the other users status
		$isOnline = auth()->check() ? $isOnline : false;
		
		return $isOnline;
	}
	
	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
	// public function posts()
	// {
	// 	return $this->hasMany(Post::class, 'user_id')->orderByDesc('created_at');
	// }
	
	// public function gender()
	// {
	// 	return $this->belongsTo(Gender::class, 'gender_id', 'id');
	// }
	
	// public function receivedThreads()
	// {
	// 	return $this->hasManyThrough(
	// 		Thread::class,
	// 		Post::class,
	// 		'user_id', // Foreign key on the Post table...
	// 		'post_id', // Foreign key on the Thread table...
	// 		'id',      // Local key on the User table...
	// 		'id'       // Local key on the Post table...
	// 	);
	// }
	
	// public function threads()
	// {
	// 	return $this->hasManyThrough(
	// 		Thread::class,
	// 		ThreadMessage::class,
	// 		'user_id', // Foreign key on the ThreadMessage table...
	// 		'post_id', // Foreign key on the Thread table...
	// 		'id',      // Local key on the User table...
	// 		'id'       // Local key on the ThreadMessage table...
	// 	);
	// }
	
	// public function savedPosts()
	// {
	// 	return $this->belongsToMany(Post::class, 'saved_posts', 'user_id', 'post_id');
	// }
	
	public function savedSearch()
	{
		return $this->hasMany(SavedSearch::class, 'user_id');
	}
	
	public function userType()
	{
		return $this->belongsTo(UserType::class, 'user_type_id');
	}
	
	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/
	// public function scopeVerified($builder)
	// {
	// 	$builder->where(function ($query) {
	// 		$query->where('verified_email', 1)->where('verified_phone', 1);
	// 	});
		
	// 	return $builder;
	// }
	
	// public function scopeUnverified($builder)
	// {
	// 	$builder->where(function ($query) {
	// 		$query->where('verified_email', 0)->orWhere('verified_phone', 0);
	// 	});
		
	// 	return $builder;
	// }
	
	/*
	|--------------------------------------------------------------------------
	| ACCESSORS
	|--------------------------------------------------------------------------
	*/
	public function getCreatedAtAttribute($value)
	{
		$value = new Carbon($value);
		$value->timezone(Date::getAppTimeZone());
		
		return $value;
	}
	
	public function getUpdatedAtAttribute($value)
	{
		$value = new Carbon($value);
		$value->timezone(Date::getAppTimeZone());
		
		return $value;
	}
	
	public function getLastActivityAttribute($value)
	{
		$value = new Carbon($value);
		$value->timezone(Date::getAppTimeZone());
		
		return $value;
	}
	
	public function getLastLoginAtAttribute($value)
	{
		$value = new Carbon($value);
		$value->timezone(Date::getAppTimeZone());
		
		return $value;
	}
	
	public function getDeletedAtAttribute($value)
	{
		$value = new Carbon($value);
		$value->timezone(Date::getAppTimeZone());
		
		return $value;
	}
	
	public function getCreatedAtFormattedAttribute($value)
	{
		if (!isset($this->attributes['created_at']) and is_null($this->attributes['created_at'])) {
			return null;
		}
		
		$value = new Carbon($this->attributes['created_at']);
		$value->timezone(Date::getAppTimeZone());
		
		$value = Date::formatFormNow($value);
		
		return $value;
	}
	


	public function getPictureAttribute()
	{
		if (!isset($this->attributes) || !isset($this->attributes['picture'])) {
			return null;
		}
		
		$value = $this->attributes['picture'];
		
		$disk = StorageDisk::getDisk();
		
		if (!$disk->exists($value)) {
			$value = null;
		}
		
		return $value;



       
	}
	
	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
	// public function setTitleAttribute($value)
	// {
	// 	if (empty($value)) {
	// 		$this->attributes['title'] = $this->name;
	// 	} else {
	// 		$this->attributes['title'] = $value;
	// 	}
	// }
	
	public function setPictureAttribute($value)
	{


    
		$disk = StorageDisk::getDisk();
		$attribute_name = 'picture';
		$destination_path = 'app/letest_news';
		
		// If the image was erased
		if (empty($value)) {
			// delete the image from disk
			$disk->delete($this->picture);
			
			// set null in the database column
			$this->attributes[$attribute_name] = null;
			
			return false;
		}
		
		// Check the image file
		if ($value == url('/')) {
			$this->attributes[$attribute_name] = null;
			
			return false;
		}
		
		// If laravel request->file('filename') resource OR base64 was sent, store it in the db
		try {
			if (fileIsUploaded($value)) {
				// Get file extension
				$extension = getUploadedFileExtension($value);
				if (empty($extension)) {
					$extension = 'jpg';
				}
				
				// Image quality
				$imageQuality = 100;
				
				// Image default dimensions
				$width = (int)config('larapen.core.picture.otherTypes.bgHeader.width', 1800);
				$height = (int)config('larapen.core.picture.otherTypes.bgHeader.height', 1000);
				
				// Init. Intervention
				$image = Image::make($value);
				
				// Get the image original dimensions
				$imgWidth = (int)$image->width();
				$imgHeight = (int)$image->height();
				
				// Fix the Image Orientation
				if (exifExtIsEnabled()) {
					$image = $image->orientate();
				}
				
				// If the original dimensions are higher than the resize dimensions
				// OR the 'upsize' option is enable, then resize the image
				if ($imgWidth > $width || $imgHeight > $height) {
					// Resize
					$image = $image->resize($width, $height, function ($constraint) {
						$constraint->aspectRatio();
					});
				}
				
				// Encode the Image!
				$image = $image->encode($extension, $imageQuality);
				
				// Generate a filename.
				$filename = md5($value . time()) . '.' . $extension;
				
				// Store the image on disk.
				$disk->put($destination_path . '/' . $filename, $image);
				
				// Save the path to the database
				$this->attributes[$attribute_name] = $destination_path . '/' . $filename;
			} else {
				// Retrieve current value without upload a new file.
				if (!Str::startsWith($value, $destination_path)) {
					$value = $destination_path . last(explode($destination_path, $value));
				}
				$this->attributes[$attribute_name] = $value;
			}
		} catch (\Throwable $e) {
			Alert::error($e->getMessage())->flash();
			$this->attributes[$attribute_name] = null;
			
			return false;
		}

        

	}
}
