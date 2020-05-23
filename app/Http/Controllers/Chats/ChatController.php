<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Chats\Message;

class ChatController extends Controller
{
    public function index(){
        return view('app.dashboard.chat.index');
    }

    public function fetchContacts(){
        $contacts = User::where('id', '!=', Auth()->user()->id)->get();
        return response()->json($contacts);
    }

    public function fetchMessages($id){
        $messages = Message::where('from', $id)->orWhere('to', $id)->get();

        return response()->json($messages);
    }
}
