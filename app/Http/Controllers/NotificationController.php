<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Vérifier et nettoyer les notifications avec des données manquantes
        foreach ($notifications as $notification) {
            if (!isset($notification->data['title'])) {
                $notification->data = array_merge($notification->data, [
                    'title' => 'Notification',
                    'message' => 'Nouvelle notification reçue'
                ]);
            }
        }

        return view('notifications.index', compact('notifications'));
    }
    
    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        try {
            $notification = Auth::user()->notifications()->findOrFail($id);
            $notification->markAsRead();

            return redirect()->back()->with('success', 'Notification marquée comme lue.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour de la notification.');
        }
    }
    
    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        try {
            $user = Auth::user();
            $unreadCount = $user->unreadNotifications->count();

            if ($unreadCount > 0) {
                $user->unreadNotifications->markAsRead();
                return redirect()->back()->with('success', "Toutes les notifications ({$unreadCount}) ont été marquées comme lues.");
            } else {
                return redirect()->back()->with('info', 'Aucune notification non lue à marquer.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour des notifications.');
        }
    }
    
    /**
     * Get unread notifications count.
     */
    public function getUnreadCount()
    {
        $count = Auth::user()->unreadNotifications->count();
        
        return response()->json([
            'count' => $count
        ]);
    }
    
    /**
     * Get latest notifications for dropdown.
     */
    public function getLatest()
    {
        $user = Auth::user();
        $notifications = $user->notifications()
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($notification) {
                // S'assurer que les données de notification sont complètes
                $data = $notification->data;
                if (!isset($data['title'])) {
                    $data['title'] = 'Notification';
                }
                if (!isset($data['message'])) {
                    $data['message'] = 'Nouvelle notification reçue';
                }

                return [
                    'id' => $notification->id,
                    'data' => $data,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at,
                    'created_at_human' => $notification->created_at->diffForHumans()
                ];
            });

        $unreadCount = $user->unreadNotifications->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
}
