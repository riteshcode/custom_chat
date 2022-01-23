<?php

namespace Module\Messanger\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Request;
use Module\Messanger\Models\User;
use Module\Messanger\Models\ChatRoom;
use Module\Messanger\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessangerController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        dd(Auth::id());
        $userList = User::where('id', '!=', Auth::id())->get();
        return view('chatui::chat', compact('userList'));
    }
}