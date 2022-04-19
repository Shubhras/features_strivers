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

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Web\Auth\Traits\VerificationTrait;
use App\Http\Requests\Admin\Request;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\UserRequest;
use App\Models\Post;
use App\Models\SavedPost;
use App\Models\Package;
use App\Models\Gender;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Torann\LaravelMetaTags\Facades\MetaTag;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
use App\Helpers\Files\Storage\StorageDisk;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Str;
use Prologue\Alerts\Facades\Alert;

class EditController extends AccountBaseController
{
	use VerificationTrait;

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */




	public function index()
	{
		$data = [];

		$data['genders'] = Gender::query()->get();

		$user = auth()->user();

		// Mini Stats
		$data['countPostsVisits'] = DB::table((new Post())->getTable())
			->select('user_id', DB::raw('SUM(visits) as total_visits'))
			->where('country_code', config('country.code'))
			->where('user_id', $user->id)
			->groupBy('user_id')
			->first();
		$data['countPosts'] = Post::currentCountry()
			->where('user_id', $user->id)
			->count();
		$data['countFavoritePosts'] = SavedPost::whereHas('post', function ($query) {
			$query->currentCountry();
		})->where('user_id', $user->id)
			->count();

		$data['subscription_plan'] = Package::query()->get();

		// $data['edit_user'] =DB::table('users')->select('users.*')->where('users.id' ,$user->id);

		//$data['categories']= Category::query()->get();
		// $data['categoriese']= cities::query()->get();
		$data['cities_data'] = DB::table('cities')->select('cities.name', 'cities.id', 'cities.country_code')
			->where('cities.country_code', $user->country_code)
			->get();


		$data['all_citiesssss'] = DB::table('cities')->select('cities.name', 'cities.id', 'cities.country_code')
			->where('cities.country_code')
			->get();

		$data['categories'] = DB::table('categories')->select('categories.slug', 'categories.id')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();
		$data['categoriess'] = DB::table('categories')->select('categories.slug', 'categories.id')->where('categories.parent_id', $user->category)->get();

		$data['all_countries'] = DB::table('countries')->get();



		// print_r($data['all_countries']);die;

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		$edit_user = DB::table('users')->select('users.*')->where('users.id', $user->id)->first();

		$data['user_auth_id'] = 	auth()->user()->id;


		$data['categories'] = DB::table('categories')->select('categories.*')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();

		if (empty($edit_user->category)) {

			return view('auth.register.user_category', $data);
		} else {

			return appView('account.edit', $data);
		}

		// print_r($edit_user);die;


		// print_r($data);die;

	}


	public function getCountryLocation(UserRequest $request)
	{

		// print_r(($request->id));die;
		$data['cities'] = DB::table('cities')->select('cities.id', 'cities.country_code', 'cities.name')->where('cities.country_code', $request->id)->get();

		return $data;
	}


	public function dashboard()
	{
		$data = [];

		$data['genders'] = Gender::query()->get();

		$user = auth()->user();

		// Mini Stats
		$data['countPostsVisits'] = DB::table((new Post())->getTable())
			->select('user_id', DB::raw('SUM(visits) as total_visits'))
			->where('country_code', config('country.code'))
			->where('user_id', $user->id)
			->groupBy('user_id')
			->first();
		$data['countPosts'] = Post::currentCountry()
			->where('user_id', $user->id)
			->count();
		$data['countFavoritePosts'] = SavedPost::whereHas('post', function ($query) {
			$query->currentCountry();
		})->where('user_id', $user->id)
			->count();

		$data['subscription_plan'] = Package::query()->get();

		//$data['categories']= Category::query()->get();



		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		$data['categories'] = DB::table('categories')->select('categories.slug', 'categories.id')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();

		$data['coach_course'] = DB::table('coach_course')->select('coach_course.*')->orderBy('coach_course.id', 'asc')->where('coach_course.coach_id', $user->id)->get();
		// print_r($data);die;


		if(empty(auth()->user())){
		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->limit(8)->inRandomOrder()->get();
		}else{

			$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)
			->where('users.category',$user->category)
			->limit(8)->inRandomOrder()->get();
		}

		$data['suggested_striver'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 3)->limit(8)->inRandomOrder()->get();

		$data['suggested_striver_data'] = DB::table('users')->select(
			'users.*',
			'categories.name as slug',
			'packages.name   as     subscription_name',
			'packages.price',
			'packages.currency_code',
			'coach_course.dated',
			'coach_course.starting_time',
			'coach_course.course_name',
			'coach_course.coach_id'
		)
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->leftjoin('user_subscription', 'user_subscription.student_id', '=', 'users.id')
			->leftjoin('coach_course', 'coach_course.id', '=', 'user_subscription.course_id')
			->where('user_subscription.student_id', $user->id)
			->orderBy('users.id', 'asc')->get();


