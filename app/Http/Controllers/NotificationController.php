<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserNotificationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::with('notificationSettings')->findOrFail(auth()->id());


        return view('pages.notifications.notification-settings', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->notificationSettings()->update([
            'email_notifications' => $request->email_notifications,
            'frequency' => $request->frequency,
            'user_id' => $user->id
        ]);

        return redirect()->back()->with('success', 'Notification settings updated successfully.');
    }




}
