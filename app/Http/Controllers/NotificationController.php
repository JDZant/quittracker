<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNotificationRequest;
use App\Mail\NotificationEmail;
use App\Models\User;
use App\Models\UserNotificationSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class NotificationController extends Controller
{
    public function index()
    {
        $user = User::with('notificationSettings')->findOrFail(auth()->id());


        return view('pages.notifications.notification-settings', [
            'user' => $user,
        ]);
    }

    public function update(UserNotificationRequest $request, User $user)
    {
        $data = $request->validated();
        $notificationSettings = $user
            ->with('notificationSettings')
            ->first()
            ->notificationSettings;

        if(is_null($notificationSettings)){
            UserNotificationSetting::create([
                'email_notifications' => $data['email_notifications'],
                'frequency' => $data['frequency'],
                'user_id' => $user->id
            ]);
        } else {
            $notificationSettings->update([
                'email_notifications' => $data['email_notifications'],
                'frequency' => $data['frequency'],
                'user_id' => $user->id
            ]);
        }
        $user->update([
            'email' => $data['email']
        ]);

        return redirect()->back()->with('success', 'Notification settings updated successfully.');
    }

    public function sendEmailNotification(): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $recipientEmail = $user->email;

        $emailContent = 'This is the email notification content.';

        Mail::to($recipientEmail)->send(new NotificationEmail($emailContent));

        return redirect()->back()->with('success', 'Email notification sent successfully.');
    }





}
