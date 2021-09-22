var pathname = window.location.pathname;
if (pathname == '/users/list') { var fromUser = $('.users').attr('name'); }
if (pathname == '/home') { var fromUser = $('.myboard').attr('name'); }
chatWithUser = (e, data) => {
    if (data == undefined) {
        var toUser = e.target.id;
        var userName = $(e.target.nextElementSibling).text();
    }
    else {
        userName = $('#' + data).next().text();
        var toUser = data;
    }
    if ((!($('.card-body').is('.' + toUser))) && toUser != fromUser) {
        var newWindowChat = '<div class="card prv border-secondary mt-3" style="width: 18rem; height:25rem;"> \
                            <div class="card-header">'+ userName + '<span class="float-right close">x</span></div> \
                                <div class="card-message card-body '+ toUser + '"> \
                                </div> \
                                <form method="post" id="prv'+ toUser + '" enctype="multipart/form-data"> \
                                    <div> \
                                        <input type="text" class="form-control col-12 d-inline" id="message" name="message"> \
                                        <input type="hidden" value="'+ fromUser + '" id="fromUser" name="fromUser"> \
                                        <input type="hidden" value="'+ toUser + '" id="toUser" name="toUser"> \
                                    </div> \
                                    <button type="submit" class="btn btn-primary col-12 d-inline">Send</button> \
                                </form> \
                            </div> \
                        </div>';

        $('.chatWindows').append(newWindowChat);
        var formData = new FormData();
        formData.append("toUser", toUser);
        formData.append("fromUser", fromUser);
        var checkMessage = setInterval(function () {
            $.ajax({
                type: "post",
                url: '/users/list',
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (responses) {
                    var amount = $('.' + toUser + " p").length
                    var count = responses.length;
                    var value = count - amount;
                   
                    if (value > 0) {
                        value = value - 1;
                        for (value; value >= 0; value--) {
                            $('.' + toUser).append('<p class="card-text'+(responses[value].fromUser == toUser ? ' out ':' in')+'">' + responses[value].message + '</p>');
                        };
                        $('.' + toUser).scrollTop($('.' + toUser)[0].scrollHeight);
                    }
                }
            });
        }, 1000);
        $('.close').on("click", function () {
            $(this).parent().parent().remove();
            clearInterval(checkMessage);
        });
        $('#prv' + toUser).on('submit', function (e) {
            e.preventDefault();
            var form = $('#prv' + toUser)[0];
            var data = new FormData(form);
            $.ajax({
                type: "post",
                url: '/users/list',
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function () {
                    $("#prv" + toUser + " input#message").val('');
                }
            });
        });
    }
};
$('.user img').on("click", chatWithUser);
var checkNewMessage = setInterval(function () {
    var data = new FormData();
    data.append("fromUser", fromUser);
    $.ajax({
        type: "post",
        url: '/newmessage',
        enctype: 'multipart/form-data',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (responses) {
            if (responses.length > 0) {
                if (pathname == '/users/list') {
                    responses.forEach((response, i) => {
                        chatWithUser(null, response.fromUser);
                    });
                }
                if (pathname == '/home' && $('.alert-info').length == 0) {
                    $('#app').prepend('<div class="col-6 mx-auto text-center alert \
                    alert-info" role="alert">Somebody is wrote to you \
                     <a href="/users/list" class="alert-link">Go to chat!</a></div>')
                }
            }
        }
    });
}, 1000);