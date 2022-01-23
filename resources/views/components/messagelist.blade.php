
@if(!empty($all_msg))
@foreach($all_msg as $msg)

@if( $msg->sender_id == Auth::id() || $msg->receiver_id == Auth::id())
<div class="direct-chat-msg">
	<div class="direct-chat-infos clearfix">
	  <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
	</div>
	<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
	<div class="direct-chat-text">
	  {{ $msg->body }}
	</div>
</div>
@else
<div class="direct-chat-msg right">
	<div class="direct-chat-infos clearfix">
	  <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
	</div>
	<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
	<div class="direct-chat-text">
	  {{ $msg->body }}
	</div>
</div>
@endif
@endforeach

@else
<div>
	No message !
</div>
@endif