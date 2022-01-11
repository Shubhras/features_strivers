<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gender;
use App\Models\Post;
use App\Models\SavedPost;
use Session;
use Stripe;
use Carbon\Carbon;
    
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)

    {
        // print_r($request->all());die;
        $data = [];
		
		$data['genders'] = Gender::query()->get();
		
		$user = auth()->user();
        // print_r($user->name);die;
		
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
            
            $data['price'] = $request->price;
            $data['subscriptionPlan'] = $request->subscriptionPlan;
            $data ['totalHours'] = $request->totalHours;
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
        $user = auth()->user();
        $userId = $user->id;
        // print_r($request->all());die;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Stripe\Charge::create ([
                "amount" => $request->price *100,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com",
                // "customer" => $user->name
        ]);

        // print_r($request->hours);die;
   
        Session::flash('success', 'Payment successful!');
        
        if($data->paid){
            $data['subscription_plan'] = DB::table('users')->where('id', $userId)
					->update(array(
						'subscription_plans' => $request->subscriptionPlan, 
					));
            
            $data['payment_details'] = DB::table('payments')
                    ->insert(array(
                        'user_id' => $userId,
                        'post_id' => null,
                        'package_id' => $request->subscriptionPlan,
                        'payment_method_id' => null,
                        'transaction_id' => $data->id,
                        'amount' => $data->amount/100,
                        'receipt_url' => $data->receipt_url,
                        'active' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => null

                    )
                );
            
            $data['user_subscription_payment'] = DB::table('user_subscription_payment')
                    ->insert(array(
                        'user_id' => $userId,
                        'subscription_id' => $request->subscriptionPlan,
                        'total_provided_hours' => $request->totalHours,
                        'consumed_hours' => 0,
                        'remaining_hours' => $request->totalHours,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'deleted_at' => NULL

                    ));
                
        }
        return redirect("/");
    }


    public function forward_back_block(){
        return redirect("/");
    }





}