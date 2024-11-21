<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'notifications' => $user->notifications,
            'unread_count' => $user->notifications()->whereNull('read_at')->count(),
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
            $notification->update(['read_at' => now()]);
            return response()->json(['message' => 'Notification marked as read.']);

    }

    public function markAllAsRead(Request $request)
    {
        $user = $request->user();
        $user->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return response()->json(['message' => 'All notifications marked as read.']);
    }
}
