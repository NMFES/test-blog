<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSended;

class ContactController extends Controller {

    /**
     * Sends message to author
     * @param Request $request
     * @return string
     */
    public function message(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string|min:10|max:5000',
        ]);

        // Send email to me
        Mail::to(config('mail.from.address'))->send(new MessageSended($request->email, $request->message));

        return response()->json([
                    'success' => true
        ]);
    }

}
