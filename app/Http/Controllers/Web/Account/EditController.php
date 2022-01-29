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

class EditController extends AccountBaseController
{
	use VerificationTrait;
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */


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

		$data['subscription_plan']= Package::query()->get();

		//$data['categories']= Category::query()->get();

		$data['suggested_coaches'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',2)->orderBy('users.id','asc')->get();

		$data['suggested_striver'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',3)->orderBy('users.id','asc')->get();

			$data['suggested_striver_data']= DB::table('users')->select('users.*','categories.name as slug','packages.name   as     subscription_name','packages.price','packages.currency_code'
		,'coach_course.dated','coach_course.starting_time','coach_course.course_name','coach_course.coach_id')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->leftjoin('user_subscription' ,'user_subscription.student_id' ,'=' ,'users.id')
			->leftjoin('coach_course' , 'coach_course.id','=','user_subscription.course_id')
			->where('user_subscription.student_id',$user->id)
		    ->orderBy('users.id','asc')->get();
		
		$data['categories'] = DB::table('categories')->select('categories.slug','categories.id')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));
		
		$data['coach_course'] = DB::table('coach_course')->select('coach_course.*')->orderBy('coach_course.id','asc')->where('coach_course.coach_id', $user->id)->get();
		// print_r($data);die;
		return appView('account.dashboard', $data);
		
	}


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

		$data['subscription_plan']= Package::query()->get();

		//$data['categories']= Category::query()->get();

		$data['categories'] = DB::table('categories')->select('categories.slug','categories.id')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));
		
		return appView('account.edit', $data);
		
	}





	public function my_coaches_by_striver(){

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

			$data['my_coaches'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',2)->orderBy('users.id','asc')->limit(3)->get();

			$data['suggested_coaches'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',2)->orderBy('users.id','asc')->get();

			$data['suggested_striver'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',3)->orderBy('users.id','asc')->get();


			$data['my_striver'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',3)->orderBy('users.id','asc')->limit(3)->get();



			
		$data['subscription_plan']= Package::query()->get();

		//$data['categories']= Category::query()->get();

		$data['categories'] = DB::table('categories')->select('categories.slug','categories.id')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		return appView('account.my_coaches', $data);

	}


	public function my_courses_by_striver(){


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

			$data['suggested_coaches'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',2)->orderBy('users.id','asc')->get();

			$data['suggested_striver'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',3)->orderBy('users.id','asc')->get();

		// print_r();die;
		$data['users'] = DB::table('user_subscription')->select('coach_course.*')
			->leftjoin('packages','packages.id'  ,'=','user_subscription.subscription_id')
			->leftjoin('users' ,'users.id' ,'=', 'user_subscription.student_id')
			->leftjoin('coach_course','coach_course.id','=','user_subscription.course_id')
			->where('user_subscription.student_id',$user->id)
			->where('users.user_type_id',3)
			->orderBy('users.id','asc')->get();
			
		// print_r($data['users']);die;
			



			
		$data['subscription_plan']= Package::query()->get();

		//$data['categories']= Category::query()->get();

		$data['categories'] = DB::table('categories')->select('categories.slug','categories.id')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();


		$data['coach_course'] = DB::table('coach_course')->select('coach_course.*')->orderBy('coach_course.id','asc')->where('coach_course.coach_id', $user->id)->get();

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		return appView('account.my_courses', $data);


	}



	public function payment_and_subscription(){

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

			

			$data['suggested_coaches'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			->where('users.user_type_id',2)->orderBy('users.id','asc')->get();

			$data['suggested_striver'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			
			->where('users.user_type_id',3)->orderBy('users.id','asc')->get();


			$data['user_subscriptions1'] = DB::table('user_subscription_payment')->select('user_subscription_payment.*','packages.name','users.name as username')
			->leftjoin('packages','packages.id'  ,'=','user_subscription_payment.subscription_id')
			->leftjoin('users' ,'users.id' ,'=', 'user_subscription_payment.user_id')
			->where('user_subscription_payment.user_id',$user->id)
			->where('user_subscription_payment.remaining_hours',0)
			->get();
		// print_r($data['user_subscription']);die;
			$data['user_subscription'] = DB::table('user_subscription_payment')
					->where('user_id', $user->id)
					->first();

		// print_r($data['user_subscription']);die;
		

			//print_r($data['user_subscription']);die;
		$data['subscription_plan']= Package::query()->get();

		//$data['categories']= Category::query()->get();

		$data['categories'] = DB::table('categories')->select('categories.slug','categories.id')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();


		
		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		return appView('account.payment_and_subscription', $data);
		


	}


	public function create_coursesss(Request $request){

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
		// print_r($request->all());die;
		$data = array(
			'coach_id' =>$user->id,
			'course_name' =>$request->course_name,
			'course_hourse' => $request->course_hourse,
			'description' => $request->description, 
			'starting_time' => $request->starting_time,
			'dated' => $request->dated,
	
	
			);
			// print_r($data);die;

			

		

		$tru = DB::table('coach_course')->insert($data);
		if($tru){
			return true;
		}
		


	}



	public function getSubcategories(UserRequest $request)
	{
	    $subcategories = DB::table("categories")
		   ->where("parent_id", $request->id)
		   ->pluck("slug", "id");
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

	public function payment_subscription_plan(Request $request){

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
			'user_id' =>$request->user_id,
			'student_id' =>$request->student_id,
			'subscription_id' =>$request->subscription_id,
			'course_id' => $request->course_id,
			'net_payment' => $request->net_payment, 
			'fee_deducte' =>$request->fee_deducte,
			'created_at' => $datess,
			'updated_at' => $datess
	
	
			);
			// print_r($data);die;

			

		

		DB::table('user_subscription')->insert($data);


	}

	public function comet_chat(){

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

// print_r($data['auth_user_name']);die;
		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		return appView('account.cometchat', $data);

	}
}
