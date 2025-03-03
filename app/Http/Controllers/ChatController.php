<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check() || Auth::guard('admin')->check()) {
            return view('livechat');
        }
    
        return redirect()->route('account.welcome')->with('error', 'You must be logged in to access the chat.');
    }
    

    public function getMessages()
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user(); // Normal User
        } elseif (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user(); // Admin User
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $messages = Message::with('user')->orderBy('created_at', 'asc')->get();
    
        \Log::info('Messages Retrieved for:', ['user_id' => $user->id, 'user_role' => $user->role ?? 'User/Admin']);
    
        return response()->json(['messages' => $messages]);
    }
    
    
public function sendMessage(Request $request)
{
    // Check if a user or admin is authenticated
    if (Auth::guard('web')->check()) {
        $user = Auth::guard('web')->user(); // Normal User
    } elseif (Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user(); // Admin User
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    \Log::info('Chat Message Sent By:', ['user_id' => $user->id, 'user_name' => $user->name]);

    // Validate input
    $validated = $request->validate([
        'message' => 'required|string|max:500',
    ]);

    // Store the message in the database
    $message = Message::create([
        'user_id' => $user->id,
        'message' => $validated['message'],
    ]);

    return response()->json(['message' => $message]);
}

}