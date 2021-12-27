<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gender;
use App\Models\Post;
use App\Models\SavedPost;
use Session;
use Stripe;
    
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($price =null)
    {
        $data = [];
		
		$data['genders'] = Gender::query()->get();
		
		$user = auth()->user();
		
        if(!$user){
            return redirect('login');
        }
        else{
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
            
            $data['price'] = $price;
            
            //  print_r('kjskdjkdsj k jkd jskdjk dj dsjfjkdf');die;
            return appView('home.stripe', $data);
        }
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        // print_r($request->price);die;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->price,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }
}