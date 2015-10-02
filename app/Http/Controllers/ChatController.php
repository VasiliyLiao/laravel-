<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events\MessageCreated;

class ChatController extends Controller
{
    public function index()
    {
        srand(time()); // 亂數種子
        $username = sprintf('user%06d', rand(1, 100000)); // 決定 user 名稱 (註)
        return view('chat', compact('username'));
    }

    public function sendMessage(Request $request)
    {
        $username = $request->get('username');
        $message = $request->get('message');
        event(new MessageCreated($username, $message));
        return 'message sent';
    }

}
