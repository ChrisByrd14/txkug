<?php

namespace App\Console;

use App\Notifications\SendEventReminderToSlack;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use SlackApi;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
//use Mail;


class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // Schedule for Updating User tables with Slack Data
        $schedule->call(function () {
            $users = User::get();
            $users->map(function ($user) {
                $response = SlackApi::execute('users.info', ['user' => $user->slack_id]);

                if( ! empty($response['user']['profile']['title'])){
                    $slack_title = $response['user']['profile']['title'];
                } else {
                    $slack_title = NULL;
                }

                $user->update([
                    'slack_handle' => $response['user']['name'],
                    'slack_title' => $slack_title,
                    'slack_avatar_32' => $response['user']['profile']['image_32'],
                    'slack_avatar_192' => $response['user']['profile']['image_192'],
                ]);
            });
        })->daily();


        /**
         * Scheduler for Sending Event Notifications to Slack Channel
         *
         * Find any event scheduled for 4 days from today OR scheduled for today
         * Run the scheduler daily at 8:30 am CST
         */

        $schedule->call(function() {

            // Find any event schedule for 4 days from today OR scheduled for today
            $event = Event::with('venue')
                ->where('event_date', '=', Carbon::today()->addDays(4))
                ->orWhere('event_date', '=', Carbon::today()->addDays(1))
                ->orWhere('event_date', '=', Carbon::now()->toDateTimeString())
                ->orderBy('stops_at')
                ->first();

            if ( $event->count() > 0 ) {
                $user = \App\Models\User::find(1);
                $user->notify(new SendEventReminderToSlack($event));
            }

        })->daily();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}