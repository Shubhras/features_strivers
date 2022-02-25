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

namespace App\Http\Controllers\Web;

use App\Helpers\ArrayHelper;
use App\Helpers\UrlGen;
use App\Models\Post;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\SubAdmin1;
use App\Models\City;
use App\Models\User;
use App\Models\Package;
use App\Http\Resources\EntityCollection;
use App\Http\Resources\PackageResource;
use Illuminate\Support\Facades\Cache;
use Torann\LaravelMetaTags\Facades\MetaTag;
use DB;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Auth;

class HomeController extends FrontController
{
	/**
	 * HomeController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$data = [];
		$countryCode = config('country.code');
		
		// Get all homepage sections
		$cacheId = $countryCode . '.homeSections';
		$data['sections'] = Cache::remember($cacheId, $this->cacheExpiration, function () use ($countryCode) {
			$sections = collect();
			
			// Check if the Domain Mapping plugin is available
			if (config('plugins.domainmapping.installed')) {
				try {
					$sections = \extras\plugins\domainmapping\app\Models\DomainHomeSection::where('country_code', $countryCode)->orderBy('lft')->get();
				} catch (\Throwable $e) {
				}
			}
			
			// Get the entry from the core
			if ($sections->count() <= 0) {
				$sections = HomeSection::orderBy('lft')->get();
			}
			
			return $sections;
		});
		
		$searchFormOptions = [];
		if ($data['sections']->count() > 0) {
			foreach ($data['sections'] as $section) {
				// Clear method name
				$method = str_replace(strtolower($countryCode) . '_', '', $section->method);
				
				// Check if method exists
				if (!method_exists($this, $method)) {
					continue;
				}
				
				// Call the method
				try {
					if (isset($section->value)) {
						$this->{$method}($section->value);
					} else {
						$this->{$method}();
					}
					
					// Get the search area background image
					if ($method == 'getSearchForm') {
						$searchFormOptions = $section->value;
						
					}
				} catch (\Throwable $e) {
					flash($e->getMessage())->error();
					continue;
				}

			}
			

		}


		

		$data['user'] = DB::table('users')->select('users.*')->where('users.user_type_id',2)->whereNotIn('users.id', [1])->orderBy('users.id','desc')->limit(6)->get();

		$data['our_reviews'] = DB::table('users')->select('users.*')->where('users.user_type_id',2)->whereNotIn('users.id', [1])->orderBy('users.id','asc')->limit(3)->get();


		$data['our_review_coaches'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
		->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
		->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
		->where('users.id',2)->first();

		$data['user_course']= DB::table('coach_course')->select('course_name','course_hourse')->get();
		$data['user_striver'] = DB::table('users')->select('users.*')->where('users.user_type_id',3)->whereNotIn('users.id', [1])->orderBy('users.id','desc')->limit(3)->get();

		$packages = Package::query()->applyCurrency();
		
		$embed = explode(',', request()->get('embed'));
		
		if (in_array('currency', $embed)) {
			$packages->with('currency');
		}
		
		$packages->orderBy('lft');
		
		$packages = $packages->get();
		
		$data['packages'] = new EntityCollection(class_basename($this), $packages);
		// print_r($data['packages']);die;
		// Get SEO
		$this->setSeo($searchFormOptions);



		$data['categories_list_coach'] = DB::table('categories')->select('categories.slug','categories.id','categories.name')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();
		// print_r($data['categories_list_coach']);die;
		
		return appView('home.index', $data);
	}
	
	/**
	 * Get search form (Always in Top)
	 *
	 * @param array $value
	 */
	protected function getSearchForm($value = [])
	{
		view()->share('searchFormOptions', $value);
	}
	
