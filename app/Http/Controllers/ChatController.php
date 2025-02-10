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
        return view('livechat');
    }

   public function getMessages()
{
    $messages = Message::with('user')->latest()->take(20)->get();

    return response()->json([
        'messages' => $messages
    ]);
}

    
public function sendMessage(Request $request)
{
    \Log::info('Received Message:', $request->all()); // Log message data

    $validated = $request->validate([
        'message' => 'required|string|max:500',
    ]);

    // Check if admin or user is logged in
    if (Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();
    } elseif (Auth::guard('web')->check()) {
        $user = Auth::guard('web')->user();
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Store the message with user details
    $message = Message::create([
        'user_id' => $user->id,  // Works for both user and admin
        'message' => $validated['message'],
    ]);

    \Log::info('Message saved:', $message->toArray()); // Log saved message

    broadcast(new MessageSent($message->load('user')))->toOthers();

    return response()->json(['message' => $message]);
}



}