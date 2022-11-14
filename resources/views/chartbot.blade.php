@extends('layouts.master')

@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/test/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/test/app-chat.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/test/app-chat-list.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/test/core.css') }}">
@endsection

@section('content')
    <div id="wrapper" style="overflow-y: hidden">
        @php
            $nowTime = date('Y-m-d H:i:s');
        @endphp
        <section id="content" style="overflow-y: hidden">
            <div class='wrapper' style="max-width: 80%">
                <div id="dialogue" class="chat-application">
                    <section class="chat-app-window">
                        <!-- Active Chat -->
                        <div class="active-chat">
                            <!-- User Chat messages -->
                            <div class="user-chats ps ps--active-x ps--active-y">
                                <div class="chats">
                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <span class="avatar box-shadow-1 cursor-pointer">
                                                <img src="https://admin.aiinfo.cc/images/avatars/yee_head.jpg"
                                                    alt="avatar" height="36" width="36">
                                            </span>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-content">
                                                <p>您好！我是機器人小智，有任何問題都可以問我唷！</p>
                                            </div>
                                        </div>
                                        <p>{{ $nowTime }}</p>
                                    </div>
                                    <div id="user-speak-1" class="chat" style="display: none">
                                        <div class="chat-avatar">
                                            <span class="avatar box-shadow-1 cursor-pointer">
                                                <img src="https://admin.aiinfo.cc/images/avatars/yee_head.jpg"
                                                    alt="avatar" height="36" width="36">
                                            </span>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-content cursor-pointer">
                                                <p id="user-speak-sentence-1">
                                                    See way up into that tree?
                                                </p>
                                            </div>
                                        </div>
                                        <p id="user-speak-time-1" style="float:right;">
                                            {{ $nowTime }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- User Chat messages -->
                        </div>
                        <!--/ Active Chat -->
                    </section>
                </div>
                <div id="speak" class="card">
                    <div class="row align-items-center" style="height: 100%">
                        <div class="col-11 form-group mb-1">
                            <input type="text" class="form-control" id="chat-text" name="chat-text">
                        </div>
                        <div class="col-1 form-group mb-1">
                            <button class="form-control mr-2" id="message-send">送出</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container clearfix" style="height:60px"></div>
        </section>

        <div class="modal fade record_search" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 10000">
            <div class="modal-dialog modal-lg">
                <div class="modal-body">
                    <div id="keywordSearch" class="modal-content">
                        <div class="modal-header" style="justify-content: space-between">
                            <div></div>
                            <h4 class="modal-title">對話紀錄查詢</h4>
                            <i class="icon-line2-close" data-dismiss="modal"></i>

                        </div>
                        <div class="modal-body">
                            <input id="keyword" name="keyword" type="text" placeholder="查找對話內容關鍵字" class="mb-2" style="width:100%" required>
                            
                            <div class="row" id="chat-record">
                                
                            </div>
                            
                            <div class="text-center mt-3">
                                <input id="search-type" name="search-type" type="text" value="course" hidden>
                                <button id="confirm-search" class="button btn-primary button-rounded" type="submit">
                                    查詢
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        var chat_position = 1;
        $('#message-send').click(function() {
            var message_text = $('#chat-text').val();
            console.log(message_text);

            if (message_text) {
                //將使用者輸入的內容顯示在對話框上
                $('#user-speak-' + chat_position).css('display', 'block');
                $('#user-speak-sentence-' + chat_position).text(message_text);
                chat_position++;
                let formData = new FormData();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', CSRF_TOKEN);
                formData.append('chat_position', chat_position);
                formData.append('response_text', message_text);
                $.ajax({
                    url: '/api/chatbot/response',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'post',
                    success: function(data) {
                        $('.user-chats').append(data.html);
                        var scrollDiv = document.getElementById('dialogue');
                        scrollDiv.scrollTop = scrollDiv.scrollHeight;
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                    }
                });
            }
        });

        $('#record-search-click').click(function(){
            $('.record_search').modal('show');
        });

        $('#confirm-search').click(function(){
            var search_text = $('#keyword').val();

            if(search_text){
                let formData = new FormData();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', CSRF_TOKEN);
                formData.append('keyword', search_text);

                $.ajax({
                    url: '/api/chatbot/search',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'post',
                    success: function(data) {
                        $('#chat-record').html(data.html);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                    }
                });
            }
        });
    </script>
@endsection