	/**
	 * Get locations & SVG map
	 *
	 * @param array $value
	 */
	protected function getLocations($value = [])
	{
		// Get the default Max. Items
		$maxItems = 14;
		if (isset($value['max_items'])) {
			$maxItems = (int)$value['max_items'];
		}
		
		// Get the Default Cache delay expiration
		$cacheExpiration = $this->getCacheExpirationTime($value);
		
		// Modal - States Collection
		$cacheId = config('country.code') . '.home.getLocations.modalAdmins';
		$modalAdmins = Cache::remember($cacheId, $cacheExpiration, function () {
			return SubAdmin1::currentCountry()->orderBy('name')->get(['code', 'name'])->keyBy('code');
		});
		view()->share('modalAdmins', $modalAdmins);
		
		// Get cities
		if (config('settings.listing.count_cities_posts')) {
			$cacheId = config('country.code') . 'home.getLocations.cities.withCountPosts';
			$cities = Cache::remember($cacheId, $cacheExpiration, function () use ($maxItems) {
				return City::currentCountry()->withCount('posts')->take($maxItems)->orderByDesc('population')->orderBy('name')->get();
			});
		} else {
			$cacheId = config('country.code') . 'home.getLocations.cities';
			$cities = Cache::remember($cacheId, $cacheExpiration, function () use ($maxItems) {
				return City::currentCountry()->take($maxItems)->orderByDesc('population')->orderBy('name')->get();
			});
		}
		$cities = collect($cities)->push(ArrayHelper::toObject([
			'id'             => 0,
			'name'           => t('More cities') . ' &raquo;',
			'subadmin1_code' => 0,
		]));
		
		// Get cities number of columns
		$numberOfCols = 4;
		if (file_exists(config('larapen.core.maps.path') . strtolower(config('country.code')) . '.svg')) {
			if (isset($value['show_map']) && $value['show_map'] == '1') {
				$numberOfCols = (isset($value['items_cols']) && !empty($value['items_cols'])) ? (int)$value['items_cols'] : 3;
			}
		}
		
		// Chunk
		$maxRowsPerCol = round($cities->count() / $numberOfCols, 0); // PHP_ROUND_HALF_EVEN
		$maxRowsPerCol = ($maxRowsPerCol > 0) ? $maxRowsPerCol : 1;  // Fix array_chunk with 0
		$cities = $cities->chunk($maxRowsPerCol);
		
		view()->share('cities', $cities);
		view()->share('citiesOptions', $value);
	}
	
	/**
	 * Get sponsored posts
	 *
	 * @param array $value
	 */
	protected function getSponsoredPosts($value = [])
	{
		$type = 'sponsored';
		
		// Get the default Max. Items
		$maxItems = 20;
		if (isset($value['max_items'])) {
			$maxItems = (int)$value['max_items'];
		}
		
		// Get the default orderBy value
		$orderBy = 'random';
		if (isset($value['order_by'])) {
			$orderBy = $value['order_by'];
		}
		
		// Get the default Cache delay expiration
		$cacheExpiration = $this->getCacheExpirationTime($value);
		
		// Get featured posts
		$cacheId = config('country.code') . '.home.getPosts.' . $type;
		$posts = Cache::remember($cacheId, $cacheExpiration, function () use ($maxItems, $type, $orderBy) {
			return Post::getLatestOrSponsored($maxItems, $type, $orderBy);
		});
		
		$widgetSponsoredPosts = null;
		if ($posts->count() > 0) {
			$widgetSponsoredPosts = [
				'title'   => t('Home - Sponsored Ads'),
				'link'    => UrlGen::search(),
				'posts'   => $posts,
				'options' => [],
			];
			$widgetSponsoredPosts = ArrayHelper::toObject($widgetSponsoredPosts);
			$widgetSponsoredPosts->options = $value;
		}
		
		view()->share('widgetSponsoredPosts', $widgetSponsoredPosts);
	}
	
	/**
	 * Get latest posts
	 *
	 * @param array $value
	 */
	protected function getLatestPosts($value = [])
	{
		$type = 'latest';
		
		// Get the default Max. Items
		$maxItems = 12;
		if (isset($value['max_items'])) {
			$maxItems = (int)$value['max_items'];
		}
		
		// Get the default orderBy value
		$orderBy = 'date';
		if (isset($value['order_by'])) {
			$orderBy = $value['order_by'];
		}
		
		// Get the Default Cache delay expiration
		$cacheExpiration = $this->getCacheExpirationTime($value);
		
		// Get latest posts
		$cacheId = config('country.code') . '.home.getPosts.' . $type;
		$posts = Cache::remember($cacheId, $cacheExpiration, function () use ($maxItems, $type, $orderBy) {
			return Post::getLatestOrSponsored($maxItems, $type, $orderBy);
		});
		
		$widgetLatestPosts = null;
		if (!empty($posts)) {
			$widgetLatestPosts = [
				'title'   => t('Home - Latest Ads'),
				'link'    => UrlGen::search(),
				'posts'   => $posts,
				'options' => [],
			];
			$widgetLatestPosts = ArrayHelper::toObject($widgetLatestPosts);
			$widgetLatestPosts->options = $value;
		}
		
		view()->share('widgetLatestPosts', $widgetLatestPosts);
	}
	
	/**
	 * Get list of categories
	 *
	 * @param array $value
	 */


