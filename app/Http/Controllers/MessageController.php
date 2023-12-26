<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_username' => [
                'required',
                Rule::exists('users', 'name'),
            ],
            'content' => 'required',
        ]);

        $receiver = User::where('name',
                                $request->receiver_username)->firstOrFail();

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver->id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success',
                                        'Message sent successfully.');
    }

    public function showMessages()
    {
        $user = Auth::user();
        $sentMessages = $user->sentMessages;
        $receivedMessages = $user->receivedMessages;

        return view('messages.show', compact('sentMessages',
                                             'receivedMessages'));
    }
}
