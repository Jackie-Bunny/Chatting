<?php

namespace App\Http\Controllers\User;

use App\Events\SmsEvent;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chatGet()
    {
        if (!Auth::user()) {
            return back()->with('error', 'Please login or create account first !');
        }
        return view('messenger');
    }

    public function userGet(Request $request)
    {
        $userId = $request->user_id;
        $user = User::find($userId);
        $status = $user->status == 1 ? 'online' : 'offline';
        return response()->json([
            'profile_image' => asset('uploads/users/' . $user->profile),
            'name' => $user->name,
            'status' => $status
        ]);
    }

    public function sendMessage(Request $request)
    {
        try {
            $message = new Message();
            $message->user_id = Auth::user()->id;
            $message->sender_id = $request->sender_id;
            $message->reciever_id = $request->receiver_id;
            $message->message = $request->message ?? '';
            // $fileName = null;
            // if ($request->hasFile(.'audio')) {
            //     $file = $request->file('audio');
            //     $fileName = time() . '.' . $file->extension();
            //     $file->move('uploads/files/', $fileName);
            //     $message->msg_file = $fileName;
            // }
            // if ($request->hasFile('msg_files')) {
            //     $files = $request->file('msg_files');
            //     $filePaths = [];
            //     foreach ($files as $file) {
            //         $fileName = time() . '.' . $file->extension();
            //         $file->move('uploads/message-files/', $fileName);
            //         $filePaths[] = $fileName;
            //     }
            //     $message->message_file = json_encode($filePaths);
            // }
            $users = User::whereIn('id', [$request->receiver_id, Auth::id()])->get();
            foreach ($users as $user) {
                $user->profile_url = asset('uploads/users/' . $user->profile);
            }
            // $path = $fileName ? asset('uploads/files/' . $fileName) : null;
            // dd($request->all());
            $message->save();
            Log::info('Broadcasting data:', ['message' => $message, 'users' => $users]);
            broadcast(new SmsEvent($message, $users));
            return response()->json(['success' => true, 'data' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
 
    public function getMessages(Request $request)
    {
        $userId = $request->user_id;
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())->where('reciever_id', $userId)
                ->orWhere('sender_id', $userId)->where('reciever_id', Auth::id());
        })->get();
        $users = User::whereIn('id', [$userId, Auth::id()])->get();
        return response()->json([
            'messages' => $messages,
            'users' => $users,
        ]);
    }

    public function fetchMessages(Request $request)
    {
        $userId = $request->user_id;
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())->where('reciever_id', $userId)
                ->orWhere('sender_id', $userId)->where('reciever_id', Auth::id());
        })->get();
        $users = User::whereIn('id', [$userId, Auth::id()])->get();
        foreach ($users as $user) {
            $user->profile_url = asset('uploads/users/' . $user->profile);
        }
        // dd($messages, $users);
        return response()->json([
            'messages' => $messages,
            'users' => $users,
        ]);
    }
}
