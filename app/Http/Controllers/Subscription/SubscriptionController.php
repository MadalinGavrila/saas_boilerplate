<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Plan::active()->get();

        return view('subscription.index', compact('plans'));
    }

    public function store(SubscriptionStoreRequest $request)
    {
        if(!$request->payment_method_nonce){
            return back();
        } else {
            $subscription = $request->user()->newSubscription('main', $request->plan);

            if($request->has('coupon')){
                $subscription->withCoupon($request->coupon);
            }

            $subscription->create($request->payment_method_nonce);

            return redirect('/')->withSuccess('Thanks for becoming a subscriber.');
        }
    }
}