	protected function getCoaches($value = [])
	{
		// Get the default Max. Items
		$maxItems = null;
		if (isset($value['max_items'])) {
			$maxItems = (int)$value['max_items'];
		}
		
		// Number of columns
		$numberOfCols = 3;
		
		// Get the Default Cache delay expiration
		$cacheExpiration = $this->getCacheExpirationTime($value);

		//print_r($cacheExpiration);die;
		
		$cacheId = 'categories.parents.' . config('app.locale') . '.take.' . $maxItems;
		
		if (isset($value['type_of_display']) && in_array($value['type_of_display'], ['cc_normal_list', 'cc_normal_list_s'])) {
			
			$categories = Cache::remember($cacheId, $cacheExpiration, function () {
				$categories = Category::orderBy('lft')->get();
				
				return $categories;
			});
			$categories = collect($categories)->keyBy('id');
			$categories = $subCategories = $categories->groupBy('parent_id');
			
			if ($categories->has(null)) {
				if (!empty($maxItems)) {
					$categories = $categories->get(null)->take($maxItems);
				} else {
					$categories = $categories->get(null);
				}
				$subCategories = $subCategories->forget(null);
				
				$maxRowsPerCol = round($categories->count() / $numberOfCols, 0, PHP_ROUND_HALF_EVEN);
				$maxRowsPerCol = ($maxRowsPerCol > 0) ? $maxRowsPerCol : 1;
				$categories = $categories->chunk($maxRowsPerCol);
			} else {
				$categories = collect();
				$subCategories = collect();
			}
			
			view()->share('coach', $categories);
			view()->share('subCategories', $subCategories);
			
		} else {
			
			$categories = Cache::remember($cacheId, $cacheExpiration, function () use ($maxItems) {
				if (!empty($maxItems)) {
					$categories = Category::where(function ($query) {
						$query->where('parent_id', 0)->orWhereNull('parent_id');
					})->take($maxItems)->orderBy('lft')->get();
				} else {
					$categories = Category::where(function ($query) {
						$query->where('parent_id', 0)->orWhereNull('parent_id');
					})->orderBy('lft')->get();
				}
				
				return $categories;
			});
			
			if (isset($value['type_of_display']) && $value['type_of_display'] == 'c_picture_icon') {
				$categories = collect($categories)->keyBy('id');
			} else {
				// $maxRowsPerCol = round($categories->count() / $numberOfCols, 0); // PHP_ROUND_HALF_EVEN
				$maxRowsPerCol = ceil($categories->count() / $numberOfCols);
				$maxRowsPerCol = ($maxRowsPerCol > 0) ? $maxRowsPerCol : 1; // Fix array_chunk with 0
				$categories = $categories->chunk($maxRowsPerCol);
			}
			
			view()->share('coach', $categories);
			
		}
		
		// Count Posts by category (if the option is enabled)
		$countPostsByCat = collect();
		if (config('settings.listing.count_categories_posts')) {
			$cacheId = config('country.code') . '.count.posts.by.cat.' . config('app.locale');
			$countPostsByCat = Cache::remember($cacheId, $cacheExpiration, function () {
				$countPostsByCat = Category::countPostsByCategory();
				
				return $countPostsByCat;
			});
		}
		view()->share('countPostsByCat', $countPostsByCat);
		
		// Export the Options
		view()->share('categoriesOptions', $value);
	}

