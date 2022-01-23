@extends('layouts')
@section('sidebar')
<div id="plist" class="people-list">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
        <input type="text" class="form-control" placeholder="Search...">
    </div>
    <ul class="list-unstyled chat-list mt-2 mb-0">
        @if(!empty($userList))
            @foreach($userList as $user)
                <li class="clearfix" onclick="showChat({{$user->id}})" >
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                    <div class="about">
                        <div class="name">{{$user->name}}</div>
                        <div class="status"> <i class="fa fa-circle {{$user->user_log_status}}"></i> {{$user->user_log_status}}</div>
                    </div>
                </li>
            @endforeach
        @else
            <li class="clearfix" >No User Found !</li>
        @endif
        <li class="clearfix" >
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </li>

    </ul>
</div>

@endsection

@section('content')
    <div class="chat" style="min-height: 600px;">
        <br/><br/>
        <p class="text-center">No Message preview !</p>
    </div>

<script src="{{ url('/') }}/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    
    function showChat(userid){
        $(this).addClass('active');
        var base_url = "{{url('/get/')}}/"+userid;
        $.get(base_url,function(response){
            $('.chat').html(response);
        });
    }

    const send_message_other = document.getElementById('send-message-other');
    console.log(send_message_other);
    $('#send-message-other').submit(function(e){
        console.log(e);
        e.preventDefault();
        $.ajax({
            url : '/send',
            type: 'POST',
            // dataType: 'json',
            data: new FormData(this),
            // cache : false,
            processData: false
        }).done(function(response) {
            alert(response);
        });

        $.post("/send",
          new FormData(this),
          function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
          });
        
        
    });

    function loadchat(roomid,receiver_id){
        var base_url = "{{url('/get/')}}/"+roomid;
        $.get(base_url,function(response){
            $('#receiver_id').val(receiver_id);
            $('#room_id').val(roomid);
            $('#direct-chat-messages').html(response.body);
        });
    }

</script>


@endsection
