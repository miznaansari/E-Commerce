<?php

namespace App\Http\Controllers;

use App\Models\User;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class FirebaseNotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $validated = $request->validate([
            'fcm_token' => 'required|string',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
    
        $messaging = app('firebase.messaging');
    
        $notification = Notification::create($validated['title'], $validated['body']);
        $message = CloudMessage::withTarget('token', $validated['fcm_token'])
            ->withNotification($notification);
    
        try {
            $messaging->send($message);
            return redirect()->back()->with('success', 'Notification sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to send notification: ' . $e->getMessage()]);
        }
    }
    
    
    public function storeFcmToken(Request $request)
    {
        $fcmToken = $request->input('token');
        $existingUser = User::where('fcm_token', $fcmToken)->first();

        if ($existingUser) {
            return response()->json(['message' => 'FCM token already stored!']);
        }
        $customerId = Auth::id(); 

        $user = new User();
        $user->customer_id = $customerId;
        $user->fcm_token = $fcmToken;
        $user->save();

        return response()->json(['message' => 'FCM token stored successfully!']);
    }
}