	protected function getCategories($value = [])
	{
		// Get the default Max. Items
		$maxItems = null;
		if (isset($value['max_items'])) {
			$maxItems = (int)$value['max_items'];
		}
		
		// Number of columns
		$numberOfCols = 3;
		
		// Get the Default Cache delay expiration
		$cacheExpiration = $this->getCacheExpirationTime($value);
		
		$cacheId = 'categories.parents.' . config('app.locale') . '.take.' . $maxItems;
		
		if (isset($value['type_of_display']) && in_array($value['type_of_display'], ['cc_normal_list', 'cc_normal_list_s'])) {
			
			$categories = Cache::remember($cacheId, $cacheExpiration, function () {
				$categories = Category::orderBy('lft')->get();
				
				return $categories;
			});
			$categories = collect($categories)->keyBy('id');
			$categories = $subCategories = $categories->groupBy('parent_id');
			
			if ($categories->has(null)) {
				if (!empty($maxItems)) {
					$categories = $categories->get(null)->take($maxItems);
				} else {
					$categories = $categories->get(null);
				}
				$subCategories = $subCategories->forget(null);
				
				$maxRowsPerCol = round($categories->count() / $numberOfCols, 0, PHP_ROUND_HALF_EVEN);
				$maxRowsPerCol = ($maxRowsPerCol > 0) ? $maxRowsPerCol : 1;
				$categories = $categories->chunk($maxRowsPerCol);
			} else {
				$categories = collect();
				$subCategories = collect();
			}
			
			view()->share('categories', $categories);
			view()->share('subCategories', $subCategories);
			
		} else {
			
			$categories = Cache::remember($cacheId, $cacheExpiration, function () use ($maxItems) {
				if (!empty($maxItems)) {
					$categories = Category::where(function ($query) {
						$query->where('parent_id', 0)->orWhereNull('parent_id');
					})->take($maxItems)->orderBy('lft')->get();
				} else {
					$categories = Category::where(function ($query) {
						$query->where('parent_id', 0)->orWhereNull('parent_id');
					})->orderBy('lft')->get();
				}
				
				return $categories;
			});
			
			if (isset($value['type_of_display']) && $value['type_of_display'] == 'c_picture_icon') {
				$categories = collect($categories)->keyBy('id');
			} else {
				// $maxRowsPerCol = round($categories->count() / $numberOfCols, 0); // PHP_ROUND_HALF_EVEN
				$maxRowsPerCol = ceil($categories->count() / $numberOfCols);
				$maxRowsPerCol = ($maxRowsPerCol > 0) ? $maxRowsPerCol : 1; // Fix array_chunk with 0
				$categories = $categories->chunk($maxRowsPerCol);
			}
			
			view()->share('categories', $categories);
			
		}
		
		// Count Posts by category (if the option is enabled)
		$countPostsByCat = collect();
		if (config('settings.listing.count_categories_posts')) {
			$cacheId = config('country.code') . '.count.posts.by.cat.' . config('app.locale');
			$countPostsByCat = Cache::remember($cacheId, $cacheExpiration, function () {
				$countPostsByCat = Category::countPostsByCategory();
				
				return $countPostsByCat;
			});
		}
		view()->share('countPostsByCat', $countPostsByCat);
		
		// Export the Options
		view()->share('categoriesOptions', $value);
	}
	
	/**
	 * Get mini stats data
	 *
	 * @param array $value
	 */
	protected function getStats($value = [])
	{
		// Count posts
		$countPosts = Post::currentCountry()->unarchived()->count();
		
		// Count cities
		$countCities = City::currentCountry()->count();
		
		// Count users
		$countUsers = User::count();
		
		// Share vars
		view()->share('countPosts', $countPosts);
		view()->share('countCities', $countCities);
		view()->share('countUsers', $countUsers);
		
		// Export the Options
		view()->share('statsOptions', $value);
	}
	
	/**
	 * Get the text area data
	 *
	 * @param array $value
	 */
	protected function getTextArea($value = [])
	{
		// Export the Options
		view()->share('textOptions', $value);
	}
	
	/**
	 * Set SEO information
	 *
	 * @param array $searchFormOptions
	 */
	protected function setSeo($searchFormOptions = [])
	{
		// Meta Tags
		[$title, $description, $keywords] = getMetaTag('home');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);
		
