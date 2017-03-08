<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;
use SlackApi;

class SlackController extends Controller
{
    public function getSocialRedirect( $provider )
    {

        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {

            return view('pages.status')
                ->with('error','No such provider');

        }

        return Socialite::driver( $provider )->redirect();

    }

    public function getSocialHandle( $provider )
    {

        if (Input::get('denied') != '') {

            return redirect()->to('login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');

        }

        $user = Socialite::driver( $provider )->user();

        $slackUser = null;

        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        $email = $user->email;

        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }

        if (!empty($userCheck)) {
            $slackUser = $userCheck;
        }
        else {

            $sameSlackId = User::where('slack_id', '=', $user->id)
                ->where('provider', '=', $provider )
                ->first();

            if (empty($sameSlackId)) {

                //There is no combination of this social id and provider, so create new one
                $newUser = new User;

                $newUser->email = $email;
                $name = explode(' ', $user->name);

                if (count($name) >= 1) {
                    $newUser->first_name = $name[0];
                }
                if (count($name) >= 2) {
                    $newUser->last_name = $name[1];
                }

                $newUser->password = bcrypt(str_random(16));
                $newUser->token = str_random(64);
                $newUser->provider = $provider;
                $newUser->slack_id = $user->id;

                // Default to user role
                $role = Role::whereName('user')->first();
                $newUser->role_id = $role->id;

                // Slack Data: Handle, Title, Avatars
                $slackData = SlackApi::execute('users.info', ['user' => $newUser->slack_id]);
                $newUser->slack_handle = $slackData['user']['name'];

                if( ! empty($slackData['user']['profile']['title'])){
                    $slack_title = $slackData['user']['profile']['title'];
                } else {
                    $slack_title = NULL;
                }

                $newUser->slack_title = $slack_title;
                $newUser->slack_avatar_32 = $slackData['user']['profile']['image_32'];
                $newUser->slack_avatar_192 = $slackData['user']['profile']['image_192'];
                $newUser->save();

                $slackUser = $newUser;

            }
            else {

                //Load this existing social user
                $slackUser = $sameSlackId->user;

            }

        }

        auth()->login($slackUser, true);

        if ( auth()->user()->hasRole('administrator')) {

            return redirect()->route('admin.home');
        }
//        else
//        if ( auth()->user()->hasRole('member')) {

            return redirect()->route('{slack_handle}.index', ['slack_handle' => auth()->user()->slack_handle]);

//        }


        return abort(500, 'User has no Role assigned, role is obligatory! You did not seed the database with the roles.');

    }
}