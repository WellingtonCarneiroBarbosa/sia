<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Chats\Message;
use App\Events\Chat\MessageSent;
use DB;

class ChatController extends Controller
{
    public function index(){
         // select all users except logged in user
        // $users = User::where('id', '!=', auth()->user()->id)->get();

        // count how many message are unread from the selected user
        $users = DB::select("select users.id, users.name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . auth()->user()->id . "
        where users.id != " . auth()->user()->id . " 
        group by users.id, users.name, users.profile_image, users.email");

        return view('app.dashboard.chat.index', compact('users'));
    }

    public function getMessage($user_id)
    {
        $my_id = auth()->user()->id;

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('app.dashboard.chat.messages', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = auth()->user()->id;
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        $data = \json_encode(['from' => $from, 'to' => $to]); // sending from and to user id when pressed enter
    
        event(new MessageSent($data));
    }
}
