<?php

namespace App\Http\Controllers\Account\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionCardController extends Controller
{
    public function index()
    {
        return view('account.subscription.card.index');
    }

    public function store(Request $request)
    {
        if (!$request->payment_method_nonce) {
            return back();
        } else {
            $request->user()->updateCard($request->payment_method_nonce);

            return redirect()->route('account.index')->withSuccess('Your card has been updated.');
        }

    }
}
