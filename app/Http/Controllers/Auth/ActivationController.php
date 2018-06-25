<?php

namespace App\Http\Controllers\Auth;

use App\Models\ConfirmationToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['confirmation_token.expired:/']);
    }

    protected $redirectTo = '/dashboard';

    public function activate(ConfirmationToken $token, Request $request)
    {
        $token->user->update([
            'activated' => true
        ]);

        Auth::loginUsingId($token->user->id);

        $token->delete();

        return redirect()->intended($this->redirectPath())->withSuccess('You are now signed in.');
    }

    protected function redirectPath()
    {
        return $this->redirectTo;
    }
}
