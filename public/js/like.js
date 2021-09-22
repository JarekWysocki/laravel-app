var myId = $('.myboard').attr('name');
giveLike = (e) => {
    var idPost = e.target.parentElement.parentElement.parentElement.id;
    var formData = new FormData();
    formData.append("myId", myId);
    formData.append("idPost", idPost);
    $.ajax({
        type: "post",
        url: '/like',
        enctype: 'multipart/form-data',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function () {
        }
    });
}
wholike = (e) => {
    var idPost = e.target.parentElement.parentElement.parentElement.id;
    var formData = new FormData();
    formData.append("idPost", idPost);
    $.ajax({
        type: "post",
        url: '/like',
        enctype: 'multipart/form-data',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (responses) {
            if (responses.length) {
                if (!($('.whoislike').length)) {
                    $('#' + idPost + ' div.card-footer').prepend('<div class="whoislike"></div>');
                    responses.forEach((response, i) => {
                        $('.whoislike').append('<p>' + response.name + '</p>');
                    });

                }
            }
        }
    });
}
out = (e) => {
    $('.whoislike').remove();
}
$('.wholike').on("mouseover", wholike);
$('.wholike').on("mouseout", out);
$('.like').on("click", giveLike);