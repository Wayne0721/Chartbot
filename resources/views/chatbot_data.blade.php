@php
    $nowTime = date('Y-m-d H:i:s');
@endphp
<div class="chats mt-5">
    <div class="chat chat-left">
        <div class="chat-avatar">
            <span class="avatar box-shadow-1 cursor-pointer">
                <img src="http://admin.aiinfo.cc/images/avatars/yee_head.jpg" alt="avatar" height="36" width="36">
            </span>
        </div>
        <div class="chat-body">
            <div class="chat-content">
                <p>{{ $response_text }}</p>
            </div>
        </div>
        <p>{{ $nowTime }}</p>
    </div>
    <div id="user-speak-{{ $chat_position }}" class="chat" style="display: none">
        <div class="chat-avatar">
            <span class="avatar box-shadow-1 cursor-pointer">
                <img src="https://admin.aiinfo.cc/images/avatars/yee_head.jpg" alt="avatar" height="36" width="36">
            </span>
        </div>
        <div class="chat-body">
            <div class="chat-content cursor-pointer">
                <p id="user-speak-sentence-{{ $chat_position }}">
                    See way up into that tree?
                </p>
            </div>
        </div>
        <p id="user-speak-time-{{ $chat_position }}" style="float:right;">
            {{ $nowTime }}
        </p>
    </div>
</div>
