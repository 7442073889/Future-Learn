<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->latest()->take(20)->get();
        return view('admin.livechat', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
        ]);

        if (!Auth::guard('admin')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $message = Message::create([
            'user_id' => Auth::guard('admin')->id(),
            'message' => $validated['message'],
        ]);

        return response()->json(['message' => $message]);
    }

    public function getMessages()
    {
        $messages = Message::with('user')->latest()->take(20)->get();
        return response()->json(['messages' => $messages]);
    }
}

