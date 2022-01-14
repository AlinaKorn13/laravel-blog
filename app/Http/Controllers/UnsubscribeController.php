<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UnsubscribeController extends Controller
{
    /*
       Single action controller for picking email to subscribe
   */
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->unsubscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be removed from our newsletter list.'
            ]);
        }

        return redirect('/');
    }
}
