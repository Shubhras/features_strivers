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
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Files\Storage\StorageDisk;
use Auth;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Web\Session;

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
		$user1 = auth()->user();
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

		// print_r(json_decode($user1->category));die;

		if (empty(auth()->user())) {

			$data['user'] = DB::table('users')->select('users.*', 'categories.name as categories_slug')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->where('users.user_type_id', 2)
				->whereNotIn('users.id', [1])
				->inRandomOrder()
				->limit(6)
				->get();
		} else {

			if (!empty($user1->category)) {

				$conditions = $user1->category;
				$x = explode(",", $conditions);
				$catss =  json_encode($x);
				$catUser = json_decode($catss);
				// print_r($conditions);die;
				$data = [];
				foreach ($catUser as $val) {

					$q1 = DB::table('categories')->where('categories.id', $val)->first();

					$user = DB::table('users')->select('categories.name as categories_slug', 'users.*')
						// ->leftJoin('categories', DB::raw('FIND_IN_SET(categories.id, users.category)'), '>', DB::raw(0))
						->leftjoin('categories', 'categories.id', '=', 'users.category')
						// ->leftjoin('categories', 'categories.id', '=', $val)
						// ->leftJoin('categories', function ($val) {

						// 	$val->where('categories.id',$val);
						// })
						->where('users.user_type_id', 2)
						->where(json_decode('users.category', $val))
						->whereNotNull('users.category')

						->whereNotIn('users.id', [1])

						->inRandomOrder()
						->limit(6)
						->get();

					$data['user'] = $user;
				}
			} else {
				$edit_user = DB::table('users')->select('users.*')->where('users.id', $user1->id)->first();
				$data['user_auth_id'] = 	auth()->user()->id;


				$data['categories'] = DB::table('categories')->select('categories.*')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();
				return view('auth.register.user_category', $data);
			}

			// print_r($data['user']);die;


			// $condition= $data['user']
			// print_r($data['user'];die;
			// foreach($datauser as $value){

			//  }


			// $users = User::where(function($q) use ($condition){
			// 	foreach($condition as $key => $value){
			// 		$user1 = auth()->user();
			// 		$conditions =json_decode($user1->category);

			// 		$q->where('users.category', 'LIKE', $conditions);
			// 		$q->where('users.user_type_id', 2);

			// 		$q->whereNotIn('users.id', [1]);
			// 		$q->limit(6);
			// 	}
			// })->get();


			// $data['user'] = $users;


		}


		$data['our_reviews'] = DB::table('users')->select('users.*')->where('users.user_type_id', 2)->whereNotIn('users.id', [1])->orderBy('users.id', 'asc')->limit(3)->get();


		$data['our_review_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.id', 2)->first();

		$data['user_course'] = DB::table('coach_course')->select('coach_course.*', 'course_name', 'course_hourse')->orderBy('coach_course.id', 'desc')->limit(4)->get();
		$data['user_striver'] = DB::table('users')->select('users.*')->where('users.user_type_id', 3)->whereNotIn('users.id', [1])->orderBy('users.id', 'desc')->limit(3)->get();

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
		$data['index_and_footer_logo'] = DB::table('logo_header_and_footer_and_images_change')->select('logo_header_and_footer_and_images_change.*')->first();
		$data['home_section_banner_text'] = DB::table('home_section_banner_text')->select('home_section_banner_text.*')->orderBy('home_section_banner_text.id','desc')->first();


		$data['home_page_section_two__banner'] = DB::table('home_page_section_two__banner')->select('home_page_section_two__banner.*')->orderBy('home_page_section_two__banner.id','desc')->first();

		$data['home_page_section_three_banner'] = DB::table('home_page_section_three_banner')->select('home_page_section_three_banner.*')->orderBy('home_page_section_three_banner.id','desc')->first();

		$data['letest_news'] = DB::table('latest_new')->select('latest_new.*')->where('active', 1)->orderBy('latest_new.id', 'desc')->limit(4)->get();

		// $data['categories_list_coach'] = DB::table('categories')->select('categories.slug','categories.id','categories.name','users.category')->join('users' ,'categories.id' ,'=' ,'users.category')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();


		$data['categories'] = DB::table('categories')->select('categories.*')->where('categories.parent_id', null)->orderBy('categories.name', 'asc')->get();

		// print_r($data['categories']);die;

		$data['categories_list_coach343'] = DB::table('users')
			->select('users.category')
			->where('users.user_type_id', 2)->get();


		$data['categories_list_coach'] = DB::table('users')
			->select('categories.slug', 'categories.id', 'categories.name', 'users.category', 'categories.picture', 'categories.icon_class')
			->join('categories', 'categories.id', '=', 'users.category')
			->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->where('users.user_type_id', 2)->get();

		//  print_r($data['categories_list_coach343']);die;

		$unique = array();
		$uniques = array();
		$keyss = array();

		foreach ($data['categories_list_coach343'] as $value) {
			// print_r($value);die;
			$unique[$value->category] = $value;
			$uniques['key'] = $value->category;
		}

		$data['uniqueCat'] = array_values($unique);

		$data['categories_list_coach187'] = array_slice($data['uniqueCat'], 0, 6);





		$unique = array();
		$uniques = array();
		$keyss = array();

		foreach ($data['categories_list_coach'] as $value) {
			// print_r($value);die;
			$unique[$value->category] = $value;
			$uniques['key'] = $value->category;
		}

		$data['uniqueCat'] = array_values($unique);

		$data['categories_list_coach1'] = array_slice($data['uniqueCat'], 0, 6);


		// print_r($data['categories_list_coach1']);die;

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


	public function user_login(Request $request)
	{

		$email = $request->input('login');
		$password = $request->input('password');
		$course_id = $request->input('course_id');

		// print_r($request->all());
		// die;

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
					->attempt(['email' => $email, 'password' => $password])
				) {
					$id = Auth::user()->id;
					$userId = DB::table('users')->where('users.id', $id)
						->first(['users.*']);

					if ($userId->verified_email == 1) {
						Session()
							->flash('strivre', 'welcome');
						if ($userId->user_type_id == 2) {

							Session()
								->flash('strivre', 'Welcome to Coach');


							return redirect('/account');
						} elseif ($userId->user_type_id == 3) {



							if (!empty($course_id)) {

								$course_data = 'get_coach_course/' . $course_id;

								// print_r($course_data);die;


								return redirect('get_coach_course/' . $course_id);
							} else {



								Session()
									->flash('strivre', 'Welcome to Strivre');

								return redirect('/account');
							}
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
		return redirect('/login');
	}


	public function register_new_user(Request $request)
	{



		// print_r($request->all());die;

		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		//   CURLOPT_URL => 'https://206672f6b5d16174.api-us.cometchat.io/v3/users',
		//   CURLOPT_RETURNTRANSFER => true,
		//   CURLOPT_ENCODING => '',
		//   CURLOPT_MAXREDIRS => 10,
		//   CURLOPT_TIMEOUT => 0,
		//   CURLOPT_FOLLOWLOCATION => true,
		//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//   CURLOPT_CUSTOMREQUEST => 'POST',
		//   CURLOPT_POSTFIELDS => array('uid' => $request->username,'name' => $request->name),
		//   CURLOPT_HTTPHEADER => array(
		// 	'apiKey: 37e9caaa45ca1ea8240082bbef437450bce73aa5'
		//   ),
		// ));

		// $response = curl_exec($curl);

		// curl_close($curl);

		// echo $response;


		// $request['country_code'] = 'UK';


// start pdf ile upload

if ($request->user_type_id == 2) {

		$uploadfile = $request->upload_document;

		$disk = StorageDisk::getDisk();
		$attribute_name = 'pdf';


		$destination = 'app/upload_document';



		$extension = getUploadedFileExtension($uploadfile);

		if (empty($extension)) {
			$extension = 'pdf';
		}

		$upload_document =	$disk->put($destination, $uploadfile);
		$this->attributes[$attribute_name] = $destination . '/' . $uploadfile;
	}
		// print_r($extension);

// end pdf ile upload


		// Call API endpoint
		$endpoint = '/users';
		$data = makeApiRequest('post', $endpoint, $request->all());
		// $data = makeApiRequest('post', $endpoint, $user_data_request);



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



		// commetchat curl




		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://21234831742240b3.api-eu.cometchat.io/v3/users',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array('uid' => $request->username, 'name' => $request->name),
			CURLOPT_HTTPHEADER => array(
				'apiKey: 54cf45c3d0c670d9ab067f1b3498ea02873281bd'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);




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
			return redirect('login.js');
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


		$user_type_id = 	auth()->user()->user_type_id;
		$user_id = 	auth()->user()->id;
		$name = 	auth()->user()->name;
		$email = 	auth()->user()->email;


		if ($user_type_id == 2) {
			$datas = DB::table('users')->where('users.id', $user_id)->update(['upload_document' => trim($upload_document, "app/upload_document!")]);
		}


		if ($user_type_id == 3) {

			$strivreDefaultPackage = DB::table('packages')->select('packages.*')->where('packages.id', 1)->first();
			// $date = date('d-m-yy');
			// $data = array(
			// 	'user_id' => $user_id,
			// 	'package_id' => $strivreDefaultPackage->id,
			// 	'payment_method_id' => 1,
			// 	'transaction_id' => 'active',
			// 	'amount' =>$strivreDefaultPackage->price,
			// 	'email' =>$email,
			// 	'user_name' =>$name,
			// 	'active' =>1,
			// 	'created_at' => $date
			// );

			// DB::table('payments')->insert($data);

			$date = date('d-m-yy');
			$data = array(
				'user_id' => $user_id,
				'subscription_id' => $strivreDefaultPackage->id,
				'total_provided_hours' => $strivreDefaultPackage->price,
				'consumed_hours' => 0,
				'remaining_hours' => $strivreDefaultPackage->price,
				'created_at' => $date
			);

			DB::table('user_subscription_payment')->insert($data);
		}

		$data['user_auth_id'] = 	auth()->user()->id;


		$data['categories'] = DB::table('categories')->select('categories.*')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();
		$category = auth()->user()->category;

		if (empty($category)) {

			return view('auth.register.user_category', $data);
		} else {
			return redirect($nextUrl);
		}
	}

	public function updateUserCategory(Request $request)
	{

		// print_r(json_encode($request->category_id));die;
		// implode($request->category_id);
		// print_r(implode(',',$request->category_id));die;
		// $userCategory = 12;
		$auth_id = auth()->user()->id;


		DB::table('users')->where('users.id', $auth_id)->update(['users.category' => implode(',', $request->category_id)]);


		return redirect('/account');
	}

	public function coach_coursess($id)
	{
		$data = [];

		// $data['genders'] = Gender::query()->get();
		$user = auth()->user();

		if (empty($user)) {

			$data['course_id'] = $id;

			return appView('auth.login.index', $data);


			// return redirect('/login');
		}



		$data['auth_id'] = auth()->user()->id;

		$data['coach_course'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
			->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')
			// ->where('coach_course.coach_id', $user->id)
			->where('coach_course.id', $id)
			->orderBy('coach_course.id', 'asc')
			->first();

		if (empty(auth()->user())) {
			$data['coach_striver'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
				->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')->inRandomOrder()
				->limit(8)->get();
		} else {
			$data['coach_striver'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
				->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')
				->where('users.category', $user->category)
				->inRandomOrder()
				->limit(8)->get();
		}


		// print_r($data['enroll_course_by_strivre']);die;

		return appView('pages.coach_coarse', $data);
	}

	public function coach_list_category_interesting(Request $request)
	{
		// print_r($request->search);die;

		$data['request_cat_id'] = '';
		// Get the Country's largest city for Google Maps
		$cacheId = config('country.code') . '.city.population.desc.first';
		$city = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$city = City::currentCountry()->orderBy('population', 'desc')->first();

			return $city;
		});
		view()->share('city', $city);

		// print_r($id);die;

		$data['categories'] = DB::table('categories')->select('categories.name', 'categories.id')->where('categories.parent_id', null)->orderBy('categories.name', 'asc')->get();
		// print_r($data['categories']);die
		$sub_cat = [];
		foreach ($data['categories'] as $key => $value) {
			$sub_cat[] = $value->id;
		}
		// print_r($sub_cat);die();
		// $data['sub_categories'] = DB::table('categories')->select('categories.*')->orderBy('categories.name', 'asc')->where('categories.parent_id',$sub_cat)->get();
		// print_r($data['sub_categories']);die;
		// $data['sub_categories'] = DB::table('categories')->select('categories.name', 'categories.id', 'categories.parent_id','categories.slug')->where('categories.parent_id','!=', null)->orderBy('categories.name', 'asc')->get();

		$data['sub_categories'] = DB::table('categories')->select('categories.name', 'categories.id', 'categories.parent_id', 'categories.slug')->where('categories.parent_id', '!=', null)->orderBy('categories.name', 'asc')->get();


		$data['my_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)
			->orderBy('users.id', 'asc')->limit(8)->get();


		// $data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'sub.slug as slug_name')
		// 			->leftjoin('categories', 'categories.id', '=', 'users.category')
		// 			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
		// 			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
		// 			->where('users.user_type_id', 2)->where('users.name','LIKE','%'.$request->search .'%')->orderBy('users.id', 'asc')->limit(8)->get();

		// 			print_r($data['user']);die;



		// if (empty($id)) {
		if (empty($request->search)) {

			$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'sub.slug as slug_name')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();

			// $data['user'] = DB::table('users')->select('users.*', DB::raw('GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.id) as slug_name'), 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'countries.name as countries_name', 'cities.name as cities_name')
			// 	// ->leftjoin('categories', 'categories.id', '=', 'users.category')
			// 	->leftJoin('categories', DB::raw('FIND_IN_SET(categories.id, users.category)'), '>', DB::raw(0))
			// 	// ->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			// 	->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			// 	->leftjoin('countries', 'countries.code', '=', 'users.country_code')
			// 	->leftjoin('cities', 'cities.id', '=', 'users.location')
			// 	->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();

			// print_r($data['user']);die;

		} else {

			$key = $request->search;

			$user1 = auth()->user();

			if (!empty($user1)) {




				$data['user'] = DB::table('users')->select('users.*', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'countries.name as countries_name', 'cities.name as cities_name')
					// ->leftjoin('categories', 'categories.id', '=', 'users.category')
					->leftJoin('categories', DB::raw('FIND_IN_SET(categories.id, users.category)'), '>', DB::raw(0))
					->leftJoin('categories as sub', DB::raw('FIND_IN_SET(sub.id, users.sub_category)'), '>', DB::raw(0))
					// ->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
					->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
					->leftjoin('countries', 'countries.code', '=', 'users.country_code')
					->leftjoin('cities', 'cities.id', '=', 'users.location')
					->where('users.user_type_id', 2)
					->where(
						function ($query) use ($key) {

							return $query
								->where('users.name', 'LIKE', '%' . $key . '%')->orWhere('countries.name', 'LIKE', '%' . $key . '%')->orWhere('categories.name', 'LIKE', '%' . $key . '%')->orWhere('cities.name', 'LIKE', '%' . $key . '%');
						}
					)
					->groupBy('users.id')
					->orderBy('users.id', 'asc')->get();
			} else {

				$data['user'] = DB::table('users')->select('users.*', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'countries.name as countries_name', 'cities.name as cities_name')
					// ->leftjoin('categories', 'categories.id', '=', 'users.category')
					->leftJoin('categories', DB::raw('FIND_IN_SET(categories.id, users.category)'), '>', DB::raw(0))
					->leftJoin('categories as sub', DB::raw('FIND_IN_SET(sub.id, users.sub_category)'), '>', DB::raw(0))
					// ->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
					->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
					->leftjoin('countries', 'countries.code', '=', 'users.country_code')
					->leftjoin('cities', 'cities.id', '=', 'users.location')
					->where('users.user_type_id', 2)
					->where(
						function ($query) use ($key) {

							return $query
								->where('users.name', 'LIKE', '%' . $key . '%')->orWhere('countries.name', 'LIKE', '%' . $key . '%')->orWhere('categories.name', 'LIKE', '%' . $key . '%')->orWhere('cities.name', 'LIKE', '%' . $key . '%');
						}
					)
					->groupBy('users.id')
					->orderBy('users.id', 'asc')->get();
			}
		}

		// print_r($data['user']);die;


		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->inRandomOrder()->limit(8)->get();



		[$title, $description, $keywords] = getMetaTag('contact');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		$data['search_key'] = $key;

		// print_r($data);die;



		return appView('pages.category_coaches', $data);
	}

	public function all_article()
	{

		$data['article_list'] = DB::table('latest_new')
			->select('latest_new.*', 'users.name as user_name', 'users.photo')
			->leftJoin('users', 'users.id', '=', 'latest_new.user_id')
			->where('latest_new.active', 1)->get();
		// print_r($data);die;


		return appView('pages.article_list', $data);
	}

	public function contactUs(Request $request)
	{

		// print_r($request->all());die;
		$data = array([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email,
			'phone' => $request->phone,
			'subject' => $request->subject,
			'message' => $request->message
		]);

		

		// $message = !empty(data_get($dataq, 'message')) ? data_get($dataq, 'message') : 'Unknown Error.';
		// if (array_get($dataq, 'success')) {
		// 	flash($message)->success();
		// } else {
		// 	flash($message)->error();
		// }




		if (!empty($request->all())) {
			$insert_id  = DB::table('contact')->insert($data);
			
			$userEmail = 'chris@ycsdigital.com';
			// $userEmail = $request->email;

			// print_r($userEmail);die;

			$contact_id = DB::getPDO()->lastInsertId($insert_id);
			// print_r($contact_id);die;

			$contact_detail['contact_detail'] = DB::table('contact')->select('contact.*')
				->where('contact.id', $contact_id)->first();
				// print_r($contact_detail);die;
			if (env('MAIL_USERNAME') != null && env('MAIL_USERNAME') != "null" && env('MAIL_USERNAME') != "") {
				// Send mail to User his new otp
				Mail::send('emails.send_contact_detail', ['contact_detail' => $contact_detail], function ($m) use ($userEmail) {
					$m->from('ahujamohit327@gmail.com', 'ycsdigitalocean');
					$m->to($userEmail, 'Admin')->subject('New course inquiry ');
				});
			}

			$message = !empty(data_get($insert_id, 'message')) ? data_get($insert_id, 'message') : 'Unknown Error.';

		
		if (array_get($insert_id, 'success')) {
			flash($message)->success();
			return redirect('/contact');

		}  else {
			flash($message)->error();
			return redirect('/contact');
		}
	}
			// return appView('pages.contact', $data);

			
		






		
		// print_r($request->all());die;

	}
}
