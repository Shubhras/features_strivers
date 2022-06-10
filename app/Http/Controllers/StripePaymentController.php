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

        if (!$user) {
            return redirect('login');
        } else {
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
            $data['userEmail'] = $user->email;
            $data['price'] = $request->price;
            $data['subscriptionPlan'] = $request->subscriptionPlan;
            $data['totalHours'] = $request->totalHours;

            $data['courseId'] = $request->courseId;
            //  print_r($data ['courseId']);die;
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
        // print_r($request->totalHours);die;
        $user = auth()->user();
        $userId = $user->id;
        $user_name = $user->name;
        $user_email = $user->email;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $token =     \Stripe\Token::create(array(
            "card" => array(
                "number" => $request->cardNumber,
                "exp_month" => $request->expiryMonth,
                "exp_year" => $request->expiryyear,
                "cvc" => $request->cvcNumber,
            )
        ));

// print_r($token->id);die;
        $customer2 = \Stripe\Customer::create(['email' => $request->email, 'name' => $user->name]);
        $subscription = Stripe\Charge::create([
            'customer' => $customer2->id,
            "amount" => $request->price * 100,
            "currency" => "INR",
            "source" => $request->stripeToken,
            "description" => "This payment is tested purpose phpcodingstuff.com",
            "customer" => $request->name,
            // "token" =>$token->id
        ]);
        // print_r($data->source);die;

        // $subscription = \Stripe\PaymentIntent::create([
        //     'customer' => $customer->id,
        //     'currency' => 'INR',
        //     'amount' => $request->price * 100,
        //     'metadata' => [
        //         'title' => 'abc',
        //         'price'    =>  $request->price * 100,

        //     ],
        // ]);




        $stripe = 'stripe';

        // print_r($request->hours);die;

        Session::flash('success', 'Payment successful!');

        

        if ($subscription->paid) {
            $data['subscription_plan'] = DB::table('users')->where('id', $userId)
                ->update(array(
                    'subscription_plans' => $request->subscriptionPlan,
                ));

            $date =  date('Y-m-d');

            $privious_date =   date('Y-m-d', strtotime('+30 days'));
            $data['payment_details'] = DB::table('payments')
                ->insert(
                    array(
                        'user_id' => $userId,
                        'post_id' => null,
                        'package_id' => $request->subscriptionPlan,
                        'payment_method_id' => null,
                        'transaction_id' => $subscription->id,
                        'amount' => $subscription->amount / 100,
                        'receipt_url' => $subscription->receipt_url,
                        'active' => 1,
                        'email' => $user_email,
                        'user_name' =>$user_name,
                        'source' =>   $request->stripeToken,
                        'created_at' => Carbon::now(),
                        'SubExpires' => $privious_date,
                        'card_token' =>  $token->id,
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



         // print_r($request->all());die;
        //  $user = auth()->user();
         // print_r( $data['subscription_list']);die;
         $data['subscription_list'] = DB::table('payments')->select('payments.*', 'users.name as username', 'users.email')->join('users', 'users.id', '=', 'payments.user_id')->where('payments.card_token', $token->id)->whereNotNull('SubExpires')->get();
         // print_r($data['subscription_list']);die;
 
         

         foreach ($data['subscription_list'] as $key => $value) {
 
             $CUSTOMER_ID = $value->user_id;
 
             $RECURRING_PRICE_ID = $value->transaction_id;
             $PRICE_ID = $value->amount;
             $DATED_ID = $value->created_at;
             $Subexpire = $value->SubExpires;
             $user2 = $value->username;
             $source = $value->source;
             $email = $value->email;
             $packageid = $value->package_id;
 
             $date_arr = explode(" ", $DATED_ID);
             $date = $date_arr[0];
             $time = $date_arr[1];
             // print_r( $value);die;
 
             $privious_date =   date('Y-m-d', strtotime($date . ' + 30 days'));
             // 'Y-m-d', strtotime($Date. ' + 10 days')
             // print_r($privious_date);die;
             $current_date = Carbon::now();
             $date_arr = explode(" ", $current_date);
             $date1 = $date_arr[0];
             $time = $date_arr[1];
             // print_r($privious_date);die;
            //  if ($privious_date == $date1 || $Subexpire ==  $date1) {
 
                 //  print_r($value);die;
 
 
                 // Session::flash('success', 'Payment successful!');
 
 
 
 
                 // $dateTrial = Carbon::now();
 
                 // $dateAdd = $dateTrial->addMonths(1)->timestamp;
                 $amountStripe = $value->amount;
                 $intervalMonth = $privious_date;
                 $paymentIntentId = '';
 
 
                 //print_r($getOrderDetail);die;
 
                 $add =  DB::table('users')->where('email', $email)->update([
                     'Subscription_plans' =>  $packageid
                 ]);
                 // print_r($add);die;
                 // if($dataInput['method'] == "stripe"){
 
                 // if($getOrderDetail->payment_mode == "Test"){
 
                 //     $key = $getOrderDetail->payment_test_key;
 
                 // }else{
 
                 //     $key = $getOrderDetail->payment_live_key;
                 // } 
 
 
 
                 Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
 
                 //update price in strip portal
                 $customer = \Stripe\Customer::all(['email' => $email]);
                 // $customer = \Stripe\Token::create(['email'=> $email]);
 
                 // print_r($customer);die;
 
                 if (count($customer->data) > 0) {
 
                     // if($packageid){
 
                     //     if($PRICE_ID == "One Time"){
                     $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                     $customer1 = \Stripe\Customer::create(['email' => $customer->email, 'name' => $customer->name]);
 
                    
            // print_r($token->id);die;
 
                         if (!empty($token->id)) {
                             //Insert new product and prices
                             $product = \Stripe\Product::create([
                                 'name' => 'Enroll Course',
                             ]);
 
                             $price = \Stripe\Price::create([
                                 'product' => $product->id,
                                 'unit_amount' => $request->price * 100,
                                 'currency' => 'INR'
                             ]);
                             // print_r( $price);die;
 
                             // $subscription = \Stripe\PaymentIntent::create([
                             //     'customer' =>  $customer->id,
                             //     'currency' => 'INR',
                             //     'amount' => '300',
                             //     // 'metadata' => [
                             //         // 'title' =>'test',
                             //     //     'orderId' => $getOrderDetail->id,
                             //     //     'offer_id' => $PRICE_ID,
                             //         // 'price'    => '300',
                             //     //     'key' => $key, 
                             //     // ],
                             // ]);
 
                             //    $token= \Stripe\Token::create(array(
                             //             "card" => array(
                             //               "number" => "4242424242424242",
                             //               "exp_month" => 1,
                             //               "exp_year" => 2023,
                             //               "cvc" => "414"
                             //             )
                             //           ));
                             //   print_r($token);die;
 
                            //  $subscription = Stripe\Charge::create([
                            //      'customer' => $customer->id,
                            //      "amount" => $request->price * 100,
                            //      "currency" => "INR",
                            //      "source" =>   $token->id,
                            //      "description" => "This payment is tested purpose phpcodingstuff.com",
                            //      // "customer" => $request->name
                            //  ]);
                             $date = date("d-m-Y", $subscription->created);
 
 
                             $client_secret = $subscription->client_secret;
                             $paymentIntentId = $subscription->id;
                             // print_r( $client_secret);die;
                             //update price id in order form table
                             DB::table('payments')->where('id', $value->id)->update([
                                 'amount' =>  $request->price * 100
                             ]);
                             // }
                             $interval = 'month';
                             //multiple time recrring payment create price
                             $rec_price = \Stripe\Price::create([
                                 'product' => $product->id,
                                 'unit_amount' => $request->price * 100,
                                 'currency' => 'INR',
                                 'recurring' => [
                                     'interval' => $interval,
                                 ]
                             ]);
                             // print_r($rec_price);die;
                             // $current_date = Carbon::now();
                             //     $date_arr= explode(" ", $current_date);
                             //     $date1= $date_arr[0];
                             //     $time= $date_arr[1];  

                             $subscription = \Stripe\Subscription::create([
                                'customer' => $customer1->id,
                                'items' => [[
                                    'price' =>$rec_price->id,
                                ]],
                                'metadata' => [
                                    'title' => 'Enroll Course',
                                    // 'orderId' => $getOrderDetail->id,
                                    // 'offer_id' => $getOrderDetail->offer_id,
                                    // 'price'    => '300',
                                    // 'key' => $key, 
                                ],
                                'payment_behavior' => 'default_incomplete',
                                'expand' => ['latest_invoice.payment_intent'],
                            ]);
                            
                             $schedule = \Stripe\SubscriptionSchedule::create([
                                 'customer' =>  $customer1->id,
                                 'start_date' => $subscription->created,
                                 'end_behavior' => 'release',
                                 'phases' => [
                                     [
                                         'items' => [
                                             [
                                                 'price' =>  $rec_price->id,
                                                 'quantity' => 1,
                                             ],
                                         ],
                                         'iterations' => 1,
                                     ],
                                 ],
                                 'metadata' => [
                                     'title' => 'Enroll Course',
                                     // 'orderId' => $getOrderDetail->id,
                                     // 'offer_id' => $getOrderDetail->offer_id,
                                     'price'    => $request->price * 100,
                                     'customer' =>  $customer1->id,
                                     // 'key' => $key, 
                                 ],
                             ]);
                         } else {
                         }
                    
 
                     // print_r($schedule);die;
 
                 } else {
 
                     $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
 
                     if ($privious_date == "Monthly") {
                         $interval = 'month';
                     } elseif ($privious_date == "Yearly") {
                         $interval = 'year';
                     } else {
                         $interval = 'month';
                     }
 
                     //Insert new product and prices
                     $product = \Stripe\Product::create([
                         'name' => 'Enroll Course',
                     ]);
 
                     $price = \Stripe\Price::create([
                         'product' => $product->id,
                         'unit_amount' => $request->price * 100,
                         'currency' => 'INR',
                         'recurring' => [
                             'interval' => 'month',
                         ],
                     ]);
                     // print_r($price);die;
                     $subscription = \Stripe\Subscription::create([
                         'customer' => $customer->id,
                         'items' => [[
                             // 'price' => '300',
                         ]],
                         'metadata' => [
                             'title' => 'strivre Enroll Course',
                             // 'orderId' => $getOrderDetail->id,
                             // 'offer_id' => $getOrderDetail->offer_id,
                             // 'price'    => '300',
                             // 'key' => $key, 
                         ],
                         'payment_behavior' => 'default_incomplete',
                         'expand' => ['latest_invoice.payment_intent'],
                     ]);
                     //update price id in order form table
                    //  print_r($subscription);die;
                     DB::table('payments')->where('id', $value->id)->update([
                         'amount' => $request->price * 100
                     ]);
                     $client_secret = $subscription->latest_invoice->payment_intent->client_secret;
                     $paymentIntentId = $subscription->latest_invoice->payment_intent->id;
                     // print_r('xyz',$paymentIntentId);die;
                 }
            //  }
         }


        if (!empty($request->courseId)) {

            return redirect('get_coach_course/' . $request->courseId);
        } else {

            return redirect("/account/my_subscription");
        }


        // return redirect("/account/my_subscription");
    }





    public function forward_back_block()
    {
        return redirect("/");
    }


  


}
