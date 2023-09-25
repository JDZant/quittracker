<?php

namespace App\Console\Commands;

use App\Mail\NotificationEmail;
use App\Models\QuitAttempt;
use App\Models\User;
use App\Models\UserNotificationSetting;
use App\Traits\CalculatedSmokingData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNotificationEmails extends Command
{
    use CalculatedSmokingData;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notification-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications based on user settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = UserNotificationSetting::where('email_notifications', true)
            ->with('user')
            ->get();

        foreach ($users as $userSetting) {
            $user = $userSetting->user;
            $quitAttempt = QuitAttempt::whereUserId($user->id)->whereNull('end_date')->first();


            $smokingData = $this->calculateSmokingData($quitAttempt);

            $content = [
                'daysStopped' => $this->daysStopped,
                'smokingData' => $smokingData
            ];

            Mail::to($user->email)->send(new NotificationEmail($content));
        }
    }
}
