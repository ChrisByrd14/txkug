<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\CaptchaTrait;
use App\Models\User;
use App\Notifications\SlackInviteRequestNotification;
use Alert;


class SlackInviteController extends Controller
{
    use CaptchaTrait;

    /**
     * Create a new slack invite request instance after form validation.
     */
    public function processSlackInviteRequest(Request $request)
    {
        $request['captcha'] = $this->captchaCheck();

        $this->validate($request, [
                'name'            => 'required',
                'email'           => 'required|email',
                'g-recaptcha-response'  => 'required',
                'captcha'         => 'required|min:1'
            ],[
                'name.required'   => 'Your name is required',
                'email.required'  => 'Your email address is required',
                'email.email'     => 'The email you entered is invalid',
                'g-recaptcha-response.required' => 'The Captcha response is required',
                'captcha.min'    => 'Wrong captcha, please try again.'
            ]
        );

        $user = User::find(1);
        $user->notify(new SlackInviteRequestNotification($request));

        Alert::success('Your request to join our Slack team has been received. We will send you an email with a registration link shortly!', 'Thanks!')
            ->persistent('Close');
        return redirect()->route('welcome.index');

    }

}
