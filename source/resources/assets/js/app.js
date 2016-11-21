

var chat = {
    chatSubmitBox:'footer .textinput',
    chatAreaWrap: 'section',
    chatArea:     '.chat-area',
    attachButton: 'footer .attachment',

    chatEmptyMessage: 'Type a message here',

    init:function() {
        $(this.chatSubmitBox).html(this.chatEmptyMessage);
        this.initChatSubmit();
        this.initClearChat();
        this.initSocket();
        this.initChatSubmitLooseFocus();
        this.initAttachButton();
        this.initUploadAction();
    },

    initClearChat:function() {
        $(this.chatSubmitBox).focus(function(){
            if($(this).html() == chat.chatEmptyMessage) {
                $(this).html('');
            }
        });
    },

    initChatSubmit:function() {
        $(this.chatSubmitBox).keypress(function(e) {
            if(e.which == 13) {
                var message = $(this).html();
                $(this).html('');
                $.post( "/chat", {message:message}, function( data ) {
                    console.log(data);
                });
                return false;
            }
        });
    },

    initSocket:function() {
        var socket = io('http://socket-example.dev:3000');
        socket.on('chat:message', function(data) {
            var thisUser = $('.thisUser').html();
            var type = (thisUser === data.user) ? 'me' : 'other';
            $('.chat-area').append('<p><span class="user user-'+type+'">'+data.user+':</span> '+data.message+'</p>');

            chat.checkForScrollCorrection();
        });
    },

    initChatSubmitLooseFocus:function() {
        $(this.chatSubmitBox).blur(function() {
            if($(this).html() == '') {
                $(this).html(chat.chatEmptyMessage);
            }
        })
    },

    checkForScrollCorrection:function() {
        if($(this.chatArea).height() > $(this.chatAreaWrap).height())
        {
            $(this.chatAreaWrap).scrollTop($(this.chatArea).height());
        }
    },

    initAttachButton:function() {
        $(this.attachButton).click(function()
        {
            $('footer input').focus().trigger('click');
        });
    },

    initUploadAction : function() {
        $('footer input').change(function () {
            var fd = new FormData();
            fd.append('file', $(this).get(0).files[0]);

            $.ajax({
                url: '/chat',
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST'
            });
        });
    }
};

$(document).ready(function() {
    chat.init();
});


var getXsrfToken = function() {
    var cookies = document.cookie.split(';');
    var token = '';

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split('=');
        if(cookie[0] == 'XSRF-TOKEN') {
            token = decodeURIComponent(cookie[1]);
        }
    }

    return token;
}

jQuery.ajaxSetup({
    headers: {
        'X-XSRF-TOKEN': getXsrfToken()
    }
});