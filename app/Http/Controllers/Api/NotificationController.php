<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends ApiBaseController
{
    /**
     * Get user's notifications
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            
            $notifications = Notification::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);

            return $this->success($notifications, 'Notifications retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve notifications', $e->getMessage(), 500);
        }
    }

    /**
     * Get unread notifications count
     */
    public function unreadCount(Request $request)
    {
        try {
            $user = $request->user();
            
            $count = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();

            return $this->success(['count' => $count], 'Unread notifications count retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve unread notifications count', $e->getMessage(), 500);
        }
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $notification = Notification::where('user_id', $user->id)
                ->findOrFail($id);
                
            $notification->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

            return $this->success($notification, 'Notification marked as read');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Notification not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to mark notification as read', $e->getMessage(), 500);
        }
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(Request $request)
    {
        try {
            $user = $request->user();
            
            Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now(),
                ]);

            return $this->success(null, 'All notifications marked as read');
        } catch (\Exception $e) {
            return $this->error('Failed to mark all notifications as read', $e->getMessage(), 500);
        }
    }

    /**
     * Delete notification
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $notification = Notification::where('user_id', $user->id)
                ->findOrFail($id);
                
            $notification->delete();

            return $this->success(null, 'Notification deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Notification not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to delete notification', $e->getMessage(), 500);
        }
    }
}