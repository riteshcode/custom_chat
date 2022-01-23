<?php use Carbon\Carbon; ?>
<div class="chat-header clearfix">
    <div class="row">
        <div class="col-lg-6">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
            </a>
            <div class="chat-about">
                <h6 class="m-b-0">{{ !empty($userInfo) ? $userInfo->name: ''}}</h6>
                <small> {{ !empty($userInfo) ? $userInfo->user_log_status: ''}} {{Carbon::now()->diffForHumans()}}</small>
            </div>
        </div>
        <div class="col-lg-6 hidden-sm text-right">
            <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
            <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
            <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
            <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
        </div>
    </div>
</div>
<div class="chat-history">
    <ul class="m-b-0 chat-history-list" id="chat-history-list">
        @if(sizeof($messageList)> 0)
	        @foreach($messageList as $message)
	       		@if($message->sender_id == Auth::id())
		       		<li class="clearfix">
			            <div class="message-data text-right">
			                <span class="message-data-time">10:10 AM, Today</span>
			                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
			            </div>
			            <div class="message other-message float-right">{{$message->body}}</div>
			        </li>
	       		@else
			        <li class="clearfix">
			            <div class="message-data">
			                <span class="message-data-time">10:12 AM, Today</span>
			            </div>
			            <div class="message my-message">{{$message->body}}</div>                                    
			        </li>
	       		@endif
	       	@endforeach
	    @else
	    	<li class="clearfix">
	    		<p class="text-center">No Message !</p>
	        </li>
        @endif

    </ul>
</div>
<div class="chat-message clearfix">
	<form id="send_message_form">
		@csrf
		<input type="hidden" name="sender_id" value="{{Auth::id()}}">
		<input type="hidden" name="receiver_id" value="{{ !empty($userInfo) ? $userInfo->id:0 }}">
		<input type="hidden" name="room_id" value="{{ $chatRoomInfo->id }}">
	    <div class="input-group mb-0">
	        <div class="input-group-prepend">
	            <button type="submit" class="input-group-text send-submit" ><i class="fa fa-send"></i></button>
	        </div>
	        <input type="text" name="message" id="sendMessage" class="form-control" placeholder="Enter text here.({{Auth::user()->name}})..">                                    
	    </div>
    </form>
</div>

<script type="text/javascript">
	$('#send_message_form').submit(function(e){
        e.preventDefault();
        $.ajax({
	         type:'POST',
	         url:"{{ url('/send') }}",
	         processData: false,
			 contentType: false,
	         data: new FormData(this),
	         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	         beforeSend:function(){
	         	$('.send-submit').html('<i class="fa fa-spinner"></i>');
	         },
	         success:function(data){
	            $("#msg").html(data.msg);
	         	$('.send-submit').html('<i class="fa fa-send"></i>');
	         	$('.chat-history-list').append(`<li class="clearfix">
				            <div class="message-data text-right">
				                <span class="message-data-time">10:10 AM, Today</span>
				                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
				            </div>
				            <div class="message other-message float-right">${$('#sendMessage').val()}</div>
				        </li>
			    `);
			    $('#sendMessage').val('');
	         }
	      });
    });

	// initialize socket here
 room_id = parseInt('{{ $chatRoomInfo->id }}');
window.Echo.private(`room.${room_id}`)
    .listen('.sendmessage', (e) => {
        console.log('sendmessage', e);    
    	$('.chat-history-list').append(`<li class="clearfix">
                        <div class="message-data">
                            <span class="message-data-time">10:12 AM, Today</span>
                        </div>
                        <div class="message my-message">${e.data.body}</div>                                    
                    </li>
		    `);

    });

</script>
