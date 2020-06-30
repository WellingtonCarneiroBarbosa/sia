@extends('layouts.dashboard')

@section('title', 'Chat')

@section('styles')
<style>
    .chat {
      list-style: none;
      margin: 0;
      padding: 0;
    }
  
    .chat li {
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 1px dotted #B3A9A9;
    }
  
    .chat li .chat-body p {
      margin: 0;
      color: #777777;
    }
  
    .panel-body {
      overflow-y: scroll;
      height: 350px;
      padding: 1em;
    }

    .chat-border {
      border-style: solid;
      border-width: 1px;
    }
  
    ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      background-color: #F5F5F5;
    }
  
    ::-webkit-scrollbar {
      width: 12px;
      background-color: #F5F5F5;
    }
  
    ::-webkit-scrollbar-thumb {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
      background-color: #555;
    }
</style>

<script>
  $(document).ready(function (){
    var out = document.getElementById("out");
    // allow 1px inaccuracy by adding 1
      var isScrolledToBottom = out.scrollHeight - out.clientHeight <= out.scrollTop + 1;
  })
 
</script>
@endsection

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default ">
                <div class="panel-heading">Chat</div>
  
                <div class="panel-body chat-border">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

