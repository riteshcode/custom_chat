<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SendMessage;
use Auth;

use App\Models\User;
use App\Models\ChatRoom;
use App\Models\Message;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        User::where('id', Auth::id())->update(['user_log_status'=>'online']);
        $userList = User::all()->except(Auth::id());
        return view('chat',compact('userList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $response = Message::create([
            'chat_room_id'=>$request->room_id,
            'sender_id'=>$request->sender_id,
            'receiver_id'=>$request->receiver_id,
            'body'=>$request->message,
        ]);
        
        broadcast( new SendMessage($response, $request->room_id))->toOthers();

        return response()->json(['success'=>true, 'data'=>$response]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {   
        $userList = array((int)$user_id,Auth::id());
        sort($userList);

        $chatRoomInfo = ChatRoom::where('ids',implode(',', $userList))->first(); 
        if($chatRoomInfo == null){
            $chatRoomInfo = ChatRoom::create(['ids'=>implode(',', $userList)]);
        }

        // message list
        $messageList = Message::where('chat_room_id', $chatRoomInfo->id)->get();
        $userInfo = User::find($user_id);

        return view('messagelist',compact('messageList','userInfo','chatRoomInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
