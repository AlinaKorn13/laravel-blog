<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsLetterController extends Controller
{
    /*
        Single action controller for picking email to subscribe
    */
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/');
    }
}
