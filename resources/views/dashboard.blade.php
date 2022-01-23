<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat Dashboard') }}
        </h2>
    </x-slot>

<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Online user</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                    
                    @if(!empty($all_room_user))
                        @foreach($all_room_user as $all_room_user)
                            <li class="nav-item active">
                              <a onclick="loadchat('{{$all_room_user->id}}','{{ ($all_room_user->sender_id == Auth::id() ) ? $all_room_user->receiver_info->id : $all_room_user->sender_info->id }}')" href="javascript:void(0);" class="nav-link">
                                <i class="fas fa-inbox"></i>
                                    {{ ($all_room_user->sender_id == Auth::id() ) ? $all_room_user->receiver_info->name : $all_room_user->sender_info->name }}
                                <span class="badge bg-primary float-right">12</span>
                              </a>
                            </li>
                        @endforeach
                    @endif
                  </ul>
                </div>
                <!-- /.card-body -->
              </div>

        </div>
        <div class="col-md-9">

        <div class="card direct-chat direct-chat-primary">
          <div class="card-header">
            <h3 class="card-title">Direct Chat</h3>

            <div class="card-tools">
              <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                      data-widget="chat-pane-toggle">
                <i class="fas fa-comments"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" id="direct-chat-messages">
              
              
              

            </div>
            <!--/.direct-chat-messages-->

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <form action="#" method="post" id="send-message-other">
                @csrf
              <div class="input-group">
                <input type="hidden" name="room_id" id="room_id" value="">
                <input type="hidden" name="sender_id" value="{{ Auth::id() }}">
                <input type="hidden" name="receiver_id" id="receiver_id" value="">
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-append">
                  <button type="submit" class="btn btn-primary">Send</button>
                </span>
              </div>
            </form>
          </div>
          <!-- /.card-footer-->
        </div>
        </div>
    </div>

</div>
        


<script src="{{ url('/') }}/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
    

    // const send_message_other = document.getElementById('send-message-other');
    // console.log(send_message_other);
    // $('#send-message-other').submit(function(e){
    //     console.log(e);
    //     e.preventDefault();
    //     // $.ajax({
    //     //     url : '/send',
    //     //     type: 'POST',
    //     //     // dataType: 'json',
    //     //     data: new FormData(this),
    //     //     // cache : false,
    //     //     processData: false
    //     // }).done(function(response) {
    //     //     alert(response);
    //     // });

    //     $.post("/send",
    //       new FormData(this),
    //       function(data, status){
    //         console.log("Data: " + data + "\nStatus: " + status);
    //       });
        
        
    // });

    function loadchat(roomid,receiver_id){
        var base_url = "{{url('/get/')}}/"+roomid;
        $.get(base_url,function(response){
            $('#receiver_id').val(receiver_id);
            $('#room_id').val(roomid);
            $('#direct-chat-messages').html(response.body);

        });
    }

</script>

</x-app-layout>




