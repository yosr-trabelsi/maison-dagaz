<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    
    public function index()
    {
        $userId = Auth::id();

       
        $contactIds = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->get()
            ->map(fn($m) => $m->sender_id === $userId ? $m->receiver_id : $m->sender_id)
            ->unique()
            ->values();

        $contacts = User::whereIn('id', $contactIds)
            ->where('id', '!=', $userId)
            ->get()
            ->map(function ($user) use ($userId) {
                $lastMessage = Message::where(function ($q) use ($userId, $user) {
                    $q->where('sender_id', $userId)->where('receiver_id', $user->id);
                })->orWhere(function ($q) use ($userId, $user) {
                    $q->where('sender_id', $user->id)->where('receiver_id', $userId);
                })->latest()->first();

                $user->last_message   = $lastMessage?->body;
                $user->last_message_at = $lastMessage?->created_at;
                $user->unread_count   = Message::where('sender_id', $user->id)
                    ->where('receiver_id', $userId)
                    ->where('is_read', false)
                    ->count();

                return $user;
            })
            ->sortByDesc('last_message_at')
            ->values();

        
        $allUsers = User::where('id', '!=', $userId)->get();

        return view('chat.index', compact('contacts', 'allUsers'));
    }

   
    public function show(User $user)
    {
        $userId = Auth::id();

       
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where(function ($q) use ($userId, $user) {
            $q->where('sender_id', $userId)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($userId, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $userId);
        })->orderBy('created_at')->get();

       
        $contactIds = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->get()
            ->map(fn($m) => $m->sender_id === $userId ? $m->receiver_id : $m->sender_id)
            ->unique()
            ->push($user->id)
            ->values();

        $contacts = User::whereIn('id', $contactIds)
            ->where('id', '!=', $userId)
            ->get()
            ->map(function ($u) use ($userId) {
                $lastMessage = Message::where(function ($q) use ($userId, $u) {
                    $q->where('sender_id', $userId)->where('receiver_id', $u->id);
                })->orWhere(function ($q) use ($userId, $u) {
                    $q->where('sender_id', $u->id)->where('receiver_id', $userId);
                })->latest()->first();

                $u->last_message    = $lastMessage?->body;
                $u->last_message_at = $lastMessage?->created_at;
                $u->unread_count    = Message::where('sender_id', $u->id)
                    ->where('receiver_id', $userId)
                    ->where('is_read', false)
                    ->count();

                return $u;
            })
            ->sortByDesc('last_message_at')
            ->values();

        $allUsers = User::where('id', '!=', $userId)->get();

        return view('chat.show', compact('messages', 'user', 'contacts', 'allUsers'));
    }

    
    public function send(Request $request, User $user)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $user->id,
            'body'        => $request->body,
        ]);

        return redirect()->route('chat.show', $user->id);
    }

    
    public function poll(Request $request, User $user)
    {
        $userId    = Auth::id();
        $lastId    = (int) $request->query('last_id', 0);

        $messages = Message::where('id', '>', $lastId)
            ->where(function ($q) use ($userId, $user) {
                $q->where(fn($q) => $q->where('sender_id', $userId)->where('receiver_id', $user->id))
                  ->orWhere(fn($q) => $q->where('sender_id', $user->id)->where('receiver_id', $userId));
            })
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'id'        => $m->id,
                'body'      => e($m->body),
                'is_mine'   => $m->sender_id === $userId,
                'time'      => $m->created_at->format('H:i'),
            ]);

        
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

  
    public function unreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}
