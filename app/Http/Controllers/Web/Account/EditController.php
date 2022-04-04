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

		// $data['categoriese']= cities::query()->get();
		$data['categoriese'] = DB::table('cities')->get();

		$data['categories'] = DB::table('categories')->select('categories.slug','categories.id')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();

		$data['all_countries']= DB::table('countries')->get();
		// print_r($data['all_countries']);die;

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));
		
		return appView('account.edit', $data);
		
	}


	public function getCountryLocation(UserRequest $request){

// print_r(($request->id));die;
		$data['cities'] = DB::table('cities')->select('cities.id','cities.country_code','cities.name')->where('cities.country_code',$request->id)->get();

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

		$data['subscription_plan']= Package::query()->get();

		//$data['categories']= Category::query()->get();

		

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));
		
		$data['categories'] = DB::table('categories')->select('categories.slug','categories.id')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();
		
		$data['coach_course'] = DB::table('coach_course')->select('coach_course.*')->orderBy('coach_course.id','asc')->where('coach_course.coach_id', $user->id)->get();
		// print_r($data);die;



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
		
		
		return appView('account.dashboard', $data);
		
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
			->where('users.user_type_id',2)->orderBy('users.id','asc')->limit(6)->get();

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
			->where('users.user_type_id',3)->orderBy('users.id','asc')->limit(6)->get();



			
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
			->orderBy('users.id','asc')->limit(6)->get();
			
		// print_r($data['users']);die;
			



			
		$data['subscription_plan']= Package::query()->get();

		//$data['categories']= Category::query()->get();

		$data['categories'] = DB::table('categories')->select('categories.slug','categories.id')->orderBy('categories.slug','asc')->where('categories.parent_id' ,null)->get();


		$data['coach_course'] = DB::table('coach_course')->select('coach_course.*')->orderBy('coach_course.id','asc')->where('coach_course.coach_id', $user->id)->get();

		$data['coach_coarsee']= DB::table('coach_course')->select('coach_course.*','users.name','users.photo')
		->where('coach_course.coach_id', $user->id)
		->leftjoin('users' ,'users.id' ,'=', 'coach_course.coach_id')->orderBy('id','desc')
		->limit(6)->get();

		$data['coach_striver']= DB::table('coach_course')->select('coach_course.*','users.name','users.photo')
		->leftjoin('users' ,'users.id' ,'=', 'coach_course.coach_id')->orderBy('id','desc')
		->limit(6)->get();
		// print_r($data['coach_coarsee']);die;
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
			->where('users.user_type_id',2)->orderBy('users.id','asc')->limit(8)->get();

			$data['suggested_striver'] = DB::table('users')->select('users.*','categories.name as slug','packages.name as subscription_name','packages.price','packages.currency_code')
			->leftjoin('categories' ,'categories.id' ,'=' ,'users.category')
			->leftjoin('categories as sub' ,'sub.id' ,'=' ,'users.sub_category')
			->leftjoin('packages' ,'packages.id' ,'=' ,'users.subscription_plans')
			
			->where('users.user_type_id',3)->orderBy('users.id','asc')->limit(8)->get();


			$data['user_subscriptions1'] = DB::table('user_subscription')->select('user_subscription.*','packages.name','users.name as username')
			->leftjoin('packages','packages.id'  ,'=','user_subscription.subscription_id')
			->leftjoin('users' ,'users.id' ,'=', 'user_subscription.user_id')
			->where('user_subscription.user_id',$user->id)
			// ->where('user_subscription.remaining_hours',0)
			->get();
		// print_r($data['user_subscription']);die;
			// $data['user_subscription'] = DB::table('user_subscription_payment')
			// 		->where('user_id', $user->id)
			// 		->first();


			$data['user_subscription'] = DB::table('user_subscription_payment')->select('user_subscription_payment.*','packages.name','users.name as username')
			->leftjoin('packages','packages.id'  ,'=','user_subscription_payment.subscription_id')
			->leftjoin('users' ,'users.id' ,'=', 'user_subscription_payment.user_id')
			->where('user_subscription_payment.user_id', $user->id)
			->get();

			$totalsum = array();
			$name = array();
			$consumed_hours = array();
			$remaining_hours = array();
			$user_id = array();
		foreach ($data['user_subscription'] as $key => $value) {
		
				$totalsum[$value->total_provided_hours] =$value->total_provided_hours;
				$name[$value->name] =$value->name;
				$consumed_hours[$value->consumed_hours] =$value->consumed_hours;
				$remaining_hours[$value->remaining_hours] =$value->remaining_hours;
				$user_id[$value->id] =$value->id;
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
		$data['subscription_plan']= Package::query()->get();

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
			'uid: '.$user->username
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
			$responsesst= json_decode($response);						
			$session_id = array();
			$datavideo_minutes = array();

		foreach($responsesst as $key =>$uidkey){
			
			//   $data[$uidkey->uid] =$uidkey;			
			foreach($uidkey as $key =>$value){
			
				// $datauid[$value->uid] =$value->uid;
				$datavideo_minutes[] =$value->video_minutes;
				$dataaudio_minutes[] =$value->audio_minutes;

				// if($value->uid == $user->username){					
				$session_id[$user->username] =$value->session_id;
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
			$responsess= json_decode($response);
			//   $datauid = array();
			$datavideo_minutes = array();
			$dataaudio_minutes = array();
			  $session_id = array();
		foreach($responsess as $key =>$uidkey){
			
			//   $data[$uidkey->uid] =$uidkey;


			foreach($uidkey as $key =>$value){
			
				// $datauid[$value->uid] =$value->uid;
				$datavideo_minutes[$value->uid] =$value->video_minutes;
				$dataaudio_minutes[$value->uid] =$value->audio_minutes;

				if($value->uid == $user->username){

					$datavideo_minutes[$value->uid] =$value->video_minutes;
					$dataaudio_minutes[$value->uid] =$value->audio_minutes;
					$session_id[$value->uid] =$value->session_id;

				}
		
				
			}  
		
		}
	}
		//   print_r($value->session_id);exit;

		$data['datavideo_minutes'] = $datavideo_minutes + $dataaudio_minutes;

		$videominuts = implode('',$data['datavideo_minutes']);
		$videominuts = $value->video_minutes;
		// print_r($videominuts);die;
		$data['dataaudio_minutes'] = $dataaudio_minutes;
		
		
		$videominutsTotal = '0'; 
		$videominutsTotal = $videominutsTotal+$videominuts;

		DB::table('user_subscription_payment')->where('user_subscription_payment.user_id',$user->id)->update(['user_subscription_payment.consumed_hours'=>$videominutsTotal]);
		

		MetaTag::set('title', t('my_account'));
		MetaTag::set('description', t('my_account_on', ['appName' => config('settings.app.name')]));

		// print_r($videominuts);die;
		
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
		//  print_r($request->all());die;
		$data = array(
			'coach_id' =>$user->id,
			'course_name' =>$request->course_name,
			'consultation_fee_per_hour' =>$request->consultation_fee_per_hour,
			'course_hourse' => $request->course_hourse,
			'total_consultation_fee' =>$request->total_consultation_fee,
			'creadit_required' =>$request->creadit_required,
			'description' => $request->description, 
			'image' => 'course_image/'.$request->image, 
			'starting_time' => $request->starting_time,
			'dated' => $request->dated,
	
	
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

		$data['sub_categories'] = DB::table('categories')->select('categories.name', 'categories.id', 'categories.parent_id','categories.slug')->where('categories.parent_id','!=', null)->orderBy('categories.name', 'asc')->get();


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