		// Open Graph
		$this->og->title($title)->description($description);
		$backgroundImage = '';
		if (!empty(config('country.background_image'))) {
			if (isset($this->disk) && $this->disk->exists(config('country.background_image'))) {
				$backgroundImage = config('country.background_image');
			}
		}
		if (empty($backgroundImage)) {
			if (isset($searchFormOptions['background_image']) && !empty($searchFormOptions['background_image'])) {
				$backgroundImage = $searchFormOptions['background_image'];
			}
		}
		if (!empty($backgroundImage)) {
			if ($this->og->has('image')) {
				$this->og->forget('image')->forget('image:width')->forget('image:height');
			}
			$this->og->image(imgUrl($backgroundImage, 'bgHeader'), [
				'width'  => 600,
				'height' => 600,
			]);
		}
		view()->share('og', $this->og);
	}
	
	/**
	 * @param array $value
	 * @return int
	 */
	private function getCacheExpirationTime($value = [])
	{
		// Get the default Cache Expiration Time
		$cacheExpiration = 0;
		if (isset($value['cache_expiration'])) {
			$cacheExpiration = (int)$value['cache_expiration'];
		}
		
		return $cacheExpiration;
	}


	public function user_login(Request $request) {
		
		$email = $request->input('login');
		$password = $request->input('password');
		 
		

		$users_context_id = DB::table('users')->where('email', $email)->first();

		//print_r($users_context_id);die;

		if (!empty($users_context_id)) {
			//$users_context_id_del = DB::table('users')->join('employees', 'employees.id', '=', 'users.context_id')->where('users.email', $email)->where('employees.deleted_at', NULL)->first();

			// $users_context_id_delete_date = DB::table('users')->select('users.deleted_at')->where('email', $email)->first();
			// $users_context_id_delete_date = DB::table('users')->select('employees.deleted_at')->join('employees', 'employees.id', '=', 'users.context_id')->where('users.email', $email)->first();
			// $delete_date = $users_context_id_delete_date->deleted_at;

			if (!empty($users_context_id)) {

				//$user_context_id = $users_context_id->context_id;

				$checkLogin = DB::table('users')->where(['email' => $email, 'password' => $password])->get();

				if (auth()
					->attempt(['email' => $email, 'password' => $password])) {
					$id = Auth::user()->id;
					$userId = DB::table('users')->where('users.id', $id)
						->first(['users.*']);

					if ($userId->verified_email == 1) {
						Session()
							->flash('strivre', 'welcome');
						if ($userId->user_type_id == 2) {
							

							return redirect('/account');
						} elseif ($userId->user_type_id == 3) {

							return redirect('/account');
							// return redirect('/received-notification');
						}

					} 
					// else {
					// 	$user_login_id = $userId->id;
					// 	$data1['login_user_id'] = $user_login_id;
					// 	$user_login_email = $userId->email;
					// 	$data1['user_login_email'] = $user_login_email;

					// 	$mobile = $userId->mobile;
					// 	$data1['mobile'] = $mobile;

					// 	$data = $this->common();
					// 	Session()
					// 		->flash('loginerrors', 'You have not confirmed your OTP yet. please enter OTP');
					// 	return view('header', $data) . view('confirm_otp', $data1) . view('footer', $data);

					// }

				} else {
					Session()->flash('loginerror', 'Your email and password not valid !');
				}
			} else {
				//$data = $this->common();
				// $data4['users_context_id_delete_date'] = $users_context_id_delete_date;
				// Session()
				// 	->flash('loginerrors', 'Your account deleted at ' . $users_context_id_delete_date->deleted_at);
				// return view('header', $data) . view('newlogin', $data4) . view('footer', $data);
				// return redirect()->back()withError('Your account was blocked at ' . $data4);
			}
		} else {
			Session()
				->flash('loginerror', 'User not available');
		}

		// return redirect()
		//     ->back()
		//     ->withInput();
		return redirect('/');

	}
	public function register_new_user(Request $request)
	{
		
	
		// Call API endpoint
		$endpoint = '/users';
		$data = makeApiRequest('post', $endpoint, $request->all());
		
		//print_r($data);die;
		// Parsing the API's response
		$message = !empty(data_get($data, 'message')) ? data_get($data, 'message') : 'Unknown Error.';
		
		// HTTP Error Found
		if (!data_get($data, 'isSuccessful')) {
			return back()->withErrors(['error' => $message])->withInput();
		}
		
		// Notification Message
		if (data_get($data, 'success')) {
			session()->put('message', $message);
		} else {
			flash($message)->error();
		}
		
		// Get User Resource
		$user = data_get($data, 'result');
		
		// Get the next URL
		$nextUrl = url('register/finish');
		
		if (
			data_get($data, 'extra.sendEmailVerification.emailVerificationSent')
			|| data_get($data, 'extra.sendPhoneVerification.phoneVerificationSent')
		) {
			session()->put('userNextUrl', $nextUrl);
			
			if (data_get($data, 'extra.sendEmailVerification.emailVerificationSent')) {
				session()->put('emailVerificationSent', true);
				
				// Show the Re-send link
				$this->showReSendVerificationEmailLink($user, 'users');
			}
			
			if (data_get($data, 'extra.sendPhoneVerification.phoneVerificationSent')) {
				session()->put('phoneVerificationSent', true);
				
				// Show the Re-send link
				$this->showReSendVerificationSmsLink($user, 'users');
				
				// Go to Phone Number verification
				$nextUrl = url('users/verify/phone/');
			}
		} else {
			if (
				!empty(data_get($data, 'extra.authToken'))
				&& !empty(data_get($user, 'id'))
			) {
				// Auto logged in the User
				if (auth()->loginUsingId(data_get($data, 'result.id'))) {
					session()->put('authToken', data_get($data, 'extra.authToken'));
					$nextUrl = url('account');
				}
			}
		}
		
		// Mail Notification Message
		if (data_get($data, 'extra.mail.message')) {
			$mailMessage = data_get($data, 'extra.mail.message');
			if (data_get($data, 'extra.mail.success')) {
				flash($mailMessage)->success();
			} else {
				flash($mailMessage)->error();
			}
		}
		
		
		return redirect($nextUrl);
	}
}
