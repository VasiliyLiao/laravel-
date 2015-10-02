<!DOCTYPE html>
<html>
<head>
    <title>ChatRoom</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
</head>
<body>
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>公開評道</h1>
                <!-- 訊息列表框 -->
                <div id="public-chat-room">
                </div>
                <!-- 輸入訊息的表單 -->
                <form id="public-send-message" method="post" action="/send-message">
                    {!! csrf_field() !!}
                    <input type="hidden" name="username" value="{{ $username }}"/>

                    <div class="input-group">
                        <label id="user" class="input-group-addon">{{ $username }}</label>
                        <input id="public-message" name="message" type="text" value="" class="form-control"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" id="send">Send</button>
                                </span>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    var socket = window.io('http://localhost:3000');

    var $pubicChatRoom = $('#public-chat-room');
    var $publicSendMessage = $('#public-send-message');
    var $publicMessageInput = $('#public-message');

    var $privateChatRoom = $('#private-chat-room');
    var $privateSendMessage = $('#private-send-message');
    var $privateMessageInput = $('#private-message');

    var user = $('#user').text();
    $publicSendMessage.on('submit', function () {
        $.post(this.action, $publicSendMessage.serialize());
        $publicMessageInput.val('');
        return false;
    });

    socket.emit('add user', user);
    socket.on('chat-channel:all', function (payload) {
        addMessageHtml($pubicChatRoom, payload);
    });

    function addMessageHtml(chatRoomParam, payload) {
        var html = '<div class="message alert-info" style="display: none;">';
        html += payload.username + ': ';
        html += payload.message;
        html += '</div>';

        var $message = $(html);
        chatRoomParam.append($message);
        $message.fadeIn('fast');
    }
</script>
</body>
</html>
