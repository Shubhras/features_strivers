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
        $user = auth()->user();
        $userId = $user->id;
        // print_r($request->all());die;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Stripe\Charge::create([
            "amount" => $request->price * 100,
            "currency" => "INR",
            "source" => $request->stripeToken,
            "description" => "This payment is tested purpose phpcodingstuff.com",
            // "customer" => $user->name
        ]);

        // print_r($request->hours);die;

        Session::flash('success', 'Payment successful!');

        if ($data->paid) {
            $data['subscription_plan'] = DB::table('users')->where('id', $userId)
                ->update(array(
                    'subscription_plans' => $request->subscriptionPlan,
                ));

            $date =  date('Y-m-d');


            $data['payment_details'] = DB::table('payments')
                ->insert(
                    array(
                        'user_id' => $userId,
                        'post_id' => null,
                        'package_id' => $request->subscriptionPlan,
                        'payment_method_id' => null,
                        'transaction_id' => $data->id,
                        'amount' => $data->amount / 100,
                        'receipt_url' => $data->receipt_url,
                        'active' => 1,
                        'created_at' => Carbon::now(),
                        'SubExpires' => $date,
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


    public function createSubscription(Request $request)
    {

        // $data =  date('Y-m-d');

        // $date =  date('Y-m-d h:i:s');

        // ->where('payments.created_at' ,'LIKE','%'.$date.'%')

        //    $data['subscription_list'] = DB::table('payments')->select('payments.*')->where('payments.created_at' between now() and date_add(now(), interval 30 day))->get();

        $data['subscription_list'] = DB::select(DB::raw("SELECT payments.* FROM payments 
    WHERE  now() between SubExpires and date_add( now(), interval 30 day)"));


        // $data['subscription_list'] = DB::select(DB::raw("SELECT payments.* FROM payments 
        //   WHERE SubExpires between now() and date_add( now(), interval 30 day)"));








        foreach ($data['subscription_list'] as $key => $value) {

            $CUSTOMER_ID = $value->user_id;

            $RECURRING_PRICE_ID = $value->transaction_id;
            $PRICE_ID = $value->id;




            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys


            // \Stripe\Stripe::setApiKey('sk_test_51K6WWFSHIfUu7ouY4bssfdSciQmERgNvhgYIYzx6dAryQ32Myuyqvbl6x05WG6Qtsv4mEKeR2K8GxhlGTEY4DYXY00fPf3E1W0');

            // $subscription = \Stripe\Subscription::create([
            //   'customer' => $CUSTOMER_ID,
            //   'items' => [[
            //     'price' => $RECURRING_PRICE_ID,
            //   ]],
            //   'add_invoice_items' => [[
            //     'price' => $PRICE_ID,
            //   ]],
            // ]);



            // sk_test_51K6WWFSHIfUu7ouY4bssfdSciQmERgNvhgYIYzx6dAryQ32Myuyqvbl6x05WG6Qtsv4mEKeR2K8GxhlGTEY4DYXY00fPf3E1W0

            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys


            // \Stripe\Stripe::setApiKey('sk_test_51K6WWFSHIfUu7ouY4bssfdSciQmERgNvhgYIYzx6dAryQ32Myuyqvbl6x05WG6Qtsv4mEKeR2K8GxhlGTEY4DYXY00fPf3E1W0');

            // $schedule = \Stripe\SubscriptionSchedule::create([

            // print_r($CUSTOMER_ID),
            // die,

            //     'customer' => 20,
            //     'start_date' => 1651343400,
            //     'phases' => [
            //         [
            //             'items' => [
            //                 [
            //                     'price' => $RECURRING_PRICE_ID,
            //                 ],
            //             ],
            //             'add_invoice_items' => [
            //                 [
            //                     'price' => $PRICE_ID,
            //                 ],
            //             ],
            //         ],
            //     ],
            // ]);


        //     $user = auth()->user();
        //     $userId = $user->id;
        // print_r($user);die;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Stripe\Charge::create([
            // "amount" => $request->price * 100,
            "currency" => "INR",
            // "source" => $request->stripeToken,
            "description" => "This payment is tested purpose phpcodingstuff.com",
            // "customer" => $user->name
        ]);

        // print_r($request->hours);die;

        Session::flash('success', 'Payment successful!');


            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            \Stripe\Stripe::setApiKey('sk_test_51K6WWFSHIfUu7ouY4bssfdSciQmERgNvhgYIYzx6dAryQ32Myuyqvbl6x05WG6Qtsv4mEKeR2K8GxhlGTEY4DYXY00fPf3E1W0');

            $app->post('/create-subscription', function (
                Request $request,
                Response $response,
                array $args
            ) {
                $body = json_decode($request->getBody());
                $stripe = $this->stripe;
                $customer_id = $_COOKIE['customer'];
                $price_id = $body->priceId;

                // Create the subscription. Note we're expanding the Subscription's
                // latest invoice and that invoice's payment_intent
                // so we can pass it to the front end to confirm the payment
                $subscription = $stripe->subscriptions->create([
                    'customer' => $customer_id,
                    'items' => [[
                        'price' => $price_id,
                    ]],
                    'payment_behavior' => 'default_incomplete',
                    'expand' => ['latest_invoice.payment_intent'],
                ]);

                return $response->withJson([
                    'subscriptionId' => $subscription->id,
                    'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret
                ]);
            });


            // print_r($schedule);
            // die;
        }

        return redirect()->back();
    }
}
