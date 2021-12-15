<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use App\Http\Requests\UserRequest;
use App\Models\Post;
use App\Models\SavedPost;
use App\Models\Package;
use App\Models\Gender;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Torann\LaravelMetaTags\Facades\MetaTag;


use Laravel\Cashier\Billable;
use Auth;
use App\User;
use Illuminate\Support\Facades\Request;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    //
    public function stripe()
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

        //  print_r('kjskdjkdsj k jkd jskdjk dj dsjfjkdf');die;
        return appView('home.stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {   
        
        $token = Request::input('stripeToken');

        Stripe::setApiKey(Config::get('stripe.secret_key'));

        try {
            return Stripe_Charge::create([
                'amount' => 1000,
                'currenct' => 'gbp',
                'description' => Auth::user()->email,
                'card' => $token,
            ]);
        } catch(Stripe_CardError $e) {
            dd('card declined');
        }
    }
}
