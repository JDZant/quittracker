<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNotificationRequest;
use App\Models\User;
use App\Models\UserNotificationSetting;


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

        $notificationSettings->update([
           'email_notifications' => $data['email_notifications'],
           'frequency' => $data['frequency'],
           'user_id' => $user->id
        ]);

        $user->update([
           'email' => $data['email']
        ]);

        return redirect()->back()->with('success', 'Notification settings updated successfully.');
    }




}
