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

use App\Helpers\UrlGen;
use App\Http\Controllers\Web\Traits\Sluggable\PageBySlug;
use App\Http\Requests\ContactRequest;
use App\Models\City;
use App\Models\Package;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Torann\LaravelMetaTags\Facades\MetaTag;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\EntityCollection;
use App\Http\Resources\PackageResource;
use App\Models\Category;
use Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class PageController extends FrontController
{
	use PageBySlug;

	/**
	 * @return mixed
	 */




	public function pricing()
	{
		// print_r($request->all());die;
		$data = [];

		// Get Packages
		$cacheId = 'packages.with.currency.' . config('app.locale');
		$packages = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$packages = Package::applyCurrency()->with('currency')->orderBy('lft')->get();

			// print_r($packages);die;

			return $packages;
		});

		// $data['courseId'] = 130;


		$data['packages'] = $packages;
		// print_r($data);die;
		// Select a Package and go to previous URL ---------------------
		// Add Listing possible URLs
		$addListingUriArray = [
			'create',
			'post\/create',
			'post\/create\/[^\/]+\/photos',
		];
		// Default Add Listing URL
		$addListingUrl = UrlGen::addPost();
		if (request()->filled('from')) {
			foreach ($addListingUriArray as $uriPattern) {
				if (preg_match('#' . $uriPattern . '#', request()->get('from'))) {
					$addListingUrl = url(request()->get('from'));
					break;
				}
			}
		}
		view()->share('addListingUrl', $addListingUrl);
		// --------------------------------------------------------------

		// Meta Tags
		[$title, $description, $keywords] = getMetaTag('pricing');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		// print_r($data);die;
		return appView('pages.pricing', $data);
	}



	public function pricingCourse(Request $request)
	{
		// print_r($request->all());die;
		$data = [];

		// Get Packages
		$cacheId = 'packages.with.currency.' . config('app.locale');
		$packages = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$packages = Package::applyCurrency()->with('currency')->orderBy('lft')->get();

			// print_r($packages);die;

			return $packages;
		});

		$data['courseId'] = $request->course_id;


		$data['packages'] = $packages;
		// print_r($data);die;
		// Select a Package and go to previous URL ---------------------
		// Add Listing possible URLs
		$addListingUriArray = [
			'create',
			'post\/create',
			'post\/create\/[^\/]+\/photos',
		];
		// Default Add Listing URL
		$addListingUrl = UrlGen::addPost();
		if (request()->filled('from')) {
			foreach ($addListingUriArray as $uriPattern) {
				if (preg_match('#' . $uriPattern . '#', request()->get('from'))) {
					$addListingUrl = url(request()->get('from'));
					break;
				}
			}
		}
		view()->share('addListingUrl', $addListingUrl);
		// --------------------------------------------------------------

		// Meta Tags
		[$title, $description, $keywords] = getMetaTag('pricing');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		// print_r($data);die;
		return appView('pages.pricing', $data);
	}


	/**
	 * @param $slug
	 * @return \Illuminate\Http\RedirectResponse|mixed
	 */
	public function cms($slug)
	{
		// Get the Page
		$page = $this->getPageBySlug($slug);
		if (empty($page)) {
			abort(404);
		}

		view()->share('page', $page);
		view()->share('uriPathPageSlug', $slug);

		// Check if an external link is available
		if (!empty($page->external_link)) {
			return redirect()->away($page->external_link, 301)->withHeaders(config('larapen.core.noCacheHeaders'));
		}

		// Meta Tags
		[$title, $description, $keywords] = getMetaTag('staticPage');
		$title = str_replace('{page.title}', $page->seo_title, $title);
		$title = str_replace('{app.name}', config('app.name'), $title);
		$title = str_replace('{country.name}', config('country.name'), $title);

		$description = str_replace('{page.description}', $page->seo_description, $description);
		$description = str_replace('{app.name}', config('app.name'), $description);
		$description = str_replace('{country.name}', config('country.name'), $description);

		$keywords = str_replace('{page.keywords}', $page->seo_keywords, $keywords);
		$keywords = str_replace('{app.name}', config('app.name'), $keywords);
		$keywords = str_replace('{country.name}', config('country.name'), $keywords);

		if (empty($title)) {
			$title = $page->title . ' - ' . config('app.name');
		}
		if (empty($description)) {
			$description = Str::limit(str_strip(strip_tags($page->content)), 200);
		}

		$title = removeUnmatchedPatterns($title);
		$description = removeUnmatchedPatterns($description);
		$keywords = removeUnmatchedPatterns($keywords);

		MetaTag::set('title', $title);
		MetaTag::set('description', $description);
		MetaTag::set('keywords', $keywords);

		// Open Graph
		$this->og->title($title)->description($description);
		if (!empty($page->picture)) {
			if ($this->og->has('image')) {
				$this->og->forget('image')->forget('image:width')->forget('image:height');
			}
			$this->og->image(imgUrl($page->picture, 'bgHeader'), [
				'width'  => 600,
				'height' => 600,
			]);
		}
		view()->share('og', $this->og);

		return appView('pages.cms');
	}


	public function letestCms($slug)
	{

		$user = auth()->user();
		if (empty($user)) {

			return redirect('/login');
		} else {

			if ($user->user_type_id == 3) {

				// Get the Page
				$page = $this->getLetestBySlug($slug);
				if (empty($page)) {
					abort(404);
				}

				view()->share('page', $page);
				view()->share('uriPathPageSlug', $slug);

				// Check if an external link is available
				if (!empty($page->external_link)) {
					return redirect()->away($page->external_link, 301)->withHeaders(config('larapen.core.noCacheHeaders'));
				}

				// Meta Tags
				[$title, $description, $keywords] = getMetaTag('staticPage');
				$title = str_replace('{page.title}', $page->seo_title, $title);
				$title = str_replace('{app.name}', config('app.name'), $title);
				$title = str_replace('{country.name}', config('country.name'), $title);

				$description = str_replace('{page.description}', $page->seo_description, $description);
				$description = str_replace('{app.name}', config('app.name'), $description);
				$description = str_replace('{country.name}', config('country.name'), $description);

				$keywords = str_replace('{page.keywords}', $page->seo_keywords, $keywords);
				$keywords = str_replace('{app.name}', config('app.name'), $keywords);
				$keywords = str_replace('{country.name}', config('country.name'), $keywords);

				if (empty($title)) {
					$title = $page->title . ' - ' . config('app.name');
				}
				if (empty($description)) {
					$description = Str::limit(str_strip(strip_tags($page->content)), 200);
				}

				$title = removeUnmatchedPatterns($title);
				$description = removeUnmatchedPatterns($description);
				$keywords = removeUnmatchedPatterns($keywords);

				MetaTag::set('title', $title);
				MetaTag::set('description', $description);
				MetaTag::set('keywords', $keywords);

				// Open Graph
				$this->og->title($title)->description($description);
				if (!empty($page->picture)) {
					if ($this->og->has('image')) {
						$this->og->forget('image')->forget('image:width')->forget('image:height');
					}
					$this->og->image(imgUrl($page->picture, 'bgHeader'), [
						'width'  => 600,
						'height' => 600,
					]);
				}
				view()->share('og', $this->og);



				$articleData = DB::table('latest_new')->select('latest_new.*')->where('latest_new.slug', $slug)->first();



				if (empty($articleData->price)) {

					return appView('pages.letest_cms');
				} else {
					

					$enroll_course_by_strivre = DB::table('article_price')->select('article_price.article_id', 'article_price.strivre_id')->where('article_price.strivre_id', $user->id)->where('article_price.article_id', $articleData->id)->first();
					
						if (empty($enroll_course_by_strivre && $user->id)) {
							$enroldStrvreCourse = 0;

							return appView('pages.article_payment');
						} else {


							$enroldStrvreCourse = $enroll_course_by_strivre->article_id;



							if ($enroldStrvreCourse == $articleData->id && $enroll_course_by_strivre->strivre_id == $user->id) {

								Session()
									->flash('loginerrorenroll', 'You have already enroll article .');
								// return redirect()
								// 	->back();
								return appView('pages.letest_cms');
							}
						}
						// } else {
						// 	// return appView('pages.article_payment');
						// }
					}
				
			} else {


				$page = $this->getLetestBySlug($slug);
				if (empty($page)) {
					abort(404);
				}

				view()->share('page', $page);
				view()->share('uriPathPageSlug', $slug);

				// Check if an external link is available
				if (!empty($page->external_link)) {
					return redirect()->away($page->external_link, 301)->withHeaders(config('larapen.core.noCacheHeaders'));
				}

				// Meta Tags
				[$title, $description, $keywords] = getMetaTag('staticPage');
				$title = str_replace('{page.title}', $page->seo_title, $title);
				$title = str_replace('{app.name}', config('app.name'), $title);
				$title = str_replace('{country.name}', config('country.name'), $title);

				$description = str_replace('{page.description}', $page->seo_description, $description);
				$description = str_replace('{app.name}', config('app.name'), $description);
				$description = str_replace('{country.name}', config('country.name'), $description);

				$keywords = str_replace('{page.keywords}', $page->seo_keywords, $keywords);
				$keywords = str_replace('{app.name}', config('app.name'), $keywords);
				$keywords = str_replace('{country.name}', config('country.name'), $keywords);

				if (empty($title)) {
					$title = $page->title . ' - ' . config('app.name');
				}
				if (empty($description)) {
					$description = Str::limit(str_strip(strip_tags($page->content)), 200);
				}

				$title = removeUnmatchedPatterns($title);
				$description = removeUnmatchedPatterns($description);
				$keywords = removeUnmatchedPatterns($keywords);

				MetaTag::set('title', $title);
				MetaTag::set('description', $description);
				MetaTag::set('keywords', $keywords);

				// Open Graph
				$this->og->title($title)->description($description);
				if (!empty($page->picture)) {
					if ($this->og->has('image')) {
						$this->og->forget('image')->forget('image:width')->forget('image:height');
					}
					$this->og->image(imgUrl($page->picture, 'bgHeader'), [
						'width'  => 600,
						'height' => 600,
					]);
				}
				view()->share('og', $this->og);




				return appView('pages.letest_cms');
			}
		}
	}


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function contact()
	{
		// Get the Country's largest city for Google Maps
		$cacheId = config('country.code') . '.city.population.desc.first';
		$city = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$city = City::currentCountry()->orderBy('population', 'desc')->first();

			return $city;
		});
		view()->share('city', $city);

		// Meta Tags
		[$title, $description, $keywords] = getMetaTag('contact');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		return appView('pages.contact');
	}

	public function coach_details($id)
	{

		$user = auth()->user();
		if ($user != "") {


			$data['login_id'] = $user->id;
		} else {
			$data['login_id'] = 0;
		}
		// Get the Country's largest city for Google Maps
		$cacheId = config('country.code') . '.city.population.desc.first';
		$city = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$city = City::currentCountry()->orderBy('population', 'desc')->first();

			return $city;
		});
		view()->share('city', $city);


		$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.id', $id)->first();


		$user_category = $data['user']->category;
		//print_r($user_category);die;

		$data['related_coaches'] = DB::table('users')->select('users.*', 'categories.slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.category', $user_category)->get();
		//print_r($data['related_coaches']);die;

		$data['categories'] = DB::table('categories')->select('categories.slug', 'categories.id', 'categories.name')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();


		$data['sub_categories'] = DB::table('categories')->select('categories.slug', 'categories.id')->orderBy('categories.slug', 'asc')->whereNotIn('categories.parent_id', ['null'])->get();
		//print_r($data['user']);die;
		// Meta Tags


		[$title, $description, $keywords] = getMetaTag('contact');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		return appView('pages.coach_details', $data);
	}




	/**
	 * @param \App\Http\Requests\ContactRequest $request
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */


	public function coach_list_category2($id)
	{

		// print_r($id);die;

		// Get the Country's largest city for Google Maps
		$cacheId = config('country.code') . '.city.population.desc.first';
		$city = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$city = City::currentCountry()->orderBy('population', 'desc')->first();

			return $city;
		});
		view()->share('city', $city);

		// print_r($id);die;


		// $data['user'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
		// ->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
		// ->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
		// ->where('users.category',$id)->where('users.user_type_id',2)->orWhere('users.sub_category',$id)->get();


		if (!empty($id)) {


			$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.category', $id)->where('users.user_type_id', 2)->get();
		} else {

			$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();
		}

		// $data['my_coaches'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
		// ->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
		// ->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
		// ->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
		// ->where('users.user_type_id',2)->orderBy('users.id','asc')->limit(8)->get();



		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();

		$data['sub_cat_id'] = DB::table('categories')->select('categories.*')->orderBy('categories.name', 'asc')->where('categories.parent_id', $id)->get();


		$data['categories'] = DB::table('categories')->select('categories.name', 'categories.id')->where('categories.parent_id', null)->orderBy('categories.name', 'asc')->get();



		// Meta Tags
		$data['request_cat_id'] = $id;
		// print_r($data['user']);die;

		[$title, $description, $keywords] = getMetaTag('contact');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		$data['search_key'] = ' ';

		return appView('pages.category_coaches', $data);
		$data42['category'] = $data;
		return $data42;
	}




	public function coach_list_category_all($id)
	{
// print_r($id);die;
		$user1 = auth()->user();
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

		$data['sub_categories'] = DB::table('categories')->select('categories.name', 'categories.id', 'categories.parent_id', 'categories.slug')->where('categories.parent_id', '!=', null)->orderBy('categories.name', 'asc')->get();


		$data['my_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();



		// if (empty($id)) {
		if ($id == '0') {

			$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'sub.slug as slug_name')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(6)->get();

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
			$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'sub.slug as slug_name')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)->where('users.category', 'like', '%'.$id.'%')->whereNotNull('users.category')->orderBy('users.id', 'asc')->limit(8)->get();

		// print_r($data['user']);die;

				
		}

		// $data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'sub.slug as slug_name')
		// 		->leftjoin('categories', 'categories.id', '=', 'users.category')
		// 		->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
		// 		->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
		// 		->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();

		// $category= json_decode($user1->category);
		if (empty(auth()->user())) {
			$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();
		} else {
			// $data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			// 	->leftjoin('categories', 'categories.id', '=', 'users.category')
			// 	->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			// 	->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			// 	->where('users.user_type_id', 2)
			// 	->where('users.category', $user1->category)
			// 	->orderBy('users.id', 'asc')->inRandomOrder()->limit(8)->get();


				// $conditions =json_decode($user1->category);
				$conditions = $user1->category;
			$x = explode(",", $conditions);
			$catss =  json_encode($x);
			$catUser = json_decode($catss);
			
			$userss =[];
			foreach($catUser as $val){
				
			// $q1 = DB::table('categories')->where('categories.id',$val)->first();
			
			$userss = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)
			->where(json_decode('users.category',$val))
			->whereNotNull('users.category')
			
			->whereNotIn('users.id', [1])
			
			->inRandomOrder()
			->limit(8)
			->get();

		}
		$data['suggested_coaches']= $userss;
	}

		[$title, $description, $keywords] = getMetaTag('contact');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		$data['search_key'] = '';

		// print_r($data['suggested_coaches']);die;

		return appView('pages.category_coaches', $data);
	}




	public function coach_list_category_all_filter(Request $request)
	{
// print_r($request->all());die;
		
		

		$data['sub_categories'] = DB::table('categories')->select('categories.name', 'categories.id', 'categories.parent_id', 'categories.slug')->where('categories.parent_id', '!=', null)->orderBy('categories.name', 'asc')->get();


		$data['my_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();



	

			$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'sub.slug as slug_name')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)->where('users.category', 'like', '%'.$request->id.'%' )->whereNotNull('users.category')->orderBy('users.id', 'asc')->limit(8)->get();

		// print_r($data['user']);die;

				
		// }

		return $data['user'];

		// return appView('pages.category_coaches', $data);
	}






	public function coach_list_sub_category($id)
	{

		$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'sub.name as sub_cat', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.sub_category', 'categories.id')->where('users.user_type_id', 2)->get();


		$data['categories'] = DB::table('categories')->select('categories.name', 'categories.id')->where('categories.parent_id', null)->orderBy('categories.name', 'asc')->get();

		// Meta Tags
		$data['request_cat_id'] = $id;

		[$title, $description, $keywords] = getMetaTag('contact');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		return appView('pages.coach_list_sub_cat', $data);
	}



	public function contactPost(ContactRequest $request)
	{
		// Add required data in the request for API
		request()->merge([
			'country_code' => config('country.code'),
			'country_name' => config('country.name'),
		]);

		// Call API endpoint
		$endpoint = '/contact';
		$data = makeApiRequest('post', $endpoint, $request->all());

		// Parsing the API's response
		$message = !empty(data_get($data, 'message')) ? data_get($data, 'message') : 'Unknown Error.';

		// HTTP Error Found
		if (!data_get($data, 'isSuccessful')) {
			return back()->withErrors(['error' => $message])->withInput();
		}

		// Notification Message
		if (data_get($data, 'success')) {
			flash($message)->success();
		} else {
			flash($message)->error();
		}

		return redirect(UrlGen::contact());
	}
	public function top_coach_detail($id)
	{
		$user1 = auth()->user();
		// $data['user'] = DB::table('users')->where('id',$id)->select('users.*','id','name')
		// ->where('users.user_type_id',2)->get();
		$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'sub.name as sub_cat', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.id', $id)->where('users.user_type_id', 2)->get();


		$data['top_coach_detail'] = DB::table('users')->select('users.*', 'categories.name as slug', 'sub.name as sub_cat', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.id', $id)->where('users.user_type_id', 2)->first();


		$data['create_my_course'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
			->where('coach_course.coach_id', $id)
			->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')->inRandomOrder()
			->limit(6)->get();

		if (empty(auth()->user())) {
			$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)->inRandomOrder()->limit(8)->get();
		} else {
			$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)
				->where('users.category', $user1->category)
				->inRandomOrder()->limit(8)->get();
		}

		if (empty(auth()->user())) {

			$data['coach_striver'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
				->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')->inRandomOrder()
				->limit(8)->get();
		} else {

			$data['coach_striver'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
				->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')
				->where('users.category', $user1->category)
				->inRandomOrder()
				->limit(8)->get();
		}

		// print_r($data['top_coach_detail']);die;

		return appView('coach_detail', $data);
	}

	public function coaches()
	{
		// $data = "hello";
		$data['user'] = DB::table('users')->select('id', 'name')
			->where('users.user_type_id', 2)->get();
		// print_r($data);die;
		return appView('coach', $data);
	}
	public function show1()

	{
		$data = [];

		// Get Packages
		$cacheId = 'packages.with.currency.' . config('app.locale');
		$packages = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$packages = Package::applyCurrency()->with('currency')->orderBy('lft')->get();

			// print_r($packages);die;

			return $packages;
		});
		$data['packages'] = $packages;
		// print_r($data);die;
		// Select a Package and go to previous URL ---------------------
		// Add Listing possible URLs
		$addListingUriArray = [
			'create',
			'post\/create',
			'post\/create\/[^\/]+\/photos',
		];
		// Default Add Listing URL
		$addListingUrl = UrlGen::addPost();
		if (request()->filled('from')) {
			foreach ($addListingUriArray as $uriPattern) {
				if (preg_match('#' . $uriPattern . '#', request()->get('from'))) {
					$addListingUrl = url(request()->get('from'));
					break;
				}
			}
		}
		view()->share('addListingUrl', $addListingUrl);
		// --------------------------------------------------------------

		// Meta Tags
		[$title, $description, $keywords] = getMetaTag('pricing');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);

		return appView('subscription', $data);
	}

	/**
	 * @param $slug
	 * @return \Illuminate\Http\RedirectResponse|mixed
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

			view()->share('subscription', $categories);
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

			view()->share('subscription', $categories);
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
		view()->share('subscription', $countPostsByCat);

		// Export the Options
		view()->share('subscription', $value);
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

			view()->share('subscription', $categories);
			view()->share('subscription', $subCategories);
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





	public function aboutUs()
	{
		// $data = "Hello Folks! ";
		return appView('pages.aboutUs');
	}

	// Select plans per hours

	// public function selectCoursesHours($id){

	// 	$user = auth()->user();

	// 	if(!$user){
	// 		// print_r($user);die;
	// 		return redirect('login');
	// 	}
	// 	else{
	// 		// print_r($user->id);die;
	// 		$userId = $user->id;
	// 		$data['userData'] = DB::table('users')->where('id', $userId)->first();
	// 		$data['price'] = DB::table('packages')->where('id',$id)->first();

	// 		return appView('pages.courseHours',$data);
	// 	}
	// } 



}
