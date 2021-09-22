$('#postForm').on('submit', function (e) {
  e.preventDefault();
  var form = $('#postForm')[0];
  var data = new FormData(form);
  $.ajax({
    type: "post",
    url: '/home',
    enctype: 'multipart/form-data',
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    success: function () {
      $("#post").val('');
      $("#image").val('');
    }
  });
});