		$edit_user = DB::table('users')->select('users.*')->where('users.id', $user->id)->first();
		$data['user_auth_id'] = 	auth()->user()->id;


		$data['categories'] = DB::table('categories')->select('categories.*')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();

		if (empty($edit_user->category)) {
			return view('auth.register.user_category', $data);
		} else {

			return appView('account.dashboard', $data);
		}
	}




	public function my_coaches_by_striver()
	{

		$data = [];

		$data['genders'] = Gender::query()->get();

		$user = auth()->user();

		// Mini Stats
		$data['countPostsVisits'] = DB::table((new Post())->getTable())
			->select('user_id', DB::raw('SUM(visits) as total_visits'))
			->where('country_code', config('country.code'))
			->where('user_id', $user->id)
			->groupBy('user_id')
			->first();
		$data['countPosts'] = Post::currentCountry()
			->where('user_id', $user->id)
			->count();
		$data['countFavoritePosts'] = SavedPost::whereHas('post', function ($query) {
			$query->currentCountry();
		})->where('user_id', $user->id)
			->count();

		$data['my_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->leftjoin('enroll_course', 'enroll_course.coach_id', '=', 'users.id')
			->where('users.user_type_id', 2)->where('enroll_course.user_id', $user->id)->groupBy('enroll_course.coach_id')->get();

		// $data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
		// 	->leftjoin('categories', 'categories.id', '=', 'users.category')
		// 	->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
		// 	->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
		// 	->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->get();

		// print_r($data['my_coaches']);die;

		if (empty(auth()->user())) {
		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->inRandomOrder()->limit(8)->get();
		}else{
			$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)
			->where('users.category',$user->category)
			->inRandomOrder()->limit(8)->get();
		}
		$data['suggested_striver'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 3)->inRandomOrder()->limit(8)->get();


		// $data['my_striver'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
		// 	->leftjoin('categories', 'categories.id', '=', 'users.category')
		// 	->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
		// 	->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
		// 	->leftjoin('enroll_course', 'enroll_course.coach_id', '=', 'users.id')
		// 	->where('users.user_type_id', 3)->where('enroll_course.coach_id', $user->id)->groupBy('enroll_course.user_id')->get();


		$data['my_striver'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->leftjoin('enroll_course', 'enroll_course.user_id', '=', 'users.id')
			->where('enroll_course.coach_id', $user->id)->groupBy('enroll_course.user_id')->get();

		if (empty(auth()->user())) {
			
		
			$data['coach_striver'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
			->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')->inRandomOrder()
			->limit(8)->get();
		}else{
			$data['coach_striver'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
			->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')
			->where('users.category',$user->category)
			->inRandomOrder()
			->limit(8)->get();
		}

		$data['subscription_plan'] = Package::query()->get();

		//$data['categories']= Category::query()->get();

		$data['categories'] = DB::table('categories')->select('categories.slug', 'categories.id')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		// print_r($data['suggested_striver'] );die;


		$edit_user = DB::table('users')->select('users.*')->where('users.id', $user->id)->first();
		$data['user_auth_id'] = 	auth()->user()->id;


		$data['categories'] = DB::table('categories')->select('categories.*')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();

		if (empty($edit_user->category)) {
			return view('auth.register.user_category', $data);

		} else {

			return appView('account.my_coaches', $data);
		}




		
	}


	public function enroll_course_striver(Request $request)
	{



		$user = auth()->user();
		if ($user->user_type_id == 3) {
			if (empty($user)) {

				return redirect('/login');
			} else {


				$enroll_course_by_strivre = DB::table('enroll_course')->select('enroll_course.course_id')->where('enroll_course.user_id', $user->id)->orWhere('enroll_course.course_id', $request->course_id)->first();

				$enroldStrvreCourse = $enroll_course_by_strivre->course_id;

				if ($enroldStrvreCourse == $request->course_id) {

					Session()
						->flash('loginerrorenroll', 'You have already enroll course .');
					return redirect()
						->back();
				} else {

					$user = auth()->user();

					$data['user_subscription'] = DB::table('user_subscription_payment')->select('user_subscription_payment.*', 'packages.name', 'users.name as username')
						->leftjoin('packages', 'packages.id', '=', 'user_subscription_payment.subscription_id')
						->leftjoin('users', 'users.id', '=', 'user_subscription_payment.user_id')
						->where('user_subscription_payment.user_id', $user->id)->orderBy('users.id', 'desc')
						->get();


					$totalsum = array();
					$name = array();
					$consumed_hours = array();
					$remaining_hours = array();
					$user_id = array();

					foreach ($data['user_subscription'] as $key => $value) {

						$totalsum[$value->total_provided_hours] = $value->total_provided_hours;
						$name[$value->name] = $value->name;
						$consumed_hours[$value->consumed_hours] = $value->consumed_hours;
						$remaining_hours[$value->remaining_hours] = $value->remaining_hours;
						$user_id[$value->id] = $value->id;
						// $consumed_hours[$value->consumed_hours] =$value->consumed_hours;
					}


					$ss  = array();
					foreach ($name as $key => $sub) {
						$ss[$sub] = $sub;
					}


					$data['total_purchase_package'] = count($user_id);
					$data['packagename'] = $ss;
					$totalpoints = array_sum($totalsum);
					$data['consumed_hours'] = array_sum($consumed_hours);

					$consumeddat =  $data['consumed_hours'] + $request->creadit_required;

					$remaining_hours = $totalpoints - $consumeddat;
					$remaining_hourss = $totalpoints - $data['consumed_hours'];
					// $total = implode('', $totalpoints);

					// 
					// print_r($totalpoints);
					// print_r($request->creadit_required);

					// print_r($remaining_hourss);die;

					if ($remaining_hourss >=  $request->creadit_required) {



						$date = date('d-m-yy');
						$data = array(
							'user_id' => $request->user_id,
							'coach_id' => $request->coach_id,
							'course_id' => $request->course_id,
							'created_at' => $date
						);

						DB::table('enroll_course')->insert($data);



						DB::table('user_subscription_payment')->where('user_subscription_payment.user_id', $user->id)->update(['user_subscription_payment.consumed_hours' => $consumeddat, 'user_subscription_payment.remaining_hours' => $remaining_hours]);


						Session()->flash('messagess', ' Enroll Successfully !');
						// return redirect()
						// ->back();

						return redirect('account/my_courses');
					} else {



						// } else {
						Session()
							->flash('loginerror', 'You do not have sufficient credits.');
						return redirect()
							->back();
						// }


						// return redirect('/pricing');
					}
				}
			}
		} else {
			Session()
				->flash('loginerror', 'You do not access.');
			return redirect()
				->back();
		}
	}


	public function my_courses_by_striver()
	{


		$data = [];

		$data['genders'] = Gender::query()->get();

		$user = auth()->user();

		// Mini Stats
		$data['countPostsVisits'] = DB::table((new Post())->getTable())
			->select('user_id', DB::raw('SUM(visits) as total_visits'))
			->where('country_code', config('country.code'))
			->where('user_id', $user->id)
			->groupBy('user_id')
			->first();
		$data['countPosts'] = Post::currentCountry()
			->where('user_id', $user->id)
			->count();
		$data['countFavoritePosts'] = SavedPost::whereHas('post', function ($query) {
			$query->currentCountry();
		})->where('user_id', $user->id)
			->count();

		// $data['my_coaches'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
		// ->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
		// ->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
		// ->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
		// ->where('users.user_type_id',2)->orderBy('users.id','asc')->limit(3)->get();

		if(empty(auth()->user())){
		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->inRandomOrder()->limit(8)->get();
		}else{
		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
		->leftjoin('categories', 'categories.id', '=', 'users.category')
		->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
		->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
		->where('users.user_type_id', 2)
		->where('users.category',$user->category)
		->inRandomOrder()->limit(8)->get();
		}
		$data['suggested_striver'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 3)->inRandomOrder()->limit(8)->get();

		// print_r();die;
		$data['users'] = DB::table('user_subscription')->select('coach_course.*')
			->leftjoin('packages', 'packages.id', '=', 'user_subscription.subscription_id')
			->leftjoin('users', 'users.id', '=', 'user_subscription.student_id')
			->leftjoin('coach_course', 'coach_course.id', '=', 'user_subscription.course_id')
			->where('user_subscription.student_id', $user->id)
			->where('users.user_type_id', 3)
			->orderBy('users.id', 'asc')->limit(6)->get();

		// print_r($data['users']);die;





		$data['subscription_plan'] = Package::query()->get();

		//$data['categories']= Category::query()->get();

		$data['categories'] = DB::table('categories')->select('categories.slug', 'categories.id')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();


		$data['coach_course'] = DB::table('coach_course')->select('coach_course.*')->orderBy('coach_course.id', 'asc')->where('coach_course.coach_id', $user->id)->get();

		$data['coach_coarsee'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
			->where('coach_course.coach_id', $user->id)
			->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')->inRandomOrder()
			->limit(6)->get();


		$data['enroll_coach_coarse'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo', 'enroll_course.user_id')
			->leftJoin('enroll_course', 'enroll_course.course_id', '=', 'coach_course.id')
			->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')
			->where('enroll_course.user_id', $user->id)
			->inRandomOrder()
			->limit(6)->get();


		if(empty(auth()->user())){
		$data['coach_striver'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
			->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')->inRandomOrder()
			->limit(8)->get();
		}else{
		$data['coach_striver'] = DB::table('coach_course')->select('coach_course.*', 'users.name', 'users.photo')
		->leftjoin('users', 'users.id', '=', 'coach_course.coach_id')
		->where('users.category',$user->category)
		->inRandomOrder()
		->limit(8)->get();
		}
		// print_r($data['coach_striver']);die;
		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));



		$edit_user = DB::table('users')->select('users.*')->where('users.id', $user->id)->first();
		$data['user_auth_id'] = 	auth()->user()->id;


		$data['categories'] = DB::table('categories')->select('categories.*')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();
		if (empty($edit_user->category)) {
			return view('auth.register.user_category', $data);
			
		} else {

			return appView('account.my_courses', $data);
		}

		
	}




	public function payment_and_subscription()
	{

		//return appView('account.stripe');

		$data = [];

		$data['genders'] = Gender::query()->get();

		$user = auth()->user();
		// print_r($user->id);die;

		// Mini Stats
		$data['countPostsVisits'] = DB::table((new Post())->getTable())
			->select('user_id', DB::raw('SUM(visits) as total_visits'))
			->where('country_code', config('country.code'))
			->where('user_id', $user->id)
			->groupBy('user_id')
			->first();
		$data['countPosts'] = Post::currentCountry()
			->where('user_id', $user->id)
			->count();
		$data['countFavoritePosts'] = SavedPost::whereHas('post', function ($query) {
			$query->currentCountry();
		})->where('user_id', $user->id)
			->count();


		if(empty(auth()->user())){
		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();
		}else{
		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
		->leftjoin('categories', 'categories.id', '=', 'users.category')
		->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
		->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
		->where('users.user_type_id', 2)
		->where('users.category',$user->category)
		->orderBy('users.id', 'asc')->limit(8)->get();
		}
		$data['suggested_striver'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')

			->where('users.user_type_id', 3)->orderBy('users.id', 'asc')->limit(8)->get();


		$data['user_subscriptions1'] = DB::table('user_subscription')->select('user_subscription.*', 'packages.name', 'users.name as username')
			->leftjoin('packages', 'packages.id', '=', 'user_subscription.subscription_id')
			->leftjoin('users', 'users.id', '=', 'user_subscription.user_id')
			->where('user_subscription.user_id', $user->id)
			// ->where('user_subscription.remaining_hours',0)
			->get();
		// print_r($data['user_subscription']);die;
		// $data['user_subscription'] = DB::table('user_subscription_payment')
		// 		->where('user_id', $user->id)
		// 		->first();


		$data['user_subscription'] = DB::table('user_subscription_payment')->select('user_subscription_payment.*', 'packages.name', 'users.name as username')
			->leftjoin('packages', 'packages.id', '=', 'user_subscription_payment.subscription_id')
			->leftjoin('users', 'users.id', '=', 'user_subscription_payment.user_id')
			->where('user_subscription_payment.user_id', $user->id)->orderBy('users.id', 'desc')
			->get();

		$totalsum = array();
		$name = array();
		$consumed_hours = array();
		$remaining_hours = array();
		$user_id = array();
		foreach ($data['user_subscription'] as $key => $value) {

			$totalsum[$value->total_provided_hours] = $value->total_provided_hours;
			$name[$value->name] = $value->name;
			$consumed_hours[$value->consumed_hours] = $value->consumed_hours;
			$remaining_hours[$value->remaining_hours] = $value->remaining_hours;
			$user_id[$value->id] = $value->id;
			// $consumed_hours[$value->consumed_hours] =$value->consumed_hours;
		}


		//  $dataa = sum($totalsum);

		// $totalsum += $totalsum;
		$ss  = array();
		foreach ($name as $key => $sub) {
			$ss[$sub] = $sub;
		}


		$data['total_purchase_package'] = count($user_id);
		$data['packagename'] = $ss;
		$data['totalpoints'] = array_sum($totalsum);
		$data['consumed_hours'] = array_sum($consumed_hours);

		$data['remaining_hours'] = $data['totalpoints'] - $data['consumed_hours'];
		//  print_r($data);die;


		//print_r($data['user_subscription']);die;
		$data['subscription_plan'] = Package::query()->get();

		//$data['categories']= Category::query()->get();





		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://metrics-us.cometchat.io/v1/calls/sessions',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'appId: 2040141e5d5dcef3',
				'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGltZ210LmNvbWV0Y2hhdC5pb1wvYXBwc1wvMjA0MDE0MWU1ZDVkY2VmMyIsImlhdCI6MTY0Nzg1MTgxNSwic3ViIjoiMjA0MDE0MWU1ZDVkY2VmMyIsIm5iZiI6MTY0Nzg0ODIxNSwiZXhwIjoxNjUwNDQzODE1LCJkYXRhIjp7ImFwcElkIjoiMjA0MDE0MWU1ZDVkY2VmMyIsInJlZ2lvbiI6InVzIn19.TJNg26DTjo_YexASHQVAnVgZriGqPY7aLW_N8VAmLzo',
				'uid: ' . $user->username
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$responsesst = json_decode($response);
		$session_id = array();
		$datavideo_minutes = array();

		foreach ($responsesst as $key => $uidkey) {

			//   $data[$uidkey->uid] =$uidkey;			
			foreach ($uidkey as $key => $value) {

				// $datauid[$value->uid] =$value->uid;
				$datavideo_minutes[] = $value->video_minutes;
				$dataaudio_minutes[] = $value->audio_minutes;

				// if($value->uid == $user->username){					
				$session_id[$user->username] = $value->session_id;
				//}		
				// print_r($value->video_minutes);die;
				$session_s = $value->session_id;
			}

			// print_r($session_s);die;


			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://metrics-us.cometchat.io/v1/calls/sessions/$session_s/participants',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'appId: 2040141e5d5dcef3',
					'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGltZ210LmNvbWV0Y2hhdC5pb1wvYXBwc1wvMjA0MDE0MWU1ZDVkY2VmMyIsImlhdCI6MTY0Nzg1MTgxNSwic3ViIjoiMjA0MDE0MWU1ZDVkY2VmMyIsIm5iZiI6MTY0Nzg0ODIxNSwiZXhwIjoxNjUwNDQzODE1LCJkYXRhIjp7ImFwcElkIjoiMjA0MDE0MWU1ZDVkY2VmMyIsInJlZ2lvbiI6InVzIn19.TJNg26DTjo_YexASHQVAnVgZriGqPY7aLW_N8VAmLzo',
					'uid: $user->username'
				),
			));
			// print_r($session_s);die;

			$response = curl_exec($curl);

			curl_close($curl);
			//   echo $response;
			$responsess = json_decode($response);
			//   $datauid = array();
			$datavideo_minutes = array();
			$dataaudio_minutes = array();
			$session_id = array();
			foreach ($responsess as $key => $uidkey) {

				//   $data[$uidkey->uid] =$uidkey;


				foreach ($uidkey as $key => $value) {

					// $datauid[$value->uid] =$value->uid;
					$datavideo_minutes[$value->uid] = $value->video_minutes;
					$dataaudio_minutes[$value->uid] = $value->audio_minutes;

					if ($value->uid == $user->username) {

						$datavideo_minutes[$value->uid] = $value->video_minutes;
						$dataaudio_minutes[$value->uid] = $value->audio_minutes;
						$session_id[$value->uid] = $value->session_id;
					}
				}
			}
		}
		//   print_r($value->session_id);exit;

		$data['datavideo_minutes'] = $datavideo_minutes + $dataaudio_minutes;

		$videominuts = implode('', $data['datavideo_minutes']);
		$videominuts = $value->video_minutes;
		// print_r($videominuts);die;
		$data['dataaudio_minutes'] = $dataaudio_minutes;


		$videominutsTotal = '0';
		$videominutsTotal = $videominutsTotal + $videominuts;

		// DB::table('user_subscription_payment')->where('user_subscription_payment.user_id', $user->id)->update(['user_subscription_payment.consumed_hours' => $videominutsTotal]);

		$data['totalStrivre'] = DB::table('enroll_course')->select('enroll_course.*')->where('enroll_course.coach_id', $user->id)->groupBy('enroll_course.user_id')->get();

		$data['totalStrivrePayment'] = count($data['totalStrivre']);

		$data['strivrePayment'] = DB::table('users')
			->select('enroll_course.*', 'users.name as strivre_name', 'users.email as strivre_email', 'coach_course.*')
			->join('enroll_course', 'users.id', '=', 'enroll_course.user_id')
			->join('coach_course', 'coach_course.id', '=', 'enroll_course.course_id')
			// ->join('user_subscription_payment','user_subscription_payment.user_id','=','users.id')
			->where('enroll_course.coach_id', $user->id)->get();


		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		// print_r($data['strivrePayment']);die;

		$edit_user = DB::table('users')->select('users.*')->where('users.id', $user->id)->first();
		$data['user_auth_id'] = 	auth()->user()->id;


		$data['categories'] = DB::table('categories')->select('categories.*')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->get();

		if (empty($edit_user->category)) {
			return view('auth.register.user_category', $data);
			
		} else {

			return appView('account.payment_and_subscription', $data);
		}


		
	}



	public function create_coursesss(Request $request)
	{

		// print_r($request->all());die;
		$data = [];

		$data['genders'] = Gender::query()->get();

		$user = auth()->user();

		// Mini Stats
		$data['countPostsVisits'] = DB::table((new Post())->getTable())
			->select('user_id', DB::raw('SUM(visits) as total_visits'))
			->where('country_code', config('country.code'))
			->where('user_id', $user->id)
			->groupBy('user_id')
			->first();
		$data['countPosts'] = Post::currentCountry()
			->where('user_id', $user->id)
			->count();
		$data['countFavoritePosts'] = SavedPost::whereHas('post', function ($query) {
			$query->currentCountry();
		})->where('user_id', $user->id)
			->count();











		$value = $request->image;


		// print_r($value);die;

		$disk = StorageDisk::getDisk();
		$attribute_name = 'picture';
		$destination_path = 'app/course_image';


		// Check the image file
		if ($value == url('/')) {
			$this->attributes[$attribute_name] = null;

			return false;
		}

		// If laravel request->file('filename') resource OR base64 was sent, store it in the db

		// if (fileIsUploaded($value)) {


		// Get file extension
		$extension = getUploadedFileExtension($value);


		if (empty($extension)) {
			$extension = 'jpg';
		}

		// Image quality
		$imageQuality = 100;

		// Image default dimensions
		$width = (int)config('larapen.core.picture.otherTypes.bgHeader.width', 2000);
		$height = (int)config('larapen.core.picture.otherTypes.bgHeader.height', 1000);




		$image = $value;
		// Generate a filename.
		// $filename = md5($value . time()) . '.' . $extension;
		$filename = md5($value . time()) . '.' . $extension;

		// Store the image on disk.
		// $disk->put($destination_path . '/' . $filename, $image);
		$courseimg =	$disk->put($destination_path, $image);

		// Save the path to the database
		// $this->attributes[$attribute_name] = $destination_path . '/' . $filename;
		$this->attributes[$attribute_name] = $destination_path . '/' . $image;

		if (!empty($request->dated)) {
			// $dates =date('d-m-yy',$request->dated);
			$dates = $request->dated;

			// print_r($dates);die;
		} else {
			$dates = date('d-m-y');
		}


		//  print_r($request->all());die;
		$data = array(
			'coach_id' => $user->id,
			'course_name' => $request->course_name,
			'consultation_fee_per_hour' => $request->consultation_fee_per_hour,
			'course_hourse' => $request->course_hourse,
			'total_consultation_fee' => $request->total_consultation_fee,
			'creadit_required' => $request->creadit_required,
			'description' => $request->description,
			'image' => $courseimg,
			'starting_time' => $request->starting_time,
			'dated' => $dates,


		);
		// print_r($data);die;





		$tru = DB::table('coach_course')->insert($data);

		// return redirect('my_courses')->back();
		return redirect('/account/my_courses');
	}




	public function getSubcategories(UserRequest $request)
	{
		$subcategories = DB::table("categories")
			->where("parent_id", $request->id)
			->pluck("slug", "id");
		// print_r($subcategories);die;
		return response()->json($subcategories);
	}

	/**
	 * @param \App\Http\Requests\UserRequest $request
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function updateDetails(UserRequest $request)
	{
		// print_r($request->all());die;
		$endpoint = '/users/' . auth()->user()->id;
		$data = makeApiRequest('put', $endpoint, $request->all());


		// Parsing the API's response
		$message = !empty(data_get($data, 'message')) ? data_get($data, 'message') : 'Unknown Error.';
		// print_r($message);die;

		// HTTP Error Found
		if (!data_get($data, 'isSuccessful')) {
			flash($message)->error();

			return redirect()->back()->withInput($request->except(['photo']));
		}

		// Notification Message
		if (data_get($data, 'success')) {
			flash($message)->success();
		} else {
			flash($message)->error();
		}

		// Get User Resource
		$user = data_get($data, 'result');

		// Don't logout the User (See User model)
		if (data_get($data, 'extra.emailOrPhoneChanged')) {
			session()->put('emailOrPhoneChanged', true);
		}

		// Get Query String
		$queryString = '';
		if ($request->filled('panel')) {
			$queryString = '?panel=' . $request->input('panel');
		}
		// print_r($queryString);die;
		// Get the next URL
		$nextUrl = url('account' . $queryString);

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

	/**
	 * Update the User's photo.
	 *
	 * @param AvatarRequest $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function updatePhoto(AvatarRequest $request)
	{
		// Call API endpoint
		$endpoint = '/users/' . auth()->user()->id;
		$data = makeApiRequest('put', $endpoint, $request->all());
		// print_r($data);die;
		// Parsing the API's response
		$message = !empty(data_get($data, 'message')) ? data_get($data, 'message') : 'Unknown Error.';

		// HTTP Error Found
		if (!data_get($data, 'isSuccessful')) {
			// AJAX Response
			if ($request->ajax()) {
				return response()->json(['error' => $message]);
			}

			flash($message)->error();

			return redirect(url('account'))->withInput();
		}

		// AJAX Response
		if ($request->ajax()) {
			if (!data_get($data, 'success')) {
				return response()->json(['error' => $message]);
			}

			$fileInput = array_get($data, 'extra.photo.extra.fileInput');

			return response()->json($fileInput);
		}

		// Notification Message
		if (array_get($data, 'success')) {
			flash($message)->success();
		} else {
			flash($message)->error();
		}

		return redirect(url('account'));
	}

	public function payment_subscription_plan(Request $request)
	{

		// print_r($request->all());die;

		$data = [];

		$data['genders'] = Gender::query()->get();

		$user = auth()->user();

		// Mini Stats
		$data['countPostsVisits'] = DB::table((new Post())->getTable())
			->select('user_id', DB::raw('SUM(visits) as total_visits'))
			->where('country_code', config('country.code'))
			->where('user_id', $user->id)
			->groupBy('user_id')
			->first();
		$data['countPosts'] = Post::currentCountry()
			->where('user_id', $user->id)
			->count();
		$data['countFavoritePosts'] = SavedPost::whereHas('post', function ($query) {
			$query->currentCountry();
		})->where('user_id', $user->id)
			->count();





		// ]);
		$datess = date('Y-m-d h:i:s');
		$data = array(
			'user_id' => $request->user_id,
			'student_id' => $request->student_id,
			'subscription_id' => $request->subscription_id,
			'course_id' => $request->course_id,
			'net_payment' => $request->net_payment,
			'fee_deducte' => $request->fee_deducte,
			'created_at' => $datess,
			'updated_at' => $datess


		);
		// print_r($data);die;





		DB::table('user_subscription')->insert($data);
	}

	public function comet_chat()
	{

		$data = [];

		$data['genders'] = Gender::query()->get();

		$user = auth()->user();

		$data['countPostsVisits'] = DB::table((new Post())->getTable())
			->select('user_id', DB::raw('SUM(visits) as total_visits'))
			->where('country_code', config('country.code'))
			->where('user_id', $user->id)
			->groupBy('user_id')
			->first();

		$data['auth_user_name'] = DB::table('users')
			->select('users.username')
			->where('id', $user->id)
			->first();

		$data['countPosts'] = Post::currentCountry()
			->where('user_id', $user->id)
			->count();
		$data['countFavoritePosts'] = SavedPost::whereHas('post', function ($query) {
			$query->currentCountry();
		})->where('user_id', $user->id)
			->count();


		// $curl = curl_init();

		// curl_setopt_array($curl, array(
		// CURLOPT_URL => 'https://metrics-us.cometchat.io/v1/calls/sessions',
		// CURLOPT_RETURNTRANSFER => true,
		// CURLOPT_ENCODING => '',
		// CURLOPT_MAXREDIRS => 10,
		// CURLOPT_TIMEOUT => 0,
		// CURLOPT_FOLLOWLOCATION => true,
		// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// CURLOPT_CUSTOMREQUEST => 'GET',
		// CURLOPT_HTTPHEADER => array(
		// 	'appId: 2040141e5d5dcef3',
		// 	'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGltZ210LmNvbWV0Y2hhdC5pb1wvYXBwc1wvMjA0MDE0MWU1ZDVkY2VmMyIsImlhdCI6MTY0Nzg1MTgxNSwic3ViIjoiMjA0MDE0MWU1ZDVkY2VmMyIsIm5iZiI6MTY0Nzg0ODIxNSwiZXhwIjoxNjUwNDQzODE1LCJkYXRhIjp7ImFwcElkIjoiMjA0MDE0MWU1ZDVkY2VmMyIsInJlZ2lvbiI6InVzIn19.TJNg26DTjo_YexASHQVAnVgZriGqPY7aLW_N8VAmLzo',
		// 	'uid: '.$user->username
		// ),
		// ));

		// $response = curl_exec($curl);

		// curl_close($curl);
		// // echo $response;
		// $responsesst= json_decode($response);
		// 	//   $datauid = array();

		// 	$session_id = array();
		// 	$datavideo_minutes = array();

		// foreach($responsesst as $key =>$uidkey){

		// 	//   $data[$uidkey->uid] =$uidkey;
		// 	// print_r($uidkey);die;

		// 	foreach($uidkey as $key =>$value){

		// 		// $datauid[$value->uid] =$value->uid;
		// 		$datavideo_minutes[] =$value->video_minutes;
		// 		$dataaudio_minutes[] =$value->audio_minutes;

		// 		// if($value->uid == $user->username){


		// 			$session_id[$user->username] =$value->session_id;

		// 		//}

		// 		// print_r($value->video_minutes);die;
		// 			$session_s = $value->session_id;
		// 	}
		// }
		// // print_r($value->session_id);die;


		// $curl = curl_init();

		// curl_setopt_array($curl, array(
		// 	CURLOPT_URL => 'https://metrics-us.cometchat.io/v1/calls/sessions/$session_s/participants',
		// 	CURLOPT_RETURNTRANSFER => true,
		// 	CURLOPT_ENCODING => '',
		// 	CURLOPT_MAXREDIRS => 10,
		// 	CURLOPT_TIMEOUT => 0,
		// 	CURLOPT_FOLLOWLOCATION => true,
		// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 	CURLOPT_CUSTOMREQUEST => 'GET',
		// 	CURLOPT_HTTPHEADER => array(
		// 	'appId: 2040141e5d5dcef3',
		// 	'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGltZ210LmNvbWV0Y2hhdC5pb1wvYXBwc1wvMjA0MDE0MWU1ZDVkY2VmMyIsImlhdCI6MTY0Nzg1MTgxNSwic3ViIjoiMjA0MDE0MWU1ZDVkY2VmMyIsIm5iZiI6MTY0Nzg0ODIxNSwiZXhwIjoxNjUwNDQzODE1LCJkYXRhIjp7ImFwcElkIjoiMjA0MDE0MWU1ZDVkY2VmMyIsInJlZ2lvbiI6InVzIn19.TJNg26DTjo_YexASHQVAnVgZriGqPY7aLW_N8VAmLzo',
		// 	'uid: $user->username'
		// 	),
		// ));


		// $response = curl_exec($curl);

		// curl_close($curl);
		// //   echo $response;
		// 	$responsess= json_decode($response);
		// 	//   $datauid = array();
		// 	$datavideo_minutes = array();
		// 	$dataaudio_minutes = array();
		// 	//   $session_id = array();
		// foreach($responsess as $key =>$uidkey){

		// 	//   $data[$uidkey->uid] =$uidkey;


		// 	foreach($uidkey as $key =>$value){

		// 		$datauid[$value->uid] =$value->uid;
		// 		$datavideo_minutes[$value->uid] =$value->video_minutes;
		// 		$dataaudio_minutes[$value->uid] =$value->audio_minutes;

		// 		if($value->uid == $user->username){

		// 			$datavideo_minutes[$value->uid] =$value->video_minutes;
		// 			$dataaudio_minutes[$value->uid] =$value->audio_minutes;
		// 			$session_id[$value->uid] =$value->session_id;

		// 		}


		// 	}  


		// //   print_r($value->session_id);exit;

		// $data['datavideo_minutes'] = $datavideo_minutes + $dataaudio_minutes;

		// $videominuts = implode('',$data['datavideo_minutes']);
		// $videominuts = $value->video_minutes;
		// $data['dataaudio_minutes'] = $dataaudio_minutes;

		// $consumed_hours = DB::table('user_subscription_payment')->select('user_subscription_payment.*')->where('user_subscription_payment.user_id',$user->id)->first();
		// // print_r($consumed_hours->consumed_hours);die;
		// $datavalue = 0;
		// // if($datavalue >=1)
		// // {
		// $videominutsTotal =$consumed_hours->consumed_hours + $videominuts;

		// // print_r($videominutsTotal);die;
		// // if(!empty($videominutsTotal))

		// DB::table('user_subscription_payment')->where('user_subscription_payment.user_id',$user->id)->update(['user_subscription_payment.consumed_hours'=>$videominutsTotal]);
		// }
		// print_r($user->username);die;
		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		return appView('account.cometchat', $data);
	}


	public function coach_list_category_interesting(Request $request)
	{
		// print_r($request);die;

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



		if (empty($id)) {

			$data['user'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code', 'sub.slug as slug_name')
				->leftjoin('categories', 'categories.id', '=', 'users.category')
				->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
				->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
				->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();

			// print_r($data['user']);die;

		}


		$data['suggested_coaches'] = DB::table('users')->select('users.*', 'categories.name as slug', 'packages.name as subscription_name', 'packages.price', 'packages.currency_code')
			->leftjoin('categories', 'categories.id', '=', 'users.category')
			->leftjoin('categories as sub', 'sub.id', '=', 'users.sub_category')
			->leftjoin('packages', 'packages.id', '=', 'users.subscription_plans')
			->where('users.user_type_id', 2)->orderBy('users.id', 'asc')->limit(8)->get();



		[$title, $description, $keywords] = getMetaTag('contact');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);



		return appView('pages.category_coaches', $data);
	}
}
